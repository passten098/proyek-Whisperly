<?php
namespace App\Modules\pengguna\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\pengguna\Models\pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class penggunaController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Pengguna";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = pengguna::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('pengguna::pengguna', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'username' => ['label' => 'Username', 'type' => 'text', 'value' => old("username"), 'required' => true],
			'email' => ['label' => 'Email', 'type' => 'text', 'value' => old("email"), 'required' => true],
			'password' => ['label' => 'Password', 'type' => 'text', 'value' => old("password"), 'required' => true],
			'role' => ['label' => 'Role', 'type' => 'text', 'value' => old("role"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('pengguna::pengguna_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'username' => 'required',
			'email' => 'required',
			'password' => 'required',
			'role' => 'required',
			
		]);

		$pengguna = new pengguna();
		$pengguna->username = $request->input("username");
		$pengguna->email = $request->input("email");
		$pengguna->password = $request->input("password");
		$pengguna->role = $request->input("role");
		
		$pengguna->created_by = Auth::id();
		$pengguna->save();

		$text = 'membuat '.$this->title; //' baru '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return redirect()->route('pengguna.index')->with('message_success', 'Pengguna berhasil ditambahkan!');
	}

	public function show(Request $request, pengguna $pengguna)
	{
		$data['pengguna'] = $pengguna;

		$text = 'melihat detail '.$this->title;//.' '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return view('pengguna::pengguna_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, pengguna $pengguna)
	{
		$data['pengguna'] = $pengguna;

		
		$data['forms'] = array(
			'username' => ['label' => 'Username', 'type' => 'text', 'value' => $pengguna->username, 'required' => true, 'id' => 'username'],
			'email' => ['label' => 'Email', 'type' => 'text', 'value' => $pengguna->email, 'required' => true, 'id' => 'email'],
			'password' => ['label' => 'Password', 'type' => 'text', 'value' => $pengguna->password, 'required' => true, 'id' => 'password'],
			'role' => ['label' => 'Role', 'type' => 'text', 'value' => $pengguna->role, 'required' => true, 'id' => 'role'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return view('pengguna::pengguna_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'username' => 'required',
			'email' => 'required',
			'password' => 'required',
			'role' => 'required',
			
		]);

		$pengguna = pengguna::find($id);
		$pengguna->username = $request->input("username");
		$pengguna->email = $request->input("email");
		$pengguna->password = $request->input("password");
		$pengguna->role = $request->input("role");
		
		$pengguna->updated_by = Auth::id();
		$pengguna->save();


		$text = 'mengedit '.$this->title;//.' '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return redirect()->route('pengguna.index')->with('message_success', 'Pengguna berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$pengguna = pengguna::find($id);
		$pengguna->deleted_by = Auth::id();
		$pengguna->save();
		$pengguna->delete();

		$text = 'menghapus '.$this->title;//.' '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return back()->with('message_success', 'Pengguna berhasil dihapus!');
	}

}
