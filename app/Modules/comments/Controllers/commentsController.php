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
		$query = comments::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('comments::comments', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'id_menfess' => ['label' => 'Menfess', 'type' => 'number', 'value' => old("id_menfess"), 'required' => true],
			'id_pengguna' => ['label' => 'Pengguna', 'type' => 'number', 'value' => old("id_pengguna"), 'required' => true],
			'komentar' => ['label' => 'Komentar', 'type' => 'textarea', 'value' => old("komentar"), 'required' => true],
			'status' => ['label' => 'Status', 'type' => 'text', 'value' => old("status"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('comments::comments_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
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

		$text = 'membuat '.$this->title; //' baru '.$comments->what;
		$this->log($request, $text, ['comments.id' => $comments->id]);
		return redirect()->route('comments.index')->with('message_success', 'Comments berhasil ditambahkan!');
	}

	public function show(Request $request, comments $comments)
	{
		$data['comments'] = $comments;

		$text = 'melihat detail '.$this->title;//.' '.$comments->what;
		$this->log($request, $text, ['comments.id' => $comments->id]);
		return view('comments::comments_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, comments $comments)
	{
		$data['comments'] = $comments;

		
		$data['forms'] = array(
			'id_menfess' => ['label' => 'Menfess', 'type' => 'number', 'value' => $comments->id_menfess, 'required' => true, 'id' => 'id_menfess'],
			'id_pengguna' => ['label' => 'Pengguna', 'type' => 'number', 'value' => $comments->id_pengguna, 'required' => true, 'id' => 'id_pengguna'],
			'komentar' => ['label' => 'Komentar', 'type' => 'textarea', 'value' => $comments->komentar, 'required' => true, 'id' => 'komentar'],
			'status' => ['label' => 'Status', 'type' => 'text', 'value' => $comments->status, 'required' => true, 'id' => 'status'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$comments->what;
		$this->log($request, $text, ['comments.id' => $comments->id]);
		return view('comments::comments_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_menfess' => 'required',
			'id_pengguna' => 'required',
			'komentar' => 'required',
			'status' => 'required',
			
		]);

		$comments = comments::find($id);
		$comments->id_menfess = $request->input("id_menfess");
		$comments->id_pengguna = $request->input("id_pengguna");
		$comments->komentar = $request->input("komentar");
		$comments->status = $request->input("status");
		
		$comments->updated_by = Auth::id();
		$comments->save();


		$text = 'mengedit '.$this->title;//.' '.$comments->what;
		$this->log($request, $text, ['comments.id' => $comments->id]);
		return redirect()->route('comments.index')->with('message_success', 'Comments berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$comments = comments::find($id);
		$comments->deleted_by = Auth::id();
		$comments->save();
		$comments->delete();

		$text = 'menghapus '.$this->title;//.' '.$comments->what;
		$this->log($request, $text, ['comments.id' => $comments->id]);
		return back()->with('message_success', 'Comments berhasil dihapus!');
	}

}
