<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
<label for="username">Username</label>

<input
    type="text"
    id="username"
    name="username"
    value="{{ old('username', $user->username) }}"
    required
>

<label for="email">Email</label>

<input
    type="email"
    id="email"
    name="email"
    value="{{ old('email', $user->email) }}"
    required
>
    <title>Edit Profil Talent - Whisperly</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f08baa;
            color: #321b27;
            font-family: Georgia, serif;
            padding: 30px;
        }

        main {
            width: min(900px, 100%);
            margin: 40px auto;
        }

        .eyebrow {
            color: #71364e;
            font: 600 12px Arial, sans-serif;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        h1 {
            margin: 12px 0 8px;
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
            background: rgba(255,255,255,.86);
            box-shadow: 0 20px 45px rgba(94,45,76,.15);
        }

        .profile {
            display: flex;
            gap: 25px;
            align-items: center;
            margin-bottom: 30px;
        }

        .photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            background: #f8dce5;
        }

        .photo-empty {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #f8dce5;
            color: #71364e;
            font: 13px Arial, sans-serif;
            text-align: center;
        }

        .profile-info h2 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .profile-info p {
            margin: 0;
            color: #71364e;
            font: 14px Arial, sans-serif;
        }

        label {
            display: block;
            margin: 22px 0 8px;
            font: 700 14px Arial, sans-serif;
        }

        textarea {
            width: 100%;
            min-height: 130px;
            padding: 14px;
            resize: vertical;
            border: 1px solid #e3b5c4;
            border-radius: 14px;
            outline: none;
            font: 15px Arial, sans-serif;
        }

        textarea:focus {
            border-color: #9b536e;
        }

        input[type="file"] {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #e3b5c4;
            background: #fff;
        }

        .schedule-title {
            margin-top: 32px;
            font-size: 25px;
        }

        .schedule {
            display: grid;
            gap: 10px;
            margin-top: 15px;
        }

        .slot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 14px 16px;
            border-radius: 13px;
            background: #f8dce5;
        }

        .time {
            font: 600 14px Arial, sans-serif;
        }

        select {
            padding: 9px 12px;
            border: 0;
            border-radius: 9px;
            background: white;
            font: 14px Arial, sans-serif;
        }

        .booked-label {
            padding: 8px 12px;
            border-radius: 9px;
            background: #ead8a8;
            color: #765b1d;
            font: 700 13px Arial, sans-serif;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 22px;
            border: 0;
            border-radius: 99px;
            background: #321b27;
            color: white;
            font: 700 14px Arial, sans-serif;
            text-decoration: none;
            cursor: pointer;
        }

        .button.secondary {
            background: #e7bfd0;
            color: #321b27;
        }

        .success {
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 12px;
            background: #d8f0dc;
            color: #2e6a3b;
            font: 14px Arial, sans-serif;
        }

        .error {
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 12px;
            background: #f8d6d6;
            color: #8a3333;
            font: 14px Arial, sans-serif;
        }

        @media (max-width: 600px) {

            body {
                padding: 15px;
            }

            .card {
                padding: 20px;
            }

            .profile {
                align-items: flex-start;
                flex-direction: column;
            }

            .slot {
                align-items: flex-start;
                flex-direction: column;
            }

            select {
                width: 100%;
            }

            .actions {
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

    <h1>Edit Profil</h1>

    <p class="subtitle">
        Kelola profil dan jadwal kamu sebagai talent.
    </p>

    @if (session('status'))
        <div class="success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="error">
            <strong>Ada yang perlu diperbaiki:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('talent.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')

        <section class="card">

            <div class="profile">

                @if ($talent->photo)

                    <img
                        class="photo"
                        src="{{ asset('storage/' . $talent->photo) }}"
                        alt="Foto profil"
                    >

                @else

                    <div class="photo-empty">
                        Belum ada<br>foto
                    </div>

                @endif

                <div class="profile-info">

                    <h2>
                        {{ ucfirst($user->username) }}
                    </h2>

                    <p>
                        {{ $user->email }}
                    </p>

                    <p>
                        Talent Whisperly
                    </p>

                </div>

            </div>

            <label for="photo">
                Foto Profil
            </label>

            <input
                type="file"
                id="photo"
                name="photo"
                accept="image/png,image/jpeg,image/webp"
            >

            <label for="description">
                Deskripsi Talent
            </label>

            <textarea
                id="description"
                name="description"
                placeholder="Ceritakan tentang dirimu sebagai talent..."
            >{{ old('description', $talent->deskripsi) }}</textarea>


            <h2 class="schedule-title">
                Jadwal Ketersediaan
            </h2>

            <p class="subtitle">
                Atur waktu kapan kamu tersedia untuk menerima booking.
            </p>

            <div class="schedule">

                @foreach ($talent->schedules as $schedule)

                    <div class="slot">

                        <span class="time">
                            {{ substr($schedule->start_time, 0, 5) }}
                            -
                            {{ substr($schedule->end_time, 0, 5) }}
                        </span>

                        @if ($schedule->status === 'booked')

                            <span class="booked-label">
                                Sudah Dibooking
                            </span>

                            <input
                                type="hidden"
                                name="schedule[{{ $schedule->id }}]"
                                value="booked"
                            >

                        @else

                            <select
                                name="schedule[{{ $schedule->id }}]"
                            >

                                <option
                                    value="available"
                                    {{ $schedule->status === 'available' ? 'selected' : '' }}
                                >
                                    Tersedia
                                </option>

                                <option
                                    value="unavailable"
                                    {{ $schedule->status === 'unavailable' ? 'selected' : '' }}
                                >
                                    Tidak Tersedia
                                </option>

                            </select>

                        @endif

                    </div>

                @endforeach

            </div>

            <div class="actions">

                <button
                    type="submit"
                    class="button"
                >
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('talent') }}"
                    class="button secondary"
                >
                    Kembali
                </a>

            </div>

        </section>

    </form>

</main>

</body>
</html>