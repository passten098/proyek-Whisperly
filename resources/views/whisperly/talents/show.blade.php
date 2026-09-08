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
        }


        /* =========================================================
           ROOT
        ========================================================= */

        :root {

            --blue: #8ecae6;
            --blue-dark: #5aa9d6;
            --blue-soft: #e8f6fc;
            --blue-selected: #d9f0fb;

            --white: #ffffff;
            --page-bg: #f7fbfd;

            --text: #53616b;
            --text-dark: #263943;
            --muted: #8a9aa3;

            --border: #e5eef2;

            /* AVAILABLE */
            --available-bg: #dff3ea;
            --available-text: #438568;
            --available-border: #c5e7d7;

            /* UNAVAILABLE */
            --unavailable-bg: #eeeeef;
            --unavailable-text: #8a9297;
            --unavailable-border: #dedfe1;

            /* BOOKED */
            --booked-bg: #f7dfe2;
            --booked-text: #b35d69;
            --booked-border: #edc4ca;

            /* SUCCESS */
            --success-bg: #e4f5eb;
            --success-text: #3e7958;

            /* ERROR */
            --error-bg: #fbe5e7;
            --error-text: #a94b58;
        }


        /* =========================================================
           BODY
        ========================================================= */

        body {

            margin: 0;

            min-height: 100vh;

            background:
                radial-gradient(
                    circle at 85% 10%,
                    rgba(174, 224, 244, .25),
                    transparent 28%
                ),
                var(--page-bg);

            color: var(--text);

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;
        }


        /* =========================================================
           MAIN
        ========================================================= */

        main {

            width:
                min(1120px, calc(100% - 50px));

            margin:
                0 auto;

            padding:
                120px 0 70px;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .success {

            margin-bottom:
                25px;

            padding:
                15px 18px;

            border:
                1px solid
                #cde9d8;

            border-radius:
                14px;

            background:
                var(--success-bg);

            color:
                var(--success-text);

            font-size:
                13px;

            line-height:
                1.5;
        }


        .error {

            margin-bottom:
                25px;

            padding:
                15px 18px;

            border:
                1px solid
                #efcdd1;

            border-radius:
                14px;

            background:
                var(--error-bg);

            color:
                var(--error-text);

            font-size:
                13px;

            line-height:
                1.5;
        }


        .error ul {

            margin:
                6px 0 0;

            padding-left:
                20px;
        }


        /* =========================================================
           MAIN LAYOUT
           KIRI PROFIL
           KANAN JADWAL
        ========================================================= */

        .profile-layout {

            display:
                grid;

            grid-template-columns:
                330px minmax(0, 1fr);

            gap:
                55px;

            align-items:
                start;
        }


        /* =========================================================
           LEFT — PROFILE
        ========================================================= */

        .profile-column {

            position:
                sticky;

            top:
                105px;

            padding:
                28px;

            border:
                1px solid
                var(--border);

            border-radius:
                24px;

            background:
                rgba(255,255,255,.9);

            box-shadow:
                0 10px 35px
                rgba(67, 121, 145, .07);
        }


        /* =========================================================
           PROFILE PHOTO
        ========================================================= */

        .profile-photo {

            width:
                150px;

            height:
                150px;

            margin:
                0 auto 22px;

            overflow:
                hidden;

            border-radius:
                50%;

            border:
                5px solid
                white;

            background:
                var(--blue-soft);

            box-shadow:
                0 10px 30px
                rgba(73, 147, 183, .16);
        }


        .profile-photo img {

            width:
                100%;

            height:
                100%;

            display:
                block;

            object-fit:
                cover;
        }


        /* =========================================================
           PROFILE NAME
        ========================================================= */

        .profile-info {

            text-align:
                left;
        }


        .profile-name {

            margin:
                0;

            color:
                var(--text-dark);

            font-size:
                26px;

            font-weight:
                700;

            line-height:
                1.2;
        }


        .username {

            margin:
                5px 0 0;

            color:
                var(--muted);

            font-size:
                14px;
        }


        .email {

            margin:
                8px 0 0;

            color:
                var(--muted);

            font-size:
                12.5px;

            word-break:
                break-word;
        }


        /* =========================================================
           DIVIDER
        ========================================================= */

        .profile-divider {

            height:
                1px;

            margin:
                23px 0;

            background:
                var(--border);
        }


        /* =========================================================
           DESCRIPTION
        ========================================================= */

        .description-title {

            margin:
                0 0 10px;

            color:
                var(--text-dark);

            font-size:
                14px;

            font-weight:
                700;
        }


        .description {

            color:
                var(--text);

            font-size:
                13px;

            line-height:
                1.7;

            white-space:
                pre-line;
        }


        /* =========================================================
           RIGHT — SCHEDULE
        ========================================================= */

        .schedule-column {

            min-width:
                0;
        }


        .schedule-header {

            margin-bottom:
                23px;
        }


        .schedule-eyebrow {

            margin:
                0 0 5px;

            color:
                var(--blue-dark);

            font:
                700 11px Arial, sans-serif;

            letter-spacing:
                .12em;

            text-transform:
                uppercase;
        }


        .schedule-title {

            margin:
                0;

            color:
                var(--text-dark);

            font-size:
                30px;

            font-weight:
                700;

            line-height:
                1.2;
        }


        .schedule-subtitle {

            margin:
                7px 0 0;

            color:
                var(--muted);

            font-size:
                13px;

            line-height:
                1.5;
        }


        /* =========================================================
           LEGEND
        ========================================================= */

        .legend {

            display:
                flex;

            flex-wrap:
                wrap;

            gap:
                8px;

            margin-bottom:
                20px;
        }


        .legend-item {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                6px;

            padding:
                6px 10px;

            border-radius:
                999px;

            background:
                white;

            border:
                1px solid
                var(--border);

            color:
                var(--muted);

            font-size:
                10px;

            font-weight:
                600;
        }


        .legend-dot {

            width:
                8px;

            height:
                8px;

            border-radius:
                50%;
        }


        .legend-dot.green {

            background:
                #8bc9aa;
        }


        .legend-dot.gray {

            background:
                #b8bec2;
        }


        .legend-dot.red {

            background:
                #df919b;
        }


        /* =========================================================
           SCHEDULE GRID
           3 KOLOM
        ========================================================= */

        .schedule-grid {

            display:
                grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap:
                13px;
        }


        /* =========================================================
           SCHEDULE BUTTON
        ========================================================= */

        .schedule-button {

            position:
                relative;

            width:
                100%;

            min-height:
                72px;

            padding:
                14px 10px;

            border:
                1px solid
                transparent;

            border-radius:
                17px;

            font:
                700 13px
                "Segoe UI",
                Arial,
                sans-serif;

            transition:
                transform .18s ease,
                box-shadow .18s ease,
                border-color .18s ease,
                background .18s ease;

            user-select:
                none;
        }


        /* =========================================================
           AVAILABLE
        ========================================================= */

        .schedule-button.available {

            background:
                var(--available-bg);

            border-color:
                var(--available-border);

            color:
                var(--available-text);

            cursor:
                pointer;
        }


        /* =========================================================
           UNAVAILABLE
        ========================================================= */

        .schedule-button.unavailable {

            background:
                var(--unavailable-bg);

            border-color:
                var(--unavailable-border);

            color:
                var(--unavailable-text);

            cursor:
                not-allowed;
        }


        /* =========================================================
           BOOKED
        ========================================================= */

        .schedule-button.booked {

            background:
                var(--booked-bg);

            border-color:
                var(--booked-border);

            color:
                var(--booked-text);

            cursor:
                not-allowed;
        }


        /* =========================================================
           HOVER AVAILABLE
        ========================================================= */

        .schedule-button.available:hover {

            transform:
                translateY(-4px);

            background:
                #d4eee3;

            box-shadow:
                0 12px 25px
                rgba(64, 128, 100, .15);
        }


        /* =========================================================
           SELECTED
           EFEK BUTTON TERANGKAT
        ========================================================= */

        .schedule-button.selected {

            transform:
                translateY(-7px);

            background:
                var(--blue-selected);

            border-color:
                var(--blue);

            color:
                #397da5;

            box-shadow:
                0 17px 32px
                rgba(73, 147, 183, .23);

        }


        .schedule-button.selected::after {

            content:
                "✓";

            position:
                absolute;

            top:
                -7px;

            right:
                -7px;

            width:
                22px;

            height:
                22px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                50%;

            background:
                var(--blue-dark);

            color:
                white;

            font-size:
                11px;

            box-shadow:
                0 5px 12px
                rgba(73,147,183,.25);
        }


        /* =========================================================
           EMPTY
        ========================================================= */

        .schedule-empty {

            grid-column:
                1 / -1;

            padding:
                25px;

            border:
                1px dashed
                #d8e4e9;

            border-radius:
                17px;

            background:
                white;

            color:
                var(--muted);

            text-align:
                center;

            font-size:
                13px;
        }


        /* =========================================================
           BOOKING AREA
        ========================================================= */

        .booking-area {

            margin-top:
                25px;

            padding:
                18px;

            border:
                1px solid
                #dcecf3;

            border-radius:
                20px;

            background:
                white;

            box-shadow:
                0 10px 30px
                rgba(67,121,145,.07);

            opacity:
                0;

            transform:
                translateY(10px);

            pointer-events:
                none;

            transition:
                opacity .22s ease,
                transform .22s ease;
        }


        .booking-area.show {

            opacity:
                1;

            transform:
                translateY(0);

            pointer-events:
                auto;
        }


        .booking-selected {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                15px;

            margin-bottom:
                15px;
        }


        .booking-label {

            color:
                var(--muted);

            font-size:
                11px;
        }


        .booking-time {

            margin-top:
                3px;

            color:
                var(--text-dark);

            font-size:
                18px;

            font-weight:
                700;
        }


        /* =========================================================
           CONFIRM BUTTON
        ========================================================= */

        .confirm-button {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            min-height:
                45px;

            padding:
                0 22px;

            border:
                0;

            border-radius:
                999px;

            background:
                var(--blue-dark);

            color:
                white;

            font:
                700 12px
                Arial,
                sans-serif;

            cursor:
                pointer;

            box-shadow:
                0 8px 18px
                rgba(73,147,183,.22);

            transition:
                transform .18s ease,
                background .18s ease,
                box-shadow .18s ease;
        }


        .confirm-button:hover {

            background:
                #4d99c5;

            transform:
                translateY(-3px);

            box-shadow:
                0 12px 24px
                rgba(73,147,183,.28);
        }


        /* =========================================================
           BACK
        ========================================================= */

        .back-wrapper {

            margin-top:
                35px;
        }


        .back {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                7px;

            padding:
                10px 15px;

            border:
                1px solid
                var(--border);

            border-radius:
                999px;

            background:
                white;

            color:
                #6f8792;

            font:
                700 11px
                Arial,
                sans-serif;

            text-decoration:
                none;

            transition:
                .18s ease;
        }


        .back:hover {

            color:
                var(--blue-dark);

            border-color:
                #cce5f0;

            transform:
                translateX(-3px);

            box-shadow:
                0 7px 18px
                rgba(67,121,145,.08);
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 850px) {

            main {

                width:
                    calc(100% - 30px);

                padding-top:
                    105px;
            }


            .profile-layout {

                grid-template-columns:
                    280px minmax(0, 1fr);

                gap:
                    30px;
            }


            .profile-column {

                padding:
                    23px;
            }


            .profile-photo {

                width:
                    130px;

                height:
                    130px;
            }


            .schedule-grid {

                gap:
                    10px;
            }


            .schedule-button {

                min-height:
                    66px;
            }

        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 700px) {

            main {

                width:
                    calc(100% - 24px);

                padding:
                    95px 0 45px;
            }


            .profile-layout {

                grid-template-columns:
                    1fr;

                gap:
                    30px;
            }


            .profile-column {

                position:
                    static;

                width:
                    100%;
            }


            .profile-info {

                text-align:
                    center;
            }


            .description-wrapper {

                text-align:
                    left;
            }


            .schedule-column {

                width:
                    100%;
            }


            .schedule-title {

                font-size:
                    26px;
            }


            .schedule-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            .booking-selected {

                align-items:
                    flex-start;

                flex-direction:
                    column;
            }


            .confirm-button {

                width:
                    100%;
            }


            .back-wrapper {

                text-align:
                    center;
            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================= */

        @media (max-width: 420px) {

            .schedule-grid {

                grid-template-columns:
                    1fr;
            }


            .legend {

                gap:
                    5px;
            }


            .legend-item {

                font-size:
                    9px;
            }

        }

    </style>

</head>


<body>


@include('whisperly.navbar')


<main>


    {{-- =========================================================
         SUCCESS
    ========================================================== --}}

    @if (session('booking_success'))

        <div class="success">

            <strong>
                Booking berhasil!
            </strong>

            <br>

            {{ session('status') }}

        </div>

    @endif


    {{-- =========================================================
         ERROR
    ========================================================== --}}

    @if ($errors->any())

        <div class="error">

            <strong>
                Terjadi kesalahan:
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


    {{-- =========================================================
         LAYOUT UTAMA
    ========================================================== --}}

    <div class="profile-layout">


        {{-- =====================================================
             KIRI — PROFIL TALENT
        ====================================================== --}}

        <section class="profile-column">


            {{-- FOTO --}}

            <div class="profile-photo">

                @if ($talent->photo)

                    <img
                        src="{{ asset('storage/' . $talent->photo) }}"
                        alt="Foto {{ $talent->pengguna->username }}"
                    >

                @else

                    @php

                        $faceNumber =
                            (abs(crc32($talent->pengguna->username)) % 8) + 1;

                    @endphp

                    <img
                        src="{{ asset('assets/images/faces/' . $faceNumber . '.jpg') }}"
                        alt="Foto {{ $talent->pengguna->username }}"
                    >

                @endif

            </div>


            {{-- INFORMASI PROFIL --}}

            <div class="profile-info">

                <h1 class="profile-name">

                    {{ ucfirst($talent->pengguna->username) }}

                </h1>



                <p class="email">

                    {{ $talent->pengguna->email }}

                </p>


                <div class="profile-divider"></div>


                {{-- DESKRIPSI --}}

                <div class="description-wrapper">

                    <h2 class="description-title">

                        Tentang Talent

                    </h2>


                    <div class="description">

                        {{ $talent->deskripsi ?: 'Talent belum menambahkan deskripsi.' }}

                    </div>

                </div>

            </div>


        </section>


        {{-- =====================================================
             KANAN — JADWAL
        ====================================================== --}}

        <section class="schedule-column">


            <div class="schedule-header">

                <p class="schedule-eyebrow">
                    Whisperly
                </p>

                <h2 class="schedule-title">
                    Pilih Waktu
                </h2>

                <p class="schedule-subtitle">
                    Pilih salah satu waktu yang tersedia untuk melakukan booking.
                </p>

            </div>


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

                    Sudah dibooking

                </div>

            </div>


            {{-- =================================================
                 JADWAL
            ================================================== --}}

            <div class="schedule-grid">


                @forelse ($talent->schedules as $schedule)

                    @php
                        $status = $schedule->resolveStatusForDate(now(config('app.timezone'))->toDateString());
                        $isAvailable = $status === 'available';
                        $isBooked = $status === 'booked';
                        $statusClass = $isAvailable ? 'available' : ($isBooked ? 'booked' : 'unavailable');
                    @endphp

                    <button
                        type="button"
                        class="schedule-button {{ $statusClass }}"
                        data-schedule-id="{{ $schedule->id }}"
                        data-start="{{ substr($schedule->start_time, 0, 5) }}"
                        data-end="{{ substr($schedule->end_time, 0, 5) }}"
                        {{ !$isAvailable ? 'disabled' : '' }}
                    >

                        {{ substr($schedule->start_time, 0, 5) }}

                        –

                        {{ substr($schedule->end_time, 0, 5) }}

                    </button>


                @empty


                    <div class="schedule-empty">

                        Belum ada jadwal yang tersedia.

                    </div>


                @endforelse


            </div>


            {{-- =================================================
                 BOOKING
            ================================================== --}}

            @if (
                auth('whisperly')->check() &&
                auth('whisperly')->user()->role === 'user'
            )


                <div
                    class="booking-area"
                    id="bookingArea"
                >


                    <div class="booking-selected">


                        <div>

                            <div class="booking-label">
                                Jadwal yang dipilih
                            </div>


                            <div
                                class="booking-time"
                                id="bookingTime"
                            >
                                -
                            </div>

                        </div>


                        <form
                            method="POST"
                            action="{{ route(
                                'whisperly.bookings.store',
                                [
                                    'username' =>
                                    $talent->pengguna->username
                                ]
                            ) }}"
                            id="bookingForm"
                        >

                            @csrf


                            <input
                                type="hidden"
                                name="schedule_id"
                                id="schedule_id"
                                value=""
                            >


                            <button
                                type="submit"
                                class="confirm-button"
                            >

                                ✓ Confirm Booking

                            </button>

                        </form>


                    </div>


                </div>


            @endif


        </section>


    </div>


    {{-- =========================================================
         BACK
    ========================================================== --}}

    <div class="back-wrapper">

        <a
            href="{{ route('whisperly.talents.index') }}"
            class="back"
        >

            ← Kembali ke Daftar Talent

        </a>

    </div>


