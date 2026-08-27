<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($talent->pengguna->username) }} | Whisperly</title>
    <style>
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; padding: 130px 28px 40px; background: #f4c5d2; color: #241b31; font-family: Arial, sans-serif; }
        main { width: min(760px, 100%); margin: auto; }
        .back { display: inline-block; margin-bottom: 22px; color: #65455d; text-decoration: none; }
        .card { padding: clamp(22px, 5vw, 48px); border-radius: 24px; background: rgba(255,255,255,.82); box-shadow: 0 20px 50px rgba(94,45,76,.15); }
        .photo { width: min(300px, 100%); aspect-ratio: 1; display: grid; place-items: center; margin-bottom: 24px; border-radius: 20px; background: #d7a9bf; color: #65455d; overflow: hidden; font: 600 12px Arial, sans-serif; text-transform: uppercase; }
        .photo img { width: 100%; height: 100%; object-fit: cover; }
        h1 { margin: 0 0 12px; font: 400 clamp(40px, 8vw, 74px) Georgia, serif; }
        .description { color: #65455d; line-height: 1.65; }
        h2 { margin: 30px 0 12px; font: 400 28px Georgia, serif; }
        .schedule { display: grid; gap: 8px; }
        .slot { display: flex; justify-content: space-between; gap: 20px; padding: 13px 15px; border-radius: 12px; background: #f8e5ea; }
        .status { font-weight: 700; text-transform: capitalize; }
        .available { color: #34734a; } .unavailable { color: #9a5264; } .booked { color: #8a651e; }
        .status { display: inline-flex; align-items: center; gap: 8px; }
        .booking { margin-top: 18px; }
        .booking input { position: absolute; opacity: 0; }
        .booking label { display: flex; justify-content: space-between; gap: 20px; padding: 13px 15px; border-radius: 12px; background: #f8e5ea; cursor: pointer; }
        .booking input:checked + label { outline: 2px solid #65455d; background: #efd0db; }
        .confirm { margin-top: 16px; padding: 13px 19px; border: 0; border-radius: 99px; color: #fff; background: #241b31; cursor: pointer; font-weight: 700; }
        .flash { margin-bottom: 18px; padding: 12px 15px; border-radius: 12px; color: #34734a; background: #e2f1e4; }
        .popup { position: fixed; inset: 0; display: grid; place-items: center; background: rgba(25, 17, 35, .45); z-index: 30; }
        .popup-card { width: min(420px, calc(100% - 24px)); padding: 28px 22px; border-radius: 20px; background: #fff; box-shadow: 0 24px 60px rgba(40, 24, 46, .2); text-align: center; }
        .popup-card h3 { margin: 0 0 12px; font-size: 28px; color: #241b31; }
        .popup-card p { margin: 0 0 20px; color: #65455d; }
        .popup-actions { display: flex; justify-content: center; gap: 12px; }
        .popup-actions a, .popup-actions button { padding: 12px 18px; border: 0; border-radius: 99px; font-weight: 700; text-decoration: none; cursor: pointer; }
        .popup-actions a { background: #241b31; color: #fff; }
        .popup-actions button { background: #f2dfe8; color: #241b31; }
    </style>
</head>
<body>
    @include('whisperly.navbar')
    @if (session('booking_success') && session('booking_id'))
        <div class="popup" id="booking-popup">
            <div class="popup-card">
                <h3>Booking berhasil!</h3>
                <p>Jadwal Anda telah dikonfirmasi.</p>
                <div class="popup-actions">
                    <a href="{{ route('whisperly.chat.show', session('booking_id')) }}">Mulai Chat</a>
                    <button type="button" onclick="document.getElementById('booking-popup').style.display='none'">Tutup</button>
                </div>
            </div>
        </div>
    @endif
    <main>
        <a class="back" href="{{ route('whisperly.talents.index') }}">← Semua Talent</a>
        @if (session('status'))
            <div class="flash">{{ session('status') }}</div>
        @endif
        <article class="card">
            <div class="photo">
                @if ($talent->photo)
                    <img src="{{ Storage::url($talent->photo) }}" alt="Foto {{ $talent->pengguna->username }}">
                @else
                    {{ $talent->pengguna->username }}
                @endif
            </div>
            <h1>{{ ucfirst($talent->pengguna->username) }}</h1>
            <p class="description">{{ $talent->deskripsi }}</p>
            <div style="margin: 18px 0 0; padding: 12px 14px; border-radius: 12px; background: #f8e5ea; color: #241b31; font-weight: 700;">
                ⭐ {{ number_format($talent->averageRating(), 1) }} / 5
                <span style="opacity: 0.75; font-weight: 500;">({{ $talent->ratingCount() }} rating)</span>
            </div>
            <h2>Jadwal</h2>
            @if (auth('whisperly')->user()->role === 'user')
                <form class="booking" method="POST" action="{{ route('whisperly.bookings.store', $talent->pengguna->username) }}">
                    @csrf
                    <div class="schedule">
                        @foreach ($talent->schedules as $schedule)
                            @if ($schedule->status === 'available')
                                <input id="schedule-{{ $schedule->id }}" type="radio" name="schedule_id" value="{{ $schedule->id }}" required>
                                <label for="schedule-{{ $schedule->id }}">
                                    <span>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</span>
                                    <span class="status available">Tersedia</span>
                                </label>
                            @else
                                <div class="slot">
                                    <span>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</span>
                                    <span class="status {{ $schedule->status }}">{{ $schedule->status === 'booked' ? 'Terbooking' : 'Tidak tersedia' }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @error('schedule_id') <p class="description">{{ $message }}</p> @enderror
                    <button class="confirm" type="submit">Confirm Booking</button>
                </form>
            @else
                <div class="schedule">
                    @foreach ($talent->schedules as $schedule)
                        <div class="slot">
                            <span>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</span>
                            <span class="status {{ $schedule->status }}">{{ $schedule->status === 'available' ? 'Tersedia' : ($schedule->status === 'booked' ? 'Terbooking' : 'Tidak tersedia') }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </article>
    </main>
</body>
</html>
