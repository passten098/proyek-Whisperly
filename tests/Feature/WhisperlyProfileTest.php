<?php

namespace Tests\Feature;

use App\Modules\pengguna\Models\pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WhisperlyProfileTest extends TestCase
{
    use RefreshDatabase;

    private function createWhisperlyUser(array $overrides = []): pengguna
    {
        return pengguna::create(array_merge([
            'username' => 'citrawangi',
            'email' => 'citra@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'user',
            'bio' => 'Halo, ini bio saya di Whisperly.',
        ], $overrides));
    }

    public function test_guest_is_redirected_from_profile_page(): void
    {
        $response = $this->get(route('whisperly.profile'));
        $response->assertRedirect(route('login.baru'));
    }

    public function test_authenticated_user_can_view_profile_page(): void
    {
        $user = $this->createWhisperlyUser();

        $response = $this->actingAs($user, 'whisperly')
            ->get(route('whisperly.profile'));

        $response->assertOk();
        $response->assertSee('Profil Saya');
        $response->assertSee('citrawangi');
        $response->assertSee('citra@example.com');
        $response->assertSee('Halo, ini bio saya di Whisperly.');
        $response->assertSee('Tanggal Bergabung');
        $response->assertSee('Bio');
        // Pastikan role tidak ditampilkan di card utama sesuai instruksi "hanya boleh menampilkan 5 hal"
        $response->assertDontSee('INFORMASI AKUN');
    }

    public function test_user_can_update_bio(): void
    {
        $user = $this->createWhisperlyUser();

        $response = $this->actingAs($user, 'whisperly')
            ->postJson(route('whisperly.profile.bio.update'), [
                'bio' => 'Bio baru yang telah diperbarui!',
            ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'bio' => 'Bio baru yang telah diperbarui!',
            ]);

        $this->assertDatabaseHas('pengguna', [
            'id' => $user->id,
            'bio' => 'Bio baru yang telah diperbarui!',
        ]);
    }

    public function test_user_can_upload_profile_photo(): void
    {
        Storage::fake('public');

        $user = $this->createWhisperlyUser();
        $file = UploadedFile::fake()->image('my_avatar.jpg', 300, 300);

        $response = $this->actingAs($user, 'whisperly')
            ->postJson(route('whisperly.profile.photo.update'), [
                'photo' => $file,
            ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
            ]);

        $user->refresh();
        $this->assertNotNull($user->profil);
        Storage::disk('public')->assertExists('profil/' . $user->profil);
    }

    public function test_user_can_delete_profile_photo(): void
    {
        Storage::fake('public');

        $user = $this->createWhisperlyUser([
            'profil' => 'test_old_photo.jpg',
        ]);
        Storage::disk('public')->put('profil/test_old_photo.jpg', 'fake content');

        $response = $this->actingAs($user, 'whisperly')
            ->deleteJson(route('whisperly.profile.photo.delete'));

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'initial' => 'C',
            ]);

        $user->refresh();
        $this->assertNull($user->profil);
        Storage::disk('public')->assertMissing('profil/test_old_photo.jpg');
    }
}
