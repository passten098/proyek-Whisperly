<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moderasi Menfess | Whisperly</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --dark: #30251f;
            --text: #45403b;
            --muted: #817970;

            --green-soft: #dce9df;
            --green: #718d78;
            --green-dark: #526b58;

            --blue: #6078c7;
            --blue-soft: #dce7f3;

            --purple: #756dcc;

            --approve: #65d477;
            --approve-dark: #348e47;

            --reject: #e85c5c;
            --reject-dark: #b93636;

            --shadow: 0 5px 16px rgba(45, 53, 53, .12);
            --shadow-small: 0 3px 9px rgba(45, 53, 53, .08);
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family:
                "Cambria",
                Georgia,
                "Times New Roman",
                serif;

            color: var(--text);

            background:
                linear-gradient(
                    rgba(255,255,255,.12),
                    rgba(255,255,255,.12)
                ),
                url("{{ asset('assets/images/CAMPURAN.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* =========================================
           HEADER
        ========================================= */

        .top-header {
            width: 100%;
            min-height: 82px;

            display: flex;
            align-items: center;

            position: relative;

            padding: 0 42px;

            background:
                linear-gradient(
                    90deg,
                    rgba(122,165,169,.95),
                    rgba(153,190,184,.94) 45%,
                    rgba(196,211,190,.93)
                );

            border-bottom:
                1px solid rgba(91,139,145,.44);

            box-shadow:
                0 4px 12px
                rgba(40,48,48,.10);
        }

        .back-button {
            display: inline-flex;
            align-items: center;

            gap: 8px;

            padding: 10px 15px;

            color: #3f6c71;

            text-decoration: none;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 18px;
            font-weight: 600;

            border-radius: 10px;

            transition: .2s ease;
        }

        .back-button:hover {
            transform: translateY(-1px);
        }

        .page-title {
            position: absolute;

            left: 50%;

            transform: translateX(-50%);

            margin: 0;

            color: #345d62;

            font-size: 29px;
            font-weight: 700;

            white-space: nowrap;
        }

        /* =========================================
           PAGE
        ========================================= */

        .page {
            width: min(1500px, calc(100% - 48px));

            margin: 28px auto 60px;
        }

        /* =========================================
           INTRO
        ========================================= */

        .intro {
            padding: 19px 28px;

            margin-bottom: 20px;

            background:
                linear-gradient(
                    90deg,
                    rgba(220,235,230,.88),
                    rgba(233,241,228,.88),
                    rgba(245,238,210,.84)
                );

            border:
                1px solid rgba(123,170,170,.50);

            border-radius: 16px;

            box-shadow: var(--shadow-small);

            text-align: center;
        }

        .intro p {
            margin: 0;

            color: #496b68;

            font-size: 16px;
            line-height: 1.5;
        }

        /* =========================================
           CONTENT GRID
        ========================================= */

        .content-grid {
            display: grid;

            grid-template-columns:
                390px
                minmax(0, 1fr);

            gap: 24px;

            align-items: start;
        }

        /* =========================================
           ADMIN PANEL KIRI
        ========================================= */

        .admin-panel {
            position: sticky;

            top: 20px;

            min-height: 650px;

            padding: 25px;

            border-radius: 24px;

            background:
                linear-gradient(
                    180deg,
                    rgba(144,188,183,.90),
                    rgba(181,210,194,.88) 48%,
                    rgba(235,225,185,.90)
                );

            border:
                1px solid rgba(88,151,160,.62);

            box-shadow: var(--shadow);
        }

        .info-box {
            padding: 20px;

            margin-bottom: 18px;

            background: rgba(255,255,255,.82);

            border-radius: 18px;

            border:
                1px solid
                rgba(255,255,255,.45);
        }

        .info-box h3 {
            margin: 0 0 12px;

            color: var(--dark);

            font-size: 15px;
            font-weight: 700;
        }

        .info-box ul {
            margin: 0;

            padding-left: 20px;
        }

        .info-box li {
            margin-bottom: 7px;

            color: #5d5a55;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 13px;

            line-height: 1.5;
        }

        /* =========================================
           ADMIN TOOLS
        ========================================= */

        .admin-tools {
            padding: 20px;

            background:
                rgba(255,255,255,.78);

            border-radius: 18px;

            border:
                1px solid
                rgba(255,255,255,.45);
        }

        .admin-title {
            margin: 0 0 15px;

            color: var(--dark);

            font-size: 20px;

            font-weight: 700;
        }

        .pending-count {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 32px;
            height: 27px;

            margin-left: 5px;

            padding: 0 9px;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #e8c84c,
                    #dcae35
                );

            color: #5c4814;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 11px;

            font-weight: 800;
        }

        .pending-list {
            display: grid;

            gap: 12px;
        }

        .pending-item {
            padding: 13px;

            background:
                rgba(255,255,255,.70);

            border:
                1px solid
                rgba(210,215,210,.70);

            border-radius: 13px;
        }

        .pending-meta {
            margin-bottom: 6px;

            color: #817970;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;
        }

        .pending-message {
            color: #413b36;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 12px;

            line-height: 1.5;
        }

        /* =========================================
           BOARD
        ========================================= */

        .board {
            min-width: 0;
        }

        .board-header {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 20px;

            min-height: 70px;

            padding: 13px 18px;

            margin-bottom: 16px;

            background:
                rgba(248,250,240,.88);

            border:
                1px solid
                rgba(128,175,173,.48);

            border-radius: 15px;

            box-shadow: var(--shadow-small);
        }

        .board-info {
            min-width: 230px;
        }

        .board-title {
            color: var(--dark);

            font-size: 22px;

            font-weight: 700;
        }

        .board-subtitle {
            margin-left: 7px;

            color: #917d70;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 15px;
        }

        .pending-badge {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 40px;

            padding: 0 17px;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #e7c950,
                    #d9ae35
                );

            color: #5b4817;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 12px;

            font-weight: 800;
        }

        /* =========================================
           FEED
        ========================================= */

        .feed {
            display: grid;

            gap: 15px;
        }

        /* =========================================
           MENFESS CARD
        ========================================= */

        .card {
            padding: 14px 16px 16px;

            background:
                linear-gradient(
                    135deg,
                    rgba(198,224,220,.88),
                    rgba(226,238,222,.89) 52%,
                    rgba(247,239,207,.84)
                );

            border:
                1px solid
                rgba(116,170,172,.52);

            border-radius: 16px;

            box-shadow:
                0 4px 14px
                rgba(45,53,53,.11);

            transition: .2s ease;
        }

        .card:hover {
            transform: translateY(-1px);
        }

        /* =========================================
           CARD HEADER
        ========================================= */

        .card-head {
            display: flex;

            align-items: flex-start;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 9px;
        }

        .author-block {
            display: flex;

            align-items: center;

            gap: 10px;
        }

        .avatar {
            width: 42px;
            height: 42px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #83aaa7,
                    #5d858e
                );

            color: #264f56;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 15px;

            font-weight: 800;

            border:
                2px solid
                rgba(255,255,255,.75);
        }

        .author {
            color: #302a26;

            font-size: 16px;

            font-weight: 700;
        }

        .meta {
            display: flex;

            align-items: center;

            gap: 6px;

            margin-top: 2px;

            color: #92867c;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;
        }

        .chip {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 31px;

            padding: 0 14px;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #d4ebe0,
                    #b8d8d2
                );

            color: #3e7770;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 13px;

            font-weight: 700;

            white-space: nowrap;
        }

        /* =========================================
           PESAN
        ========================================= */

        .message {
            width: 100%;

            margin: 8px 0 14px;

            color: #3f3934;

            font-size: 20px;

            font-weight: 500;

            line-height: 1.6;

            white-space: pre-wrap;

            word-break: break-word;

            text-align: left;
        }

        /* =========================================
           STATUS PENDING
        ========================================= */

        .pending-status {
            display: inline-flex;

            align-items: center;

            padding: 6px 11px;

            margin-bottom: 10px;

            border-radius: 999px;

            background:
                rgba(231,201,80,.28);

            color: #80661c;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;

            font-weight: 800;
        }

        /* =========================================
           ADMIN ACTION
        ========================================= */

        .admin-actions {
            display: flex;

            align-items: center;

            gap: 10px;

            padding-top: 11px;

            border-top:
                1px dashed
                #d5cbb5;
        }

        .admin-actions form {
            margin: 0;
        }

        .admin-btn {
            min-height: 38px;

            padding: 0 19px;

            border: none;

            border-radius: 999px;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 12px;

            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }

        .admin-btn:hover {
            transform: translateY(-1px);

            filter: brightness(.96);
        }

        .approve-btn {
            background:
                linear-gradient(
                    135deg,
                    #70dc82,
                    #55c96b
                );

            color: #24552d;

            box-shadow:
                0 3px 8px
                rgba(67,172,85,.20);
        }

        .reject-btn {
            background:
                linear-gradient(
                    135deg,
                    #ef6b6b,
                    #dc4f4f
                );

            color: white;

            box-shadow:
                0 3px 8px
                rgba(210,70,70,.20);
        }

        .btn-delete {
            min-height: 38px;

            padding: 0 16px;

            border: none;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #ef6b6b,
                    #dc4f4f
                );

            color: white;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 12px;

            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }

        .btn-delete:hover {
            transform: translateY(-1px);

            filter: brightness(.96);
        }

        .published-status {
            display: inline-flex;

            align-items: center;

            padding: 6px 11px;

            margin-bottom: 10px;

            border-radius: 999px;

            background:
                rgba(101, 212, 119, 0.18);

            color: #287245;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;

            font-weight: 800;
        }

        /* =========================================
           EMPTY
        ========================================= */

        .empty {
            min-height: 160px;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 30px;

            border:
                2px dashed
                #d6d5cf;

            border-radius: 18px;

            background:
                rgba(255,255,255,.62);

            color: #8c837b;

            text-align: center;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;
        }

        /* =========================================
           HOROR
        ========================================= */

        body.theme-horor {
            background:
                linear-gradient(
                    rgba(20,10,8,.08),
                    rgba(20,10,8,.08)
                ),
                url("{{ asset('assets/images/HOROR.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body.theme-horor .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(43,29,25,.96),
                    rgba(78,40,31,.95) 42%,
                    rgba(132,55,39,.94) 72%,
                    rgba(181,112,65,.92)
                );
        }

        body.theme-horor .page-title {
            color: #f1d9ad;
        }

        body.theme-horor .back-button {
            color: #efd5aa;
        }

        body.theme-horor .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(58,40,33,.90),
                    rgba(80,49,37,.88),
                    rgba(110,69,45,.84)
                );
        }

        body.theme-horor .intro p {
            color: #ead5b5;
        }

        body.theme-horor .admin-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(49,32,28,.92),
                    rgba(79,42,34,.89) 46%,
                    rgba(123,71,47,.84)
                );
        }

        body.theme-horor .info-box,
        body.theme-horor .admin-tools {
            background:
                rgba(247,229,197,.84);
        }

        body.theme-horor .board-header {
            background:
                rgba(247,229,197,.84);
        }

        body.theme-horor .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(73,47,38,.90),
                    rgba(104,61,44,.88) 48%,
                    rgba(154,91,54,.82)
                );

            border-color:
                rgba(186,102,60,.56);
        }

        body.theme-horor .author,
        body.theme-horor .message {
            color: #fff0d2;
        }

        body.theme-horor .meta {
            color: #ead2b2;
        }

        body.theme-horor .chip {
            background:
                linear-gradient(
                    135deg,
                    #b64b35,
                    #7d3029
                );

            color: #ffe6c4;
        }

        body.theme-horor .avatar {
            background:
                linear-gradient(
                    135deg,
                    #d1844f,
                    #8f3b2f
                );

            color: #2e1814;
        }

        /* =========================================
           CINTA
        ========================================= */

        body.theme-cinta {
            background:
                linear-gradient(
                    rgba(255,255,255,.10),
                    rgba(255,255,255,.10)
                ),
                url("{{ asset('assets/images/CINTA.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body.theme-cinta .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(217,119,91,.94),
                    rgba(239,157,122,.94) 45%,
                    rgba(248,208,170,.94)
                );
        }

        body.theme-cinta .page-title {
            color: #7d463d;
        }

        body.theme-cinta .back-button {
            color: #8f5144;
        }

        body.theme-cinta .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(255,232,215,.88),
                    rgba(255,242,226,.88),
                    rgba(248,224,208,.86)
                );
        }

        body.theme-cinta .intro p {
            color: #89564a;
        }

        body.theme-cinta .admin-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(242,170,137,.86),
                    rgba(250,205,175,.84) 46%,
                    rgba(255,236,213,.90)
                );
        }

        body.theme-cinta .info-box,
        body.theme-cinta .admin-tools,
        body.theme-cinta .board-header {
            background:
                rgba(255,249,241,.84);
        }

        body.theme-cinta .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(255,222,201,.88),
                    rgba(255,239,222,.90) 55%,
                    rgba(250,225,210,.86)
                );

            border-color:
                rgba(226,163,140,.54);
        }

        body.theme-cinta .chip {
            background:
                linear-gradient(
                    135deg,
                    #ffd8c5,
                    #f5bfa8
                );

            color: #a64f4b;
        }

        body.theme-cinta .avatar {
            background:
                linear-gradient(
                    135deg,
                    #e7a083,
                    #c76e63
                );

            color: #633d38;
        }

        /* =========================================
           SEDIH
        ========================================= */

        body.theme-sedih {
            background:
                linear-gradient(
                    rgba(255,255,255,.12),
                    rgba(255,255,255,.12)
                ),
                url("{{ asset('assets/images/SEDIH.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body.theme-sedih .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(225,190,120,.94),
                    rgba(244,210,145,.94) 35%,
                    rgba(248,225,180,.94) 65%,
                    rgba(225,220,190,.94)
                );
        }

        body.theme-sedih .page-title {
            color: #6f6048;
        }

        body.theme-sedih .back-button {
            color: #75654b;
        }

        body.theme-sedih .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(250,238,205,.88),
                    rgba(242,235,210,.88),
                    rgba(225,230,215,.86)
                );
        }

        body.theme-sedih .intro p {
            color: #766a52;
        }

        body.theme-sedih .admin-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(238,215,160,.88),
                    rgba(245,230,190,.86) 45%,
                    rgba(222,232,218,.88)
                );
        }

        body.theme-sedih .info-box,
        body.theme-sedih .admin-tools {
            background:
                rgba(255,250,235,.84);
        }

        body.theme-sedih .board-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(247,235,205,.88),
                    rgba(235,235,215,.86),
                    rgba(220,230,220,.84)
                );
        }

        body.theme-sedih .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(248,238,210,.88),
                    rgba(240,235,215,.88) 50%,
                    rgba(220,230,220,.85)
                );
        }

        body.theme-sedih .chip {
            background:
                linear-gradient(
                    135deg,
                    #e5d19c,
                    #d4c89f
                );

            color: #6f6045;
        }

        body.theme-sedih .avatar {
            background:
                linear-gradient(
                    135deg,
                    #c9b47d,
                    #9aa89a
                );

            color: #4f5548;
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 1050px) {

            .content-grid {
                grid-template-columns:
                    330px
                    minmax(0,1fr);
            }

            .board-header {
                flex-direction: column;

                align-items: flex-start;
            }
        }

        @media (max-width: 760px) {

            .top-header {
                min-height: 64px;

                padding: 0 15px;
            }

            .page-title {
                font-size: 20px;
            }

            .page {
                width: calc(100% - 18px);

                margin: 14px auto 30px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .admin-panel {
                position: static;

                min-height: auto;

                padding: 16px;
            }

            .board-header {
                padding: 14px;
            }

            .card {
                padding: 13px;
            }

            .message {
                font-size: 18px;
            }
        }

        @media (max-width: 430px) {

            .page-title {
                font-size: 16px;
            }

            .card-head {
                flex-direction: column;
            }

            .chip {
                align-self: flex-start;
            }

            .admin-actions {
                flex-direction: column;

                align-items: stretch;
            }

            .admin-actions form,
            .admin-btn {
                width: 100%;
            }
        }
    </style>
</head>

@php
    $currentCategory = strtolower(
        trim($selectedCategory ?? 'campuran')
    );

    if ($currentCategory === 'horor') {
        $theme = 'theme-horor';
    } elseif ($currentCategory === 'cinta') {
        $theme = 'theme-cinta';
    } elseif ($currentCategory === 'sedih') {
        $theme = 'theme-sedih';
    } else {
        $theme = 'theme-campuran';
    }
@endphp

<body class="{{ $theme }}">

    <!-- HEADER -->
    <header class="top-header">

        <a
            href="{{ route('whisperly.home') }}"
            class="back-button"
        >
            ← Kembali
        </a>

        <h1 class="page-title">
            Ruang Pengaduan
        </h1>

    </header>


    <div class="page">

        <!-- INTRO -->
        <div class="intro">

            <p>
                Menfess yang dikirim pengguna harus diverifikasi
                admin sebelum ditampilkan ke publik.
            </p>

        </div>


        <div class="content-grid">

            <!-- =================================
                 ADMIN TOOLS / KIRI
            ================================== -->

            <aside class="admin-panel">

                <div class="info-box">

                    <h3>
                        Sebelum mengelola menfess, baca ini:
                    </h3>

                    <ul>

                        <li>
                            Menfess baru tidak langsung tampil ke publik.
                        </li>

                        <li>
                            Admin harus memeriksa setiap menfess terlebih dahulu.
                        </li>

                        <li>
                            Klik Setujui jika menfess layak ditampilkan.
                        </li>

                        <li>
                            Klik Tolak jika menfess tidak sesuai ketentuan.
                        </li>

                        <li>
                            Identitas pengirim tetap anonim.
                        </li>

                    </ul>

                </div>


                <div class="admin-tools">

                    <h2 class="admin-title">

                        ADMIN TOOLS

                        <span class="pending-count">
                            {{ $pendingItems->count() }}
                        </span>

                    </h2>


                    <div class="pending-list">

                        @forelse ($pendingItems as $item)

                            @php

                                $pendingName =
                                    $item->anonymous_display_name
                                    ?? 'Anonim';

                            @endphp

                            <div class="pending-item">

                                <div class="pending-meta">

                                    {{ $item->created_at?->translatedFormat('d M, H:i') ?? $item->created_at }}

                                    ·

                                    {{ $pendingName }}

                                </div>

                                <div class="pending-message">

                                    {{ $item->isi_pesan }}

                                </div>

                                <div class="admin-actions" style="margin-top: 12px;">

                                    <form
                                        method="POST"
                                        action="{{ route('menfess.approve', $item->id) }}"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="admin-btn approve-btn">
                                            ✓ Setujui
                                        </button>
                                    </form>

                                    <form
                                        method="POST"
                                        action="{{ route('menfess.reject', $item->id) }}"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="admin-btn reject-btn">
                                            ✕ Tolak
                                        </button>
                                    </form>

                                </div>

                            </div>

                        @empty

                            <div class="pending-item">

                                <div class="pending-message">

                                    Tidak ada menfess yang menunggu persetujuan.

                                </div>

                            </div>

                        @endforelse

                    </div>

                </div>

            </aside>


            <!-- =================================
                 BOARD / KANAN
            ================================== -->

            <main class="board">

                <div class="board-header">

                    <div class="board-info">

                        <span class="board-title">
                            Menfess Masuk
                        </span>

                        <span class="board-subtitle">
                            Periksa sebelum dipublikasikan.
                        </span>

                    </div>


                    <div class="pending-badge">

                        {{ $pendingItems->count() }}

                        Menunggu Persetujuan

                    </div>

                </div>


                <!-- LIST MENFESS -->

                <section class="feed">

                    @forelse ($approvedItems as $item)

                        @php

                            $tone = strtolower(
                                trim(
                                    $item->kategori?->jenis_kategori
                                    ?? 'campuran'
                                )
                            );

                            $displayName =
                                $item->anonymous_display_name
                                ?? 'Anonim';

                            $initial = strtoupper(
                                mb_substr(
                                    $displayName,
                                    0,
                                    1
                                )
                            );

                            $itemCategory = strtolower(
                                trim(
                                    $item->kategori?->jenis_kategori
                                    ?? ''
                                )
                            );

                        @endphp


                        <!-- CARD MENFESS -->

                        <article
                            class="card"
                            data-tone="{{ $tone }}"
                        >

                            <!-- HEADER -->

                            <div class="card-head">

                                <div class="author-block">

                                    <div class="avatar">
                                        {{ $initial }}
                                    </div>


                                    <div>

                                        <div class="author">

                                            {{ $displayName }}

                                        </div>


                                        <div class="meta">

                                            <span>

                                                {{
                                                    $item->created_at
                                                    ?->translatedFormat(
                                                        'd M, H:i'
                                                    )
                                                    ?? $item->created_at
                                                }}

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


                                <!-- KATEGORI -->

                                <span class="chip">

                                    @if ($itemCategory === 'horor')

                                        Horror

                                    @elseif ($itemCategory === 'cinta')

                                        Love

                                    @elseif ($itemCategory === 'sedih')

                                        Sedih

                                    @elseif ($itemCategory === 'campuran')

                                        Random

                                    @else

                                        {{
                                            ucfirst(
                                                $item->kategori
                                                ?->jenis_kategori
                                                ?? 'Random'
                                            )
                                        }}

                                    @endif

                                </span>

                            </div>


                            <!-- STATUS -->

                            <div class="published-status">

                                Sudah dipublikasikan

                            </div>


                            <!-- ISI MENFESS -->

                            <div class="message">

                                {{ $item->isi_pesan }}

                            </div>


                            <div class="admin-actions" style="justify-content: flex-end;">

                                <form
                                    action="{{ route('menfess.destroy', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus menfess ini?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-delete">
                                        🗑 Hapus Menfess
                                    </button>
                                </form>

                            </div>

                        </article>


                    @empty

                        <div class="empty">

                            Tidak ada menfess yang sudah
                            dipublikasikan.

                        </div>

                    @endforelse

                </section>

            </main>

        </div>

    </div>

</body>

</html>