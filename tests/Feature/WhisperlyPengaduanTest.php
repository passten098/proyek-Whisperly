<?php

namespace Tests\Feature;

use App\Modules\categories\Models\categories;
use App\Modules\menfess\Models\menfess;
use App\Modules\pengguna\Models\pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class WhisperlyPengaduanTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pengaduan_shows_only_approved_menfess_with_anonymous_identity(): void
    {
        $user = pengguna::create([
            'username' => 'user05',
            'email' => 'user05@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $category = categories::create([
            'jenis_kategori' => 'cinta',
        ]);

        menfess::create([
            'id_pengguna' => $user->id,
            'id_kategori' => $category->id,
            'isi_pesan' => 'Aku sedang sedih sekali.',
            'status' => 'approved',
        ]);

        menfess::create([
            'id_pengguna' => $user->id,
            'id_kategori' => $category->id,
            'isi_pesan' => 'Ini masih pending.',
            'status' => 'pending',
        ]);

        $this->actingAs($user, 'whisperly');

        $response = $this->get(route('pengaduan'));

        $response->assertOk();
        $response->assertSee('Anonim');
        $response->assertDontSee('Ini masih pending.');
        $response->assertDontSee('user05');
    }

    public function test_category_is_required_before_submitting_menfess(): void
    {
        $user = pengguna::create([
            'username' => 'user06',
            'email' => 'user06@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $this->actingAs($user, 'whisperly');

        $response = $this->post(route('pengaduan.store'), [
            'isi_pesan' => 'Aku butuh ruang curhat.',
        ]);

        $response->assertSessionHasErrors('id_kategori');
        $this->assertDatabaseMissing('menfess', ['isi_pesan' => 'Aku butuh ruang curhat.']);
    }

    public function test_valid_category_is_saved_when_user_creates_menfess(): void
    {
        $user = pengguna::create([
            'username' => 'user07',
            'email' => 'user07@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $category = categories::create([
            'jenis_kategori' => 'cinta',
        ]);

        $this->actingAs($user, 'whisperly');

        $response = $this->post(route('pengaduan.store'), [
            'id_kategori' => $category->id,
            'isi_pesan' => 'Aku baru saja melangkah menyukai seseorang.',
        ]);

        $response->assertRedirect(route('pengaduan'));
        $this->assertDatabaseHas('menfess', [
            'id_pengguna' => $user->id,
            'id_kategori' => $category->id,
            'status' => 'pending',
        ]);
    }

    public function test_legacy_capitalized_admin_role_is_still_treated_as_admin(): void
    {
        $admin = pengguna::create([
            'username' => 'nabila123',
            'email' => 'nabila123@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
        ]);

        $user = pengguna::create([
            'username' => 'user09',
            'email' => 'user09@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $category = categories::create([
            'jenis_kategori' => 'campuran',
        ]);

        $menfess = menfess::create([
            'id_pengguna' => $user->id,
            'id_kategori' => $category->id,
            'isi_pesan' => 'Saya butuh review moderator.',
            'status' => 'pending',
        ]);

        $this->actingAs($admin, 'whisperly');

        $response = $this->get(route('admin.menfess.index'));
        $response->assertOk();
        $response->assertSee('Saya butuh review moderator.');
        $response->assertSee('Setujui');
        $response->assertSee('Tolak');

        $approval = $this->post(route('pengaduan.approve', $menfess));
        $approval->assertRedirect();
        $this->assertDatabaseHas('menfess', [
            'id' => $menfess->id,
            'status' => 'approved',
        ]);
    }

    public function test_admin_can_view_pending_menfess_and_approve_them(): void
    {
        $admin = pengguna::create([
            'username' => 'admin01',
            'email' => 'admin01@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $user = pengguna::create([
            'username' => 'user08',
            'email' => 'user08@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $category = categories::create([
            'jenis_kategori' => 'sedih',
        ]);

        $menfess = menfess::create([
            'id_pengguna' => $user->id,
            'id_kategori' => $category->id,
            'isi_pesan' => 'Saya sedang menangis sendirian.',
            'status' => 'pending',
        ]);

        $this->actingAs($admin, 'whisperly');

        $response = $this->get(route('admin.menfess.index'));
        $response->assertOk();
        $response->assertSee('Saya sedang menangis sendirian.');
        $response->assertSee($user->username);
        $response->assertSee('Setujui');
        $response->assertSee('Tolak');

        $approval = $this->post(route('pengaduan.approve', $menfess));
        $approval->assertRedirect();
        $this->assertDatabaseHas('menfess', [
            'id' => $menfess->id,
            'status' => 'approved',
        ]);

        $this->actingAs($user, 'whisperly');
        $publicPage = $this->get(route('pengaduan'));
        $publicPage->assertOk();
        $publicPage->assertSee('Anonim');
        $publicPage->assertDontSee($user->username);
        $publicPage->assertSee('Saya sedang menangis sendirian.');
    }
}
