<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent | Whisperly</title>
    <style>
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; padding: 130px 28px 40px; background: #f4c5d2; color: #241b31; font-family: Arial, sans-serif; }
        main { width: min(1100px, 100%); margin: auto; }
        h1 { margin: 0 0 10px; font: 400 clamp(42px, 7vw, 78px) Georgia, serif; }
        .intro { margin: 0 0 30px; color: #65455d; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 18px; }
        .card { padding: 18px; border-radius: 22px; background: rgba(255,255,255,.74); box-shadow: 0 16px 38px rgba(94,45,76,.12); }
        .photo { width: 100%; aspect-ratio: 4/3; display: grid; place-items: center; margin-bottom: 16px; border-radius: 16px; background: #d7a9bf; color: #65455d; overflow: hidden; font: 600 12px Arial, sans-serif; text-transform: uppercase; }
        .photo img { width: 100%; height: 100%; object-fit: cover; }
        h2 { margin: 0 0 8px; font: 400 28px Georgia, serif; }
        .description { min-height: 48px; color: #65455d; line-height: 1.5; }
        .button { display: inline-flex; min-height: 42px; align-items: center; padding: 0 16px; border-radius: 99px; color: #fff; background: #241b31; font-weight: 600; text-decoration: none; }
        .back { display: inline-block; margin-bottom: 24px; color: #65455d; text-decoration: none; }
    </style>
</head>
<body>
    @include('whisperly.navbar')
    <main>
        <a class="back" href="{{ route('user') }}">← Kembali</a>
        <h1>Temukan Talent</h1>
        <p class="intro">Pilih teman cerita yang ingin kamu kenal lebih dekat.</p>
        <div class="grid">
            @forelse ($talents as $talent)
                <article class="card">
                    <div class="photo">
                        @if ($talent->photo)
                            <img src="{{ Storage::url($talent->photo) }}" alt="Foto {{ $talent->pengguna->username }}">
                        @else
                            {{ $talent->pengguna->username }}
                        @endif
                    </div>
                    <h2>{{ ucfirst($talent->pengguna->username) }}</h2>
                    <p class="description">{{ Str::limit($talent->deskripsi, 100) }}</p>
                    <a class="button" href="{{ route('whisperly.talents.show', $talent->pengguna->username) }}">Lihat Profil</a>
                </article>
            @empty
                <p>Belum ada Talent yang tersedia.</p>
            @endforelse
        </div>
    </main>
</body>
</html>
