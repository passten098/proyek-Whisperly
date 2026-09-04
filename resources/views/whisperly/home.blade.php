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

        /* =========================================================
           VARIABLES
        ========================================================= */

        :root {
            --bg-dark: #11101f;
            --bg-soft: #1b1930;

            --white: #fffaf7;
            --text-soft: rgba(255, 250, 247, .68);
            --text-muted: rgba(255, 250, 247, .38);

            --pink: #e7a2b6;
            --pink-soft: #f2c8d4;

            --lavender: #c9b9ef;
            --lavender-soft: #ded5f6;

            --border: rgba(255,255,255,.11);
            --glass: rgba(21, 20, 40, .91);
        }


        /* =========================================================
           RESET
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            width: 100%;
            min-height: 100%;
        }


        /* =========================================================
           BODY
        ========================================================= */

        body {
            min-height: 100vh;

            color: var(--white);

            background:
                #252238
                url('/assets/images/jep.jpg')
                center / cover
                fixed;

            font-family:
                Georgia,
                "Times New Roman",
                serif;
        }


        body::before {
            content: "";

            position: fixed;
            inset: 0;

            z-index: 0;

            background:
                linear-gradient(
                    180deg,
                    rgba(13,12,28,.72),
                    rgba(24,21,47,.46) 45%,
                    rgba(8,7,19,.88)
                );

            pointer-events: none;
        }


        /* =========================================================
           SHELL
        ========================================================= */

        .shell {
            position: relative;

            z-index: 1;

            min-height: 100vh;

            display: flex;
            flex-direction: column;
        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .nav {
            position: sticky;

            top: 0;

            z-index: 999;

            width: 100%;

            min-height: 78px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 13px 34px;

            background:
                rgba(14,13,30,.68);

            border-bottom:
                1px solid
                rgba(255,255,255,.08);

            backdrop-filter:
                blur(25px);

            -webkit-backdrop-filter:
                blur(25px);

            box-shadow:
                0 10px 35px
                rgba(0,0,0,.16);
        }


        /* =========================================================
           BRAND
        ========================================================= */

        .brand {
            position: relative;

            display: inline-flex;

            align-items: center;

            color: var(--white);

            font-size: 24px;

            font-weight: 700;

            letter-spacing: .14em;

            text-decoration: none;

            transition:
                transform .25s ease,
                color .25s ease;
        }


        .brand::before {
            content: "";

            width: 7px;
            height: 7px;

            margin-right: 10px;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    var(--pink),
                    var(--lavender)
                );

            box-shadow:
                0 0 16px
                rgba(231,162,182,.65);
        }


        .brand:hover {
            color: var(--lavender-soft);

            transform:
                translateY(-1px);
        }


        /* =========================================================
           NAV RIGHT
        ========================================================= */

        .nav-right {
            display: flex;

            align-items: center;

            gap: 10px;
        }


        /* =========================================================
           USER PILL
        ========================================================= */

        .user-pill {
            display: flex;

            align-items: center;

            gap: 9px;

            min-height: 43px;

            padding:
                5px 14px 5px 6px;

            border:
                1px solid
                rgba(255,255,255,.10);

            border-radius: 999px;

            background:
                rgba(255,255,255,.045);

            transition:
                .25s ease;
        }


        .user-pill:hover {
            background:
                rgba(255,255,255,.075);

            border-color:
                rgba(255,255,255,.17);
        }


        /* =========================================================
           USER AVATAR
        ========================================================= */

        .user-avatar {
            width: 32px;
            height: 32px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            color: #211c32;

            background:
                linear-gradient(
                    135deg,
                    var(--pink-soft),
                    var(--lavender)
                );

            font:
                700 11px
                Arial,
                sans-serif;

            box-shadow:
                0 4px 14px
                rgba(0,0,0,.18);
        }


        .username {
            max-width: 125px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color:
                rgba(255,250,247,.82);

            font:
                600 12px
                Arial,
                sans-serif;
        }


        /* =========================================================
           MENU WRAPPER
        ========================================================= */

        .menu-wrapper {
            position: relative;
        }


        /* =========================================================
           MENU BUTTON
        ========================================================= */

        .menu-button {
            position: relative;

            width: 45px;
            height: 45px;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 0;

            border:
                1px solid
                rgba(255,255,255,.12);

            border-radius: 15px;

            color: var(--white);

            background:
                rgba(255,255,255,.055);

            cursor: pointer;

            transition:
                background .25s ease,
                border-color .25s ease,
                transform .25s ease,
                box-shadow .25s ease;
        }


        .menu-button:hover {
            background:
                rgba(201,185,239,.13);

            border-color:
                rgba(201,185,239,.34);

            transform:
                translateY(-2px);

            box-shadow:
                0 12px 30px
                rgba(0,0,0,.24);
        }


        .menu-button.active {
            background:
                rgba(231,162,182,.10);

            border-color:
                rgba(231,162,182,.32);
        }


        /* =========================================================
           THREE DOTS
        ========================================================= */

        .dots {
            display: flex;

            align-items: center;
            justify-content: center;

            gap: 4px;
        }


        .dots span {
            width: 4px;
            height: 4px;

            border-radius: 50%;

            background:
                currentColor;

            transition:
                transform .25s ease,
                opacity .25s ease;
        }


        .menu-button.active .dots {
            gap: 0;
        }


        .menu-button.active
        .dots span:nth-child(1) {
            transform:
                translate(3px, 0)
                rotate(45deg);
        }


        .menu-button.active
        .dots span:nth-child(2) {
            opacity: 0;
        }


        .menu-button.active
        .dots span:nth-child(3) {
            transform:
                translate(-3px, 0)
                rotate(-45deg);
        }


        /* =========================================================
           DROPDOWN
        ========================================================= */

        .dropdown-menu {
            position: absolute;

            top:
                calc(100% + 14px);

            right: 0;

            width: 300px;

            padding: 10px;

            overflow: hidden;

            border:
                1px solid
                rgba(255,255,255,.12);

            border-radius: 25px;

            background:
                linear-gradient(
                    145deg,
                    rgba(37,35,65,.96),
                    rgba(14,13,30,.98)
                );

            box-shadow:
                0 30px 80px
                rgba(0,0,0,.48);

            backdrop-filter:
                blur(28px);

            -webkit-backdrop-filter:
                blur(28px);

            opacity: 0;

            visibility: hidden;

            transform:
                translateY(-9px)
                scale(.96);

            transform-origin:
                top right;

            transition:
                opacity .22s ease,
                visibility .22s ease,
                transform .22s ease;
        }


        .dropdown-menu.show {
            opacity: 1;

            visibility: visible;

            transform:
                translateY(0)
                scale(1);
        }


        /* =========================================================
           DECORATIVE GLOW
        ========================================================= */

        .dropdown-menu::before {
            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            top: -100px;
            right: -70px;

            border-radius: 50%;

            background:
                rgba(201,185,239,.11);

            filter:
                blur(25px);

            pointer-events: none;
        }


        .dropdown-menu::after {
            content: "";

            position: absolute;

            width: 130px;
            height: 130px;

            bottom: -90px;
            left: -60px;

            border-radius: 50%;

            background:
                rgba(231,162,182,.06);

            filter:
                blur(25px);

            pointer-events: none;
        }


        /* =========================================================
           PROFILE MINI HEADER
        ========================================================= */

        .menu-profile {
            position: relative;

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                10px 10px 13px;

            z-index: 2;
        }


        .menu-profile-avatar {
            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 13px;

            color: #241f35;

            background:
                linear-gradient(
                    135deg,
                    var(--pink-soft),
                    var(--lavender)
                );

            font:
                700 12px
                Arial,
                sans-serif;
        }


        .menu-profile-info {
            min-width: 0;

            display: flex;

            flex-direction: column;

            gap: 3px;
        }


        .menu-profile-name {
            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color:
                rgba(255,250,247,.95);

            font:
                600 13px
                Arial,
                sans-serif;
        }


        .menu-profile-role {
            color:
                rgba(255,255,255,.36);

            font:
                500 9px
                Arial,
                sans-serif;

            letter-spacing:
                .12em;

            text-transform:
                uppercase;
        }


        /* =========================================================
           DIVIDER
        ========================================================= */

        .dropdown-divider {
            position: relative;

            height: 1px;

            margin:
                0 8px 8px;

            background:
                rgba(255,255,255,.07);

            z-index: 2;
        }


        /* =========================================================
           MENU ITEM
        ========================================================= */

        .dropdown-item {
            position: relative;

            display: flex;

            align-items: center;

            gap: 12px;

            min-height: 58px;

            width: 100%;

            margin-bottom: 4px;

            padding:
                7px 9px;

            border-radius: 16px;

            color: var(--white);

            text-decoration: none;

            overflow: hidden;

            z-index: 2;

            transition:
                background .25s ease,
                transform .25s ease;
        }


        .dropdown-item:last-child {
            margin-bottom: 0;
        }


        .dropdown-item:hover {
            background:
                rgba(255,255,255,.065);

            transform:
                translateX(3px);
        }


        /* =========================================================
           ACTIVE LINE
        ========================================================= */

        .dropdown-item::before {
            content: "";

            position: absolute;

            left: 0;

            top: 10px;
            bottom: 10px;

            width: 2px;

            border-radius: 999px;

            background:
                linear-gradient(
                    180deg,
                    var(--pink),
                    var(--lavender)
                );

            opacity: 0;

            transform:
                scaleY(.3);

            transition:
                opacity .25s ease,
                transform .25s ease;
        }


        .dropdown-item:hover::before {
            opacity: 1;

            transform:
                scaleY(1);
        }


        /* =========================================================
           MENU ICON
        ========================================================= */

        .dropdown-icon {
            width: 40px;
            height: 40px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border:
                1px solid
                rgba(255,255,255,.07);

            border-radius: 12px;

            color:
                var(--lavender-soft);

            background:
                rgba(255,255,255,.045);

            transition:
                .25s ease;
        }


        .dropdown-icon svg {
            width: 18px;
            height: 18px;
        }


        .dropdown-item:hover
        .dropdown-icon {
            color:
                var(--pink-soft);

            background:
                rgba(231,162,182,.10);

            border-color:
                rgba(231,162,182,.16);

            transform:
                scale(1.06);
        }


        /* =========================================================
           MENU TEXT
        ========================================================= */

        .dropdown-text {
            display: flex;

            flex-direction: column;

            gap: 3px;

            min-width: 0;
        }


        .dropdown-text strong {
            color:
                rgba(255,250,247,.94);

            font:
                600 12px
                Arial,
                sans-serif;
        }


        .dropdown-text small {
            color:
                rgba(255,255,255,.34);

            font:
                400 9px
                Arial,
                sans-serif;

            line-height: 1.3;

            transition:
                color .25s ease;
        }


        .dropdown-item:hover
        .dropdown-text small {
            color:
                rgba(255,255,255,.52);
        }


        /* =========================================================
           ARROW
        ========================================================= */

        .dropdown-arrow {
            margin-left: auto;

            color:
                rgba(255,255,255,.20);

            font:
                400 17px
                Arial,
                sans-serif;

            transition:
                .25s ease;
        }


        .dropdown-item:hover
        .dropdown-arrow {
            color:
                var(--pink-soft);

            transform:
                translateX(4px);
        }


        /* =========================================================
           HERO
        ========================================================= */

        .hero {
            flex: 1;

            display: flex;

            align-items: center;

            width:
                min(900px, 100%);

            padding:
                9vh
                5vw
                12vh;
        }


        /* =========================================================
           WELCOME
        ========================================================= */

        .welcome {
            margin:
                0 0 12px;

            color:
                var(--pink);

            font:
                600 14px
                Arial,
                sans-serif;

            letter-spacing:
                .10em;

            text-transform:
                uppercase;
        }


        /* =========================================================
           TITLE
        ========================================================= */

        h1 {
            max-width: 780px;

            margin: 0;

            color:
                var(--white);

            font-size:
                clamp(
                    60px,
                    9vw,
                    170px
                );

            font-weight: 400;

            line-height: .84;

            letter-spacing: .01em;
        }


        h1 strong {
            font-weight: 700;
        }


        /* =========================================================
           DESCRIPTION
        ========================================================= */

        .description {
            max-width: 540px;

            margin:
                30px 0 28px;

            color:
                var(--text-soft);

            font:
                16px/1.65
                Arial,
                sans-serif;
        }


        /* =========================================================
           ACTIONS
        ========================================================= */

        .actions {
            display: flex;

            flex-wrap: wrap;

            gap: 12px;
        }


        .action {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 50px;

            padding:
                0 24px;

            border:
                1px solid
                transparent;

            border-radius: 999px;

            color:
                var(--bg-dark);

            background:
                var(--white);

            font:
                700 13px
                Arial,
                sans-serif;

            text-decoration: none;

            cursor: pointer;

            box-shadow:
                0 8px 25px
                rgba(0,0,0,.14);

            transition:
                .25s ease;
        }


        .action:hover {
            transform:
                translateY(-3px);

            background:
                #ffffff;

            box-shadow:
                0 13px 32px
                rgba(0,0,0,.25);
        }


        .action.alt {
            color:
                var(--white);

            background:
                rgba(23,23,47,.55);

            border:
                1px solid
                rgba(255,255,255,.20);

            box-shadow: none;
        }


        .action.alt:hover {
            background:
                rgba(201,185,239,.12);

            border-color:
                rgba(201,185,239,.42);

            box-shadow:
                0 10px 25px
                rgba(0,0,0,.16);
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 700px) {

            .nav {
                min-height: 68px;

                padding:
                    11px 17px;
            }


            .brand {
                font-size: 20px;

                letter-spacing:
                    .12em;
            }


            .username {
                display: none;
            }


            .user-pill {
                padding:
                    5px;
            }


            .menu-button {
                width: 43px;
                height: 43px;
            }


            .dropdown-menu {
                width:
                    min(
                        300px,
                        calc(100vw - 30px)
                    );

                right: -2px;
            }


            .hero {
                width: 100%;

                padding:
                    12vh
                    7vw
                    8vh;
            }


            h1 {
                font-size:
                    clamp(
                        54px,
                        18vw,
                        92px
                    );
            }


            .description {
                font-size: 14px;

                max-width: 450px;
            }


            .actions {
                width: 100%;
            }


            .action {
                width: 100%;
            }
        }


        @media (max-width: 420px) {

            .nav {
                padding:
                    10px 14px;
            }


            .brand {
                font-size: 18px;
            }


            .dropdown-menu {
                width:
                    calc(100vw - 24px);

                right: -3px;
            }


            .hero {
                padding:
                    10vh
                    6vw
                    8vh;
            }


            .welcome {
                font-size: 11px;
            }


            h1 {
                font-size:
                    clamp(
                        48px,
                        17vw,
                        78px
                    );
            }


            .description {
                margin-top: 24px;

                font-size: 13px;
            }
        }

    </style>
