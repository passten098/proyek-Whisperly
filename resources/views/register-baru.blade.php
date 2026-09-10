<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Whisperly - Register</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link
    rel="preconnect"
    href="https://fonts.googleapis.com"
    crossorigin
>

<link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
    rel="stylesheet"
>

<style>

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


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


    body {

        min-height: 100vh;
        width: 100%;

        font-family: "DM Sans", sans-serif;

        color: var(--white);

        background:

            radial-gradient(
                circle at 72% 25%,
                rgba(125,65,190,0.23),
                transparent 28%
            ),

            radial-gradient(
                circle at 15% 80%,
                rgba(190,100,155,0.12),
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
            transform: translate(0,0) scale(1);
        }

        to {
            transform: translate(-35px,35px) scale(1.08);
        }
    }


    /* =====================================================
       MAIN
    ====================================================== */

    .register-page {

        position: relative;

        z-index: 2;

        min-height: 100vh;

        display: grid;

        grid-template-columns:
            minmax(0,1fr)
            430px;

        gap: 65px;

        align-items: center;

        padding:
            25px 7vw;

    }


    /* =====================================================
       LEFT
    ====================================================== */

    .intro {

        position: relative;

        width: 100%;

        min-height: 560px;

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
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    .brand {

        position: absolute;

        top: 0;
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


    /* =====================================================
       DIAMOND
    ====================================================== */

    .diamond-scene {

        position: relative;

        width: 470px;
        height: 390px;

        display: flex;

        align-items: center;

        justify-content: center;

        margin-top: 0;
    }


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


    /* =====================================================
       ORBIT
    ====================================================== */

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

        background: #f7dca5;

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


    .diamond-platform {

        position: absolute;

        bottom: 5px;

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
            transform: scale(.9);
        }

        50% {
            opacity: 1;
            transform: scale(1.08);
        }
    }


    /* =====================================================
       CRYSTALS
    ====================================================== */

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
        top: 45px;
        left: 38px;
        transform: rotate(24deg);
        animation-delay: -.8s;
    }


    .crystal.two {
        top: 115px;
        right: 35px;
        width: 20px;
        height: 36px;
        transform: rotate(-30deg);
        animation-delay: -2s;
    }


    .crystal.three {
        bottom: 55px;
        left: 80px;
        width: 18px;
        height: 32px;
        transform: rotate(-20deg);
        animation-delay: -3s;
    }


    .crystal.four {
        bottom: 70px;
        right: 70px;
        width: 30px;
        height: 50px;
        transform: rotate(35deg);
        animation-delay: -1.5s;
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


    /* =====================================================
       LEFT TEXT
    ====================================================== */

    .diamond-content {

        position: relative;

        margin-top: -10px;

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

        text-transform: uppercase;
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

        margin-top: 10px;

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

        margin-top: 10px;

        color:
            #a99db6;

        font-size: 11px;

        letter-spacing: 3px;

        text-transform: uppercase;
    }


    /* =====================================================
       REGISTER SIDE
    ====================================================== */

    .register-side {

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
                translateY(25px)
                scale(.98);
        }

        to {

            opacity: 1;

            transform:
                translateY(0)
                scale(1);
        }
    }


    /* =====================================================
       PANEL
    ====================================================== */

    .register-panel {

        position: relative;

        padding: 29px 31px 24px;

        border:
            1px solid
            rgba(255,255,255,0.09);

        border-radius: 27px;

        background:

            linear-gradient(
                145deg,
                rgba(40,28,61,0.78),
                rgba(18,13,30,0.82)
            );

        box-shadow:

            0 30px 80px
            rgba(0,0,0,0.38),

            inset 0 1px 0
            rgba(255,255,255,0.06);

        backdrop-filter:
            blur(22px);

        -webkit-backdrop-filter:
            blur(22px);

        overflow: hidden;
    }


    .register-panel::before {

        content: "";

        position: absolute;

        top: 0;

        left: 32px;
        right: 32px;

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


    .register-panel::after {

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


    /* =====================================================
       HEADER
    ====================================================== */

    .register-header {

        margin-bottom: 19px;
    }


    .register-kicker {

        color:
            var(--gold);

        font-size: 9px;

        font-weight: 700;

        letter-spacing: 2.5px;

        text-transform: uppercase;

        margin-bottom: 6px;
    }


    .register-title {

        font-family:
            "Playfair Display",
            serif;

        font-size: 31px;

        line-height: 1.05;

        font-weight: 600;

        color:
            var(--white);
    }


    .register-subtitle {

        margin-top: 7px;

        color:
            #938b9d;

        font-size: 11px;

        line-height: 1.45;
    }


    /* =====================================================
       FORM
    ====================================================== */

    .register-form {

        width: 100%;
    }


    .field {

        margin-bottom: 10px;
    }


    .field-label {

        display: block;

        margin:
            0 0 5px 11px;

        color:
            #c7bfce;

        font-size: 10px;

        font-weight: 600;

        letter-spacing: .4px;
    }


    /* =====================================================
       INPUT
    ====================================================== */

    .input-box {

        position: relative;

        width: 100%;

        height: 48px;

        display: flex;

        align-items: center;

        border:
            1px solid
            rgba(255,255,255,0.09);

        border-radius: 14px;

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

            0 8px 25px
            rgba(0,0,0,0.15);
    }


    .icon {

        width: 45px;

        display: flex;

        align-items: center;

        justify-content: center;

        flex-shrink: 0;
    }


    .icon svg {

        width: 17px;
        height: 17px;

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

        font-size: 12px;

        padding-right: 5px;
    }


    .input-box input::placeholder {

        color:
            #756e7d;

        opacity: 1;
    }


    /* =====================================================
       AUTOFILL
    ====================================================== */

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


    /* =====================================================
       PASSWORD
    ====================================================== */

    .eye-btn {

        width: 48px;
        height: 100%;

        flex-shrink: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        border: none;

        background: transparent;

        cursor: pointer;

        font-size: 22px;

        line-height: 1;

        padding: 0;

        opacity: .95;

        transition:
            .2s ease;
    }


    .eye-btn:hover {

        opacity: 1;

        transform:
            scale(1.12);
    }


    .eye-btn:active {

        transform:
            scale(.98);
    }


    /* =====================================================
       ERROR
    ====================================================== */

    .error-message {

        margin:
            4px 0 0 11px;

        color:
            #e99aab;

        font-size: 10px;
    }


    /* =====================================================
       BUTTON
    ====================================================== */

    .register-btn {

        position: relative;

        width: 100%;

        height: 49px;

        margin-top: 4px;

        border: none;

        border-radius: 14px;

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

        font-size: 12px;

        font-weight: 700;

        letter-spacing: .4px;

        cursor: pointer;

        box-shadow:

            0 10px 25px
            rgba(216,181,106,0.13);

        transition:
            .3s ease;
    }


    .register-btn::before {

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


    .register-btn:hover {

        transform:
            translateY(-2px);

        box-shadow:

            0 15px 30px
            rgba(216,181,106,.20);
    }


    .register-btn:hover::before {

        transform:
            translateX(120%);
    }


    .register-btn:active {

        transform:
            translateY(-1px);
    }


    /* =====================================================
       LOGIN
    ====================================================== */

    .login-text {

        margin-top: 12px;

        text-align: center;

        color:
            #80788a;

        font-size: 10px;
    }


    .login-text a {

        color:
            var(--gold-light);

        font-weight: 700;

        text-decoration: none;

        transition:
            .2s ease;
    }


    .login-text a:hover {

        color:
            var(--pink-light);
    }


    /* =====================================================
       DIVIDER
    ====================================================== */

    .register-divider {

        display: flex;

        align-items: center;

        gap: 10px;

        margin:
            13px 0 11px;

        color:
            #625b6a;

        font-size: 8px;

        letter-spacing: 1.5px;

        text-transform: uppercase;
    }


    .register-divider::before,
    .register-divider::after {

        content: "";

        flex: 1;

        height: 1px;

        background:
            rgba(255,255,255,.07);
    }


    /* =====================================================
       NOTE
    ====================================================== */

    .register-note {

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        color:
            #686170;

        font-size: 8px;

        letter-spacing: .3px;
    }


    .note-dot {

        width: 5px;
        height: 5px;

        border-radius: 50%;

        background:
            var(--gold);

        box-shadow:
            0 0 8px
            rgba(216,181,106,.55);
    }


    /* =====================================================
       TABLET
    ====================================================== */

    @media (max-width: 1050px) {

        .register-page {

            grid-template-columns:
                minmax(0,1fr)
                390px;

            gap: 40px;

            padding:
                20px 5vw;
        }


        .diamond-scene {

            width: 390px;

            transform:
                scale(.9);
        }


        .register-panel {

            padding:
                27px 28px 22px;
        }
    }


    /* =====================================================
       MOBILE
    ====================================================== */

    @media (max-width: 800px) {

        body {

            overflow-y: auto;
        }


        .register-page {

            min-height: 100vh;

            grid-template-columns:
                1fr;

            gap: 8px;

            padding:
                20px 20px 35px;
        }


        .intro {

            min-height: 390px;
        }


        .brand {

            position: relative;

            top: auto;
            left: auto;

            align-self:
                flex-start;
        }


        .diamond-scene {

            width: 350px;

            height: 300px;

            margin-top: -10px;

            transform:
                scale(.86);
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

            font-size: 45px;
        }


        .register-side {

            width:
                min(430px,100%);

            justify-self:
                center;
        }
    }


    /* =====================================================
       SMALL MOBILE
    ====================================================== */

    @media (max-width: 500px) {

        .register-page {

            padding:
                15px 16px 30px;

            gap: 5px;
        }


        .intro {

            min-height: 350px;
        }


        .brand-name {

            font-size: 21px;

            letter-spacing: 4px;
        }


        .diamond-scene {

            width: 300px;

            height: 255px;

            transform:
                scale(.78);

            margin-top: -15px;
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

            bottom: 2px;
        }


        .diamond-title {

            font-size: 36px;

            letter-spacing: 4px;
        }


        .diamond-subtitle {

            font-size: 8px;

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


        .register-panel {

            padding:
                24px 19px 20px;

            border-radius: 22px;
        }


        .register-header {

            margin-bottom: 16px;
        }


        .register-title {

            font-size: 28px;
        }


        .register-subtitle {

            font-size: 10px;
        }


        .field {

            margin-bottom: 9px;
        }


        .input-box {

            height: 47px;
        }


        .register-btn {

            height: 48px;
        }


        .eye-btn {

            width: 48px;

            font-size: 22px;
        }
    }


</style>

</head>

<body>

<main class="register-page">


    <!-- =================================================
         LEFT INTRO
    ================================================== -->

    <section class="intro">


        <div class="brand">

            <span class="brand-dot"></span>

            <span class="brand-name">
                WHISPERLY
            </span>

        </div>


        <div class="diamond-scene">


            <span class="crystal one"></span>

            <span class="crystal two"></span>

            <span class="crystal three"></span>

            <span class="crystal four"></span>


            <div class="diamond-orbit"></div>

            <div class="diamond-orbit second"></div>


            <div class="diamond">

                <div class="diamond-core"></div>

                <div class="diamond-facet facet-one"></div>

                <div class="diamond-facet facet-two"></div>

                <div class="diamond-facet facet-three"></div>

                <div class="diamond-light"></div>

            </div>


            <div class="diamond-platform"></div>


        </div>


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


    <!-- =================================================
         REGISTER
    ================================================== -->

    <section class="register-side">


        <div class="register-panel">


            <div class="register-header">

                <div class="register-kicker">
                    JOIN WHISPERLY
                </div>


                <h2 class="register-title">
                    Buat ruangmu.
                </h2>


                <p class="register-subtitle">
                    Mulai perjalananmu dan temukan ruang
                    untuk didengar bersama Whisperly.
                </p>

            </div>


            <form
                class="register-form"
                method="POST"
                action="{{ route('register.baru.store') }}"
            >

                @csrf


                <!-- USERNAME -->

                <div class="field">

                    <label
                        class="field-label"
                        for="username"
                    >
                        Username
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
                            placeholder="Buat username"
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


                <!-- EMAIL -->

                <div class="field">

                    <label
                        class="field-label"
                        for="email"
                    >
                        Email
                    </label>


                    <div class="input-box">

                        <span class="icon">

                            <svg viewBox="0 0 24 24">

                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                ></rect>

                                <polyline
                                    points="3,7 12,13 21,7"
                                ></polyline>

                            </svg>

                        </span>


                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Masukkan email"
                            autocomplete="email"
                            value="{{ old('email') }}"
                            required
                        >

                    </div>


                    @error('email')

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
                            placeholder="Buat password"
                            autocomplete="new-password"
                            required
                        >


                        <button
                            type="button"
                            class="eye-btn"
                            onclick="togglePassword('password', this)"
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


                <!-- CONFIRM PASSWORD -->

                <div class="field">

                    <label
                        class="field-label"
                        for="confirm-password"
                    >
                        Konfirmasi Password
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
                            name="password_confirmation"
                            id="confirm-password"
                            placeholder="Ulangi password"
                            autocomplete="new-password"
                            required
                        >


                        <button
                            type="button"
                            class="eye-btn"
                            onclick="togglePassword('confirm-password', this)"
                            aria-label="Tampilkan password"
                        >
                            🙈
                        </button>

                    </div>

                </div>


                <!-- CREATE ACCOUNT -->

                <button
                    type="submit"
                    class="register-btn"
                >
                    Create Account
                </button>


                <!-- LOGIN -->

                <p class="login-text">

                    Sudah punya akun?

                    <a href="{{ route('login.baru') }}">
                        Login
                    </a>

                </p>


                <!-- DIVIDER -->

                <div class="register-divider">
                    private & secure
                </div>


                <!-- NOTE -->

                <div class="register-note">

                    <span class="note-dot"></span>

                    Your space stays yours.

                </div>


            </form>


        </div>


    </section>


</main>


<script>

    function togglePassword(id, button) {

        const password =
            document.getElementById(id);


        if (password.type === "password") {

            password.type = "text";

            button.textContent = "🐵";

            button.setAttribute(
                "aria-label",
                "Sembunyikan password"
            );

        } else {

            password.type = "password";

            button.textContent = "🙈";

            button.setAttribute(
                "aria-label",
                "Tampilkan password"
            );

        }

    }

</script>


</body>

</html>