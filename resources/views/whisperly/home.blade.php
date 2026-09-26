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

            /* LOGOUT */
            --logout-red: #ff6678;
            --logout-red-soft: #ff8795;
            --logout-red-bg: rgba(255, 102, 120, .08);
            --logout-red-border: rgba(255, 102, 120, .17);

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

        .notification-wrapper {
            position: relative;
            margin-right: 5px;
        }

        .notification-btn {
            width: 43px;
            height: 43px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 50%;
            background: rgba(255,255,255,.055);
            color: var(--white);
            cursor: pointer;
            position: relative;
            font-size: 19px;
        }

        .notification-btn:hover {
            background: rgba(201,185,239,.13);
            border-color: rgba(201,185,239,.34);
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #ff3b30;
            color: #fff;
            font: bold 11px Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 55px;

            width: fit-content !important;
            min-width: 0 !important;
            max-width: calc(100vw - 20px);

            max-height: 300px;
            overflow-y: auto;

            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,.2);
            z-index: 9999;
        }

        .notification-dropdown.show {
            display: block;
        }

        .notification-item {
            padding: 12px 14px;
            border-bottom: 1px solid #eee;
            color: #333;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item strong {
            color: #000;
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


        .user-avatar img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-width: 0;
}

.user-role {
    font-family: Arial, sans-serif;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.7px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.5);
    line-height: 1;
    margin-top: 3px;
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

        .menu-profile-avatar img {

    width: 100%;

    height: 100%;

    display: block;

    object-fit: cover;

    border-radius: 13px;

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
           LOGOUT ITEM
        ========================================================= */

        .logout-form {

            position: relative;

            width: 100%;

            margin: 0;

            padding: 0;

            z-index: 3;

        }


        .logout-button {

            position: relative;

            display: flex;

            align-items: center;

            gap: 12px;

            min-height: 58px;

            width: 100%;

            margin: 0;

            padding:
                7px 9px;

            border: 0;

            border-radius: 16px;

            color:
                var(--logout-red);

            background:
                transparent;

            font:
                inherit;

            text-align: left;

            cursor: pointer;

            overflow: hidden;

            z-index: 3;

            transition:
                background .25s ease,
                transform .25s ease,
                color .25s ease;

        }


        /* GARIS MERAH */

        .logout-button::before {

            content: "";

            position: absolute;

            left: 0;

            top: 10px;

            bottom: 10px;

            width: 2px;

            border-radius: 999px;

            background:
                var(--logout-red);

            opacity: 0;

            transform:
                scaleY(.3);

            transition:
                opacity .25s ease,
                transform .25s ease;

        }


        .logout-button:hover {

            background:
                var(--logout-red-bg);

            color:
                var(--logout-red-soft);

            transform:
                translateX(3px);

        }


        .logout-button:hover::before {

            opacity: 1;

            transform:
                scaleY(1);

        }


        /* ICON LOGOUT MERAH */

        .logout-button .dropdown-icon {

            color:
                var(--logout-red);

            border-color:
                var(--logout-red-border);

            background:
                rgba(255,102,120,.055);

        }


        .logout-button:hover
        .dropdown-icon {

            color:
                var(--logout-red-soft);

            background:
                rgba(255,102,120,.11);

            border-color:
                rgba(255,135,149,.24);

            transform:
                scale(1.06);

        }


        /* TEKS LOGOUT */

        .logout-button
        .dropdown-text strong {

            color:
                var(--logout-red);

            transition:
                color .25s ease;

        }


        .logout-button
        .dropdown-text small {

            color:
                rgba(255,102,120,.40);

            transition:
                color .25s ease;

        }


        .logout-button:hover
        .dropdown-text strong {

            color:
                var(--logout-red-soft);

        }


        .logout-button:hover
        .dropdown-text small {

            color:
                rgba(255,135,149,.60);

        }


        /* PANAH LOGOUT */

        .logout-button
        .dropdown-arrow {

            color:
                rgba(255,102,120,.38);

            transition:
                .25s ease;

        }


        .logout-button:hover
        .dropdown-arrow {

            color:
                var(--logout-red-soft);

            transform:
                translateX(4px);

        }


        /* =========================================================
           PREMIUM HOME
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

.premium-visual.role-talent {
    transform: translateX(45px);
}

.premium-visual.role-admin {
    transform: translateY(-35px);
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

        .crystal-talent .crystal {
    clip-path: polygon(
        50% 0%,
        82% 18%,
        100% 55%,
        72% 100%,
        28% 100%,
        0% 55%,
        18% 18%
    );
}

.crystal-admin .crystal {
    clip-path: polygon(
        50% 0%,
        88% 28%,
        78% 78%,
        50% 100%,
        22% 78%,
        12% 28%
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

        .notification-dropdown {
            width: 23px !important;
            min-width: 230px !important;
            max-width: calc(100vw - 20px);
        }

            .chat-status-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 8px 14px;
                border-radius: 10px;
                font: 600 12px Arial, sans-serif;
                text-decoration: none;
                transition: .2s ease;
                opacity: 1 !important;
            }

            .chat-status-waiting {
                color: #ffffff !important;
                background: #5a4630 !important;
                border: 1px solid #8a6a3f !important;
                cursor: not-allowed;
                opacity: 1 !important;
            }

            .chat-status-active {
                color: #ffffff !important;
                background: #168a5b !important;
                border: 1px solid #25b979 !important;
                cursor: pointer;
                opacity: 1 !important;
            }

            .chat-status-active:hover {
                background: #1f9f6b !important;
            }

            .notification-profile {
    display: flex;
    align-items: center;
    gap: 9px;
    margin-bottom: 8px;
}

.notification-avatar {
    width: 32px;
    height: 32px;
    min-width: 32px;
    border-radius: 50%;
    overflow: hidden;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #e7a2b6;
    color: #fff;

    font-weight: 700;
    font-size: 13px;
}

.notification-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.notification-profile strong {
    font-size: 14px;
}

    </style>

</head>


<body>


<div class="shell">


    @php
        $currentUser = auth('whisperly')->user();
    @endphp

    @include('whisperly.navbar')


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

    @if ($currentUser && $currentUser->role === 'talent')

        TALENT SPACE

    @elseif ($currentUser && $currentUser->role === 'admin')

        ADMIN SPACE

    @else

        PRIVATE SPACE

    @endif

</div>


@if ($currentUser)

    <p class="premium-welcome">

        @if ($currentUser->role === 'talent')

            Selamat Datang Kembali,
            Talent {{ ucfirst($currentUser->username) }}

        @elseif ($currentUser->role === 'admin')

            Selamat Datang Kembali,
            Admin {{ ucfirst($currentUser->username) }}

        @else

            Selamat Datang,
            {{ ucfirst($currentUser->username) }}

        @endif

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


                <!-- =====================================================
                     ACTION BUTTONS
                ====================================================== -->

                <div class="premium-actions">

    @if ($currentUser && $currentUser->role === 'talent')

        <a
            class="premium-action primary"
            href="{{ route('bookings.index') }}"
        >
            Kelola Booking
        </a>

        <a
            class="premium-action secondary"
            href="{{ route('whisperly.profile') }}"
        >
            Profil Talent
        </a>

    @elseif ($currentUser && $currentUser->role === 'admin')

        <a
            class="premium-action primary"
            href="{{ route('admin.menfess.index') }}"
        >
            Kelola Pengaduan
        </a>

        <a
            class="premium-action secondary"
            href="{{ route('admin.profile') }}"
        >
            Profil Admin
        </a>

    @else

        <a
            class="premium-action primary"
            href="{{ route('whisperly.talents.index') }}"
        >
            Lihat Talent
        </a>

        <a
            class="premium-action secondary"
            href="{{ route('pengaduan') }}"
        >
            Ruang Pengaduan
        </a>

    @endif

</div>


            </section>



            <!-- =====================================================
                 RIGHT SIDE
            ====================================================== -->

            <section
    class="premium-visual
        @if ($currentUser && $currentUser->role === 'talent')
            role-talent
        @elseif ($currentUser && $currentUser->role === 'admin')
            role-admin
        @endif"
>


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

    @if ($currentUser && $currentUser->role === 'talent')

        <small>RUANG UNTUK TALENT</small>
        <strong>Siap menemani cerita.</strong>

    @elseif ($currentUser && $currentUser->role === 'admin')

        <small>RUANG ADMIN</small>
        <strong>Kelola Whisperly.</strong>

    @else

        <small>RUANG UNTUK DIDENGAR</small>
        <strong>Ceritamu berarti.</strong>

    @endif

</div>



                <!-- CRYSTAL -->

                <div
    class="crystal-wrapper
        @if ($currentUser && $currentUser->role === 'talent')
            crystal-talent
        @elseif ($currentUser && $currentUser->role === 'admin')
            crystal-admin
        @endif"
>

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

    @if ($currentUser && $currentUser->role === 'talent')

        TALENT SPACE

    @elseif ($currentUser && $currentUser->role === 'admin')

        ADMIN SPACE

    @else

        WHISPERLY SPACE

    @endif

</div>


                        <div class="dashboard-status">

                            Active

                        </div>


                    </div>


                    <div class="dashboard-title">

    @if ($currentUser && $currentUser->role === 'talent')

        Ruang talentmu

    @elseif ($currentUser && $currentUser->role === 'admin')

        Ruang kendali admin

    @else

        Ruang pribadimu

    @endif

</div>


<div class="dashboard-subtitle">

    @if ($currentUser && $currentUser->role === 'talent')

        Tempat untuk menemani dan mendengarkan.

    @elseif ($currentUser && $currentUser->role === 'admin')

        Tempat untuk mengelola Whisperly.

    @else

        Tempat di mana setiap suara berarti.

    @endif

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

                const notificationDropdown =
                document.getElementById('notificationDropdown');

            if (notificationDropdown) {
                notificationDropdown.classList.remove('show');
            }

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

<script>
document.addEventListener("DOMContentLoaded", function () {

    const notificationButton =
        document.getElementById("notificationButton");

    const notificationDropdown =
        document.getElementById("notificationDropdown");

    const menuButton =
        document.getElementById("menuButton");

    const dropdownMenu =
        document.getElementById("dropdownMenu");


    if (
        notificationButton &&
        notificationDropdown
    ) {

        notificationButton.addEventListener(
            "click",
            function (event) {

                event.stopPropagation();

                // Tutup menu •••
                if (dropdownMenu) {
                    dropdownMenu.classList.remove("show");
                }

                if (menuButton) {
                    menuButton.classList.remove("active");

                    menuButton.setAttribute(
                        "aria-expanded",
                        "false"
                    );
                }

                // Buka/tutup notifikasi
                notificationDropdown.classList.toggle("show");

            }
        );


        notificationDropdown.addEventListener(
            "click",
            function (event) {

                event.stopPropagation();

            }
        );


        document.addEventListener(
            "click",
            function () {

                notificationDropdown.classList.remove(
                    "show"
                );

            }
        );

    }

});
</script>