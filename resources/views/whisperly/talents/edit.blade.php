
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Profil - Whisperly</title>

    <style>
        /* =========================================================
           WHISPERLY EDIT PROFILE
        ========================================================= */

        :root {
            --wp-green: #789f89;
            --wp-green-dark: #527663;
            --wp-green-deep: #385b4b;
            --wp-green-soft: #e8f1eb;
            --wp-pink: #f4dfe5;
            --wp-pink-dark: #c98599;
            --wp-cream: #fcf8f3;
            --wp-white: #ffffff;
            --wp-text: #34443d;
            --wp-text-soft: #69766f;
            --wp-muted: #9aa59f;
            --wp-border: #e7ebe7;

            --wp-shadow:
                0 24px 70px rgba(72, 94, 82, 0.10);

            --wp-radius-xl: 38px;
            --wp-radius-lg: 30px;
        }


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
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            color: var(--wp-text);

            background:
                radial-gradient(
                    circle at 8% 8%,
                    rgba(120, 169, 135, .15),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 92% 20%,
                    rgba(244, 223, 229, .55),
                    transparent 25%
                ),
                var(--wp-cream);
        }


        /* =========================================================
           PAGE
        ========================================================= */

        .wp-page {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            padding: 42px 24px 70px;
        }

        .wp-page::before {
            content: "";
            position: absolute;

            width: 390px;
            height: 390px;

            top: 100px;
            left: -210px;

            background:
                radial-gradient(
                    circle,
                    rgba(120, 169, 135, .15),
                    transparent 68%
                );

            pointer-events: none;
        }

        .wp-page::after {
            content: "";
            position: absolute;

            width: 430px;
            height: 430px;

            right: -250px;
            bottom: 50px;

            background:
                radial-gradient(
                    circle,
                    rgba(244, 223, 229, .40),
                    transparent 68%
                );

            pointer-events: none;
        }


        /* =========================================================
           CONTAINER
        ========================================================= */

        .wp-container {
            position: relative;
            z-index: 2;

            width: min(1180px, 100%);
            margin: 0 auto;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .wp-heading {
            margin-bottom: 28px;
        }

        .wp-heading-left {
            max-width: 650px;
        }

        .wp-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 11px;

            color: var(--wp-green-dark);

            font-size: 11px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .wp-eyebrow-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: var(--wp-pink-dark);

            box-shadow:
                0 0 0 5px rgba(201, 133, 153, .10);
        }

        .wp-title {
            color: var(--wp-green-deep);

            font-size: clamp(30px, 4vw, 44px);
            line-height: 1.08;

            letter-spacing: -.045em;
            font-weight: 800;
        }

        .wp-subtitle {
            max-width: 570px;

            margin-top: 10px;

            color: var(--wp-text-soft);

            font-size: 14px;
            line-height: 1.7;
        }


        /* =========================================================
           GRID
        ========================================================= */

        .wp-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 1.08fr)
                minmax(360px, .92fr);

            gap: 22px;

            align-items: stretch;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .wp-card {
            position: relative;

            background:
                rgba(255, 255, 255, .88);

            border:
                1px solid rgba(224, 230, 225, .65);

            border-radius: var(--wp-radius-xl);

            box-shadow: var(--wp-shadow);

            overflow: hidden;

            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }


        /* =========================================================
           PROFILE CARD
        ========================================================= */

        .wp-profile-card {
            padding: 28px;
        }

        .wp-profile-top {
            position: relative;

            display: flex;
            align-items: center;

            gap: 21px;

            padding: 22px;
            margin-bottom: 28px;

            border-radius: 32px;

            background:
                linear-gradient(
                    135deg,
                    #eef5ef 0%,
                    #f8f2ed 52%,
                    #f8e9ed 100%
                );

            overflow: hidden;
        }

        .wp-profile-top::after {
            content: "";

            position: absolute;

            width: 190px;
            height: 190px;

            right: -75px;
            top: -95px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, .40);
        }


        /* =========================================================
           PHOTO
        ========================================================= */

        .wp-photo-wrap {
            position: relative;
            z-index: 2;

            flex: 0 0 auto;
        }

        .wp-photo {
            display: block;

            width: 112px;
            height: 112px;

            object-fit: cover;

            /* FOTO BULAT */
            border-radius: 50%;

            border:
                5px solid rgba(255, 255, 255, .95);

            box-shadow:
                0 14px 30px rgba(67, 91, 77, .15);
        }

        .wp-photo-status {
            position: absolute;

            right: -4px;
            bottom: -4px;

            width: 27px;
            height: 27px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--wp-white);

            box-shadow:
                0 5px 15px rgba(67, 91, 77, .13);
        }

        .wp-photo-status span {
            width: 11px;
            height: 11px;

            border-radius: 50%;

            background: #78aa87;
        }


        /* =========================================================
           PROFILE IDENTITY
        ========================================================= */

        .wp-profile-identity {
            position: relative;
            z-index: 2;

            min-width: 0;
        }

        .wp-profile-label {
            margin-bottom: 6px;

            color: var(--wp-text-soft);

            font-size: 11px;
            font-weight: 800;

            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .wp-profile-username {
            color: var(--wp-green-deep);

            font-size: 25px;
            line-height: 1.1;

            font-weight: 800;
            letter-spacing: -.035em;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .wp-profile-hint {
            margin-top: 8px;

            color: #718078;

            font-size: 12px;
            line-height: 1.5;
        }


        /* =========================================================
           SECTION TITLE
        ========================================================= */

        .wp-section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 18px;
        }

        .wp-section-title-left {
            display: flex;
            align-items: center;

            gap: 10px;
        }

        .wp-section-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            color: var(--wp-green-dark);
            background: var(--wp-green-soft);
        }

        .wp-section-icon svg {
            width: 17px;
            height: 17px;
        }

        .wp-section-title h2 {
            color: var(--wp-text);

            font-size: 15px;
            font-weight: 800;
        }


        /* =========================================================
           FORM
        ========================================================= */

        .wp-form-group {
            margin-bottom: 17px;
        }

        .wp-form-label {
            display: block;

            margin-bottom: 8px;

            color: #59675f;

            font-size: 12px;
            font-weight: 800;
        }

        .wp-input,
        .wp-textarea {
            width: 100%;

            border:
                1px solid rgba(225, 231, 226, .8);

            outline: none;

            color: var(--wp-text);
            background: #fbfcfa;

            font-family: inherit;
            font-size: 13px;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .wp-input {
            height: 50px;

            padding: 0 18px;

            border-radius: 999px;
        }

        .wp-textarea {
            min-height: 130px;

            padding: 16px 18px;

            line-height: 1.65;

            resize: vertical;

            border-radius: 25px;
        }

        .wp-input:focus,
        .wp-textarea:focus {
            border-color:
                rgba(120, 169, 135, .55);

            background: var(--wp-white);

            box-shadow:
                0 0 0 4px rgba(120, 169, 135, .09);
        }

        .wp-input[readonly] {
            color: #758078;

            background: #f3f6f3;

            cursor: not-allowed;
        }

        .wp-description-bottom {
            display: flex;
            justify-content: flex-end;

            margin-top: 6px;

            color: var(--wp-muted);

            font-size: 11px;
        }


        /* =========================================================
           UPLOAD FOTO
        ========================================================= */

        .wp-upload-area {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 14px;

            padding: 14px 17px;

            border-radius: 999px;

            background:
                linear-gradient(
                    100deg,
                    rgba(232, 243, 233, .70),
                    rgba(248, 228, 233, .48)
                );
        }

        .wp-upload-info {
            display: flex;
            align-items: center;

            gap: 11px;

            min-width: 0;
        }

        .wp-upload-icon {
            flex: 0 0 auto;

            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            color: var(--wp-pink-dark);

            background:
                rgba(255, 255, 255, .75);
        }

        .wp-upload-icon svg {
            width: 18px;
            height: 18px;
        }

        .wp-upload-text {
            min-width: 0;
        }

        .wp-upload-title {
            color: var(--wp-text);

            font-size: 12px;
            font-weight: 800;
        }

        .wp-upload-desc {
            margin-top: 2px;

            color: var(--wp-muted);

            font-size: 10px;
        }

        .wp-upload-button {
            flex: 0 0 auto;

            position: relative;

            padding: 10px 17px;

            border: 0;
            border-radius: 999px;

            color: var(--wp-green-dark);

            background: var(--wp-white);

            box-shadow:
                0 5px 14px rgba(72, 94, 82, .08);

            font-family: inherit;

            font-size: 11px;
            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }

        .wp-upload-button:hover {
            transform: translateY(-1px);

            box-shadow:
                0 8px 18px rgba(72, 94, 82, .12);
        }

        #photo {
            display: none;
        }


        /* =========================================================
           AVAILABILITY
        ========================================================= */

        .wp-availability-card {
            padding: 28px;
        }

        .wp-availability-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 21px;
        }

        .wp-availability-heading {
            display: flex;

            gap: 12px;
        }

        .wp-big-icon {
            flex: 0 0 auto;

            width: 47px;
            height: 47px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            color: var(--wp-green-dark);

            background:
                linear-gradient(
                    145deg,
                    #e5f0e8,
                    #f6e6e9
                );
        }

        .wp-big-icon svg {
            width: 21px;
            height: 21px;
        }

        .wp-availability-title {
            color: var(--wp-green-deep);

            font-size: 20px;
            line-height: 1.2;

            font-weight: 800;

            letter-spacing: -.025em;
        }

        .wp-availability-desc {
            margin-top: 5px;

            color: var(--wp-muted);

            font-size: 11px;
            line-height: 1.5;
        }

        .wp-count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 34px;
            height: 29px;

            padding: 0 10px;

            border-radius: 999px;

            color: var(--wp-green-dark);
            background: var(--wp-green-soft);

            font-size: 11px;
            font-weight: 800;
        }


        /* =========================================================
           SCHEDULE
        ========================================================= */

        .wp-schedule-list {
            display: flex;
            flex-direction: column;

            gap: 10px;

            max-height: 520px;

            overflow-y: auto;

            padding-right: 3px;
        }

        .wp-schedule-list::-webkit-scrollbar {
            width: 4px;
        }

        .wp-schedule-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .wp-schedule-list::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: #dce4df;
        }

        .wp-schedule {
            display: grid;

            grid-template-columns: 1fr auto;

            align-items: center;

            gap: 14px;

            padding: 14px 12px 14px 18px;

            border-radius: 22px;

            background: #f7f9f6;

            transition:
                transform .2s ease,
                background .2s ease,
                box-shadow .2s ease;
        }

        .wp-schedule:hover {
            transform: translateY(-2px);

            background: #f4f8f4;

            box-shadow:
                0 8px 20px rgba(72, 94, 82, .06);
        }

        .wp-schedule-main {
            min-width: 0;
        }

        .wp-schedule-day {
            color: var(--wp-text);

            font-size: 13px;
            font-weight: 800;
        }

        .wp-schedule-time {
            display: inline-flex;
            align-items: center;

            gap: 6px;

            margin-top: 5px;

            color: var(--wp-muted);

            font-size: 11px;
        }

        .wp-time-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: var(--wp-pink-dark);
        }


        /* =========================================================
           SELECT
        ========================================================= */

        .wp-status-select {
            min-width: 145px;
            height: 39px;

            padding: 0 30px 0 15px;

            border:
                1px solid rgba(220, 229, 222, .8);

            border-radius: 999px;

            outline: none;

            color: var(--wp-green-dark);

            background-color: var(--wp-white);

            font-family: inherit;

            font-size: 11px;
            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }

        .wp-status-select:hover,
        .wp-status-select:focus {
            border-color:
                rgba(120, 169, 135, .60);

            box-shadow:
                0 0 0 3px rgba(120, 169, 135, .09);
        }


        /* =========================================================
           BOOKED
        ========================================================= */

        .wp-booked {
            display: inline-flex;
            align-items: center;

            gap: 7px;

            min-height: 39px;

            padding: 0 15px;

            border-radius: 999px;

            color: #a56d7d;

            background: #faeaee;

            font-size: 10px;
            font-weight: 800;

            white-space: nowrap;
        }

        .wp-booked svg {
            width: 14px;
            height: 14px;
        }


        /* =========================================================
           EMPTY
        ========================================================= */

        .wp-empty {
            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;

            min-height: 250px;

            padding: 30px;

            border:
                1px dashed #dce4de;

            border-radius: 28px;

            text-align: center;

            background:
                linear-gradient(
                    145deg,
                    rgba(232, 243, 233, .35),
                    rgba(248, 228, 233, .22)
                );
        }

        .wp-empty-icon {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 13px;

            border-radius: 50%;

            color: var(--wp-green-dark);

            background: var(--wp-white);

            box-shadow:
                0 9px 24px rgba(72, 94, 82, .08);
        }

        .wp-empty-icon svg {
            width: 23px;
            height: 23px;
        }

        .wp-empty-title {
            color: var(--wp-text);

            font-size: 13px;
            font-weight: 800;
        }

        .wp-empty-text {
            margin-top: 5px;

            color: var(--wp-muted);

            font-size: 11px;
        }


        /* =========================================================
           ACTION
        ========================================================= */

        .wp-actions {
            display: flex;

            align-items: center;
            justify-content: flex-end;

            margin-top: 25px;
        }

        .wp-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            min-height: 48px;

            padding: 0 24px;

            border-radius: 999px;

            font-family: inherit;

            font-size: 12px;
            font-weight: 800;

            cursor: pointer;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .wp-btn-save {
            border: 0;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    var(--wp-green),
                    var(--wp-green-dark)
                );

            box-shadow:
                0 10px 23px rgba(82, 118, 99, .20);
        }

        .wp-btn-save:hover {
            transform: translateY(-2px);

            box-shadow:
                0 14px 28px rgba(82, 118, 99, .27);
        }

        .wp-btn svg {
            width: 15px;
            height: 15px;
        }


        /* =========================================================
           ERROR
        ========================================================= */

        .wp-error {
            margin-bottom: 18px;

            padding: 13px 17px;

            border:
                1px solid #f0cfd7;

            border-radius: 20px;

            color: #a85f73;

            background: #fff2f5;

            font-size: 12px;
            line-height: 1.6;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 950px) {

            .wp-grid {
                grid-template-columns: 1fr;
            }

            .wp-availability-card {
                min-height: auto;
            }
        }


        @media (max-width: 650px) {

            .wp-page {
                padding:
                    25px 14px 45px;
            }

            .wp-profile-card,
            .wp-availability-card {
                padding: 20px;
            }

            .wp-profile-top {
                align-items: flex-start;

                flex-direction: column;

                padding: 19px;

                border-radius: 28px;
            }

            .wp-photo {
                width: 94px;
                height: 94px;

                border-radius: 50%;
            }

            .wp-profile-username {
                font-size: 22px;
            }

            .wp-upload-area {
                align-items: flex-start;

                flex-direction: column;

                border-radius: 25px;
            }

            .wp-upload-button {
                width: 100%;
            }

            .wp-schedule {
                grid-template-columns: 1fr;
            }

            .wp-status-select,
            .wp-booked {
                width: 100%;
            }

            .wp-actions {
                margin-top: 20px;
            }

            .wp-btn-save {
                width: 100%;
            }
        }
    </style>
