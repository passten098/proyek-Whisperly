<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Whisperly - Login</title>


    <!-- =========================================================
         GOOGLE FONT
    ========================================================== -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


    <style>

        /* =========================================================
           RESET
        ========================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =========================================================
           ROOT
        ========================================================== */

        :root {

            --bg-main: #100b1d;
            --bg-deep: #090712;

            --purple: #24163d;
            --purple-light: #39245b;

            --gold: #d8b56a;
            --gold-light: #f1dca3;

            --pink: #e5a7c3;
            --pink-light: #f4d5e3;

            --white: #f8f4ee;
            --muted: #aaa2b5;

            --line: rgba(255,255,255,0.10);

        }


        /* =========================================================
           BODY
        ========================================================== */

        body {

            min-height: 100vh;
            width: 100%;

            font-family: "DM Sans", sans-serif;

            color: var(--white);

            background:

                radial-gradient(
                    circle at 72% 25%,
                    rgba(125, 65, 190, 0.23),
                    transparent 28%
                ),

                radial-gradient(
                    circle at 15% 80%,
                    rgba(190, 100, 155, 0.12),
                    transparent 27%
                ),

                radial-gradient(
                    circle at 88% 85%,
                    rgba(216,181,106,0.08),
                    transparent 22%
                ),

                linear-gradient(
                    135deg,
                    #0b0714 0%,
                    #160d27 45%,
                    #0c0816 100%
                );

            overflow: hidden;

            position: relative;

        }


        /* =========================================================
           AMBIENT LIGHT
        ========================================================== */

        body::before {

            content: "";

            position: fixed;

            width: 650px;
            height: 650px;

            right: -260px;
            top: -250px;

            border-radius: 50%;

            background:

                radial-gradient(
                    circle,
                    rgba(210,150,255,0.16),
                    rgba(111,65,165,0.07) 38%,
                    transparent 70%
                );

            filter: blur(8px);

            animation:
                ambientFloat 10s ease-in-out infinite alternate;

            pointer-events: none;

        }


        body::after {

            content: "";

            position: fixed;

            width: 500px;
            height: 500px;

            left: -260px;
            bottom: -250px;

            border-radius: 50%;

            background:

                radial-gradient(
                    circle,
                    rgba(216,181,106,0.08),
                    transparent 68%
                );

            filter: blur(8px);

            pointer-events: none;

        }


        @keyframes ambientFloat {

            from {

                transform:
                    translate(0,0)
                    scale(1);

            }

            to {

                transform:
                    translate(-35px,35px)
                    scale(1.08);

            }

        }


        /* =========================================================
           MAIN
        ========================================================== */

        .login-page {

            position: relative;

            z-index: 2;

            min-height: 100vh;

            display: grid;

            grid-template-columns:
                minmax(0,1fr)
                430px;

            gap: 90px;

            align-items: center;

            padding:
                45px
                8vw;

        }


        /* =========================================================
           LEFT INTRO
        ========================================================== */

        .intro {

            position: relative;

            width: 100%;

            min-height: 650px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            text-align: center;

            animation:
                introReveal 1s ease both;

        }


        @keyframes introReveal {

            from {

                opacity: 0;

                transform:
                    translateY(30px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        /* =========================================================
           BRAND
        ========================================================== */

        .brand {

            position: absolute;

            top: 10px;
            left: 0;

            display: flex;

            align-items: center;

            gap: 11px;

        }


        .brand-dot {

            width: 8px;
            height: 8px;

            border-radius: 50%;

            background: var(--pink);

            box-shadow:

                0 0 12px
                rgba(229,167,195,0.9),

                0 0 25px
                rgba(229,167,195,0.35);

        }


        .brand-name {

            font-family:
                "Playfair Display",
                serif;

            font-size: 25px;

            font-weight: 700;

            letter-spacing: 5px;

            color: var(--white);

        }


        /* =========================================================
           DIAMOND SCENE
        ========================================================== */

        .diamond-scene {

            position: relative;

            width: 470px;
            height: 430px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-top: 5px;

        }


        /* =========================================================
           MAIN DIAMOND
        ========================================================== */

        .diamond {

            position: relative;

            width: 165px;
            height: 245px;

            transform-style: preserve-3d;

            z-index: 8;

            animation:
                diamondFloat 4.5s ease-in-out infinite;

            filter:

                drop-shadow(
                    0 0 18px
                    rgba(213,151,255,0.65)
                )

                drop-shadow(
                    0 0 45px
                    rgba(153,87,220,0.38)
                );

        }


        @keyframes diamondFloat {

            0%,
            100% {

                transform:
                    translateY(8px)
                    rotate(-2deg);

            }

            50% {

                transform:
                    translateY(-25px)
                    rotate(2deg);

            }

        }


        /* =========================================================
           DIAMOND BASE
        ========================================================== */

        .diamond-core {

            position: absolute;

            inset: 0;

            clip-path: polygon(
                50% 0%,
                88% 28%,
                72% 70%,
                50% 100%,
                28% 70%,
                12% 28%
            );

            background:

                linear-gradient(
                    135deg,
                    #fff3ff 0%,
                    #c778ff 20%,
                    #6737a0 47%,
                    #d991ff 72%,
                    #fff0d0 100%
                );

        }


        /* =========================================================
           DIAMOND FACETS
        ========================================================== */

        .diamond-facet {

            position: absolute;

            inset: 0;

            clip-path: polygon(
                50% 0%,
                88% 28%,
                72% 70%,
                50% 100%,
                28% 70%,
                12% 28%
            );

        }


        .facet-one {

            background:

                linear-gradient(
                    135deg,
                    rgba(255,255,255,0.85),
                    rgba(201,129,255,0.12)
                );

            clip-path: polygon(
                50% 0%,
                50% 100%,
                28% 70%,
                12% 28%
            );

        }


        .facet-two {

            background:

                linear-gradient(
                    225deg,
                    rgba(255,244,211,0.9),
                    rgba(167,84,255,0.08)
                );

            clip-path: polygon(
                50% 0%,
                88% 28%,
                50% 100%
            );

        }


        .facet-three {

            background:

                linear-gradient(
                    180deg,
                    rgba(255,255,255,0.38),
                    rgba(109,49,171,0.5)
                );

            clip-path: polygon(
                12% 28%,
                88% 28%,
                72% 70%,
                28% 70%
            );

        }


        /* =========================================================
           DIAMOND LIGHT
        ========================================================== */

        .diamond-light {

            position: absolute;

            width: 42px;
            height: 42px;

            top: 42%;
            left: 50%;

            transform:
                translate(-50%,-50%)
                rotate(45deg);

            background:

                linear-gradient(
                    135deg,
                    #ffffff,
                    #ffe8fa 45%,
                    #e4a8ff
                );

            filter:

                drop-shadow(
                    0 0 15px #ffffff
                )

                drop-shadow(
                    0 0 35px #d89aff
                );

            animation:
                diamondLight 2.8s ease-in-out infinite;

            z-index: 10;

        }


        @keyframes diamondLight {

            0%,
            100% {

                opacity: .65;

                scale: .75;

            }

            50% {

                opacity: 1;

                scale: 1.15;

            }

        }


        /* =========================================================
           ORBIT
        ========================================================== */

        .diamond-orbit {

            position: absolute;

            width: 390px;
            height: 110px;

            border:
                1px solid
                rgba(216,181,106,0.48);

            border-radius: 50%;

            transform:
                rotate(-12deg);

            box-shadow:

                0 0 18px
                rgba(216,181,106,0.08);

            animation:
                orbitRotate 8s linear infinite;

            z-index: 5;

        }


        .diamond-orbit::before {

            content: "";

            position: absolute;

            inset:
                13px
                35px;

            border:
                1px solid
                rgba(229,167,195,0.30);

            border-radius: 50%;

        }


        .diamond-orbit::after {

            content: "";

            position: absolute;

            width: 9px;
            height: 9px;

            top: 8px;
            left: 22%;

            border-radius: 50%;

            background:
                #f7dca5;

            box-shadow:

                0 0 10px
                #f7dca5,

                0 0 25px
                rgba(216,181,106,0.8);

        }


        @keyframes orbitRotate {

            from {

                transform:
                    rotate(-12deg)
                    scale(1);

            }

            50% {

                transform:
                    rotate(168deg)
                    scale(1.03);

            }

            to {

                transform:
                    rotate(348deg)
                    scale(1);

            }

        }


        /* =========================================================
           SECOND ORBIT
        ========================================================== */

        .diamond-orbit.second {

            width: 325px;
            height: 78px;

            border-color:
                rgba(207,145,255,0.30);

            transform:
                rotate(25deg);

            animation:
                orbitReverse 11s linear infinite;

        }


        @keyframes orbitReverse {

            from {

                transform:
                    rotate(25deg);

            }

            to {

                transform:
                    rotate(-335deg);

            }

        }


        /* =========================================================
           GLOW PLATFORM
        ========================================================== */

        .diamond-platform {

            position: absolute;

            bottom: 14px;

            width: 285px;
            height: 50px;

            border-radius: 50%;

            background:

                radial-gradient(
                    ellipse,
                    rgba(213,137,255,0.60),
                    rgba(127,63,190,0.20) 42%,
                    transparent 72%
                );

            filter: blur(5px);

            animation:
                platformPulse 3s ease-in-out infinite;

            z-index: 2;

        }


        .diamond-platform::before {

            content: "";

            position: absolute;

            inset:
                18px
                25px;

            border-top:
                1px solid
                rgba(243,211,255,0.75);

            border-radius: 50%;

        }


        @keyframes platformPulse {

            0%,
            100% {

                opacity: .5;

                transform:
                    scale(.9);

            }

            50% {

                opacity: 1;

                transform:
                    scale(1.08);

            }

        }


        /* =========================================================
           FLOATING CRYSTALS
        ========================================================== */

        .crystal {

            position: absolute;

            width: 27px;
            height: 46px;

            clip-path: polygon(
                50% 0%,
                85% 25%,
                68% 80%,
                50% 100%,
                32% 80%,
                15% 25%
            );

            background:

                linear-gradient(
                    145deg,
                    #f3cfff,
                    #8b4ec5,
                    #e7a8ff
                );

            opacity: .8;

            filter:

                drop-shadow(
                    0 0 12px
                    rgba(190,105,255,0.65)
                );

            animation:
                crystalFloat 5s ease-in-out infinite;

            z-index: 6;

        }


        .crystal.one {

            top: 55px;
            left: 38px;

            transform:
                rotate(24deg);

            animation-delay:
                -.8s;

        }


        .crystal.two {

            top: 125px;
            right: 35px;

            width: 20px;
            height: 36px;

            transform:
                rotate(-30deg);

            animation-delay:
                -2s;

        }


        .crystal.three {

            bottom: 70px;
            left: 80px;

            width: 18px;
            height: 32px;

            transform:
                rotate(-20deg);

            animation-delay:
                -3s;

        }


        .crystal.four {

            bottom: 90px;
            right: 70px;

            width: 30px;
            height: 50px;

            transform:
                rotate(35deg);

            animation-delay:
                -1.5s;

        }


        @keyframes crystalFloat {

            0%,
            100% {

                translate:
                    0 8px;

                rotate:
                    0deg;

                opacity:
                    .55;

            }

            50% {

                translate:
                    0 -20px;

                rotate:
                    12deg;

                opacity:
                    1;

            }

        }


        /* =========================================================
           DIAMOND TEXT
        ========================================================== */

        .diamond-content {

            position: relative;

            margin-top: -4px;

            z-index: 15;

        }


        .diamond-kicker {

            display: inline-flex;

            align-items: center;

            gap: 10px;

            color:
                var(--gold-light);

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 4px;

            text-transform:
                uppercase;

        }


        .diamond-kicker::before,
        .diamond-kicker::after {

            content: "";

            width: 30px;
            height: 1px;

            background:

                linear-gradient(
                    90deg,
                    transparent,
                    var(--gold)
                );

        }


        .diamond-kicker::after {

            background:

                linear-gradient(
                    90deg,
                    var(--gold),
                    transparent
                );

        }


        .diamond-title {

            margin-top: 13px;

            font-family:
                "Playfair Display",
                serif;

            font-size:
                clamp(
                    43px,
                    5vw,
                    68px
                );

            line-height: .95;

            letter-spacing: 6px;

            font-weight: 600;

            background:

                linear-gradient(
                    110deg,
                    #fff7ed,
                    #edc8ff 48%,
                    #d8b56a
                );

            -webkit-background-clip:
                text;

            background-clip:
                text;

            -webkit-text-fill-color:
                transparent;

        }


        .diamond-subtitle {

            margin-top: 13px;

            color:
                #a99db6;

            font-size: 11px;

            letter-spacing: 3px;

            text-transform:
                uppercase;

        }


        /* =========================================================
           RIGHT LOGIN
        ========================================================== */

        .login-side {

            width: 100%;

            animation:
                formReveal
                .9s
                .12s
                ease
                both;

        }


        @keyframes formReveal {

            from {

                opacity: 0;

                transform:
                    translateY(30px)
                    scale(.98);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);

            }

        }


        /* =========================================================
           LOGIN PANEL
        ========================================================== */

        .login-panel {

            position: relative;

            padding: 38px;

            border:
                1px solid
                rgba(255,255,255,0.09);

            border-radius: 30px;

            background:

                linear-gradient(
                    145deg,
                    rgba(40,28,61,0.78),
                    rgba(18,13,30,0.82)
                );

            box-shadow:

                0 35px 100px
                rgba(0,0,0,0.38),

                inset 0 1px 0
                rgba(255,255,255,0.06);

            backdrop-filter:
                blur(22px);

            -webkit-backdrop-filter:
                blur(22px);

            overflow: hidden;

        }


        .login-panel::before {

            content: "";

            position: absolute;

            top: 0;

            left: 35px;
            right: 35px;

            height: 1px;

            background:

                linear-gradient(
                    90deg,
                    transparent,
                    rgba(216,181,106,0.75),
                    rgba(229,167,195,0.65),
                    transparent
                );

        }


        .login-panel::after {

            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            right: -100px;
            top: -100px;

            border-radius: 50%;

            background:
                rgba(216,181,106,0.08);

            filter: blur(20px);

            pointer-events: none;

        }


        /* =========================================================
           LOGIN HEADER
        ========================================================== */

        .login-header {

            margin-bottom: 32px;

        }


        .login-kicker {

            color:
                var(--gold);

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 2.5px;

            text-transform:
                uppercase;

            margin-bottom: 10px;

        }


        .login-title {

            font-family:
                "Playfair Display",
                serif;

            font-size: 34px;

            line-height: 1.1;

            font-weight: 600;

            color:
                var(--white);

        }


        .login-subtitle {

            margin-top: 9px;

            color:
                #938b9d;

            font-size: 12px;

            line-height: 1.6;

        }


        /* =========================================================
           FORM
        ========================================================== */

        .login-form {

            width: 100%;

        }


        .field {

            margin-bottom: 17px;

        }


        .field-label {

            display: block;

            margin:
                0 0 8px 12px;

            color:
                #c7bfce;

            font-size: 11px;

            font-weight: 600;

            letter-spacing: .4px;

        }


        .input-box {

            position: relative;

            width: 100%;

            height: 54px;

            display: flex;

            align-items: center;

            border:
                1px solid
                rgba(255,255,255,0.09);

            border-radius: 16px;

            background:
                rgba(255,255,255,0.045);

            transition:
                .25s ease;

        }


        .input-box:hover {

            border-color:
                rgba(216,181,106,0.25);

            background:
                rgba(255,255,255,0.06);

        }


        .input-box:focus-within {

            border-color:
                rgba(216,181,106,0.55);

            background:
                rgba(255,255,255,0.065);

            box-shadow:

                0 0 0 3px
                rgba(216,181,106,0.06),

                0 8px 30px
                rgba(0,0,0,0.15);

        }


        /* =========================================================
           ICON
        ========================================================== */

        .icon {

            width: 50px;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

        }


        .icon svg {

            width: 18px;
            height: 18px;

            fill: none;

            stroke:
                #b9a6b7;

            stroke-width: 1.6;

            stroke-linecap: round;

            stroke-linejoin: round;

            transition:
                .25s ease;

        }


        .input-box:focus-within
        .icon svg {

            stroke:
                var(--gold-light);

        }


        /* =========================================================
           INPUT
        ========================================================== */

        .input-box input {

            flex: 1;

            width: 100%;

            height: 100%;

            border: none;

            outline: none;

            background: transparent;

            color:
                var(--white);

            font-family:
                "DM Sans",
                sans-serif;

            font-size: 13px;

            padding-right: 5px;

        }


        .input-box input::placeholder {

            color:
                #756e7d;

            opacity: 1;

        }


        /* =========================================================
           AUTOFILL
        ========================================================== */

        .input-box input:-webkit-autofill,
        .input-box input:-webkit-autofill:hover,
        .input-box input:-webkit-autofill:focus,
        .input-box input:-webkit-autofill:active {

            -webkit-box-shadow:
                0 0 0 1000px
                #21172f inset !important;

            -webkit-text-fill-color:
                #f8f4ee !important;

            caret-color:
                #f8f4ee !important;

            transition:
                background-color
                9999s
                ease-in-out
                0s;

        }


        /* =========================================================
           MONKEY PASSWORD BUTTON
        ========================================================== */

        .eye-btn {

            width: 54px;
            height: 100%;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border: none;

            background: transparent;

            cursor: pointer;

            font-size: 25px;

            line-height: 1;

            padding: 0;

            opacity: .95;

            transition:
                .2s ease;

        }


        .eye-btn:hover {

            opacity: 1;

            transform:
                scale(1.13);

        }


        .eye-btn:active {

            transform:
                scale(.98);

        }


        /* =========================================================
           ERROR
        ========================================================== */

        .error-message {

            margin:
                7px 0 10px 12px;

            color:
                #e99aab;

            font-size: 11px;

        }


        /* =========================================================
           LOGIN BUTTON
        ========================================================== */

        .login-btn {

            position: relative;

            width: 100%;

            height: 54px;

            margin-top: 9px;

            border: none;

            border-radius: 16px;

            overflow: hidden;

            background:

                linear-gradient(
                    110deg,
                    #f2e5d0 0%,
                    #e7cba1 34%,
                    #dfb5c9 70%,
                    #cda4dd 100%
                );

            color:
                #21172d;

            font-family:
                "DM Sans",
                sans-serif;

            font-size: 13px;

            font-weight: 700;

            letter-spacing: .4px;

            cursor: pointer;

            box-shadow:

                0 12px 30px
                rgba(216,181,106,0.13);

            transition:
                .3s ease;

        }


        .login-btn::before {

            content: "";

            position: absolute;

            inset: 0;

            background:

                linear-gradient(
                    110deg,
                    transparent 20%,
                    rgba(255,255,255,.5) 50%,
                    transparent 80%
                );

            transform:
                translateX(-120%);

            transition:
                .7s ease;

        }


        .login-btn:hover {

            transform:
                translateY(-3px);

            box-shadow:

                0 17px 35px
                rgba(216,181,106,.20);

        }


        .login-btn:hover::before {

            transform:
                translateX(120%);

        }


        .login-btn:active {

            transform:
                translateY(-1px);

        }


        /* =========================================================
           REGISTER
        ========================================================== */

        .register-text {

            margin-top: 21px;

            text-align: center;

            color:
                #80788a;

            font-size: 11px;

        }


        .register-text a {

            color:
                var(--gold-light);

            font-weight: 700;

            text-decoration: none;

            transition:
                .2s ease;

        }


        .register-text a:hover {

            color:
                var(--pink-light);

        }


        /* =========================================================
           DIVIDER
        ========================================================== */

        .login-divider {

            display: flex;

            align-items: center;

            gap: 12px;

            margin:
                25px 0 19px;

            color:
                #625b6a;

            font-size: 9px;

            letter-spacing: 1.5px;

            text-transform:
                uppercase;

        }


        .login-divider::before,
        .login-divider::after {

            content: "";

            flex: 1;

            height: 1px;

            background:
                rgba(255,255,255,.07);

        }


        /* =========================================================
           ADMIN
        ========================================================== */

        .secret-login {

            width: 100%;

            height: 46px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            border:
                1px solid
                rgba(216,181,106,.17);

            border-radius: 14px;

            background:
                rgba(255,255,255,.025);

            color:
                #b8aab9;

            cursor: pointer;

            font-family:
                "DM Sans",
                sans-serif;

            font-size: 11px;

            font-weight: 600;

            letter-spacing: .5px;

            transition:
                .25s ease;

        }


        .secret-login:hover {

            color:
                var(--gold-light);

            border-color:
                rgba(216,181,106,.4);

            background:
                rgba(216,181,106,.06);

            transform:
                translateY(-2px);

        }


        /* =========================================================
           LOCK ICON
        ========================================================== */

        .lock-icon {

            position: relative;

            width: 17px;
            height: 19px;

            display: block;

            flex-shrink: 0;

        }


        .lock-body {

            position: absolute;

            left: 1px;
            bottom: 0;

            width: 15px;
            height: 11px;

            background:
                currentColor;

            border-radius: 3px;

        }


        .lock-shackle {

            position: absolute;

            z-index: 1;

            left: 4px;
            top: 0;

            width: 9px;
            height: 9px;

            border:
                2px solid
                currentColor;

            border-bottom: none;

            border-radius:
                8px 8px 0 0;

        }


        .lock-hole {

            position: absolute;

            z-index: 3;

            left: 7px;
            bottom: 3px;

            width: 3px;
            height: 5px;

            border-radius: 2px;

            background:
                var(--bg-main);

        }


        /* =========================================================
           SECRET MODAL
        ========================================================== */

        .secret-modal {

            position: fixed;

            inset: 0;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background:
                rgba(6,4,12,.72);

            backdrop-filter:
                blur(14px);

            -webkit-backdrop-filter:
                blur(14px);

            z-index: 999;

        }


        .secret-modal.is-open {

            display: flex;

        }


        .secret-box {

            position: relative;

            width:
                min(390px,100%);

            padding: 35px;

            border:
                1px solid
                rgba(255,255,255,.10);

            border-radius: 26px;

            background:

                linear-gradient(
                    145deg,
                    rgba(44,30,64,.98),
                    rgba(17,11,28,.99)
                );

            box-shadow:

                0 35px 100px
                rgba(0,0,0,.55);

            animation:
                secretModalIn
                .25s
                ease-out;

        }


        .secret-box::before {

            content: "";

            position: absolute;

            top: 0;

            left: 35px;
            right: 35px;

            height: 1px;

            background:

                linear-gradient(
                    90deg,
                    transparent,
                    var(--gold),
                    var(--pink),
                    transparent
                );

        }


        @keyframes secretModalIn {

            from {

                opacity: 0;

                transform:
                    translateY(15px)
                    scale(.96);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);

            }

        }


        /* =========================================================
           CLOSE
        ========================================================== */

        .secret-close {

            position: absolute;

            top: 14px;
            right: 16px;

            width: 32px;
            height: 32px;

            border: none;

            border-radius: 50%;

            background:
                rgba(255,255,255,.04);

            color:
                #aaa1b0;

            cursor: pointer;

            font-size: 20px;

            transition:
                .2s ease;

        }


        .secret-close:hover {

            color:
                var(--white);

            background:
                rgba(255,255,255,.08);

        }


        /* =========================================================
           MODAL TITLE
        ========================================================== */

        .secret-box h2 {

            font-family:
                "Playfair Display",
                serif;

            margin-bottom: 8px;

            color:
                var(--white);

            font-size: 27px;

        }


        .secret-description {

            margin-bottom: 24px;

            color:
                #938a9b;

            font-size: 11px;

            line-height: 1.6;

        }


        /* =========================================================
           SECRET FIELD
        ========================================================== */

        .secret-field {

            margin-bottom: 15px;

        }


        .secret-label {

            display: block;

            margin:
                0 0 8px 12px;

            color:
                #c7bfce;

            font-size: 11px;

            font-weight: 600;

        }


        .secret-input-wrap {

            position: relative;

            width: 100%;

        }


        .secret-box input {

            width: 100%;

            height: 51px;

            padding:
                0 55px 0 16px;

            border:
                1px solid
                rgba(255,255,255,.09);

            border-radius: 15px;

            outline: none;

            color:
                var(--white);

            background:
                rgba(255,255,255,.045);

            font-family:
                "DM Sans",
                sans-serif;

            font-size: 12px;

            transition:
                .2s ease;

        }


        .secret-box input:focus {

            border-color:
                rgba(216,181,106,.5);

            box-shadow:
                0 0 0 3px
                rgba(216,181,106,.06);

        }


        .secret-box input::placeholder {

            color:
                #756e7d;

        }


        /* =========================================================
           SECRET MONKEY PASSWORD
        ========================================================== */

        .secret-eye {

            position: absolute;

            top: 50%;
            right: 7px;

            transform:
                translateY(-50%);

            width: 43px;
            height: 43px;

            border: none;

            background: transparent;

            color:
                #9b91a2;

            cursor: pointer;

            font-size: 25px;

            line-height: 1;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 0;

            opacity: .95;

            transition:
                .2s ease;

        }


        .secret-eye:hover {

            opacity: 1;

            transform:
                translateY(-50%)
                scale(1.13);

            color:
                var(--gold-light);

        }


        .secret-eye:active {

            transform:
                translateY(-50%)
                scale(.98);

        }


        /* =========================================================
           SECRET ERROR
        ========================================================== */

        .secret-error {

            margin:
                7px 0 0 12px;

            color:
                #e99aab;

            font-size: 11px;

        }


        /* =========================================================
           SECRET SUBMIT
        ========================================================== */

        .secret-submit {

            width: 100%;

            height: 50px;

            margin-top: 8px;

            border: none;

            border-radius: 15px;

            background:

                linear-gradient(
                    110deg,
                    #e9d4ad,
                    #dfb5c9,
                    #c5a4da
                );

            color:
                #21172d;

            cursor: pointer;

            font-family:
                "DM Sans",
                sans-serif;

            font-size: 12px;

            font-weight: 700;

            transition:
                .25s ease;

        }


        .secret-submit:hover {

            transform:
                translateY(-2px);

            box-shadow:

                0 12px 30px
                rgba(216,181,106,.16);

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1050px) {

            .login-page {

                grid-template-columns:
                    minmax(0,1fr)
                    390px;

                gap: 50px;

                padding:
                    35px 5vw;

            }


            .diamond-scene {

                width: 390px;

                transform:
                    scale(.9);

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 800px) {

            body {

                overflow-y: auto;

            }


            .login-page {

                min-height: 100vh;

                grid-template-columns:
                    1fr;

                gap: 20px;

                padding:
                    25px 24px 50px;

            }


            .intro {

                min-height: 500px;

            }


            .brand {

                position: relative;

                top: auto;
                left: auto;

                align-self:
                    flex-start;

                margin-bottom: 0;

            }


            .diamond-scene {

                width: 350px;

                height: 330px;

                margin-top: -5px;

                transform:
                    scale(.9);

            }


            .diamond {

                width: 125px;
                height: 185px;

            }


            .diamond-orbit {

                width: 300px;
                height: 85px;

            }


            .diamond-orbit.second {

                width: 250px;
                height: 65px;

            }


            .diamond-title {

                font-size: 48px;

            }


            .login-side {

                width:
                    min(430px,100%);

                justify-self:
                    center;

            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 500px) {

            .login-page {

                padding:
                    20px 18px 40px;

                gap: 15px;

            }


            .intro {

                min-height: 450px;

            }


            .brand-name {

                font-size: 22px;

                letter-spacing: 4px;

            }


            .diamond-scene {

                width: 300px;

                height: 280px;

                transform:
                    scale(.86);

                margin-top: -10px;

            }


            .diamond {

                width: 105px;
                height: 158px;

            }


            .diamond-orbit {

                width: 260px;
                height: 73px;

            }


            .diamond-orbit.second {

                width: 215px;
                height: 55px;

            }


            .diamond-platform {

                width: 215px;

                bottom: 7px;

            }


            .diamond-title {

                font-size: 38px;

                letter-spacing: 4px;

            }


            .diamond-subtitle {

                font-size: 9px;

                letter-spacing: 2px;

            }


            .crystal.one {

                left: 12px;

            }


            .crystal.two {

                right: 12px;

            }


            .crystal.three {

                left: 40px;

            }


            .crystal.four {

                right: 35px;

            }


            .login-panel {

                padding:
                    27px 21px;

                border-radius: 24px;

            }


            .login-title {

                font-size: 29px;

            }


            .secret-box {

                padding:
                    30px 23px;

            }


            .eye-btn {

                width: 52px;

                font-size: 24px;

            }


            .secret-eye {

                width: 42px;
                height: 42px;

                font-size: 24px;

            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         MAIN
    ========================================================== -->

    <main class="login-page">


        <!-- =====================================================
             LEFT DIAMOND
        ====================================================== -->

        <section class="intro">


            <!-- BRAND -->

            <div class="brand">

                <span class="brand-dot"></span>

                <span class="brand-name">
                    WHISPERLY
                </span>

            </div>


            <!-- =================================================
                 DIAMOND SCENE
            ================================================== -->

            <div class="diamond-scene">


                <!-- FLOATING CRYSTALS -->

                <span class="crystal one"></span>

                <span class="crystal two"></span>

                <span class="crystal three"></span>

                <span class="crystal four"></span>


                <!-- ORBITS -->

                <div class="diamond-orbit"></div>

                <div class="diamond-orbit second"></div>


                <!-- MAIN DIAMOND -->

                <div class="diamond">

                    <div class="diamond-core"></div>

                    <div class="diamond-facet facet-one"></div>

                    <div class="diamond-facet facet-two"></div>

                    <div class="diamond-facet facet-three"></div>

                    <div class="diamond-light"></div>

                </div>


                <!-- GLOW PLATFORM -->

                <div class="diamond-platform"></div>


            </div>


            <!-- =================================================
                 DIAMOND TEXT
            ================================================== -->

            <div class="diamond-content">

                <div class="diamond-kicker">
                    PRIVATE SPACE
                </div>


                <h1 class="diamond-title">
                    WHISPERLY
                </h1>


                <p class="diamond-subtitle">
                    A place to be heard
                </p>

            </div>


        </section>


        <!-- =====================================================
             RIGHT LOGIN
        ====================================================== -->

        <section class="login-side">


            <div class="login-panel">


                <!-- HEADER -->

                <div class="login-header">

                    <div class="login-kicker">
                        WHISPERLY SPACE
                    </div>


                    <h2 class="login-title">
                        Masuk ke ruangmu.
                    </h2>


                    <p class="login-subtitle">
                        Lanjutkan perjalananmu bersama Whisperly.
                    </p>

                </div>


                <!-- =================================================
                     LOGIN FORM
                ================================================== -->

                <form
                    class="login-form"
                    method="POST"
                    action="{{ route('login.baru.store') }}"
                >

                    @csrf


                    <!-- USERNAME -->

                    <div class="field">

                        <label
                            class="field-label"
                            for="username"
                        >
                            Username atau Email
                        </label>


                        <div class="input-box">

                            <span class="icon">

                                <svg viewBox="0 0 24 24">

                                    <circle
                                        cx="12"
                                        cy="8"
                                        r="4"
                                    ></circle>

                                    <path
                                        d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"
                                    ></path>

                                </svg>

                            </span>


                            <input
                                type="text"
                                id="username"
                                name="username"
                                placeholder="Masukkan username atau email"
                                autocomplete="username"
                                value="{{ old('username') }}"
                                required
                            >

                        </div>


                        @error('username')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- PASSWORD -->

                    <div class="field">

                        <label
                            class="field-label"
                            for="password"
                        >
                            Password
                        </label>


                        <div class="input-box">

                            <span class="icon">

                                <svg viewBox="0 0 24 24">

                                    <rect
                                        x="5"
                                        y="10"
                                        width="14"
                                        height="10"
                                        rx="2"
                                    ></rect>

                                    <path
                                        d="M8 10V7a4 4 0 0 1 8 0v3"
                                    ></path>

                                </svg>

                            </span>


                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Masukkan password"
                                autocomplete="current-password"
                                required
                            >


                            <!-- MONKEY -->

                            <button
                                type="button"
                                class="eye-btn"
                                onclick="togglePassword()"
                                aria-label="Tampilkan password"
                            >
                                🙈
                            </button>

                        </div>


                        @error('password')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- LOGIN -->

                    <button
                        type="submit"
                        class="login-btn"
                    >
                        Masuk ke Whisperly
                    </button>


                    <!-- REGISTER -->

                    <p class="register-text">

                        Belum punya akun?

                        <a href="{{ route('register.baru') }}">
                            Sign Up
                        </a>

                    </p>


                    <!-- DIVIDER -->

                    <div class="login-divider">
                        atau
                    </div>


                    <!-- ADMIN -->

                    <button
                        type="button"
                        class="secret-login"
                        onclick="openSecretModal()"
                        aria-label="Login Admin"
                        title="Login Admin"
                    >

                        <span class="lock-icon">

                            <span class="lock-shackle"></span>

                            <span class="lock-body"></span>

                            <span class="lock-hole"></span>

                        </span>


                        <span>
                            Admin Access
                        </span>

                    </button>


                </form>


            </div>


        </section>


    </main>


    <!-- =========================================================
         ADMIN MODAL
    ========================================================== -->

    <div
        class="secret-modal {{ $errors->has('secret_password') || $errors->has('secret_username') ? 'is-open' : '' }}"
        id="secret-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="secret-title"
    >


        <div class="secret-box">


            <!-- CLOSE -->

            <button
                type="button"
                class="secret-close"
                onclick="closeSecretModal()"
                aria-label="Tutup"
            >
                &times;
            </button>


            <!-- TITLE -->

            <h2 id="secret-title">
                Admin Access
            </h2>


            <p class="secret-description">
                Masukkan USN dan password admin
                untuk melanjutkan.
            </p>


            <!-- ADMIN FORM -->

            <form
                method="POST"
                action="{{ route('login.baru.secret') }}"
            >

                @csrf


                <!-- USN -->

                <div class="secret-field">

                    <label
                        for="secret_username"
                        class="secret-label"
                    >
                        USN
                    </label>


                    <input
                        type="text"
                        id="secret_username"
                        name="secret_username"
                        placeholder="Masukkan username admin"
                        autocomplete="username"
                        value="{{ old('secret_username') }}"
                        required
                    >


                    @error('secret_username')

                        <div class="secret-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- PASSWORD -->

                <div class="secret-field">

                    <label
                        for="secret_password"
                        class="secret-label"
                    >
                        Password
                    </label>


                    <div class="secret-input-wrap">

                        <input
                            type="password"
                            id="secret_password"
                            name="secret_password"
                            placeholder="Masukkan password admin"
                            autocomplete="current-password"
                            required
                        >


                        <!-- MONKEY -->

                        <button
                            type="button"
                            class="secret-eye"
                            onclick="toggleSecretPassword()"
                            aria-label="Tampilkan password admin"
                        >
                            🙈
                        </button>

                    </div>


                    @error('secret_password')

                        <div class="secret-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- SUBMIT -->

                <button
                    type="submit"
                    class="secret-submit"
                >
                    Masuk sebagai Admin
                </button>


            </form>


        </div>


    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>


        /* =========================================================
           LOGIN PASSWORD
        ========================================================== */

        function togglePassword() {

            const password =
                document.getElementById("password");

            const monkey =
                document.querySelector(".eye-btn");


            if (password.type === "password") {

                /* PASSWORD DIBUKA */

                password.type = "text";

                monkey.textContent = "🐵";

                monkey.setAttribute(
                    "aria-label",
                    "Sembunyikan password"
                );

            } else {

                /* PASSWORD DITUTUP */

                password.type = "password";

                monkey.textContent = "🙈";

                monkey.setAttribute(
                    "aria-label",
                    "Tampilkan password"
                );

            }

        }


        /* =========================================================
           ADMIN PASSWORD
        ========================================================== */

        function toggleSecretPassword() {

            const password =
                document.getElementById("secret_password");

            const monkey =
                document.querySelector(".secret-eye");


            if (password.type === "password") {

                /* PASSWORD DIBUKA */

                password.type = "text";

                monkey.textContent = "🐵";

                monkey.setAttribute(
                    "aria-label",
                    "Sembunyikan password admin"
                );

            } else {

                /* PASSWORD DITUTUP */

                password.type = "password";

                monkey.textContent = "🙈";

                monkey.setAttribute(
                    "aria-label",
                    "Tampilkan password admin"
                );

            }

        }


        /* =========================================================
           OPEN ADMIN MODAL
        ========================================================== */

        function openSecretModal() {

            const modal =
                document.getElementById("secret-modal");

            modal.classList.add("is-open");


            setTimeout(function() {

                const username =
                    document.getElementById("secret_username");

                if (username) {

                    username.focus();

                }

            }, 100);

        }


        /* =========================================================
           CLOSE ADMIN MODAL
        ========================================================== */

        function closeSecretModal() {

            document
                .getElementById("secret-modal")
                .classList
                .remove("is-open");

        }


        /* =========================================================
           CLICK OUTSIDE
        ========================================================== */

        document
            .getElementById("secret-modal")
            .addEventListener(
                "click",
                function(event) {

                    if (event.target === this) {

                        closeSecretModal();

                    }

                }
            );


        /* =========================================================
           ESC
        ========================================================== */

        document.addEventListener(
            "keydown",
            function(event) {

                if (event.key === "Escape") {

                    closeSecretModal();

                }

            }
        );


    </script>


</body>

</html>