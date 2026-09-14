@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row align-items-end mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <p class="kt-eyebrow mb-1">Data Management</p>
                <h3 class="mb-0">{{ $title ?? 'Riwayat Talent' }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('talents.index') }}">Talents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @php
        $history = $bookings ?? $data ?? ($talent?->bookings ?? collect());
    @endphp

    <section class="section">
        <div class="card kt-table-card">
            <div class="card-body">
                <div class="row align-items-center mb-3 g-2">
                    <div class="col-12 col-md-8">
                        <h5 class="mb-1">Riwayat Booking</h5>
                        <p class="text-muted mb-0">
                            {{ $talent?->pengguna?->username ? 'Riwayat booking '.$talent->pengguna->username : 'Daftar seluruh riwayat booking talent' }}
                        </p>
                    </div>
                    <div class="col-12 col-md-4 text-md-end">
                        <a href="{{ route('talents.index') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                @include('include.flash')

                <div class="table-responsive-md">
                    <table class="table table-hover align-middle kt-table" id="table1">
                        <thead>
                            <tr>
                                <th width="15">No</th>
                                <th>Pengguna</th>
                                <th>Tanggal Booking</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th width="15%">Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = method_exists($history, 'firstItem') ? $history->firstItem() : 1;
                            @endphp
                            @forelse ($history as $item)
                                @php
                                    $bookingDate = $item->tanggal_booking ?? $item->created_at;
                                    $duration = $item->durasi_jam;
                                    if ($duration === null && method_exists($item, 'durationHours')) {
                                        $duration = $item->durationHours();
                                    }
                                    $status = $item->status ?? 'pending';
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->pengguna?->username ?? $item->pengguna_username ?? '-' }}</td>
                                    <td>{{ $bookingDate ? \Illuminate\Support\Carbon::parse($bookingDate)->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $duration !== null ? $duration.' jam' : '-' }}</td>
                                    <td>
                                        <span class="badge bg-light-secondary text-capitalize">{{ str_replace('_', ' ', $status) }}</span>
                                    </td>
                                    <td>{{ $item->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fa fa-history fa-2x text-muted mb-2"></i>
                                        <p class="mb-0"><i>Belum ada riwayat booking.</i></p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (method_exists($history, 'links'))
                    {{ $history->withQueryString()->links() }}
                @endif
            </div>
        </div>
    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection