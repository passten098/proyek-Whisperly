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

        * {
            box-sizing: border-box;
        }

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
            background:
                linear-gradient(
                    180deg,
                    rgba(20, 18, 43, .5),
                    rgba(20, 18, 43, .2) 45%,
                    rgba(20, 18, 43, .7)
                );
            pointer-events: none;
        }

        .shell {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding: 20px 28px 32px;
            display: flex;
            flex-direction: column;
        }

        /* =========================
           NAVBAR
        ========================= */

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

        .brand {
            color: var(--ink);
            font-size: 25px;
            font-weight: 700;
            letter-spacing: .04em;
            text-decoration: none;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .username {
            padding: 8px 15px;
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 99px;
            color: var(--lavender);
            font: 600 12px Arial, sans-serif;
        }

        /* Tombol Chat / Admin */

        .nav-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 40px;
            padding: 0 16px;

            border-radius: 99px;
            border: 1px solid rgba(255,255,255,.25);

            color: var(--ink);
            background: rgba(255,255,255,.08);

            font: 600 12px Arial, sans-serif;
            text-decoration: none;

            transition: .2s ease;
        }

        .nav-action:hover {
            background: rgba(255,255,255,.16);
            transform: translateY(-1px);
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            flex: 1;
            display: flex;
            align-items: center;

            width: min(840px, 100%);

            padding: 9vh 5vw 12vh;
        }

        .welcome {
            margin: 0 0 10px;

            color: var(--pink);

            font: 600 15px Arial, sans-serif;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        h1 {
            max-width: 760px;
            margin: 0;

            font-size: clamp(60px, 12vw, 148px);
            font-weight: 400;
            line-height: .84;
            letter-spacing: .01em;
        }

        .description {
            max-width: 520px;
            margin: 28px 0 26px;

            color: var(--muted);

            font: 16px/1.6 Arial, sans-serif;
        }

        /* =========================
           BUTTON UTAMA
        ========================= */

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .action {
            display: inline-flex;
            align-items: center;

            min-height: 48px;
            padding: 0 20px;

            border-radius: 99px;

            color: var(--navy);
            background: var(--ink);

            font: 600 13px Arial, sans-serif;
            text-decoration: none;

            transition: .2s ease;
        }

        .action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,.2);
        }

        .action.alt {
            color: var(--ink);
            background: rgba(23,23,47,.76);
            border: 1px solid rgba(255,255,255,.25);
        }

        .action.alt:hover {
            background: rgba(23,23,47,.95);
        }

        /* =========================
           NEXT
        ========================= */

        .next {
            align-self: flex-end;

            display: inline-flex;
            align-items: center;
            gap: 12px;

            padding: 13px 20px;

            border-radius: 99px;

            color: var(--navy);
            background: var(--lavender);

            font: 600 13px Arial, sans-serif;
            text-decoration: none;

            transition: .2s ease;
        }

        .next:hover {
            transform: translateY(-2px);
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 600px) {

            .shell {
                padding: 12px 14px 20px;
            }

            .nav {
                padding-left: 16px;
            }

            .brand {
                font-size: 20px;
            }

            .nav-right {
                gap: 6px;
            }

            .username {
                padding: 7px 10px;
            }

            .nav-action {
                padding: 0 11px;
                font-size: 11px;
            }

            .hero {
                padding: 12vh 4vw 8vh;
            }

            h1 {
                font-size: clamp(54px, 18vw, 90px);
            }

            .description {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

<div class="shell">

    <!-- =========================
         NAVBAR
    ========================== -->

    <header class="nav">

        <!-- Logo -->
        <a class="brand" href="{{ route('whisperly.home') }}">
            WHISPERLY
        </a>

        <div class="nav-right">

            <!-- Username -->
            <span class="username">
                {{ auth('whisperly')->user()->username }}
            </span>

            @php
                $currentUser = auth('whisperly')->user();
            @endphp

            <!-- USER & TALENT -->
            @if (in_array($currentUser->role, ['user', 'talent'], true))

                <a
                    class="nav-action"
                    href="{{ route('whisperly.chat.index') }}"
                >
                    Chat
                </a>

            @endif


            <!-- ADMIN -->
            @if ($currentUser->role === 'admin')

                <a
                    class="nav-action"
                    href="{{ route('admin.menfess.index') }}"
                >
                    Lihat Menfess
                </a>

            @endif

        </div>

    </header>


    <!-- =========================
         HERO
    ========================== -->

    <main class="hero">

        <section>

            <p class="welcome">
                Selamat datang,
                {{ ucfirst($currentUser->username) }}
            </p>

            <h1>
                Welcome to<br>
                <strong>WHISPERLY</strong>
            </h1>

            <p class="description">
                Layanan konsultasi non-profesional —
                hadir sebagai teman sehari-hari yang bisa didengar.
            </p>

            <div class="actions">

                <!-- LIHAT TALENT -->
                <a
                    class="action"
                    href="{{ route('whisperly.talents.index') }}"
                >
                    Lihat Talent
                </a>


                <!-- RUANG PENGADUAN -->
                <a
                    class="action alt"
                    href="{{ route('pengaduan') }}"
                >
                    Ruang Pengaduan
                </a>

            </div>

        </section>

    </main>


    <!-- =========================
         NEXT
    ========================== -->

    <a
        class="next"
        href="{{ route('booking') }}"
    >
        Lanjut
        <span aria-hidden="true">→</span>
    </a>

</div>

</body>
</html>