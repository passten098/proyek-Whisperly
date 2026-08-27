<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderasi Menfess</title>
    <style>
        :root {
            --bg: #17172f;
            --panel: rgba(24, 24, 48, 0.88);
            --card: rgba(255,255,255,0.04);
            --text: #f8f4ee;
            --muted: #d9d2ca;
            --green: #7ed6a0;
            --red: #ff8a8a;
            --pink: #ef9bb0;
            --border: rgba(255,255,255,0.12);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }
        .shell {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 20px 60px;
        }
        h1 {
            margin: 0 0 12px;
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 700;
        }
        .subtitle {
            color: var(--muted);
            margin-bottom: 24px;
        }
        .grid {
            display: grid;
            gap: 18px;
        }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        }
        .meta {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 10px;
        }
        .badge {
            display: inline-block;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.18);
            padding: 6px 10px;
            font-size: 12px;
            background: rgba(255,255,255,0.04);
            text-transform: capitalize;
        }
        .message {
            white-space: pre-wrap;
            line-height: 1.7;
            margin: 16px 0;
            font-size: 16px;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
        }
        .btn {
            border: none;
            border-radius: 999px;
            padding: 10px 18px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .approve {
            background: var(--green);
            color: #0c2614;
        }
        .reject {
            background: var(--red);
            color: #2a0d0d;
        }
        .empty {
            padding: 24px;
            border: 1px dashed var(--border);
            border-radius: 16px;
            color: var(--muted);
            text-align: center;
        }
        @media (max-width: 640px) {
            .row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <h1>Moderasi Menfess</h1>
        <p class="subtitle">Daftar menfess yang menunggu persetujuan admin.</p>

        @if ($items->isEmpty())
            <div class="empty">Tidak ada menfess pending saat ini.</div>
        @else
            <div class="grid">
                @foreach ($items as $item)
                    <div class="card">
                        <div class="row">
                            <div>
                                <div class="meta">Pengirim: {{ $item->pengguna?->username ?? 'Tidak diketahui' }}</div>
                                <div class="meta">Dikirim: {{ $item->created_at?->translatedFormat('d M Y, H:i') ?? $item->created_at }}</div>
                            </div>
                            <span class="badge">{{ $item->kategori?->jenis_kategori ?? 'Campuran' }}</span>
                        </div>

                        <div class="message">{{ $item->isi_pesan }}</div>

                        <div class="actions">
                            <form method="POST" action="{{ route('pengaduan.approve', $item->id) }}">
                                @csrf
                                <button type="submit" class="btn approve">✓ Setujui</button>
                            </form>
                            <form method="POST" action="{{ route('pengaduan.reject', $item->id) }}">
                                @csrf
                                <button type="submit" class="btn reject">✕ Tolak</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
