<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ruang Pengaduan | Whisperly</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --white: #ffffff;
            --dark: #30251f;
            --text: #45403b;
            --muted: #817970;

            --green-soft: #dce9df;
            --green: #718d78;
            --green-dark: #526b58;

            --blue: #6078c7;
            --blue-soft: #dce7f3;

            --pink-soft: #ffe1ea;
            --pink-dark: #bd3d63;

            --purple: #756dcc;

            --shadow: 0 6px 18px rgba(45, 53, 53, 0.14);
            --shadow-small: 0 3px 10px rgba(45, 53, 53, 0.10);
        }

        /* =====================================================
           BACKGROUND DEFAULT
        ===================================================== */

        body {
            margin: 0;
            min-height: 100vh;

            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--text);

            background:
                radial-gradient(
                    700px 450px at 0% 5%,
                    rgba(208, 230, 215, .65),
                    transparent 65%
                ),
                radial-gradient(
                    700px 450px at 100% 5%,
                    rgba(255, 237, 193, .70),
                    transparent 65%
                ),
                linear-gradient(
                    180deg,
                    #edf4f7 0%,
                    #f5f7f7 100%
                );

            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* =====================================================
           BACKGROUND HOROR
        ===================================================== */

        body.theme-horor {
            background-image:
                linear-gradient(
                    rgba(255, 255, 255, .18),
                    rgba(255, 255, 255, .18)
                ),
                url("{{ asset('images/HOROR.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* =====================================================
           BACKGROUND CINTA
        ===================================================== */

        body.theme-cinta {
            background-image:
                linear-gradient(
                    rgba(255, 255, 255, .12),
                    rgba(255, 255, 255, .12)
                ),
                url("{{ asset('images/CINTA.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* =====================================================
           BACKGROUND CAMPURAN
        ===================================================== */

        body.theme-campuran {
            background-image:
                linear-gradient(
                    rgba(255, 255, 255, .12),
                    rgba(255, 255, 255, .12)
                ),
                url("{{ asset('images/CAMPURAN.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* =====================================================
           BACKGROUND SEDIH
        ===================================================== */

        body.theme-sedih {
            background-image:
                linear-gradient(
                    rgba(255, 255, 255, .12),
                    rgba(255, 255, 255, .12)
                ),
                url("{{ asset('images/SEDIH.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* =====================================================
           HEADER
        ===================================================== */

        .top-header {
            width: 100%;
            min-height: 82px;

            display: flex;
            align-items: center;

            position: relative;

            padding: 0 42px;

            background: rgba(255, 255, 255, .92);

            border-bottom: 1px solid #e1e3e2;
            box-shadow: 0 4px 12px rgba(40, 48, 48, .10);

            margin: 0;
            border-radius: 0;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 15px;

            color: #5c554f;
            text-decoration: none;

            font-size: 15px;
            font-weight: 600;

            border-radius: 10px;

            transition: .2s ease;
        }

        .back-button:hover {
            background: #f1f3f2;
            color: var(--dark);
        }

        .page-title {
            position: absolute;

            left: 50%;
            transform: translateX(-50%);

            margin: 0;

            color: var(--dark);

            font-family: Georgia, "Times New Roman", serif;

            font-size: 28px;
            font-weight: 700;

            white-space: nowrap;
        }

        /* =====================================================
           PAGE
        ===================================================== */

        .page {
            width: min(1500px, calc(100% - 48px));

            margin: 28px auto 60px;
        }

        /* =====================================================
           DESCRIPTION
        ===================================================== */

        .intro {
            padding: 20px 28px;
            margin-bottom: 20px;

            background: rgba(255, 255, 255, .82);

            border: 1px solid rgba(215, 220, 219, .9);
            border-radius: 16px;

            box-shadow: var(--shadow-small);

            text-align: center;
        }

        .intro p {
            margin: 0;

            color: #756d66;

            font-size: 16px;
            line-height: 1.6;
        }

        /* =====================================================
           MAIN GRID
        ===================================================== */

        .content-grid {
            display: grid;

            grid-template-columns: 390px minmax(0, 1fr);

            gap: 24px;

            align-items: start;
        }

        /* =====================================================
           LEFT PANEL
        ===================================================== */

        .composer-panel {
            position: sticky;
            top: 20px;

            min-height: 650px;

            padding: 25px;

            border-radius: 24px;

            background:
                linear-gradient(
                    180deg,
                    rgba(220, 233, 223, .90) 0%,
                    rgba(232, 238, 230, .90) 40%,
                    rgba(255, 245, 217, .90) 100%
                );

            border: 1px solid #d0d9d2;

            box-shadow: var(--shadow);
        }

        /* HOROR */

        body.theme-horor .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(119, 160, 153, .88) 0%,
                    rgba(179, 213, 194, .82) 48%,
                    rgba(255, 245, 217, .92) 100%
                );

            border-color: rgba(95, 137, 130, .55);
        }

        /* CINTA */

        body.theme-cinta .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(239, 208, 193, .88) 0%,
                    rgba(246, 220, 209, .82) 48%,
                    rgba(255, 245, 217, .92) 100%
                );

            border-color: rgba(220, 190, 175, .65);
        }

        /* CAMPURAN */

        body.theme-campuran .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(220, 226, 247, .90) 0%,
                    rgba(231, 235, 250, .86) 48%,
                    rgba(255, 245, 217, .92) 100%
                );

            border-color: rgba(150, 160, 205, .65);
        }

        /* SEDIH */

        body.theme-sedih .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(213, 225, 239, .90) 0%,
                    rgba(230, 236, 245, .86) 48%,
                    rgba(255, 245, 217, .92) 100%
                );

            border-color: rgba(150, 165, 185, .65);
        }

        /* =====================================================
           INFO
        ===================================================== */

        .info-box {
            padding: 21px;
            margin-bottom: 20px;

            background: rgba(255, 255, 255, .76);

            border-radius: 18px;
        }

        .info-box h3 {
            margin: 0 0 13px;

            color: var(--dark);

            font-family: Georgia, "Times New Roman", serif;

            font-size: 16px;
            font-weight: 700;
        }

        .info-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .info-box li {
            margin-bottom: 8px;

            color: #5d5a55;

            font-size: 13px;
            line-height: 1.5;
        }

        /* =====================================================
           COMPOSER
        ===================================================== */

        .composer-card {
            padding: 23px;

            background: rgba(255, 255, 255, .82);

            border-radius: 18px;
        }

        .composer-title {
            margin: 0 0 22px;

            color: var(--dark);

            font-family: Georgia, "Times New Roman", serif;

            font-size: 23px;
            font-weight: 500;

            line-height: 1.15;
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;

            margin-bottom: 8px;

            color: #756d66;

            font-size: 13px;
            font-weight: 700;
        }

        .field select,
        .field textarea {
            width: 100%;

            border: 1px solid #d2d5d1;

            border-radius: 13px;

            background: rgba(255, 255, 255, .9);

            color: var(--text);

            padding: 14px 15px;

            font-family: inherit;
            font-size: 14px;

            transition: .2s ease;
        }

        .field select {
            height: 52px;
            cursor: pointer;
        }

        .field textarea {
            min-height: 180px;

            resize: vertical;

            line-height: 1.6;
        }

        .field select:focus,
        .field textarea:focus {
            outline: none;

            background: #fff;

            border-color: var(--green);

            box-shadow:
                0 0 0 3px rgba(113, 141, 120, .13);
        }

        /* =====================================================
           SUBMIT
        ===================================================== */

        .submit-btn {
            width: 100%;
            min-height: 48px;

            padding: 0 20px;

            border: none;
            border-radius: 12px;

            background: var(--dark);
            color: #fff;

            font-family: inherit;
            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s ease;
        }

        .submit-btn:hover {
            background: #4a3b32;

            transform: translateY(-1px);
        }

        /* =====================================================
           ALERT
        ===================================================== */

        .form-alert {
            margin-top: 17px;

            padding: 13px 15px;

            border-radius: 12px;

            font-size: 13px;
            line-height: 1.5;
        }

        .form-alert.error {
            background: #fde4e4;
            color: #a62f2f;
        }

        .form-alert.success {
            background: #def1e3;
            color: #2c7446;
        }

        /* =====================================================
           BOARD
        ===================================================== */

        .board {
            min-width: 0;
        }

        .board-header {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 20px;

            min-height: 72px;

            padding: 14px 18px;
            margin-bottom: 18px;

            background: rgba(255, 255, 255, .92);

            border-radius: 15px;

            box-shadow: var(--shadow-small);
        }

        .board-info {
            min-width: 230px;
        }

        .board-title {
            color: var(--dark);

            font-family: Georgia, "Times New Roman", serif;

            font-size: 18px;
            font-weight: 700;
        }

        .board-subtitle {
            margin-left: 7px;

            color: #917d70;

            font-size: 13px;
        }

        /* =====================================================
           CATEGORY
        ===================================================== */

        .category-bar {
            display: flex;

            align-items: center;
            justify-content: flex-end;

            gap: 9px;

            flex-wrap: wrap;
        }

        .category-toggle {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 36px;

            padding: 0 17px;

            border: 1px solid #ddd4c1;
            border-radius: 11px;

            background: #f5e8cb;
            color: #64594b;

            text-decoration: none;

            font-size: 12px;
            font-weight: 700;

            transition: .2s ease;
        }

        .category-toggle:hover {
            background: #eadbb9;

            transform: translateY(-1px);
        }

        .category-toggle.active {
            background: #e4cc94;

            border-color: #d4bb7e;

            color: #463a2e;
        }

        /* =====================================================
           FEED
        ===================================================== */

        .feed {
            display: grid;

            gap: 18px;
        }

        /* =====================================================
           CARD
        ===================================================== */

        .card {
            padding: 23px 25px 20px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 244, 215, .90) 0%,
                    rgba(255, 249, 234, .90) 100%
                );

            border: 1px solid #ded4ba;
            border-radius: 18px;

            box-shadow: var(--shadow);

            transition: .2s ease;
        }

        .card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 9px 23px rgba(45, 53, 53, .17);
        }

        /* HOROR */

        body.theme-horor .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(224, 239, 225, .86) 0%,
                    rgba(245, 242, 214, .86) 100%
                );

            border-color: rgba(115, 145, 132, .55);
        }

        /* CINTA */

        body.theme-cinta .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(255, 231, 224, .88) 0%,
                    rgba(255, 246, 238, .88) 100%
                );

            border-color: rgba(220, 190, 178, .55);
        }

        /* CAMPURAN */

        body.theme-campuran .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(229, 234, 255, .88) 0%,
                    rgba(247, 247, 255, .90) 100%
                );

            border-color: rgba(170, 178, 220, .60);
        }

        /* SEDIH */

        body.theme-sedih .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(226, 235, 246, .88) 0%,
                    rgba(247, 249, 252, .90) 100%
                );

            border-color: rgba(170, 185, 205, .60);
        }

        /* =====================================================
           CARD HEADER
        ===================================================== */

        .card-head {
            display: flex;

            align-items: flex-start;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 17px;
        }

        .author-block {
            display: flex;

            align-items: center;

            gap: 13px;

            min-width: 0;
        }

        .avatar {
            width: 48px;
            height: 48px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #6179c7;
            color: #1c2c60;

            font-size: 17px;
            font-weight: 800;

            border: 2px solid rgba(255,255,255,.75);
        }

        .author {
            color: #302a26;

            font-size: 14px;
            font-weight: 800;
        }

        .meta {
            display: flex;

            align-items: center;

            gap: 7px;

            margin-top: 4px;

            color: #92867c;

            font-size: 11px;
        }

        /* =====================================================
           CHIP
        ===================================================== */

        .chip {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 31px;

            padding: 0 14px;

            border-radius: 999px;

            background: var(--green-soft);
            color: var(--green-dark);

            font-size: 11px;
            font-weight: 800;

            white-space: nowrap;
        }

        .card[data-tone="cinta"] .chip {
            background: var(--pink-soft);
            color: var(--pink-dark);
        }

        .card[data-tone="horor"] .chip {
            background: #dcf1df;
            color: #347245;
        }

        .card[data-tone="sedih"] .chip {
            background: #dfe8f4;
            color: #526b86;
        }

        .card[data-tone="campuran"] .chip {
            background: #dfe8ff;
            color: #4159a6;
        }

        /* =====================================================
           MESSAGE
        ===================================================== */

        .message {
            margin: 5px 4px 21px;

            color: #3e3934;

            font-size: 15px;
            line-height: 1.75;

            white-space: pre-wrap;
            word-break: break-word;
        }

        /* =====================================================
           REPLY
        ===================================================== */

        .reply-box {
            padding-top: 16px;

            border-top: 1px dashed #d5cbb5;
        }

        .reply-count {
            display: inline-flex;

            align-items: center;

            min-height: 30px;

            padding: 0 12px;

            margin-bottom: 12px;

            border-radius: 999px;

            background: var(--blue-soft);
            color: #536b86;

            font-size: 11px;
            font-weight: 800;
        }

        .comment-list {
            display: grid;

            gap: 9px;

            margin-bottom: 12px;
        }

        .comment {
            display: flex;

            gap: 10px;

            padding: 12px 13px;

            background: rgba(255, 255, 255, .57);

            border: 1px solid rgba(215, 205, 178, .65);

            border-radius: 12px;
        }

        .comment .avatar {
            width: 32px;
            height: 32px;

            font-size: 11px;

            color: #25325f;
            background: #7186ca;
        }

        .comment strong {
            display: block;

            color: #403a35;

            font-size: 12px;
        }

        .comment .comment-text {
            margin-top: 4px;

            color: #756d66;

            font-size: 12px;
            line-height: 1.5;
        }

        /* =====================================================
           REPLY FORM
        ===================================================== */

        .reply-form {
            display: flex;

            align-items: stretch;

            gap: 9px;
        }

        .reply-form textarea {
            flex: 1;

            min-width: 0;
            min-height: 48px;

            padding: 12px 13px;

            border: 1px solid #d5cdbd;
            border-radius: 11px;

            background: rgba(255, 255, 255, .72);

            color: var(--text);

            font-family: inherit;
            font-size: 12px;

            resize: vertical;
        }

        .reply-form textarea:focus {
            outline: none;

            border-color: var(--blue);

            background: #fff;
        }

        .reply-form button {
            flex-shrink: 0;

            min-width: 76px;

            border: 0;
            border-radius: 10px;

            padding: 0 16px;

            background: var(--purple);
            color: white;

            font-family: inherit;
            font-size: 11px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s ease;
        }

        .reply-form button:hover {
            background: #5f59b3;
        }

        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {
            min-height: 180px;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 30px;

            border: 2px dashed #d6d5cf;
            border-radius: 18px;

            background: rgba(255,255,255,.62);

            color: #8c837b;

            text-align: center;

            font-size: 14px;
        }

        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 1050px) {

            .page {
                width: min(100% - 30px, 1500px);
            }

            .content-grid {
                grid-template-columns: 330px minmax(0, 1fr);
            }

            .composer-panel {
                padding: 20px;
            }

            .board-header {
                align-items: flex-start;

                flex-direction: column;
            }

            .category-bar {
                justify-content: flex-start;
            }
        }

        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 760px) {

            .top-header {
                min-height: 64px;

                padding: 0 15px;
            }

            .page-title {
                font-size: 20px;
            }

            .back-button {
                padding: 8px 5px;

                font-size: 12px;
            }

            .page {
                width: calc(100% - 18px);

                margin: 14px auto 30px;
            }

            .intro {
                padding: 15px;

                margin-bottom: 14px;
            }

            .intro p {
                font-size: 12px;
            }

            .content-grid {
                grid-template-columns: 1fr;

                gap: 15px;
            }

            .composer-panel {
                position: static;

                min-height: auto;

                padding: 16px;
            }

            .info-box {
                padding: 16px;

                margin-bottom: 14px;
            }

            .info-box li {
                font-size: 11px;
            }

            .composer-card {
                padding: 17px;
            }

            .composer-title {
                font-size: 20px;
            }

            .board-header {
                padding: 14px;
            }

            .board-title {
                font-size: 16px;
            }

            .board-subtitle {
                display: block;

                margin: 4px 0 0;

                font-size: 11px;
            }

            .category-toggle {
                min-height: 33px;

                padding: 0 12px;

                font-size: 10px;
            }

            .card {
                padding: 17px;
            }

            .card-head {
                flex-direction: column;

                gap: 10px;
            }

            .chip {
                align-self: flex-start;
            }

            .message {
                font-size: 13px;
            }
        }

        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 430px) {

            .top-header {
                min-height: 58px;
            }

            .page-title {
                font-size: 16px;
            }

            .back-button {
                font-size: 11px;
            }

            .reply-form {
                flex-direction: column;
            }

            .reply-form button {
                width: 100%;

                min-height: 42px;
            }

            .category-bar {
                width: 100%;
            }

            .category-toggle {
                flex: 1;
            }
        }

    </style>