</main>


<script>

    /*
    |--------------------------------------------------------------------------
    | PILIH JADWAL
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const scheduleButtons =
                document.querySelectorAll(
                    '.schedule-button.available'
                );


            const scheduleInput =
                document.getElementById(
                    'schedule_id'
                );


            const bookingArea =
                document.getElementById(
                    'bookingArea'
                );


            const bookingTime =
                document.getElementById(
                    'bookingTime'
                );


            scheduleButtons.forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function () {


                            /*
                            |--------------------------------------------------
                            | HAPUS SELECTION SEBELUMNYA
                            |--------------------------------------------------
                            */

                            scheduleButtons.forEach(
                                function (item) {

                                    item.classList.remove(
                                        'selected'
                                    );

                                }
                            );


                            /*
                            |--------------------------------------------------
                            | PILIH BUTTON
                            |--------------------------------------------------
                            */

                            button.classList.add(
                                'selected'
                            );


                            /*
                            |--------------------------------------------------
                            | AMBIL DATA
                            |--------------------------------------------------
                            */

                            const scheduleId =
                                button.dataset.scheduleId;


                            const start =
                                button.dataset.start;


                            const end =
                                button.dataset.end;


                            /*
                            |--------------------------------------------------
                            | MASUKKAN ID KE FORM
                            |--------------------------------------------------
                            */

                            if (scheduleInput) {

                                scheduleInput.value =
                                    scheduleId;

                            }


                            /*
                            |--------------------------------------------------
                            | TAMPILKAN JAM
                            |--------------------------------------------------
                            */

                            if (bookingTime) {

                                bookingTime.textContent =
                                    start + ' – ' + end;

                            }


                            /*
                            |--------------------------------------------------
                            | TAMPILKAN CONFIRM BOOKING
                            |--------------------------------------------------
                            */

                            if (bookingArea) {

                                bookingArea.classList.add(
                                    'show'
                                );

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