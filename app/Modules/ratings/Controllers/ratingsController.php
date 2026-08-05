<?php
namespace App\Modules\ratings\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\ratings\Models\ratings;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ratingsController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Ratings";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = ratings::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('ratings::ratings', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'id_booking' => ['label' => 'Booking', 'type' => 'number', 'value' => old("id_booking"), 'required' => true],
			'id_pengguna' => ['label' => 'Pengguna', 'type' => 'number', 'value' => old("id_pengguna"), 'required' => true],
			'nilai_rating' => ['label' => 'Nilai Rating', 'type' => 'text', 'value' => old("nilai_rating"), 'required' => true],
			'ulasan' => ['label' => 'Ulasan', 'type' => 'textarea', 'value' => old("ulasan"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('ratings::ratings_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_booking' => 'required',
			'id_pengguna' => 'required',
			'nilai_rating' => 'required',
			'ulasan' => 'required',
			
		]);

		$ratings = new ratings();
		$ratings->id_booking = $request->input("id_booking");
		$ratings->id_pengguna = $request->input("id_pengguna");
		$ratings->nilai_rating = $request->input("nilai_rating");
		$ratings->ulasan = $request->input("ulasan");
		
		$ratings->created_by = Auth::id();
		$ratings->save();

		$text = 'membuat '.$this->title; //' baru '.$ratings->what;
		$this->log($request, $text, ['ratings.id' => $ratings->id]);
		return redirect()->route('ratings.index')->with('message_success', 'Ratings berhasil ditambahkan!');
	}

	public function show(Request $request, ratings $ratings)
	{
		$data['ratings'] = $ratings;

		$text = 'melihat detail '.$this->title;//.' '.$ratings->what;
		$this->log($request, $text, ['ratings.id' => $ratings->id]);
		return view('ratings::ratings_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, ratings $ratings)
	{
		$data['ratings'] = $ratings;

		
		$data['forms'] = array(
			'id_booking' => ['label' => 'Booking', 'type' => 'number', 'value' => $ratings->id_booking, 'required' => true, 'id' => 'id_booking'],
			'id_pengguna' => ['label' => 'Pengguna', 'type' => 'number', 'value' => $ratings->id_pengguna, 'required' => true, 'id' => 'id_pengguna'],
			'nilai_rating' => ['label' => 'Nilai Rating', 'type' => 'text', 'value' => $ratings->nilai_rating, 'required' => true, 'id' => 'nilai_rating'],
			'ulasan' => ['label' => 'Ulasan', 'type' => 'textarea', 'value' => $ratings->ulasan, 'required' => true, 'id' => 'ulasan'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$ratings->what;
		$this->log($request, $text, ['ratings.id' => $ratings->id]);
		return view('ratings::ratings_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_booking' => 'required',
			'id_pengguna' => 'required',
			'nilai_rating' => 'required',
			'ulasan' => 'required',
			
		]);

		$ratings = ratings::find($id);
		$ratings->id_booking = $request->input("id_booking");
		$ratings->id_pengguna = $request->input("id_pengguna");
		$ratings->nilai_rating = $request->input("nilai_rating");
		$ratings->ulasan = $request->input("ulasan");
		
		$ratings->updated_by = Auth::id();
		$ratings->save();


		$text = 'mengedit '.$this->title;//.' '.$ratings->what;
		$this->log($request, $text, ['ratings.id' => $ratings->id]);
		return redirect()->route('ratings.index')->with('message_success', 'Ratings berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$ratings = ratings::find($id);
		$ratings->deleted_by = Auth::id();
		$ratings->save();
		$ratings->delete();

		$text = 'menghapus '.$this->title;//.' '.$ratings->what;
		$this->log($request, $text, ['ratings.id' => $ratings->id]);
		return back()->with('message_success', 'Ratings berhasil dihapus!');
	}

}
