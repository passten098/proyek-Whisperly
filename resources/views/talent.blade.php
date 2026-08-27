<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Whisperly</title>
    <style>
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            display: block;
            padding: 32px;
            background: #f08baa;
            color: #321b27;
            font-family: Georgia, serif;
        }
        main { width: min(760px, 100%); margin: 22vh auto 0; }
        .eyebrow { color: #71364e; font: 600 12px Arial, sans-serif; letter-spacing: 0.16em; text-transform: uppercase; }
        h1 { max-width: 680px; margin: 18px 0 8px; font-size: clamp(42px, 8vw, 88px); font-weight: 400; line-height: 0.98; }
        p { margin: 0; color: #71364e; font: 16px Arial, sans-serif; }
        .card { margin-top: 28px; padding: 24px; border-radius: 22px; background: rgba(255,255,255,.78); box-shadow: 0 18px 40px rgba(94,45,76,.14); }
        .schedule { display: grid; gap: 8px; margin-top: 18px; }
        .slot { display: flex; justify-content: space-between; padding: 11px 13px; border-radius: 10px; background: #f8dce5; }
        .available { color: #34734a; } .unavailable { color: #9a5264; } .booked { color: #8a651e; }
        .edit { display: inline-flex; margin-top: 20px; padding: 12px 18px; border-radius: 99px; color: #fff; background: #321b27; text-decoration: none; font-weight: 700; }
    </style>
</head>
<body>
    @include('whisperly.navbar')
    <main>
        <div class="eyebrow">Whisperly / Talent</div>
        <h1>Selamat Datang, {{ ucfirst(auth('whisperly')->user()->username) }}</h1>
        <p>Talent Whisperly</p>
        <section class="card">
            <p>{{ $talent->deskripsi }}</p>
            <div class="schedule">
                @foreach ($talent->schedules as $schedule)
                    <div class="slot"><span>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</span><strong class="{{ $schedule->status }}">{{ $schedule->status }}</strong></div>
                @endforeach
            </div>
            <a class="edit" href="{{ route('talent.edit') }}">Edit</a>
            <a class="edit" href="{{ route('whisperly.chat.index') }}" style="margin-left: 12px;">Chat Masuk</a>
        </section>
    </main>
</body>
</html>