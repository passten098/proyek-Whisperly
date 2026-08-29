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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 30px;
            background: #f08baa;
            color: #321b27;
            font-family: Georgia, serif;
        }

        main {
            width: min(900px, 100%);
            margin: 60px auto;
        }

        .eyebrow {
            color: #71364e;
            font: 600 12px Arial, sans-serif;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        h1 {
            margin: 14px 0 8px;
            font-size: clamp(42px, 7vw, 72px);
            font-weight: 400;
        }

        .subtitle {
            color: #71364e;
            font: 16px Arial, sans-serif;
        }

        .card {
            margin-top: 30px;
            padding: 30px;
            border-radius: 24px;
            background: rgba(255,255,255,.88);
            box-shadow: 0 20px 45px rgba(94,45,76,.15);
        }

        .profile {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .photo {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            background: #f8dce5;
        }

        .photo-empty {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 140px;
            height: 140px;

            border-radius: 50%;

            background: #f8dce5;
            color: #71364e;

            font: 13px Arial, sans-serif;
            text-align: center;
        }

        .profile-info h2 {
            margin: 0 0 8px;
            font-size: 30px;
        }

        .profile-info p {
            margin: 4px 0;
            color: #71364e;
            font: 14px Arial, sans-serif;
        }

        .description {
            margin-top: 28px;
            padding: 20px;
            border-radius: 16px;
            background: #f8dce5;
            color: #71364e;
            font: 15px/1.6 Arial, sans-serif;
        }

        .schedule-title {
            margin-top: 32px;
            font-size: 25px;
        }

        .schedule {
            display: grid;
            gap: 10px;
            margin-top: 16px;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 15px;

            border-radius: 13px;
            background: #f8dce5;
        }

        .time {
            font: 600 14px Arial, sans-serif;
        }

        .status {
            padding: 8px 12px;
            border-radius: 9px;
            font: 700 12px Arial, sans-serif;
        }

        .available {
            background: #d8f0dc;
            color: #2e6a3b;
        }

        .unavailable {
            background: #ead3dc;
            color: #8a3d59;
        }

        .booked {
            background: #ead8a8;
            color: #765b1d;
        }

        .booking-box {
            margin-top: 35px;
            padding: 24px;

            border-radius: 18px;

            background: #fff;
            border: 1px solid #e7bfd0;
        }

        .booking-box h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .booking-box p {
            color: #71364e;
            font: 14px/1.5 Arial, sans-serif;
        }

        .booking-form {
            margin-top: 20px;
        }

        .booking-form select {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid #e3b5c4;
            border-radius: 12px;

            background: white;

            font: 14px Arial, sans-serif;

            outline: none;
        }

        .booking-form select:focus {
            border-color: #9b536e;
        }

        .confirm-button {
            width: 100%;

            margin-top: 15px;

            padding: 14px 20px;

            border: 0;
            border-radius: 99px;

            background: #321b27;
            color: white;

            font: 700 14px Arial, sans-serif;

            cursor: pointer;

            transition: .2s;
        }

        .confirm-button:hover {
            transform: translateY(-1px);
            background: #512d3e;
        }

        .confirm-button:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .success {
            margin-bottom: 20px;

            padding: 15px 18px;

            border-radius: 13px;

            background: #d8f0dc;
            color: #2e6a3b;

            font: 14px Arial, sans-serif;
        }

        .error {
            margin-bottom: 20px;

            padding: 15px 18px;

            border-radius: 13px;

            background: #f8d6d6;
            color: #8a3333;

            font: 14px Arial, sans-serif;
        }

        .back {
            display: inline-flex;

            margin-top: 20px;

            padding: 12px 18px;

            border-radius: 99px;

            background: #e7bfd0;
            color: #321b27;

            font: 700 13px Arial, sans-serif;

            text-decoration: none;
        }

        @media (max-width: 600px) {

            body {
                padding: 15px;
            }

            main {
                margin-top: 30px;
            }

            .card {
                padding: 20px;
            }

            .profile {
                align-items: flex-start;
                flex-direction: column;
            }

            .schedule-item {
                align-items: flex-start;
                flex-direction: column;
            }
        }

    </style>

</head>


<body>

@include('whisperly.navbar')


<main>

    <div class="eyebrow">
        Whisperly / Talent
    </div>


    <h1>
        {{ ucfirst($talent->pengguna->username) }}
    </h1>


    <p class="subtitle">
        Profil Talent
    </p>


    {{-- ========================================================= --}}
    {{-- PESAN BOOKING BERHASIL --}}
    {{-- ========================================================= --}}

    @if (session('booking_success'))

        <div class="success">

            <strong>Booking berhasil!</strong>

            <br>

            {{ session('status') }}

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- ERROR --}}
    {{-- ========================================================= --}}

    @if ($errors->any())

        <div class="error">

            <strong>Booking gagal:</strong>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <section class="card">


        {{-- ===================================================== --}}
        {{-- PROFIL --}}
        {{-- ===================================================== --}}

        <div class="profile">

            @if ($talent->photo)

                <img
                    class="photo"
                    src="{{ asset('storage/' . $talent->photo) }}"
                    alt="Foto {{ $talent->pengguna->username }}"
                >

            @else

                <div class="photo-empty">

                    Belum ada<br>
                    foto profil

                </div>

            @endif


            <div class="profile-info">

                <h2>
                    {{ ucfirst($talent->pengguna->username) }}
                </h2>

                <p>
                    {{ $talent->pengguna->email }}
                </p>

                <p>
                    Talent Whisperly
                </p>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- DESKRIPSI --}}
        {{-- ===================================================== --}}

        <div class="description">

            {{ $talent->deskripsi ?: 'Talent belum menambahkan deskripsi.' }}

        </div>


        {{-- ===================================================== --}}
        {{-- JADWAL --}}
        {{-- ===================================================== --}}

        <h2 class="schedule-title">
            Jadwal Talent
        </h2>


        <div class="schedule">

            @forelse ($talent->schedules as $schedule)

                <div class="schedule-item">

                    <span class="time">

                        {{ substr($schedule->start_time, 0, 5) }}

                        -

                        {{ substr($schedule->end_time, 0, 5) }}

                    </span>


                    @if ($schedule->status === 'available')

                        <span class="status available">
                            Tersedia
                        </span>

                    @elseif ($schedule->status === 'booked')

                        <span class="status booked">
                            Sudah Dibooking
                        </span>

                    @else

                        <span class="status unavailable">
                            Tidak Tersedia
                        </span>

                    @endif

                </div>

            @empty

                <p>
                    Belum ada jadwal tersedia.
                </p>

            @endforelse

        </div>


        {{-- ===================================================== --}}
        {{-- CONFIRM BOOKING --}}
        {{-- ===================================================== --}}

        @if (
            auth('whisperly')->check() &&
            auth('whisperly')->user()->role === 'user'
        )

            <div class="booking-box">

                <h2>
                    Booking Talent
                </h2>

                <p>
                    Pilih jadwal yang masih tersedia,
                    kemudian tekan Confirm Booking.
                </p>


                <form
                    class="booking-form"
                    method="POST"
                    action="{{ route(
                        'whisperly.bookings.store',
                        ['username' => $talent->pengguna->username]
                    ) }}"
                >

                    @csrf


                    <select
                        name="schedule_id"
                        id="schedule_id"
                        required
                    >

                        <option value="">
                            -- Pilih Jadwal --
                        </option>


                        @foreach ($talent->schedules as $schedule)

                            @if ($schedule->status === 'available')

                                <option
                                    value="{{ $schedule->id }}"
                                >

                                    {{ substr($schedule->start_time, 0, 5) }}
                                    -
                                    {{ substr($schedule->end_time, 0, 5) }}

                                </option>

                            @endif

                        @endforeach

                    </select>


                    <button
                        type="submit"
                        class="confirm-button"
                        id="confirm-button"
                    >
                        Confirm Booking
                    </button>

                </form>

            </div>

        @endif


        <a
            href="{{ route('whisperly.talents.index') }}"
            class="back"
        >
            ← Kembali ke Daftar Talent
        </a>


    </section>

</main>


<script>

    const scheduleSelect =
        document.getElementById('schedule_id');

    const confirmButton =
        document.getElementById('confirm-button');


    if (scheduleSelect && confirmButton) {

        function checkSchedule() {

            confirmButton.disabled =
                scheduleSelect.value === '';

        }


        scheduleSelect.addEventListener(
            'change',
            checkSchedule
        );


        checkSchedule();

    }

</script>


</body>

</html>