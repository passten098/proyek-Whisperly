<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Pengaduan | Whisperly</title>
    <style>
        :root {
            --bg-a: #f4f1ff;
            --bg-b: #fdf4f7;
            --panel: #ffffff;
            --ink: #2b2b3d;
            --muted: #8b8a9c;
            --line: #ece9f7;
            --accent: #2f2b55;
            --accent-soft: #ecebfa;
            --violet: #7c6ff0;
            --pink-soft: #ffe1ea;
            --pink-ink: #c23662;
            --green-soft: #dcf6e6;
            --green-ink: #1c8a53;
            --amber-soft: #ffedd2;
            --amber-ink: #b8690e;
            --blue-soft: #dfe8ff;
            --blue-ink: #3454d1;
            --radius-lg: 22px;
            --radius-md: 16px;
            --radius-sm: 12px;
            --shadow: 0 18px 40px rgba(47, 43, 85, 0.08);
            --shadow-soft: 0 10px 24px rgba(47, 43, 85, 0.06);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(900px 500px at 85% -5%, rgba(124, 111, 240, 0.14), transparent 60%),
                radial-gradient(700px 420px at 0% 10%, rgba(255, 182, 205, 0.16), transparent 55%),
                linear-gradient(180deg, var(--bg-a), var(--bg-b) 45%, #f8f6fb 100%);
        }

        .shell {
            max-width: 1180px;
            margin: 0 auto;
            padding: 36px 20px 70px;
        }

        /* ---------- Top bar ---------- */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            padding: 10px 16px;
            background: var(--panel);
            border-radius: 999px;
            box-shadow: var(--shadow-soft);
        }

        .brand-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--muted);
            background: var(--panel);
            padding: 10px 16px;
            border-radius: 999px;
            box-shadow: var(--shadow-soft);
        }

        .brand-tag .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--violet);
        }

        .hero {
            background: var(--panel);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 30px 32px;
            margin-bottom: 22px;
        }

        .hero h1 {
            margin: 0 0 8px;
            font-size: clamp(30px, 5vw, 44px);
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--accent);
        }

        .hero p {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
        }

        /* ---------- Category pills ---------- */
        .category-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0 0;
        }

        .category-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid transparent;
            transition: all 0.15s ease;
        }

        .category-toggle:hover {
            border-color: rgba(124, 111, 240, 0.35);
        }

        .category-toggle.active {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 8px 18px rgba(47, 43, 85, 0.28);
        }

        /* ---------- Composer ---------- */
        .composer {
            padding: 26px 28px;
            border-radius: var(--radius-lg);
            background: var(--panel);
            box-shadow: var(--shadow);
            margin: 22px 0 30px;
        }

        .composer h2 {
            margin: 0 0 18px;
            font-size: 20px;
            font-weight: 800;
            color: var(--accent);
        }

        .composer form {
            display: grid;
            gap: 16px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .field select,
        .field textarea {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: var(--radius-sm);
            background: #f9f8fd;
            color: var(--ink);
            padding: 13px 16px;
            font: inherit;
            font-size: 14px;
        }

        .field select:focus,
        .field textarea:focus {
            outline: none;
            border-color: var(--violet);
            background: #fff;
        }

        .field textarea { min-height: 120px; resize: vertical; }

        .submit-btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: fit-content;
            min-height: 46px;
            padding: 0 22px;
            border: none;
            border-radius: 999px;
            background: var(--accent);
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(47, 43, 85, 0.3);
            transition: transform 0.12s ease;
        }

        .submit-btn:hover { transform: translateY(-1px); }

        .form-alert {
            margin-top: 16px;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px;
        }

        .form-alert.error { background: var(--pink-soft); color: var(--pink-ink); }
        .form-alert.success { background: var(--green-soft); color: var(--green-ink); }

        /* ---------- Feed ---------- */
        .feed {
            display: grid;
            gap: 20px;
        }

        .card {
            padding: 22px 24px;
            border-radius: var(--radius-lg);
            background: var(--panel);
            box-shadow: var(--shadow-soft);
            border-left: 5px solid var(--violet);
            transition: box-shadow 0.15s ease, transform 0.15s ease;
        }

        .card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-2px);
        }

        .card[data-tone="cinta"]      { border-left-color: var(--pink-ink); }
        .card[data-tone="horror"]     { border-left-color: var(--green-ink); }
        .card[data-tone="sedih"]      { border-left-color: var(--amber-ink); }
        .card[data-tone="campuran"]   { border-left-color: var(--blue-ink); }

        .card-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .author-block {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 15px;
            color: #fff;
            background: linear-gradient(135deg, var(--violet), #a89bff);
            flex-shrink: 0;
        }

        .author {
            font-weight: 700;
            font-size: 15px;
            color: var(--ink);
        }

        .meta {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 12px;
            margin-top: 2px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            min-height: 26px;
            padding: 0 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
            background: var(--accent-soft);
            color: var(--accent);
            white-space: nowrap;
        }

        .card[data-tone="cinta"] .chip    { background: var(--pink-soft);  color: var(--pink-ink); }
        .card[data-tone="horror"] .chip   { background: var(--green-soft); color: var(--green-ink); }
        .card[data-tone="sedih"] .chip    { background: var(--amber-soft); color: var(--amber-ink); }
        .card[data-tone="campuran"] .chip { background: var(--blue-soft);  color: var(--blue-ink); }

        .message {
            margin: 4px 0 18px;
            white-space: pre-wrap;
            color: var(--ink);
            line-height: 1.7;
            font-size: 14.5px;
        }

        .reply-box {
            border-top: 1px dashed var(--line);
            padding-top: 16px;
            margin-top: 4px;
        }

        .reply-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .comment-list {
            display: grid;
            gap: 10px;
            margin-bottom: 12px;
        }

        .comment {
            display: flex;
            gap: 10px;
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            background: #f9f8fd;
        }

        .comment .avatar {
            width: 28px;
            height: 28px;
            font-size: 11px;
            background: linear-gradient(135deg, #c8c2ff, var(--violet));
        }

        .comment strong {
            display: block;
            font-size: 13px;
            color: var(--ink);
        }

        .comment .comment-text {
            margin-top: 4px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .reply-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .reply-form textarea {
            flex: 1 1 220px;
            min-height: 52px;
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--line);
            background: #f9f8fd;
            color: var(--ink);
            font: inherit;
            font-size: 13.5px;
            resize: vertical;
        }

        .reply-form textarea:focus {
            outline: none;
            border-color: var(--violet);
            background: #fff;
        }

        .reply-form button {
            border: none;
            border-radius: 999px;
            padding: 12px 20px;
            background: var(--accent-soft);
            color: var(--accent);
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .reply-form button:hover { background: #ded9fb; }

        .empty {
            padding: 40px 24px;
            border: 2px dashed var(--line);
            border-radius: var(--radius-lg);
            color: var(--muted);
            text-align: center;
            background: rgba(255,255,255,0.6);
            font-size: 14px;
        }

        @media (max-width: 700px) {
            .topbar { flex-direction: column; align-items: flex-start; }
            .hero { padding: 24px; }
            .composer { padding: 20px; }
            .card { padding: 18px; }
            .card-head { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="topbar">
            <a class="brand-link" href="{{ route('whisperly.home') }}">&larr; Kembali</a>
            <span class="brand-tag"><span class="dot"></span>Whisperly &middot; Ruang Pengaduan</span>
        </div>

        <div class="hero">
            <h1>Ruang Pengaduan</h1>
            <p>Sampaikan cerita, harapan, atau keluhanmu dengan aman dan anonim.</p>

            <div class="category-bar">
                <a class="category-toggle {{ empty($selectedCategory) ? 'active' : '' }}" href="{{ route('pengaduan') }}">Semua</a>
                @foreach ($categories as $category)
                    <a class="category-toggle {{ $selectedCategory === $category->jenis_kategori ? 'active' : '' }}"
                       href="{{ route('pengaduan', ['kategori' => $category->jenis_kategori]) }}">
                        {{ ucfirst($category->jenis_kategori) }}
                    </a>
                @endforeach
            </div>
        </div>

        <section class="composer">
            <h2>Buat menfess</h2>
            <form method="POST" action="{{ route('pengaduan.store') }}">
                @csrf
                <div class="field">
                    <label for="id_kategori">Pilih kategori</label>
                    <select id="id_kategori" name="id_kategori" required>
                        <option value="">-- Pilih kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ ucfirst($category->jenis_kategori) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="isi_pesan">Tulis menfess</label>
                    <textarea id="isi_pesan" name="isi_pesan" placeholder="Ceritakan pengalamanmu..." required>{{ old('isi_pesan') }}</textarea>
                </div>
                <button type="submit" class="submit-btn">+ Kirim Menfess</button>
            </form>
            @if ($errors->any())
                <div class="form-alert error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            @if (session('message_success'))
                <div class="form-alert success">{{ session('message_success') }}</div>
            @endif
        </section>

        <section class="feed">
            @forelse ($items as $item)
                @php
                    $tone = strtolower($item->kategori?->jenis_kategori ?? 'campuran');
                    $initial = strtoupper(mb_substr($item->anonymous_display_name ?? '?', 0, 1));
                @endphp
                <article class="card" data-tone="{{ $tone }}">
                    <div class="card-head">
                        <div class="author-block">
                            <div class="avatar">{{ $initial }}</div>
                            <div>
                                <div class="author">{{ $item->anonymous_display_name }}</div>
                                <div class="meta">
                                    <span>{{ $item->created_at?->translatedFormat('d M, H:i') ?? $item->created_at }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="chip">{{ ucfirst($item->kategori?->jenis_kategori ?? 'Campuran') }}</span>
                    </div>

                    <div class="message">{{ $item->isi_pesan }}</div>

                    <div class="reply-box">
                        <div class="reply-count">{{ $item->comments->count() }} Balasan</div>

                        <div class="comment-list">
                            @foreach ($item->comments as $comment)
                                @php
                                    $commentName = $comment->pengguna?->username ?? 'Pengguna';
                                    $commentInitial = strtoupper(mb_substr($commentName, 0, 1));
                                @endphp
                                <div class="comment">
                                    <div class="avatar">{{ $commentInitial }}</div>
                                    <div>
                                        <strong>{{ $commentName }}</strong>
                                        <div class="comment-text">{{ $comment->komentar }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <form method="POST" action="{{ route('pengaduan.comments.store', $item->id) }}" class="reply-form">
                            @csrf
                            <textarea name="komentar" placeholder="Tulis balasan..." required></textarea>
                            <button type="submit">Balas</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="empty">Belum ada menfess yang diterima untuk kategori ini.</div>
            @endforelse
        </section>
    </div>
</body>
</html>