<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

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


        html,
        body {
            margin: 0;
            width: 100%;
            min-height: 100%;
        }


        body {
            min-height: 100vh;

            color: var(--ink);

            background:
                #29253a
                url('/assets/images/jep.jpg')
                center / cover
                fixed;

            font-family:
                Georgia,
                'Times New Roman',
                serif;
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

            padding:
                0
                0
                32px;

            display: flex;

            flex-direction: column;
        }


        .nav {

            position: sticky;

            top: 0;

            z-index: 1000;

            width: 100%;

            min-height: 70px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding:
                12px
                28px;

            border-radius:
                0
                0
                32px
                32px;

            background:
                rgba(23, 23, 47, .96);

            border:
                1px solid
                rgba(255, 255, 255, .06);

            border-top: none;

            box-shadow:
                0
                16px
                34px
                rgba(16, 14, 37, .25);

            backdrop-filter:
                blur(14px);

            -webkit-backdrop-filter:
                blur(14px);
        }


        .brand {

            color:
                var(--ink);

            font-size:
                25px;

            font-weight:
                700;

            letter-spacing:
                .04em;

            text-decoration:
                none;

            transition:
                opacity .2s ease;
        }


        .brand:hover {

            opacity:
                .8;
        }


        .nav-right {

            display:
                flex;

            align-items:
                center;

            gap:
                10px;
        }


        .username {

            display:
                inline-flex;

            align-items:
                center;

            min-height:
                38px;

            padding:
                0
                15px;

            border:
                1px solid
                rgba(255,255,255,.18);

            border-radius:
                999px;

            color:
                var(--lavender);

            background:
                rgba(255,255,255,.03);

            font:
                600
                12px
                Arial,
                sans-serif;

            white-space:
                nowrap;
        }


        .menu-wrapper {

            position: relative;
        }


        .menu-button {

            width: 42px;

            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border:
                1px solid
                rgba(255,255,255,.14);

            border-radius:
                50%;

            color:
                var(--ink);

            background:
                rgba(255,255,255,.05);

            font:
                700
                22px
                Arial,
                sans-serif;

            cursor:
                pointer;

            transition:
                background .2s ease,
                transform .2s ease;
        }


        .menu-button:hover {

            background:
                rgba(255,255,255,.12);

            transform:
                translateY(-2px);
        }


        .menu-button:active {

            transform:
                translateY(0);
        }


        .dropdown-menu {

            position: absolute;

            top: calc(100% + 12px);

            right: 0;

            width: 220px;

            padding: 8px;

            border:
                1px solid
                rgba(255,255,255,.10);

            border-radius:
                18px;

            background:
                rgba(23,23,47,.98);

            box-shadow:
                0
                15px
                40px
                rgba(0,0,0,.35);

            backdrop-filter:
                blur(16px);

            -webkit-backdrop-filter:
                blur(16px);

            opacity:
                0;

            visibility:
                hidden;

            transform:
                translateY(-8px);

            transition:
                opacity .2s ease,
                visibility .2s ease,
                transform .2s ease;
        }


        .dropdown-menu.show {

            opacity:
                1;

            visibility:
                visible;

            transform:
                translateY(0);
        }


        .dropdown-item {

            display:
                flex;

            align-items:
                center;

            gap:
                11px;

            width:
                100%;

            min-height:
                42px;

            padding:
                0
                13px;

            border-radius:
                12px;

            color:
                var(--ink);

            background:
                transparent;

            font:
                600
                13px
                Arial,
                sans-serif;

            text-decoration:
                none;

            transition:
                background .2s ease,
                color .2s ease;
        }


        .dropdown-item:hover {

            color:
                var(--navy);

            background:
                var(--lavender);
        }


        .dropdown-icon {

            width:
                20px;

            text-align:
                center;

            font-size:
                16px;
        }


        .dropdown-divider {

            height:
                1px;

            margin:
                7px 4px;

            background:
                rgba(255,255,255,.10);
        }


        .hero {

            flex:
                1;

            display:
                flex;

            align-items:
                center;

            width:
                min(840px, 100%);

            padding:
                9vh
                5vw
                12vh;
        }


        .welcome {

            margin:
                0
                0
                10px;

            color:
                var(--pink);

            font:
                600
                15px
                Arial,
                sans-serif;

            letter-spacing:
                .08em;

            text-transform:
                uppercase;
        }


        h1 {

            max-width:
                760px;

            margin:
                0;

            font-size:
                clamp(
                    60px,
                    12vw,
                    148px
                );

            font-weight:
                400;

            line-height:
                .84;

            letter-spacing:
                .01em;
        }


        h1 strong {

            font-weight:
                700;
        }


        .description {

            max-width:
                520px;

            margin:
                28px
                0
                26px;

            color:
                var(--muted);

            font:
                16px/1.6
                Arial,
                sans-serif;
        }


        .actions {

            display:
                flex;

            flex-wrap:
                wrap;

            gap:
                12px;
        }


        .action {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            min-height:
                48px;

            padding:
                0
                22px;

            border:
                1px solid
                transparent;

            border-radius:
                999px;

            color:
                var(--navy);

            background:
                var(--ink);

            font:
                700
                13px
                Arial,
                sans-serif;

            text-decoration:
                none;

            cursor:
                pointer;

            box-shadow:
                0
                6px
                18px
                rgba(0,0,0,.12);

            transition:
                transform .2s ease,
                background .2s ease,
                box-shadow .2s ease;
        }


        .action:hover {

            transform:
                translateY(-2px);

            background:
                #ffffff;

            box-shadow:
                0
                10px
                24px
                rgba(0,0,0,.22);
        }


        .action.alt {

            color:
                var(--ink);

            background:
                rgba(23,23,47,.78);

            border:
                1px solid
                rgba(255,255,255,.22);

            box-shadow:
                none;
        }


        .action.alt:hover {

            background:
                rgba(23,23,47,.96);

            border-color:
                rgba(255,255,255,.35);

            box-shadow:
                0
                8px
                20px
                rgba(0,0,0,.2);
        }


        @media (max-width: 600px) {

            .nav {

                min-height:
                    60px;

                padding:
                    10px
                    16px;

                border-radius:
                    0
                    0
                    26px
                    26px;
            }


            .brand {

                font-size:
                    20px;
            }


            .nav-right {

                gap:
                    6px;
            }


            .username {

                display:
                    none;
            }


            .menu-button {

                width:
                    38px;

                height:
                    38px;

                font-size:
                    20px;
            }


            .dropdown-menu {

                width:
                    200px;

                right:
                    0;
            }


            .hero {

                width:
                    100%;

                padding:
                    12vh
                    6vw
                    8vh;
            }


            h1 {

                font-size:
                    clamp(
                        54px,
                        18vw,
                        90px
                    );
            }


            .description {

                font-size:
                    14px;
            }


            .actions {

                width:
                    100%;
            }


            .action {

                width:
                    100%;
            }

        }

    </style>

