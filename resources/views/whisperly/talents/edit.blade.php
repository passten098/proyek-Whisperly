<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Profil - Whisperly</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>

        /* =========================================================
           RESET
        ========================================================== */

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

            color: #f8f5fc;

            font-family:
                "Manrope",
                sans-serif;

            background:
                radial-gradient(
                    circle at 5% 5%,
                    rgba(128, 66, 212, .27),
                    transparent 27%
                ),
                radial-gradient(
                    circle at 92% 7%,
                    rgba(208, 165, 75, .13),
                    transparent 23%
                ),
                radial-gradient(
                    circle at 75% 78%,
                    rgba(104, 47, 180, .20),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #05040a 0%,
                    #0b0715 32%,
                    #160c29 57%,
                    #0a0614 100%
                );

            background-attachment: fixed;
        }


        /* =========================================================
           AMBIENT BACKGROUND
        ========================================================== */

        body::before {
            content: "";

            position: fixed;

            inset: -20%;

            z-index: -5;

            pointer-events: none;

            background:
                radial-gradient(
                    ellipse at 18% 20%,
                    rgba(132, 70, 221, .14),
                    transparent 30%
                ),
                radial-gradient(
                    ellipse at 82% 30%,
                    rgba(219, 179, 93, .07),
                    transparent 28%
                );

            filter: blur(55px);

            animation:
                ambientMove 15s ease-in-out infinite alternate;
        }

        @keyframes ambientMove {

            0% {
                transform:
                    translate3d(-1%, -1%, 0)
                    scale(1);
            }

            100% {
                transform:
                    translate3d(2%, 2%, 0)
                    scale(1.07);
            }

        }


        /* =========================================================
           ORBS
        ========================================================== */

        .ambient-orb {
            position: fixed;

            border-radius: 50%;

            pointer-events: none;

            z-index: -4;
        }

        .orb-purple {
            width: 260px;
            height: 260px;

            left: -130px;
            top: 22%;

            background:
                radial-gradient(
                    circle,
                    rgba(139, 73, 230, .16),
                    transparent 68%
                );

            filter: blur(8px);
        }

        .orb-gold {
            width: 320px;
            height: 320px;

            right: -160px;
            bottom: -80px;

            background:
                radial-gradient(
                    circle,
                    rgba(215, 173, 85, .08),
                    transparent 68%
                );

            filter: blur(8px);
        }


        /* =========================================================
           MAIN
        ========================================================== */

        main {
            position: relative;

            width: 100%;

            padding:
                24px
                60px
                65px;
        }


        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .page-header {
            max-width: 850px;

            margin-bottom: 30px;
        }

        .page-eyebrow {
            display: flex;

            align-items: center;

            gap: 9px;

            margin-bottom: 8px;

            color: #d6b66c;

            font-size: 8px;

            font-weight: 800;

            letter-spacing: .34em;

            text-transform: uppercase;
        }

        .page-eyebrow::before {
            content: "";

            width: 30px;
            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    #dfbf72,
                    transparent
                );
        }

        .page-title {
            color: #fff;

            font-family:
                "Playfair Display",
                serif;

            font-size: 40px;

            font-weight: 600;

            line-height: 1.05;

            letter-spacing: -.025em;

            text-shadow:
                0 10px 35px rgba(0, 0, 0, .4);
        }

        .page-subtitle {
            max-width: 650px;

            margin-top: 10px;

            color: #8f859c;

            font-size: 10px;

            font-weight: 500;

            line-height: 1.8;

            letter-spacing: .01em;
        }


        /* =========================================================
           ALERT
        ========================================================== */

        .success,
        .error {
            width: 100%;

            margin-bottom: 20px;

            padding:
                13px
                17px;

            border-radius: 13px;

            font-size: 10px;

            backdrop-filter: blur(18px);
        }

        .success {
            border:
                1px solid
                rgba(220, 184, 102, .30);

            background:
                rgba(69, 48, 29, .50);

            color: #ead18e;
        }

        .error {
            border:
                1px solid
                rgba(214, 101, 145, .30);

            background:
                rgba(65, 27, 48, .52);

            color: #efb5ca;
        }

        .error ul {
            padding-left: 18px;

            margin-top: 5px;
        }


        /* =========================================================
           MAIN GRID
        ========================================================== */

        .profile-layout {
            display: grid;

            grid-template-columns:
                370px
                minmax(0, 1fr);

            gap: 70px;

            align-items: start;
        }


        /* =========================================================
           LEFT PROFILE
        ========================================================== */

        .profile-column {
            position: sticky;

            top: 85px;

            padding:
                5px
                0
                30px;

            text-align: left;
        }


        /* =========================================================
           PHOTO
        ========================================================== */

        .photo-stage {
            position: relative;

            width: 200px;
            height: 200px;

            margin:
                0
                auto
                28px;
        }

        .photo-stage::before {
            content: "";

            position: absolute;

            inset: -12px;

            border-radius: 50%;

            background:
                conic-gradient(
                    from 0deg,
                    #8b5ac7,
                    transparent 20%,
                    #dcb967,
                    transparent 43%,
                    #7741ad,
                    transparent 65%,
                    #ead083,
                    transparent 85%,
                    #8b5ac7
                );

            animation:
                rotatePhoto 10s linear infinite;
        }

        .photo-stage::after {
            content: "";

            position: absolute;

            inset: -42px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(135, 72, 221, .23),
                    transparent 67%
                );

            filter: blur(18px);

            z-index: -1;
        }

        @keyframes rotatePhoto {

            to {
                transform:
                    rotate(360deg);
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
                    #f8dda0,
                    #b88332 23%,
                    #f3d17b 48%,
                    #8e642a 75%,
                    #eed187
                );

            box-shadow:
                0 0 0 2px rgba(255,255,255,.04),
                0 0 38px rgba(213,169,79,.22),
                0 25px 65px rgba(0,0,0,.45);
        }

        .profile-photo {
            width: 100%;
            height: 100%;

            overflow: hidden;

            border-radius: 50%;

            background: #120a20;
        }

        .profile-photo img {
            display: block;

            width: 100%;
            height: 100%;

            object-fit: cover;

            transition:
                transform .65s ease;
        }

        .photo-stage:hover
        .profile-photo img {
            transform:
                scale(1.055);
        }

        .online-dot {
            position: absolute;

            right: 12px;
            bottom: 12px;

            width: 18px;
            height: 18px;

            border:
                3px solid
                #11091d;

            border-radius: 50%;

            background: #c7a75c;

            box-shadow:
                0 0 0 4px rgba(199,167,92,.10),
                0 0 18px rgba(199,167,92,.70);
        }


        /* =========================================================
           PROFILE IDENTITY
        ========================================================== */

        .profile-info {
            width: 100%;

            text-align: left;
        }

        .profile-label {
            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            margin-bottom: 9px;

            color: #caaa5d;

            font-size: 8px;

            font-weight: 800;

            letter-spacing: .30em;

            text-transform: uppercase;

            text-align: center;
        }

        .profile-label::before,
        .profile-label::after {
            content: "";

            width: 20px;
            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(218,184,101,.7)
                );
        }

        .profile-label::after {
            background:
                linear-gradient(
                    90deg,
                    rgba(218,184,101,.7),
                    transparent
                );
        }

        .profile-name {
            color: #fff;

            font-family:
                "Playfair Display",
                serif;

            font-size: 43px;

            font-weight: 600;

            line-height: 1.05;

            letter-spacing: -.035em;

            text-align: center;

            text-shadow:
                0 8px 35px rgba(0,0,0,.40);

            word-break: break-word;
        }

        .email {
            margin-top: 10px;

            color: #9b91a8;

            font-size: 11px;

            font-weight: 500;

            text-align: center;

            word-break: break-word;
        }


        /* =========================================================
           DIVIDER
        ========================================================== */

        .profile-divider {
            width: 80%;

            height: 1px;

            margin:
                22px
                auto
                22px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(218,181,98,.55),
                    rgba(119,68,173,.35),
                    transparent
                );
        }


        /* =========================================================
           INFORMATION PROFILE
           FONT DIPERBESAR
        ========================================================== */

        .section-heading {
            width: 100%;

            display: flex;

            align-items: center;

            justify-content: flex-start;

            gap: 12px;

            margin-bottom: 21px;

            text-align: left;
        }

        .section-heading h2,
        .section-heading p {
            text-align: left;
        }

        .section-icon {
            display: flex;

            align-items: center;

            justify-content: center;

            width: 42px;
            height: 42px;

            flex-shrink: 0;

            border:
                1px solid
                rgba(216,181,106,.27);

            border-radius: 11px;

            background:
                linear-gradient(
                    145deg,
                    rgba(216,181,106,.10),
                    rgba(93,48,139,.20)
                );

            color: #e2c473;

            box-shadow:
                0 8px 20px rgba(0,0,0,.18);
        }

        .section-icon svg {
            width: 19px;
            height: 19px;
        }

        .section-heading h2 {
            color: #f2ecf8;

            font-size: 17px;

            font-weight: 800;

            line-height: 1.2;

            letter-spacing: -.01em;
        }

        .section-heading p {
            margin-top: 4px;

            color: #8f849d;

            font-size: 11px;

            font-weight: 500;

            line-height: 1.5;
        }


        /* =========================================================
           FORM
        ========================================================== */

        .form-group {
            margin-bottom: 19px;

            text-align: left;
        }

        .form-label {
            display: block;

            margin-bottom: 9px;

            color: #d8cfdf;

            font-size: 10px;

            font-weight: 800;

            letter-spacing: .13em;

            text-transform: uppercase;

            text-align: left;
        }

        .input,
        .textarea {
            width: 100%;

            outline: none;

            border:
                1px solid
                rgba(164,130,205,.17);

            border-radius: 12px;

            background:
                linear-gradient(
                    145deg,
                    rgba(35,21,54,.72),
                    rgba(13,8,23,.90)
                );

            color: #f5eff9;

            font-family:
                "Manrope",
                sans-serif;

            font-size: 13px;

            text-align: left;

            transition:
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .input {
            height: 48px;

            padding:
                0
                15px;
        }

        .textarea {
            min-height: 150px;

            padding:
                15px
                16px;

            resize: vertical;

            line-height: 1.75;
        }

        .input:focus,
        .textarea:focus {
            border-color:
                rgba(220,184,102,.58);

            box-shadow:
                0 0 0 3px
                rgba(216,181,106,.06);
        }

        .input[readonly] {
            color: #9c92a8;
        }

        .textarea::placeholder {
            color: #61586c;
        }


        /* =========================================================
           CHARACTER COUNT
        ========================================================== */

        .description-bottom {
            display: flex;

            justify-content: flex-end;

            margin-top: 6px;

            color: #81768d;

            font-size: 9px;

            font-weight: 600;
        }


        /* =========================================================
           UPLOAD
        ========================================================== */

        .upload-area {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-top: 8px;

            padding:
                14px
                16px;

            border:
                1px solid
                rgba(216,181,106,.17);

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    rgba(43,27,64,.60),
                    rgba(17,10,28,.72)
                );
        }

        .upload-info {
            display: flex;

            align-items: center;

            gap: 10px;
        }

        .upload-icon {
            display: flex;

            align-items: center;

            justify-content: center;

            width: 38px;
            height: 38px;

            flex-shrink: 0;

            border:
                1px solid
                rgba(216,181,106,.23);

            border-radius: 10px;

            background:
                rgba(216,181,106,.07);

            color: #d7b968;
        }

        .upload-icon svg {
            width: 17px;
            height: 17px;
        }

        .upload-title {
            color: #eee8f5;

            font-size: 11px;

            font-weight: 800;
        }

        .upload-desc {
            margin-top: 3px;

            color: #776d82;

            font-size: 9px;
        }

        .upload-button {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 38px;

            padding:
                0
                17px;

            border:
                1px solid
                rgba(220,184,102,.48);

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    rgba(216,181,106,.15),
                    rgba(111,67,159,.20)
                );

            color: #e5ca7e;

            font-size: 10px;

            font-weight: 800;

            cursor: pointer;

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .upload-button:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 10px 25px rgba(0,0,0,.25);
        }

        #photo {
            display: none;
        }


        /* =========================================================
           AVAILABILITY
        ========================================================== */

        .availability-column {
            position: relative;

            width: 100%;

            min-width: 0;
        }

        .availability-header {
            margin:
                8px
                0
                24px;
        }

        .availability-eyebrow {
            display: flex;

            align-items: center;

            gap: 9px;

            margin-bottom: 8px;

            color: #d2b263;

            font-size: 8px;

            font-weight: 800;

            letter-spacing: .33em;

            text-transform: uppercase;
        }

        .availability-eyebrow::before {
            content: "";

            width: 30px;
            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    #ddbd6f,
                    transparent
                );
        }

        .availability-title {
            color: #fff;

            font-family:
                "Playfair Display",
                serif;

            font-size: 43px;

            font-weight: 600;

            line-height: 1.05;

            letter-spacing: -.03em;
        }

        .availability-subtitle {
            max-width: 650px;

            margin-top: 12px;

            color: #9d92aa;

            font-size: 12px;

            font-weight: 500;

            line-height: 1.8;

            letter-spacing: .005em;
        }


        /* =========================================================
           SCHEDULE SHELL
        ========================================================== */

        .schedule-shell {
            position: relative;

            padding: 1px;

            border-radius: 22px;

            background:
                linear-gradient(
                    135deg,
                    rgba(223,187,101,.45),
                    rgba(108,65,160,.16),
                    rgba(255,255,255,.03),
                    rgba(193,147,62,.27)
                );

            box-shadow:
                0 25px 70px rgba(0,0,0,.36);
        }

        .schedule-inner {
            padding: 22px;

            border-radius: 21px;

            background:
                linear-gradient(
                    145deg,
                    rgba(26,15,43,.94),
                    rgba(9,6,17,.97)
                );
        }


        /* =========================================================
           SCHEDULE HEADER
        ========================================================== */

        .schedule-top {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 19px;

            padding:
                0
                2px;
        }

        .schedule-top-title {
            color: #f1eaf7;

            font-size: 14px;

            font-weight: 800;

            letter-spacing: .01em;
        }

        .schedule-top-note {
            color: #8e829b;

            font-size: 10px;

            font-weight: 600;
        }


        /* =========================================================
           SCHEDULE LIST
        ========================================================== */

        .schedule-list {
            display: flex;

            flex-direction: column;

            gap: 11px;
        }

        .schedule-item {
            position: relative;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 30px;

            min-height: 92px;

            padding:
                16px
                20px
                16px
                24px;

            overflow: hidden;

            border:
                1px solid
                rgba(255,255,255,.07);

            border-radius: 16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(52,31,78,.78),
                    rgba(20,11,34,.94)
                );

            box-shadow:
                inset 0 1px 0
                rgba(255,255,255,.025);

            transition:
                transform .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .schedule-item::before {
            content: "";

            position: absolute;

            left: 0;

            top: 12px;

            bottom: 12px;

            width: 3px;

            border-radius: 5px;

            background:
                linear-gradient(
                    180deg,
                    #e5c675,
                    #8a55c4
                );

            box-shadow:
                0 0 12px
                rgba(216,181,106,.22);
        }

        .schedule-item::after {
            content: "";

            position: absolute;

            width: 170px;
            height: 170px;

            right: -100px;
            top: -100px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(213,169,79,.07),
                    transparent 68%
                );

            pointer-events: none;
        }

        .schedule-item:hover {
            transform:
                translateY(-2px);

            border-color:
                rgba(216,181,106,.27);

            box-shadow:
                0 14px 34px
                rgba(0,0,0,.28);
        }


        /* =========================================================
           DAY + TIME
        ========================================================== */

        .schedule-main {
            position: relative;

            z-index: 1;

            min-width: 0;
        }

        .schedule-day {
            color: #f5eff9;

            font-family:
                "Playfair Display",
                serif;

            font-size: 24px;

            font-weight: 600;

            line-height: 1;
        }

        .schedule-time {
            display: flex;

            align-items: center;

            gap: 9px;

            margin-top: 9px;

            color: #b9afc4;

            font-size: 14px;

            font-weight: 700;

            letter-spacing: .02em;
        }

        .schedule-time span:not(.time-dot) {
            color: #766c80;
        }

        .time-dot {
            width: 6px;
            height: 6px;

            flex-shrink: 0;

            border-radius: 50%;

            background: #d9b968;

            box-shadow:
                0 0 10px
                rgba(217,185,104,.75);
        }


        /* =========================================================
           STATUS SELECT
        ========================================================== */

        .status-select {
            position: relative;

            z-index: 2;

            min-width: 175px;

            height: 48px;

            padding:
                0
                42px
                0
                17px;

            outline: none;

            appearance: none;

            border:
                1px solid
                rgba(216,181,106,.38);

            border-radius: 13px;

            background-color: #211332;

            background-image:
                linear-gradient(
                    45deg,
                    transparent 50%,
                    #e0bf6c 50%
                ),
                linear-gradient(
                    135deg,
                    #e0bf6c 50%,
                    transparent 50%
                );

            background-position:
                calc(100% - 19px) 20px,
                calc(100% - 14px) 20px;

            background-size:
                6px 6px,
                6px 6px;

            background-repeat: no-repeat;

            color: #e5c979;

            font-family:
                "Manrope",
                sans-serif;

            font-size: 11px;

            font-weight: 800;

            letter-spacing: .02em;

            cursor: pointer;

            box-shadow:
                0 8px 20px
                rgba(0,0,0,.20);

            transition:
                border-color .25s ease,
                box-shadow .25s ease,
                transform .2s ease;
        }

        .status-select:hover {
            border-color:
                rgba(224,188,103,.70);

            transform:
                translateY(-2px);

            box-shadow:
                0 10px 28px
                rgba(0,0,0,.30),
                0 0 18px
                rgba(216,181,106,.07);
        }

        .status-select:focus {
            border-color:
                rgba(224,188,103,.80);

            box-shadow:
                0 0 0 3px
                rgba(216,181,106,.08),
                0 10px 28px
                rgba(0,0,0,.25);
        }

        .status-select option {
            background: #1b102b;

            color: #f5edfa;

            font-family:
                "Manrope",
                sans-serif;

            font-size: 11px;
        }


        /* =========================================================
           BOOKED
        ========================================================== */

        .booked-status {
            position: relative;

            z-index: 2;

            display: inline-flex;

            align-items: center;

            gap: 8px;

            min-height: 48px;

            padding:
                0
                17px;

            border:
                1px solid
                rgba(255,70,108,.38);

            border-radius: 13px;

            background:
                rgba(95,27,46,.38);

            color: #ff9caf;

            font-size: 10px;

            font-weight: 800;

            white-space: nowrap;
        }

        .booked-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: #ff416c;

            box-shadow:
                0 0 10px
                rgba(255,65,108,.8);
        }


        /* =========================================================
           EMPTY
        ========================================================== */

        .empty-schedule {
            padding:
                45px
                20px;

            border:
                1px solid
                rgba(255,255,255,.055);

            border-radius: 15px;

            background:
                rgba(20,12,32,.50);

            text-align: center;
        }

        .empty-icon {
            display: flex;

            align-items: center;

            justify-content: center;

            width: 42px;
            height: 42px;

            margin:
                0
                auto
                11px;

            border:
                1px solid
                rgba(216,181,106,.20);

            border-radius: 11px;

            color: #c8a95d;
        }

        .empty-icon svg {
            width: 18px;
            height: 18px;
        }

        .empty-title {
            color: #d8cfdf;

            font-size: 12px;

            font-weight: 800;
        }

        .empty-text {
            margin-top: 4px;

            color: #756b80;

            font-size: 9px;
        }


        /* =========================================================
           SAVE BUTTON
        ========================================================== */

        .actions {
            display: flex;

            justify-content: flex-end;

            margin-top: 19px;
        }

        .save-button {
            position: relative;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            min-height: 48px;

            padding:
                0
                25px;

            overflow: hidden;

            border:
                1px solid
                rgba(245,216,132,.62);

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #efd486,
                    #bc9146
                );

            color: #211509;

            font-size: 10px;

            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 13px 32px
                rgba(195,151,62,.17);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .save-button:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 18px 40px
                rgba(195,151,62,.28);
        }

        .save-button svg {
            width: 15px;
            height: 15px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1150px) {

            main {
                padding:
                    24px
                    35px
                    55px;
            }

            .profile-layout {
                grid-template-columns:
                    320px
                    minmax(0,1fr);

                gap: 45px;
            }

            .photo-stage {
                width: 205px;
                height: 205px;
            }

            .profile-name {
                font-size: 38px;
            }

            .availability-title,
            .page-title {
                font-size: 35px;
            }

            .availability-subtitle {
                font-size: 11px;
            }

            .schedule-day {
                font-size: 22px;
            }

            .schedule-time {
                font-size: 13px;
            }

            .status-select {
                min-width: 160px;
            }

            .section-heading h2 {
                font-size: 16px;
            }

            .section-heading p {
                font-size: 10px;
            }

            .form-label {
                font-size: 9px;
            }

            .input,
            .textarea {
                font-size: 12px;
            }

        }


        @media (max-width: 850px) {

            main {
                padding:
                    22px
                    25px
                    50px;
            }

            .profile-layout {
                grid-template-columns: 1fr;

                gap: 32px;
            }

            .profile-column {
                position: relative;

                top: auto;
            }

            .photo-stage {
                width: 200px;
                height: 200px;
            }

            .profile-name {
                font-size: 36px;
            }

            .availability-title,
            .page-title {
                font-size: 32px;
            }

            .schedule-item {
                align-items: flex-start;

                flex-direction: column;

                gap: 16px;

                min-height: 0;
            }

            .status-select,
            .booked-status {
                width: 100%;
            }

            .section-heading h2 {
                font-size: 17px;
            }

            .section-heading p {
                font-size: 11px;
            }

            .form-label {
                font-size: 10px;
            }

            .input,
            .textarea {
                font-size: 13px;
            }

        }


        @media (max-width: 600px) {

            main {
                padding:
                    18px
                    16px
                    40px;
            }

            .photo-stage {
                width: 175px;
                height: 175px;
            }

            .profile-name {
                font-size: 31px;
            }

            .availability-title,
            .page-title {
                font-size: 29px;
            }

            .availability-subtitle {
                font-size: 10px;
            }

            .schedule-inner {
                padding: 15px;
            }

            .schedule-top {
                align-items: flex-start;

                flex-direction: column;

                gap: 5px;
            }

            .schedule-top-title {
                font-size: 13px;
            }

            .schedule-top-note {
                font-size: 9px;
            }

            .schedule-item {
                padding:
                    16px
                    15px
                    16px
                    20px;
            }

            .schedule-day {
                font-size: 22px;
            }

            .schedule-time {
                font-size: 13px;
            }

            .section-icon {
                width: 40px;
                height: 40px;
            }

            .section-heading h2 {
                font-size: 16px;
            }

            .section-heading p {
                font-size: 10px;
            }

            .form-label {
                font-size: 9px;
            }

            .input,
            .textarea {
                font-size: 12px;
            }

            .upload-area {
                align-items: flex-start;

                flex-direction: column;
            }

            .upload-button {
                width: 100%;
            }

            .actions {
                justify-content: stretch;
            }

            .save-button {
                width: 100%;
            }

        }

    </style>

