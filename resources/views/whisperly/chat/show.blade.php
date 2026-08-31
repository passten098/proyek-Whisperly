<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $me = auth('whisperly')->user();
        $iAmUser = $me->role === 'user';

        // Nama & data lawan bicara untuk room yang sedang dibuka.
        $partnerName = $iAmUser
            ? ucfirst($booking->talent?->pengguna?->username ?? 'Talent')
            : ucfirst($booking->pengguna?->username ?? 'User');

        $partnerRoleLabel = $iAmUser ? 'Talent' : 'User';

        $partnerDesc = $iAmUser
            ? ($booking->talent?->deskripsi ?? 'Profil talent.')
            : 'User yang melakukan booking.';

        $partnerInitial = strtoupper(mb_substr($partnerName, 0, 1));

        $scheduleStart = substr(
            $booking->schedule?->start_time ?? '00:00',
            0,
            5
        );

        $scheduleEnd = substr(
            $booking->schedule?->end_time ?? '00:00',
            0,
            5
        );

        $statusDot = match ($status) {
            'active' => '#4f8ff7',
            'upcoming' => '#e0a94c',
            default => '#b3aab0',
        };

        $mobileView = request('view') === 'list'
            ? 'list'
            : 'chat';
    @endphp

    <title>Chat dengan {{ $partnerName }}</title>

    <style>

        :root {
            --pink-soft: #fdeef4;
            --pink-mid: #f6d9e4;
            --pink-line: #f1c9d8;

            --blue-bubble: #e8f1ff;
            --blue-ink: #1f4e79;
            --blue-strong: #4f8ff7;

            --white: #ffffff;
            --ink: #2b2b3d;
            --muted: #8b8a9c;

            --line: #ece3e8;

            --radius-lg: 22px;
            --radius-md: 16px;
            --radius-sm: 12px;

            --shadow: 0 18px 44px rgba(94, 45, 76, 0.10);
        }


        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            min-height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    var(--pink-soft),
                    #fbfbff 55%
                );

            color: var(--ink);

            font-family: Arial, sans-serif;
        }


        a {
            text-decoration: none;
            color: inherit;
        }


        /* =========================================================
           NAVIGASI CHAT
        ========================================================= */

        .chat-navigation {
            width: min(1300px, calc(100% - 32px));

            margin: 95px auto 0;

            display: flex;
            align-items: center;
            gap: 10px;

            flex-wrap: wrap;
        }


        .nav-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 10px 16px;

            border-radius: 999px;

            background: #ffffff;
            color: #2b2b3d;

            font-size: 12px;
            font-weight: 700;

            box-shadow:
                0 8px 20px rgba(94, 45, 76, 0.08);

            transition: .2s ease;
        }


        .nav-button:hover {
            transform: translateY(-2px);

            background: #fdeef4;
        }


        .nav-button.nav-home {
            background: #e8f1ff;
            color: #1f4e79;
        }


        .nav-button.nav-home:hover {
            background: #dbeaff;
        }


        .nav-button.nav-pengaduan {
            background: #fff1d8;
            color: #765b1d;
        }


        .nav-button.nav-pengaduan:hover {
            background: #ffe8bc;
        }


        /* =========================================================
           APP SHELL
        ========================================================= */

        .app-shell {
            width: min(1300px, calc(100% - 32px));

            margin: 18px auto 40px;

            display: grid;

            grid-template-columns:
                280px
                1fr
                290px;

            gap: 18px;

            align-items: start;
        }


        .panel {
            background: var(--white);

            border-radius: var(--radius-lg);

            box-shadow: var(--shadow);

            overflow: hidden;
        }


        /* =========================================================
           LEFT - RIWAYAT CHAT
        ========================================================= */

        .chat-list {
            display: flex;

            flex-direction: column;

            max-height:
                calc(100vh - 150px);
        }


        .chat-list-head {
            padding: 20px 20px 14px;

            border-bottom:
                1px solid var(--line);
        }


        .chat-list-head h2 {
            margin: 0;

            font-size: 17px;

            font-weight: 800;
        }


        .chat-list-head span {
            font-size: 12.5px;

            color: var(--muted);
        }


        .chat-list-items {
            overflow-y: auto;

            padding: 8px;
        }


        .conversation {
            display: flex;

            gap: 12px;

            align-items: flex-start;

            padding: 12px;

            border-radius: var(--radius-sm);

            margin-bottom: 4px;

            border:
                1px solid transparent;
        }


        .conversation:hover {
            background: var(--pink-soft);
        }


        .conversation.active {
            background: var(--pink-mid);

            border-color:
                var(--pink-line);
        }


        .avatar {
            width: 44px;
            height: 44px;

            border-radius: 50%;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            font-weight: 800;

            font-size: 16px;

            color: #fff;

            background:
                linear-gradient(
                    135deg,
                    var(--blue-strong),
                    #8fb8fb
                );
        }


        .avatar.lg {
            width: 86px;
            height: 86px;

            font-size: 30px;

            margin:
                0 auto 14px;
        }


        .conversation-body {
            min-width: 0;

            flex: 1;
        }


        .conversation-top {
            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 8px;
        }


        .conversation-name {
            font-weight: 700;

            font-size: 14.5px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .conversation-time {
            font-size: 11px;

            color: var(--muted);

            flex-shrink: 0;
        }


        .conversation-preview-row {
            display: flex;

            align-items: center;

            gap: 6px;

            margin-top: 4px;
        }


        .status-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            flex-shrink: 0;
        }


        .conversation-preview {
            font-size: 12.5px;

            color: var(--muted);

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .empty-list {
            padding: 24px 18px;

            color: var(--muted);

            font-size: 13px;

            text-align: center;
        }


        /* =========================================================
           CENTER - CHAT
        ========================================================= */

        .chat {
            display: flex;

            flex-direction: column;

            height:
                calc(100vh - 150px);
        }


        .chat-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 12px;

            padding: 16px 22px;

            border-bottom:
                1px solid var(--line);
        }


        .chat-header-left {
            display: flex;

            align-items: center;

            gap: 12px;

            min-width: 0;
        }


        .back-link {
            display: none;

            width: 34px;
            height: 34px;

            border-radius: 50%;

            background: var(--pink-soft);

            align-items: center;

            justify-content: center;

            font-weight: 800;

            flex-shrink: 0;
        }


        .chat-header h3 {
            margin: 0;

            font-size: 17px;

            font-weight: 800;
        }


        .chat-header .subtitle {
            margin-top: 2px;

            font-size: 12.5px;

            color: var(--muted);
        }


        .status-pill {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 6px 12px;

            border-radius: 999px;

            background: var(--pink-soft);

            color: var(--ink);

            font-size: 12px;

            font-weight: 700;

            text-transform: capitalize;

            white-space: nowrap;
        }


        .info-toggle {
            display: none;

            border: none;

            background: var(--pink-soft);

            color: var(--ink);

            width: 34px;
            height: 34px;

            border-radius: 50%;

            font-weight: 800;

            cursor: pointer;

            font-size: 14px;
        }


        .notice-banner {
            margin: 14px 22px 0;

            padding: 10px 14px;

            border-radius: var(--radius-sm);

            background: var(--pink-soft);

            color: var(--ink);

            font-size: 13px;
        }


        .messages {
            flex: 1;

            overflow-y: auto;

            padding: 20px 22px;

            display: flex;

            flex-direction: column;

            gap: 10px;

            background: #fdfdff;
        }


        .message-row {
            display: flex;

            max-width: 100%;
        }


        .message-row.sent {
            justify-content: flex-end;
        }


        .message-row.received {
            justify-content: flex-start;
        }


        .bubble {
            max-width: 68%;

            padding: 11px 15px;

            border-radius: var(--radius-md);

            line-height: 1.5;

            font-size: 14px;

            word-wrap: break-word;

            box-shadow:
                0 6px 16px
                rgba(94, 45, 76, 0.08);
        }


        .message-row.sent .bubble {
            background: var(--blue-bubble);

            color: var(--blue-ink);

            border-bottom-right-radius: 4px;
        }


        .message-row.received .bubble {
            background: var(--white);

            color: var(--ink);

            border-bottom-left-radius: 4px;
        }


        .bubble .timestamp {
            display: block;

            margin-top: 5px;

            font-size: 10.5px;

            opacity: 0.6;
        }


        /* =========================================================
           COMPOSER
        ========================================================= */

        .composer {
            padding: 14px 18px;

            border-top:
                1px solid var(--line);
        }


        .composer form {
            display: flex;

            align-items: center;

            gap: 10px;
        }


        .icon-btn {
            width: 40px;
            height: 40px;

            border-radius: 50%;

            border:
                1px solid var(--line);

            background: var(--pink-soft);

            color: var(--muted);

            font-size: 18px;

            font-weight: 700;

            display: flex;

            align-items: center;
            justify-content: center;

            cursor: not-allowed;

            flex-shrink: 0;
        }


        .composer textarea {
            flex: 1;

            min-height: 44px;

            max-height: 120px;

            resize: vertical;

            border:
                1px solid var(--line);

            border-radius: 999px;

            padding:
                11px 18px;

            font:
                14px Arial, sans-serif;

            background:
                var(--pink-soft);

            color: var(--ink);
        }


        .composer textarea:focus {
            outline: none;

            border-color:
                var(--blue-strong);

            background: #fff;
        }


        .send-btn {
            border: 0;

            border-radius: 50%;

            width: 44px;
            height: 44px;

            background:
                var(--blue-strong);

            color: #fff;

            font-weight: 700;

            cursor: pointer;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 16px;
        }


        .send-btn:disabled {
            background: #c8d6e8;

            cursor: not-allowed;
        }


        .composer-disabled-note {
            text-align: center;

            font-size: 12.5px;

            color: var(--muted);

            padding:
                6px 0 2px;
        }


        /* =========================================================
           RIGHT - CONTACT INFO
        ========================================================= */

        .contact-info {
            padding: 24px 22px;

            text-align: center;
        }


        .contact-info summary {
            list-style: none;

            cursor: pointer;

            font-weight: 800;

            font-size: 15px;

            text-align: left;

            display: none;
        }


        .contact-info summary::-webkit-details-marker {
            display: none;
        }


        .contact-username {
            margin:
                0 0 2px;

            font-size: 17px;

            font-weight: 800;
        }


        .contact-role {
            margin:
                0 0 18px;

            font-size: 12px;

            font-weight: 700;

            letter-spacing: 0.06em;

            text-transform: uppercase;

            color: var(--muted);
        }


        .info-divider {
            height: 1px;

            background: var(--line);

            margin: 18px 0;

            border: none;
        }


        .info-block {
            text-align: left;
        }


        .info-block h4 {
            margin:
                0 0 10px;

            font-size: 12px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: 0.06em;

            color: var(--muted);
        }


        .info-row {
            display: flex;

            justify-content: space-between;

            gap: 10px;

            font-size: 13.5px;

            padding: 6px 0;
        }


        .info-row span:first-child {
            color: var(--muted);
        }


        .info-row span:last-child {
            font-weight: 700;

            text-align: right;

            text-transform: capitalize;
        }


        .info-desc {
            font-size: 13.5px;

            color: var(--ink);

            line-height: 1.6;

            text-align: left;
        }


        /* =========================================================
           RATING
        ========================================================= */

        .rating-box {
            text-align: left;
        }


        .rating-box strong {
            display: block;

            margin-bottom: 10px;

            font-size: 13.5px;
        }


        .rating-box form {
            display: grid;

            gap: 10px;
        }


        .rating-box label {
            display: grid;

            gap: 6px;

            font-size: 12.5px;

            color: var(--muted);

            font-weight: 700;
        }


        .rating-box select,
        .rating-box textarea {
            padding:
                10px 12px;

            border:
                1px solid var(--line);

            border-radius:
                var(--radius-sm);

            font:
                13.5px Arial, sans-serif;

            background:
                var(--pink-soft);

            color: var(--ink);
        }


        .rating-box textarea {
            resize: vertical;
        }


        .rating-box button {
            padding:
                11px 16px;

            border-radius:
                var(--radius-sm);

            border: 0;

            background:
                var(--blue-strong);

            color: #fff;

            font-weight: 700;

            cursor: pointer;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1080px) {

            .app-shell {
                grid-template-columns:
                    250px
                    1fr;
            }


            .contact-info {
                grid-column:
                    1 / -1;

                text-align: left;
            }


            .contact-info summary {
                display: block;

                padding-bottom: 4px;
            }


            .contact-info .contact-info-body {
                display: none;

                margin-top: 14px;
            }


            .contact-info[open]
            .contact-info-body {
                display: block;
            }


            .contact-info .avatar.lg,
            .contact-info .contact-username,
            .contact-info .contact-role {
                text-align: center;
            }

        }


        @media (max-width: 760px) {

            .chat-navigation {
                width:
                    calc(100% - 20px);

                margin-top: 85px;

                gap: 7px;
            }


            .nav-button {
                padding:
                    9px 12px;

                font-size: 11px;
            }


            .app-shell {
                grid-template-columns: 1fr;

                margin-top: 14px;

                width:
                    calc(100% - 20px);
            }


            .info-toggle {
                display: flex;

                align-items: center;

                justify-content: center;
            }


            .back-link {
                display: flex;
            }


            .bubble {
                max-width: 82%;
            }


            /* Mode chat */

            .app-shell.mobile-chat
            .chat-list {
                display: none;
            }


            .app-shell.mobile-chat
            .chat {
                height:
                    calc(100vh - 210px);

                min-height: 420px;
            }


            /* Mode list */

            .app-shell.mobile-list
            .chat,
            .app-shell.mobile-list
            .contact-info {
                display: none;
            }


            .app-shell.mobile-list
            .chat-list {
                max-height: none;
            }

        }

    </style>

