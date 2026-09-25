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
     * Tampilkan halaman profil Talent.
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

        return view('whisperly.profile', [
            'currentUser' => $currentUser,
            'currentTalentProfile' => $currentTalentProfile,
        ]);
    }


    /**
     * Tampilkan halaman profil Admin.
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
     * Perbarui profil Admin.
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

        $currentUser->bio = !empty($validated['bio'])
            ? trim($validated['bio'])
            : null;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            /*
             * Hapus foto Admin lama
             */
            if (
                !empty($currentUser->profil) &&
                !filter_var($currentUser->profil, FILTER_VALIDATE_URL)
            ) {
                $oldFilename = ltrim(
                    preg_replace(
                        '#^storage/#',
                        '',
                        $currentUser->profil
                    ),
                    '/'
                );

                if (
                    Storage::disk('public')->exists(
                        'profil/' . $oldFilename
                    )
                ) {
                    Storage::disk('public')->delete(
                        'profil/' . $oldFilename
                    );
                } elseif (
                    Storage::disk('public')->exists(
                        $oldFilename
                    )
                ) {
                    Storage::disk('public')->delete(
                        $oldFilename
                    );
                }
            }

            $filename =
                time() .
                '_' .
                uniqid() .
                '.' .
                $file->getClientOriginalExtension();

            $file->storeAs(
                'profil',
                $filename,
                'public'
            );

            $currentUser->profil = $filename;
        }

        $currentUser->save();

        return redirect()
            ->route('admin.profile')
            ->with(
                'success',
                'Profil admin berhasil diperbarui.'
            );
    }


    /**
     * Perbarui deskripsi profil.
     *
     * Admin  -> pengguna.bio
     * Talent -> talents.deskripsi
     */
    public function updateBio(Request $request)
    {
        $currentUser = Auth::guard('whisperly')->user();

        if (!$currentUser) {

            if (
                $request->expectsJson() ||
                $request->ajax()
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi login telah berakhir.',
                ], 401);
            }

            return redirect()->route('login.baru');
        }

        $validated = $request->validate(
            [
                'bio' => 'nullable|string|max:500',
            ],
            [
                'bio.max' =>
                    'Deskripsi tidak boleh lebih dari 500 karakter.',
            ]
        );

        $bio = !empty($validated['bio'])
            ? trim($validated['bio'])
            : null;


        /*
         * =========================================================
         * TALENT
         * =========================================================
         */

        if ($currentUser->role === 'talent') {

            $talent = talents::query()
                ->where(
                    'pengguna_id',
                    $currentUser->id
                )
                ->first();

            if (!$talent) {

                if (
                    $request->expectsJson() ||
                    $request->ajax()
                ) {
                    return response()->json([
                        'success' => false,
                        'message' =>
                            'Data Talent tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('whisperly.profile')
                    ->with(
                        'error',
                        'Data Talent tidak ditemukan.'
                    );
            }

            $talent->deskripsi = $bio;
            $talent->updated_by = $currentUser->id;
            $talent->save();

        }


        /*
         * =========================================================
         * ADMIN / USER
         * =========================================================
         */

        else {

            $currentUser->bio = $bio;
            $currentUser->save();
        }


        if (
            $request->expectsJson() ||
            $request->ajax()
        ) {
            return response()->json([
                'success' => true,
                'message' =>
                    $currentUser->role === 'talent'
                        ? 'Deskripsi Talent berhasil diperbarui!'
                        : 'Bio berhasil diperbarui!',
                'bio' => $bio,
            ]);
        }


        return redirect()
            ->route(
                $currentUser->role === 'talent'
                    ? 'whisperly.profile'
                    : 'admin.profile'
            )
            ->with(
                'success',
                $currentUser->role === 'talent'
                    ? 'Deskripsi Talent berhasil diperbarui!'
                    : 'Bio berhasil diperbarui!'
            );
    }


    /**
     * Upload / ganti foto profil.
     *
     * Talent -> talents.photo
     * Admin/User -> pengguna.profil
     */
    public function updatePhoto(Request $request)
    {
        $currentUser = Auth::guard('whisperly')->user();

        if (!$currentUser) {

            if (
                $request->expectsJson() ||
                $request->ajax()
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi login telah berakhir.',
                ], 401);
            }

            return redirect()->route('login.baru');
        }

        $request->validate(
            [
                'photo' =>
                    'required|image|mimes:jpeg,png,jpg,webp,gif|max:3072',
            ],
            [
                'photo.required' =>
                    'Pilih foto terlebih dahulu.',
                'photo.image' =>
                    'File yang diunggah harus berupa gambar.',
                'photo.mimes' =>
                    'Format gambar harus jpeg, png, jpg, webp, atau gif.',
                'photo.max' =>
                    'Ukuran gambar maksimal 3 MB.',
            ]
        );

        $file = $request->file('photo');

        $filename =
            time() .
            '_' .
            uniqid() .
            '.' .
            $file->getClientOriginalExtension();


        /*
         * =========================================================
         * TALENT
         * =========================================================
         */

        if ($currentUser->role === 'talent') {

            $talent = talents::query()
                ->where(
                    'pengguna_id',
                    $currentUser->id
                )
                ->first();

            if (!$talent) {

                if (
                    $request->expectsJson() ||
                    $request->ajax()
                ) {
                    return response()->json([
                        'success' => false,
                        'message' =>
                            'Data Talent tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('whisperly.profile')
                    ->with(
                        'error',
                        'Data Talent tidak ditemukan.'
                    );
            }


            /*
             * Hapus foto Talent lama
             */

            if (!empty($talent->photo)) {

                $oldPhoto = ltrim(
                    preg_replace(
                        '#^storage/#',
                        '',
                        $talent->photo
                    ),
                    '/'
                );

                if (
                    Storage::disk('public')->exists(
                        $oldPhoto
                    )
                ) {
                    Storage::disk('public')->delete(
                        $oldPhoto
                    );
                }
            }


            /*
             * Simpan foto Talent
             */

            $file->storeAs(
                'talent-profiles',
                $filename,
                'public'
            );

            $talent->photo =
                'talent-profiles/' . $filename;

            $talent->updated_by =
                $currentUser->id;

            $talent->save();
        }


        /*
         * =========================================================
         * ADMIN / USER
         * =========================================================
         */

        else {

            /*
             * Hapus foto lama
             */

            if (
                !empty($currentUser->profil) &&
                !filter_var(
                    $currentUser->profil,
                    FILTER_VALIDATE_URL
                )
            ) {

                $oldFilename = ltrim(
                    preg_replace(
                        '#^storage/#',
                        '',
                        $currentUser->profil
                    ),
                    '/'
                );

                if (
                    Storage::disk('public')->exists(
                        'profil/' . $oldFilename
                    )
                ) {
                    Storage::disk('public')->delete(
                        'profil/' . $oldFilename
                    );
                } elseif (
                    Storage::disk('public')->exists(
                        $oldFilename
                    )
                ) {
                    Storage::disk('public')->delete(
                        $oldFilename
                    );
                }
            }


            /*
             * Simpan foto Admin/User
             */

            $file->storeAs(
                'profil',
                $filename,
                'public'
            );

            $currentUser->profil =
                $filename;

            $currentUser->save();
        }


        if (
            $request->expectsJson() ||
            $request->ajax()
        ) {

            return response()->json([
                'success' => true,
                'message' =>
                    'Foto profil berhasil diperbarui!',
                'avatar_url' =>
                    $currentUser->fresh()->avatar_url,
            ]);
        }


        return redirect()
            ->route(
                $currentUser->role === 'talent'
                    ? 'whisperly.profile'
                    : 'admin.profile'
            )
            ->with(
                'success',
                'Foto profil berhasil diperbarui!'
            );
    }


    /**
     * Hapus foto profil.
     *
     * Talent -> talents.photo
     * Admin/User -> pengguna.profil
     */
    public function deletePhoto(Request $request)
    {
        $currentUser = Auth::guard('whisperly')->user();

        if (!$currentUser) {

            if (
                $request->expectsJson() ||
                $request->ajax()
            ) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'Sesi login telah berakhir.',
                ], 401);
            }

            return redirect()->route('login.baru');
        }


        /*
         * =========================================================
         * TALENT
         * =========================================================
         */

        if ($currentUser->role === 'talent') {

            $talent = talents::query()
                ->where(
                    'pengguna_id',
                    $currentUser->id
                )
                ->first();

            if (!$talent) {

                if (
                    $request->expectsJson() ||
                    $request->ajax()
                ) {
                    return response()->json([
                        'success' => false,
                        'message' =>
                            'Data Talent tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('whisperly.profile')
                    ->with(
                        'error',
                        'Data Talent tidak ditemukan.'
                    );
            }


            if (!empty($talent->photo)) {

                $oldPhoto = ltrim(
                    preg_replace(
                        '#^storage/#',
                        '',
                        $talent->photo
                    ),
                    '/'
                );

                if (
                    Storage::disk('public')->exists(
                        $oldPhoto
                    )
                ) {
                    Storage::disk('public')->delete(
                        $oldPhoto
                    );
                }
            }


            $talent->photo = null;
            $talent->updated_by =
                $currentUser->id;

            $talent->save();
        }


        /*
         * =========================================================
         * ADMIN / USER
         * =========================================================
         */

        else {

            if (
                !empty($currentUser->profil) &&
                !filter_var(
                    $currentUser->profil,
                    FILTER_VALIDATE_URL
                )
            ) {

                $oldFilename = ltrim(
                    preg_replace(
                        '#^storage/#',
                        '',
                        $currentUser->profil
                    ),
                    '/'
                );

                if (
                    Storage::disk('public')->exists(
                        'profil/' . $oldFilename
                    )
                ) {
                    Storage::disk('public')->delete(
                        'profil/' . $oldFilename
                    );
                } elseif (
                    Storage::disk('public')->exists(
                        $oldFilename
                    )
                ) {
                    Storage::disk('public')->delete(
                        $oldFilename
                    );
                }
            }

            $currentUser->profil = null;
            $currentUser->save();
        }


        if (
            $request->expectsJson() ||
            $request->ajax()
        ) {
            return response()->json([
                'success' => true,
                'message' =>
                    'Foto profil berhasil dihapus.',
                'avatar_url' => null,
                'initial' =>
                    strtoupper(
                        substr(
                            $currentUser->username,
                            0,
                            1
                        )
                    ),
            ]);
        }


        return redirect()
            ->route(
                $currentUser->role === 'talent'
                    ? 'whisperly.profile'
                    : 'admin.profile'
            )
            ->with(
                'success',
                'Foto profil berhasil dihapus.'
            );
    }
}