</head>


<body>

    {{-- =========================================================
         NAVBAR GLOBAL
    ========================================================== --}}

    @include('whisperly.navbar')


    <main class="wp-page">

        <div class="wp-container">

            {{-- =================================================
                 HEADER
            ================================================== --}}

            <header class="wp-heading">

                <div class="wp-heading-left">

                    <div class="wp-eyebrow">

                        <span class="wp-eyebrow-dot"></span>

                        Whisperly Profile

                    </div>


                    <h1 class="wp-title">
                        Edit profil kamu
                    </h1>


                    <p class="wp-subtitle">
                        Atur informasi profil dan ketersediaanmu
                        supaya orang lain tahu kapan kamu siap menerima
                        booking.
                    </p>

                </div>

            </header>


            {{-- =================================================
                 VALIDATION ERROR
            ================================================== --}}

            @if ($errors->any())

                <div class="wp-error">

                    @foreach ($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            {{-- =================================================
                 FORM
            ================================================== --}}

            <form
                action="{{ route('talent.update') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                <div class="wp-grid">


                    {{-- =================================================
                         LEFT : PROFILE
                    ================================================== --}}

                    <section class="wp-card wp-profile-card">


                        {{-- Profile identity --}}

                        <div class="wp-profile-top">


                            <div class="wp-photo-wrap">

                                @if ($talent->photo)

                                    <img
                                        id="photoPreview"
                                        class="wp-photo"
                                        src="{{ asset('storage/' . $talent->photo) }}"
                                        alt="Foto Profil"
                                    >

                                @else

                                    @php

                                        $faceNumber =
                                            (abs(crc32($user->username)) % 8) + 1;

                                    @endphp


                                    <img
                                        id="photoPreview"
                                        class="wp-photo"
                                        src="{{ asset('assets/images/faces/' . $faceNumber . '.jpg') }}"
                                        alt="Foto Profil"
                                    >

                                @endif


                                <div class="wp-photo-status">

                                    <span></span>

                                </div>

                            </div>


                            <div class="wp-profile-identity">

                                <div class="wp-profile-label">
                                    Foto Profil
                                </div>


                                <div class="wp-profile-username">
                                    {{ $user->username }}
                                </div>


                                <div class="wp-profile-hint">
                                    Profil kamu akan terlihat seperti ini
                                    oleh pengguna Whisperly lainnya.
                                </div>

                            </div>

                        </div>


                        {{-- Section --}}

                        <div class="wp-section-title">

                            <div class="wp-section-title-left">

                                <div class="wp-section-icon">

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


                                <h2>
                                    Informasi Profil
                                </h2>

                            </div>

                        </div>


                        {{-- Username --}}

                        <div class="wp-form-group">

                            <label
                                for="username"
                                class="wp-form-label"
                            >
                                Username
                            </label>


                            <input
                                type="text"
                                id="username"
                                class="wp-input"
                                value="{{ $user->username }}"
                                readonly
                            >

                        </div>


                        {{-- Email --}}

                        <div class="wp-form-group">

                            <label
                                for="email"
                                class="wp-form-label"
                            >
                                Email
                            </label>


                            <input
                                type="email"
                                id="email"
                                class="wp-input"
                                value="{{ $user->email }}"
                                readonly
                            >

                        </div>


                        {{-- Description --}}

                        <div class="wp-form-group">

                            <label
                                for="description"
                                class="wp-form-label"
                            >
                                About You
                            </label>


                            <textarea
                                name="description"
                                id="description"
                                class="wp-textarea"
                                maxlength="2000"
                                required
                                placeholder="Ceritakan sedikit tentang dirimu..."
                            >{{ old('description', $talent->deskripsi ?? '') }}</textarea>


                            <div class="wp-description-bottom">

                                <span id="charCount">
                                    0 / 2000
                                </span>

                            </div>

                        </div>


                        {{-- Upload --}}

                        <div class="wp-upload-area">

                            <div class="wp-upload-info">

                                <div class="wp-upload-icon">

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


                                <div class="wp-upload-text">

                                    <div class="wp-upload-title">
                                        Ganti Foto
                                    </div>

                                    <div class="wp-upload-desc">
                                        JPG, PNG atau WEBP · Maks. 2 MB
                                    </div>

                                </div>

                            </div>


                            <label
                                for="photo"
                                class="wp-upload-button"
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

                    </section>



                    {{-- =================================================
                         RIGHT : AVAILABILITY
                    ================================================== --}}

                    <section class="wp-card wp-availability-card">


                        <div class="wp-availability-header">

                            <div class="wp-availability-heading">


                                <div class="wp-big-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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

                                        <path d="M8 14h.01"></path>

                                        <path d="M12 14h.01"></path>

                                        <path d="M16 14h.01"></path>

                                        <path d="M8 18h.01"></path>

                                        <path d="M12 18h.01"></path>

                                    </svg>

                                </div>


                                <div>

                                    <h2 class="wp-availability-title">
                                        Availability
                                    </h2>


                                    <p class="wp-availability-desc">
                                        Tentukan kapan kamu tersedia
                                        untuk menerima booking.
                                    </p>

                                </div>

                            </div>


                            @if ($talent->schedules)

                                <span class="wp-count-badge">
                                    {{ $talent->schedules->count() }}
                                </span>

                            @endif

                        </div>


                        {{-- Schedule --}}

                        @forelse ($talent->schedules as $schedule)

                            @php

                                $status =
                                    $schedule->resolveStatusForDate(
                                        now(config('app.timezone'))
                                            ->toDateString()
                                    );

                            @endphp


                            <div class="wp-schedule">


                                <div class="wp-schedule-main">

                                    <div class="wp-schedule-day">
                                        {{ $schedule->day }}
                                    </div>


                                    <div class="wp-schedule-time">

                                        <span class="wp-time-dot"></span>

                                        {{ substr($schedule->start_time, 0, 5) }}

                                        <span>—</span>

                                        {{ substr($schedule->end_time, 0, 5) }}

                                    </div>

                                </div>


                                @if ($status === 'booked')

                                    <div class="wp-booked">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
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

                                            <path d="M9 15l2 2 4-4"></path>

                                        </svg>

                                        Sudah Dibooking

                                    </div>

                                @else

                                    <select
                                        name="schedule[{{ $schedule->id }}]"
                                        class="wp-status-select"
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


                        @empty


                            <div class="wp-empty">

                                <div class="wp-empty-icon">

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


                                <div class="wp-empty-title">
                                    Belum ada jadwal
                                </div>


                                <div class="wp-empty-text">
                                    Jadwal kamu akan muncul di sini.
                                </div>

                            </div>


                        @endforelse

                    </section>

                </div>



                {{-- =================================================
                     ACTIONS
                ================================================== --}}

                <div class="wp-actions">

                    <button
                        type="submit"
                        class="wp-btn wp-btn-save"
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

                            <path d="M17 21v-8H7v8"></path>

                            <path d="M7 3v5h8"></path>

                        </svg>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </main>



    <script>

        /* =========================================================
           PHOTO PREVIEW
        ========================================================== */

        const photoInput =
            document.getElementById('photo');

        const photoPreview =
            document.getElementById('photoPreview');


        if (photoInput && photoPreview) {

            photoInput.addEventListener(
                'change',
                function () {

                    const file = this.files[0];

                    if (!file) {
                        return;
                    }


                    const allowedTypes = [
                        'image/jpeg',
                        'image/png',
                        'image/webp'
                    ];


                    if (!allowedTypes.includes(file.type)) {

                        alert(
                            'Format foto harus JPG, PNG, atau WEBP.'
                        );

                        this.value = '';

                        return;
                    }


                    if (file.size > 2 * 1024 * 1024) {

                        alert(
                            'Ukuran foto maksimal 2 MB.'
                        );

                        this.value = '';

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
           DESCRIPTION CHARACTER COUNT
        ========================================================== */

        const description =
            document.getElementById('description');

        const charCount =
            document.getElementById('charCount');


        function updateCharCount() {

            if (!description || !charCount) {
                return;
            }


            charCount.textContent =
                `${description.value.length} / 2000`;

        }


        if (description) {

            description.addEventListener(
                'input',
                updateCharCount
            );

            updateCharCount();

        }

    </script>

</body>

</html>
```