</head>


<body>

<div class="shell">


    <!-- =========================================================
         NAVBAR
    ========================================================== -->

    <header class="nav">


        <!-- BRAND -->

        <a
            class="brand"
            href="{{ route('whisperly.home') }}"
        >
            WHISPERLY
        </a>


        <!-- RIGHT NAV -->

        <div class="nav-right">

            @php
                $currentUser =
                    auth('whisperly')->user();
            @endphp


            @if ($currentUser)


                <!-- USER -->

                <div class="user-pill">

                    <div class="user-avatar">
                        {{ strtoupper(
                            substr(
                                $currentUser->username,
                                0,
                                1
                            )
                        ) }}
                    </div>

                    <span class="username">
                        {{ $currentUser->username }}
                    </span>

                </div>


                <!-- MENU -->

                <div class="menu-wrapper">


                    <!-- MENU BUTTON -->

                    <button
                        type="button"
                        class="menu-button"
                        id="menuButton"
                        aria-label="Buka menu"
                        aria-expanded="false"
                    >

                        <span class="dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>

                    </button>


                    <!-- =================================================
                         DROPDOWN
                    ================================================== -->

                    <div
                        class="dropdown-menu"
                        id="dropdownMenu"
                    >


                        <!-- MINI PROFILE -->

                        <div class="menu-profile">

                            <div class="menu-profile-avatar">
                                {{ strtoupper(
                                    substr(
                                        $currentUser->username,
                                        0,
                                        1
                                    )
                                ) }}
                            </div>

                            <div class="menu-profile-info">

                                <span class="menu-profile-name">
                                    {{ $currentUser->username }}
                                </span>

                                <span class="menu-profile-role">
                                    {{ $currentUser->role }}
                                </span>

                            </div>

                        </div>


                        <div class="dropdown-divider"></div>


                        <!-- =================================================
                             USER MENU
                        ================================================== -->

                        @if ($currentUser->role === 'user')


                            <!-- HOME -->

                            <a
                                href="{{ route('whisperly.home') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <path
                                            d="M3.5 10.7L12 3.7L20.5 10.7V20H14.8V14.4H9.2V20H3.5V10.7Z"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linejoin="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Home
                                    </strong>

                                    <small>
                                        Kembali ke halaman utama
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- CHAT -->

                            <a
                                href="{{ route('whisperly.chat.index') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <path
                                            d="M5 5.5H19V16H9L5 19V5.5Z"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M8.5 9.5H15.5"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                        <path
                                            d="M8.5 12.5H13"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Chat
                                    </strong>

                                    <small>
                                        Mulai percakapan
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- TALENT -->

                            <a
                                href="{{ route('whisperly.talents.index') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <circle
                                            cx="12"
                                            cy="8"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                        />

                                        <path
                                            d="M5.5 20C5.9 16.1 8 14 12 14C16 14 18.1 16.1 18.5 20"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Lihat Talent
                                    </strong>

                                    <small>
                                        Temukan talent yang tersedia
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- PENGADUAN -->

                            <a
                                href="{{ route('pengaduan') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <path
                                            d="M5 4.5H19V16H9L5 19.5V4.5Z"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M8.5 9H15.5"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                        <path
                                            d="M8.5 12H13"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Pengaduan
                                    </strong>

                                    <small>
                                        Sampaikan ceritamu
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                        @endif



                        <!-- =================================================
                             TALENT MENU
                        ================================================== -->

                        @if ($currentUser->role === 'talent')


                            <!-- HOME -->

                            <a
                                href="{{ route('whisperly.home') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <path
                                            d="M3.5 10.7L12 3.7L20.5 10.7V20H14.8V14.4H9.2V20H3.5V10.7Z"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linejoin="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Home
                                    </strong>

                                    <small>
                                        Kembali ke halaman utama
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- TALENT -->

                            <a
                                href="{{ route('whisperly.talents.index') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <circle
                                            cx="12"
                                            cy="8"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                        />

                                        <path
                                            d="M5.5 20C5.9 16.1 8 14 12 14C16 14 18.1 16.1 18.5 20"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Lihat Talent
                                    </strong>

                                    <small>
                                        Lihat daftar talent
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- EDIT PROFILE -->

                            <a
                                href="{{ route('talent.edit') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <path
                                            d="M4 20L8.2 19.1L18.8 8.5C19.6 7.7 19.6 6.4 18.8 5.6C18 4.8 16.7 4.8 15.9 5.6L5.3 16.2L4 20Z"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M14.8 6.7L17.3 9.2"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Edit Profil
                                    </strong>

                                    <small>
                                        Perbarui profilmu
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- PROFILE -->

                            <a
                                href="{{ route('talent') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <circle
                                            cx="12"
                                            cy="8"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                        />

                                        <path
                                            d="M5.5 20C5.9 16.1 8 14 12 14C16 14 18.1 16.1 18.5 20"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Profil
                                    </strong>

                                    <small>
                                        Lihat profil talent
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- PENGADUAN -->

                            <a
                                href="{{ route('pengaduan') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <path
                                            d="M5 4.5H19V16H9L5 19.5V4.5Z"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M8.5 9H15.5"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                        <path
                                            d="M8.5 12H13"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Pengaduan
                                    </strong>

                                    <small>
                                        Sampaikan ceritamu
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- CHAT -->

                            <a
                                href="{{ route('whisperly.chat.index') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <path
                                            d="M5 5.5H19V16H9L5 19V5.5Z"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M8.5 9.5H15.5"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                        <path
                                            d="M8.5 12.5H13"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Chat
                                    </strong>

                                    <small>
                                        Mulai percakapan
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                        @endif



                        <!-- =================================================
                             ADMIN MENU
                        ================================================== -->

                        @if ($currentUser->role === 'admin')


                            <!-- HOME -->

                            <a
                                href="{{ route('admin') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <path
                                            d="M3.5 10.7L12 3.7L20.5 10.7V20H14.8V14.4H9.2V20H3.5V10.7Z"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linejoin="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Home
                                    </strong>

                                    <small>
                                        Dashboard administrator
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- TALENT -->

                            <a
                                href="{{ route('whisperly.talents.index') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <circle
                                            cx="12"
                                            cy="8"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                        />

                                        <path
                                            d="M5.5 20C5.9 16.1 8 14 12 14C16 14 18.1 16.1 18.5 20"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Lihat Talent
                                    </strong>

                                    <small>
                                        Kelola daftar talent
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                            <!-- PENGADUAN -->

                            <a
                                href="{{ route('admin.menfess.index') }}"
                                class="dropdown-item"
                            >

                                <span class="dropdown-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >

                                        <path
                                            d="M5 4.5H19V16H9L5 19.5V4.5Z"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M8.5 9H15.5"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                        <path
                                            d="M8.5 12H13"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </span>


                                <span class="dropdown-text">

                                    <strong>
                                        Pengaduan
                                    </strong>

                                    <small>
                                        Kelola ruang pengaduan
                                    </small>

                                </span>


                                <span class="dropdown-arrow">
                                    →
                                </span>

                            </a>


                        @endif


                    </div>

                </div>

            @endif

        </div>

    </header>



    <!-- =========================================================
         HERO
    ========================================================== -->

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


                <!-- LIHAT TALENT -->

                <a
                    class="action"
                    href="{{ route('whisperly.talents.index') }}"
                >
                    Lihat Talent
                </a>


                <!-- RUANG PENGADUAN -->

                @if (
                    $currentUser &&
                    $currentUser->role === 'admin'
                )

                    <a
                        class="action alt"
                        href="{{ route('admin.menfess.index') }}"
                    >
                        Ruang Pengaduan
                    </a>

                @else

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
     JAVASCRIPT
