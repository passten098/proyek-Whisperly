<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Whisperly</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Montserrat:wght@700;800;900&display=swap"
        rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #09050e;
        }

        body {
            font-family: "Inter", sans-serif;
            cursor: pointer;
            user-select: none;
        }


        /* =========================================================
           SCENE
        ========================================================= */

        .scene {
            position: fixed;
            inset: 0;
            overflow: hidden;

            background:
                radial-gradient(
                    ellipse at 55% 45%,
                    rgba(92, 48, 126, .34) 0%,
                    rgba(48, 27, 72, .30) 22%,
                    rgba(24, 15, 39, .72) 48%,
                    #10091a 72%,
                    #09050e 100%
                );
        }

        .scene::before {
            content: "";

            position: absolute;
            inset: 0;

            background:
                radial-gradient(
                    circle at 48% 43%,
                    rgba(170, 104, 220, .12),
                    rgba(108, 64, 151, .055) 28%,
                    transparent 62%
                );

            pointer-events: none;
            z-index: 1;
        }

        .scene::after {
            content: "";

            position: absolute;
            inset: 0;

            background:
                radial-gradient(
                    ellipse at center,
                    transparent 34%,
                    rgba(48, 22, 70, .12) 60%,
                    rgba(5, 3, 10, .72) 100%
                );

            pointer-events: none;
            z-index: 2;
        }


        /* =========================================================
           BLACK COVER
        ========================================================= */

        .black-cover {
            position: absolute;
            inset: 0;

            z-index: 500;

            background: #000;

            pointer-events: none;

            animation:
                blackReveal 1.6s
                cubic-bezier(.77, 0, .18, 1)
                forwards;
        }

        @keyframes blackReveal {

            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }

        }


        /* =========================================================
           AMBIENT
        ========================================================= */

        .ambient {
            position: absolute;

            left: 50%;
            top: 53%;

            width: min(900px, 85vw);
            height: min(900px, 85vw);

            transform: translate(-50%, -50%);

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(157, 91, 211, .14) 0%,
                    rgba(201, 145, 228, .055) 20%,
                    rgba(231, 162, 182, .035) 31%,
                    rgba(216, 181, 106, .035) 42%,
                    rgba(110, 57, 150, .05) 55%,
                    transparent 74%
                );

            filter: blur(22px);

            opacity: 0;

            animation:
                ambientIn 3s
                1.2s
                ease
                forwards;
        }

        @keyframes ambientIn {

            from {
                opacity: 0;

                transform:
                    translate(-50%, -50%)
                    scale(.65);
            }

            to {
                opacity: 1;

                transform:
                    translate(-50%, -50%)
                    scale(1);
            }

        }


        /* =========================================================
           FLOOR
        ========================================================= */

        .floor {
            position: absolute;

            left: -20%;
            bottom: -55%;

            width: 140%;
            height: 100%;

            transform:
                perspective(650px)
                rotateX(66deg);

            transform-origin: center top;

            background-image:
                linear-gradient(
                    rgba(151, 91, 194, .045) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(151, 91, 194, .045) 1px,
                    transparent 1px
                );

            background-size: 70px 70px;

            opacity: 0;

            animation:
                floorIn 2.5s
                1.3s
                ease
                forwards;
        }

        @keyframes floorIn {

            to {
                opacity: .65;
            }

        }


        /* =========================================================
           PARTICLES
        ========================================================= */

        .particles {
            position: absolute;
            inset: 0;

            z-index: 3;

            pointer-events: none;
        }

        .particle {
            position: absolute;

            width: 2px;
            height: 2px;

            border-radius: 50%;

            background: rgba(226, 201, 246, .78);

            box-shadow:
                0 0 8px rgba(177, 113, 218, .55);

            opacity: .12;

            animation:
                particleFloat
                linear
                infinite;
        }

        .particle:nth-child(1) {
            left: 9%;
            top: 28%;
            animation-duration: 8s;
        }

        .particle:nth-child(2) {
            left: 18%;
            top: 61%;
            animation-duration: 11s;
        }

        .particle:nth-child(3) {
            left: 28%;
            top: 17%;
            animation-duration: 9s;
        }

        .particle:nth-child(4) {
            left: 76%;
            top: 23%;
            animation-duration: 10s;
        }

        .particle:nth-child(5) {
            left: 87%;
            top: 55%;
            animation-duration: 8s;
        }

        .particle:nth-child(6) {
            left: 93%;
            top: 36%;
            animation-duration: 12s;
        }

        .particle:nth-child(7) {
            left: 7%;
            top: 48%;
            animation-duration: 9s;
        }

        .particle:nth-child(8) {
            left: 64%;
            top: 13%;
            animation-duration: 10s;
        }

        .particle:nth-child(9) {
            left: 39%;
            top: 76%;
            animation-duration: 11s;
        }

        .particle:nth-child(10) {
            left: 68%;
            top: 72%;
            animation-duration: 9s;
        }

        @keyframes particleFloat {

            0%,
            100% {
                transform:
                    translate3d(0, 0, 0);

                opacity: .04;
            }

            50% {
                transform:
                    translate3d(20px, -28px, 0);

                opacity: .6;
            }

        }


        /* =========================================================
           ORB
        ========================================================= */

        .orb-layer {
            position: absolute;
            inset: 0;

            z-index: 80;

            pointer-events: none;
        }

        .light-orb {
            position: absolute;

            left: 50%;
            top: 50%;

            width: 11px;
            height: 11px;

            margin-left: -5.5px;
            margin-top: -5.5px;

            border-radius: 50%;

            background: #fffdfd;

            box-shadow:
                0 0 4px #ffffff,
                0 0 12px #ffffff,
                0 0 27px rgba(255, 245, 250, .96),
                0 0 48px rgba(191, 126, 224, .72),
                0 0 70px rgba(145, 77, 183, .42),
                0 0 95px rgba(231, 190, 128, .20);

            opacity: 0;

            will-change:
                left,
                top,
                transform,
                opacity;
        }

        .light-orb::before {
            content: "";

            position: absolute;

            left: 50%;
            top: 50%;

            width: 31px;
            height: 31px;

            transform:
                translate(-50%, -50%);

            border-radius: 50%;

            border:
                1px solid
                rgba(207, 157, 235, .34);

            box-shadow:
                0 0 18px rgba(177, 105, 218, .22);
        }

        .light-orb::after {
            content: "";

            position: absolute;

            left: 50%;
            top: 50%;

            width: 105px;
            height: 105px;

            transform:
                translate(-50%, -50%);

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(255,255,255,.16) 0%,
                    rgba(185,119,222,.12) 27%,
                    rgba(230,174,194,.045) 42%,
                    transparent 68%
                );

            filter: blur(7px);
        }


        /* =========================================================
           BURST
        ========================================================= */

        .orb-burst {
            position: absolute;

            left: 50%;
            top: 52%;

            width: 30px;
            height: 30px;

            transform:
                translate(-50%, -50%)
                scale(.2);

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    #fff 0%,
                    rgba(255,255,255,.97) 8%,
                    rgba(213,172,244,.78) 20%,
                    rgba(165,94,207,.48) 35%,
                    rgba(226,181,119,.18) 50%,
                    transparent 72%
                );

            opacity: 0;

            z-index: 70;

            pointer-events: none;
        }

        .orb-burst.active {

            animation:
                burstExpand
                1.25s
                cubic-bezier(.16,1,.3,1)
                forwards;

        }

        @keyframes burstExpand {

            0% {
                opacity: 0;

                transform:
                    translate(-50%, -50%)
                    scale(.2);
            }

            12% {
                opacity: 1;
            }

            38% {
                opacity: 1;
            }

            65% {
                opacity: .65;
            }

            100% {
                opacity: 0;

                transform:
                    translate(-50%, -50%)
                    scale(30);
            }

        }


        /* =========================================================
           ENERGY RING
        ========================================================= */

        .energy-ring {
            position: absolute;

            left: 50%;
            top: 52%;

            width: 130px;
            height: 130px;

            transform:
                translate(-50%, -50%)
                scale(.3);

            border-radius: 50%;

            border:
                1px solid
                rgba(202,145,231,.38);

            box-shadow:
                0 0 30px
                rgba(154,80,201,.20),

                inset 0 0 20px
                rgba(226,186,123,.075);

            opacity: 0;

            z-index: 71;

            pointer-events: none;
        }

        .energy-ring.active {

            animation:
                ringExpand
                1.3s
                ease-out
                forwards;

        }

        @keyframes ringExpand {

            0% {
                opacity: 0;

                transform:
                    translate(-50%, -50%)
                    scale(.3);
            }

            15% {
                opacity: .9;
            }

            100% {
                opacity: 0;

                transform:
                    translate(-50%, -50%)
                    scale(9);
            }

        }


        /* =========================================================
           ROBOT STAGE
        ========================================================= */

        .robot-stage {
            position: absolute;

            left: 50%;
            top: 57%;

            width: 650px;
            height: 720px;

            transform:
                translate(-50%, -50%);

            perspective: 1400px;

            z-index: 30;

            pointer-events: none;

            overflow: visible;
        }

        .robot-entrance {
            position: absolute;
            inset: 0;

            opacity: 0;

            transform:
                translateY(110px)
                scale(.72);

            animation:
                robotEntrance
                2.6s
                1.25s
                cubic-bezier(.16,1,.3,1)
                forwards;

            overflow: visible;
        }

        @keyframes robotEntrance {

            0% {
                opacity: 0;

                transform:
                    translateY(125px)
                    scale(.67);

                filter:
                    brightness(.05)
                    blur(10px);
            }

            30% {
                opacity: 1;

                filter:
                    brightness(.22)
                    blur(5px);
            }

            68% {
                filter:
                    brightness(.72)
                    blur(1px);
            }

            100% {
                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);

                filter:
                    brightness(1)
                    blur(0);
            }

        }


        /* =========================================================
           ROBOT PREMIUM BASE
        ========================================================= */

        .robot {
            position: absolute;

            left: 50%;
            top: 0;

            width: 430px;
            height: 710px;

            transform:
                translateX(-50%)
                translateY(var(--robot-y, 0px))
                rotateY(var(--robot-yaw, 0deg))
                rotateZ(var(--robot-roll, 0deg));

            transform-style: preserve-3d;

            will-change: transform;

            overflow: visible;

            filter:
                drop-shadow(
                    0 30px 35px
                    rgba(0,0,0,.55)
                );
        }

        .robot::before {
            content: "";

            position: absolute;

            left: 50%;
            top: 22%;

            width: 250px;
            height: 430px;

            transform:
                translateX(-50%)
                translateZ(-35px);

            border-radius: 50%;

            background:
                radial-gradient(
                    ellipse,
                    rgba(174,101,221,.10),
                    rgba(215,170,193,.035) 35%,
                    transparent 72%
                );

            filter: blur(20px);

            z-index: -5;
        }

        .robot::after {
            content: "";

            position: absolute;

            left: 50%;
            top: 7%;

            width: 330px;
            height: 590px;

            transform:
                translateX(-50%)
                translateZ(15px);

            border-radius: 50%;

            background:
                linear-gradient(
                    115deg,
                    transparent 0%,
                    rgba(255,255,255,.025) 34%,
                    rgba(218,181,106,.045) 50%,
                    rgba(205,151,235,.035) 65%,
                    transparent 100%
                );

            filter: blur(10px);

            opacity: .9;

            pointer-events: none;

            z-index: 50;
        }

        .robot-glow {
            position: absolute;

            left: 50%;
            top: 49%;

            width: 370px;
            height: 560px;

            transform:
                translate(-50%, -50%);

            border-radius: 50%;

            background:
                radial-gradient(
                    ellipse,
                    rgba(157,88,205,.12),
                    rgba(230,171,192,.032) 34%,
                    rgba(216,181,106,.025) 46%,
                    transparent 70%
                );

            filter: blur(22px);

            z-index: -2;
        }


        /* =========================================================
           HEAD - PREMIUM
        ========================================================= */

        .head-group {
            position: absolute;

            left: 50%;
            top: 35px;

            width: 175px;
            height: 185px;

            transform:
                translateX(-50%)
                translateY(var(--head-y,0px))
                rotateY(var(--head-yaw,0deg))
                rotateX(var(--head-pitch,0deg))
                rotateZ(var(--head-roll,0deg));

            transform-origin: 50% 80%;

            transform-style: preserve-3d;

            z-index: 20;

            will-change: transform;
        }

        .head {
            position: absolute;
            inset: 0;

            border-radius:
                47%
                47%
                42%
                42%;

            background:
                linear-gradient(
                    115deg,
                    #f7f5f3 0%,
                    #d9d8d8 8%,
                    #7b7e83 18%,
                    #272a2f 31%,
                    #08090c 45%,
                    #15171b 57%,
                    #4d5157 69%,
                    #c8c8c8 83%,
                    #f0e8e4 94%,
                    #676a70 100%
                );

            border:
                1px solid
                rgba(255,255,255,.34);

            box-shadow:
                inset 12px 10px 20px
                rgba(255,255,255,.20),

                inset -17px -22px 30px
                rgba(0,0,0,.76),

                inset 0 0 0 1px
                rgba(211,171,105,.09),

                0 25px 45px
                rgba(0,0,0,.72),

                0 0 35px
                rgba(161,92,207,.08);

            overflow: hidden;
        }

        .head::before {
            content: "";

            position: absolute;

            left: 20px;
            top: 12px;

            width: 92px;
            height: 38px;

            border-radius: 50%;

            background:
                linear-gradient(
                    115deg,
                    rgba(255,255,255,.30),
                    rgba(255,255,255,.015)
                );

            filter: blur(7px);

            transform:
                rotate(-17deg);
        }

        .head::after {
            content: "";

            position: absolute;

            left: 17px;
            right: 17px;
            bottom: 12px;

            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(216,181,106,.34),
                    rgba(205,151,235,.42),
                    rgba(216,181,106,.34),
                    transparent
                );

            box-shadow:
                0 0 10px
                rgba(181,113,222,.25);
        }

        .face {
            position: absolute;

            left: 17px;
            right: 17px;

            top: 41px;
            bottom: 25px;

            border-radius:
                44%
                44%
                48%
                48%;

            background:
                linear-gradient(
                    145deg,
                    #020305,
                    #101319 35%,
                    #030406 70%,
                    #15181c
                );

            border:
                1px solid
                rgba(255,255,255,.07);

            box-shadow:
                inset 0 8px 15px
                rgba(255,255,255,.055),

                inset 0 -20px 28px
                rgba(0,0,0,.9),

                0 0 0 1px
                rgba(190,132,225,.025);
        }

        .visor {
            position: absolute;

            left: 13px;
            right: 13px;

            top: 35px;

            height: 68px;

            border-radius: 50%;

            background:
                linear-gradient(
                    180deg,
                    #010102 0%,
                    #080b0f 35%,
                    #171a1f 53%,
                    #020304 100%
                );

            border:
                1px solid
                rgba(255,255,255,.075);

            box-shadow:
                inset 0 7px 11px
                rgba(255,255,255,.055),

                inset 0 -12px 17px
                rgba(0,0,0,.85),

                0 0 18px
                rgba(147,80,197,.08);
        }

        .visor::after {
            content: "";

            position: absolute;

            left: 16px;
            right: 16px;
            bottom: 7px;

            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(216,181,106,.35),
                    rgba(205,151,235,.25),
                    transparent
                );

            opacity: .7;
        }

        .visor-line {
            position: absolute;

            left: 20px;
            right: 20px;

            top: 8px;

            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.32),
                    transparent
                );
        }

        .eyes {
            position: absolute;

            left: 0;
            right: 0;
            top: 29px;

            display: flex;

            justify-content: center;

            gap: 34px;

            transform:
                translate(
                    var(--eye-x,0px),
                    var(--eye-y,0px)
                );

            will-change: transform;
        }

        .eye {
            position: relative;

            width: 28px;
            height: 6px;

            border-radius: 50%;

            background:
                linear-gradient(
                    90deg,
                    #fff,
                    #f7eefa,
                    #fff
                );

            box-shadow:
                0 0 4px #fff,
                0 0 12px rgba(255,255,255,.95),
                0 0 23px rgba(153,81,211,.48),
                0 0 34px rgba(216,181,106,.16);

            transform:
                skewX(-14deg);
        }

        .eye::after {
            content: "";

            position: absolute;

            left: 50%;
            top: 50%;

            width: 7px;
            height: 2px;

            transform:
                translate(-50%,-50%);

            border-radius: 50%;

            background: #fff;

            box-shadow:
                0 0 7px #fff;
        }

        .eye.right {
            transform:
                skewX(14deg);
        }


        /* =========================================================
           NECK
        ========================================================= */

        .neck {
            position: absolute;

            left: 50%;
            top: 200px;

            width: 70px;
            height: 48px;

            transform:
                translateX(-50%)
                rotateY(var(--neck-yaw,0deg));

            border-radius: 14px;

            background:
                linear-gradient(
                    90deg,
                    #050608,
                    #565b62 16%,
                    #d3d6d9 31%,
                    #41454b 47%,
                    #090a0d 67%,
                    #898e95 87%,
                    #14161a
                );

            border:
                1px solid
                rgba(235,238,240,.20);

            box-shadow:
                inset 4px 0 8px
                rgba(255,255,255,.13),

                inset -7px 0 10px
                rgba(0,0,0,.76),

                0 8px 15px
                rgba(0,0,0,.55);
        }

        .neck-ring {
            position: absolute;

            left: 50%;
            top: 7px;

            width: 77px;
            height: 8px;

            transform:
                translateX(-50%);

            border-radius: 50%;

            border:
                1px solid
                rgba(190,130,225,.68);

            box-shadow:
                0 0 8px
                rgba(161,82,204,.30),

                inset 0 0 5px
                rgba(216,181,106,.16);
        }


        /* =========================================================
           BODY
        ========================================================= */

        .body {
            position: absolute;

            left: 50%;
            top: 224px;

            width: 240px;
            height: 270px;

            transform:
                translateX(-50%)
                rotateY(var(--body-yaw,0deg))
                rotateX(var(--body-pitch,0deg));

            transform-origin: 50% 10%;

            border-radius:
                45px
                45px
                50px
                50px;

            background:
                linear-gradient(
                    108deg,
                    #050608 0%,
                    #25292f 9%,
                    #aeb3b8 18%,
                    #42464c 27%,
                    #090a0c 40%,
                    #13161a 56%,
                    #5f646b 71%,
                    #b9bdc1 81%,
                    #292c31 92%,
                    #050608 100%
                );

            border:
                1px solid
                rgba(230,233,236,.28);

            box-shadow:
                inset 16px 0 25px
                rgba(255,255,255,.09),

                inset -21px -23px 33px
                rgba(0,0,0,.77),

                inset 0 0 0 1px
                rgba(216,181,106,.07),

                0 35px 55px
                rgba(0,0,0,.72);

            transform-style: preserve-3d;

            z-index: 8;
        }

        .body::before {
            content: "";

            position: absolute;

            left: 11px;
            right: 11px;
            top: 11px;

            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.30),
                    rgba(216,181,106,.13),
                    rgba(255,255,255,.30),
                    transparent
                );

            opacity: .7;
        }

        .body::after {
            content: "";

            position: absolute;

            left: 19px;
            right: 19px;
            bottom: 17px;

            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(172,108,217,.32),
                    rgba(216,181,106,.25),
                    rgba(172,108,217,.32),
                    transparent
                );

            box-shadow:
                0 0 9px
                rgba(159,83,206,.20);
        }

        .inner-chest {
            position: absolute;

            left: 28px;
            right: 28px;

            top: 30px;
            bottom: 44px;

            border-radius: 33px;

            background:
                linear-gradient(
                    145deg,
                    #020304,
                    #12151a 35%,
                    #050608 70%,
                    #171a1e
                );

            border:
                1px solid
                rgba(255,255,255,.055);

            box-shadow:
                inset 0 8px 15px
                rgba(255,255,255,.045),

                inset 0 -24px 31px
                rgba(0,0,0,.86);
        }

        .chest-plate {
            position: absolute;

            left: 50%;
            top: 31px;

            width: 91px;
            height: 132px;

            transform:
                translateX(-50%);

            border-radius:
                42px
                42px
                28px
                28px;

            background:
                linear-gradient(
                    155deg,
                    #71767d 0%,
                    #25282d 18%,
                    #08090b 52%,
                    #1a1d21 72%,
                    #6b7077 100%
                );

            border:
                1px solid
                rgba(255,255,255,.15);

            box-shadow:
                inset 5px 6px 11px
                rgba(255,255,255,.11),

                inset -7px -12px 17px
                rgba(0,0,0,.78),

                0 0 20px
                rgba(0,0,0,.65);
        }

        .chest-plate::before {
            content: "";

            position: absolute;

            left: 50%;
            top: 11px;

            width: 43px;
            height: 2px;

            transform:
                translateX(-50%);

            border-radius: 50%;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.25),
                    transparent
                );
        }

        .chest-plate::after {
            content: "";

            position: absolute;

            left: 50%;
            bottom: 12px;

            width: 42px;
            height: 1px;

            transform:
                translateX(-50%);

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(216,181,106,.48),
                    rgba(173,108,216,.38),
                    transparent
                );
        }

        .core {
            position: absolute;

            left: 50%;
            top: 39px;

            width: 29px;
            height: 29px;

            transform:
                translateX(-50%);

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    #fff 0 8%,
                    #fff6d9 15%,
                    #f1d28c 27%,
                    #c79b4e 39%,
                    #4d3b20 54%,
                    #080808 73%
                );

            border:
                1px solid
                rgba(255,239,199,.34);

            box-shadow:
                0 0 8px
                rgba(216,181,106,.95),

                0 0 20px
                rgba(216,181,106,.42),

                0 0 38px
                rgba(161,89,204,.16);
        }

        .core::before {
            content: "";

            position: absolute;

            inset: -6px;

            border-radius: 50%;

            border:
                1px solid
                rgba(216,181,106,.18);

            box-shadow:
                0 0 8px
                rgba(216,181,106,.12);
        }

        .core-line {
            position: absolute;

            left: 50%;
            top: 84px;

            width: 53px;
            height: 1px;

            transform:
                translateX(-50%);

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    #a467ca,
                    #d8b56a,
                    #a467ca,
                    transparent
                );

            box-shadow:
                0 0 8px
                rgba(161,86,207,.40);
        }


        /* =========================================================
           SHOULDERS
        ========================================================= */

        .shoulder {
            position: absolute;

            top: 232px;

            width: 88px;
            height: 94px;

            border-radius: 45%;

            background:
                linear-gradient(
                    140deg,
                    #f3f4f4 0%,
                    #858a91 18%,
                    #292c31 35%,
                    #07080a 57%,
                    #30343a 73%,
                    #b7bbc0 91%,
                    #575b62 100%
                );

            border:
                1px solid
                rgba(235,238,241,.27);

            box-shadow:
                inset 8px 6px 13px
                rgba(255,255,255,.14),

                inset -12px -14px 19px
                rgba(0,0,0,.77),

                0 13px 23px
                rgba(0,0,0,.58);

            z-index: 12;

            will-change: transform;
        }

        .shoulder::before {
            content: "";

            position: absolute;

            left: 14px;
            top: 12px;

            width: 45px;
            height: 18px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.12);

            filter: blur(5px);

            transform:
                rotate(-16deg);
        }

        .shoulder::after {
            content: "";

            position: absolute;

            width: 31px;
            height: 4px;

            left: 50%;
            top: 27px;

            transform:
                translateX(-50%);

            border-radius: 50%;

            background:
                linear-gradient(
                    90deg,
                    rgba(149,86,198,.35),
                    #d8b56a,
                    rgba(149,86,198,.35)
                );

            opacity: .72;

            box-shadow:
                0 0 9px
                rgba(155,82,204,.48);
        }

        .shoulder.left {
            left: 28px;
        }

        .shoulder.right {
            right: 28px;
        }


        /* =========================================================
           ARMS
        ========================================================= */

        .arm {
            position: absolute;

            top: 288px;

            width: 82px;
            height: 245px;

            transform-origin:
                50% 5%;

            transform-style: preserve-3d;

            z-index: 7;

            will-change: transform;
        }

        .arm.left {
            left: 18px;
        }

        .arm.right {
            right: 18px;
        }

        .upper-arm {
            position: absolute;

            left: 50%;
            top: 0;

            width: 53px;
            height: 105px;

            transform:
                translateX(-50%);

            border-radius: 28px;

            background:
                linear-gradient(
                    95deg,
                    #050608 0%,
                    #383d43 13%,
                    #8e949a 25%,
                    #e1e4e7 35%,
                    #555a61 47%,
                    #17191d 63%,
                    #08090b 77%,
                    #aeb2b7 91%,
                    #30343a 100%
                );

            border:
                1px solid
                rgba(235,238,241,.23);

            box-shadow:
                inset 5px 0 9px
                rgba(255,255,255,.11),

                inset -7px 0 11px
                rgba(0,0,0,.72),

                0 9px 17px
                rgba(0,0,0,.56);
        }

        .upper-arm::before {
            content: "";

            position: absolute;

            left: 9px;
            top: 12px;

            width: 25px;
            height: 56px;

            border-radius: 50%;

            background:
                linear-gradient(
                    90deg,
                    rgba(255,255,255,.13),
                    transparent
                );

            filter: blur(4px);
        }

        .upper-arm::after {
            content: "";

            position: absolute;

            left: 50%;
            top: 22px;

            width: 25px;
            height: 3px;

            transform:
                translateX(-50%);

            border-radius: 50%;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(161,94,211,.72),
                    rgba(216,181,106,.52),
                    transparent
                );

            box-shadow:
                0 0 7px
                rgba(148,74,199,.30);
        }

        .elbow {
            position: absolute;

            left: 50%;
            top: 91px;

            width: 49px;
            height: 49px;

            transform:
                translateX(-50%);

            border-radius: 50%;

            background:
                radial-gradient(
                    circle at 31% 25%,
                    #f4f5f5,
                    #858a91 23%,
                    #30343a 42%,
                    #090a0d 65%,
                    #6f747b 86%,
                    #191b1f
                );

            border:
                1px solid
                rgba(230,234,238,.24);

            box-shadow:
                inset 5px 4px 9px
                rgba(255,255,255,.14),

                inset -7px -8px 11px
                rgba(0,0,0,.72),

                0 8px 15px
                rgba(0,0,0,.70);
        }

        .elbow::after {
            content: "";

            position: absolute;

            left: 50%;
            top: 50%;

            width: 21px;
            height: 21px;

            transform:
                translate(-50%,-50%);

            border-radius: 50%;

            border:
                1px solid
                rgba(203,151,231,.20);

            box-shadow:
                inset 0 0 7px
                rgba(0,0,0,.55);
        }

        .forearm {
            position: absolute;

            left: 50%;
            top: 125px;

            width: 48px;
            height: 96px;

            transform:
                translateX(-50%);

            border-radius: 25px;

            background:
                linear-gradient(
                    100deg,
                    #060709,
                    #6e747b 21%,
                    #e4e7e9 36%,
                    #4a4f55 48%,
                    #17191d 62%,
                    #07080a 77%,
                    #a6abb0 92%
                );

            border:
                1px solid
                rgba(230,234,237,.22);

            box-shadow:
                inset 5px 0 8px
                rgba(255,255,255,.11),

                inset -7px 0 10px
                rgba(0,0,0,.72);
        }

        .forearm::before {
            content: "";

            position: absolute;

            left: 9px;
            top: 13px;

            width: 14px;
            height: 57px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.10);

            filter: blur(4px);
        }

        .forearm::after {
            content: "";

            position: absolute;

            left: 50%;
            bottom: 12px;

            width: 25px;
            height: 2px;

            transform:
                translateX(-50%);

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(216,181,106,.50),
                    rgba(162,95,210,.45),
                    transparent
                );

            box-shadow:
                0 0 7px
                rgba(165,93,209,.24);
        }


        /* =========================================================
           HAND
        ========================================================= */

        .hand {
            position: absolute;

            left: 50%;
            top: 198px;

            width: 62px;
            height: 70px;

            transform:
                translateX(-50%)
                rotateZ(var(--hand-rotate,0deg))
                rotateX(var(--hand-pitch,0deg));

            transform-origin: 50% 0;

            clip-path: polygon(
                21% 0%,
                79% 0%,
                91% 13%,
                94% 39%,
                87% 69%,
                76% 91%,
                61% 100%,
                39% 100%,
                24% 91%,
                13% 69%,
                6% 39%,
                9% 13%
            );

            background:
                linear-gradient(
                    118deg,
                    #050608 0%,
                    #33383f 13%,
                    #8b9197 25%,
                    #e9ebed 36%,
                    #777d84 47%,
                    #24272c 61%,
                    #08090c 75%,
                    #60666d 88%,
                    #d4d8dc 100%
                );

            box-shadow:
                inset 7px 4px 10px
                rgba(255,255,255,.16),

                inset -8px -9px 15px
                rgba(0,0,0,.78),

                0 7px 13px
                rgba(0,0,0,.48);
        }

        .hand::before {
            content: "";

            position: absolute;

            left: 50%;
            top: 5px;

            width: 42px;
            height: 13px;

            transform:
                translateX(-50%);

            border-radius: 50%;

            background:
                linear-gradient(
                    180deg,
                    rgba(255,255,255,.27),
                    rgba(255,255,255,.035)
                );

            box-shadow:
                0 0 7px
                rgba(255,255,255,.08);
        }

        .hand::after {
            content: "";

            position: absolute;

            left: 50%;
            top: 37px;

            width: 40px;
            height: 3px;

            transform:
                translateX(-50%);

            border-radius: 50%;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(143,86,190,.70),
                    rgba(216,181,106,.86),
                    rgba(143,86,190,.70),
                    transparent
                );

            box-shadow:
                0 0 8px
                rgba(168,91,218,.36);
        }


        /* =========================================================
           FINGERS
        ========================================================= */

        .finger {
            position: absolute;

            bottom: -24px;

            width: 8px;
            height: 33px;

            border-radius:
                0 0 7px 7px;

            background:
                linear-gradient(
                    90deg,
                    #090b0e 0%,
                    #4e545b 22%,
                    #d0d4d8 43%,
                    #6e747b 62%,
                    #15181c 100%
                );

            border:
                1px solid
                rgba(255,255,255,.16);

            box-shadow:
                inset 2px 0 3px
                rgba(255,255,255,.12),

                inset -2px 0 4px
                rgba(0,0,0,.55),

                0 3px 6px
                rgba(0,0,0,.45);

            transform-origin: top;
        }

        .finger:nth-child(1) {
            left: 5px;
            transform: rotate(13deg);
        }

        .finger:nth-child(2) {
            left: 17px;
            transform: rotate(5deg);
        }

        .finger:nth-child(3) {
            left: 29px;
            transform: rotate(-5deg);
        }

        .finger:nth-child(4) {
            left: 41px;
            transform: rotate(-13deg);
        }


        /* =========================================================
           WAIST
        ========================================================= */

        .waist {
            position: absolute;

            left: 50%;
            top: 465px;

            width: 151px;
            height: 84px;

            transform:
                translateX(-50%)
                rotateY(var(--body-yaw,0deg));

            border-radius:
                22px
                22px
                35px
                35px;

            background:
                linear-gradient(
                    90deg,
                    #060709,
                    #6e747b 16%,
                    #1d2025 33%,
                    #07080a 50%,
                    #202329 66%,
                    #858a91 84%,
                    #08090b
                );

            border:
                1px solid
                rgba(220,224,229,.22);

            box-shadow:
                inset 0 5px 10px
                rgba(255,255,255,.08),

                inset 0 -10px 15px
                rgba(0,0,0,.72),

                0 9px 15px
                rgba(0,0,0,.42);

            z-index: 9;
        }

        .waist::before {
            content: "";

            position: absolute;

            left: 15px;
            right: 15px;
            top: 11px;

            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.20),
                    transparent
                );
        }

        .waist-line {
            position: absolute;

            left: 50%;
            top: 28px;

            width: 96px;
            height: 3px;

            transform:
                translateX(-50%);

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    #955ac0,
                    #d8b56a,
                    #955ac0,
                    transparent
                );

            box-shadow:
                0 0 8px
                rgba(139,70,198,.34);
        }


        /* =========================================================
           LEGS
        ========================================================= */

        .leg {
            position: absolute;

            top: 525px;

            width: 87px;
            height: 165px;

            border-radius:
                37px
                37px
                25px
                25px;

            background:
                linear-gradient(
                    105deg,
                    #07080a,
                    #5d626a 18%,
                    #d4d8dc 32%,
                    #25282d 47%,
                    #07080a 68%,
                    #858a91 88%,
                    #0a0b0d
                );

            border:
                1px solid
                rgba(215,219,224,.22);

            box-shadow:
                inset 8px 0 14px
                rgba(255,255,255,.08),

                inset -11px -11px 18px
                rgba(0,0,0,.75),

                0 17px 26px
                rgba(0,0,0,.55);

            z-index: 4;
        }

        .leg::before {
            content: "";

            position: absolute;

            left: 10px;
            top: 13px;

            width: 20px;
            height: 75px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.08);

            filter: blur(5px);
        }

        .leg.left {
            left: 98px;
        }

        .leg.right {
            right: 98px;
        }

        .knee {
            position: absolute;

            left: 50%;
            top: 91px;

            width: 64px;
            height: 57px;

            transform:
                translateX(-50%);

            border-radius: 24px;

            background:
                linear-gradient(
                    145deg,
                    #e7eaed,
                    #686e76 29%,
                    #101215 56%,
                    #a5aab0
                );

            border:
                1px solid
                rgba(220,224,230,.2);

            box-shadow:
                inset 4px 3px 8px
                rgba(255,255,255,.14),

                inset -6px -8px 11px
                rgba(0,0,0,.67);
        }

        .knee::after {
            content: "";

            position: absolute;

            left: 50%;
            top: 50%;

            width: 27px;
            height: 12px;

            transform:
                translate(-50%,-50%);

            border-radius: 50%;

            background:
                linear-gradient(
                    90deg,
                    #090a0d,
                    #656b72,
                    #0b0c0f
                );

            box-shadow:
                0 0 0 1px
                rgba(216,181,106,.08);
        }

        .shin {
            position: absolute;

            left: 50%;
            top: 132px;

            width: 70px;
            height: 133px;

            transform:
                translateX(-50%);

            border-radius: 24px;

            background:
                linear-gradient(
                    95deg,
                    #08090b,
                    #737880 22%,
                    #d5d9dd 36%,
                    #25282d 55%,
                    #08090b 75%,
                    #8d9299
                );

            border:
                1px solid
                rgba(210,214,220,.2);

            box-shadow:
                inset 6px 0 10px
                rgba(255,255,255,.07),

                inset -8px -9px 14px
                rgba(0,0,0,.68);
        }

        .foot {
            position: absolute;

            left: 50%;
            top: 248px;

            width: 112px;
            height: 54px;

            transform:
                translateX(-50%);

            border-radius:
                18px
                39px
                14px
                18px;

            background:
                linear-gradient(
                    145deg,
                    #050608,
                    #70757d 26%,
                    #c9cdd2 40%,
                    #25282d 58%,
                    #08090b 78%
                );

            border:
                1px solid
                rgba(210,214,220,.22);

            box-shadow:
                inset 5px 3px 10px
                rgba(255,255,255,.09),

                inset -8px -7px 11px
                rgba(0,0,0,.65),

                0 10px 18px
                rgba(0,0,0,.6);
        }

        .foot::after {
            content: "";

            position: absolute;

            left: 18px;
            right: 18px;
            bottom: 9px;

            height: 2px;

            border-radius: 50%;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(173,108,216,.42),
                    rgba(216,181,106,.38),
                    transparent
                );

            box-shadow:
                0 0 7px
                rgba(163,92,209,.22);
        }


        /* =========================================================
           ROBOT SHADOW
        ========================================================= */

        .robot-shadow {
            position: absolute;

            left: 50%;
            bottom: 0;

            width: 370px;
            height: 55px;

            transform:
                translateX(-50%)
                scaleX(var(--shadow-scale,1));

            border-radius: 50%;

            background:
                radial-gradient(
                    ellipse,
                    rgba(0,0,0,.95),
                    rgba(45,13,65,.20) 50%,
                    rgba(0,0,0,.25) 64%,
                    transparent
                );

            filter: blur(8px);

            z-index: 0;
        }


        /* =========================================================
           GHOST TEXT
        ========================================================= */

        .ghost-text {
            position: absolute;

            left: 50%;
            top: 49%;

            transform:
                translate(-50%,-50%)
                scale(1.08);

            z-index: 5;

            font-family:
                "Montserrat",
                sans-serif;

            font-size:
                clamp(90px,17vw,260px);

            font-weight: 900;

            letter-spacing: -.07em;

            white-space: nowrap;

            color: transparent;

            -webkit-text-stroke:
                1px rgba(178,112,220,.05);

            opacity: 0;
        }

        .ghost-text.active {

            animation:
                ghostReveal
                1.8s
                ease
                forwards;

        }

        @keyframes ghostReveal {

            from {
                opacity: 0;

                transform:
                    translate(-50%,-50%)
                    scale(1.2);
            }

            to {
                opacity: 1;

                transform:
                    translate(-50%,-50%)
                    scale(1.08);
            }

        }


        /* =========================================================
           TITLE
        ========================================================= */

        .title-container {
            position: absolute;

            left: 50%;
            top: 52%;

            transform:
                translate(-50%, -50%)
                scale(.72);

            z-index: 120;

            text-align: center;

            opacity: 0;

            pointer-events: none;

            will-change:
                transform,
                opacity,
                filter;
        }

        .title-container.active {

            animation:
                titleFromLight
                1.35s
                cubic-bezier(.16,1,.3,1)
                forwards;

        }

        @keyframes titleFromLight {

            0% {
                opacity: 0;

                transform:
                    translate(-50%, -50%)
                    scale(.35);

                filter:
                    blur(16px)
                    brightness(2.5);
            }

            30% {
                opacity: 1;
            }

            62% {
                transform:
                    translate(-50%, -50%)
                    scale(1.08);

                filter:
                    blur(0)
                    brightness(1.35);
            }

            100% {
                opacity: 1;

                transform:
                    translate(-50%, -50%)
                    scale(1);

                filter:
                    blur(0)
                    brightness(1);
            }

        }

        .title {
            font-family:
                "Montserrat",
                sans-serif;

            font-size:
                clamp(48px, 7vw, 100px);

            line-height: .9;

            font-weight: 900;

            letter-spacing: .055em;

            white-space: nowrap;

            background:
                linear-gradient(
                    100deg,
                    #fffdfd 0%,
                    #fffafc 15%,
                    #eadcf0 28%,
                    #d6b8e8 40%,
                    #b784d0 48%,
                    #e6c3cf 56%,
                    #e2c58d 66%,
                    #ead9ef 80%,
                    #fffdfd 100%
                );

            -webkit-background-clip: text;
            background-clip: text;

            color: transparent;

            filter:
                drop-shadow(
                    0 10px 25px
                    rgba(0,0,0,.82)
                )

                drop-shadow(
                    0 0 25px
                    rgba(139,72,190,.24)
                );
        }

        .title-line {
            width: 150px;
            height: 2px;

            margin:
                18px auto 0;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    #fff 20%,
                    #b27acb 40%,
                    #d8b56a 50%,
                    #b27acb 60%,
                    #fff 80%,
                    transparent
                );

            box-shadow:
                0 0 11px
                rgba(143,76,200,.48);
        }

        .subtitle {
            margin-top: 12px;

            font-size: 8px;

            font-weight: 600;

            letter-spacing: .58em;

            padding-left: .58em;

            color:
                rgba(224,197,237,.48);
        }


        /* =========================================================
           FINAL FADE TO BLACK
        ========================================================= */

        .final-flash {
            position: absolute;
            inset: 0;

            z-index: 1000;

            background: #000;

            opacity: 0;

            pointer-events: none;
        }

        .final-flash.active {

            animation:
                fadeToBlack
                1.15s
                cubic-bezier(.65,0,.35,1)
                forwards;

        }

        @keyframes fadeToBlack {

            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }

        }


        /* =========================================================
           VIGNETTE
        ========================================================= */

        .vignette {
            position: absolute;
            inset: -10%;

            z-index: 180;

            pointer-events: none;

            background:
                radial-gradient(
                    ellipse at center,
                    transparent 28%,
                    rgba(47,19,65,.16) 55%,
                    rgba(5,2,9,.78) 100%
                );
        }

        .top-dark {
            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 30%;

            z-index: 170;

            pointer-events: none;

            background:
                linear-gradient(
                    to bottom,
                    rgba(7,3,13,.86),
                    transparent
                );
        }

        .bottom-dark {
            position: absolute;

            bottom: 0;
            left: 0;

            width: 100%;
            height: 33%;

            z-index: 170;

            pointer-events: none;

            background:
                linear-gradient(
                    to top,
                    rgba(6,2,11,.88),
                    transparent
                );
        }


        /* =========================================================
           SCAN
        ========================================================= */

        .scan-line {
            position: absolute;

            left: 0;
            top: -5%;

            width: 100%;
            height: 1px;

            z-index: 175;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(180,116,220,.15),
                    rgba(255,226,238,.08),
                    rgba(180,116,220,.15),
                    transparent
                );

            opacity: .25;

            animation:
                scanMove
                7s
                2s
                linear
                infinite;
        }

        @keyframes scanMove {

            from {
                top: -5%;
            }

            to {
                top: 105%;
            }

        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 700px) {

            .robot-stage {
                top: 56%;
                width: 500px;
                height: 680px;
            }

            .robot-entrance {
                transform:
                    translateY(80px)
                    scale(.82);
            }

            .robot {
                transform:
                    translateX(-50%)
                    translateY(var(--robot-y,0px))
                    rotateY(var(--robot-yaw,0deg))
                    rotateZ(var(--robot-roll,0deg))
                    scale(.72);

                transform-origin:
                    top center;
            }

            .title-container {
                top: 52%;
            }

            .title {
                font-size: 39px;
                letter-spacing: .04em;
            }

            .subtitle {
                font-size: 6px;
                letter-spacing: .38em;
                padding-left: .38em;
            }

            .ghost-text {
                font-size: 72px;
            }

        }

        @media (max-height: 700px) and (min-width: 701px) {

            .robot-stage {
                top: 57%;

                transform:
                    translate(-50%, -50%)
                    scale(.84);
            }

            .title {
                font-size: 72px;
            }

        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }

        }

    </style>
