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

    public function index(Request $request)
    {
        $query = comments::with(['menfess', 'pengguna']);

        if ($request->has('search')) {
            $search = $request->get('search');
        }

        $data['data'] = $query->paginate(10)->withQueryString();

        $this->log(
            $request,
            'melihat halaman manajemen data ' . $this->title
        );

        return view(
            'comments::comments',
            array_merge($data, ['title' => $this->title])
        );
    }

    public function create(Request $request)
    {
        $data['forms'] = [
            'id_menfess' => [
                'label' => 'Menfess',
                'type' => 'number',
                'value' => old("id_menfess"),
                'required' => true
            ],

            'id_pengguna' => [
                'label' => 'Pengguna',
                'type' => 'number',
                'value' => old("id_pengguna"),
                'required' => true
            ],

            'komentar' => [
                'label' => 'Komentar',
                'type' => 'textarea',
                'value' => old("komentar"),
                'required' => true
            ],

            'status' => [
                'label' => 'Status',
                'type' => 'text',
                'value' => old("status"),
                'required' => true
            ],
        ];

        $this->log($request, 'membuka form tambah ' . $this->title);

        return view(
            'comments::comments_create',
            array_merge($data, ['title' => $this->title])
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_menfess' => 'required',
            'id_pengguna' => 'required',
            'komentar' => 'required',
            'status' => 'required',
        ]);

        $comments = new comments();

        $comments->id_menfess = $request->input("id_menfess");
        $comments->id_pengguna = $request->input("id_pengguna");
        $comments->komentar = $request->input("komentar");
        $comments->status = $request->input("status");

        $comments->created_by = Auth::id();
        $comments->save();

        $text = 'membuat ' . $this->title;

        $this->log(
            $request,
            $text,
            ['comments.id' => $comments->id]
        );

        return redirect()
            ->route('comments.index')
            ->with(
                'message_success',
                'Comments berhasil ditambahkan!'
            );
    }

    public function show(Request $request, comments $comments)
    {
        $data['comments'] = $comments;

        $text = 'melihat detail ' . $this->title;

        $this->log(
            $request,
            $text,
            ['comments.id' => $comments->id]
        );

        return view(
            'comments::comments_detail',
            array_merge($data, ['title' => $this->title])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT COMMENT
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request, comments $comments)
    {
        $user = Auth::guard('whisperly')->user();

        if (!$user) {
            abort(403);
        }

        /*
        | Admin boleh edit semua komentar.
        | Pengguna biasa hanya boleh edit komentar miliknya sendiri.
        */

        if (
            $user->role !== 'admin' &&
            $comments->id_pengguna != $user->id
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
                'id' => 'id_menfess'
            ],

            'id_pengguna' => [
                'label' => 'Pengguna',
                'type' => 'number',
                'value' => $comments->id_pengguna,
                'required' => true,
                'id' => 'id_pengguna'
            ],

            'komentar' => [
                'label' => 'Komentar',
                'type' => 'textarea',
                'value' => $comments->komentar,
                'required' => true,
                'id' => 'komentar'
            ],

            'status' => [
                'label' => 'Status',
                'type' => 'text',
                'value' => $comments->status,
                'required' => true,
                'id' => 'status'
            ],
        ];

        $text = 'membuka form edit ' . $this->title;

        $this->log(
            $request,
            $text,
            ['comments.id' => $comments->id]
        );

        return view(
            'comments::comments_update',
            array_merge($data, ['title' => $this->title])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE COMMENT
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
        | Admin boleh mengubah semua komentar.
        | Pengguna biasa hanya boleh mengubah komentar miliknya sendiri.
        */

        if (
            $user->role !== 'admin' &&
            $comments->id_pengguna != $user->id
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
        | Pengguna biasa tidak boleh mengganti pemilik komentar.
        */

        if ($user->role !== 'admin') {
            $comments->id_pengguna = $user->id;
        } else {
            $comments->id_pengguna = $request->input("id_pengguna");
        }

        $comments->id_menfess = $request->input("id_menfess");
        $comments->komentar = $request->input("komentar");
        $comments->status = $request->input("status");

        $comments->updated_by = $user->id;
        $comments->save();

        $text = 'mengedit ' . $this->title;

        $this->log(
            $request,
            $text,
            ['comments.id' => $comments->id]
        );

        return back()->with(
            'message_success',
            'Komentar berhasil diubah!'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE COMMENT
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request, $id)
    {
        $user = Auth::guard('whisperly')->user();

        if (!$user) {
            abort(403);
        }

        $comments = comments::findOrFail($id);

        /*
        | ADMIN
        | Admin boleh menghapus komentar siapa saja.
        */

        if ($user->role === 'admin') {

            $comments->deleted_by = $user->id;
            $comments->save();

            $comments->delete();

            $this->log(
                $request,
                'menghapus ' . $this->title . ' sebagai admin',
                ['comments.id' => $comments->id]
            );

            return back()->with(
                'message_success',
                'Komentar berhasil dihapus!'
            );
        }

        /*
        | USER BIASA
        | Hanya boleh menghapus komentar miliknya sendiri.
        */

        if ($comments->id_pengguna != $user->id) {
            abort(403);
        }

        $comments->deleted_by = $user->id;
        $comments->save();

        $comments->delete();

        $this->log(
            $request,
            'menghapus ' . $this->title,
            ['comments.id' => $comments->id]
        );

        return back()->with(
            'message_success',
            'Komentar berhasil dihapus!'
        );
    }
}