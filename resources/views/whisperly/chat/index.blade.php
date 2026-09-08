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

            background-color: #a9d2f5;

            background-image:
                linear-gradient(
            rgba(183,216,246,0.55),
            rgba(183,216,246,0.55)
        ),
                url('{{ asset('assets/images/chat-background.jpg') }}');

            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;

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
            width: calc(100% - 64px);

            max-width: 1660px;

            margin:
                10px auto 40px;

            position: relative;

            z-index: 1;
        }


        /* =========================================================
           CHAT CONTAINER
        ========================================================= */

        .chat-container {

            width: 100%;

            min-height: 720px;

            display: grid;

            grid-template-columns:
                360px 1fr;

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.95
                );

            border-radius: 28px;

            overflow: hidden;

            border:
                1px solid
                rgba(
                    255,
                    255,
                    255,
                    0.85
                );

            box-shadow:
                0 25px 70px
                rgba(
                    35,
                    101,
                    160,
                    0.18
                );
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .chat-sidebar {

            min-height: 720px;

            padding:
                28px 18px;

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.97
                );

            border-right:
                1px solid
                #d9e9f8;
        }


        /* =========================================================
           JUDUL CHAT
        ========================================================= */

        .chat-title {

            margin:
                0 0 24px 4px;

            color:
                #173456;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 38px;

            font-weight: 400;
        }


        /* =========================================================
           SEARCH
        ========================================================= */

.search-wrapper {
    position: relative;
    width: 100%;
}

