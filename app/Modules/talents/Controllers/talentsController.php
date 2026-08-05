<?php
namespace App\Modules\talents\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\talents\Models\talents;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class talentsController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Talents";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = talents::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('talents::talents', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'id_user' => ['label' => 'User', 'type' => 'number', 'value' => old("id_user"), 'required' => true],
			'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'value' => old("deskripsi"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('talents::talents_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_user' => 'required',
			'deskripsi' => 'required',
			
		]);

		$talents = new talents();
		$talents->id_user = $request->input("id_user");
		$talents->deskripsi = $request->input("deskripsi");
		
		$talents->created_by = Auth::id();
		$talents->save();

		$text = 'membuat '.$this->title; //' baru '.$talents->what;
		$this->log($request, $text, ['talents.id' => $talents->id]);
		return redirect()->route('talents.index')->with('message_success', 'Talents berhasil ditambahkan!');
	}

	public function show(Request $request, talents $talents)
	{
		$data['talents'] = $talents;

		$text = 'melihat detail '.$this->title;//.' '.$talents->what;
		$this->log($request, $text, ['talents.id' => $talents->id]);
		return view('talents::talents_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, talents $talents)
	{
		$data['talents'] = $talents;

		
		$data['forms'] = array(
			'id_user' => ['label' => 'User', 'type' => 'number', 'value' => $talents->id_user, 'required' => true, 'id' => 'id_user'],
			'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'value' => $talents->deskripsi, 'required' => true, 'id' => 'deskripsi'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$talents->what;
		$this->log($request, $text, ['talents.id' => $talents->id]);
		return view('talents::talents_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_user' => 'required',
			'deskripsi' => 'required',
			
		]);

		$talents = talents::find($id);
		$talents->id_user = $request->input("id_user");
		$talents->deskripsi = $request->input("deskripsi");
		
		$talents->updated_by = Auth::id();
		$talents->save();


		$text = 'mengedit '.$this->title;//.' '.$talents->what;
		$this->log($request, $text, ['talents.id' => $talents->id]);
		return redirect()->route('talents.index')->with('message_success', 'Talents berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$talents = talents::find($id);
		$talents->deleted_by = Auth::id();
		$talents->save();
		$talents->delete();

		$text = 'menghapus '.$this->title;//.' '.$talents->what;
		$this->log($request, $text, ['talents.id' => $talents->id]);
		return back()->with('message_success', 'Talents berhasil dihapus!');
	}

}