========================================================= -->

<script>

    const menuButton =
        document.getElementById('menuButton');

    const dropdownMenu =
        document.getElementById('dropdownMenu');


    if (
        menuButton &&
        dropdownMenu
    ) {


        /* =====================================================
           TOGGLE MENU
        ===================================================== */

        menuButton.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

                const isOpen =
                    dropdownMenu.classList.contains('show');


                if (isOpen) {

                    dropdownMenu.classList.remove('show');

                    menuButton.classList.remove('active');

                    menuButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                } else {

                    dropdownMenu.classList.add('show');

                    menuButton.classList.add('active');

                    menuButton.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                }

            }
        );


        /* =====================================================
           CLICK OUTSIDE
        ===================================================== */

        document.addEventListener(
            'click',
            function (event) {

                if (
                    !dropdownMenu.contains(event.target)
                    &&
                    !menuButton.contains(event.target)
                ) {

                    dropdownMenu.classList.remove('show');

                    menuButton.classList.remove('active');

                    menuButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );


        /* =====================================================
           ESCAPE
        ===================================================== */

        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape'
                ) {

                    dropdownMenu.classList.remove('show');

                    menuButton.classList.remove('active');

                    menuButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );


        /* =====================================================
           CLOSE AFTER CLICK MENU
        ===================================================== */

        const menuItems =
            dropdownMenu.querySelectorAll(
                '.dropdown-item'
            );


        menuItems.forEach(
            function (item) {

                item.addEventListener(
                    'click',
                    function () {

                        dropdownMenu.classList.remove(
                            'show'
                        );

                        menuButton.classList.remove(
                            'active'
                        );

                        menuButton.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }
                );

            }
        );

    }

</script>


</body>

</html>