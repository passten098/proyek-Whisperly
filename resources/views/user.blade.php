<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Whisperly</title>
    <style>
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; color: #fbf8f2; background: #29253a url('/assets/images/jep.jpeg') center/cover fixed; font-family: Georgia, 'Times New Roman', serif; }
        body::before { position: fixed; inset: 0; content: ''; background: rgba(20, 18, 43, .58); pointer-events: none; }
        .shell { position: relative; z-index: 1; min-height: 100vh; padding: 20px 28px; }
        .nav { display: flex; align-items: center; justify-content: space-between; min-height: 70px; padding: 12px 16px 12px 24px; border-radius: 18px 18px 32px 32px; background: #17172f; }
        .brand { color: #fbf8f2; font-size: 25px; font-weight: 700; letter-spacing: .04em; text-decoration: none; }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .username { padding: 8px 15px; border: 1px solid rgba(255,255,255,.18); border-radius: 99px; color: #c7b6ef; font: 600 12px Arial, sans-serif; }
        .menu-wrap { position: relative; }
        .menu-button { width: 42px; height: 42px; border: 0; border-radius: 50%; color: #fff; background: rgba(255,255,255,.12); cursor: pointer; letter-spacing: 2px; }
        .menu { position: absolute; top: 54px; right: 0; display: none; width: 180px; padding: 8px; border-radius: 14px; background: #1c1b38; }
        .menu.is-open { display: grid; }
        .menu a, .menu button { padding: 11px 12px; border: 0; border-radius: 9px; color: #f7f3ed; background: transparent; font: 14px Arial, sans-serif; text-align: left; text-decoration: none; cursor: pointer; }
        .menu a:hover, .menu button:hover { background: rgba(255,255,255,.1); }
        main { position: relative; z-index: 1; max-width: 760px; padding: 18vh 5vw; }
        .eyebrow { color: #e29aaf; font: 600 12px Arial, sans-serif; letter-spacing: .16em; text-transform: uppercase; }
        h1 { margin: 18px 0 8px; font-size: clamp(48px, 8vw, 88px); font-weight: 400; line-height: .98; }
        p { color: #d6d0cb; font: 16px/1.6 Arial, sans-serif; }
        .talent-link { display: inline-flex; margin-top: 24px; padding: 13px 20px; border-radius: 99px; color: #17172f; background: #c7b6ef; font: 600 13px Arial, sans-serif; text-decoration: none; }
        @media (max-width: 600px) { .shell { padding: 12px 14px; } .nav { padding-left: 16px; } .brand { font-size: 20px; } main { padding: 16vh 4vw; } }
    </style>
</head>
<body>
    <div class="shell">
        <header class="nav">
            <a class="brand" href="{{ route('whisperly.home') }}">WHISPERLY</a>
            <div class="nav-right">
                <span class="username">{{ auth('whisperly')->user()->username }}</span>
                <div class="menu-wrap">
                    <button class="menu-button" type="button" id="menu-button">•••</button>
                    <nav class="menu" id="menu">
                        <a href="{{ route('whisperly.home') }}">Home</a>
                        <a href="{{ route('pengaduan') }}">Pengaduan</a>
                        <a href="{{ route('booking') }}">Booking</a>
                        <a href="{{ route('whisperly.chat.index') }}">Chat</a>
                        <form method="POST" action="{{ route('logout.baru') }}">@csrf<button type="submit">Keluar</button></form>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            <div class="eyebrow">Whisperly / User</div>
            <h1>Selamat Datang, {{ ucfirst(auth('whisperly')->user()->username) }}</h1>
            <p>Ruang aman untuk didengar dan menemukan teman sehari-hari.</p>
            <a class="talent-link" href="{{ route('whisperly.talents.index') }}">Lihat Talent</a>
        </main>
    </div>
    <script>
        const button = document.getElementById('menu-button');
        const menu = document.getElementById('menu');
        button.addEventListener('click', () => menu.classList.toggle('is-open'));
    </script>
</body>
</html>