.search-icon {
    position: absolute;
    left: 17px;
    top: 50%;
    transform: translateY(-50%);

    color: #4285c5;
    font-size: 17px;

    pointer-events: none;
    z-index: 2;
}

        .search-box {

            width: 100%;

            padding:
                14px 16px 14px 48px;

            border:
                1px solid
                #d4e6f8;

            border-radius: 15px;

            outline: none;

            background:
                #f8fcff;

            color:
                #23466d;

            font-size: 14px;

            transition:
                0.2s ease;
        }


        .search-box::placeholder {
            color:
                #7890a8;
        }


        .search-box:focus {

            border-color:
                #5da5ed;

            box-shadow:
                0 0 0 3px
                rgba(
                    93,
                    165,
                    237,
                    0.12
                );
        }


        /* =========================================================
           FILTER
        ========================================================= */

        .chat-filter {

            display: flex;

            gap: 8px;

            margin:
                18px 0 20px;
        }


        .filter-btn {

            border: none;

            padding:
                9px 15px;

            border-radius: 12px;

            background:
                transparent;

            color:
                #55718e;

            font-size: 13px;

            cursor: pointer;

            transition:
                0.2s ease;
        }


        .filter-btn:hover {

            background:
                #eef7ff;

            color:
                #1976d2;
        }


        .filter-btn.active {

            background:
                #dceeff;

            color:
                #1976d2;

            font-weight: 700;
        }


        /* =========================================================
           CHAT LIST
        ========================================================= */

        .chat-list {

            display: grid;

            gap: 8px;
        }


        /* =========================================================
           ITEM CHAT
        ========================================================= */

        .chat-item {

            position: relative;

            display: grid;

            grid-template-columns:
                52px 1fr auto;

            gap: 12px;

            align-items: center;

            padding:
                13px 12px;

            border-radius: 18px;

            text-decoration: none;

            color: inherit;

            transition:
                background 0.2s ease,
                transform 0.2s ease;
        }


        .chat-item:hover {

            background:
                #eef7ff;

            transform:
                translateX(2px);
        }


        /* =========================================================
           CHAT ITEM AKTIF
        ========================================================= */

        .chat-item.active {

            background:
                #dceeff;
        }


        .chat-item.active:hover {

            background:
                #dceeff;
        }


        /* =========================================================
           AVATAR
        ========================================================= */

        .chat-avatar {

            width: 52px;

            height: 52px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #c8e5ff,
                    #9fd0fa
                );

            color:
                #1976d2;

            font-size: 20px;

            font-weight: 700;

            box-shadow:
                0 5px 15px
                rgba(
                    25,
                    118,
                    210,
                    0.12
                );
        }


        /* =========================================================
           CHAT INFO
        ========================================================= */

        .chat-main {

            min-width: 0;
        }


        .chat-item-name {

            display: block;

            margin-bottom: 4px;

            color:
                #18365b;

            font-size: 15px;

            font-weight: 700;
        }


        .chat-item-preview {

            max-width: 200px;

            color:
                #63809c;

            font-size: 12px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        /* =========================================================
           BAGIAN KANAN ITEM
        ========================================================= */

        .chat-item-right {

            align-self: start;

            display: flex;

            flex-direction: column;

            align-items: flex-end;

            gap: 6px;
        }


        .chat-item-time {

            color:
                #66809b;

            font-size: 11px;

            white-space: nowrap;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .status {

            font-size: 11px;

            font-weight: 700;

            text-transform: capitalize;
        }


        .active {
            color:
                #23834a;
        }


        .completed {
            color:
                #66809b;
        }


        .upcoming {
            color:
                #9a721b;
        }


        .closed {
            color:
                #999;
        }


        /* =========================================================
           UNREAD
        ========================================================= */

        .chat-item.unread {

            background:
                rgba(
                    219,
                    238,
                    255,
                    0.65
                );
        }


        .chat-item.unread:hover {

            background:
                #dceeff;
        }


        .chat-item.unread
        .chat-item-name {

            color:
                #145da0;
        }


        .unread-badge {

            min-width: 21px;

            height: 21px;

            padding:
                0 6px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                #2388e8;

            color:
                white;

            font-size: 10px;

            font-weight: 700;
        }


        /* =========================================================
           MESSAGE INDICATOR (CHECKLIST)
        ========================================================= */

        .message-indicator {

            font-size: 11px;

            font-weight: 700;

            color: #2388e8;

            white-space: nowrap;
        }


        /* =========================================================
           EMPTY SIDEBAR
        ========================================================= */

        .empty-chat {

            padding:
                30px 10px;

            color:
                #63809c;

            font-size: 14px;

            line-height: 1.6;

            text-align: center;
        }


        /* =========================================================
           AREA KANAN
           BACKGROUND SAMA DENGAN ROOM CHAT
        ========================================================= */

        .chat-content {

            position: relative;

            min-height: 720px;

            display: flex;

            align-items: center;

            justify-content: center;

            padding:
                60px;

            overflow: hidden;

            background-color:
                #a9d2f5;

            background-image:
                linear-gradient(
            rgba(183,216,246,0.55),
            rgba(183,216,246,0.55)
        ),
                url('{{ asset('assets/images/chat-background.jpg') }}');

            background-size:
                cover;

            background-position:
                center;

            background-repeat:
                no-repeat;

            text-align: center;
        }


        /* =========================================================
           CHAT EMPTY CONTENT
        ========================================================= */

        .chat-empty-content {

            position: relative;

            z-index: 2;

            width:
                min(
                    700px,
                    90%
                );

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            padding:
                55px 65px;

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.88
                );

            border:
                1px solid
                rgba(
                    255,
                    255,
                    255,
                    0.95
                );

            border-radius:
                30px;

            box-shadow:
                0 20px 55px
                rgba(
                    44,
                    106,
                    163,
                    0.18
                );

            backdrop-filter:
                blur(8px);

            -webkit-backdrop-filter:
                blur(8px);
        }


        /* =========================================================
           ICON CHAT SAYA
        ========================================================= */

        .chat-icon {

            width: 88px;

            height: 88px;

            margin:
                0 auto 24px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #d8ecff,
                    #b8daf8
                );

            color:
                #1976d2;

            font-size: 38px;

            box-shadow:
                0 12px 30px
                rgba(
                    44,
                    112,
                    176,
                    0.16
                );
        }


        /* =========================================================
           JUDUL CHAT SAYA
        ========================================================= */

        .chat-empty-content h1 {

            margin:
                0 0 12px;

            color:
                #182b4a;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size:
                clamp(
                    42px,
                    5vw,
                    60px
                );

            font-weight:
                400;

            line-height:
                1.1;
        }


        /* =========================================================
           DESKRIPSI CHAT SAYA
        ========================================================= */

        .chat-empty-content p {

            margin:
                0 auto;

            max-width:
                650px;

            color:
                #587491;

            font-size:
                15px;

            line-height:
                1.7;
        }


        /* =========================================================
           HILANGKAN EFEK / ELEMENT PINK LAMA
        ========================================================= */

        .empty-chat-area {
            display: none;
        }


        /* =========================================================
           MOBILE / TABLET
        ========================================================= */

        @media (max-width: 900px) {

            main {

                width:
                    calc(100% - 35px);

                margin-top:
                    10px;
            }


            .chat-container {

                grid-template-columns:
                    300px 1fr;
            }


            .chat-empty-content {

                width:
                    88%;

                padding:
                    45px 35px;
            }


            .chat-empty-content h1 {

                font-size:
                    44px;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 700px) {

            .navbar-wrapper {

                padding:
                    14px 14px 0;
            }


            main {

                width:
                    calc(100% - 28px);

                margin:
                    10px auto 30px;
            }


            .chat-container {

                display:
                    block;

                min-height:
                    auto;

                border-radius:
                    22px;
            }


            .chat-sidebar {

                min-height:
                    auto;

                border-right:
                    none;

                border-bottom:
                    1px solid
                    #d9e9f8;
            }


            .chat-content {

                min-height:
                    600px;

                padding:
                    35px 20px;
            }


            .chat-empty-content {

                width:
                    92%;

                padding:
                    40px 25px;

                border-radius:
                    25px;
            }


            .chat-icon {

                width:
                    72px;

                height:
                    72px;

                font-size:
                    30px;

                margin-bottom:
                    18px;
            }


            .chat-empty-content h1 {

                font-size:
                    36px;
            }


            .chat-empty-content p {

                font-size:
                    13px;
            }
        }


        /* =========================================================
           HP KECIL
        ========================================================= */

        @media (max-width: 480px) {

            .chat-sidebar {

                padding:
                    22px 14px;
            }


            .chat-title {

                font-size:
                    32px;
            }


            .chat-item {

                grid-template-columns:
                    46px 1fr auto;

                gap:
                    9px;

                padding:
                    11px 9px;
            }


            .chat-avatar {

                width:
                    46px;

                height:
                    46px;

                font-size:
                    18px;
            }


            .chat-item-preview {

                max-width:
                    140px;
            }


            .chat-content {

                min-height:
                    550px;
            }


            .chat-empty-content {

                width:
                    94%;

                padding:
                    35px 18px;
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

    <span class="search-icon">⌕</span>

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

                                $avatar =
                                    strtoupper(
                                        substr(
                                            $otherName,
                                            0,
                                            1
                                        )
                                    );

                            } else {

                                $otherName =
                                    $booking
                                        ->pengguna
                                        ?->username
                                        ?? 'User';

                                $avatar =
                                    strtoupper(
                                        substr(
                                            $otherName,
                                            0,
                                            1
                                        )
                                    );

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | CONVERSATION ROOM
                            |--------------------------------------------------------------------------
                            */

                            $lastMessage = $booking->last_message;
    $unreadCount = $booking->unread_count ?? 0;

    $isLastMessageFromCurrentUser =
        $lastMessage &&
        (string) $lastMessage->sender_id === (string) auth('whisperly')->id();


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
                                $messageTime = $lastMessage->created_at->format('H:i');
                            } else {
                                $messageTime = substr(
                                    $booking->schedule?->start_time ?? '00:00',
                                    0,
                                    5
                                );
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | STATUS PESAN TERAKHIR (UNTUK CHECKLIST/BADGE)
                            |--------------------------------------------------------------------------
                            */

                            $lastMessageIsRead =
                                $booking->last_message_is_read ?? false;

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
                        >


                            {{-- AVATAR --}}

                            <div class="chat-avatar">

                                {{ $avatar }}

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

                                        {{-- CHECKLIST UNTUK PESAN DARI USER LOGIN --}}

                                        <span class="message-indicator">

                                            @if ($lastMessageIsRead)
                                                ✓✓
                                            @else
                                                ✓
                                            @endif

                                        </span>

                                    @else

                                        {{-- BADGE UNREAD UNTUK PESAN DARI ORANG LAIN --}}

                                        @if ($unreadCount > 0)

                                            <span class="unread-badge">

                                                {{ $unreadCount > 99 ? '99+' : $unreadCount }}

                                            </span>

                                        @endif

                                    @endif

                                @else

                                    {{-- JIKA TIDAK ADA PESAN, TAMPILKAN STATUS BOOKING --}}

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
                     BUBBLE CHAT SAYA
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
           SEARCH CHAT
        ========================================================= */

        const searchInput =
            document.getElementById(
                'chat-search'
            );


        const chatItems =
            document.querySelectorAll(
                '.chat-item'
            );


        if (searchInput) {

            searchInput.addEventListener(
                'input',
                function () {

                    const keyword =
                        this.value
                            .toLowerCase()
                            .trim();


                    chatItems.forEach(
                        function (item) {

                            const name =
                                item.dataset.name
                                || '';


                            const matches =
                                name.includes(
                                    keyword
                                );


                            item.style.display =
                                matches
                                    ? 'grid'
                                    : 'none';

                        }
                    );

                }
            );

        }



        /* =========================================================
           FILTER BELUM DIBACA
        ========================================================= */

        const filterButtons =
            document.querySelectorAll(
                '.filter-btn'
            );


        filterButtons.forEach(
            function (button) {

                button.addEventListener(
                    'click',
                    function () {


                        /* =================================================
                           BUTTON AKTIF
                        ================================================= */

                        filterButtons.forEach(
                            function (btn) {

                                btn.classList.remove(
                                    'active'
                                );

                            }
                        );


                        this.classList.add(
                            'active'
                        );


                        const filter =
                            this.dataset.filter;



                        /* =================================================
                           FILTER CHAT
                        ================================================= */

                        chatItems.forEach(
                            function (item) {


                                if (
                                    filter === 'all'
                                ) {

                                    item.style.display =
                                        'grid';

                                    return;
                                }



                                if (
                                    filter === 'unread'
                                ) {

                                    const unread =
                                        item.dataset.unread
                                        === 'true';


                                    item.style.display =
                                        unread
                                            ? 'grid'
                                            : 'none';

                                }

                            }
                        );

                    }
                );

            }
        );

    </script>


</body>

</html>