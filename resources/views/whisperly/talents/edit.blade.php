<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Talent</title>
    <style>
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; padding: 130px 28px 40px; background: #f08baa; color: #321b27; font-family: Arial, sans-serif; }
        main { width: min(800px, 100%); margin: auto; }
        .card { padding: clamp(22px, 5vw, 48px); border-radius: 24px; background: rgba(255,255,255,.84); box-shadow: 0 20px 50px rgba(94,45,76,.15); }
        h1 { margin: 0 0 28px; font: 400 clamp(40px, 7vw, 70px) Georgia, serif; }
        label { display: block; margin: 18px 0 8px; color: #65455d; font-weight: 700; }
        textarea, input[type=file], select { width: 100%; padding: 12px; border: 1px solid rgba(50,27,39,.2); border-radius: 12px; background: #fff9fb; font: inherit; }
        textarea { min-height: 130px; resize: vertical; }
        .schedule { display: grid; gap: 10px; margin-top: 10px; }
        .slot { display: grid; grid-template-columns: 1fr minmax(150px, 200px); align-items: center; gap: 16px; padding: 10px 14px; border-radius: 12px; background: #f8dce5; }
        .button { margin-top: 26px; padding: 13px 22px; border: 0; border-radius: 99px; color: #fff; background: #321b27; cursor: pointer; font-weight: 700; }
        .back { display: inline-block; margin-bottom: 22px; color: #65455d; text-decoration: none; }
        .error { color: #a1324e; font-size: 13px; }
        @media (max-width: 560px) { body { padding: 110px 14px 24px; } .slot { grid-template-columns: 1fr; gap: 7px; } }
    </style>
</head>
<body>
    @include('whisperly.navbar')
    <main>
        <a class="back" href="{{ route('talent') }}">← Profil Saya</a>
        <form class="card" method="POST" action="{{ route('talent.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1>Edit Profil</h1>
            <label for="photo">Foto Profil</label>
            <input id="photo" type="file" name="photo" accept="image/*">
            @error('photo') <div class="error">{{ $message }}</div> @enderror
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" required>{{ old('description', $talent->deskripsi) }}</textarea>
            @error('description') <div class="error">{{ $message }}</div> @enderror
            <label>Jadwal</label>
            <div class="schedule">
                @foreach ($talent->schedules as $schedule)
                    <div class="slot">
                        <span>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</span>
                        <select name="schedule[{{ $schedule->id }}]">
                            @foreach (['available' => 'Tersedia', 'unavailable' => 'Tidak tersedia', 'booked' => 'Terbooking'] as $value => $label)
                                <option value="{{ $value }}" @selected($schedule->status === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
            @error('schedule') <div class="error">{{ $message }}</div> @enderror
            <button class="button" type="submit">Simpan</button>
        </form>
    </main>
</body>
</html>