</head>


<body>


    <div class="ambient-orb orb-purple"></div>

    <div class="ambient-orb orb-gold"></div>


    @include('whisperly.navbar')


    <main>


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header class="page-header">

            <div class="page-eyebrow">
                PROFILE SETTINGS
            </div>

            <h1 class="page-title">
                Edit profil kamu.
            </h1>

            <p class="page-subtitle">
                Atur informasi profil dan ketersediaanmu supaya
                pengguna Whisperly tahu lebih banyak tentangmu
                dan kapan kamu siap menerima booking.
            </p>

        </header>


        {{-- =====================================================
             SUCCESS
        ====================================================== --}}

        @if (session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        {{-- =====================================================
             ERROR
        ====================================================== --}}

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
             FORM
        ====================================================== --}}

        <form
            action="{{ route('talent.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            <div class="profile-layout">


                {{-- =================================================
                     PROFILE LEFT
                ================================================== --}}

                <aside class="profile-column">


                    {{-- FOTO CENTER --}}

                    <div class="photo-stage">

                        <div class="photo-ring">

                            <div class="profile-photo">

                                @php

                                    $photo =
                                        trim(
                                            (string) $talent->photo
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
                                                    'storage/' . $photo
                                                );

                                        }

                                    }

                                @endphp


                                @if ($photoUrl)

                                    <img
                                        id="photoPreview"
                                        src="{{ $photoUrl }}"
                                        alt="Foto Profil"
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
                                                        $user->username
                                                    )
                                                ) % 8
                                            ) + 1;

                                    @endphp

                                    <img
                                        id="photoPreview"
                                        src="{{ asset(
                                            'assets/images/faces/' .
                                            $faceNumber .
                                            '.jpg'
                                        ) }}"
                                        alt="Foto Profil"
                                    >

                                @endif

                            </div>

                        </div>


                        <span class="online-dot"></span>

                    </div>


                    {{-- =================================================
                         IDENTITAS CENTER
                    ================================================== --}}

                    <div class="profile-info">

                        <div class="profile-label">
                            WHISPERLY TALENT
                        </div>

                        <h2 class="profile-name">
                            {{ ucfirst($user->username) }}
                        </h2>

                        <div class="email">
                            {{ $user->email }}
                        </div>


                        {{-- GARIS --}}

                        <div class="profile-divider"></div>


                        {{-- =================================================
                             INFORMASI PROFIL
                        ================================================== --}}

                        <div class="section-heading">

                            <div class="section-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >

                                    <path
                                        d="M20 21a8 8 0 0 0-16 0"
                                    ></path>

                                    <circle
                                        cx="12"
                                        cy="7"
                                        r="4"
                                    ></circle>

                                </svg>

                            </div>


                            <div>

                                <h2>
                                    Informasi Profil
                                </h2>

                                <p>
                                    Informasi dasar profil kamu
                                </p>

                            </div>

                        </div>


                        {{-- USERNAME --}}

                        <div class="form-group">

                            <label
                                for="username"
                                class="form-label"
                            >
                                Username
                            </label>

                            <input
                                type="text"
                                id="username"
                                class="input"
                                value="{{ $user->username }}"
                                readonly
                            >

                        </div>


                        {{-- EMAIL --}}

                        <div class="form-group">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                class="input"
                                value="{{ $user->email }}"
                                readonly
                            >

                        </div>


                        {{-- ABOUT YOU --}}

                        <div class="form-group">

                            <label
                                for="description"
                                class="form-label"
                            >
                                About You
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                class="textarea"
                                maxlength="2000"
                                required
                                placeholder="Ceritakan sedikit tentang dirimu..."
                            >{{ old('description', $talent->deskripsi ?? '') }}</textarea>


                            <div class="description-bottom">

                                <span id="charCount">
                                    0 / 2000
                                </span>

                            </div>

                        </div>


                        {{-- GANTI FOTO --}}

                        <div class="upload-area">

                            <div class="upload-info">

                                <div class="upload-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="M12 16V4"></path>

                                        <path d="M7 9l5-5 5 5"></path>

                                        <path d="M5 20h14"></path>

                                    </svg>

                                </div>


                                <div>

                                    <div class="upload-title">
                                        Ganti Foto
                                    </div>

                                    <div class="upload-desc">
                                        JPG, PNG atau WEBP · Maks. 2 MB
                                    </div>

                                </div>

                            </div>


                            <label
                                for="photo"
                                class="upload-button"
                            >
                                Pilih Foto
                            </label>


                            <input
                                type="file"
                                name="photo"
                                id="photo"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            >

                        </div>

                    </div>

                </aside>


                {{-- =================================================
                     AVAILABILITY RIGHT
                ================================================== --}}

                <section class="availability-column">


                    <header class="availability-header">

                        <div class="availability-eyebrow">
                            PROFILE AVAILABILITY
                        </div>

                        <h2 class="availability-title">
                            Atur waktu terbaikmu.
                        </h2>

                        <p class="availability-subtitle">
                            Tentukan jadwal kapan kamu tersedia untuk
                            menerima booking dari pengguna Whisperly.
                        </p>

                    </header>


                    <div class="schedule-shell">

                        <div class="schedule-inner">


                            <div class="schedule-top">

                                <div class="schedule-top-title">
                                    Jadwal Talent
                                </div>

                                <div class="schedule-top-note">
                                    Pilih status setiap jadwal
                                </div>

                            </div>


                            @if ($talent->schedules->count())


                                <div class="schedule-list">


                                    @foreach ($talent->schedules as $schedule)


                                        @php

                                            $status =
                                                $schedule->resolveStatusForDate(
                                                    now(
                                                        config('app.timezone')
                                                    )->toDateString()
                                                );

                                        @endphp


                                        <div class="schedule-item">


                                            <div class="schedule-main">

                                                <div class="schedule-day">
                                                    {{ $schedule->day }}
                                                </div>


                                                <div class="schedule-time">

                                                    <span class="time-dot"></span>

                                                    {{ substr($schedule->start_time, 0, 5) }}

                                                    <span>
                                                        —
                                                    </span>

                                                    {{ substr($schedule->end_time, 0, 5) }}

                                                </div>

                                            </div>


                                            @if ($status === 'booked')


                                                <div class="booked-status">

                                                    <span class="booked-dot"></span>

                                                    Sudah Dibooking

                                                </div>


                                            @else


                                                <select
                                                    name="schedule[{{ $schedule->id }}]"
                                                    class="status-select"
                                                >

                                                    <option
                                                        value="available"
                                                        {{ $status === 'available' ? 'selected' : '' }}
                                                    >
                                                        Tersedia
                                                    </option>

                                                    <option
                                                        value="unavailable"
                                                        {{ $status === 'unavailable' ? 'selected' : '' }}
                                                    >
                                                        Tidak Tersedia
                                                    </option>

                                                </select>


                                            @endif


                                        </div>


                                    @endforeach


                                </div>


                            @else


                                <div class="empty-schedule">

                                    <div class="empty-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >

                                            <rect
                                                x="3"
                                                y="4"
                                                width="18"
                                                height="17"
                                                rx="3"
                                            ></rect>

                                            <path d="M8 2v4"></path>

                                            <path d="M16 2v4"></path>

                                            <path d="M3 10h18"></path>

                                        </svg>

                                    </div>


                                    <div class="empty-title">
                                        Belum ada jadwal
                                    </div>


                                    <div class="empty-text">
                                        Jadwal kamu akan muncul di sini.
                                    </div>

                                </div>


                            @endif


                        </div>

                    </div>


                    {{-- =================================================
                         SAVE
                    ================================================== --}}

                    <div class="actions">

                        <button
                            type="submit"
                            class="save-button"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"
                                ></path>

                                <path
                                    d="M17 21v-8H7v8"
                                ></path>

                                <path
                                    d="M7 3v5h8"
                                ></path>

                            </svg>

                            Simpan Perubahan

                        </button>

                    </div>


                </section>


            </div>

        </form>

    </main>


    <script>

        /* =========================================================
           PHOTO PREVIEW
        ========================================================== */

        const photoInput =
            document.getElementById("photo");

        const photoPreview =
            document.getElementById("photoPreview");


        if (
            photoInput &&
            photoPreview
        ) {

            photoInput.addEventListener(
                "change",
                function () {

                    const file =
                        this.files[0];

                    if (!file) {
                        return;
                    }


                    const allowedTypes = [
                        "image/jpeg",
                        "image/png",
                        "image/webp"
                    ];


                    if (
                        !allowedTypes.includes(
                            file.type
                        )
                    ) {

                        alert(
                            "Format foto harus JPG, PNG, atau WEBP."
                        );

                        this.value = "";

                        return;
                    }


                    if (
                        file.size >
                        2 * 1024 * 1024
                    ) {

                        alert(
                            "Ukuran foto maksimal 2 MB."
                        );

                        this.value = "";

                        return;
                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function (event) {

                            photoPreview.src =
                                event.target.result;

                        };


                    reader.readAsDataURL(file);

                }
            );

        }


        /* =========================================================
           CHARACTER COUNTER
        ========================================================== */

        const description =
            document.getElementById(
                "description"
            );

        const charCount =
            document.getElementById(
                "charCount"
            );


        function updateCharCount() {

            if (
                !description ||
                !charCount
            ) {
                return;
            }

            charCount.textContent =
                `${description.value.length} / 2000`;

        }


        if (description) {

            description.addEventListener(
                "input",
                updateCharCount
            );

            updateCharCount();

        }

    </script>

</body>

</html>

