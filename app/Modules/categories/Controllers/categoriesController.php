<?php
namespace App\Modules\categories\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\categories\Models\categories;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class categoriesController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Categories";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = categories::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('categories::categories', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'jenis_kategori' => ['label' => 'Jenis Kategori', 'type' => 'text', 'value' => old("jenis_kategori"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('categories::categories_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'jenis_kategori' => 'required',
			
		]);

		$categories = new categories();
		$categories->jenis_kategori = $request->input("jenis_kategori");
		
		$categories->created_by = Auth::id();
		$categories->save();

		$text = 'membuat '.$this->title; //' baru '.$categories->what;
		$this->log($request, $text, ['categories.id' => $categories->id]);
		return redirect()->route('categories.index')->with('message_success', 'Categories berhasil ditambahkan!');
	}

	public function show(Request $request, categories $categories)
	{
		$data['categories'] = $categories;

		$text = 'melihat detail '.$this->title;//.' '.$categories->what;
		$this->log($request, $text, ['categories.id' => $categories->id]);
		return view('categories::categories_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, categories $categories)
	{
		$data['categories'] = $categories;

		
		$data['forms'] = array(
			'jenis_kategori' => ['label' => 'Jenis Kategori', 'type' => 'text', 'value' => $categories->jenis_kategori, 'required' => true, 'id' => 'jenis_kategori'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$categories->what;
		$this->log($request, $text, ['categories.id' => $categories->id]);
		return view('categories::categories_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'jenis_kategori' => 'required',
			
		]);

		$categories = categories::find($id);
		$categories->jenis_kategori = $request->input("jenis_kategori");
		
		$categories->updated_by = Auth::id();
		$categories->save();


		$text = 'mengedit '.$this->title;//.' '.$categories->what;
		$this->log($request, $text, ['categories.id' => $categories->id]);
		return redirect()->route('categories.index')->with('message_success', 'Categories berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$categories = categories::find($id);
		$categories->deleted_by = Auth::id();
		$categories->save();
		$categories->delete();

		$text = 'menghapus '.$this->title;//.' '.$categories->what;
		$this->log($request, $text, ['categories.id' => $categories->id]);
		return back()->with('message_success', 'Categories berhasil dihapus!');
	}

}
