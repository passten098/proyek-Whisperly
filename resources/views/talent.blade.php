<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Talent - Whisperly</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 32px;

            background: #f08baa;
            color: #321b27;

            font-family: Georgia, serif;
        }

        main {
            width: min(850px, 100%);
            margin: 80px auto;
        }

        .eyebrow {
            color: #71364e;

            font: 600 12px Arial, sans-serif;

            letter-spacing: .16em;
            text-transform: uppercase;
        }

        h1 {
            margin: 15px 0 5px;

            font-size: clamp(42px, 7vw, 72px);
            font-weight: 400;

            line-height: 1;
        }

        .subtitle {
            color: #71364e;

            font: 16px Arial, sans-serif;
        }

        .card {
            margin-top: 30px;

            padding: 28px;

            border-radius: 24px;

            background: rgba(255, 255, 255, .85);

            box-shadow:
                0 18px 40px rgba(94, 45, 76, .15);
        }

        .profile {
            display: flex;

            gap: 25px;

            align-items: center;
        }

        .photo {
            width: 120px;
            height: 120px;

            border-radius: 50%;

            object-fit: cover;

            background: #f8dce5;
        }

        .no-photo {
            display: flex;

            align-items: center;
            justify-content: center;

            width: 120px;
            height: 120px;

            border-radius: 50%;

            background: #f8dce5;

            color: #71364e;

            font: 13px Arial;
        }

        .username {
            margin: 0;

            font-size: 28px;
        }

        .description {
            margin-top: 25px;

            color: #71364e;

            font: 16px/1.6 Arial, sans-serif;
        }

        .schedule-title {
            margin-top: 30px;

            font-size: 20px;
        }

        .schedule {
            display: grid;

            gap: 8px;

            margin-top: 15px;
        }

        .slot {
            display: flex;

            justify-content: space-between;
            align-items: center;

            padding: 13px 15px;

            border-radius: 12px;

            background: #f8dce5;

            font-family: Arial, sans-serif;
        }

        .available {
            color: #34734a;
        }

        .unavailable {
            color: #9a5264;
        }

        .booked {
            color: #8a651e;
        }

        .buttons {
            display: flex;

            gap: 12px;

            margin-top: 28px;
        }

        .button {
            display: inline-flex;

            padding: 13px 20px;

            border-radius: 99px;

            color: white;

            background: #321b27;

            text-decoration: none;

            font: 700 14px Arial, sans-serif;
        }

        .button:hover {
            opacity: .85;
        }

        .success {
            margin-bottom: 20px;

            padding: 13px 16px;

            border-radius: 12px;

            background: #dff3e5;

            color: #34734a;

            font: 14px Arial, sans-serif;
        }

        @media (max-width: 600px) {

            body {
                padding: 18px;
            }

            main {
                margin-top: 40px;
            }

            .profile {
                flex-direction: column;

                align-items: flex-start;
            }

            .buttons {
                flex-direction: column;
            }

            .button {
                justify-content: center;
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
            Profil Saya
        </h1>

        <p class="subtitle">
            Kelola profil dan jadwal kamu di Whisperly.
        </p>

        @if(session('status'))
            <div class="success">
                {{ session('status') }}
            </div>
        @endif

        <section class="card">

            <div class="profile">

                @if($talent->photo)

                    <img
                        src="{{ asset('storage/' . $talent->photo) }}"
                        class="photo"
                        alt="Foto profil"
                    >

                @else

                    <div class="no-photo">
                        Belum ada foto
                    </div>

                @endif

                <div>

                    <h2 class="username">
                        {{ ucfirst($talent->pengguna->username) }}
                    </h2>

                    <p class="subtitle">
                        Talent Whisperly
                    </p>

                </div>

            </div>

            <div class="description">

                <strong>Deskripsi</strong>

                <p>
                    {{ $talent->deskripsi }}
                </p>

            </div>

            <h3 class="schedule-title">
                Jadwal Saya
            </h3>

            <div class="schedule">

                @foreach($talent->schedules as $schedule)

                    <div class="slot">

                        <span>
                            {{ substr($schedule->start_time, 0, 5) }}
                            -
                            {{ substr($schedule->end_time, 0, 5) }}
                        </span>

                        <strong class="{{ $schedule->status }}">
                            {{ ucfirst($schedule->status) }}
                        </strong>

                    </div>

                @endforeach

            </div>

            <div class="buttons">

                <a
                    href="{{ route('talent.edit') }}"
                    class="button"
                >
                    ✏️ Edit Profil & Jadwal
                </a>

                <a
                    href="{{ route('whisperly.chat.index') }}"
                    class="button"
                >
                    💬 Chat Masuk
                </a>

            </div>

        </section>

    </main>

</body>

</html>