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
        $query = ratings::with(['booking.talent', 'pengguna']);

        if ($request->filled('search')) {
            $search = $request->get('search');

            $query->where(function ($q) use ($search) {
                $q->where('nilai_rating', 'like', "%{$search}%")
                    ->orWhere('ulasan', 'like', "%{$search}%")
                    ->orWhere('id_booking', 'like', "%{$search}%")
                    ->orWhereHas('pengguna', function ($userQuery) use ($search) {
                        $userQuery->where('username', 'like', "%{$search}%");
                    });
            });
        }

        $data['data'] = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $this->log(
            $request,
            'melihat halaman manajemen data ' . $this->title
        );

        return view(
            'ratings::ratings',
            array_merge($data, ['title' => $this->title])
        );
    }

    public function create(Request $request)
    {
        $data['forms'] = [
            'id_booking' => [
                'label' => 'Booking',
                'type' => 'text',
                'value' => old('id_booking'),
                'required' => true,
            ],
            'id_pengguna' => [
                'label' => 'Pengguna',
                'type' => 'text',
                'value' => old('id_pengguna'),
                'required' => true,
            ],
            'nilai_rating' => [
                'label' => 'Nilai Rating',
                'type' => 'number',
                'value' => old('nilai_rating'),
                'required' => true,
                'min' => 1,
                'max' => 5,
            ],
            'ulasan' => [
                'label' => 'Ulasan',
                'type' => 'textarea',
                'value' => old('ulasan'),
                'required' => true,
            ],
        ];

        $this->log($request, 'membuka form tambah ' . $this->title);

        return view(
            'ratings::ratings_create',
            array_merge($data, ['title' => $this->title])
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_booking' => 'required|string|max:36',
            'id_pengguna' => 'required|string|max:36',
            'nilai_rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:1000',
        ]);

        $rating = new ratings();
        $rating->id_booking = $validated['id_booking'];
        $rating->id_pengguna = $validated['id_pengguna'];
        $rating->nilai_rating = $validated['nilai_rating'];
        $rating->ulasan = trim($validated['ulasan']);
        $rating->created_by = Auth::id();
        $rating->save();

        $this->log(
            $request,
            'membuat ' . $this->title,
            ['ratings.id' => $rating->id]
        );

        return redirect()
            ->route('ratings.index')
            ->with('message_success', 'Ratings berhasil ditambahkan!');
    }

    public function show(Request $request, ratings $ratings)
    {
        $data['ratings'] = $ratings;

        $this->log(
            $request,
            'melihat detail ' . $this->title,
            ['ratings.id' => $ratings->id]
        );

        return view(
            'ratings::ratings_detail',
            array_merge($data, ['title' => $this->title])
        );
    }

    public function edit(Request $request, ratings $ratings)
    {
        $data['ratings'] = $ratings;

        $data['forms'] = [
            'id_booking' => [
                'label' => 'Booking',
                'type' => 'text',
                'value' => $ratings->id_booking,
                'required' => true,
                'id' => 'id_booking',
            ],
            'id_pengguna' => [
                'label' => 'Pengguna',
                'type' => 'text',
                'value' => $ratings->id_pengguna,
                'required' => true,
                'id' => 'id_pengguna',
            ],
            'nilai_rating' => [
                'label' => 'Nilai Rating',
                'type' => 'number',
                'value' => $ratings->nilai_rating,
                'required' => true,
                'min' => 1,
                'max' => 5,
                'id' => 'nilai_rating',
            ],
            'ulasan' => [
                'label' => 'Ulasan',
                'type' => 'textarea',
                'value' => $ratings->ulasan,
                'required' => true,
                'id' => 'ulasan',
            ],
        ];

        $this->log(
            $request,
            'membuka form edit ' . $this->title,
            ['ratings.id' => $ratings->id]
        );

        return view(
            'ratings::ratings_update',
            array_merge($data, ['title' => $this->title])
        );
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_booking' => 'required|string|max:36',
            'id_pengguna' => 'required|string|max:36',
            'nilai_rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:1000',
        ]);

        $rating = ratings::findOrFail($id);
        $rating->id_booking = $validated['id_booking'];
        $rating->id_pengguna = $validated['id_pengguna'];
        $rating->nilai_rating = $validated['nilai_rating'];
        $rating->ulasan = trim($validated['ulasan']);
        $rating->updated_by = Auth::id();
        $rating->save();

        $this->log(
            $request,
            'mengedit ' . $this->title,
            ['ratings.id' => $rating->id]
        );

        return redirect()
            ->route('ratings.index')
            ->with('message_success', 'Ratings berhasil diubah!');
    }

    public function destroy(Request $request, $id)
    {
        $rating = ratings::findOrFail($id);
        $rating->deleted_by = Auth::id();
        $rating->save();
        $rating->delete();

        $this->log(
            $request,
            'menghapus ' . $this->title,
            ['ratings.id' => $rating->id]
        );

        return back()->with(
            'message_success',
            'Ratings berhasil dihapus!'
        );
    }
}
