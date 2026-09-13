<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ ucfirst($talent->pengguna->username) }} - Whisperly
    </title>


    <style>

        /* =========================================================
           RESET
        ========================================================= */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;

            color: #f8f4ff;

            font-family:
                "Segoe UI",
                Inter,
                Arial,
                sans-serif;

            background:
                radial-gradient(
                    circle at 8% 8%,
                    rgba(130, 71, 211, .28),
                    transparent 25%
                ),
                radial-gradient(
                    circle at 88% 12%,
                    rgba(195, 145, 62, .15),
                    transparent 22%
                ),
                radial-gradient(
                    circle at 72% 78%,
                    rgba(103, 49, 180, .23),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 12% 90%,
                    rgba(151, 82, 221, .14),
                    transparent 25%
                ),
                linear-gradient(
                    135deg,
                    #05040b 0%,
                    #0b0716 25%,
                    #150c2a 52%,
                    #0c0718 78%,
                    #04030a 100%
                );

            background-attachment: fixed;
        }


        /* =========================================================
           AMBIENT BACKGROUND
        ========================================================= */

        body::before {
            content: "";

            position: fixed;
            inset: -20%;

            pointer-events: none;

            background:
                radial-gradient(
                    ellipse at 25% 20%,
                    rgba(117, 57, 208, .16),
                    transparent 32%
                ),
                radial-gradient(
                    ellipse at 75% 30%,
                    rgba(213, 169, 83, .08),
                    transparent 30%
                );

            filter: blur(50px);

            animation:
                ambientMove 14s ease-in-out infinite alternate;

            z-index: -3;
        }

        @keyframes ambientMove {

            0% {
                transform:
                    translate3d(-2%, -1%, 0)
                    scale(1);
            }

            100% {
                transform:
                    translate3d(2%, 2%, 0)
                    scale(1.08);
            }

        }


        /* =========================================================
           BACKGROUND ORBS
        ========================================================= */

        .light-orb {
            position: fixed;

            border-radius: 50%;

            pointer-events: none;

            filter: blur(2px);

            z-index: -2;
        }

        .orb-one {
            width: 230px;
            height: 230px;

            top: 15%;
            left: -100px;

            background:
                radial-gradient(
                    circle,
                    rgba(142, 74, 235, .18),
                    transparent 68%
                );

            animation:
                floatOne 12s ease-in-out infinite;
        }

        .orb-two {
            width: 300px;
            height: 300px;

            right: -120px;
            bottom: 5%;

            background:
                radial-gradient(
                    circle,
                    rgba(215, 174, 92, .09),
                    transparent 68%
                );

            animation:
                floatTwo 15s ease-in-out infinite;
        }

        @keyframes floatOne {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(45px, 30px);
            }

        }

        @keyframes floatTwo {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-40px, -35px);
            }

        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar-wrapper {
            position: relative;
            z-index: 20;
        }


        /* =========================================================
           MAIN
        ========================================================= */

        main {
            position: relative;

            width: 100%;

            padding:
                30px
                60px
                80px;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .success,
        .error {
            position: relative;

            width: 100%;

            margin-bottom: 24px;

            padding:
                15px
                19px;

            border-radius: 16px;

            backdrop-filter: blur(18px);

            box-shadow:
                0 20px 50px rgba(0, 0, 0, .22);
        }

        .success {
            border:
                1px solid
                rgba(220, 181, 91, .35);

            background:
                linear-gradient(
                    135deg,
                    rgba(70, 49, 35, .75),
                    rgba(44, 31, 58, .72)
                );

            color: #f0d890;
        }

        .error {
            border:
                1px solid
                rgba(215, 111, 163, .35);

            background:
                linear-gradient(
                    135deg,
                    rgba(65, 29, 53, .76),
                    rgba(38, 19, 48, .74)
                );

            color: #efb6d1;
        }

        .error ul {
            margin-top: 6px;
            padding-left: 20px;
        }


        /* =========================================================
           MAIN LAYOUT
        ========================================================= */

        .profile-layout {
            position: relative;

            width: 100%;

            display: grid;

            grid-template-columns:
                370px
                minmax(0, 1fr);

            gap: 80px;

            align-items: start;
        }


        /* =========================================================
           PROFILE
        ========================================================= */

        .profile-column {
            position: sticky;

            top: 95px;

            width: 100%;

            padding:
                30px 0;

            background: transparent;

            text-align: center;
        }


        /* =========================================================
           PHOTO
        ========================================================= */

        .photo-stage {
            position: relative;

            width: 210px;
            height: 210px;

            margin:
                0 auto 30px;
        }

        .photo-stage::before {
            content: "";

            position: absolute;

            inset: -15px;

            border-radius: 50%;

            background:
                conic-gradient(
                    from 0deg,
                    transparent 0deg,
                    rgba(230, 193, 105, .9) 45deg,
                    transparent 95deg,
                    rgba(121, 67, 204, .75) 180deg,
                    transparent 245deg,
                    rgba(230, 193, 105, .75) 320deg,
                    transparent 360deg
                );

            filter: blur(1px);

            animation:
                rotateRing 8s linear infinite;
        }

        .photo-stage::after {
            content: "";

            position: absolute;

            inset: -35px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(150, 82, 235, .24),
                    transparent 67%
                );

            filter: blur(12px);

            z-index: -1;
        }

        @keyframes rotateRing {

            to {
                transform: rotate(360deg);
            }

        }

        .photo-ring {
            position: absolute;

            inset: 0;

            padding: 5px;

            border-radius: 50%;

            background:
                linear-gradient(
                    145deg,
                    #fff0b4,
                    #c9973d 25%,
                    #f4d88c 48%,
                    #9e7130 75%,
                    #f0ce78
                );

            box-shadow:
                0 0 0 2px rgba(255, 255, 255, .06),
                0 0 35px rgba(210, 164, 72, .24),
                0 25px 60px rgba(0, 0, 0, .45);
        }

        .profile-photo {
            width: 100%;
            height: 100%;

            overflow: hidden;

            border-radius: 50%;

            background:
                linear-gradient(
                    145deg,
                    #25163d,
                    #0d0819
                );
        }

        .profile-photo img {
            display: block;

            width: 100%;
            height: 100%;

            object-fit: cover;

            transition:
                transform .7s cubic-bezier(.2, .8, .2, 1);
        }

        .photo-stage:hover .profile-photo img {
            transform: scale(1.06);
        }

        .online-dot {
            position: absolute;

            right: 13px;
            bottom: 15px;

            width: 18px;
            height: 18px;

            border:
                3px solid
                #10091c;

            border-radius: 50%;

            background: #b99752;

            box-shadow:
                0 0 0 5px rgba(185, 151, 82, .12),
                0 0 18px rgba(185, 151, 82, .75);
        }


        /* =========================================================
           PROFILE TEXT
        ========================================================= */

        .profile-info {
            width: 100%;

            text-align: center;
        }

        .profile-label {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            margin-bottom: 12px;

            color: #c9a858;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: .22em;

            text-transform: uppercase;
        }

        .profile-label::before {
            content: "";

            width: 25px;
            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    #e2bd69,
                    transparent
                );
        }

        .profile-name {
            margin: 0;

            color: #fff;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 39px;
            font-weight: 500;

            line-height: 1.08;

            letter-spacing: -.025em;

            text-shadow:
                0 8px 35px rgba(0, 0, 0, .35);
        }

        .email {
            margin-top: 9px;

            color: #9389a5;

            font-size: 12px;

            word-break: break-word;

            text-align: center;
        }

        .profile-divider {
            width: 100%;
            height: 1px;

            margin:
                16px
                0
                10px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(220, 181, 91, .8),
                    rgba(220, 181, 91, .18),
                    transparent
                );
        }


        /* =========================================================
           DESCRIPTION
        ========================================================= */

        .description-wrapper {
            width: 100%;

            min-height: 80px;

            padding:
                8px
                12px
                10px !important;

            border-radius: 11px;

            background:
                linear-gradient(
                    145deg,
                    rgba(216, 181, 106, .10),
                    rgba(75, 38, 112, .18)
                );

            border:
                1px solid
                rgba(216, 181, 106, .24);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, .04),
                0 8px 20px rgba(0, 0, 0, .12);

            display: block !important;

            text-align: left;
        }

        .description-title {
            margin:
                0 !important;

            padding:
                0 !important;

            color: #e8ca7b;

            font-size: 17px;
            font-weight: 800;

            line-height: 1 !important;

            letter-spacing: .02em;
        }

        .description {
            width: 100%;

            margin:
                15px
                0
                0 !important;

            padding:
                0 !important;

            color: #c8bdd6;

            font-size: 13px;

            line-height: 1.4 !important;

            white-space: pre-line;

            text-align: left;
        }


        /* =========================================================
           SCHEDULE COLUMN
        ========================================================= */

        .schedule-column {
            position: relative;

            width: 100%;

            min-width: 0;
        }

        .schedule-column::before {
            content: "";

            position: absolute;

            top: -80px;
            right: -80px;

            width: 320px;
            height: 320px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(128, 67, 214, .13),
                    transparent 70%
                );

            filter: blur(10px);

            pointer-events: none;
        }


        /* =========================================================
           SCHEDULE HEADER
        ========================================================= */

        .schedule-header {
            position: relative;

            margin:
                24px
                0
                25px;
        }

        .schedule-eyebrow {
            display: flex;

            align-items: center;

            gap: 11px;

            margin-bottom: 10px;

            color: #cda957;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: .25em;

            text-transform: uppercase;
        }

        .schedule-eyebrow::before {
            content: "";

            width: 32px;
            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    #d8b365,
                    transparent
                );
        }

        .schedule-title {
            color: #fff;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 43px;
            font-weight: 500;

            line-height: 1.08;

            letter-spacing: -.025em;
        }

        .schedule-subtitle {
            max-width: 650px;

            margin-top: 10px;

            color: #9389a5;

            font-size: 13px;

            line-height: 1.6;
        }


        /* =========================================================
           LEGEND
        ========================================================= */

        .legend {
            display: flex;

            flex-wrap: wrap;

            gap: 9px;

            margin-bottom: 22px;
        }

        .legend-item {
            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                8px
                13px;

            border:
                1px solid
                rgba(166, 126, 212, .18);

            border-radius: 999px;

            background:
                rgba(28, 17, 45, .54);

            color: #a9a0b8;

            font-size: 10px;
            font-weight: 700;

            backdrop-filter: blur(14px);
        }

        .legend-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;
        }

        .legend-dot.green {
            background: #42e88b;

            box-shadow:
                0 0 12px rgba(66, 232, 139, .9);
        }

        .legend-dot.gray {
            background: #eadcae;

            box-shadow:
                0 0 9px rgba(234, 220, 174, .55);
        }

        .legend-dot.red {
            background: #ff416c;

            box-shadow:
                0 0 13px rgba(255, 65, 108, .9);
        }


        /* =========================================================
           SCHEDULE FRAME
        ========================================================= */

        .schedule-shell {
            position: relative;

            padding: 2px;

            border-radius: 28px;

            background:
                linear-gradient(
                    135deg,
                    rgba(224, 188, 103, .5),
                    rgba(109, 69, 167, .18) 28%,
                    rgba(255, 255, 255, .04) 55%,
                    rgba(193, 148, 66, .28)
                );

            box-shadow:
                0 30px 90px rgba(0, 0, 0, .38),
                0 0 50px rgba(110, 60, 186, .09);
        }

        .schedule-inner {
            padding: 24px;

            border-radius: 26px;

            background:
                linear-gradient(
                    145deg,
                    rgba(26, 15, 43, .93),
                    rgba(10, 7, 19, .95)
                );

            backdrop-filter: blur(24px);
        }

        .schedule-top {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 20px;
        }

        .schedule-top-title {
            color: #eee8f7;

            font-size: 14px;
            font-weight: 800;
        }

        .schedule-top-note {
            color: #776e83;

            font-size: 10px;
        }


        /* =========================================================
           SCHEDULE GRID
        ========================================================= */

        .schedule-grid {
            width: 100%;

            display: grid;

            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );

            gap: 13px;
        }


        /* =========================================================
           BORDER ANGLE
        ========================================================= */

        @property --border-angle {

            syntax: "<angle>";

            initial-value: 0deg;

            inherits: false;

        }


        /* =========================================================
           BASE BUTTON
        ========================================================= */

        .schedule-button {
            position: relative;

            isolation: isolate;

            width: 100%;

            min-height: 88px;

            padding:
                17px
                15px;

            overflow: hidden;

            border:
                1px solid
                rgba(255, 255, 255, .06);

            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(49, 30, 73, .86),
                    rgba(24, 14, 39, .92)
                );

            color: #e8e0ef;

            cursor: pointer;

            text-align: left;

            transition:
                transform .28s ease,
                border-color .28s ease,
                box-shadow .28s ease,
                background .28s ease;
        }


        /* =========================================================
           RUNNING BORDER
        ========================================================= */

        .schedule-button.available::before {

            content: "";

            position: absolute;

            inset: 0;

            border-radius: inherit;

            padding: 2px;

            background:
                conic-gradient(
                    from var(--border-angle),
                    transparent 0deg 70deg,
                    rgba(53, 242, 139, .12) 80deg,
                    #35f28b 105deg 360deg
                );

            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);

            -webkit-mask-composite: xor;

            mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);

            mask-composite: exclude;

            animation:
                runningBorder 2.4s linear infinite;

            pointer-events: none;

            z-index: 5;

            color: #35f28b;

            filter:
                drop-shadow(
                    0 0 4px currentColor
                )
                drop-shadow(
                    0 0 10px currentColor
                );
        }

        @keyframes runningBorder {

            from {
                --border-angle: 0deg;
            }

            to {
                --border-angle: 360deg;
            }

        }


        /* =========================================================
           AVAILABLE
        ========================================================= */

        .schedule-button.available {

            border:
                1px solid
                rgba(55, 230, 135, .5);

            background:
                linear-gradient(
                    145deg,
                    rgba(30, 104, 67, .96),
                    rgba(16, 55, 39, .98)
                );

            color: #effff6;

            box-shadow:
                0 0 18px rgba(35, 218, 126, .16),
                inset 0 1px 0 rgba(255, 255, 255, .05);
        }

        .schedule-button.available:hover {

            transform: translateY(-5px);

            border-color:
                rgba(111, 255, 174, .95);

            background:
                linear-gradient(
                    145deg,
                    rgba(39, 133, 83, .98),
                    rgba(16, 70, 47, .98)
                );

            box-shadow:
                0 18px 38px rgba(0, 0, 0, .32),
                0 0 30px rgba(48, 234, 139, .34);
        }

        .schedule-button.available.selected {

            transform: translateY(-4px);

            border-color:
                #f0d486;

            background:
                linear-gradient(
                    145deg,
                    rgba(40, 142, 88, .98),
                    rgba(17, 69, 46, .99)
                );

            box-shadow:
                0 15px 45px rgba(0, 0, 0, .35),
                inset 0 0 0 1px rgba(228, 191, 104, .25),
                0 0 38px rgba(48, 235, 139, .30);
        }


        /* =========================================================
           TIDAK TERSEDIA
        ========================================================= */

        .schedule-button.unavailable,
        .schedule-button.unavailable:disabled {

            cursor: not-allowed !important;

            opacity: 1 !important;

            border:
                1px solid
                rgba(238, 224, 180, .72) !important;

            background:
                linear-gradient(
                    145deg,
                    rgba(82, 73, 68, .95),
                    rgba(38, 32, 40, .98)
                ) !important;

            color: #fff5d8 !important;

            -webkit-text-fill-color:
                #fff5d8 !important;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, .08),
                0 0 14px rgba(221, 193, 116, .08),
                0 10px 25px rgba(0, 0, 0, .22) !important;
        }

        .schedule-button.unavailable .schedule-date {

            color: #ded2b0 !important;

            opacity: 1 !important;

            -webkit-text-fill-color:
                #ded2b0 !important;
        }

        .schedule-button.unavailable .schedule-time {

            color: #fff8e5 !important;

            opacity: 1 !important;

            -webkit-text-fill-color:
                #fff8e5 !important;

            text-shadow:
                0 2px 12px rgba(0, 0, 0, .55);
        }

        .schedule-button.unavailable .schedule-status {

            color: #ead9a7 !important;

            opacity: 1 !important;

            -webkit-text-fill-color:
                #ead9a7 !important;

            text-shadow:
                0 1px 8px rgba(0, 0, 0, .4);
        }


        /* =========================================================
           BOOKED
        ========================================================= */

        .schedule-button.booked,
        .schedule-button.booked:disabled {

            cursor: not-allowed !important;

            opacity: 1 !important;

            border:
                1px solid
                rgba(255, 65, 108, .72) !important;

            background:
                linear-gradient(
                    145deg,
                    rgba(112, 31, 52, .96),
                    rgba(48, 12, 25, .99)
                ) !important;

            color: #ffd6df !important;

            -webkit-text-fill-color:
                #ffd6df !important;

            box-shadow:
                0 0 16px rgba(255, 54, 99, .35),
                0 0 35px rgba(255, 54, 99, .18),
                0 0 65px rgba(255, 54, 99, .08),
                inset 0 1px 0 rgba(255, 255, 255, .05) !important;
        }

        .schedule-button.booked::before {

            display: none !important;

            content: none !important;

            animation: none !important;
        }

        .schedule-button.booked .schedule-date {

            color: #e99aae !important;

            -webkit-text-fill-color:
                #e99aae !important;
        }

        .schedule-button.booked .schedule-time {

            color: #ffe2e8 !important;

            -webkit-text-fill-color:
                #ffe2e8 !important;

            text-shadow:
                0 0 15px rgba(255, 61, 105, .30);
        }

        .schedule-button.booked .schedule-status {

            color: #ff7798 !important;

            -webkit-text-fill-color:
                #ff7798 !important;

            text-shadow:
                0 0 12px rgba(255, 61, 105, .65);
        }

        .schedule-button.booked .schedule-status::before {

            background: #ff416c !important;

            box-shadow:
                0 0 7px #ff416c,
                0 0 15px rgba(255, 65, 108, .95) !important;
        }


        /* =========================================================
           SESI SUDAH LEWAT
        ========================================================= */

        .schedule-button.passed,
        .schedule-button.passed:disabled {

            cursor: not-allowed !important;

            opacity: 1 !important;

            border:
                1px solid
                rgba(151, 143, 165, .45) !important;

            background:
                linear-gradient(
                    145deg,
                    rgba(57, 51, 66, .95),
                    rgba(27, 23, 34, .98)
                ) !important;

            color: #aaa3b2 !important;

            -webkit-text-fill-color:
                #aaa3b2 !important;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, .04),
                0 8px 22px rgba(0, 0, 0, .20) !important;
        }

        .schedule-button.passed::before {

            display: none !important;

            content: none !important;

            animation: none !important;
        }

        .schedule-button.passed .schedule-date {

            color: #81798b !important;

            -webkit-text-fill-color:
                #81798b !important;
        }

        .schedule-button.passed .schedule-time {

            color: #aaa3b2 !important;

            -webkit-text-fill-color:
                #aaa3b2 !important;

            text-shadow: none;
        }

        .schedule-button.passed .schedule-status {

            color: #8f8798 !important;

            -webkit-text-fill-color:
                #8f8798 !important;
        }

        .schedule-button.passed .schedule-status::before {

            background: #77707f !important;

            box-shadow: none !important;
        }


        /* =========================================================
           SCHEDULE CONTENT
        ========================================================= */

        .schedule-date {

            display: block;

            margin-bottom: 8px;

            color: #a99bb8;

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .08em;
        }

        .schedule-time {

            display: block;

            color: #fff;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 20px;
            font-weight: 500;

            line-height: 1.2;

            text-shadow:
                0 2px 10px rgba(0, 0, 0, .35);
        }

        .schedule-status {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            margin-top: 8px;

            font-size: 9px;
            font-weight: 800;

            letter-spacing: .08em;

            text-transform: uppercase;
        }

        .available .schedule-status {
            color: #63f0a1;
        }

        .unavailable .schedule-status {
            color: #ead9a7;
        }

        .booked .schedule-status {
            color: #ff7798;
        }

        .passed .schedule-status {
            color: #8f8798;
        }

        .schedule-status::before {

            content: "";

            width: 5px;
            height: 5px;

            flex-shrink: 0;

            border-radius: 50%;

            background: currentColor;
        }


        /* =========================================================
           BOOKING AREA
        ========================================================= */

        .booking-area {

            position: relative;

            margin-top: 18px;

            padding:
                17px
                27px;

            overflow: hidden;

            border-radius: 20px;

            background:
                linear-gradient(
                    135deg,
                    rgba(103, 55, 150, .95),
                    rgba(53, 25, 79, .98)
                );

            border:
                1px solid
                rgba(231, 195, 106, .5);

            box-shadow:
                0 25px 70px rgba(0, 0, 0, .3),
                0 0 30px rgba(160, 90, 220, .16);

            backdrop-filter: blur(22px);
        }

        .booking-area::before {

            content: "";

            position: absolute;

            width: 230px;
            height: 230px;

            right: -100px;
            top: -130px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(216, 174, 80, .17),
                    transparent 70%
                );
        }

        .booking-area.hidden {
            display: none;
        }

        .booking-label {

            color: #f0d486;

            font-size: 9px;
            font-weight: 800;

            letter-spacing: .2em;

            text-transform: uppercase;
        }

        .booking-title {

            margin-top: 4px;

            color: #fff;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 23px;
            font-weight: 500;
        }

        .booking-selected {

            margin-top: 4px;

            color: #e2d7ec;

            font-size: 11px;
        }

        .booking-actions {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-top: 13px;
        }

        .booking-button {

            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 40px;

            padding:
                0
                22px;

            border: 0;

            border-radius: 11px;

            background:
                linear-gradient(
                    135deg,
                    #f0d486,
                    #c19648
                );

            color: #20140a;

            font-size: 11px;
            font-weight: 900;

            cursor: pointer;

            box-shadow:
                0 10px 30px rgba(195, 151, 62, .19);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .booking-button:hover {

            transform: translateY(-2px);

            box-shadow:
                0 15px 35px rgba(195, 151, 62, .3);
        }

        .cancel-button {

            min-height: 40px;

            padding:
                0
                18px;

            border:
                1px solid
                rgba(255, 255, 255, .13);

            border-radius: 11px;

            background:
                rgba(255, 255, 255, .06);

            color: #eee4f5;

            font-size: 10px;
            font-weight: 700;

            cursor: pointer;
        }


        /* =========================================================
           LOGIN NOTICE
        ========================================================= */

        .login-notice {

            margin-top: 22px;

            padding: 22px;

            border:
                1px solid
                rgba(153, 113, 194, .2);

            border-radius: 19px;

            background:
                rgba(28, 17, 42, .62);

            color: #94899f;

            font-size: 12px;

            line-height: 1.6;
        }

        .login-notice strong {
            color: #d8b86d;
        }


        /* =========================================================
           EMPTY SCHEDULE
        ========================================================= */

        .empty-schedule {

            padding:
                55px
                25px;

            border:
                1px solid
                rgba(255, 255, 255, .06);

            border-radius: 22px;

            background:
                rgba(20, 12, 32, .55);

            color: #80768d;

            text-align: center;

            font-size: 13px;
        }


        /* =========================================================
           BACK BUTTON
        ========================================================= */

        .back-area {
            margin-top: 28px;
        }

        .back-button {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                10px
                15px;

            border:
                1px solid
                rgba(205, 165, 77, .2);

            border-radius: 12px;

            background:
                rgba(25, 15, 39, .55);

            color: #b3a9be;

            font-size: 11px;
            font-weight: 700;

            text-decoration: none;

            transition:
                .2s ease;
        }

        .back-button:hover {

            color: #e2c477;

            border-color:
                rgba(205, 165, 77, .45);

            transform:
                translateX(-3px);
        }


        /* =========================================================
           POPUP
        ========================================================= */

        .booking-success-overlay {

            position: fixed;

            inset: 0;

            z-index: 99999;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 20px;

            background:
                rgba(5, 3, 12, .80);

            backdrop-filter: blur(10px);

            -webkit-backdrop-filter:
                blur(10px);

            opacity: 0;

            visibility: hidden;

            transition:
                opacity .3s ease,
                visibility .3s ease;
        }

        .booking-success-overlay.show {

            opacity: 1;

            visibility: visible;
        }

        .booking-success-popup {

            position: relative;

            width:
                min(
                    430px,
                    100%
                );

            padding:
                36px
                30px
                30px;

            border:
                1px solid
                rgba(240, 212, 134, .35);

            border-radius: 26px;

            background:
                linear-gradient(
                    145deg,
                    rgba(39, 23, 56, .98),
                    rgba(14, 8, 24, .99)
                );

            box-shadow:
                0 35px 100px rgba(0, 0, 0, .65),
                0 0 60px rgba(139, 77, 210, .16);

            text-align: center;

            transform:
                translateY(25px)
                scale(.94);

            transition:
                transform .4s
                cubic-bezier(.2, .8, .2, 1);
        }

        .booking-success-overlay.show
        .booking-success-popup {

            transform:
                translateY(0)
                scale(1);
        }

        .booking-success-popup::before {

            content: "";

            position: absolute;

            top: -80px;

            left: 50%;

            width: 180px;
            height: 180px;

            transform:
                translateX(-50%);

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(211, 170, 82, .16),
                    transparent 70%
                );

            filter: blur(8px);

            pointer-events: none;
        }

        .booking-success-icon {

            position: relative;

            width: 72px;
            height: 72px;

            margin:
                0 auto 20px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                rgba(240, 212, 134, .60);

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(240, 212, 134, .24),
                    rgba(240, 212, 134, .04)
                );

            color: #f0d486;

            font-size: 35px;
            font-weight: 800;

            box-shadow:
                0 0 25px rgba(240, 212, 134, .18),
                inset 0 0 20px rgba(240, 212, 134, .06);

            animation:
                successIcon .6s ease-out;
        }

        @keyframes successIcon {

            0% {
                opacity: 0;

                transform:
                    scale(.5)
                    rotate(-20deg);
            }

            70% {
                transform:
                    scale(1.08)
                    rotate(4deg);
            }

            100% {
                opacity: 1;

                transform:
                    scale(1)
                    rotate(0);
            }
        }

        .booking-success-popup h3 {

            position: relative;

            margin:
                0 0 11px;

            color: #fff;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 28px;

            font-weight: 500;

            letter-spacing: -.02em;
        }

        .booking-success-popup p {

            position: relative;

            width: 100%;

            max-width: 340px;

            margin:
                0 auto 25px;

            color: #c8bdd5;

            font-size: 13px;

            line-height: 1.7;
        }

        .booking-success-close {

            position: relative;

            min-height: 44px;

            padding:
                0
                25px;

            border: 0;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #f2d88b,
                    #c19447
                );

            color: #20140a;

            font-size: 11px;

            font-weight: 900;

            cursor: pointer;

            box-shadow:
                0 10px 30px rgba(195, 151, 62, .22);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .booking-success-close:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 15px 38px rgba(195, 151, 62, .34);
        }

        .booking-success-close:active {

            transform:
                translateY(0);
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1150px) {

            main {
                padding:
                    30px
                    35px
                    60px;
            }

            .profile-layout {

                grid-template-columns:
                    300px
                    minmax(0, 1fr);

                gap: 50px;
            }

            .schedule-grid {

                grid-template-columns:
                    repeat(
                        2,
                        minmax(0, 1fr)
                    );
            }

            .profile-name {
                font-size: 34px;
            }

            .schedule-title {
                font-size: 37px;
            }

        }


        @media (max-width: 850px) {

            main {

                padding:
                    25px
                    25px
                    55px;
            }

            .profile-layout {

                grid-template-columns: 1fr;

                gap: 20px;
            }

            .profile-column {

                position: relative;

                top: auto;

                width: 100%;

                text-align: center;
            }

            .photo-stage {

                width: 175px;
                height: 175px;

                margin:
                    0 auto 30px;
            }

            .schedule-header {
                margin-top: 10px;
            }

            .schedule-title {
                font-size: 34px;
            }

        }


        @media (max-width: 600px) {

            main {

                padding:
                    20px
                    16px
                    45px;
            }

            .profile-column {

                padding-top: 10px;

                text-align: center;
            }

            .photo-stage {

                width: 155px;
                height: 155px;

                margin:
                    0 auto 25px;
            }

            .profile-name {
                font-size: 31px;
            }

            .schedule-title {
                font-size: 30px;
            }

            .schedule-shell {
                border-radius: 21px;
            }

            .schedule-inner {

                padding: 16px;

                border-radius: 19px;
            }

            .schedule-grid {
                grid-template-columns: 1fr;
            }

            .schedule-button {
                min-height: 78px;
            }

            .booking-area {

                padding:
                    15px
                    21px;
            }

            .booking-actions {

                flex-direction: column;

                align-items: stretch;
            }

            .booking-button,
            .cancel-button {

                width: 100%;
            }

            .booking-success-overlay {
                padding: 16px;
            }

            .booking-success-popup {

                padding:
                    31px
                    21px
                    26px;

                border-radius: 22px;
            }

            .booking-success-popup h3 {
                font-size: 25px;
            }

            .booking-success-popup p {
                font-size: 12px;
            }

        }

    </style>

