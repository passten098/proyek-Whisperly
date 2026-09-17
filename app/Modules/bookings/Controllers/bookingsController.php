<?php

namespace App\Modules\bookings\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\bookings\Models\bookings;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class bookingsController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Bookings";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = bookings::with('whisperlyBooking');

		if ($request->has('search')) {
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}

		// Urutkan berdasarkan tanggal booking terbaru
		// Jika tanggal booking sama, gunakan created_at terbaru
		$data['data'] = $query
			->orderByDesc('tanggal_booking')
			->orderByDesc('created_at')
			->paginate(10)
			->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);

		return view(
			'bookings::bookings',
			array_merge(
				$data,
				['title' => $this->title]
			)
		);
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'id_pengguna' => [
				'label' => 'Pengguna',
				'type' => 'number',
				'value' => old("id_pengguna"),
				'required' => true
			],

			'id_talent' => [
				'label' => 'Talent',
				'type' => 'number',
				'value' => old("id_talent"),
				'required' => true
			],

			'tanggal_booking' => [
				'label' => 'Tanggal Booking',
				'type' => 'text',
				'value' => old("tanggal_booking"),
				'required' => true,
				'class' => 'datepicker'
			],

			'durasi_jam' => [
				'label' => 'Durasi Jam',
				'type' => 'text',
				'value' => old("durasi_jam"),
				'required' => true
			],

			'status' => [
				'label' => 'Status',
				'type' => 'text',
				'value' => old("status"),
				'required' => true
			],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);

		return view(
			'bookings::bookings_create',
			array_merge(
				$data,
				['title' => $this->title]
			)
		);
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_pengguna' => 'required',
			'id_talent' => 'required',
			'tanggal_booking' => 'required',
			'durasi_jam' => 'required',
			'status' => 'required',
			
		]);

		$bookings = new bookings();

		$bookings->id_pengguna = $request->input("id_pengguna");
		$bookings->id_talent = $request->input("id_talent");
		$bookings->tanggal_booking = $request->input("tanggal_booking");
		$bookings->durasi_jam = $request->input("durasi_jam");
		$bookings->status = $request->input("status");
		
		$lastKode = bookings::withTrashed()
   	 	->whereNotNull('kode_booking')
    	->orderByDesc('kode_booking')
    	->value('kode_booking');

		$number = $lastKode
    	? ((int) substr($lastKode, 3)) + 1
    	: 1;

		$bookings->kode_booking = 'BK-' . str_pad($number, 6, '0', STR_PAD_LEFT);

		$bookings->created_by = Auth::id();
		$bookings->save();

		$text = 'membuat '.$this->title;
		$this->log(
			$request,
			$text,
			['bookings.id' => $bookings->id]
		);

		return redirect()
			->route('bookings.index')
			->with(
				'message_success',
				'Bookings berhasil ditambahkan!'
			);
	}

	public function show(Request $request, bookings $bookings)
	{
		$data['bookings'] = $bookings;

		$text = 'melihat detail '.$this->title;

		$this->log(
			$request,
			$text,
			['bookings.id' => $bookings->id]
		);

		return view(
			'bookings::bookings_detail',
			array_merge(
				$data,
				['title' => $this->title]
			)
		);
	}

	public function edit(Request $request, bookings $bookings)
	{
		$data['bookings'] = $bookings;

		
		$data['forms'] = array(
			'id_pengguna' => [
				'label' => 'Pengguna',
				'type' => 'number',
				'value' => $bookings->id_pengguna,
				'required' => true,
				'id' => 'id_pengguna'
			],

			'id_talent' => [
				'label' => 'Talent',
				'type' => 'number',
				'value' => $bookings->id_talent,
				'required' => true,
				'id' => 'id_talent'
			],

			'tanggal_booking' => [
				'label' => 'Tanggal Booking',
				'type' => 'text',
				'value' => $bookings->tanggal_booking,
				'required' => true,
				'class' => 'datepicker',
				'id' => 'tanggal_booking'
			],

			'durasi_jam' => [
				'label' => 'Durasi Jam',
				'type' => 'text',
				'value' => $bookings->durasi_jam,
				'required' => true,
				'id' => 'durasi_jam'
			],

			'status' => [
				'label' => 'Status',
				'type' => 'text',
				'value' => $bookings->status,
				'required' => true,
				'id' => 'status'
			],
			
		);

		$text = 'membuka form edit '.$this->title;

		$this->log(
			$request,
			$text,
			['bookings.id' => $bookings->id]
		);

		return view(
			'bookings::bookings_update',
			array_merge(
				$data,
				['title' => $this->title]
			)
		);
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_pengguna' => 'required',
			'id_talent' => 'required',
			'tanggal_booking' => 'required',
			'durasi_jam' => 'required',
			'status' => 'required',
			
		]);

		$bookings = bookings::find($id);

		$bookings->id_pengguna = $request->input("id_pengguna");
		$bookings->id_talent = $request->input("id_talent");
		$bookings->tanggal_booking = $request->input("tanggal_booking");
		$bookings->durasi_jam = $request->input("durasi_jam");
		$bookings->status = $request->input("status");
		
		$bookings->updated_by = Auth::id();
		$bookings->save();


		$text = 'mengedit '.$this->title;

		$this->log(
			$request,
			$text,
			['bookings.id' => $bookings->id]
		);

		return redirect()
			->route('bookings.index')
			->with(
				'message_success',
				'Bookings berhasil diubah!'
			);
	}

	public function destroy(Request $request, $id)
	{
		$bookings = bookings::find($id);

		$bookings->deleted_by = Auth::id();
		$bookings->save();
		$bookings->delete();

		$text = 'menghapus '.$this->title;

		$this->log(
			$request,
			$text,
			['bookings.id' => $bookings->id]
		);

		return back()->with(
			'message_success',
			'Bookings berhasil dihapus!'
		);
	}

}