</head>


<body>

    {{-- =========================================================
         NAVBAR UTAMA
    ========================================================== --}}

    @include('whisperly.navbar')


    {{-- =========================================================
         NAVIGASI CHAT
    ========================================================== --}}

    <div class="chat-navigation">

        {{-- KE HALAMAN DETAIL TALENT --}}
        @if ($booking->talent?->pengguna?->username)

            <a
                href="{{ route(
                    'whisperly.talents.show',
                    ['username' => $booking->talent->pengguna->username]
                ) }}"
                class="nav-button"
            >
                ← Lihat Talent
            </a>

        @endif


        {{-- KE HALAMAN UTAMA --}}
        <a
            href="{{ route('whisperly.home') }}"
            class="nav-button nav-home"
        >
            ← Halaman Utama
        </a>


        {{-- KE HALAMAN PENGADUAN --}}
        <a
            href="{{ url('/pengaduan') }}"
            class="nav-button nav-pengaduan"
        >
            Pengaduan →
        </a>

    </div>


    {{-- =========================================================
         APP CHAT
    ========================================================== --}}

    <div class="app-shell mobile-{{ $mobileView }}">


        {{-- =====================================================
             KIRI
             RIWAYAT PERCAKAPAN
        ====================================================== --}}

        <aside class="panel chat-list">

            <div class="chat-list-head">

                <h2>
                    Riwayat Percakapan
                </h2>

                <span>
                    Booking aktif kamu
                </span>

            </div>


            <div class="chat-list-items">

                @forelse ($bookings as $b)

                    @php

                        $bPartnerName = $iAmUser
                            ? ucfirst(
                                $b->talent?->pengguna?->username
                                ?? 'Talent'
                            )
                            : ucfirst(
                                $b->pengguna?->username
                                ?? 'User'
                            );


                        $bInitial = strtoupper(
                            mb_substr(
                                $bPartnerName,
                                0,
                                1
                            )
                        );


                        $bLastMessage =
                            $b->conversation?->messages
                            ?->sortBy('created_at')
                            ?->last();


                        $bDot = match ($b->status) {

                            'active' =>
                                '#4f8ff7',

                            'upcoming' =>
                                '#e0a94c',

                            default =>
                                '#b3aab0',

                        };


                        $bTimeLabel = '';


                        if ($bLastMessage?->created_at) {

                            $bTimeLabel =
                                $bLastMessage
                                ->created_at
                                ->isToday()

                                ? $bLastMessage
                                    ->created_at
                                    ->format('H:i')

                                : (
                                    $bLastMessage
                                        ->created_at
                                        ->isYesterday()

                                    ? 'Kemarin'

                                    : $bLastMessage
                                        ->created_at
                                        ->format('d M')
                                );

                        }

                    @endphp


                    <a
                        href="{{ route(
                            'whisperly.chat.show',
                            $b->id
                        ) }}"
                        class="conversation
                            {{ $b->id === $booking->id
                                ? 'active'
                                : '' }}"
                    >

                        <div class="avatar">
                            {{ $bInitial }}
                        </div>


                        <div class="conversation-body">

                            <div class="conversation-top">

                                <span class="conversation-name">
                                    {{ $bPartnerName }}
                                </span>


                                @if ($bTimeLabel)

                                    <span class="conversation-time">
                                        {{ $bTimeLabel }}
                                    </span>

                                @endif

                            </div>


                            <div class="conversation-preview-row">

                                <span
                                    class="status-dot"
                                    style="
                                        background:
                                        {{ $bDot }}
                                    "
                                ></span>


                                <span class="conversation-preview">

                                    {{ $bLastMessage->message
                                        ?? 'Belum ada pesan' }}

                                </span>

                            </div>

                        </div>

                    </a>

                @empty

                    <div class="empty-list">
                        Belum ada percakapan.
                    </div>

                @endforelse

            </div>

        </aside>


        {{-- =====================================================
             TENGAH
             ROOM CHAT
        ====================================================== --}}

        <section class="panel chat">


            {{-- HEADER CHAT --}}

            <div class="chat-header">

                <div class="chat-header-left">


                    {{-- MOBILE BACK --}}

                    <a
                        href="{{ route(
                            'whisperly.chat.show',
                            $booking->id
                        ) }}?view=list"
                        class="back-link"
                        aria-label="Kembali ke daftar"
                    >
                        &larr;
                    </a>


                    <div class="avatar">
                        {{ $partnerInitial }}
                    </div>


                    <div>

                        <h3>
                            {{ $partnerName }}
                        </h3>


                        <div class="subtitle">

                            Jadwal
                            {{ $scheduleStart }}
                            -
                            {{ $scheduleEnd }}

                        </div>

                    </div>

                </div>


                <div
                    style="
                        display:flex;
                        align-items:center;
                        gap:10px;
                    "
                >

                    <span class="status-pill">

                        <span
                            class="status-dot"
                            style="
                                background:
                                {{ $statusDot }}
                            "
                        ></span>

                        {{ $status }}

                    </span>


                    <button
                        type="button"
                        class="info-toggle"
                        onclick="
                            document
                                .getElementById(
                                    'contact-info-panel'
                                )
                                .setAttribute(
                                    'open',
                                    ''
                                )
                        "
                        aria-label="Lihat info kontak"
                    >
                        i
                    </button>

                </div>

            </div>


            {{-- NOTICE --}}

            @if ($notice)

                <div class="notice-banner">
                    {{ $notice }}
                </div>

            @endif


            {{-- =================================================
                 PESAN
            ================================================== --}}

            <div class="messages">

                @forelse ($messages as $message)

                    @php
                        $mine =
                            $message->sender_id
                            === auth('whisperly')->id();
                    @endphp


                    <div
                        class="message-row
                            {{ $mine
                                ? 'sent'
                                : 'received' }}"
                    >

                        <div class="bubble">

                            {{ $message->message }}


                            @if ($message->created_at)

                                <span class="timestamp">

                                    {{ $message
                                        ->created_at
                                        ->format('H:i') }}

                                </span>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="message-row received">

                        <div class="bubble">

                            Belum ada pesan untuk booking ini.

                        </div>

                    </div>

                @endforelse

            </div>


            {{-- =================================================
                 COMPOSER
            ================================================== --}}

            <div class="composer">

                @if ($canChat)

                    <form
                        method="POST"
                        action="{{ route(
                            'whisperly.chat.store',
                            $booking->id
                        ) }}"
                    >

                        @csrf


                        <div
                            class="icon-btn"
                            title="Lampiran belum tersedia"
                        >
                            +
                        </div>


                        <textarea
                            name="message"
                            placeholder="Ketik pesan..."
                            required
                        ></textarea>


                        <button
                            type="submit"
                            class="send-btn"
                            aria-label="Kirim"
                        >
                            &#10148;
                        </button>

                    </form>

                @else

                    <form
                        onsubmit="return false;"
                    >

                        <div
                            class="icon-btn"
                            title="Lampiran belum tersedia"
                        >
                            +
                        </div>


                        <textarea
                            placeholder="Ketik pesan..."
                            disabled
                        ></textarea>


                        <button
                            type="button"
                            class="send-btn"
                            disabled
                            aria-label="Kirim"
                        >
                            &#10148;
                        </button>

                    </form>


                    <div class="composer-disabled-note">

                        Kamu belum dapat mengirim pesan
                        pada percakapan ini.

                    </div>

                @endif

            </div>

        </section>


        {{-- =====================================================
             KANAN
             CONTACT INFO
        ====================================================== --}}

        <details
            class="panel contact-info"
            id="contact-info-panel"
            open
        >

            <summary>
                Contact Info &darr;
            </summary>


            <div class="contact-info-body">


                {{-- AVATAR --}}

                <div class="avatar lg">
                    {{ $partnerInitial }}
                </div>


                {{-- USERNAME --}}

                <p class="contact-username">
                    {{ $partnerName }}
                </p>


                {{-- ROLE --}}

                <p class="contact-role">
                    {{ $partnerRoleLabel }}
                </p>


                <hr class="info-divider">


                {{-- BOOKING --}}

                <div class="info-block">

                    <h4>
                        Booking
                    </h4>


                    <div class="info-row">

                        <span>
                            Status
                        </span>

                        <span>
                            {{ $status }}
                        </span>

                    </div>


                    <div class="info-row">

                        <span>
                            Jadwal
                        </span>

                        <span>
                            {{ $scheduleStart }}
                            -
                            {{ $scheduleEnd }}
                        </span>

                    </div>

                </div>


                <hr class="info-divider">


                {{-- PROFIL --}}

                <div class="info-block">

                    <h4>
                        Profil
                    </h4>


                    <p class="info-desc">
                        {{ $partnerDesc }}
                    </p>

                </div>


                {{-- =================================================
                     RATING
                ================================================== --}}

                @if (
                    $status === 'completed'
                    && $iAmUser
                    && ! $booking
                        ->ratings()
                        ->where(
                            'pengguna_id',
                            auth('whisperly')->id()
                        )
                        ->exists()
                )

                    <hr class="info-divider">


                    <div class="rating-box">

                        <strong>
                            Bagaimana pengalamanmu
                            dengan talent ini?
                        </strong>


                        <form
                            method="POST"
                            action="{{ route(
                                'whisperly.bookings.rating.store',
                                $booking->id
                            ) }}"
                        >

                            @csrf


                            <label>

                                Rating (1-5)

                                <select
                                    name="rating"
                                    required
                                >

                                    <option value="5">
                                        5 - Sangat bagus
                                    </option>

                                    <option value="4">
                                        4 - Bagus
                                    </option>

                                    <option value="3">
                                        3 - Cukup
                                    </option>

                                    <option value="2">
                                        2 - Kurang
                                    </option>

                                    <option value="1">
                                        1 - Buruk
                                    </option>

                                </select>

                            </label>


                            <label>

                                Ulasan

                                <textarea
                                    name="ulasan"
                                    rows="3"
                                    placeholder="Tulis ulasan singkat..."
                                ></textarea>

                            </label>


                            <button
                                type="submit"
                            >
                                Kirim Rating
                            </button>

                        </form>

                    </div>

                @endif

            </div>

        </details>

    </div>

</body>
</html>