</head>


<body>


    {{-- =========================================================
         POPUP BOOKING BERHASIL
    ========================================================== --}}

    @if (session('booking_success'))

        <div
            class="booking-success-overlay"
            id="bookingSuccessPopup"
        >

            <div
                class="booking-success-popup"
                role="dialog"
                aria-modal="true"
                aria-labelledby="bookingSuccessTitle"
            >

                <div class="booking-success-icon">
                    ✓
                </div>

                <h3 id="bookingSuccessTitle">
                    Booking Berhasil!
                </h3>

                <p>
                    {{ session('status') }}
                </p>

                <button
                    type="button"
                    class="booking-success-close"
                    id="closeBookingSuccess"
                >
                    Oke, Mengerti
                </button>

            </div>

        </div>

    @endif


    {{-- =========================================================
         POPUP SESI SUDAH LEWAT
    ========================================================== --}}

    <div
        class="booking-success-overlay"
        id="sessionPassedPopup"
    >

        <div
            class="booking-success-popup"
            role="dialog"
            aria-modal="true"
            aria-labelledby="sessionPassedTitle"
        >

            <div class="booking-success-icon">
                !
            </div>

            <h3 id="sessionPassedTitle">
                Maaf, sesi sudah lewat
            </h3>

            <p>
                Sesi yang kamu pilih sudah melewati waktunya
                dan tidak dapat dipesan lagi.
            </p>

            <button
                type="button"
                class="booking-success-close"
                id="closeSessionPassed"
            >
                Oke, Mengerti
            </button>

        </div>

    </div>


    <div class="light-orb orb-one"></div>

    <div class="light-orb orb-two"></div>


    {{-- =========================================================
         NAVBAR
    ========================================================== --}}

    @include('whisperly.navbar')


    <main>


        {{-- =====================================================
             ALERT
        ====================================================== --}}

        @if (session('success'))

            <div class="success">

                {{ session('success') }}

            </div>

        @endif


        @if ($errors->any())

            <div class="error">

                <strong>
                    Terjadi kesalahan.
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
             MAIN LAYOUT
        ====================================================== --}}

        <div class="profile-layout">


            {{-- =================================================
                 PROFILE
            ================================================== --}}

            <aside class="profile-column">


                <div class="photo-stage">

                    <div class="photo-ring">

                        <div class="profile-photo">

                            @php

                                $photo =
                                    trim(
                                        (string)
                                        $talent->photo
                                    );

                                $photoUrl = null;

                                if ($photo) {

                                    if (
                                        filter_var(
                                            $photo,
                                            FILTER_VALIDATE_URL
                                        )
                                    ) {

                                        $photoUrl = $photo;

                                    } else {

                                        $photo =
                                            preg_replace(
                                                '#^public/#',
                                                '',
                                                ltrim(
                                                    $photo,
                                                    '/'
                                                )
                                            );

                                        $photoUrl =
                                            asset(
                                                'storage/' .
                                                $photo
                                            );

                                    }

                                }

                            @endphp


                            @if ($photoUrl)

                                <img
                                    src="{{ $photoUrl }}"

                                    alt="Foto {{ $talent->pengguna->username }}"

                                    onerror="
                                        this.onerror=null;
                                        this.src='{{ asset('assets/images/faces/1.jpg') }}';
                                    "
                                >

                            @else

                                @php

                                    $faceNumber =
                                        (
                                            abs(
                                                crc32(
                                                    $talent
                                                        ->pengguna
                                                        ->username
                                                )
                                            ) % 8
                                        ) + 1;

                                @endphp


                                <img
                                    src="{{ asset(
                                        'assets/images/faces/' .
                                        $faceNumber .
                                        '.jpg'
                                    ) }}"

                                    alt="Foto {{ $talent->pengguna->username }}"
                                >

                            @endif

                        </div>

                    </div>


                    <span class="online-dot"></span>

                </div>


                <div class="profile-info">


                    <div class="profile-label">
                        WHISPERLY TALENT
                    </div>


                    <h1 class="profile-name">
                        {{ ucfirst($talent->pengguna->username) }}
                    </h1>


                    @if ($talent->pengguna->email)

                        <div class="email">
                            {{ $talent->pengguna->email }}
                        </div>

                    @endif


                    <div class="profile-divider"></div>


                    <div class="description-wrapper">

                        <h2 class="description-title">
                            Tentang Talent
                        </h2>

                        <div class="description">
                            {{ $talent->deskripsi ?: 'Talent belum menambahkan deskripsi.' }}
                        </div>

                    </div>

                </div>

            </aside>


            {{-- =================================================
                 SCHEDULE
            ================================================== --}}

            <section class="schedule-column">


                <header class="schedule-header">

                    <div class="schedule-eyebrow">
                        AVAILABLE MOMENTS
                    </div>


                    <h2 class="schedule-title">
                        Pilih waktu terbaikmu.
                    </h2>


                    <p class="schedule-subtitle">
                        Temukan waktu yang tersedia dan pilih sesi
                        yang paling sesuai untuk mengirim pesan kepada
                        talent pilihanmu.
                    </p>

                </header>


                {{-- =================================================
                     LEGEND
                ================================================== --}}

                <div class="legend">

                    <div class="legend-item">

                        <span class="legend-dot green"></span>

                        Tersedia

                    </div>


                    <div class="legend-item">

                        <span class="legend-dot gray"></span>

                        Tidak tersedia

                    </div>


                    <div class="legend-item">

                        <span class="legend-dot red"></span>

                        Sudah dipesan

                    </div>

                </div>


                {{-- =================================================
                     SCHEDULE FRAME
                ================================================== --}}

                <div class="schedule-shell">

                    <div class="schedule-inner">


                        <div class="schedule-top">

                            <div class="schedule-top-title">
                                Jadwal Talent
                            </div>

                            <div class="schedule-top-note">
                                Pilih salah satu waktu
                            </div>

                        </div>


                        @if ($talent->schedules->count())

                            <div class="schedule-grid">


                                @foreach ($talent->schedules as $schedule)

                                    @php

                                        /*
                                         * =================================================
                                         * TANGGAL DAN JAM SESI
                                         * =================================================
                                         */

                                        $scheduleDate =
                                            \Carbon\Carbon::parse(
                                                $schedule->date
                                            )->toDateString();


                                        /*
                                         * Waktu mulai sesi
                                         */

                                        $scheduleStart =
                                            \Carbon\Carbon::parse(
                                                $schedule->date .
                                                ' ' .
                                                $schedule->start_time
                                            );


                                        /*
                                         * Waktu selesai sesi
                                         */

                                        $scheduleEnd =
                                            \Carbon\Carbon::parse(
                                                $schedule->date .
                                                ' ' .
                                                $schedule->end_time
                                            );


                                        /*
                                         * Waktu sekarang
                                         */

                                        $now =
                                            \Carbon\Carbon::now();


                                        /*
                                         * =================================================
                                         * CEK SESI SUDAH LEWAT
                                         * =================================================
                                         *
                                         * Sesi baru dianggap lewat setelah JAM SELESAI.
                                         *
                                         * Contoh:
                                         *
                                         * 09:00 - 10:00
                                         *
                                         * Jam 09:30 -> masih tersedia
                                         * Jam 10:00 -> sudah lewat
                                         * Jam 10:01 -> sudah lewat
                                         *
                                         */

                                        $isPassed =
                                            $scheduleEnd->isPast();


                                        /*
                                         * =================================================
                                         * STATUS NORMAL DARI DATABASE
                                         * =================================================
                                         */

                                        $status =
                                            $schedule->resolveStatusForDate(
                                                $scheduleDate
                                            );


                                        /*
                                         * =================================================
                                         * STATUS AKHIR
                                         * =================================================
                                         *
                                         * Kalau sudah lewat, status PASSED
                                         * menjadi prioritas.
                                         */

                                        $isAvailable =
                                            !$isPassed &&
                                            $status === 'available';


                                        $isBooked =
                                            !$isPassed &&
                                            $status === 'booked';


                                        $statusClass =
                                            $isPassed
                                                ? 'passed'
                                                : (
                                                    $isAvailable
                                                        ? 'available'
                                                        : (
                                                            $isBooked
                                                                ? 'booked'
                                                                : 'unavailable'
                                                        )
                                                );

                                    @endphp


                                    <button
                                        type="button"

                                        class="
                                            schedule-button
                                            {{ $statusClass }}
                                        "

                                        @if ($isAvailable)

                                            data-schedule-id="{{ $schedule->id }}"

                                            data-start="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}"

                                            data-end="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}"

                                        @elseif ($isPassed)

                                            data-passed="true"

                                        @endif

                                        {{ (!$isAvailable && !$isPassed) ? 'disabled' : '' }}
                                    >


                                        <span class="schedule-date">

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $schedule->date
                                                )->translatedFormat(
                                                    'l, d M Y'
                                                )
                                            }}

                                        </span>


                                        <span class="schedule-time">

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $schedule->start_time
                                                )->format('H:i')
                                            }}

                                            —

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $schedule->end_time
                                                )->format('H:i')
                                            }}

                                        </span>


                                        <span class="schedule-status">

                                            @if ($isPassed)

                                                Sudah lewat

                                            @elseif ($isAvailable)

                                                Tersedia

                                            @elseif ($isBooked)

                                                Sudah dipesan

                                            @else

                                                Tidak tersedia

                                            @endif

                                        </span>


                                    </button>

                                @endforeach


                            </div>

                        @else

                            <div class="empty-schedule">

                                Belum ada jadwal yang tersedia
                                untuk talent ini.

                            </div>

                        @endif


                        {{-- =================================================
                             BOOKING AREA
                        ================================================== --}}

                        @if (
                            auth('whisperly')->check() &&
                            auth('whisperly')->user()->role === 'user'
                        )

                            <div
                                class="booking-area hidden"
                                id="bookingArea"
                            >


                                <div class="booking-label">
                                    SELECTED SESSION
                                </div>


                                <div class="booking-title">
                                    Pesan sesi ini
                                </div>


                                <div
                                    class="booking-selected"
                                    id="selectedScheduleText"
                                >
                                    Silakan pilih jadwal terlebih dahulu.
                                </div>


                                <form
                                    method="POST"

                                    action="{{ route(
                                        'whisperly.bookings.store',
                                        [
                                            'username' =>
                                                $talent
                                                    ->pengguna
                                                    ->username
                                        ]
                                    ) }}"
                                >

                                    @csrf


                                    <input
                                        type="hidden"

                                        name="schedule_id"

                                        id="selectedScheduleId"
                                    >


                                    <div class="booking-actions">


                                        <button
                                            type="submit"

                                            class="booking-button"
                                        >
                                            Pesan Sekarang
                                        </button>


                                        <button
                                            type="button"

                                            class="cancel-button"

                                            id="cancelSelection"
                                        >
                                            Batal
                                        </button>


                                    </div>

                                </form>

                            </div>

                        @else

                            <div class="login-notice">

                                <strong>
                                    Ingin memesan sesi?
                                </strong>

                                <br>

                                Silakan masuk sebagai pengguna Whisperly
                                untuk memilih jadwal dan melakukan booking.

                            </div>

                        @endif


                    </div>

                </div>


                {{-- =================================================
                     BACK
                ================================================== --}}

                <div class="back-area">

                    <a
                        href="{{ route('whisperly.talents.index') }}"

                        class="back-button"
                    >
                        ← Kembali ke daftar talent
                    </a>

                </div>


            </section>

        </div>

    </main>


    {{-- =========================================================
         JAVASCRIPT BOOKING
    ========================================================== --}}

    @if (
        auth('whisperly')->check() &&
        auth('whisperly')->user()->role === 'user'
    )

        <script>

            document.addEventListener(
                "DOMContentLoaded",
                function () {

                    /*
                     * =====================================================
                     * SEMUA TOMBOL JADWAL
                     * =====================================================
                     */

                    const buttons =
                        document.querySelectorAll(
                            ".schedule-button"
                        );


                    /*
                     * Hanya jadwal yang benar-benar tersedia.
                     */

                    const availableButtons =
                        document.querySelectorAll(
                            ".schedule-button.available"
                        );


                    const bookingArea =
                        document.getElementById(
                            "bookingArea"
                        );


                    const selectedId =
                        document.getElementById(
                            "selectedScheduleId"
                        );


                    const selectedText =
                        document.getElementById(
                            "selectedScheduleText"
                        );


                    const cancelButton =
                        document.getElementById(
                            "cancelSelection"
                        );


                    /*
                     * =====================================================
                     * POPUP SESI SUDAH LEWAT
                     * =====================================================
                     */

                    const passedPopup =
                        document.getElementById(
                            "sessionPassedPopup"
                        );


                    const closePassedPopup =
                        document.getElementById(
                            "closeSessionPassed"
                        );


                    function showPassedPopup() {

                        if (!passedPopup) {
                            return;
                        }

                        passedPopup.classList.add(
                            "show"
                        );

                    }


                    function hidePassedPopup() {

                        if (!passedPopup) {
                            return;
                        }

                        passedPopup.classList.remove(
                            "show"
                        );

                    }


                    /*
                     * =====================================================
                     * KLIK SEMUA JADWAL
                     * =====================================================
                     */

                    buttons.forEach(
                        function (button) {

                            button.addEventListener(
                                "click",
                                function () {

                                    /*
                                     * Jika sesi sudah lewat,
                                     * tampilkan popup.
                                     */

                                    if (
                                        button.dataset.passed ===
                                        "true"
                                    ) {

                                        showPassedPopup();

                                        return;

                                    }


                                    /*
                                     * Kalau bukan jadwal tersedia,
                                     * jangan lakukan apa-apa.
                                     */

                                    if (
                                        !button.classList.contains(
                                            "available"
                                        )
                                    ) {

                                        return;

                                    }


                                    /*
                                     * Pastikan elemen booking tersedia.
                                     */

                                    if (
                                        !bookingArea ||
                                        !selectedId ||
                                        !selectedText
                                    ) {

                                        return;

                                    }


                                    /*
                                     * Hapus selected dari jadwal sebelumnya.
                                     */

                                    availableButtons.forEach(
                                        function (item) {

                                            item.classList.remove(
                                                "selected"
                                            );

                                        }
                                    );


                                    /*
                                     * Tandai jadwal yang dipilih.
                                     */

                                    button.classList.add(
                                        "selected"
                                    );


                                    const scheduleId =
                                        button.dataset.scheduleId;


                                    const start =
                                        button.dataset.start;


                                    const end =
                                        button.dataset.end;


                                    /*
                                     * Pengaman.
                                     */

                                    if (!scheduleId) {
                                        return;
                                    }


                                    /*
                                     * Masukkan ID jadwal ke form.
                                     */

                                    selectedId.value =
                                        scheduleId;


                                    /*
                                     * Tampilkan sesi yang dipilih.
                                     */

                                    selectedText.textContent =
                                        "Sesi terpilih: " +
                                        start +
                                        " — " +
                                        end;


                                    /*
                                     * Tampilkan area booking.
                                     */

                                    bookingArea.classList.remove(
                                        "hidden"
                                    );


                                    /*
                                     * Scroll ke area booking.
                                     */

                                    bookingArea.scrollIntoView({
                                        behavior: "smooth",
                                        block: "nearest"
                                    });

                                }
                            );

                        }
                    );


                    /*
                     * =====================================================
                     * BATAL
                     * =====================================================
                     */

                    if (cancelButton) {

                        cancelButton.addEventListener(
                            "click",
                            function () {

                                availableButtons.forEach(
                                    function (item) {

                                        item.classList.remove(
                                            "selected"
                                        );

                                    }
                                );


                                selectedId.value =
                                    "";


                                selectedText.textContent =
                                    "Silakan pilih jadwal terlebih dahulu.";


                                bookingArea.classList.add(
                                    "hidden"
                                );

                            }
                        );

                    }


                    /*
                     * =====================================================
                     * TUTUP POPUP SESI LEWAT
                     * =====================================================
                     */

                    if (closePassedPopup) {

                        closePassedPopup.addEventListener(
                            "click",
                            function () {

                                hidePassedPopup();

                            }
                        );

                    }


                    /*
                     * Klik area gelap popup.
                     */

                    if (passedPopup) {

                        passedPopup.addEventListener(
                            "click",
                            function (event) {

                                if (
                                    event.target ===
                                    passedPopup
                                ) {

                                    hidePassedPopup();

                                }

                            }
                        );

                    }


                    /*
                     * Tombol ESC untuk popup sesi lewat.
                     */

                    document.addEventListener(
                        "keydown",
                        function (event) {

                            if (
                                event.key === "Escape" &&
                                passedPopup &&
                                passedPopup.classList.contains(
                                    "show"
                                )
                            ) {

                                hidePassedPopup();

                            }

                        }
                    );

                }
            );

        </script>

    @endif


    {{-- =========================================================
         JAVASCRIPT POPUP BOOKING BERHASIL
    ========================================================== --}}

    @if (session('booking_success'))

        <script>

            document.addEventListener(
                "DOMContentLoaded",
                function () {

                    const popup =
                        document.getElementById(
                            "bookingSuccessPopup"
                        );


                    const closeButton =
                        document.getElementById(
                            "closeBookingSuccess"
                        );


                    if (!popup) {
                        return;
                    }


                    /*
                     * Tampilkan popup setelah halaman selesai dimuat.
                     */

                    setTimeout(
                        function () {

                            popup.classList.add(
                                "show"
                            );

                        },
                        150
                    );


                    /*
                     * Tombol Oke, Mengerti.
                     */

                    if (closeButton) {

                        closeButton.addEventListener(
                            "click",
                            function () {

                                popup.classList.remove(
                                    "show"
                                );

                            }
                        );

                    }


                    /*
                     * Klik area gelap di luar popup.
                     */

                    popup.addEventListener(
                        "click",
                        function (event) {

                            if (
                                event.target ===
                                popup
                            ) {

                                popup.classList.remove(
                                    "show"
                                );

                            }

                        }
                    );


                    /*
                     * Tombol ESC.
                     */

                    document.addEventListener(
                        "keydown",
                        function (event) {

                            if (
                                event.key === "Escape" &&
                                popup.classList.contains(
                                    "show"
                                )
                            ) {

                                popup.classList.remove(
                                    "show"
                                );

                            }

                        }
                    );

                }
            );

        </script>

    @endif


</body>

</html>