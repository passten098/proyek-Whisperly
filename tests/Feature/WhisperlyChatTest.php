<?php

namespace Tests\Feature;

use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\talents\Models\TalentSchedule;
use App\Modules\talents\Models\talents;
use App\Modules\bookings\Models\bookings;
use App\Modules\chat\Models\WhisperlyConversation;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class WhisperlyChatTest extends TestCase
{
    use RefreshDatabase;

    protected function makeBookingFlow(string $status = 'active'): array
    {
        $now = Carbon::parse('2026-08-23 08:30:00', 'Asia/Jakarta');
        Carbon::setTestNow($now);

        $user = pengguna::create([
            'username' => 'rakan',
            'email' => 'rakan@example.com',
            'password' => bcrypt('secret123'),
            'role' => 'user',
        ]);

        $talentUser = pengguna::create([
            'username' => 'salsa',
            'email' => 'salsa@example.com',
            'password' => bcrypt('secret123'),
            'role' => 'talent',
        ]);

        $talentProfile = talents::create([
            'pengguna_id' => $talentUser->id,
            'deskripsi' => 'Talent test',
        ]);

        $startTime = '08:00';
        $endTime = '09:00';
        if ($status === 'completed') {
            $startTime = '07:00';
            $endTime = '08:00';
        }

        if ($status === 'upcoming') {
            $startTime = '10:00';
            $endTime = '11:00';
        }

        $schedule = TalentSchedule::create([
            'talent_id' => $talentProfile->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => 'available',
        ]);

        $booking = WhisperlyBooking::create([
            'pengguna_id' => $user->id,
            'talent_id' => $talentProfile->id,
            'schedule_id' => $schedule->id,
            'status' => $status,
        ]);

        $conversation = WhisperlyConversation::create([
            'booking_id' => $booking->id,
            'user_id' => $user->id,
            'talent_id' => $talentProfile->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return [$user, $talentUser, $talentProfile, $schedule, $booking, $conversation];
    }

    public function test_talent_profile_generates_slots_until_22_00(): void
    {
        $user = pengguna::create([
            'username' => 'salsa-slot-check',
            'email' => 'salsa-slot-check@example.com',
            'password' => bcrypt('secret123'),
            'role' => 'talent',
        ]);

        $controller = new \App\Http\Controllers\WhisperlyTalentController();
        $method = new \ReflectionMethod($controller, 'profileFor');
        $method->setAccessible(true);

        $profile = $method->invoke($controller, $user);

        $slotRanges = $profile->schedules->pluck('start_time', 'end_time')->mapWithKeys(function ($startTime, $endTime) {
            return ["{$startTime}-{$endTime}" => true];
        })->all();

        $this->assertArrayHasKey('20:00-21:00', $slotRanges);
        $this->assertArrayHasKey('21:00-22:00', $slotRanges);
        $this->assertArrayHasKey('08:00-09:00', $slotRanges);
    }

    public function test_user_can_send_message_in_active_booking_room(): void
    {
        [$user, , , , $booking, $conversation] = $this->makeBookingFlow('active');

        $response = $this->actingAs($user, 'whisperly')
            ->post(route('whisperly.chat.store', $booking->id), [
                'message' => 'Hai',
            ]);

        $response->assertRedirect(route('whisperly.chat.show', $booking->id));
        $this->assertDatabaseHas('whisperly_messages', [
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'message' => 'Hai',
        ]);
    }

    public function test_booking_sync_uses_real_user_and_talent_data_without_zero_placeholders(): void
    {
        [$user, $talentUser, $talentProfile, $schedule, $booking] = $this->makeBookingFlow('active');

        $booking->syncLaralagBooking();
        $booking->syncLaralagBooking();

        $this->assertDatabaseCount('bookings', 1);
        $this->assertDatabaseHas('bookings', [
            'source_booking_id' => $booking->id,
            'id_pengguna' => $user->id,
            'id_talent' => $talentProfile->id,
            'pengguna_username' => $user->username,
            'talent_username' => $talentUser->username,
            'durasi_jam' => 1,
            'status' => 'active',
        ]);
    }

    public function test_soft_deleted_booking_is_restored_and_updated_instead_of_creating_duplicate(): void
    {
        [$user, $talentUser, $talentProfile, , $booking] = $this->makeBookingFlow('upcoming');

        $legacyBooking = new bookings();
        $legacyBooking->id = (string) Str::uuid();
        $legacyBooking->source_booking_id = $booking->id;
        $legacyBooking->id_pengguna = $user->id;
        $legacyBooking->id_talent = $talentProfile->id;
        $legacyBooking->pengguna_username = 'old-user';
        $legacyBooking->talent_username = 'old-talent';
        $legacyBooking->tanggal_booking = '2026-08-23';
        $legacyBooking->durasi_jam = 0;
        $legacyBooking->status = 'upcoming';
        $legacyBooking->save();
        $legacyBooking->delete();

        $booking->syncLaralagBooking();

        $this->assertSame(1, bookings::withTrashed()->where('source_booking_id', $booking->id)->count());
        $this->assertDatabaseHas('bookings', [
            'source_booking_id' => $booking->id,
            'id_pengguna' => $user->id,
            'id_talent' => $talentProfile->id,
            'pengguna_username' => $user->username,
            'talent_username' => $talentUser->username,
            'durasi_jam' => 1,
            'status' => 'upcoming',
        ]);
    }

    public function test_same_user_cannot_create_duplicate_booking_for_same_schedule(): void
    {
        $now = Carbon::parse('2026-08-23 08:30:00', 'Asia/Jakarta');
        Carbon::setTestNow($now);

        $user = pengguna::create([
            'username' => 'rakan',
            'email' => 'rakan@example.com',
            'password' => bcrypt('secret123'),
            'role' => 'user',
        ]);

        $talentUser = pengguna::create([
            'username' => 'salsa',
            'email' => 'salsa@example.com',
            'password' => bcrypt('secret123'),
            'role' => 'talent',
        ]);

        $talentProfile = talents::create([
            'pengguna_id' => $talentUser->id,
            'deskripsi' => 'Talent test',
        ]);

        $schedule = TalentSchedule::create([
            'talent_id' => $talentProfile->id,
            'start_time' => '08:00',
            'end_time' => '09:00',
            'status' => 'available',
        ]);

        $first = WhisperlyBooking::create([
            'pengguna_id' => $user->id,
            'talent_id' => $talentProfile->id,
            'schedule_id' => $schedule->id,
            'status' => 'upcoming',
        ]);

        $secondResponse = $this->actingAs($user, 'whisperly')
            ->post(route('whisperly.bookings.store', $talentUser->username), [
                'schedule_id' => $schedule->id,
            ]);

        $secondResponse->assertRedirect(route('whisperly.talents.show', $talentUser->username));
        $this->assertSame(1, WhisperlyBooking::query()->where('schedule_id', $schedule->id)->count());
        $this->assertDatabaseHas('whisperly_bookings', [
            'id' => $first->id,
            'schedule_id' => $schedule->id,
            'pengguna_id' => $user->id,
            'talent_id' => $talentProfile->id,
            'status' => 'upcoming',
        ]);
    }

    public function test_chat_screen_shows_closed_message_after_booking_time_ends(): void
    {
        [$user, , , , $booking] = $this->makeBookingFlow('completed');

        $response = $this->actingAs($user, 'whisperly')
            ->get(route('whisperly.chat.show', $booking->id));

        $response->assertStatus(200);
        $response->assertSee('Booking telah selesai. Chat ini sudah ditutup.');
    }

    public function test_user_can_rate_a_completed_booking_once(): void
    {
        [$user, $talentUser, $talentProfile, $schedule, $booking] = $this->makeBookingFlow('completed');

        $response = $this->actingAs($user, 'whisperly')
            ->post(route('whisperly.bookings.rating.store', $booking->id), [
                'rating' => 5,
                'ulasan' => 'Mayan banget, sangat membantu.',
            ]);

        $response->assertRedirect(route('whisperly.chat.show', $booking->id));
        $this->assertDatabaseHas('ratings', [
            'booking_id' => $booking->id,
            'pengguna_id' => $user->id,
            'talent_id' => $talentProfile->id,
            'nilai_rating' => 5,
        ]);
        $this->assertDatabaseHas('bookings', [
            'source_booking_id' => $booking->id,
            'status' => 'completed',
            'pengguna_username' => $user->username,
            'talent_username' => $talentUser->username,
        ]);
    }
}
