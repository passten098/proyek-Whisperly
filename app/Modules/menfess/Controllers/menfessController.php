<?php
namespace App\Modules\menfess\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\menfess\Models\menfess;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class menfessController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Menfess";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = menfess::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('menfess::menfess', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'id_pengguna' => ['label' => 'Pengguna', 'type' => 'number', 'value' => old("id_pengguna"), 'required' => true],
			'id_kategori' => ['label' => 'Kategori', 'type' => 'number', 'value' => old("id_kategori"), 'required' => true],
			'isi_pesan' => ['label' => 'Isi Pesan', 'type' => 'textarea', 'value' => old("isi_pesan"), 'required' => true],
			'status' => ['label' => 'Status', 'type' => 'text', 'value' => old("status"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('menfess::menfess_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_pengguna' => 'required',
			'id_kategori' => 'required',
			'isi_pesan' => 'required',
			'status' => 'required',
			
		]);

		$menfess = new menfess();
		$menfess->id_pengguna = $request->input("id_pengguna");
		$menfess->id_kategori = $request->input("id_kategori");
		$menfess->isi_pesan = $request->input("isi_pesan");
		$menfess->status = $request->input("status");
		
		$menfess->created_by = Auth::id();
		$menfess->save();

		$text = 'membuat '.$this->title; //' baru '.$menfess->what;
		$this->log($request, $text, ['menfess.id' => $menfess->id]);
		return redirect()->route('menfess.index')->with('message_success', 'Menfess berhasil ditambahkan!');
	}

	public function show(Request $request, menfess $menfess)
	{
		$data['menfess'] = $menfess;

		$text = 'melihat detail '.$this->title;//.' '.$menfess->what;
		$this->log($request, $text, ['menfess.id' => $menfess->id]);
		return view('menfess::menfess_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, menfess $menfess)
	{
		$data['menfess'] = $menfess;

		
		$data['forms'] = array(
			'id_pengguna' => ['label' => 'Pengguna', 'type' => 'number', 'value' => $menfess->id_pengguna, 'required' => true, 'id' => 'id_pengguna'],
			'id_kategori' => ['label' => 'Kategori', 'type' => 'number', 'value' => $menfess->id_kategori, 'required' => true, 'id' => 'id_kategori'],
			'isi_pesan' => ['label' => 'Isi Pesan', 'type' => 'textarea', 'value' => $menfess->isi_pesan, 'required' => true, 'id' => 'isi_pesan'],
			'status' => ['label' => 'Status', 'type' => 'text', 'value' => $menfess->status, 'required' => true, 'id' => 'status'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$menfess->what;
		$this->log($request, $text, ['menfess.id' => $menfess->id]);
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
		$menfess->id_pengguna = $request->input("id_pengguna");
		$menfess->id_kategori = $request->input("id_kategori");
		$menfess->isi_pesan = $request->input("isi_pesan");
		$menfess->status = $request->input("status");
		
		$menfess->updated_by = Auth::id();
		$menfess->save();


		$text = 'mengedit '.$this->title;//.' '.$menfess->what;
		$this->log($request, $text, ['menfess.id' => $menfess->id]);
		return redirect()->route('menfess.index')->with('message_success', 'Menfess berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$menfess = menfess::find($id);
		$menfess->deleted_by = Auth::id();
		$menfess->save();
		$menfess->delete();

		$text = 'menghapus '.$this->title;//.' '.$menfess->what;
		$this->log($request, $text, ['menfess.id' => $menfess->id]);
		return back()->with('message_success', 'Menfess berhasil dihapus!');
	}

}
