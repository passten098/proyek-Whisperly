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

            --champagne: #f5e4c4;
            --champagne-soft: #fff4dc;

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

            overflow-x: hidden;

        }


        /* =========================================================
           CINEMATIC OVERLAY
        ========================================================= */

        body::before {

            content: "";

            position: fixed;

            inset: 0;

            z-index: 0;

            background:
                linear-gradient(
                    180deg,
                    rgba(13,12,28,.74),
                    rgba(24,21,47,.48) 42%,
                    rgba(8,7,19,.94)
                );

            pointer-events: none;

        }


        body::after {

            content: "";

            position: fixed;

            inset: 0;

            z-index: 0;

            pointer-events: none;

            background:
                radial-gradient(
                    circle at 18% 20%,
                    rgba(231,162,182,.10),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 80% 24%,
                    rgba(201,185,239,.12),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 60% 90%,
                    rgba(245,228,196,.06),
                    transparent 28%
                );

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
           DROPDOWN DECORATION
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
           PREMIUM HOME / DASHBOARD
        ========================================================= */

        .premium-home {

            position: relative;

            flex: 1;

            min-height:
                calc(100vh - 78px);

            width: 100%;

            display: flex;

            align-items: flex-start;

            justify-content: center;

            padding:
                10px 6vw 80px;

            overflow: visible;

        }


        /* =========================================================
           AMBIENT ORBS
        ========================================================= */

        .ambient {

            position: absolute;

            border-radius: 50%;

            pointer-events: none;

            filter:
                blur(2px);

            opacity: .55;

        }


        .ambient-one {

            width: 420px;

            height: 420px;

            top: -170px;

            left: -130px;

            background:
                radial-gradient(
                    circle,
                    rgba(231,162,182,.18),
                    transparent 68%
                );

            animation:
                ambientFloatOne 9s ease-in-out infinite;

        }


        .ambient-two {

            width: 500px;

            height: 500px;

            right: -180px;

            top: 40px;

            background:
                radial-gradient(
                    circle,
                    rgba(201,185,239,.17),
                    transparent 68%
                );

            animation:
                ambientFloatTwo 11s ease-in-out infinite;

        }


        .ambient-three {

            width: 380px;

            height: 380px;

            left: 42%;

            bottom: -220px;

            background:
                radial-gradient(
                    circle,
                    rgba(245,228,196,.09),
                    transparent 70%
                );

            animation:
                ambientFloatThree 12s ease-in-out infinite;

        }


        @keyframes ambientFloatOne {

            0%,
            100% {

                transform:
                    translate(0,0)
                    scale(1);

            }

            50% {

                transform:
                    translate(30px,25px)
                    scale(1.08);

            }

        }


        @keyframes ambientFloatTwo {

            0%,
            100% {

                transform:
                    translate(0,0)
                    scale(1);

            }

            50% {

                transform:
                    translate(-35px,35px)
                    scale(1.1);

            }

        }


        @keyframes ambientFloatThree {

            0%,
            100% {

                transform:
                    translateY(0);

            }

            50% {

                transform:
                    translateY(-35px);

            }

        }


        /* =========================================================
           PREMIUM CONTAINER
           SUDAH DIPERBAIKI AGAR JUDUL TIDAK TERPOTONG
        ========================================================= */

        .premium-container {

            position: relative;

            width:
                min(1400px, 100%);

            min-height: 650px;

            display: grid;

            grid-template-columns:
                minmax(650px, 1.15fr)
                minmax(420px, .85fr);

            align-items: center;

            gap: 50px;

            padding:
                50px;

            border: none;

            border-radius: 0;

            background: transparent;

            box-shadow: none;

            backdrop-filter: none;

            -webkit-backdrop-filter: none;

            overflow: visible;

        }


        /* =========================================================
           LEFT CONTENT
        ========================================================= */

        .premium-content {

            position: relative;

            z-index: 5;

            min-width: 0;

            overflow: visible;

        }


        /* =========================================================
           PREMIUM LABEL
        ========================================================= */

        .premium-label {

            display: inline-flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 24px;

            padding:
                8px 13px;

            border:
                1px solid
                rgba(245,228,196,.20);

            border-radius: 999px;

            background:
                rgba(245,228,196,.055);

            color:
                var(--champagne-soft);

            font:
                600 10px
                Arial,
                sans-serif;

            letter-spacing:
                .18em;

            text-transform:
                uppercase;

        }


        .premium-label::before {

            content: "";

            width: 6px;

            height: 6px;

            border-radius: 50%;

            background:
                var(--champagne);

            box-shadow:
                0 0 14px
                rgba(245,228,196,.8);

        }


        /* =========================================================
           WELCOME
        ========================================================= */

        .premium-welcome {

            margin:
                0 0 14px;

            color:
                var(--pink-soft);

            font:
                600 13px
                Arial,
                sans-serif;

            letter-spacing:
                .12em;

            text-transform:
                uppercase;

        }


        /* =========================================================
           PREMIUM TITLE
           FIX HURUF Y
        ========================================================= */

        .premium-title {

            margin: 0;

            width: 100%;

            max-width: none;

            color:
                var(--white);

            font-size:
                clamp(62px, 7vw, 105px);

            font-weight: 400;

            line-height:
                .86;

            letter-spacing:
                -.035em;

            overflow: visible;

        }


        .premium-title strong {

            display: block;

            width: max-content;

            max-width: none;

            margin-top: 9px;

            white-space: nowrap;

            font-weight: 700;

            background:
                linear-gradient(
                    110deg,
                    #fffaf7 10%,
                    #f5e4c4 38%,
                    #e7a2b6 68%,
                    #c9b9ef 92%
                );

            -webkit-background-clip:
                text;

            background-clip:
                text;

            color:
                transparent;

            text-shadow:
                0 10px 45px
                rgba(201,185,239,.12);

        }


        /* =========================================================
           LINE
        ========================================================= */

        .premium-line {

            width: 115px;

            height: 1px;

            margin:
                28px 0 22px;

            background:
                linear-gradient(
                    90deg,
                    var(--champagne),
                    var(--pink),
                    transparent
                );

        }


        /* =========================================================
           DESCRIPTION
        ========================================================= */

        .premium-description {

            max-width: 550px;

            margin: 0;

            color:
                rgba(255,250,247,.63);

            font:
                15px/1.8
                Arial,
                sans-serif;

        }


        /* =========================================================
           BUTTONS
        ========================================================= */

        .premium-actions {

            display: flex;

            flex-wrap: wrap;

            gap: 12px;

            margin-top: 30px;

        }


        .premium-action {

            position: relative;

            min-height: 51px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            padding:
                0 23px;

            border:
                1px solid
                transparent;

            border-radius: 999px;

            text-decoration: none;

            font:
                700 12px
                Arial,
                sans-serif;

            letter-spacing:
                .03em;

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                background .25s ease,
                border-color .25s ease;

        }


        .premium-action.primary {

            color:
                #282031;

            background:
                linear-gradient(
                    135deg,
                    #fffaf7,
                    #f5e4c4
                );

            box-shadow:
                0 15px 35px
                rgba(245,228,196,.13);

        }


        .premium-action.primary:hover {

            transform:
                translateY(-4px);

            box-shadow:
                0 20px 45px
                rgba(245,228,196,.22);

        }


        .premium-action.secondary {

            color:
                var(--white);

            background:
                rgba(255,255,255,.045);

            border-color:
                rgba(255,255,255,.15);

        }


        .premium-action.secondary:hover {

            transform:
                translateY(-4px);

            background:
                rgba(201,185,239,.10);

            border-color:
                rgba(201,185,239,.35);

            box-shadow:
                0 15px 35px
                rgba(0,0,0,.20);

        }


        .premium-action span {

            font-size: 16px;

            line-height: 1;

        }


        /* =========================================================
           RIGHT PREMIUM DISPLAY
        ========================================================= */

        .premium-visual {

            position: relative;

            min-height: 520px;

            display: flex;

            align-items: center;

            justify-content: center;

            z-index: 3;

        }


        /* =========================================================
           ORBIT
        ========================================================= */

        .orbit {

            position: absolute;

            width: 420px;

            height: 420px;

            border:
                1px solid
                rgba(255,255,255,.09);

            border-radius: 50%;

            transform:
                rotate(-18deg);

        }


        .orbit::before {

            content: "";

            position: absolute;

            inset: 45px;

            border:
                1px solid
                rgba(201,185,239,.10);

            border-radius: 50%;

        }


        .orbit::after {

            content: "";

            position: absolute;

            width: 8px;

            height: 8px;

            top: 27px;

            left: 85px;

            border-radius: 50%;

            background:
                var(--pink-soft);

            box-shadow:
                0 0 18px
                rgba(231,162,182,.85);

        }


        .orbit-one {

            animation:
                orbitRotate 18s linear infinite;

        }


        .orbit-two {

            width: 330px;

            height: 330px;

            transform:
                rotate(45deg);

            border-color:
                rgba(231,162,182,.08);

            animation:
                orbitRotateReverse 15s linear infinite;

        }


        .orbit-two::after {

            top: auto;

            bottom: 14px;

            left: 70px;

            background:
                var(--lavender);

            box-shadow:
                0 0 18px
                rgba(201,185,239,.8);

        }


        @keyframes orbitRotate {

            from {

                transform:
                    rotate(0deg);

            }

            to {

                transform:
                    rotate(360deg);

            }

        }


        @keyframes orbitRotateReverse {

            from {

                transform:
                    rotate(360deg);

            }

            to {

                transform:
                    rotate(0deg);

            }

        }


        /* =========================================================
           CRYSTAL
        ========================================================= */

        .crystal-wrapper {

            position: relative;

            width: 245px;

            height: 300px;

            display: flex;

            align-items: center;

            justify-content: center;

            animation:
                crystalFloat 5s ease-in-out infinite;

        }


        @keyframes crystalFloat {

            0%,
            100% {

                transform:
                    translateY(0)
                    rotate(-1deg);

            }

            50% {

                transform:
                    translateY(-16px)
                    rotate(2deg);

            }

        }


        .crystal-glow {

            position: absolute;

            width: 220px;

            height: 220px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(201,185,239,.34),
                    rgba(231,162,182,.10) 35%,
                    transparent 70%
                );

            filter:
                blur(18px);

            animation:
                glowPulse 4s ease-in-out infinite;

        }


        @keyframes glowPulse {

            0%,
            100% {

                transform:
                    scale(.92);

                opacity:
                    .65;

            }

            50% {

                transform:
                    scale(1.08);

                opacity:
                    1;

            }

        }


        .crystal {

            position: relative;

            width: 150px;

            height: 230px;

            clip-path:
                polygon(
                    50% 0%,
                    87% 20%,
                    100% 73%,
                    61% 100%,
                    37% 100%,
                    0% 73%,
                    13% 20%
                );

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.88),
                    rgba(222,213,246,.68) 28%,
                    rgba(201,185,239,.38) 56%,
                    rgba(231,162,182,.38) 78%,
                    rgba(255,255,255,.16)
                );

            box-shadow:
                0 0 70px
                rgba(201,185,239,.24);

            transform:
                rotate(1deg);

            filter:
                drop-shadow(
                    0 35px 40px
                    rgba(0,0,0,.28)
                );

        }


        .crystal::before {

            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    105deg,
                    transparent 28%,
                    rgba(255,255,255,.72) 29%,
                    rgba(255,255,255,.08) 40%,
                    transparent 41%,
                    transparent 58%,
                    rgba(255,255,255,.32) 59%,
                    transparent 70%
                );

            clip-path:
                polygon(
                    50% 0%,
                    87% 20%,
                    100% 73%,
                    61% 100%,
                    37% 100%,
                    0% 73%,
                    13% 20%
                );

        }


        .crystal::after {

            content: "";

            position: absolute;

            width: 35px;

            height: 150px;

            left: 52px;

            top: 20px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.26);

            filter:
                blur(10px);

            transform:
                rotate(17deg);

        }


        .crystal-core {

            position: absolute;

            width: 35px;

            height: 35px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle at 35% 30%,
                    #ffffff,
                    var(--champagne) 35%,
                    var(--pink) 70%,
                    var(--lavender)
                );

            box-shadow:
                0 0 40px
                rgba(245,228,196,.85);

            animation:
                corePulse 3s ease-in-out infinite;

        }


        @keyframes corePulse {

            0%,
            100% {

                transform:
                    scale(.9);

            }

            50% {

                transform:
                    scale(1.18);

            }

        }


        /* =========================================================
           FLOATING BADGE
        ========================================================= */

        .floating-badge {

            position: absolute;

            top: 45px;

            right: 8px;

            width: 190px;

            padding:
                17px 18px;

            border:
                1px solid
                rgba(255,255,255,.13);

            border-radius: 19px;

            background:
                rgba(17,16,31,.52);

            box-shadow:
                0 20px 45px
                rgba(0,0,0,.24);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);

            animation:
                badgeFloat 6s ease-in-out infinite;

        }


        @keyframes badgeFloat {

            0%,
            100% {

                transform:
                    translateY(0);

            }

            50% {

                transform:
                    translateY(-10px);

            }

        }


        .floating-badge small {

            display: block;

            margin-bottom: 7px;

            color:
                var(--champagne);

            font:
                600 8px
                Arial,
                sans-serif;

            letter-spacing:
                .18em;

        }


        .floating-badge strong {

            color:
                rgba(255,250,247,.90);

            font:
                600 13px/1.45
                Arial,
                sans-serif;

        }


        /* =========================================================
           DASHBOARD CARD
        ========================================================= */

        .dashboard-card {

            position: absolute;

            left: 0;

            bottom: 28px;

            width: 255px;

            padding:
                18px;

            border:
                1px solid
                rgba(255,255,255,.12);

            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    rgba(28,27,49,.76),
                    rgba(11,10,24,.76)
                );

            box-shadow:
                0 25px 55px
                rgba(0,0,0,.32);

            backdrop-filter:
                blur(20px);

            -webkit-backdrop-filter:
                blur(20px);

            animation:
                dashboardFloat 7s ease-in-out infinite;

        }


        @keyframes dashboardFloat {

            0%,
            100% {

                transform:
                    translateY(0);

            }

            50% {

                transform:
                    translateY(9px);

            }

        }


        .dashboard-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 20px;

        }


        .dashboard-brand {

            display: flex;

            align-items: center;

            gap: 8px;

            color:
                rgba(255,250,247,.88);

            font:
                700 10px
                Arial,
                sans-serif;

            letter-spacing:
                .12em;

        }


        .dashboard-brand-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background:
                var(--pink);

            box-shadow:
                0 0 12px
                rgba(231,162,182,.7);

        }


        .dashboard-status {

            padding:
                5px 8px;

            border:
                1px solid
                rgba(201,185,239,.16);

            border-radius: 999px;

            color:
                var(--lavender-soft);

            background:
                rgba(201,185,239,.06);

            font:
                600 7px
                Arial,
                sans-serif;

            letter-spacing:
                .08em;

            text-transform:
                uppercase;

        }


        .dashboard-title {

            margin-bottom: 5px;

            color:
                rgba(255,250,247,.94);

            font:
                600 16px
                Georgia,
                serif;

        }


        .dashboard-subtitle {

            margin-bottom: 18px;

            color:
                rgba(255,255,255,.40);

            font:
                400 10px/1.5
                Arial,
                sans-serif;

        }


        .dashboard-line {

            position: relative;

            height: 5px;

            overflow: hidden;

            border-radius: 999px;

            background:
                rgba(255,255,255,.07);

        }


        .dashboard-line span {

            display: block;

            width: 72%;

            height: 100%;

            border-radius: inherit;

            background:
                linear-gradient(
                    90deg,
                    var(--pink),
                    var(--lavender)
                );

            box-shadow:
                0 0 15px
                rgba(201,185,239,.30);

        }


        /* =========================================================
           DECORATIVE STARS
        ========================================================= */

        .star {

            position: absolute;

            width: 4px;

            height: 4px;

            border-radius: 50%;

            background:
                var(--white);

            box-shadow:
                0 0 12px
                rgba(255,255,255,.8);

            animation:
                starPulse 3s ease-in-out infinite;

        }


        .star-one {

            top: 105px;

            left: 70px;

        }


        .star-two {

            right: 85px;

            bottom: 105px;

            width: 3px;

            height: 3px;

            animation-delay:
                .8s;

        }


        .star-three {

            right: 25px;

            top: 190px;

            width: 5px;

            height: 5px;

            animation-delay:
                1.5s;

        }


        .star-four {

            left: 135px;

            bottom: 70px;

            width: 3px;

            height: 3px;

            animation-delay:
                2s;

        }


        @keyframes starPulse {

            0%,
            100% {

                opacity:
                    .25;

                transform:
                    scale(.8);

            }

            50% {

                opacity:
                    1;

                transform:
                    scale(1.35);

            }

        }


        /* =========================================================
           SMALL INFO
        ========================================================= */

        .premium-note {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-top: 28px;

            color:
                rgba(255,255,255,.30);

            font:
                400 9px
                Arial,
                sans-serif;

            letter-spacing:
                .04em;

        }


        .premium-note::before {

            content: "";

            width: 28px;

            height: 1px;

            background:
                rgba(255,255,255,.18);

        }


        /* =========================================================
           RESPONSIVE 1100px
        ========================================================= */

        @media (max-width: 1100px) {

            .premium-home {

                padding:
                    50px 4vw 70px;

            }


            .premium-container {

                grid-template-columns:
                    1fr;

                gap: 20px;

                padding:
                    50px;

            }


            .premium-content {

                text-align: center;

            }


            .premium-label {

                margin-left: auto;

                margin-right: auto;

            }


            .premium-line {

                margin-left: auto;

                margin-right: auto;

            }


            .premium-description {

                margin-left: auto;

                margin-right: auto;

            }


            .premium-actions {

                justify-content: center;

            }


            .premium-note {

                justify-content: center;

            }


            .premium-visual {

                min-height: 470px;

            }


            .premium-title {

                width: 100%;

            }


            .premium-title strong {

                width: max-content;

                max-width: 100%;

                margin-left: auto;

                margin-right: auto;

            }

        }


        /* =========================================================
           RESPONSIVE 700px
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


            .premium-home {

                min-height:
                    calc(100vh - 68px);

                padding:
                    30px 15px 50px;

            }


            .premium-container {

                min-height:
                    auto;

                padding:
                    35px 23px 20px;

                border-radius:
                    0;

            }


            .premium-title {

                width: 100%;

                font-size:
                    clamp(
                        52px,
                        15vw,
                        78px
                    );

            }


            .premium-title strong {

                width: max-content;

                max-width: 100%;

            }


            .premium-description {

                font-size:
                    13px;

                line-height:
                    1.7;

            }


            .premium-actions {

                flex-direction:
                    column;

            }


            .premium-action {

                width: 100%;

            }


            .premium-visual {

                min-height:
                    410px;

                transform:
                    scale(.88);

                margin-top:
                    -15px;

                margin-bottom:
                    -25px;

            }


            .floating-badge {

                right:
                    -8px;

                top:
                    25px;

            }


            .dashboard-card {

                left:
                    -8px;

                bottom:
                    12px;

            }


            .orbit {

                width:
                    350px;

                height:
                    350px;

            }


            .orbit-two {

                width:
                    285px;

                height:
                    285px;

            }

        }


        /* =========================================================
           RESPONSIVE 420px
        ========================================================= */

        @media (max-width: 420px) {

            .nav {

                padding:
                    10px 14px;

            }


            .brand {

                font-size:
                    18px;

            }


            .dropdown-menu {

                width:
                    calc(100vw - 24px);

                right:
                    -3px;

            }


            .premium-home {

                padding:
                    25px 10px 45px;

            }


            .premium-container {

                padding:
                    30px 17px 10px;

                border-radius:
                    0;

            }


            .premium-label {

                font-size:
                    8px;

            }


            .premium-welcome {

                font-size:
                    10px;

            }


            .premium-title {

                font-size:
                    49px;

            }


            .premium-title strong {

                width:
                    max-content;

                max-width:
                    100%;

            }


            .premium-description {

                font-size:
                    12px;

            }


            .premium-visual {

                transform:
                    scale(.73);

                margin-top:
                    -45px;

                margin-bottom:
                    -70px;

            }


            .premium-note {

                font-size:
                    8px;

            }

        }


        /* =========================================================
           REDUCED MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {

                animation-duration:
                    .01ms !important;

                animation-iteration-count:
                    1 !important;

                transition-duration:
                    .01ms !important;

                scroll-behavior:
                    auto !important;

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


                    <!-- DROPDOWN -->

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


                        <!-- USER MENU -->

                        @if ($currentUser->role === 'user')


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


                        <!-- TALENT MENU -->

                        @if ($currentUser->role === 'talent')


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


                        <!-- ADMIN MENU -->

                        @if ($currentUser->role === 'admin')


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
         PREMIUM HOME
    ========================================================== -->

    <main class="premium-home">


        <!-- AMBIENT LIGHT -->

        <div class="ambient ambient-one"></div>

        <div class="ambient ambient-two"></div>

        <div class="ambient ambient-three"></div>



        <!-- PREMIUM CONTAINER -->

        <div class="premium-container">


            <!-- =====================================================
                 LEFT SIDE
            ====================================================== -->

            <section class="premium-content">


                <div class="premium-label">
                    PRIVATE SPACE
                </div>


                @if ($currentUser)

                    <p class="premium-welcome">

                        Selamat datang,
                        {{ ucfirst($currentUser->username) }}

                    </p>

                @endif


                <h1 class="premium-title">

                    Welcome to

                    <strong>
                        WHISPERLY
                    </strong>

                </h1>


                <div class="premium-line"></div>


                <p class="premium-description">

                    Layanan konsultasi non-profesional —
                    hadir sebagai teman sehari-hari yang
                    bisa didengar. Temukan ruang yang nyaman
                    untuk berbagi cerita, berbicara, dan
                    menemukan seseorang yang siap mendengarkan.

                </p>


                <div class="premium-actions">


                    <!-- LIHAT TALENT -->

                    <a
                        class="premium-action primary"
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
                            class="premium-action secondary"
                            href="{{ route('admin.menfess.index') }}"
                        >

                            Ruang Pengaduan
                        </a>

                    @else

                        <a
                            class="premium-action secondary"
                            href="{{ route('pengaduan') }}"
                        >

                            Ruang Pengaduan


                        </a>

                    @endif


                </div>


                <div class="premium-note">

                    Tempat tenang untuk setiap suara.

                </div>


            </section>



            <!-- =====================================================
                 RIGHT SIDE
            ====================================================== -->

            <section class="premium-visual">


                <!-- ORBIT -->

                <div class="orbit orbit-one"></div>

                <div class="orbit orbit-two"></div>


                <!-- STARS -->

                <span class="star star-one"></span>

                <span class="star star-two"></span>

                <span class="star star-three"></span>

                <span class="star star-four"></span>



                <!-- FLOATING BADGE -->

                <div class="floating-badge">

                    <small>
                        RUANG UNTUK DIDENGAR
                    </small>

                    <strong>
                        Ceritamu berarti.
                    </strong>

                </div>



                <!-- CRYSTAL -->

                <div class="crystal-wrapper">

                    <div class="crystal-glow"></div>

                    <div class="crystal"></div>

                    <div class="crystal-core"></div>

                </div>



                <!-- PREMIUM DASHBOARD -->

                <div class="dashboard-card">


                    <div class="dashboard-top">


                        <div class="dashboard-brand">

                            <span
                                class="dashboard-brand-dot"
                            ></span>

                            WHISPERLY SPACE

                        </div>


                        <div class="dashboard-status">

                            Active

                        </div>


                    </div>


                    <div class="dashboard-title">

                        Ruang pribadimu

                    </div>


                    <div class="dashboard-subtitle">

                        Tempat di mana setiap suara berarti.

                    </div>


                    <div class="dashboard-line">

                        <span></span>

                    </div>


                </div>


            </section>


        </div>


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