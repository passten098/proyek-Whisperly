<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Admin | Whisperly</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        :root {
            --bg: #080714;
            --bg-2: #100c21;

            --pink: #e7a2b6;
            --pink-light: #f4c4d4;

            --lavender: #c9b9ef;
            --lavender-light: #e3d9ff;

            --gold: #e8c27a;
            --gold-light: #f7dfa6;

            --white: #fffafc;
            --muted: rgba(255, 250, 252, .62);

            --border: rgba(255, 255, 255, .1);

            --glass:
                rgba(18, 15, 36, .72);

            --gradient:
                linear-gradient(
                    135deg,
                    #e7a2b6 0%,
                    #c9b9ef 48%,
                    #e8c27a 100%
                );
        }


        /* =========================================================
           RESET
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;

            color: var(--white);

            font-family:
                'Plus Jakarta Sans',
                sans-serif;

            -webkit-font-smoothing: antialiased;

            overflow-x: hidden;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(231, 162, 182, .18),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 5%,
                    rgba(201, 185, 239, .22),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 50% 100%,
                    rgba(232, 194, 122, .11),
                    transparent 35%
                ),
                radial-gradient(
                    circle at 30% 60%,
                    rgba(125, 92, 190, .10),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #080714,
                    #100b20 45%,
                    #0b0918
                );

            position: relative;
        }


        /* =========================================================
           BACKGROUND AURORA
        ========================================================= */

        body::before {
            content: "";

            position: fixed;

            width: 700px;
            height: 700px;

            top: -280px;
            right: -200px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(201, 185, 239, .20),
                    rgba(231, 162, 182, .08) 35%,
                    transparent 70%
                );

            filter: blur(30px);

            animation:
                auroraFloat 12s ease-in-out infinite alternate;

            pointer-events: none;

            z-index: 0;
        }


        body::after {
            content: "";

            position: fixed;

            width: 650px;
            height: 650px;

            bottom: -320px;
            left: -220px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(231, 162, 182, .16),
                    rgba(232, 194, 122, .06) 40%,
                    transparent 70%
                );

            filter: blur(35px);

            animation:
                auroraFloat2 15s ease-in-out infinite alternate;

            pointer-events: none;

            z-index: 0;
        }


        @keyframes auroraFloat {
            from {
                transform: translate(0, 0) scale(1);
            }

            to {
                transform: translate(-90px, 70px) scale(1.15);
            }
        }


        @keyframes auroraFloat2 {
            from {
                transform: translate(0, 0) scale(1);
            }

            to {
                transform: translate(100px, -80px) scale(1.2);
            }
        }


        /* =========================================================
           PARTICLES
        ========================================================= */

        .particles {
            position: fixed;
            inset: 0;

            overflow: hidden;

            pointer-events: none;

            z-index: 1;
        }


        .particle {
            position: absolute;

            width: 3px;
            height: 3px;

            border-radius: 50%;

            background: var(--lavender-light);

            box-shadow:
                0 0 8px var(--lavender),
                0 0 18px rgba(201, 185, 239, .5);

            opacity: .45;

            animation:
                particleFloat linear infinite;
        }


        .particle:nth-child(1) {
            left: 8%;
            top: 25%;
            animation-duration: 13s;
        }

        .particle:nth-child(2) {
            left: 18%;
            top: 75%;
            animation-duration: 18s;
        }

        .particle:nth-child(3) {
            left: 32%;
            top: 15%;
            animation-duration: 15s;
        }

        .particle:nth-child(4) {
            left: 48%;
            top: 82%;
            animation-duration: 20s;
        }

        .particle:nth-child(5) {
            left: 62%;
            top: 20%;
            animation-duration: 16s;
        }

        .particle:nth-child(6) {
            left: 76%;
            top: 70%;
            animation-duration: 14s;
        }

        .particle:nth-child(7) {
            left: 88%;
            top: 30%;
            animation-duration: 19s;
        }

        .particle:nth-child(8) {
            left: 94%;
            top: 85%;
            animation-duration: 17s;
        }


        @keyframes particleFloat {
            0% {
                transform:
                    translateY(40px)
                    scale(.7);

                opacity: 0;
            }

            20% {
                opacity: .6;
            }

            50% {
                transform:
                    translateY(-80px)
                    scale(1);
            }

            80% {
                opacity: .35;
            }

            100% {
                transform:
                    translateY(-160px)
                    scale(.5);

                opacity: 0;
            }
        }


        /* =========================================================
           MAIN
        ========================================================= */

        .admin-profile {
            position: relative;

            z-index: 2;

            width: min(1080px, 100%);

            margin: 0 auto;

            padding:
                70px 24px 100px;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .admin-header {
            text-align: center;

            margin-bottom: 48px;

            animation:
                fadeUp .8s ease both;
        }


        .admin-eyebrow {
            display: inline-flex;

            align-items: center;
            gap: 12px;

            color: var(--lavender-light);

            font-size: 10px;
            font-weight: 800;

            letter-spacing: .28em;

            text-transform: uppercase;
        }


        .admin-eyebrow::before,
        .admin-eyebrow::after {
            content: "";

            width: 34px;
            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    var(--pink)
                );
        }


        .admin-eyebrow::after {
            background:
                linear-gradient(
                    90deg,
                    var(--lavender),
                    transparent
                );
        }


        h1 {
            margin:
                18px 0 12px;

            font-family:
                'Playfair Display',
                Georgia,
                serif;

            font-size:
                clamp(42px, 7vw, 64px);

            font-weight: 600;

            letter-spacing: -.025em;

            background:
                linear-gradient(
                    120deg,
                    #fff 10%,
                    var(--pink-light) 42%,
                    var(--lavender-light) 70%,
                    var(--gold-light)
                );

            -webkit-background-clip: text;
            background-clip: text;

            color: transparent;

            filter:
                drop-shadow(
                    0 8px 30px rgba(201,185,239,.12)
                );
        }


        .admin-header p {
            max-width: 560px;

            margin: 0 auto;

            color: var(--muted);

            font-size: 13px;

            line-height: 1.8;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .admin-card {
            position: relative;

            display: grid;

            grid-template-columns:
                310px
                1fr;

            overflow: hidden;

            border-radius: 34px;

            border:
                1px solid
                rgba(255,255,255,.1);

            background:
                linear-gradient(
                    145deg,
                    rgba(35,30,62,.78),
                    rgba(13,11,28,.82)
                );

            box-shadow:
                0 50px 120px rgba(0,0,0,.55),
                0 0 0 1px rgba(255,255,255,.02),
                inset 0 1px 0 rgba(255,255,255,.07);

            backdrop-filter:
                blur(30px);

            transform-style: preserve-3d;

            transition:
                transform .25s ease,
                box-shadow .3s ease;

            animation:
                fadeUp .9s .1s ease both;
        }


        .admin-card:hover {
            box-shadow:
                0 60px 140px rgba(0,0,0,.6),
                0 0 80px rgba(201,185,239,.07),
                inset 0 1px 0 rgba(255,255,255,.1);
        }


        /* TOP LIGHT */

        .admin-card::before {
            content: "";

            position: absolute;

            top: 0;
            left: 8%;
            right: 8%;

            height: 2px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    var(--pink),
                    var(--lavender),
                    var(--gold),
                    transparent
                );

            box-shadow:
                0 0 18px rgba(231,162,182,.5);

            z-index: 5;
        }


        /* SHIMMER */

        .admin-card::after {
            content: "";

            position: absolute;

            width: 180px;
            height: 500px;

            top: -150px;
            left: -300px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.06),
                    transparent
                );

            transform:
                rotate(25deg);

            animation:
                shimmer 7s ease-in-out infinite;

            pointer-events: none;
        }


        @keyframes shimmer {
            0% {
                left: -300px;
            }

            45%,
            100% {
                left: 120%;
            }
        }


        /* =========================================================
           IDENTITY
        ========================================================= */

        .identity {
            position: relative;

            padding:
                52px 32px;

            text-align: center;

            border-right:
                1px solid
                rgba(255,255,255,.08);

            background:
                radial-gradient(
                    circle at 50% 25%,
                    rgba(201,185,239,.09),
                    transparent 40%
                );
        }


        .identity::before {
            content: "";

            position: absolute;

            top: 15%;
            left: 0;

            width: 2px;
            height: 70%;

            background:
                linear-gradient(
                    transparent,
                    var(--pink),
                    var(--lavender),
                    transparent
                );

            opacity: .45;
        }


        /* =========================================================
           AVATAR
        ========================================================= */

        .avatar-wrap {
            position: relative;

            width: 190px;
            height: 190px;

            margin:
                0 auto 25px;
        }


        /* OUTER GLOW */

        .avatar-wrap::before {
            content: "";

            position: absolute;

            inset: -10px;

            border-radius: 50%;

            background:
                conic-gradient(
                    from 0deg,
                    var(--pink),
                    var(--lavender),
                    var(--gold),
                    var(--pink)
                );

            filter:
                blur(18px);

            opacity: .45;

            animation:
                pulseGlow 4s ease-in-out infinite;
        }


        /* ROTATING RING */

        .avatar-ring {
            position: absolute;

            inset: 0;

            border-radius: 50%;

            background:
                conic-gradient(
                    from 0deg,
                    transparent 0deg,
                    var(--pink) 60deg,
                    var(--lavender) 150deg,
                    var(--gold) 230deg,
                    transparent 310deg
                );

            animation:
                rotateRing 7s linear infinite;
        }


        .avatar-ring::before {
            content: "";

            position: absolute;

            inset: 5px;

            border-radius: 50%;

            background:
                #0c0a19;
        }


        .avatar-inner {
            position: absolute;

            inset: 14px;

            z-index: 2;

            display: flex;

            align-items: center;
            justify-content: center;

            overflow: hidden;

            border-radius: 50%;

            border:
                3px solid
                rgba(255,255,255,.1);

            background:
                radial-gradient(
                    circle at 30% 20%,
                    #292248,
                    #121024 70%
                );

            color:
                var(--lavender-light);

            font:
                700 54px
                'Playfair Display',
                Georgia,
                serif;

            box-shadow:
                inset 0 0 30px rgba(0,0,0,.5),
                0 15px 40px rgba(0,0,0,.4);
        }


        .avatar-inner img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            transition:
                transform .6s ease;
        }


        .avatar-wrap:hover .avatar-inner img {
            transform:
                scale(1.08);
        }


        /* ORBIT */

        .orbit {
            position: absolute;

            inset: -9px;

            border:
                1px dashed
                rgba(201,185,239,.35);

            border-radius: 50%;

            animation:
                rotateRing 14s linear infinite reverse;
        }


        .orbit-dot {
            position: absolute;

            top: 7px;
            left: 50%;

            width: 8px;
            height: 8px;

            margin-left: -4px;

            border-radius: 50%;

            background:
                var(--gold);

            box-shadow:
                0 0 15px var(--gold);
        }


        @keyframes rotateRing {
            to {
                transform:
                    rotate(360deg);
            }
        }


        @keyframes pulseGlow {
            0%,
            100% {
                transform: scale(.95);
                opacity: .35;
            }

            50% {
                transform: scale(1.08);
                opacity: .7;
            }
        }


        .avatar-status {
            position: absolute;

            right: 9px;
            bottom: 18px;

            width: 20px;
            height: 20px;

            border:
                3px solid
                #0c0a19;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #f4c4d4,
                    #e8c27a
                );

            box-shadow:
                0 0 18px
                rgba(232,194,122,.65);

            z-index: 4;
        }


        .avatar-status::after {
            content: "";

            position: absolute;

            inset: 5px;

            border-radius: 50%;

            background:
                #211a2c;

            animation:
                statusPulse 2s ease-in-out infinite;
        }


        @keyframes statusPulse {
            0%,
            100% {
                opacity: .3;
            }

            50% {
                opacity: 1;
            }
        }


        /* =========================================================
           IDENTITY TEXT
        ========================================================= */

        .identity-tag {
            display: block;

            margin-bottom: 8px;

            color:
                var(--pink);

            font-size: 9px;

            font-weight: 800;

            letter-spacing: .25em;

            text-transform:
                uppercase;
        }


        .identity h2 {
            margin:
                0 0 9px;

            font:
                600 25px
                'Playfair Display',
                Georgia,
                serif;
        }


        .identity p {
            margin:
                0 0 19px;

            color:
                var(--muted);

            font-size:
                12px;

            overflow-wrap:
                anywhere;
        }


        .role {
            display: inline-flex;

            align-items: center;
            gap: 7px;

            padding:
                8px 15px;

            border:
                1px solid
                rgba(231,162,182,.3);

            border-radius:
                999px;

            color:
                var(--pink-light);

            background:
                rgba(231,162,182,.06);

            box-shadow:
                inset 0 1px 0 rgba(255,255,255,.05);

            font-size:
                9px;

            font-weight:
                800;

            letter-spacing:
                .16em;

            text-transform:
                uppercase;
        }


        .role::before {
            content: "";

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background:
                var(--gold);

            box-shadow:
                0 0 9px
                var(--gold);
        }


        /* =========================================================
           FORM PANEL
        ========================================================= */

        .form-panel {
            min-width: 0;

            padding:
                52px 48px;
        }


        .form-panel h2 {
            margin:
                0 0 7px;

            font:
                600 27px
                'Playfair Display',
                Georgia,
                serif;
        }


        .subheading {
            margin:
                0 0 28px;

            color:
                var(--muted);

            font-size:
                12px;

            line-height:
                1.7;
        }


        /* SUCCESS */

        .success {
            margin-bottom:
                20px;

            padding:
                13px 16px;

            border:
                1px solid
                rgba(167,243,208,.2);

            border-radius:
                13px;

            color:
                #a7f3d0;

            background:
                rgba(167,243,208,.05);

            box-shadow:
                inset 0 1px 0 rgba(255,255,255,.03);

            font-size:
                12px;

            animation:
                fadeUp .4s ease both;
        }


        /* =========================================================
           FIELD
        ========================================================= */

        .field {
            margin-bottom:
                20px;

            animation:
                fadeUp .55s ease both;
        }


        .field:nth-of-type(1) {
            animation-delay: .1s;
        }

        .field:nth-of-type(2) {
            animation-delay: .17s;
        }

        .field:nth-of-type(3) {
            animation-delay: .24s;
        }

        .field:nth-of-type(4) {
            animation-delay: .31s;
        }

        .field:nth-of-type(5) {
            animation-delay: .38s;
        }


        label {
            display: block;

            margin-bottom:
                8px;

            color:
                rgba(255,250,252,.58);

            font-size:
                10px;

            font-weight:
                800;

            letter-spacing:
                .1em;

            text-transform:
                uppercase;
        }


        .field-shell {
            position:
                relative;

            padding:
                1px;

            border-radius:
                14px;

            background:
                linear-gradient(
                    110deg,
                    rgba(231,162,182,.25),
                    rgba(201,185,239,.12),
                    rgba(232,194,122,.2)
                );

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }


        .field-shell:hover {
            transform:
                translateY(-1px);

            background:
                linear-gradient(
                    110deg,
                    rgba(231,162,182,.55),
                    rgba(201,185,239,.35),
                    rgba(232,194,122,.45)
                );

            box-shadow:
                0 8px 25px
                rgba(0,0,0,.18);
        }


        .field-shell:focus-within {
            background:
                linear-gradient(
                    110deg,
                    var(--pink),
                    var(--lavender),
                    var(--gold)
                );

            box-shadow:
                0 0 25px
                rgba(201,185,239,.12);
        }


        input,
        textarea {
            width:
                100%;

            border:
                none;

            outline:
                none;

            border-radius:
                13px;

            padding:
                14px 16px;

            color:
                var(--white);

            background:
                rgba(12,10,26,.94);

            font:
                inherit;

            font-size:
                13px;
        }


        input::placeholder,
        textarea::placeholder {
            color:
                rgba(255,255,255,.3);
        }


        input[readonly] {
            color:
                rgba(255,255,255,.55);

            cursor:
                not-allowed;
        }


        textarea {
            min-height:
                125px;

            resize:
                vertical;

            line-height:
                1.7;
        }


        input[type="file"] {
            padding:
                11px 12px;

            color:
                rgba(255,255,255,.55);

            cursor:
                pointer;
        }


        input[type="file"]::file-selector-button {
            margin-right:
                12px;

            padding:
                8px 13px;

            border:
                none;

            border-radius:
                8px;

            color:
                #17142a;

            background:
                linear-gradient(
                    135deg,
                    var(--pink),
                    var(--lavender)
                );

            font:
                700 10px
                'Plus Jakarta Sans',
                sans-serif;

            cursor:
                pointer;
        }


        .error {
            margin-top:
                7px;

            color:
                #fca5a5;

            font-size:
                11px;
        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .actions {
            display:
                flex;

            align-items:
                center;

            gap:
                18px;

            flex-wrap:
                wrap;

            margin-top:
                28px;
        }


        .save-button {
            position:
                relative;

            overflow:
                hidden;

            border:
                none;

            border-radius:
                999px;

            padding:
                14px 25px;

            color:
                #17142a;

            background:
                linear-gradient(
                    110deg,
                    var(--pink),
                    var(--lavender),
                    var(--gold)
                );

            font:
                800 10px
                'Plus Jakarta Sans',
                sans-serif;

            letter-spacing:
                .08em;

            text-transform:
                uppercase;

            cursor:
                pointer;

            box-shadow:
                0 15px 35px
                rgba(201,185,239,.2);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }


        .save-button::before {
            content: "";

            position:
                absolute;

            top:
                0;

            left:
                -100%;

            width:
                60%;

            height:
                100%;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.55),
                    transparent
                );

            transform:
                skewX(-20deg);

            transition:
                left .5s ease;
        }


        .save-button:hover {
            transform:
                translateY(-3px);

            box-shadow:
                0 20px 45px
                rgba(201,185,239,.3);
        }


        .save-button:hover::before {
            left:
                140%;
        }


        .save-button:active {
            transform:
                translateY(0)
                scale(.98);
        }


        .back-link {
            color:
                var(--muted);

            font-size:
                11px;

            text-decoration:
                none;

            transition:
                color .2s ease,
                transform .2s ease;
        }


        .back-link:hover {
            color:
                var(--white);

            transform:
                translateX(3px);
        }


        /* =========================================================
           ANIMATION
        ========================================================= */

        @keyframes fadeUp {
            from {
                opacity: 0;

                transform:
                    translateY(22px);
            }

            to {
                opacity: 1;

                transform:
                    translateY(0);
            }
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 820px) {

            .admin-profile {
                padding:
                    45px 16px 70px;
            }


            .admin-card {
                grid-template-columns:
                    1fr;
            }


            .identity {
                padding:
                    42px 25px;

                border-right:
                    none;

                border-bottom:
                    1px solid
                    rgba(255,255,255,.08);
            }


            .identity::before {
                top:
                    auto;

                bottom:
                    0;

                width:
                    100%;

                height:
                    1px;

                background:
                    linear-gradient(
                        90deg,
                        transparent,
                        var(--pink),
                        var(--lavender),
                        transparent
                    );
            }


            .form-panel {
                padding:
                    38px 26px 42px;
            }
        }


        @media (max-width: 480px) {

            .admin-profile {
                padding-top:
                    35px;
            }


            h1 {
                font-size:
                    40px;
            }


            .admin-card {
                border-radius:
                    25px;
            }


            .form-panel h2 {
                font-size:
                    23px;
            }


            .avatar-wrap {
                width:
                    170px;

                height:
                    170px;
            }


            .actions {
                align-items:
                    flex-start;

                flex-direction:
                    column;
            }
        }


        /* =========================================================
           REDUCE MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration:
                    .01ms !important;

                animation-iteration-count:
                    1 !important;

                scroll-behavior:
                    auto !important;

                transition-duration:
                    .01ms !important;
            }
        }
    </style>
</head>


<body>

    {{-- BACKGROUND PARTICLES --}}
    <div class="particles">

        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>

    </div>


    @include('whisperly.navbar')


    <main class="admin-profile">


        {{-- HEADER --}}
        <header class="admin-header">

            <span class="admin-eyebrow">
                Whisperly Administrator
            </span>

            <h1>
                Profil Admin
            </h1>

            <p>
                Kelola identitas dan informasi akun administrator
                dengan mudah melalui halaman profil kamu.
            </p>

        </header>


        {{-- MAIN CARD --}}
        <section class="admin-card" id="adminCard">


            {{-- =====================================================
                 IDENTITY
            ====================================================== --}}

            <aside class="identity">

                <div class="avatar-wrap">

                    <div class="avatar-ring"></div>

                    <div class="orbit">
                        <span class="orbit-dot"></span>
                    </div>

                    <div class="avatar-inner">

                        @if ($currentUser->avatar_url)

                            <img
                                src="{{ $currentUser->avatar_url }}"
                                alt="Foto {{ $currentUser->username }}"
                            >

                        @else

                            {{ strtoupper(substr($currentUser->username, 0, 1)) }}

                        @endif

                    </div>

                    <span class="avatar-status"></span>

                </div>


                <span class="identity-tag">
                    Whisperly Admin
                </span>


                <h2>
                    {{ $currentUser->username }}
                </h2>


                <p>
                    {{ $currentUser->email }}
                </p>


                <span class="role">
                    Administrator
                </span>

            </aside>


            {{-- =====================================================
                 FORM
            ====================================================== --}}

            <div class="form-panel">


                <h2>
                    Informasi Administrator
                </h2>


                <p class="subheading">
                    Perbarui bio dan foto profil akun administrator kamu.
                </p>


                {{-- SUCCESS --}}
                @if (session('success'))

                    <div class="success">
                        ✦ {{ session('success') }}
                    </div>

                @endif


                <form
                    action="{{ route('admin.profile.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf
                    @method('PATCH')


                    {{-- USERNAME --}}
                    <div class="field">

                        <label for="username">
                            Username
                        </label>

                        <div class="field-shell">

                            <input
                                id="username"
                                type="text"
                                value="{{ $currentUser->username }}"
                                readonly
                            >

                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div class="field">

                        <label for="email">
                            Email
                        </label>

                        <div class="field-shell">

                            <input
                                id="email"
                                type="email"
                                value="{{ $currentUser->email }}"
                                readonly
                            >

                        </div>

                    </div>


                    {{-- ROLE --}}
                    <div class="field">

                        <label for="role">
                            Role Akun
                        </label>

                        <div class="field-shell">

                            <input
                                id="role"
                                type="text"
                                value="Administrator"
                                readonly
                            >

                        </div>

                    </div>


                    {{-- BIO --}}
                    <div class="field">

                        <label for="bio">
                            Bio Admin
                        </label>

                        <div class="field-shell">

                            <textarea
                                id="bio"
                                name="bio"
                                maxlength="500"
                                placeholder="Tuliskan bio admin..."
                            >{{ old('bio', $currentUser->bio ?? '') }}</textarea>

                        </div>


                        @error('bio')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- PHOTO --}}
                    <div class="field">

                        <label for="photo">
                            Foto Profil
                        </label>

                        <div class="field-shell">

                            <input
                                id="photo"
                                name="photo"
                                type="file"
                                accept="image/jpeg,image/png,image/webp,image/gif"
                            >

                        </div>


                        @error('photo')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- ACTIONS --}}
                    <div class="actions">

                        <button
                            class="save-button"
                            type="submit"
                        >
                            ✦ &nbsp; Simpan Profil Admin
                        </button>


                        <a
    class="back-link"
    href="{{ url('/whisperly') }}"
>
    Kembali ke dashboard →
</a>

                    </div>


                </form>

            </div>

        </section>

    </main>


    <script>
        /*
         * Efek 3D ringan mengikuti posisi mouse.
         * Tidak mengubah fungsi form.
         */
        const card = document.getElementById('adminCard');

        if (card && window.matchMedia('(pointer: fine)').matches) {

            card.addEventListener('mousemove', function (event) {

                const rect = card.getBoundingClientRect();

                const x =
                    event.clientX - rect.left;

                const y =
                    event.clientY - rect.top;

                const centerX =
                    rect.width / 2;

                const centerY =
                    rect.height / 2;

                const rotateY =
                    ((x - centerX) / centerX) * 2;

                const rotateX =
                    ((centerY - y) / centerY) * 2;

                card.style.transform =
                    `perspective(1400px)
                     rotateX(${rotateX}deg)
                     rotateY(${rotateY}deg)
                     translateY(-2px)`;
            });


            card.addEventListener('mouseleave', function () {

                card.style.transform =
                    'perspective(1400px) rotateX(0deg) rotateY(0deg) translateY(0)';

            });

        }
    </script>

</body>
</html>