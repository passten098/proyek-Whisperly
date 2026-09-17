<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\talents\Models\talents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WhisperlyProfileController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna Whisperly.
     */
    public function show(Request $request)
    {
        $currentUser = Auth::guard('whisperly')->user();

        if (!$currentUser) {
            return redirect()->route('login.baru');
        }

        $currentTalentProfile = null;

        if ($currentUser->role === 'talent') {
            $currentTalentProfile = talents::query()
                ->where('pengguna_id', $currentUser->id)
                ->first();
        }

        return view('whisperly.profile', compact(
            'currentUser',
            'currentTalentProfile'
        ));
    }


    /**
     * Tampilkan halaman profil admin Whisperly.
     */
    public function adminProfile()
    {
        $currentUser = Auth::guard('whisperly')->user();

        if (!$currentUser) {
            return redirect()->route('login.baru');
        }

        return view('admin.profile', [
            'currentUser' => $currentUser,
        ]);
    }


    /**
     * Perbarui profil admin Whisperly.
     *
     * Username dan email hanya ditampilkan,
     * yang dapat diubah adalah bio dan foto profil.
     */
    public function updateAdminProfile(Request $request)
    {
        $currentUser = Auth::guard('whisperly')->user();

        if (!$currentUser) {
            return redirect()->route('login.baru');
        }

        $validated = $request->validate([
            'bio' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:3072',
        ]);

        $currentUser->bio = $validated['bio'] ?? null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // Hapus foto lama jika ada
            if (
                !empty($currentUser->profil) &&
                !filter_var($currentUser->profil, FILTER_VALIDATE_URL)
            ) {
                $oldFilename = ltrim(
                    preg_replace('#^storage/#', '', $currentUser->profil),
                    '/'
                );

                if (Storage::disk('public')->exists('profil/' . $oldFilename)) {
                    Storage::disk('public')->delete('profil/' . $oldFilename);
                } elseif (Storage::disk('public')->exists($oldFilename)) {
                    Storage::disk('public')->delete($oldFilename);
                }
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('profil', $filename, 'public');

            $currentUser->profil = $filename;
        }

        $currentUser->save();

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Profil admin berhasil diperbarui.');
    }


    /**
     * Perbarui teks bio pengguna.
     */
    public function updateBio(Request $request)
    {
        $currentUser = Auth::guard('whisperly')->user();

        if (!$currentUser) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi login telah berakhir.'
                ], 401);
            }

            return redirect()->route('login.baru');
        }

        $validated = $request->validate([
            'bio' => 'nullable|string|max:500',
        ], [
            'bio.max' => 'Bio tidak boleh lebih dari 500 karakter.',
        ]);

        $currentUser->bio = !empty($validated['bio'])
            ? trim($validated['bio'])
            : null;

        $currentUser->save();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Bio berhasil diperbarui!',
                'bio' => $currentUser->bio,
            ]);
        }

        return redirect()
            ->route('whisperly.profile')
            ->with('success', 'Bio berhasil diperbarui!');
    }


    /**
     * Unggah / ganti foto profil pengguna.
     */
    public function updatePhoto(Request $request)
    {
        $currentUser = Auth::guard('whisperly')->user();

        if (!$currentUser) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi login telah berakhir.'
                ], 401);
            }

            return redirect()->route('login.baru');
        }

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:3072',
        ], [
            'photo.required' => 'Pilih foto terlebih dahulu.',
            'photo.image' => 'File yang diunggah harus berupa gambar.',
            'photo.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau gif.',
            'photo.max' => 'Ukuran gambar maksimal 3 MB.',
        ]);

        // Hapus foto lama jika ada di storage lokal
        if (
            !empty($currentUser->profil) &&
            !filter_var($currentUser->profil, FILTER_VALIDATE_URL)
        ) {
            $oldFilename = ltrim(
                preg_replace('#^storage/#', '', $currentUser->profil),
                '/'
            );

            if (Storage::disk('public')->exists('profil/' . $oldFilename)) {
                Storage::disk('public')->delete('profil/' . $oldFilename);
            } elseif (Storage::disk('public')->exists($oldFilename)) {
                Storage::disk('public')->delete($oldFilename);
            }
        }

        $file = $request->file('photo');

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('profil', $filename, 'public');

        $currentUser->profil = $filename;

        $currentUser->save();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui!',
                'avatar_url' => $currentUser->avatar_url,
            ]);
        }

        return redirect()
            ->route('whisperly.profile')
            ->with('success', 'Foto profil berhasil diperbarui!');
    }


    /**
     * Hapus foto profil pengguna (kembali ke avatar inisial).
     */
    public function deletePhoto(Request $request)
    {
        $currentUser = Auth::guard('whisperly')->user();

        if (!$currentUser) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi login telah berakhir.'
                ], 401);
            }

            return redirect()->route('login.baru');
        }

        if (
            !empty($currentUser->profil) &&
            !filter_var($currentUser->profil, FILTER_VALIDATE_URL)
        ) {
            $oldFilename = ltrim(
                preg_replace('#^storage/#', '', $currentUser->profil),
                '/'
            );

            if (Storage::disk('public')->exists('profil/' . $oldFilename)) {
                Storage::disk('public')->delete('profil/' . $oldFilename);
            } elseif (Storage::disk('public')->exists($oldFilename)) {
                Storage::disk('public')->delete($oldFilename);
            }
        }

        $currentUser->profil = null;

        $currentUser->save();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil dihapus.',
                'avatar_url' => null,
                'initial' => strtoupper(substr($currentUser->username, 0, 1)),
            ]);
        }

        return redirect()
            ->route('whisperly.profile')
            ->with('success', 'Foto profil berhasil dihapus.');
    }
}