</head>


{{-- ==========================================================
     TENTUKAN TEMA
     ========================================================== --}}

@php

    $currentCategory = strtolower(
        trim($selectedCategory ?? '')
    );

    $theme = '';

    if ($currentCategory === 'horor') {

        $theme = 'theme-horor';

    } elseif ($currentCategory === 'cinta') {

        $theme = 'theme-cinta';

    } elseif ($currentCategory === 'campuran') {

        $theme = 'theme-campuran';

    } elseif ($currentCategory === 'sedih') {

        $theme = 'theme-sedih';

    }

@endphp


<body class="{{ $theme }}">

    {{-- =====================================================
         HEADER
    ===================================================== --}}

    <header class="top-header">

        <a
            class="back-button"
            href="{{ route('whisperly.home') }}"
        >
            ← Kembali
        </a>

        <h1 class="page-title">
            Ruang Pengaduan
        </h1>

    </header>


    <div class="page">

        {{-- =====================================================
             DESCRIPTION
        ===================================================== --}}

        <div class="intro">

            <p>
                Sampaikan cerita, harapan, atau keluhanmu dengan aman dan anonim.
            </p>

        </div>


        {{-- =====================================================
             MAIN CONTENT
        ===================================================== --}}

        <div class="content-grid">


            {{-- =================================================
                 LEFT PANEL
            ================================================= --}}

            <aside class="composer-panel">


                {{-- INFO --}}

                <div class="info-box">

                    <h3>
                        Sebelum mengadu, ketahui ini:
                    </h3>

                    <ul>

                        <li>
                            Cerita akan dibroadcast ke publik setelah diverifikasi.
                        </li>

                        <li>
                            Identitas kamu tetap anonim sepenuhnya.
                        </li>

                        <li>
                            Admin memverifikasi kebenaran cerita terlebih dahulu.
                        </li>

                        <li>
                            Dengan mengirim, kamu menyetujui ketentuan ini.
                        </li>

                    </ul>

                </div>


                {{-- COMPOSER --}}

                <div class="composer-card">

                    <h2 class="composer-title">
                        Ceritakan kejadian yang kamu alami secara jujur dan rinci...
                    </h2>


                    <form
                        method="POST"
                        action="{{ route('pengaduan.store') }}"
                    >

                        @csrf


                        {{-- KATEGORI --}}

                        <div class="field">

                            <label for="id_kategori">
                                Pilih kategori
                            </label>

                            <select
                                id="id_kategori"
                                name="id_kategori"
                                required
                            >

                                <option value="">
                                    -- Pilih kategori --
                                </option>


                                @foreach ($categories->unique('jenis_kategori') as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('id_kategori') == $category->id ? 'selected' : '' }}
                                    >

                                        {{ ucfirst(trim($category->jenis_kategori)) }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- ISI MENFESS --}}

                        <div class="field">

                            <label for="isi_pesan">
                                Tulis menfess
                            </label>

                            <textarea
                                id="isi_pesan"
                                name="isi_pesan"
                                placeholder="Ceritakan pengalamanmu..."
                                required
                            >{{ old('isi_pesan') }}</textarea>

                        </div>


                        <button
                            type="submit"
                            class="submit-btn"
                        >
                            Kirim Menfess
                        </button>

                    </form>


                    {{-- ERROR --}}

                    @if ($errors->any())

                        <div class="form-alert error">

                            @foreach ($errors->all() as $error)

                                <div>
                                    {{ $error }}
                                </div>

                            @endforeach

                        </div>

                    @endif


                    {{-- SUCCESS --}}

                    @if (session('message_success'))

                        <div class="form-alert success">

                            {{ session('message_success') }}

                        </div>

                    @endif

                </div>

            </aside>


            {{-- =================================================
                 RIGHT : BOARD PUBLIK
            ================================================= --}}

            <main class="board">


                {{-- BOARD HEADER --}}

                <div class="board-header">

                    <div class="board-info">

                        <span class="board-title">
                            Broadcast Publik
                        </span>

                        <span class="board-subtitle">
                            Semua di sini sudah diverifikasi admin.
                        </span>

                    </div>


                    {{-- FILTER KATEGORI --}}

                    <div class="category-bar">


                        {{-- SEMUA --}}

                        <a
                            class="category-toggle
                            {{ empty($selectedCategory) ? 'active' : '' }}"
                            href="{{ route('pengaduan') }}"
                        >
                            Semua
                        </a>


                        {{-- KATEGORI --}}

                        @foreach (
                            $categories->unique(function ($category) {

                                return strtolower(
                                    trim($category->jenis_kategori)
                                );

                            }) as $category
                        )

                            @php

                                $categoryName = strtolower(
                                    trim($category->jenis_kategori)
                                );

                            @endphp


                            <a
                                class="category-toggle
                                {{
                                    strtolower(
                                        trim($selectedCategory ?? '')
                                    ) === $categoryName
                                    ? 'active'
                                    : ''
                                }}"
                                href="{{ route('pengaduan', [
                                    'kategori' => $category->jenis_kategori
                                ]) }}"
                            >

                                {{ ucfirst($categoryName) }}

                            </a>

                        @endforeach

                    </div>

                </div>


                {{-- =================================================
                     LIST MENFESS
                ================================================= --}}

                <section class="feed">


                    @forelse ($items as $item)


                        @php

                            $tone = strtolower(
                                trim(
                                    $item->kategori?->jenis_kategori
                                    ?? 'campuran'
                                )
                            );

                            $initial = strtoupper(
                                mb_substr(
                                    $item->anonymous_display_name ?? '?',
                                    0,
                                    1
                                )
                            );

                        @endphp


                        <article
                            class="card"
                            data-tone="{{ $tone }}"
                        >


                            {{-- CARD HEADER --}}

                            <div class="card-head">


                                <div class="author-block">


                                    <div class="avatar">
                                        {{ $initial }}
                                    </div>


                                    <div>

                                        <div class="author">
                                            {{ $item->anonymous_display_name }}
                                        </div>


                                        <div class="meta">

                                            <span>
                                                {{ $item->created_at?->translatedFormat('d M, H:i') ?? $item->created_at }}
                                            </span>

                                            <span>
                                                •
                                            </span>

                                            <span>
                                                Anonim
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                {{-- BADGE KATEGORI --}}

                                <span class="chip">

                                    {{ ucfirst(
                                        trim(
                                            $item->kategori?->jenis_kategori
                                            ?? 'Campuran'
                                        )
                                    ) }}

                                </span>

                            </div>


                            {{-- ISI MENFESS --}}

                            <div class="message">

                                {{ $item->isi_pesan }}

                            </div>


                            {{-- BALASAN --}}

                            <div class="reply-box">


                                <div class="reply-count">

                                    {{ $item->comments->count() }}

                                    Balasan

                                </div>


                                {{-- KOMENTAR --}}

                                <div class="comment-list">


                                    @foreach ($item->comments as $comment)


                                        @php

                                            $commentName =
                                                $comment->pengguna?->username
                                                ?? 'Pengguna';

                                            $commentInitial =
                                                strtoupper(
                                                    mb_substr(
                                                        $commentName,
                                                        0,
                                                        1
                                                    )
                                                );

                                        @endphp


                                        <div class="comment">


                                            <div class="avatar">

                                                {{ $commentInitial }}

                                            </div>


                                            <div>

                                                <strong>

                                                    {{ $commentName }}

                                                </strong>


                                                <div class="comment-text">

                                                    {{ $comment->komentar }}

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>


                                {{-- FORM BALAS --}}

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'pengaduan.comments.store',
                                        $item->id
                                    ) }}"
                                    class="reply-form"
                                >

                                    @csrf


                                    <textarea
                                        name="komentar"
                                        placeholder="Tulis balasan..."
                                        required
                                    ></textarea>


                                    <button type="submit">
                                        Balas
                                    </button>

                                </form>

                            </div>

                        </article>


                    @empty


                        <div class="empty">

                            Belum ada menfess yang diterima
                            untuk kategori ini.

                        </div>


                    @endforelse

                </section>

            </main>

        </div>

    </div>


</body>

</html>