@extends('layouts.app')

@section('page-css')
<style>
    /* =========================================================
       RATINGS PAGE
    ========================================================= */

    .ratings-page {
        width: 100%;
    }

    /* HEADER */
    .ratings-page .breadcrumb-area {
        margin-bottom: 12px;
    }

    .ratings-page .breadcrumb-area a {
        color: #555;
        text-decoration: none;
        font-size: 14px;
    }

    .ratings-page .breadcrumb-area span {
        color: #999;
        font-size: 14px;
        margin: 0 7px;
    }

    .ratings-page .section-label {
        margin: 0 0 5px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .7px;
        color: #1455c0;
        text-transform: uppercase;
    }

    .ratings-page .page-title {
        margin: 0;
        font-size: 24px;
        line-height: 1.2;
        font-weight: 600;
        color: #222;
    }

    .ratings-page .page-header {
        margin-bottom: 24px;
    }


    /* ALERT */
    .ratings-page .alert {
        border-radius: 7px;
        padding: 12px 15px;
        margin-bottom: 18px;
        font-size: 14px;
    }


    /* MAIN CONTENT */
    .ratings-page .content-box {
        width: 100%;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 7px;
        padding: 20px;
    }


    /* TOP ACTION */
    .ratings-page .toolbar {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 30px;
    }


    /* SEARCH */
    .ratings-page .search-form {
        display: flex;
        align-items: center;
        width: 290px;
        height: 40px;
    }

    .ratings-page .search-wrapper {
        position: relative;
        width: 100%;
    }

    .ratings-page .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9aa3b2;
        font-size: 16px;
        pointer-events: none;
    }

    .ratings-page .search-form input {
        width: 100%;
        height: 40px;
        border: 1px solid #bfc7d8;
        border-radius: 20px;
        padding: 0 14px 0 37px;
        outline: none;
        color: #333;
        background: #fff;
        font-size: 14px;
        box-sizing: border-box;
    }

    .ratings-page .search-form input::placeholder {
        color: #a2aaba;
    }

    .ratings-page .search-form input:focus {
        border-color: #1455c0;
    }

    .ratings-page .search-button {
        display: none;
    }

    .ratings-page .reset-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-left: 8px;
        height: 40px;
        padding: 0 14px;
        border-radius: 20px;
        background: #f1f3f7;
        color: #555;
        text-decoration: none;
        font-size: 13px;
    }


    /* TAMBAH */
    .ratings-page .btn-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 145px;
        height: 40px;
        padding: 0 17px;
        border: 0;
        border-radius: 20px;
        background: #0757d5;
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
    }

    .ratings-page .btn-add:hover {
        background: #064bb7;
        color: #fff;
    }

    .ratings-page .btn-add .plus {
        font-size: 20px;
        line-height: 1;
        font-weight: 600;
    }


    /* TABLE */
    .ratings-page .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .ratings-page table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
        table-layout: auto;
    }

    .ratings-page thead th {
        background: #f1f1fb;
        color: #20243a;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .25px;
        padding: 9px 12px;
        height: 30px;
        border-bottom: 1px solid #dcddea;
        text-align: left;
        white-space: nowrap;
    }

    .ratings-page tbody td {
        height: 72px;
        padding: 10px 12px;
        border-bottom: 1px solid #e5e7ee;
        color: #394052;
        font-size: 14px;
        vertical-align: middle;
        background: #fff;
    }

    .ratings-page tbody tr:hover td {
        background: #fafbfe;
    }


    /* COLUMN */
    .ratings-page .col-no {
        width: 40px;
    }

    .ratings-page .col-booking {
        width: 150px;
    }

    .ratings-page .col-user {
        width: 170px;
    }

    .ratings-page .col-rating {
        width: 150px;
    }

    .ratings-page .col-review {
        min-width: 250px;
    }

    .ratings-page .col-action {
        width: 180px;
    }


    /* BOOKING */
    .ratings-page .booking-value {
        color: #26364d;
        font-weight: 500;
        font-size: 14px;
    }


    /* USERNAME */
    .ratings-page .username-value {
        color: #26364d;
        font-weight: 500;
        font-size: 14px;
    }


    /* RATING */
    .ratings-page .rating-value {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
        color: #b57b00;
        background: #fff8e7;
        border-radius: 5px;
        padding: 5px 8px;
        font-size: 12px;
    }

    .ratings-page .stars {
        margin-top: 5px;
        color: #f1a900;
        font-size: 14px;
        letter-spacing: 1px;
        white-space: nowrap;
    }


    /* ULASAN */
    .ratings-page .review {
        max-width: 360px;
        color: #555d6e;
        line-height: 1.45;
        word-break: break-word;
    }


    /* ACTION */
    .ratings-page .actions {
        display: flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }

    .ratings-page .action-link,
    .ratings-page .action-button {
        height: 30px;
        padding: 0 11px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 12px;
        cursor: pointer;
        background: #fff;
    }

    .ratings-page .detail-button {
        border: 1px solid #222;
        color: #222;
    }

    .ratings-page .edit-button {
        border: 1px solid #0757d5;
        color: #0757d5;
    }

    .ratings-page .delete-button {
        border: 1px solid #ef3340;
        color: #ef3340;
    }

    .ratings-page .action-link:hover,
    .ratings-page .action-button:hover {
        opacity: .8;
    }


    /* EMPTY */
    .ratings-page .empty-data {
        text-align: center !important;
        padding: 50px 20px !important;
        color: #999 !important;
    }


    /* PAGINATION */
    .ratings-page .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
    }


    /* RESPONSIVE */
    @media (max-width: 768px) {

        .ratings-page .toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .ratings-page .search-form {
            width: 100%;
        }

        .ratings-page .btn-add {
            width: 100%;
        }

    }