</head>


<body>

<div class="shell">


    <!-- =====================================================
         NAVBAR
    ===================================================== -->

    <header class="nav">


        <a
            class="brand"
            href="{{ route('whisperly.home') }}"
        >
            WHISPERLY
        </a>


        <div class="nav-right">


            @php

                $currentUser =
                    auth('whisperly')->user();

            @endphp


            @if ($currentUser)

                <span class="username">

                    {{ $currentUser->username }}

                </span>


                <div class="menu-wrapper">


                    <button
                        type="button"
                        class="menu-button"
                        id="menuButton"
                        aria-label="Buka menu"
                        aria-expanded="false"
                    >
                        ⋮
                    </button>


                    <div
                        class="dropdown-menu"
                        id="dropdownMenu"
                    >


                        <!-- =================================================
                             USER
                        ================================================== -->

                        @if ($currentUser->role === 'user')

                            <a
                                href="{{ route('whisperly.home') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    🏠
                                </span>

                                Home
                            </a>


                            <a
                                href="{{ route('whisperly.chat.index') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    💬
                                </span>

                                Chat
                            </a>


                            <a
                                href="{{ route('whisperly.talents.index') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    👥
                                </span>

                                Lihat Talent
                            </a>


                            <!-- PENGADUAN -->

                            <a
                                href="{{ route('pengaduan') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    📝
                                </span>

                                Pengaduan
                            </a>

                        @endif



                        <!-- =================================================
                             TALENT
                        ================================================== -->

                        @if ($currentUser->role === 'talent')

                            <a
                                href="{{ route('whisperly.home') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    🏠
                                </span>

                                Home
                            </a>


                            <a
                                href="{{ route('whisperly.talents.index') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    👥
                                </span>

                                Lihat Talent
                            </a>


                            <a
                                href="{{ route('talent.edit') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    ✏️
                                </span>

                                Edit Profil
                            </a>


                            <a
                                href="{{ route('talent') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    👤
                                </span>

                                Profil
                            </a>


                            <!-- PENGADUAN -->

                            <a
                                href="{{ route('pengaduan') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    📝
                                </span>

                                Pengaduan
                            </a>


                            <a
                                href="{{ route('whisperly.chat.index') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    💬
                                </span>

                                Chat
                            </a>

                        @endif



                        <!-- =================================================
                             ADMIN
                        ================================================== -->

                        @if ($currentUser->role === 'admin')

                            <a
                                href="{{ route('admin') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    🏠
                                </span>

                                Home
                            </a>


                            <a
                                href="{{ route('whisperly.talents.index') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    👥
                                </span>

                                Lihat Talent
                            </a>


                            <!-- ADMIN PENGADUAN -->

                            <a
                                href="{{ route('menfess.admin') }}"
                                class="dropdown-item"
                            >
                                <span class="dropdown-icon">
                                    📝
                                </span>

                                Pengaduan
                            </a>

                        @endif


                    </div>

                </div>

            @endif

        </div>

    </header>



    <!-- =====================================================
         HERO
    ===================================================== -->

    <main class="hero">

        <section>


            @if ($currentUser)

                <p class="welcome">

                    Selamat datang,
                    {{ ucfirst($currentUser->username) }}

                </p>

            @endif


            <h1>

                Welcome to<br>

                <strong>
                    WHISPERLY
                </strong>

            </h1>


            <p class="description">

                Layanan konsultasi non-profesional —
                hadir sebagai teman sehari-hari yang
                bisa didengar.

            </p>


            <div class="actions">


                <!-- =================================================
                     LIHAT TALENT
                ================================================== -->

                <a
                    class="action"
                    href="{{ route('whisperly.talents.index') }}"
                >
                    Lihat Talent
                </a>


                <!-- =================================================
                     RUANG PENGADUAN
                ================================================== -->

                @if ($currentUser && $currentUser->role === 'admin')

                    <!-- ADMIN -->

                    <a
                        class="action alt"
                        href="{{ route('menfess.admin') }}"
                    >
                        Ruang Pengaduan
                    </a>

                @else

                    <!-- USER / TALENT -->

                    <a
                        class="action alt"
                        href="{{ route('pengaduan') }}"
                    >
                        Ruang Pengaduan
                    </a>

                @endif


            </div>


        </section>

    </main>


</div>


<!-- =========================================================
     JAVASCRIPT MENU TITIK TIGA
========================================================= -->

<script>

    const menuButton =
        document.getElementById('menuButton');

    const dropdownMenu =
        document.getElementById('dropdownMenu');


    if (menuButton && dropdownMenu) {

        menuButton.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

                const isOpen =
                    dropdownMenu.classList.contains('show');


                if (isOpen) {

                    dropdownMenu.classList.remove('show');

                    menuButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                } else {

                    dropdownMenu.classList.add('show');

                    menuButton.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                }

            }
        );


        document.addEventListener(
            'click',
            function (event) {

                if (
                    !dropdownMenu.contains(event.target) &&
                    !menuButton.contains(event.target)
                ) {

                    dropdownMenu.classList.remove('show');

                    menuButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );

    }

</script>


</body>

</html>