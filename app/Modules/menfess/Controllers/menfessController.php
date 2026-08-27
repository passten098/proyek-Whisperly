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

    public function index(Request $request): View
    {
        $query = menfess::query()->with(['pengguna', 'kategori', 'comments.pengguna']);

        if ($request->has('search')) {
            $search = trim((string) $request->get('search'));
            if ($search !== '') {
                $query->where('isi_pesan', 'like', "%{$search}%");
            }
        }

        $data['data'] = $query->paginate(10)->withQueryString();
        $this->log($request, 'melihat halaman manajemen data ' . $this->title);

        return view('menfess::menfess', array_merge($data, ['title' => $this->title]));
    }

    public function publicIndex(Request $request): View
    {
        $categories = categories::query()->orderBy('jenis_kategori')->get();
        $selectedCategory = $request->query('kategori');

        $query = menfess::query()
            ->with(['pengguna', 'kategori', 'comments.pengguna'])
            ->where('status', 'approved');

        if ($selectedCategory) {
            $category = categories::query()->where('jenis_kategori', strtolower((string) $selectedCategory))->first();
            if ($category) {
                $query->where('id_kategori', $category->id);
            }
        }

        $items = $query->orderByDesc('created_at')->get();

        return view('whisperly.pengaduan', [
            'title' => 'Ruang Pengaduan',
            'items' => $items,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'categoryColors' => [
                'cinta' => 'linear-gradient(135deg, rgba(186, 31, 54, 0.2), rgba(80, 18, 30, 0.16))',
                'horror' => 'linear-gradient(135deg, rgba(20, 71, 52, 0.35), rgba(9, 28, 22, 0.2))',
                'sedih' => 'linear-gradient(135deg, rgba(205, 132, 52, 0.28), rgba(132, 90, 32, 0.24))',
                'campuran' => 'linear-gradient(135deg, rgba(79, 120, 212, 0.28), rgba(48, 72, 124, 0.2))',
            ],
        ]);
    }

    public function adminIndex(Request $request): View
    {
        abort_unless(strtolower((string) ($request->user('whisperly')?->role ?? '')) === 'admin', 403, 'Hanya admin yang dapat mengakses moderasi menfess.');

        $data['items'] = menfess::query()
            ->with(['pengguna', 'kategori'])
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();

        $this->log($request, 'melihat daftar menfess pending untuk moderasi', ['count' => $data['items']->count()]);

        return view('menfess::menfess_admin', array_merge($data, ['title' => 'Moderasi Menfess']));
    }

    public function create(Request $request): View
    {
        $data['forms'] = [
            'id_kategori' => ['label' => 'Kategori', 'type' => 'select', 'value' => old('id_kategori'), 'required' => true],
            'isi_pesan' => ['label' => 'Isi Pesan', 'type' => 'textarea', 'value' => old('isi_pesan'), 'required' => true],
        ];

        $data['categories'] = categories::query()->orderBy('jenis_kategori')->get();
        $this->log($request, 'membuka form tambah ' . $this->title);

        return view('menfess::menfess_create', array_merge($data, ['title' => $this->title]));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_kategori' => 'required|string',
            'isi_pesan' => 'required|string|min:5|max:2000',
        ]);

        $category = categories::query()->where('id', $request->input('id_kategori'))->orWhere('jenis_kategori', strtolower((string) $request->input('id_kategori')))->first();

        if (!$category) {
            return back()->withErrors(['id_kategori' => 'Kategori tidak valid.'])->withInput();
        }

        $menfess = menfess::create([
            'id_pengguna' => Auth::guard('whisperly')->id() ?? Auth::id(),
            'id_kategori' => $category->id,
            'isi_pesan' => trim((string) $request->input('isi_pesan')),
            'status' => 'pending',
        ]);

        $this->log($request, 'membuat ' . $this->title, ['menfess.id' => $menfess->id]);

        return redirect()->route('pengaduan')->with('message_success', 'Menfess berhasil dikirim. Tunggu persetujuan admin.');
    }

    public function show(Request $request, menfess $menfess)
    {
        $data['menfess'] = $menfess;
        $this->log($request, 'melihat detail ' . $this->title, ['menfess.id' => $menfess->id]);

        return view('menfess::menfess_detail', array_merge($data, ['title' => $this->title]));
    }

    public function approve(Request $request, menfess $menfess): RedirectResponse
    {
        abort_unless(strtolower((string) ($request->user('whisperly')?->role ?? '')) === 'admin', 403, 'Hanya admin yang dapat menyetujui menfess.');

        $menfess->update(['status' => 'approved']);
        $this->log($request, 'menyetujui ' . $this->title, ['menfess.id' => $menfess->id]);

        return back()->with('message_success', 'Menfess berhasil disetujui.');
    }

    public function reject(Request $request, menfess $menfess): RedirectResponse
    {
        abort_unless(strtolower((string) ($request->user('whisperly')?->role ?? '')) === 'admin', 403, 'Hanya admin yang dapat menolak menfess.');

        $menfess->update(['status' => 'rejected']);
        $this->log($request, 'menolak ' . $this->title, ['menfess.id' => $menfess->id]);

        return back()->with('message_success', 'Menfess berhasil ditolak.');
    }

    public function edit(Request $request, menfess $menfess)
    {
        $data['menfess'] = $menfess;
        $data['forms'] = [
            'id_pengguna' => ['label' => 'Pengguna', 'type' => 'number', 'value' => $menfess->id_pengguna, 'required' => true, 'id' => 'id_pengguna'],
            'id_kategori' => ['label' => 'Kategori', 'type' => 'number', 'value' => $menfess->id_kategori, 'required' => true, 'id' => 'id_kategori'],
            'isi_pesan' => ['label' => 'Isi Pesan', 'type' => 'textarea', 'value' => $menfess->isi_pesan, 'required' => true, 'id' => 'isi_pesan'],
            'status' => ['label' => 'Status', 'type' => 'text', 'value' => $menfess->status, 'required' => true, 'id' => 'status'],
        ];

        $this->log($request, 'membuka form edit ' . $this->title, ['menfess.id' => $menfess->id]);

        return view('menfess::menfess_update', array_merge($data, ['title' => $this->title]));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_pengguna' => 'required',
            'id_kategori' => 'required',
            'isi_pesan' => 'required',
            'status' => 'required',
        ]);

        $menfess = menfess::find($id);
        $menfess->id_pengguna = $request->input('id_pengguna');
        $menfess->id_kategori = $request->input('id_kategori');
        $menfess->isi_pesan = $request->input('isi_pesan');
        $menfess->status = $request->input('status');
        $menfess->updated_by = Auth::id();
        $menfess->save();

        $this->log($request, 'mengedit ' . $this->title, ['menfess.id' => $menfess->id]);

        return redirect()->route('menfess.index')->with('message_success', 'Menfess berhasil diubah!');
    }

    public function destroy(Request $request, $id)
    {
        $menfess = menfess::find($id);
        $menfess->deleted_by = Auth::id();
        $menfess->save();
        $menfess->delete();

        $this->log($request, 'menghapus ' . $this->title, ['menfess.id' => $menfess->id]);

        return back()->with('message_success', 'Menfess berhasil dihapus!');
    }

    public function addComment(Request $request, menfess $menfess): RedirectResponse
    {
        $request->validate([
            'komentar' => ['required', 'string', 'min:2', 'max:2000'],
        ]);

        comments::create([
            'id_menfess' => $menfess->id,
            'id_pengguna' => Auth::guard('whisperly')->id() ?? Auth::id(),
            'komentar' => trim((string) $request->input('komentar')),
            'status' => 'active',
        ]);

        return back()->with('message_success', 'Balasan berhasil dikirim.');
    }
}