</head>


<body>

<main class="scene" id="scene">

    <div class="black-cover"></div>

    <div class="ambient"></div>

    <div class="floor"></div>


    <!-- =====================================================
         PARTICLES
    ====================================================== -->

    <div class="particles">

        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>
        <span class="particle"></span>

    </div>


    <!-- =====================================================
         GHOST LOGO
    ====================================================== -->

    <div class="ghost-text" id="ghostText">
        WHISPERLY
    </div>


    <!-- =====================================================
         ORB
    ====================================================== -->

    <div class="orb-layer">

        <div
            class="light-orb"
            id="lightOrb">
        </div>

        <div
            class="orb-burst"
            id="orbBurst">
        </div>

        <div
            class="energy-ring"
            id="energyRing">
        </div>

    </div>


    <!-- =====================================================
         ROBOT
    ====================================================== -->

    <div class="robot-stage">

        <div class="robot-entrance">

            <div
                class="robot"
                id="robot">

                <div class="robot-glow"></div>


                <div
                    class="robot-shadow"
                    id="robotShadow">
                </div>


                <!-- HEAD -->

                <div
                    class="head-group"
                    id="headGroup">

                    <div class="head">

                        <div class="face">

                            <div class="visor">

                                <div class="visor-line"></div>

                                <div class="eyes">

                                    <span class="eye left"></span>
                                    <span class="eye right"></span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- NECK -->

                <div class="neck">

                    <div class="neck-ring"></div>

                </div>


                <!-- SHOULDERS -->

                <div
                    class="shoulder left"
                    id="leftShoulder">
                </div>

                <div
                    class="shoulder right"
                    id="rightShoulder">
                </div>


                <!-- BODY -->

                <div
                    class="body"
                    id="body">

                    <div class="inner-chest"></div>

                    <div class="chest-plate">

                        <div class="core"></div>

                        <div class="core-line"></div>

                    </div>

                </div>


                <!-- LEFT ARM -->

                <div
                    class="arm left"
                    id="leftArm">

                    <div class="upper-arm"></div>

                    <div class="elbow"></div>

                    <div class="forearm"></div>

                    <div
                        class="hand"
                        id="leftHand">

                        <span class="finger"></span>
                        <span class="finger"></span>
                        <span class="finger"></span>
                        <span class="finger"></span>

                    </div>

                </div>


                <!-- RIGHT ARM -->

                <div
                    class="arm right"
                    id="rightArm">

                    <div class="upper-arm"></div>

                    <div class="elbow"></div>

                    <div class="forearm"></div>

                    <div
                        class="hand"
                        id="rightHand">

                        <span class="finger"></span>
                        <span class="finger"></span>
                        <span class="finger"></span>
                        <span class="finger"></span>

                    </div>

                </div>


                <!-- WAIST -->

                <div class="waist">

                    <div class="waist-line"></div>

                </div>


                <!-- LEFT LEG -->

                <div
                    class="leg left"
                    id="leftLeg">

                    <div class="knee"></div>

                    <div class="shin"></div>

                    <div class="foot"></div>

                </div>


                <!-- RIGHT LEG -->

                <div
                    class="leg right"
                    id="rightLeg">

                    <div class="knee"></div>

                    <div class="shin"></div>

                    <div class="foot"></div>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         TITLE
    ====================================================== -->

    <div
        class="title-container"
        id="titleContainer">

        <div class="title">
            WHISPERLY
        </div>

        <div class="title-line"></div>

        <div class="subtitle">
            YOUR THOUGHTS • YOUR SPACE
        </div>

    </div>


    <div class="scan-line"></div>

    <div class="top-dark"></div>

    <div class="bottom-dark"></div>

    <div class="vignette"></div>


    <!-- =====================================================
         FINAL BLACK TRANSITION
    ====================================================== -->

    <div
        class="final-flash"
        id="finalFlash">
    </div>