</style>
@endsection


@section('main')

<div class="ratings-page">

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}
    <div class="breadcrumb-area">
        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span>/</span>

        <span>
            Ratings
        </span>
    </div>


    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}
    <div class="page-header">

        <p class="section-label">
            Data Management
        </p>

        <h1 class="page-title">
            {{ $title ?? 'Ratings' }}
        </h1>

    </div>


    {{-- =====================================================
         ALERT SUCCESS
    ====================================================== --}}
    @if (session('message_success'))

        <div class="alert alert-success">
            {{ session('message_success') }}
        </div>

    @endif


    {{-- =====================================================
         ALERT ERROR
    ====================================================== --}}
    @if (session('message_error'))

        <div class="alert alert-danger">
            {{ session('message_error') }}
        </div>

    @endif


    {{-- =====================================================
         CONTENT
    ====================================================== --}}
    <div class="content-box">

        {{-- TOOLBAR --}}
        <div class="toolbar">

            {{-- SEARCH --}}
            <form
                method="GET"
                action="{{ route('ratings.index') }}"
                class="search-form"
            >

                <div class="search-wrapper">

                    <span class="search-icon">
                        &#128269;
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search"
                    >

                </div>

                <button
                    type="submit"
                    class="search-button"
                >
                    Cari
                </button>

                @if (request('search'))

                    <a
                        href="{{ route('ratings.index') }}"
                        class="reset-button"
                    >
                        Reset
                    </a>

                @endif

            </form>


            {{-- TAMBAH --}}
            <a
                href="{{ route('ratings.create') }}"
                class="btn-add"
            >
                <span class="plus">+</span>
                Tambah Ratings
            </a>

        </div>


        {{-- =================================================
             TABLE
        ================================================== --}}
        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th class="col-no">
                            No
                        </th>

                        <th class="col-booking">
                            Booking
                        </th>

                        <th class="col-user">
                            Pengguna
                        </th>

                        <th class="col-rating">
                            Nilai Rating
                        </th>

                        <th class="col-review">
                            Ulasan
                        </th>

                        <th class="col-action">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($data as $item)

                        <tr>

                            {{-- NO --}}
                            <td>
                                {{ $data->firstItem() + $loop->index }}
                            </td>


                            {{-- BOOKING --}}
                            <td>

                                @if ($item->booking)

                                    <div class="booking-value">
                                        {{ $item->booking->no ?? $item->booking->id }}
                                    </div>

                                @elseif ($item->id_booking)

                                    <div class="booking-value">
                                        {{ $item->id_booking }}
                                    </div>

                                @else

                                    -

                                @endif

                            </td>


                            {{-- PENGGUNA --}}
                            <td>

                                @if ($item->pengguna)

                                    <div class="username-value">
                                        {{ $item->pengguna->username ?? '-' }}
                                    </div>

                                @else

                                    -

                                @endif

                            </td>


                            {{-- NILAI RATING --}}
                            <td>

                                <div class="rating-value">
                                    ★ {{ $item->nilai_rating }}/5
                                </div>

                                <div class="stars">

                                    @for ($i = 1; $i <= 5; $i++)

                                        @if ($i <= (int) $item->nilai_rating)

                                            ★

                                        @else

                                            ☆

                                        @endif

                                    @endfor

                                </div>

                            </td>


                            {{-- ULASAN --}}
                            <td>

                                @if ($item->ulasan)

                                    <div class="review">
                                        {{ $item->ulasan }}
                                    </div>

                                @else

                                    <span style="color:#aaa;">
                                        Tidak ada ulasan
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="actions">

                                    {{-- DETAIL --}}
                                    <a
                                        href="{{ route('ratings.show', $item->id) }}"
                                        class="action-link detail-button"
                                    >
                                        →
                                    </a>


                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('ratings.edit', $item->id) }}"
                                        class="action-link edit-button"
                                    >
                                        ✎ Edit
                                    </a>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('ratings.destroy', $item->id) }}"
                                        method="POST"
                                        style="margin:0;"
                                        onsubmit="return confirm('Yakin ingin menghapus rating ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-button delete-button"
                                        >
                                            🗑 Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="empty-data"
                            >
                                Belum ada data rating.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if ($data->hasPages())

            <div class="pagination-wrapper">
                {{ $data->links() }}
            </div>

        @endif

    </div>

</div>

@endsection