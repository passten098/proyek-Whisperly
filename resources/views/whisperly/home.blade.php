<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whisperly</title>
    <style>
        :root {
            --navy: #17172f;
            --ink: #fbf8f2;
            --muted: #d6d0cb;
            --pink: #e29aaf;
            --lavender: #c7b6ef;
        }
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ink);
            background: #29253a url('/assets/images/jep.jpg') center/cover fixed;
            font-family: Georgia, 'Times New Roman', serif;
        }
        body::before {
            position: fixed;
            inset: 0;
            content: '';
            background: linear-gradient(180deg, rgba(20, 18, 43, .5), rgba(20, 18, 43, .2) 45%, rgba(20, 18, 43, .7));
            pointer-events: none;
        }
        .shell { position: relative; z-index: 1; min-height: 100vh; padding: 20px 28px 32px; display: flex; flex-direction: column; }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            min-height: 70px;
            padding: 12px 16px 12px 24px;
            border-radius: 18px 18px 32px 32px;
            background: rgba(23, 23, 47, .95);
            box-shadow: 0 16px 34px rgba(16, 14, 37, .25);
        }
        .brand { color: var(--ink); font-size: 25px; font-weight: 700; letter-spacing: .04em; text-decoration: none; }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .role { padding: 8px 15px; border: 1px solid rgba(255,255,255,.18); border-radius: 99px; color: var(--lavender); font: 600 12px Arial, sans-serif; text-transform: capitalize; }
        .menu-wrap { position: relative; }
        .menu-button { width: 42px; height: 42px; border: 0; border-radius: 50%; color: #fff; background: rgba(255,255,255,.12); cursor: pointer; font-size: 17px; letter-spacing: 2px; }
        .menu { position: absolute; top: 54px; right: 0; display: none; width: 180px; padding: 8px; border: 1px solid rgba(255,255,255,.12); border-radius: 14px; background: #1c1b38; box-shadow: 0 18px 40px rgba(0,0,0,.3); }
        .menu.is-open { display: grid; animation: menu-in .16s ease-out; }
        .menu a, .menu button { padding: 11px 12px; border: 0; border-radius: 9px; color: #f7f3ed; background: transparent; font: 14px Arial, sans-serif; text-align: left; text-decoration: none; cursor: pointer; }
        .menu a:hover, .menu button:hover { background: rgba(255,255,255,.1); }
        .hero { flex: 1; display: flex; align-items: center; width: min(840px, 100%); padding: 9vh 5vw 12vh; }
        .welcome { margin: 0 0 10px; color: var(--pink); font: 600 15px Arial, sans-serif; letter-spacing: .08em; text-transform: uppercase; }
        h1 { max-width: 760px; margin: 0; font-size: clamp(60px, 12vw, 148px); font-weight: 400; line-height: .84; letter-spacing: .01em; }
        .description { max-width: 520px; margin: 28px 0 26px; color: var(--muted); font: 16px/1.6 Arial, sans-serif; }
        .actions { display: flex; flex-wrap: wrap; gap: 12px; }
        .action { display: inline-flex; align-items: center; min-height: 48px; padding: 0 20px; border-radius: 99px; color: var(--navy); background: var(--ink); font: 600 13px Arial, sans-serif; text-decoration: none; }
        .action.alt { color: var(--ink); background: rgba(23,23,47,.76); border: 1px solid rgba(255,255,255,.25); }
        .next { align-self: flex-end; display: inline-flex; align-items: center; gap: 12px; padding: 13px 20px; border-radius: 99px; color: var(--navy); background: var(--lavender); font: 600 13px Arial, sans-serif; text-decoration: none; }
        @keyframes menu-in { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 600px) { .shell { padding: 12px 14px 20px; } .nav { padding-left: 16px; } .brand { font-size: 20px; } .hero { padding: 12vh 4vw 8vh; } h1 { font-size: clamp(54px, 18vw, 90px); } .description { font-size: 14px; } }
    </style>
</head>
<body>
    <div class="shell">
        <header class="nav">
            <a class="brand" href="{{ route('whisperly.home') }}">WHISPERLY</a>
            <div class="nav-right">
                <span class="role">{{ auth('whisperly')->user()->username }}</span>
                <div class="menu-wrap">
                    <button class="menu-button" type="button" id="menu-button" aria-label="Buka menu" aria-expanded="false">•••</button>
                    <nav class="menu" id="menu" aria-label="Menu utama">
                        <a href="{{ route('whisperly.home') }}">Home</a>
                        <a href="{{ route('pengaduan') }}">Pengaduan</a>
                        <a href="{{ route('booking') }}">Booking</a>
                        <form method="POST" action="{{ route('logout.baru') }}">
                            @csrf
                            <button type="submit">Keluar</button>
                        </form>
                    </nav>
                </div>
            </div>
        </header>
        <main class="hero">
            <section>
                <p class="welcome">Selamat datang, {{ ucfirst(auth('whisperly')->user()->username) }}</p>
                <h1>Welcome to<br><strong>WHISPERLY</strong></h1>
                <p class="description">Layanan konsultasi non-profesional — hadir sebagai teman sehari-hari yang bisa didengar.</p>
                <div class="actions">
                    <a class="action" href="{{ route('whisperly.talents.index') }}">Lihat Talent</a>
                    <a class="action alt" href="{{ route('pengaduan') }}">Ruang Pengaduan</a>
                </div>
            </section>
        </main>
        <a class="next" href="{{ route('booking') }}">Lanjut <span aria-hidden="true">→</span></a>
    </div>
    <script>
        const menuButton = document.getElementById('menu-button');
        const menu = document.getElementById('menu');
        menuButton.addEventListener('click', () => {
            const open = menu.classList.toggle('is-open');
            menuButton.setAttribute('aria-expanded', open);
        });
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.menu-wrap')) {
                menu.classList.remove('is-open');
                menuButton.setAttribute('aria-expanded', 'false');
            }
        });
    </script>
</body>
</html>