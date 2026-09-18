<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Chat Whisperly</title>


    <style>

        /* =========================================================
           RESET
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }


        /* =========================================================
           BODY
        ========================================================= */

        body {
            margin: 0;
            min-height: 100vh;

            background-color: #07152f;

            background-image:
                url('{{ asset('assets/images/chat-background.jpg') }}');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

            color: #183153;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            overflow-x: hidden;
        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar-wrapper {
            width: 100%;

            padding:
                22px 30px 0;

            position: relative;

            z-index: 100;
        }


        /* =========================================================
           MAIN
        ========================================================= */

        main {
            width: 100%;
            max-width: none;

            margin: 0;

            height:
                calc(100vh - 82px);

            position: relative;

            z-index: 1;
        }


        /* =========================================================
           CHAT CONTAINER
        ========================================================= */

        .chat-container {
            width: 100%;
            height: 100%;

            min-height: 0;

            display: grid;

            grid-template-columns:
                360px minmax(0, 1fr);

            column-gap: 0;

            background:
                #fff;

            border-radius: 0;

            overflow: hidden;
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .chat-sidebar {

            height: 100%;
            min-height: 0;

            display: flex;

            flex-direction: column;

            padding:
                28px 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.97),
                    rgba(239,247,255,.93)
                );

            border-right:
                1px solid
                #dceafb;

            border-radius: 0;

            box-shadow:
                none;

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);

            overflow: hidden;
        }


        /* =========================================================
           JUDUL CHAT
        ========================================================= */

        .chat-title {

            margin:
                0 0 20px 4px;

            color:
                #102b4d;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size:
                36px;

            font-weight:
                400;

            line-height:
                1.1;

            flex-shrink: 0;
        }


        /* =========================================================
           SEARCH
        ========================================================= */

        .search-wrapper {

            position: relative;

            width: 100%;

            flex-shrink: 0;
        }


        .search-icon {

            position: absolute;

            left:
                16px;

            top:
                50%;

            transform:
                translateY(-50%);

            color:
                #348fdf;

            font-size:
                16px;

            pointer-events:
                none;

            z-index:
                2;
        }


        .search-box {

            width: 100%;

            height:
                37px;

            padding:
                9px 14px 9px 40px;

            border:
                1px solid
                rgba(117,177,228,.30);

            border-radius:
                13px;

            outline:
                none;

            background:
                rgba(245,250,255,.90);

            color:
                #23466d;

            font-size:
                12px;

            box-shadow:
                inset 0 1px 0
                rgba(255,255,255,.85),
                0 5px 15px
                rgba(35,101,160,.04);

            transition:
                border-color .25s ease,
                box-shadow .25s ease,
                background .25s ease;
        }


        .search-box::placeholder {
            color:
                #7890a8;
        }


        .search-box:hover {

            background:
                rgba(255,255,255,.96);

            border-color:
                rgba(77,169,255,.35);
        }


        .search-box:focus {

            background:
                rgba(255,255,255,.98);

            border-color:
                rgba(35,136,232,.60);

            box-shadow:
                0 0 0 3px
                rgba(35,136,232,.09),
                0 8px 20px
                rgba(35,136,232,.08);
        }


        /* =========================================================
           FILTER
        ========================================================= */

        .chat-filter {

            display:
                flex;

            align-items:
                center;

            gap:
                6px;

            margin:
                14px 0 12px;

            flex-shrink:
                0;
        }


        .filter-btn {

            border:
                none;

            padding:
                7px 14px;

            border-radius:
                10px;

            background:
                transparent;

            color:
                #55718e;

            font-size:
                11px;

            cursor:
                pointer;

            transition:
                background .25s ease,
                color .25s ease,
                transform .25s ease,
                box-shadow .25s ease;
        }


        .filter-btn:hover {

            background:
                rgba(35,136,232,.07);

            color:
                #1674d1;

            transform:
                translateY(-1px);
        }


        .filter-btn.active {

            background:
                linear-gradient(
                    135deg,
                    rgba(35,136,232,.16),
                    rgba(77,169,255,.09)
                );

            color:
                #126bc0;

            font-weight:
                700;

            box-shadow:
                inset 0 0 0 1px
                rgba(35,136,232,.08),
                0 4px 12px
                rgba(35,136,232,.07);
        }


        /* =========================================================
           CHAT LIST
           PENTING:
           GRID TIDAK BOLEH MEMBESARKAN ITEM
        ========================================================= */

        .chat-list {

            flex:
                1;

            min-height:
                0;

            display:
                grid;

            grid-auto-rows:
                max-content;

            align-content:
                start;

            gap:
                5px;

            overflow-y:
                auto;

            overflow-x:
                hidden;

            scrollbar-width:
                thin;

            scrollbar-color:
                rgba(35,136,232,.28)
                transparent;
        }


        .chat-list::-webkit-scrollbar {

            width:
                5px;
        }


        .chat-list::-webkit-scrollbar-track {

            background:
                transparent;
        }


        .chat-list::-webkit-scrollbar-thumb {

            background:
                linear-gradient(
                    180deg,
                    rgba(77,169,255,.45),
                    rgba(35,136,232,.25)
                );

            border-radius:
                999px;
        }


        /* =========================================================
           ITEM CHAT
        ========================================================= */

        .chat-item {

            position:
                relative;

            display:
                grid;

            grid-template-columns:
                44px minmax(0, 1fr) auto;

            gap:
                10px;

            align-items:
                center;

            width:
                100%;

            min-height:
                64px;

            height:
                auto;

            padding:
                9px 10px;

            margin:
                0;

            border-radius:
                14px;

            text-decoration:
                none;

            color:
                inherit;

            border:
                1px solid
                transparent;

            flex-shrink:
                0;

            transition:
                background .25s ease,
                border-color .25s ease,
                transform .25s ease,
                box-shadow .25s ease;
        }


        .chat-item:hover {

            background:
                linear-gradient(
                    135deg,
                    rgba(235,247,255,.90),
                    rgba(219,239,255,.72)
                );

            border-color:
                rgba(77,169,255,.15);

            transform:
                translateX(2px);

            box-shadow:
                0 6px 18px
                rgba(35,101,160,.06);
        }


        /* =========================================================
           CHAT AKTIF
        ========================================================= */

        .chat-item.active {

            background:
                linear-gradient(
                    135deg,
                    rgba(210,235,255,.96),
                    rgba(190,223,251,.82)
                );

            border-color:
                rgba(35,136,232,.16);

            box-shadow:
                inset 3px 0 0 #2388e8,
                0 6px 18px
                rgba(35,136,232,.08);
        }


        .chat-item.active:hover {

            background:
                linear-gradient(
                    135deg,
                    rgba(210,235,255,.98),
                    rgba(190,223,251,.88)
                );
        }


        /* =========================================================
           UNREAD
        ========================================================= */

        .chat-item.unread {

            background:
                linear-gradient(
                    135deg,
                    rgba(225,241,255,.82),
                    rgba(210,234,255,.60)
                );

            border-color:
                rgba(77,169,255,.10);
        }


        .chat-item.unread:hover {

            background:
                linear-gradient(
                    135deg,
                    rgba(215,238,255,.98),
                    rgba(198,227,252,.88)
                );
        }


        .chat-item.unread
        .chat-item-name {

            color:
                #0e5da4;
        }


        /* =========================================================
           AVATAR
        ========================================================= */

        .chat-avatar {

            width:
                44px;

            height:
                44px;

            min-width:
                44px;

            border-radius:
                50%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            overflow:
                hidden;

            background:
                linear-gradient(
                    145deg,
                    #d9efff,
                    #8bcaff 55%,
                    #56a8ed
                );

            color:
                #1267b7;

            border:
                2px solid
                rgba(255,255,255,.95);

            font-size:
                16px;

            font-weight:
                700;

            box-shadow:
                0 6px 16px
                rgba(35,136,232,.16),
                inset 0 1px 2px
                rgba(255,255,255,.85);

            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }


        .chat-avatar img {

            width:
                100%;

            height:
                100%;

            display:
                block;

            border-radius:
                50%;

            object-fit:
                cover;
        }

        .avatar-fallback {

            width:
                100%;

            height:
                100%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            color:
                #1267b7;

            font-size:
                16px;

            font-weight:
                700;
        }


        .chat-item:hover
        .chat-avatar {

            transform:
                scale(1.025);

            box-shadow:
                0 8px 20px
                rgba(35,136,232,.22);
        }


        /* =========================================================
           INFO CHAT
        ========================================================= */

        .chat-main {

            min-width:
                0;

            overflow:
                hidden;
        }


        .chat-item-name {

            display:
                block;

            margin:
                0 0 2px;

            color:
                #173a5e;

            font-size:
                13px;

            font-weight:
                700;

            line-height:
                1.25;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;
        }


        .chat-item-preview {

            max-width:
                100%;

            color:
                #6c87a2;

            font-size:
                10px;

            line-height:
                1.3;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;
        }


        /* =========================================================
           BAGIAN KANAN ITEM
        ========================================================= */

        .chat-item-right {

            align-self:
                stretch;

            display:
                flex;

            flex-direction:
                column;

            align-items:
                flex-end;

            justify-content:
                space-between;

            padding:
                1px 0;

            gap:
                3px;
        }


        .chat-item-time {

            color:
                #7691ab;

            font-size:
                9px;

            line-height:
                1.2;

            white-space:
                nowrap;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .status {

            font-size:
                9px;

            font-weight:
                700;

            text-transform:
                capitalize;

            white-space:
                nowrap;
        }


        .status.active {
            color:
                #23834a;
        }


        .status.completed {
            color:
                #66809b;
        }


        .status.upcoming {
            color:
                #9a721b;
        }


        .status.closed {
            color:
                #999;
        }


        /* =========================================================
           UNREAD BADGE
        ========================================================= */

        .unread-badge {

            min-width:
                18px;

            height:
                18px;

            padding:
                0 5px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                50%;

            background:
                linear-gradient(
                    135deg,
                    #4ca9ff,
                    #1678d8
                );

            color:
                white;

            font-size:
                9px;

            font-weight:
                700;

            box-shadow:
                0 4px 10px
                rgba(35,136,232,.25);

            border:
                1px solid
                rgba(255,255,255,.75);
        }


        /* =========================================================
           CHECKLIST
        ========================================================= */

        .message-indicator {

            font-size:
                10px;

            font-weight:
                700;

            color:
                #2388e8;

            white-space:
                nowrap;

            text-shadow:
                0 2px 7px
                rgba(35,136,232,.18);
        }


        /* =========================================================
           EMPTY SIDEBAR
        ========================================================= */

        .empty-chat {

            margin:
                15px 0;

            padding:
                20px 10px;

            color:
                #728ca5;

            font-size:
                12px;

            line-height:
                1.5;

            text-align:
                center;
        }


        /* =========================================================
           AREA CHAT KANAN
        ========================================================= */

        .chat-content {

            position:
                relative;

            width:
                100%;

            height:
                100%;

            min-height:
                0;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            padding:
                30px;

            overflow:
                hidden;

            background-color:
                #a9d2f5;

            background-image:
                url('{{ asset('assets/images/chat-background.jpg') }}');

            background-size:
                cover;

            background-position:
                center;

            background-attachment:
                fixed;

            background-repeat:
                no-repeat;

            text-align:
                center;
        }


        /* =========================================================
           RECTANGLE CHAT SAYA
        ========================================================= */

        .chat-empty-content {

            position:
                relative;

            z-index:
                2;

            width:
                min(590px, 88%);

            display:
                flex;

            flex-direction:
                column;

            align-items:
                center;

            justify-content:
                center;

            padding:
                34px 45px;

            background:
                rgba(
                    255,
                    255,
                    255,
                    .91
                );

            border:
                1px solid
                rgba(
                    255,
                    255,
                    255,
                    .96
                );

            border-radius:
                25px;

            box-shadow:
                0 18px 45px
                rgba(
                    20,
                    63,
                    100,
                    .17
                );

            backdrop-filter:
                blur(12px);

            -webkit-backdrop-filter:
                blur(12px);

            text-align:
                center;
        }


        /* =========================================================
           ICON CHAT SAYA
        ========================================================= */

        .chat-icon {

            width:
                68px;

            height:
                68px;

            margin:
                0 0 13px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                50%;

            background:
                linear-gradient(
                    135deg,
                    #d8ecff,
                    #b8daf8
                );

            color:
                #1976d2;

            font-size:
                29px;

            box-shadow:
                0 9px 22px
                rgba(
                    44,
                    112,
                    176,
                    .14
                );
        }


        /* =========================================================
           JUDUL CHAT SAYA
        ========================================================= */

        .chat-empty-content h1 {

            margin:
                0 0 5px;

            color:
                #182b4a;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size:
                46px;

            font-weight:
                400;

            line-height:
                1.05;
        }


        /* =========================================================
           DESKRIPSI
        ========================================================= */

        .chat-empty-content p {

            margin:
                0;

            max-width:
                500px;

            color:
                #587491;

            font-size:
                13px;

            line-height:
                1.45;
        }


        /* =========================================================
           MOBILE / TABLET
        ========================================================= */

        @media (max-width: 900px) {

            .chat-container {

                grid-template-columns:
                    300px minmax(0, 1fr);
            }


            .chat-sidebar {

                padding:
                    24px 14px;
            }


            .chat-empty-content {

                width:
                    88%;

                padding:
                    30px 30px;
            }


            .chat-empty-content h1 {

                font-size:
                    40px;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 700px) {

            body {
                overflow:
                    auto;
            }


            .navbar-wrapper {

                padding:
                    14px 14px 0;
            }


            main {

                width:
                    100%;

                height:
                    auto;

                margin:
                    0;
            }


            .chat-container {

                display:
                    block;

                height:
                    auto;

                min-height:
                    0;

                border-radius:
                    0;
            }


            .chat-sidebar {

                height:
                    auto;

                min-height:
                    auto;

                border-right:
                    none;

                border-bottom:
                    1px solid
                    #dceafb;

                border-radius:
                    0;
            }


            .chat-list {

                flex:
                    none;

                max-height:
                    430px;

                overflow-y:
                    auto;
            }


            .chat-content {

                height:
                    600px;

                min-height:
                    600px;

                padding:
                    25px 18px;
            }


            .chat-empty-content {

                width:
                    92%;

                padding:
                    30px 22px;

                border-radius:
                    22px;
            }


            .chat-icon {

                width:
                    62px;

                height:
                    62px;

                font-size:
                    27px;

                margin-bottom:
                    12px;
            }


            .chat-empty-content h1 {

                font-size:
                    35px;

                margin-bottom:
                    5px;
            }


            .chat-empty-content p {

                font-size:
                    12px;

                line-height:
                    1.5;
            }
        }


        /* =========================================================
           HP KECIL
        ========================================================= */

        @media (max-width: 480px) {

            .chat-sidebar {

                padding:
                    20px 12px;
            }


            .chat-title {

                font-size:
                    31px;
            }


            .chat-item {

                grid-template-columns:
                    42px minmax(0, 1fr) auto;

                gap:
                    9px;

                min-height:
                    60px;

                padding:
                    8px 8px;

                border-radius:
                    13px;
            }


            .chat-avatar {

                width:
                    42px;

                height:
                    42px;

                min-width:
                    42px;

                font-size:
                    15px;
            }


            .chat-item-name {

                font-size:
                    12px;
            }


            .chat-item-preview {

                font-size:
                    9px;
            }


            .chat-item-time {

                font-size:
                    8px;
            }


            .chat-content {

                height:
                    550px;

                min-height:
                    550px;
            }


            .chat-empty-content {

                width:
                    94%;

                padding:
                    27px 17px;
            }


            .chat-empty-content h1 {

                font-size:
                    31px;
            }
        }

    </style>

</head>


<body>


    {{-- =========================================================
         NAVBAR WHISPERLY
    ========================================================= --}}

    @include('whisperly.navbar')


    {{-- =========================================================
         MAIN
    ========================================================= --}}

    <main>

        <div class="chat-container">


            {{-- =================================================
                 SIDEBAR
            ================================================== --}}

            <aside class="chat-sidebar">


                {{-- JUDUL --}}

                <h2 class="chat-title">
                    Chat
                </h2>


                {{-- SEARCH --}}

                <div class="search-wrapper">

                    <span class="search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        class="search-box"
                        id="chat-search"
                        placeholder="Cari Obrolan..."
                    >

                </div>


                {{-- FILTER --}}

                <div class="chat-filter">

                    <button
                        type="button"
                        class="filter-btn active"
                        data-filter="all"
                    >
                        Semua
                    </button>


                    <button
                        type="button"
                        class="filter-btn"
                        data-filter="unread"
                    >
                        Belum Dibaca
                    </button>

                </div>


                {{-- LIST CHAT --}}

                <div
                    class="chat-list"
                    id="chat-list"
                >

                    @forelse ($bookings as $booking)

                        @php

                            $userRole =
                                auth('whisperly')->user()->role;


                            /*
                            |--------------------------------------------------------------------------
                            | NAMA LAWAN CHAT
                            |--------------------------------------------------------------------------
                            */

                            if ($userRole === 'user') {

                                $otherName =
                                    $booking
                                        ->talent
                                        ?->pengguna
                                        ?->username
                                        ?? 'Talent';

                                $avatarUrl =
                                    $booking
                                        ->talent
                                        ?->pengguna
                                        ?->avatar_url
                                        ?? $booking
                                            ->talent
                                            ?->pengguna
                                            ?->photo
                                        ?? $booking
                                            ->talent
                                            ?->photo
                                        ?? null;

                            } else {

                                $otherName =
                                    $booking
                                        ->pengguna
                                        ?->username
                                        ?? 'User';

                                $avatarUrl =
                                    $booking
                                        ->pengguna
                                        ?->avatar_url
                                        ?? $booking
                                            ->pengguna
                                            ?->photo
                                        ?? null;
                            }

                            $avatar =
                                strtoupper(
                                    substr(
                                        $otherName,
                                        0,
                                        1
                                    )
                                );

                            /*
                            |----------------------------------------------------------------------
                            | NORMALISASI URL FOTO
                            |----------------------------------------------------------------------
                            */
                            if ($avatarUrl) {

                                if (
                                    !preg_match(
                                        '/^(https?:)?\\/\\//i',
                                        $avatarUrl
                                    )
                                    &&
                                    !str_starts_with(
                                        $avatarUrl,
                                        '/'
                                    )
                                ) {
                                    $avatarUrl =
                                        asset(
                                            'storage/' .
                                            ltrim(
                                                $avatarUrl,
                                                '/'
                                            )
                                        );
                                }
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | CONVERSATION ROOM
                            |--------------------------------------------------------------------------
                            */

                            $lastMessage =
                                $booking->last_message;

                            $unreadCount =
                                $booking->unread_count ?? 0;

                            $isLastMessageFromCurrentUser =
                                $lastMessage &&
                                (string) $lastMessage->sender_id ===
                                (string) auth('whisperly')->id();


                            /*
                            |--------------------------------------------------------------------------
                            | STATUS BOOKING
                            |--------------------------------------------------------------------------
                            */

                            $status =
                                $booking->chatStatus();


                            /*
                            |--------------------------------------------------------------------------
                            | WAKTU PESAN TERAKHIR
                            |--------------------------------------------------------------------------
                            */

                            if ($lastMessage) {

                                $messageTime =
                                    $lastMessage
                                        ->created_at
                                        ->format('H:i');

                            } else {

                                $messageTime =
                                    substr(
                                        $booking
                                            ->schedule
                                            ?->start_time
                                            ?? '00:00',
                                        0,
                                        5
                                    );
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | STATUS PESAN TERAKHIR
                            |--------------------------------------------------------------------------
                            */

                            $lastMessageIsRead =
                                $booking
                                    ->last_message_is_read
                                    ?? false;

                        @endphp


                        {{-- =================================================
                             ITEM CHAT
                        ================================================== --}}

                        <a
                            href="{{ route('whisperly.chat.show', $booking->id) }}"

                            class="chat-item
                                {{ $unreadCount > 0 ? 'unread' : '' }}"

                            data-name="{{ strtolower($otherName) }}"

                            data-unread="{{ $unreadCount > 0 ? 'true' : 'false' }}"

                            data-booking-id="{{ $booking->id }}"

                            data-avatar-url="{{ $avatarUrl ?? '' }}"
                        >


                            {{-- AVATAR --}}

                            <div
                                class="chat-avatar"
                                data-avatar-container
                            >

                                @if ($avatarUrl)

                                    <img
                                        src="{{ $avatarUrl }}"
                                        alt="Profil {{ $otherName }}"
                                        onerror="this.style.display='none'; this.parentElement.querySelector('.avatar-fallback').style.display='flex';"
                                    >

                                    <span
                                        class="avatar-fallback"
                                        style="display:none;"
                                    >
                                        {{ $avatar }}
                                    </span>

                                @else

                                    <span class="avatar-fallback">
                                        {{ $avatar }}
                                    </span>

                                @endif

                            </div>


                            {{-- INFO --}}

                            <div class="chat-main">

                                <span class="chat-item-name">
                                    {{ $otherName }}
                                </span>


                                <div class="chat-item-preview">

                                    @if ($lastMessage)

                                        {{
                                            \Illuminate\Support\Str::limit(
                                                $lastMessage->message,
                                                45
                                            )
                                        }}

                                    @else

                                        Belum ada pesan

                                    @endif

                                </div>

                            </div>


                            {{-- BAGIAN KANAN --}}

                            <div class="chat-item-right">


                                {{-- JAM --}}

                                <span class="chat-item-time">

                                    {{ $messageTime }}

                                </span>


                                {{-- INDIKATOR PESAN --}}

                                @if ($lastMessage)

                                    @if ($isLastMessageFromCurrentUser)

                                        <span class="message-indicator">

                                            @if ($lastMessageIsRead)

                                                ✓✓

                                            @else

                                                ✓

                                            @endif

                                        </span>

                                    @else

                                        @if ($unreadCount > 0)

                                            <span class="unread-badge">

                                                {{
                                                    $unreadCount > 99
                                                        ? '99+'
                                                        : $unreadCount
                                                }}

                                            </span>

                                        @endif

                                    @endif

                                @else

                                    {{-- STATUS BOOKING --}}

                                    <span class="status {{ $status }}">

                                        @if ($status === 'active')

                                            Active

                                        @elseif ($status === 'upcoming')

                                            Upcoming

                                        @elseif ($status === 'completed')

                                            Completed

                                        @else

                                            {{ ucfirst($status) }}

                                        @endif

                                    </span>

                                @endif

                            </div>

                        </a>


                    @empty

                        <p class="empty-chat">
                            Belum ada percakapan.
                        </p>

                    @endforelse

                </div>

            </aside>


            {{-- =================================================
                 AREA CHAT KANAN
            ================================================== --}}

            <section class="chat-content">


                {{-- =================================================
                     RECTANGLE CHAT SAYA
                ================================================== --}}

                <div class="chat-empty-content">


                    {{-- ICON --}}

                    <div class="chat-icon">
                        💬
                    </div>


                    {{-- JUDUL --}}

                    <h1>
                        Chat Saya
                    </h1>


                    {{-- DESKRIPSI --}}

                    <p>
                        Pilih salah satu percakapan di sebelah kiri
                        untuk mulai berinteraksi dengan pengguna atau talent.
                    </p>


                </div>

            </section>

        </div>

    </main>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================= --}}

    <script>

        /* =========================================================
           SEARCH + FILTER
        ========================================================= */

        const searchInput =
            document.getElementById('chat-search');

        let currentFilter = 'all';

        function applyChatFilter() {

            const keyword =
                searchInput
                    ? searchInput.value.toLowerCase().trim()
                    : '';

            document
                .querySelectorAll('.chat-item')
                .forEach(function (item) {

                    const name =
                        item.dataset.name || '';

                    const matchesSearch =
                        name.includes(keyword);

                    const matchesFilter =
                        currentFilter === 'all'
                        ||
                        (
                            currentFilter === 'unread'
                            &&
                            item.dataset.unread === 'true'
                        );

                    item.style.display =
                        matchesSearch && matchesFilter
                            ? 'grid'
                            : 'none';
                });
        }


        if (searchInput) {

            searchInput.addEventListener(
                'input',
                applyChatFilter
            );

        }


        const filterButtons =
            document.querySelectorAll('.filter-btn');

        filterButtons.forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    filterButtons.forEach(
                        function (btn) {

                            btn.classList.remove(
                                'active'
                            );

                        }
                    );

                    this.classList.add('active');

                    currentFilter =
                        this.dataset.filter || 'all';

                    applyChatFilter();

                }
            );

        });


        /* =========================================================
           REALTIME CHAT LIST
           - PP
           - preview pesan
           - jam
           - unread
           - centang
           - urutan chat
        ========================================================= */

        let isUpdatingChatList = false;

        function updateAvatar(item, chat) {

            if (!chat.avatar_url) {
                return;
            }

            const avatarContainer =
                item.querySelector(
                    '[data-avatar-container]'
                );

            if (!avatarContainer) {
                return;
            }

            const currentUrl =
                item.dataset.avatarUrl || '';

            if (currentUrl === chat.avatar_url) {
                return;
            }

            item.dataset.avatarUrl =
                chat.avatar_url;

            const img =
                document.createElement('img');

            img.src =
                chat.avatar_url;

            img.alt =
                'Profil ' +
                (chat.name || '');

            img.onerror = function () {

                avatarContainer.innerHTML = '';

                const fallback =
                    document.createElement('span');

                fallback.className =
                    'avatar-fallback';

                fallback.textContent =
                    (chat.name || '?')
                        .trim()
                        .charAt(0)
                        .toUpperCase();

                avatarContainer.appendChild(
                    fallback
                );
            };

            avatarContainer.innerHTML = '';

            avatarContainer.appendChild(
                img
            );
        }


        function updateChatRight(item, chat) {

            const right =
                item.querySelector(
                    '.chat-item-right'
                );

            if (!right) {
                return;
            }

            const oldBadge =
                right.querySelector(
                    '.unread-badge'
                );

            const oldIndicator =
                right.querySelector(
                    '.message-indicator'
                );

            if (oldBadge) {
                oldBadge.remove();
            }

            if (oldIndicator) {
                oldIndicator.remove();
            }

            if (
                chat.last_message &&
                chat.last_message_from_me
            ) {

                const indicator =
                    document.createElement('span');

                indicator.className =
                    'message-indicator';

                indicator.textContent =
                    chat.last_message_is_read
                        ? '✓✓'
                        : '✓';

                right.appendChild(
                    indicator
                );

                return;
            }

            if (
                chat.last_message &&
                Number(chat.unread_count || 0) > 0
            ) {

                const badge =
                    document.createElement('span');

                badge.className =
                    'unread-badge';

                badge.textContent =
                    Number(chat.unread_count) > 99
                        ? '99+'
                        : chat.unread_count;

                right.appendChild(
                    badge
                );
            }
        }


        function sortChatList(chats) {

            const chatList =
                document.getElementById(
                    'chat-list'
                );

            if (!chatList) {
                return;
            }

            const items =
                Array.from(
                    chatList.querySelectorAll(
                        '.chat-item'
                    )
                );

            const order = {};

            chats.forEach(function (chat, index) {

                order[
                    String(chat.booking_id)
                ] = index;

            });

            items.sort(function (a, b) {

                const aOrder =
                    order[
                        String(
                            a.dataset.bookingId || ''
                        )
                    ] ?? 999999;

                const bOrder =
                    order[
                        String(
                            b.dataset.bookingId || ''
                        )
                    ] ?? 999999;

                return aOrder - bOrder;
            });

            items.forEach(function (item) {

                chatList.appendChild(item);

            });
        }


        async function updateChatList() {

            if (isUpdatingChatList) {
                return;
            }

            isUpdatingChatList = true;

            try {

                const response =
                    await fetch(
                        "{{ route('whisperly.chat.updates') }}",
                        {
                            method: 'GET',

                            headers: {
                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            },

                            cache:
                                'no-store'
                        }
                    );

                if (!response.ok) {
                    return;
                }

                const data =
                    await response.json();

                if (!Array.isArray(data.chats)) {
                    return;
                }

                data.chats.forEach(
                    function (chat) {

                        const item =
                            document.querySelector(
                                `.chat-item[data-booking-id="${CSS.escape(String(chat.booking_id))}"]`
                            );

                        if (!item) {
                            return;
                        }

                        const preview =
                            item.querySelector(
                                '.chat-item-preview'
                            );

                        const time =
                            item.querySelector(
                                '.chat-item-time'
                            );

                        if (preview) {

                            preview.textContent =
                                chat.last_message ||
                                'Belum ada pesan';

                        }

                        if (time) {

                            time.textContent =
                                chat.time || '';

                        }

                        updateAvatar(
                            item,
                            chat
                        );

                        const unreadCount =
                            Number(
                                chat.unread_count || 0
                            );

                        if (unreadCount > 0) {

                            item.classList.add(
                                'unread'
                            );

                            item.dataset.unread =
                                'true';

                        } else {

                            item.classList.remove(
                                'unread'
                            );

                            item.dataset.unread =
                                'false';
                        }

                        updateChatRight(
                            item,
                            chat
                        );
                    }
                );

                sortChatList(
                    data.chats
                );

                applyChatFilter();

            } catch (error) {

                console.error(
                    'Gagal memperbarui chat list:',
                    error
                );

            } finally {

                isUpdatingChatList = false;

            }
        }


        updateChatList();

        setInterval(
            updateChatList,
            2500
        );

    </script>


</body>

</html>