</main>



<script>

(() => {

    /* =========================================================
       ELEMENTS
    ========================================================= */

    const orb =
        document.getElementById("lightOrb");

    const burst =
        document.getElementById("orbBurst");

    const ring =
        document.getElementById("energyRing");

    const robot =
        document.getElementById("robot");

    const head =
        document.getElementById("headGroup");

    const body =
        document.getElementById("body");

    const leftArm =
        document.getElementById("leftArm");

    const rightArm =
        document.getElementById("rightArm");

    const leftHand =
        document.getElementById("leftHand");

    const rightHand =
        document.getElementById("rightHand");

    const leftShoulder =
        document.getElementById("leftShoulder");

    const rightShoulder =
        document.getElementById("rightShoulder");

    const leftLeg =
        document.getElementById("leftLeg");

    const rightLeg =
        document.getElementById("rightLeg");

    const shadow =
        document.getElementById("robotShadow");

    const title =
        document.getElementById("titleContainer");

    const ghost =
        document.getElementById("ghostText");

    const finalFlash =
        document.getElementById("finalFlash");

    const scene =
        document.getElementById("scene");


    /* =========================================================
       SMOOTH STATE
    ========================================================= */

    let current = {
        x: 0,
        y: 0,
        opacity: 0
    };

    let previous = {
        x: 0,
        y: 0
    };


    /*
     * State khusus robot.
     *
     * Robot tidak langsung mengikuti orb.
     * Setiap bagian mempunyai sedikit delay supaya
     * gerakannya terasa seperti mechanical cinematic
     * movement, bukan animasi patah.
     */

    let robotMotion = {

        x: 0,
        y: 0,

        headX: 0,
        headY: 0,

        bodyX: 0,
        bodyY: 0,

        leftArm: 0,
        rightArm: 0,

        leftShoulder: 0,
        rightShoulder: 0,

        leftHand: 0,
        rightHand: 0,

        legWeight: 0

    };


    /* =========================================================
       LERP
    ========================================================= */

    function lerp(a, b, amount) {

        return a + (b - a) * amount;

    }


    function clamp(value, min, max) {

        return Math.max(
            min,
            Math.min(max, value)
        );

    }


    function ease(t) {

        return t * t * (3 - 2 * t);

    }


    /* =========================================================
       LIGHT PATH
    ========================================================= */

    const path = [

        {
            t: 0.0,
            x: 0.00,
            y: 0.00,
            o: 0.00
        },

        {
            t: 1.35,
            x: 0.00,
            y: -0.02,
            o: 0.00
        },

        {
            t: 1.65,
            x: 0.00,
            y: -0.02,
            o: 1.00
        },

        {
            t: 2.20,
            x: -0.28,
            y: -0.25,
            o: 1.00
        },

        {
            t: 2.85,
            x: -0.58,
            y: -0.04,
            o: 1.00
        },

        {
            t: 3.45,
            x: -0.42,
            y: 0.28,
            o: 1.00
        },

        {
            t: 4.10,
            x: -0.05,
            y: 0.40,
            o: 1.00
        },

        {
            t: 4.75,
            x: 0.38,
            y: 0.29,
            o: 1.00
        },

        {
            t: 5.35,
            x: 0.60,
            y: 0.02,
            o: 1.00
        },

        {
            t: 5.95,
            x: 0.43,
            y: -0.27,
            o: 1.00
        },

        {
            t: 6.55,
            x: 0.05,
            y: -0.43,
            o: 1.00
        },

        {
            t: 7.10,
            x: -0.30,
            y: -0.30,
            o: 1.00
        },

        {
            t: 7.75,
            x: -0.08,
            y: -0.10,
            o: 1.00
        },

        {
            t: 8.15,
            x: 0.00,
            y: 0.00,
            o: 1.00
        },

        {
            t: 8.82,
            x: 0.00,
            y: 0.00,
            o: 1.00
        },

        {
            t: 9.45,
            x: 0.00,
            y: 0.00,
            o: 0.72
        },

        {
            t: 10.00,
            x: 0.00,
            y: 0.00,
            o: 0.00
        }

    ];


    function getPath(time) {

        for (
            let i = 0;
            i < path.length - 1;
            i++
        ) {

            const a = path[i];
            const b = path[i + 1];

            if (
                time >= a.t &&
                time <= b.t
            ) {

                let p =
                    (time - a.t) /
                    (b.t - a.t);

                p = ease(p);

                return {

                    x: lerp(a.x, b.x, p),
                    y: lerp(a.y, b.y, p),
                    o: lerp(a.o, b.o, p)

                };

            }

        }

        return path[path.length - 1];

    }


    /* =========================================================
       UPDATE LIGHT
    ========================================================= */

    function updateLight(x, y, opacity) {

        const centerX =
            window.innerWidth / 2;

        const centerY =
            window.innerHeight * .52;


        const radiusX =
            Math.min(
                window.innerWidth * .30,
                430
            );


        const radiusY =
            Math.min(
                window.innerHeight * .27,
                225
            );


        const px =
            centerX +
            x * radiusX;


        const py =
            centerY +
            y * radiusY;


        orb.style.left =
            `${px}px`;

        orb.style.top =
            `${py}px`;

        orb.style.opacity =
            opacity;


        const dx =
            x - previous.x;

        const dy =
            y - previous.y;


        const velocity =
            Math.sqrt(
                dx * dx +
                dy * dy
            );


        const scale =
            1 +
            clamp(
                velocity * 3,
                0,
                .55
            );


        orb.style.transform =
            `scale(${scale})`;


        previous.x = x;
        previous.y = y;

    }


    /* =========================================================
       PREMIUM ROBOT MOVEMENT
    ========================================================= */

    function updateRobot(x, y, time) {

        /*
         * -----------------------------------------------------
         * SMOOTH FOLLOW
         * -----------------------------------------------------
         *
         * Nilai orb tidak langsung diberikan ke robot.
         * Ini membuat robot seperti mempunyai berat.
         */

        robotMotion.x =
            lerp(
                robotMotion.x,
                x,
                .045
            );

        robotMotion.y =
            lerp(
                robotMotion.y,
                y,
                .045
            );


        const rx =
            robotMotion.x;

        const ry =
            robotMotion.y;


        /* =====================================================
           HEAD
        ===================================================== */

        robotMotion.headX =
            lerp(
                robotMotion.headX,
                rx,
                .075
            );

        robotMotion.headY =
            lerp(
                robotMotion.headY,
                ry,
                .075
            );


        const headX =
            robotMotion.headX;

        const headY =
            robotMotion.headY;


        /*
         * Gerakan kepala lebih dominan.
         * Ini membuat robot terlihat benar-benar
         * memperhatikan cahaya.
         */

        const headYaw =
            headX * 37;

        const headPitch =
            headY * -18;

        const headRoll =
            headX * -5.5;

        const headOffset =
            headY * 5;


        head.style.setProperty(
            "--head-yaw",
            `${headYaw}deg`
        );

        head.style.setProperty(
            "--head-pitch",
            `${headPitch}deg`
        );

        head.style.setProperty(
            "--head-roll",
            `${headRoll}deg`
        );

        head.style.setProperty(
            "--head-y",
            `${headOffset}px`
        );


        /* =====================================================
           EYES
        ===================================================== */

        const eyes =
            document.querySelector(".eyes");


        eyes.style.setProperty(
            "--eye-x",
            `${headX * 8}px`
        );

        eyes.style.setProperty(
            "--eye-y",
            `${headY * 4}px`
        );


        /* =====================================================
           BODY
        ===================================================== */

        robotMotion.bodyX =
            lerp(
                robotMotion.bodyX,
                rx,
                .032
            );

        robotMotion.bodyY =
            lerp(
                robotMotion.bodyY,
                ry,
                .032
            );


        const bodyX =
            robotMotion.bodyX;

        const bodyY =
            robotMotion.bodyY;


        body.style.setProperty(
            "--body-yaw",
            `${bodyX * 9}deg`
        );

        body.style.setProperty(
            "--body-pitch",
            `${bodyY * -4}deg`
        );


        /* =====================================================
           ROBOT FLOATING
        ===================================================== */

        const breathing =
            Math.sin(time * 1.8) * 1.7;

        const floating =
            Math.sin(time * 1.05) * 2.5;

        const secondaryFloat =
            Math.sin(time * .72 + 1.2) * 1.2;


        const movementY =
            breathing +
            floating +
            secondaryFloat -
            bodyY * 4;


        robot.style.setProperty(
            "--robot-y",
            `${movementY}px`
        );


        robot.style.setProperty(
            "--robot-yaw",
            `${bodyX * 4.2}deg`
        );


        robot.style.setProperty(
            "--robot-roll",
            `${bodyX * -2.4}deg`
        );


        /* =====================================================
           ARMS
        ===================================================== */

        /*
         * Lengan mempunyai smoothing sendiri.
         * Karena itu saat orb berbelok tajam,
         * tangan tidak langsung lompat.
         */

        const leftTarget =
            clamp(
                (-rx + .08) / 1.1,
                0,
                1
            );

        const rightTarget =
            clamp(
                (rx + .08) / 1.1,
                0,
                1
            );


        robotMotion.leftArm =
            lerp(
                robotMotion.leftArm,
                leftTarget,
                .055
            );

        robotMotion.rightArm =
            lerp(
                robotMotion.rightArm,
                rightTarget,
                .055
            );


        const leftInfluence =
            robotMotion.leftArm;

        const rightInfluence =
            robotMotion.rightArm;


        const vertical =
            bodyY * 10;


        /*
         * Secondary mechanical motion.
         */

        const armWave =
            Math.sin(
                time * 1.25
            ) * .8;


        const leftRotation =
            7 +
            leftInfluence * 34 -
            rightInfluence * 5 -
            bodyY * 9 +
            armWave;


        leftArm.style.transform =
            `
            rotateZ(${leftRotation}deg)
            rotateY(${leftInfluence * -10}deg)
            translateY(${vertical * .16}px)
            `;


        const rightRotation =
            -7 -
            rightInfluence * 34 +
            leftInfluence * 5 +
            bodyY * 9 -
            armWave;


        rightArm.style.transform =
            `
            rotateZ(${rightRotation}deg)
            rotateY(${rightInfluence * 10}deg)
            translateY(${vertical * .16}px)
            `;


        /* =====================================================
           SHOULDERS
        ===================================================== */

        robotMotion.leftShoulder =
            lerp(
                robotMotion.leftShoulder,
                leftInfluence,
                .065
            );

        robotMotion.rightShoulder =
            lerp(
                robotMotion.rightShoulder,
                rightInfluence,
                .065
            );


        const shoulderL =
            robotMotion.leftShoulder;

        const shoulderR =
            robotMotion.rightShoulder;


        leftShoulder.style.transform =
            `
            rotate(
                ${-13 + shoulderL * 13}deg
            )
            translateY(
                ${shoulderL * -4}px
            )
            `;


        rightShoulder.style.transform =
            `
            rotate(
                ${13 - shoulderR * 13}deg
            )
            translateY(
                ${shoulderR * -4}px
            )
            `;


        /* =====================================================
           HANDS
        ===================================================== */

        robotMotion.leftHand =
            lerp(
                robotMotion.leftHand,
                rx,
                .07
            );

        robotMotion.rightHand =
            lerp(
                robotMotion.rightHand,
                rx,
                .07
            );


        const handX =
            robotMotion.leftHand;


        const handRotation =
            handX * -18 +
            bodyY * 7;


        const handPitch =
            bodyY * -11;


        leftHand.style.setProperty(
            "--hand-rotate",
            `${handRotation}deg`
        );

        leftHand.style.setProperty(
            "--hand-pitch",
            `${handPitch}deg`
        );


        rightHand.style.setProperty(
            "--hand-rotate",
            `${handRotation}deg`
        );

        rightHand.style.setProperty(
            "--hand-pitch",
            `${handPitch}deg`
        );


        /* =====================================================
           LEGS
        ===================================================== */

        robotMotion.legWeight =
            lerp(
                robotMotion.legWeight,
                rx,
                .025
            );


        const weight =
            robotMotion.legWeight * 2.5;


        const legBreath =
            Math.sin(
                time * 1.15
            ) * .45;


        leftLeg.style.transform =
            `
            rotateZ(
                ${1.3 + weight + legBreath}deg
            )
            `;


        rightLeg.style.transform =
            `
            rotateZ(
                ${-1.3 + weight - legBreath}deg
            )
            `;


        /* =====================================================
           SHADOW
        ===================================================== */

        shadow.style.setProperty(
            "--shadow-scale",
            `${1 + Math.abs(bodyY) * .18}`
        );

    }


    /* =========================================================
       TIMELINE
    ========================================================= */

    const start =
        performance.now();

    let burstStarted = false;

    let titleStarted = false;


    function animate(now) {

        const time =
            (now - start) / 1000;


        const target =
            getPath(time);


        current.x =
            lerp(
                current.x,
                target.x,
                .075
            );


        current.y =
            lerp(
                current.y,
                target.y,
                .075
            );


        current.opacity =
            lerp(
                current.opacity,
                target.o,
                .10
            );


        updateLight(
            current.x,
            current.y,
            current.opacity
        );


        updateRobot(
            current.x,
            current.y,
            time
        );


        /* =====================================================
           ROBOT REDUP
        ===================================================== */

        if (
            time >= 8.30 &&
            time < 9.05
        ) {

            const fadeProgress =
                clamp(
                    (time - 8.30) / .75,
                    0,
                    1
                );


            const robotOpacity =
                lerp(
                    1,
                    .16,
                    ease(fadeProgress)
                );


            const robotBrightness =
                lerp(
                    1,
                    1.75,
                    ease(fadeProgress)
                );


            const robotBlur =
                lerp(
                    0,
                    2,
                    ease(fadeProgress)
                );


            robot.style.opacity =
                robotOpacity;


            robot.style.filter =
                `
                brightness(${robotBrightness})
                blur(${robotBlur}px)
                drop-shadow(
                    0 30px 35px
                    rgba(0,0,0,.55)
                )
                `;

        }


        /* =====================================================
           BURST
        ===================================================== */

        if (
            time >= 8.82 &&
            !burstStarted
        ) {

            burstStarted = true;

            burst.classList.add(
                "active"
            );

            ring.classList.add(
                "active"
            );

        }


        /* =====================================================
           TITLE
        ===================================================== */

        if (
            time >= 9.05 &&
            !titleStarted
        ) {

            titleStarted = true;

            ghost.classList.add(
                "active"
            );

            title.classList.add(
                "active"
            );

        }


        /* =====================================================
           ROBOT HILANG SAAT TITLE
        ===================================================== */

        if (
            time >= 9.05 &&
            time < 9.65
        ) {

            const restoreProgress =
                clamp(
                    (time - 9.05) / .60,
                    0,
                    1
                );


            const robotOpacity =
                lerp(
                    .16,
                    0,
                    ease(restoreProgress)
                );


            robot.style.opacity =
                robotOpacity;


            robot.style.filter =
                `
                brightness(1.75)
                blur(2px)
                drop-shadow(
                    0 30px 35px
                    rgba(0,0,0,.55)
                )
                `;

        }


        if (
            time < 10.25
        ) {

            requestAnimationFrame(
                animate
            );

        }

    }


    requestAnimationFrame(
        animate
    );


    /* =========================================================
       MOUSE PARALLAX
    ========================================================= */

    window.addEventListener(
        "mousemove",
        event => {

            const mx =
                (
                    event.clientX /
                    window.innerWidth
                ) - .5;


            const my =
                (
                    event.clientY /
                    window.innerHeight
                ) - .5;


            scene.style.setProperty(
                "--mouse-x",
                `${mx * 5}px`
            );


            scene.style.setProperty(
                "--mouse-y",
                `${my * 3}px`
            );

        }
    );


    /* =========================================================
       EXIT
    ========================================================= */

    let leaving = false;


    function goToLogin() {

        if (leaving) return;

        leaving = true;


        /*
         * Fade ke hitam terlebih dahulu.
         */

        finalFlash.classList.add(
            "active"
        );


        /*
         * Setelah layar benar-benar hitam,
         * baru pindah ke halaman login.
         */

        setTimeout(
            () => {

                window.location.href =
                    "{{ url('/login-baru') }}";

            },
            1250
        );

    }


    /* =========================================================
       CLICK
    ========================================================= */

    scene.addEventListener(
        "click",
        goToLogin
    );


    /* =========================================================
       AUTO REDIRECT
    ========================================================= */

    setTimeout(
        () => {

            goToLogin();

        },
        11000
    );

})();

</script>

</body>
</html>