<?php

namespace App\Modules\comments\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\comments\Models\comments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class commentsController extends Controller
{
    use Logger;

    protected $log;
    protected $title = "Comments";

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = comments::with([
            'menfess',
            'pengguna',
        ]);

        if ($request->has('search')) {
            $search = $request->get('search');
        }

        $data['data'] = $query
            ->paginate(10)
            ->withQueryString();

        $this->log(
            $request,
            'melihat halaman manajemen data ' . $this->title
        );

        return view(
            'comments::comments',
            array_merge($data, [
                'title' => $this->title,
            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(Request $request)
    {
        $data['forms'] = [

            'id_menfess' => [
                'label' => 'Menfess',
                'type' => 'number',
                'value' => old('id_menfess'),
                'required' => true,
            ],

            'id_pengguna' => [
                'label' => 'Pengguna',
                'type' => 'number',
                'value' => old('id_pengguna'),
                'required' => true,
            ],

            'komentar' => [
                'label' => 'Komentar',
                'type' => 'textarea',
                'value' => old('komentar'),
                'required' => true,
            ],

            'status' => [
                'label' => 'Status',
                'type' => 'text',
                'value' => old('status'),
                'required' => true,
            ],
        ];

        $this->log(
            $request,
            'membuka form tambah ' . $this->title
        );

        return view(
            'comments::comments_create',
            array_merge($data, [
                'title' => $this->title,
            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_menfess' => 'required',
            'id_pengguna' => 'required',
            'komentar' => 'required',
            'status' => 'required',
        ]);

        $comments = new comments();

        $comments->id_menfess = $request->input('id_menfess');
        $comments->id_pengguna = $request->input('id_pengguna');
        $comments->komentar = $request->input('komentar');
        $comments->status = $request->input('status');

        $comments->created_by = Auth::id();

        $comments->save();

        $this->log(
            $request,
            'membuat ' . $this->title,
            [
                'comments.id' => $comments->id,
            ]
        );

        return redirect()
            ->route('comments.index')
            ->with(
                'message_success',
                'Comments berhasil ditambahkan!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Request $request, comments $comments)
    {
        $comments->load([
            'menfess',
            'pengguna',
        ]);

        $data['comments'] = $comments;

        $this->log(
            $request,
            'melihat detail ' . $this->title,
            [
                'comments.id' => $comments->id,
            ]
        );

        return view(
            'comments::comments_detail',
            array_merge($data, [
                'title' => $this->title,
            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request, comments $comments)
    {
        $user = Auth::guard('whisperly')->user();

        if (!$user) {
            abort(403);
        }

        /*
        | Ambil role aktif dari session.
        | Jika tidak ada, gunakan role dari user.
        */

        $activeRole = strtolower(
            trim(
                (string) (
                    session('active_role')['role']
                    ?? $user->role
                    ?? ''
                )
            )
        );

        /*
        | Admin boleh edit semua komentar.
        | Selain admin hanya boleh edit komentar sendiri.
        */

        if (
            $activeRole !== 'admin' &&
            (string) $comments->id_pengguna !== (string) $user->id
        ) {
            abort(403);
        }

        $data['comments'] = $comments;

        $data['forms'] = [

            'id_menfess' => [
                'label' => 'Menfess',
                'type' => 'number',
                'value' => $comments->id_menfess,
                'required' => true,
                'id' => 'id_menfess',
            ],

            'id_pengguna' => [
                'label' => 'Pengguna',
                'type' => 'number',
                'value' => $comments->id_pengguna,
                'required' => true,
                'id' => 'id_pengguna',
            ],

            'komentar' => [
                'label' => 'Komentar',
                'type' => 'textarea',
                'value' => $comments->komentar,
                'required' => true,
                'id' => 'komentar',
            ],

            'status' => [
                'label' => 'Status',
                'type' => 'text',
                'value' => $comments->status,
                'required' => true,
                'id' => 'status',
            ],
        ];

        $this->log(
            $request,
            'membuka form edit ' . $this->title,
            [
                'comments.id' => $comments->id,
            ]
        );

        return view(
            'comments::comments_update',
            array_merge($data, [
                'title' => $this->title,
            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $user = Auth::guard('whisperly')->user();

        if (!$user) {
            abort(403);
        }

        $comments = comments::findOrFail($id);

        /*
        | Ambil role aktif dari session.
        */

        $activeRole = strtolower(
            trim(
                (string) (
                    session('active_role')['role']
                    ?? $user->role
                    ?? ''
                )
            )
        );

        /*
        | Admin boleh mengubah semua komentar.
        | Selain admin hanya boleh mengubah komentar sendiri.
        */

        if (
            $activeRole !== 'admin' &&
            (string) $comments->id_pengguna !== (string) $user->id
        ) {
            abort(403);
        }

        $this->validate($request, [
            'id_menfess' => 'required',
            'id_pengguna' => 'required',
            'komentar' => 'required',
            'status' => 'required',
        ]);

        /*
        | User biasa tidak boleh mengganti pemilik komentar.
        */

        if ($activeRole !== 'admin') {
            $comments->id_pengguna = $user->id;
        } else {
            $comments->id_pengguna = $request->input('id_pengguna');
        }

        $comments->id_menfess = $request->input('id_menfess');
        $comments->komentar = $request->input('komentar');
        $comments->status = $request->input('status');

        $comments->updated_by = $user->id;

        $comments->save();

        $this->log(
            $request,
            'mengedit ' . $this->title,
            [
                'comments.id' => $comments->id,
            ]
        );

        return back()->with(
            'message_success',
            'Komentar berhasil diubah!'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request, $id)
    {
        /*
        | Ambil user dari guard Whisperly.
        */

        $user = Auth::guard('whisperly')->user();

        if (!$user) {
            abort(403);
        }

        /*
        | Ambil komentar.
        */

        $comments = comments::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | ROLE AKTIF
        |--------------------------------------------------------------------------
        |
        | Prioritaskan role aktif di session Laralag.
        | Jika tidak tersedia, gunakan role user.
        |
        */

        $activeRole = strtolower(
            trim(
                (string) (
                    session('active_role')['role']
                    ?? $user->role
                    ?? ''
                )
            )
        );

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        |
        | Admin boleh menghapus komentar siapa pun.
        |
        */

        if ($activeRole === 'admin') {

            $comments->deleted_by = $user->id;

            $comments->save();

            $comments->delete();

            $this->log(
                $request,
                'menghapus ' . $this->title . ' sebagai admin',
                [
                    'comments.id' => $comments->id,
                ]
            );

            return redirect()
                ->route('comments.index')
                ->with(
                    'message_success',
                    'Komentar berhasil dihapus!'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | USER / TALENT
        |--------------------------------------------------------------------------
        |
        | Selain admin hanya boleh menghapus komentar miliknya sendiri.
        |
        */

        if (
            (string) $comments->id_pengguna !==
            (string) $user->id
        ) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS KOMENTAR MILIK SENDIRI
        |--------------------------------------------------------------------------
        */

        $comments->deleted_by = $user->id;

        $comments->save();

        $comments->delete();

        $this->log(
            $request,
            'menghapus ' . $this->title,
            [
                'comments.id' => $comments->id,
            ]
        );

        return redirect()
            ->route('comments.index')
            ->with(
                'message_success',
                'Komentar berhasil dihapus!'
            );
    }
}