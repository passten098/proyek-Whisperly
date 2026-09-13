<?php

namespace App\Modules\menfess\Controllers;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Modules\categories\Models\categories;
use App\Modules\comments\Models\comments;
use App\Modules\Log\Models\Log;
use App\Modules\menfess\Models\menfess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class menfessController extends Controller
{
    use Logger;

    protected $log;
    protected $title = "Menfess";

    public function __construct(Log $log)
    {
        $this->log = $log;
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX ADMIN / MANAGEMENT
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $query = menfess::query()
            ->with([
                'pengguna',
                'kategori',
                'comments.pengguna'
            ]);

        if ($request->has('search')) {
            $search = trim((string) $request->get('search'));

            if ($search !== '') {
                $query->where(
                    'isi_pesan',
                    'like',
                    "%{$search}%"
                );
            }
        }

        $data['data'] = $query
            ->paginate(10)
            ->withQueryString();

        $this->log(
            $request,
            'melihat halaman manajemen data ' . $this->title
        );

        return view(
            'menfess::menfess',
            array_merge(
                $data,
                [
                    'title' => $this->title
                ]
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PUBLIC MENFESS
    |--------------------------------------------------------------------------
    */

    public function publicIndex(Request $request): View
    {
        $categories = categories::query()
            ->orderBy('jenis_kategori')
            ->get();

        $selectedCategory = strtolower(
            trim(
                (string) $request->query(
                    'kategori',
                    'random'
                )
            )
        );

        $selectedCategory = match ($selectedCategory) {
            'random',
            'campuran' => 'random',

            'love',
            'cinta' => 'love',

            'horror',
            'horor' => 'horror',

            'sad',
            'sedih' => 'sad',

            default => 'random',
        };


        $query = menfess::query()
            ->with([
                'pengguna',
                'kategori',
                'comments.pengguna'
            ])
            ->where(
                'status',
                'approved'
            );


        $categoryName = match ($selectedCategory) {
            'random' => 'campuran',
            'love' => 'cinta',
            'horror' => 'horror',
            'sad' => 'sedih',

            default => 'campuran',
        };


        $category = categories::query()
            ->whereRaw(
                'LOWER(TRIM(jenis_kategori)) = ?',
                [
                    strtolower($categoryName)
                ]
            )
            ->first();


        if ($category) {
            $query->where(
                'id_kategori',
                $category->id
            );
        } else {
            $query->whereRaw('1 = 0');
        }


        $items = $query
            ->orderByDesc('created_at')
            ->get();


        return view(
            'whisperly.pengaduan',
            [
                'title' => 'Ruang Pengaduan',

                'items' => $items,

                'categories' => $categories,

                'selectedCategory' => $selectedCategory,

                'activeCategory' => $category,

                'categoryColors' => [

                    'random' =>
                        'linear-gradient(135deg, rgba(79, 120, 212, 0.28), rgba(48, 72, 124, 0.2))',

                    'cinta' =>
                        'linear-gradient(135deg, rgba(186, 31, 54, 0.2), rgba(80, 18, 30, 0.16))',

                    'love' =>
                        'linear-gradient(135deg, rgba(186, 31, 54, 0.2), rgba(80, 18, 30, 0.16))',

                    'horor' =>
                        'linear-gradient(135deg, rgba(20, 71, 52, 0.35), rgba(9, 28, 22, 0.2))',

                    'horror' =>
                        'linear-gradient(135deg, rgba(20, 71, 52, 0.35), rgba(9, 28, 22, 0.2))',

                    'sedih' =>
                        'linear-gradient(135deg, rgba(205, 132, 52, 0.28), rgba(132, 90, 32, 0.24))',

                    'sad' =>
                        'linear-gradient(135deg, rgba(205, 132, 52, 0.28), rgba(132, 90, 32, 0.24))',
                ],
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN MODERATION
    |--------------------------------------------------------------------------
    */

    public function adminIndex(Request $request): View
    {
        abort_unless(
            strtolower(
                (string) (
                    $request
                        ->user('whisperly')
                        ?->role
                    ?? ''
                )
            ) === 'admin',
            403,
            'Hanya admin yang dapat mengakses moderasi menfess.'
        );


        $pendingItems = menfess::with([
            'pengguna',
            'kategori',
            'comments.pengguna'
        ])
            ->where(
                'status',
                'pending'
            )
            ->orderByDesc('created_at')
            ->get();


        $approvedItems = menfess::with([
            'pengguna',
            'kategori',
            'comments.pengguna'
        ])
            ->where(
                'status',
                'approved'
            )
            ->orderByDesc('created_at')
            ->get();


        $this->log(
            $request,
            'melihat halaman admin menfess',
            [
                'pending_count' =>
                    $pendingItems->count(),

                'approved_count' =>
                    $approvedItems->count(),
            ]
        );


        return view(
            'menfess::menfess_admin',
            [
                'title' => 'Moderasi Menfess',

                'pendingItems' =>
                    $pendingItems,

                'approvedItems' =>
                    $approvedItems,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(Request $request): View
    {
        $data['forms'] = [
            'id_kategori' => [
                'label' => 'Kategori',
                'type' => 'select',
                'value' => old('id_kategori'),
                'required' => true
            ],

            'isi_pesan' => [
                'label' => 'Isi Pesan',
                'type' => 'textarea',
                'value' => old('isi_pesan'),
                'required' => true
            ],
        ];


        $data['categories'] = categories::query()
            ->orderBy('jenis_kategori')
            ->get();


        $this->log(
            $request,
            'membuka form tambah ' . $this->title
        );


        return view(
            'menfess::menfess_create',
            array_merge(
                $data,
                [
                    'title' => $this->title
                ]
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE MENFESS
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_kategori' => 'required|string',

            'isi_pesan' =>
                'required|string|min:1|max:2000',
        ]);


        $categoryInput = strtolower(
            trim(
                (string) $request->input('id_kategori')
            )
        );


        $category = categories::query()
            ->where(
                'id',
                $request->input('id_kategori')
            )
            ->orWhereRaw(
                'LOWER(TRIM(jenis_kategori)) = ?',
                [
                    $categoryInput
                ]
            )
            ->first();


        if (!$category) {

            $categoryName = match ($categoryInput) {

                'random' =>
                    'campuran',

                'love' =>
                    'cinta',

                'horror',
                'horor' =>
                    'horror',

                'sad' =>
                    'sedih',

                default =>
                    null,
            };


            if ($categoryName) {

                $category = categories::query()
                    ->whereRaw(
                        'LOWER(TRIM(jenis_kategori)) = ?',
                        [
                            $categoryName
                        ]
                    )
                    ->first();
            }
        }


        if (!$category) {

            return back()
                ->withErrors([
                    'id_kategori' =>
                        'Kategori tidak valid.'
                ])
                ->withInput();
        }


        $user = Auth::guard('whisperly')->user();


        if (!$user) {
            return back()
                ->with(
                    'message_error',
                    'Silakan login terlebih dahulu.'
                );
        }


        $menfess = menfess::create([
            'id_pengguna' =>
                $user->id,

            'id_kategori' =>
                $category->id,

            'isi_pesan' =>
                trim(
                    (string) $request->input(
                        'isi_pesan'
                    )
                ),

            'status' =>
                'pending',
        ]);


        $this->log(
            $request,
            'membuat ' . $this->title,
            [
                'menfess.id' =>
                    $menfess->id
            ]
        );


        return redirect()
            ->route('pengaduan')
            ->with(
                'message_success',
                'Menfess berhasil dikirim. Tunggu persetujuan admin.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        menfess $menfess
    ) {
        $data['menfess'] = $menfess;


        $this->log(
            $request,
            'melihat detail ' . $this->title,
            [
                'menfess.id' =>
                    $menfess->id
            ]
        );


        return view(
            'menfess::menfess_detail',
            array_merge(
                $data,
                [
                    'title' =>
                        $this->title
                ]
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE
    |--------------------------------------------------------------------------
    */

    public function approve(
        Request $request,
        menfess $menfess
    ): RedirectResponse {

        abort_unless(
            strtolower(
                (string) (
                    $request
                        ->user('whisperly')
                        ?->role
                    ?? ''
                )
            ) === 'admin',
            403,
            'Hanya admin yang dapat menyetujui menfess.'
        );


        $menfess->update([
            'status' => 'approved'
        ]);


        $this->log(
            $request,
            'menyetujui ' . $this->title,
            [
                'menfess.id' =>
                    $menfess->id
            ]
        );


        return redirect()
            ->route('admin.menfess.index')
            ->with(
                'message_success',
                'Menfess berhasil disetujui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | REJECT
    |--------------------------------------------------------------------------
    */

    public function reject(
        Request $request,
        menfess $menfess
    ): RedirectResponse {

        abort_unless(
            strtolower(
                (string) (
                    $request
                        ->user('whisperly')
                        ?->role
                    ?? ''
                )
            ) === 'admin',
            403,
            'Hanya admin yang dapat menolak menfess.'
        );


        $menfess->update([
            'status' => 'rejected'
        ]);


        $this->log(
            $request,
            'menolak ' . $this->title,
            [
                'menfess.id' =>
                    $menfess->id
            ]
        );


        return redirect()
            ->route('menfess.admin')
            ->with(
                'message_success',
                'Menfess berhasil ditolak.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        menfess $menfess
    ) {
        $data['menfess'] =
            $menfess;


        $data['forms'] = [

            'id_pengguna' => [
                'label' => 'Pengguna',
                'type' => 'number',
                'value' =>
                    $menfess->id_pengguna,
                'required' => true,
                'id' => 'id_pengguna'
            ],

            'id_kategori' => [
                'label' => 'Kategori',
                'type' => 'number',
                'value' =>
                    $menfess->id_kategori,
                'required' => true,
                'id' => 'id_kategori'
            ],

            'isi_pesan' => [
                'label' => 'Isi Pesan',
                'type' => 'textarea',
                'value' =>
                    $menfess->isi_pesan,
                'required' => true,
                'id' => 'isi_pesan'
            ],

            'status' => [
                'label' => 'Status',
                'type' => 'text',
                'value' =>
                    $menfess->status,
                'required' => true,
                'id' => 'status'
            ],
        ];


        $this->log(
            $request,
            'membuka form edit ' . $this->title,
            [
                'menfess.id' =>
                    $menfess->id
            ]
        );


        return view(
            'menfess::menfess_update',
            array_merge(
                $data,
                [
                    'title' =>
                        $this->title
                ]
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ) {
        $this->validate(
            $request,
            [
                'id_pengguna' =>
                    'required',

                'id_kategori' =>
                    'required',

                'isi_pesan' =>
                    'required',

                'status' =>
                    'required',
            ]
        );


        $menfess =
            menfess::find($id);


        if (!$menfess) {

            return back()
                ->with(
                    'message_error',
                    'Menfess tidak ditemukan.'
                );
        }


        $menfess->id_pengguna =
            $request->input(
                'id_pengguna'
            );

        $menfess->id_kategori =
            $request->input(
                'id_kategori'
            );

        $menfess->isi_pesan =
            $request->input(
                'isi_pesan'
            );

        $menfess->status =
            $request->input(
                'status'
            );

        $menfess->updated_by =
            Auth::guard('whisperly')->id()
            ?? Auth::id();


        $menfess->save();


        $this->log(
            $request,
            'mengedit ' . $this->title,
            [
                'menfess.id' =>
                    $menfess->id
            ]
        );


        return redirect()
            ->route('menfess.index')
            ->with(
                'message_success',
                'Menfess berhasil diubah!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        $id
    ) {
        abort_unless(
            strtolower(
                (string) (
                    $request
                        ->user('whisperly')
                        ?->role
                    ?? ''
                )
            ) === 'admin',
            403,
            'Hanya admin yang dapat menghapus menfess.'
        );


        $menfess =
            menfess::find($id);


        if (!$menfess) {

            return back()
                ->with(
                    'message_error',
                    'Menfess tidak ditemukan.'
                );
        }


        $menfess->deleted_by =
            Auth::guard('whisperly')->id()
            ?? Auth::id();

        $menfess->save();

        $menfess->delete();


        $this->log(
            $request,
            'menghapus ' . $this->title,
            [
                'menfess.id' =>
                    $menfess->id
            ]
        );


        return back()
            ->with(
                'message_success',
                'Menfess berhasil dihapus!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADD COMMENT / REPLY
    |--------------------------------------------------------------------------
    |
    | Semua akun Whisperly yang sudah login dapat berkomentar:
    |
    | - User
    | - Talent
    | - Admin
    |
    | Menfess tetap anonim.
    | Komentar menampilkan username asli.
    |
    | reply_to digunakan untuk menghubungkan komentar
    | dengan komentar induknya.
    |
    */

    public function addComment(
        Request $request,
        menfess $menfess
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'komentar' => [
                'required',
                'string',
                'min:1',
                'max:2000',
            ],

            'reply_to' => [
                'nullable',
                'string',
                'exists:comments,id',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN WHISPERLY
        |--------------------------------------------------------------------------
        */

        $user = Auth::guard('whisperly')->user();


        if (!$user) {

            return back()
                ->with(
                    'message_error',
                    'Silakan login terlebih dahulu.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HANYA MENFESS APPROVED YANG DAPAT DIBALAS
        |--------------------------------------------------------------------------
        */

        if ($menfess->status !== 'approved') {

            return back()
                ->with(
                    'message_error',
                    'Menfess belum tersedia untuk dibalas.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL ISI KOMENTAR
        |--------------------------------------------------------------------------
        */

        $komentar = trim(
            (string) $request->input('komentar')
        );


        $replyTo = $request->input('reply_to');


        /*
        |--------------------------------------------------------------------------
        | CEK PARENT COMMENT
        |--------------------------------------------------------------------------
        |
        | Kalau reply_to diisi, pastikan komentar tersebut:
        |
        | 1. benar-benar ada
        | 2. berasal dari menfess yang sama
        |
        */

        $parentComment = null;

        if ($replyTo) {

            $parentComment = comments::with('pengguna')
                ->where(
                    'id',
                    $replyTo
                )
                ->where(
                    'id_menfess',
                    $menfess->id
                )
                ->first();


            /*
            |--------------------------------------------------------------------------
            | JIKA PARENT TIDAK DITEMUKAN
            |--------------------------------------------------------------------------
            */

            if (!$parentComment) {

                return back()
                    ->with(
                        'message_error',
                        'Komentar yang ingin dibalas tidak ditemukan.'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | TAMBAHKAN MENTION @USERNAME
            |--------------------------------------------------------------------------
            */

            $targetUsername =
                $parentComment->pengguna?->username
                ?? 'Pengguna';


            $mention =
                '@' . $targetUsername;


            /*
            |--------------------------------------------------------------------------
            | CEGAH @USERNAME DOBEL
            |--------------------------------------------------------------------------
            */

            if (
                !str_starts_with(
                    strtolower($komentar),
                    strtolower($mention)
                )
            ) {

                $komentar =
                    $mention
                    . ' '
                    . $komentar;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KOMENTAR
        |--------------------------------------------------------------------------
        |
        | BAGIAN PENTING:
        |
        | reply_to sekarang BENAR-BENAR disimpan.
        |
        | Kalau komentar utama:
        |     reply_to = null
        |
        | Kalau membalas komentar:
        |     reply_to = ID komentar yang dibalas
        |
        */

        comments::create([
            'id_menfess' =>
                $menfess->id,

            'id_pengguna' =>
                $user->id,

            'komentar' =>
                $komentar,

            'status' =>
                'active',

            'reply_to' =>
                $parentComment?->id,
        ]);


        /*
        |--------------------------------------------------------------------------
        | CATAT LOG
        |--------------------------------------------------------------------------
        */

        $this->log(
            $request,
            'membalas menfess',
            [
                'menfess.id' =>
                    $menfess->id,

                'comment.user_id' =>
                    $user->id,

                'reply_to' =>
                    $parentComment?->id,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE HALAMAN SEBELUMNYA
        |--------------------------------------------------------------------------
        */

        return back()
            ->with(
                'message_success',
                $parentComment
                    ? 'Balasan berhasil dikirim.'
                    : 'Komentar berhasil dikirim.'
            );
    }
}