<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Edit Profil - Whisperly
    </title>


    <style>

        * {
            box-sizing: border-box;
        }


        :root {

            --green: #78a987;
            --green-dark: #557d62;
            --green-soft: #e8f3e9;

            --pink: #f8e4e9;
            --pink-dark: #c9899d;

            --cream: #fffaf5;

            --text: #53615a;
            --muted: #89958e;

            --white: #ffffff;
        }


        body {

            margin: 0;

            min-height: 100vh;

            background:
                radial-gradient(
                    circle at 85% 10%,
                    rgba(255,255,255,.8),
                    transparent 25%
                ),
                var(--cream);

            color: var(--text);

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;
        }


        main {

            width:
                min(1100px, calc(100% - 50px));

            margin:
                0 auto;

            padding:
                130px 0 70px;
        }


        .heading {

            margin-bottom: 30px;
        }


        .eyebrow {

            margin: 0 0 7px;

            color: var(--green);

            font:
                700 11px Arial, sans-serif;

            letter-spacing: .15em;

            text-transform: uppercase;
        }


        h1 {

            margin: 0;

            color: var(--green-dark);

            font-family:
                Georgia,
                serif;

            font-size:
                clamp(38px, 6vw, 60px);

            font-weight: 400;
        }


        .subtitle {

            margin: 10px 0 0;

            color: var(--muted);

            font-size: 14px;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .success {

            margin-bottom: 22px;

            padding: 14px 18px;

            border-radius: 15px;

            background: var(--green-soft);

            color: var(--green-dark);

            font-size: 13px;
        }


        .error {

            margin-bottom: 22px;

            padding: 14px 18px;

            border-radius: 15px;

            background: #fbe1e1;

            color: #a13a3a;

            font-size: 13px;
        }


        .error ul {

            margin: 5px 0 0;

            padding-left: 18px;
        }


        /* =========================================================
           LAYOUT
        ========================================================= */

        .edit-layout {

            display: grid;

            grid-template-columns:
                330px 1fr;

            gap: 35px;

            align-items: start;
        }


        /* =========================================================
           PHOTO PANEL
        ========================================================= */

        .photo-panel {

            padding: 24px;

            border-radius: 28px;

            background: var(--white);

            box-shadow:
                0 18px 45px
                rgba(84, 108, 91, .10);

            text-align: center;
        }


        .photo-preview {

            width: 220px;

            height: 220px;

            margin: 0 auto 20px;

            overflow: hidden;

            border-radius: 50%;

            background: var(--pink);

            box-shadow:
                0 12px 30px
                rgba(84,108,91,.13);
        }


        .photo-preview img {

            width: 100%;

            height: 100%;

            display: block;

            object-fit: cover;
        }


        .photo-title {

            margin: 0;

            color: var(--green-dark);

            font-family:
                Georgia,
                serif;

            font-size: 22px;
        }


        .photo-help {

            margin: 7px 0 18px;

            color: var(--muted);

            font-size: 12px;

            line-height: 1.5;
        }


        .file-input {

            width: 100%;

            padding: 11px;

            border:
                1px dashed
                #b7cdbc;

            border-radius: 13px;

            background: #f7fbf7;

            color: var(--text);

            font-size: 12px;

            cursor: pointer;
        }


        /* =========================================================
           FORM PANEL
        ========================================================= */

        .form-panel {

            padding: 30px;

            border-radius: 28px;

            background: var(--white);

            box-shadow:
                0 18px 45px
                rgba(84,108,91,.10);
        }


        .form-title {

            margin: 0 0 20px;

            color: var(--green-dark);

            font-family:
                Georgia,
                serif;

            font-size: 26px;

            font-weight: 400;
        }


        .field {

            margin-bottom: 20px;
        }


        label {

            display: block;

            margin-bottom: 7px;

            color: var(--green-dark);

            font:
                700 12px Arial, sans-serif;
        }


        input[type="text"],
        input[type="email"],
        textarea {

            width: 100%;

            padding: 13px 15px;

            border:
                1px solid
                #d9e5dc;

            border-radius: 13px;

            outline: none;

            background: #fbfdfb;

            color: var(--text);

            font:
                13px
                "Segoe UI",
                Arial,
                sans-serif;

            transition: .2s ease;
        }


        textarea {

            min-height: 130px;

            resize: vertical;

            line-height: 1.6;
        }


        input:focus,
        textarea:focus {

            border-color:
                var(--green);

            box-shadow:
                0 0 0 3px
                rgba(120,169,135,.12);
        }


        .readonly {

            background: #f4f6f4;

            color: #8b958f;

            cursor: not-allowed;
        }


        .char-info {

            margin-top: 6px;

            text-align: right;

            color: var(--muted);

            font-size: 11px;
        }


        /* =========================================================
           SCHEDULE
        ========================================================= */

        .schedule-title {

            margin:
                30px 0 5px;

            color: var(--green-dark);

            font-family:
                Georgia,
                serif;

            font-size:
                23px;

            font-weight: 400;
        }


        .schedule-subtitle {

            margin:
                0 0 15px;

            color:
                var(--muted);

            font-size:
                12px;
        }


        .schedule {

            display:
                grid;

            gap:
                9px;
        }


        .schedule-row {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                12px;

            padding:
                12px 14px;

            border-radius:
                14px;

            background:
                #f7faf7;
        }


        .schedule-time {

            color:
                var(--green-dark);

            font:
                700 12px Arial, sans-serif;
        }


        .schedule-row select {

            min-width:
                150px;

            padding:
                8px 10px;

            border:
                1px solid
                #d9e5dc;

            border-radius:
                999px;

            background:
                white;

            color:
                var(--text);

            font-size:
                12px;

            outline:
                none;
        }


        .schedule-row select:focus {

            border-color:
                var(--green);
        }


        .schedule-row.booked {

            opacity:
                .65;
        }


        .booked-label {

            padding:
                6px 10px;

            border-radius:
                999px;

            background:
                #f3e3c2;

            color:
                #7a5a1d;

            font:
                700 10px Arial, sans-serif;
        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .actions {

            display:
                flex;

            justify-content:
                flex-end;

            gap:
                10px;

            margin-top:
                28px;

            padding-top:
                20px;

            border-top:
                1px solid
                #edf1ed;
        }


        .button {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            min-height:
                44px;

            padding:
                0 20px;

            border-radius:
                999px;

            text-decoration:
                none;

            font:
                700 12px Arial, sans-serif;

            cursor:
                pointer;

            transition:
                .2s ease;
        }


        .button-back {

            border:
                1px solid
                #dbe4dd;

            background:
                white;

            color:
                var(--green-dark);
        }


        .button-save {

            border:
                0;

            background:
                var(--green);

            color:
                white;
        }


        .button:hover {

            transform:
                translateY(-2px);
        }


        .button-save:hover {

            background:
                var(--green-dark);

            box-shadow:
                0 8px 20px
                rgba(85,125,98,.18);
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 800px) {

            main {

                width:
                    calc(100% - 28px);

                padding-top:
                    110px;
            }


            .edit-layout {

                grid-template-columns:
                    1fr;
            }


            .photo-panel {

                max-width:
                    430px;

                width:
                    100%;

                margin:
                    0 auto;
            }

        }


        @media (max-width: 550px) {

            .form-panel,
            .photo-panel {

                padding:
                    20px;

                border-radius:
                    22px;
            }


            .photo-preview {

                width:
                    180px;

                height:
                    180px;
            }


            .schedule-row {

                align-items:
                    flex-start;

                flex-direction:
                    column;
            }


            .schedule-row select {

                width:
                    100%;
            }


            .actions {

                flex-direction:
                    column;
            }


            .button {

                width:
                    100%;
            }

        }

    </style>

</head>


<body>


@include('whisperly.navbar')


<main>


    {{-- =====================================================
         HEADING
    ====================================================== --}}

    <section class="heading">

        <p class="eyebrow">
            Whisperly / Talent
        </p>

        <h1>
            Edit Profil Talent
        </h1>

        <p class="subtitle">
            Kelola informasi profil dan jadwal ketersediaan kamu.
        </p>

    </section>


    {{-- =====================================================
         SUCCESS MESSAGE
    ====================================================== --}}

    @if (session('status'))

        <div class="success">

            {{ session('status') }}

        </div>

    @endif


    {{-- =====================================================
         VALIDATION ERROR
    ====================================================== --}}

    @if ($errors->any())

        <div class="error">

            <strong>
                Periksa kembali data kamu:
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


    {{-- =====================================================
         FORM UPDATE
         PENTING:
         POST + @method('PUT')
    ====================================================== --}}

    <form
        action="{{ route('talent.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        {{-- Laravel akan mengubah POST menjadi PUT --}}
        @method('PUT')


        <div class="edit-layout">


            {{-- =================================================
                 FOTO PROFIL
            ================================================== --}}

            <section class="photo-panel">


                <div class="photo-preview">

                    @if ($talent->photo)

                        <img
                            id="photoPreview"
                            src="{{ asset('storage/' . $talent->photo) }}"
                            alt="Foto profil {{ $user->username }}"
                        >

                    @else

                        @php

                            $faceNumber =
                                (abs(crc32($user->username)) % 8) + 1;

                        @endphp

                        <img
                            id="photoPreview"
                            src="{{ asset('assets/images/faces/' . $faceNumber . '.jpg') }}"
                            alt="Foto profil {{ $user->username }}"
                        >

                    @endif

                </div>


                <h2 class="photo-title">
                    Foto Profil
                </h2>


                <p class="photo-help">

                    Pilih foto yang ingin digunakan
                    sebagai foto profil kamu.

                    <br>

                    JPG, PNG, atau WEBP.
                    Maksimal 2 MB.

                </p>


                <input
                    type="file"
                    name="photo"
                    id="photo"
                    class="file-input"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                >


            </section>


            {{-- =================================================
                 DATA PROFIL
            ================================================== --}}

            <section class="form-panel">


                <h2 class="form-title">
                    Profil Kamu
                </h2>


                {{-- USERNAME --}}

                <div class="field">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        value="{{ $user->username }}"
                        class="readonly"
                        readonly
                    >

                </div>


                {{-- EMAIL --}}

                <div class="field">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        value="{{ $user->email }}"
                        class="readonly"
                        readonly
                    >

                </div>


                {{-- DESKRIPSI --}}

                <div class="field">

                    <label for="description">
                        Deskripsi Diri
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        maxlength="2000"
                        required
                    >{{ old('description', $talent->deskripsi ?? '') }}</textarea>


                    <div class="char-info">

                        <span id="charCount">
                            {{ strlen(old('description', $talent->deskripsi ?? '')) }}
                        </span>

                        / 2000

                    </div>

                </div>


                {{-- =================================================
                     JADWAL
                ================================================== --}}

                <h2 class="schedule-title">
                    Atur Jadwal Ketersediaan
                </h2>


                <p class="schedule-subtitle">
                    Atur kapan kamu tersedia untuk di-booking oleh user.
                </p>


                <div class="schedule">


                    @forelse ($talent->schedules as $schedule)


                        <div
                            class="
                                schedule-row
                                {{ $schedule->status === 'booked' ? 'booked' : '' }}
                            "
                        >


                            <span class="schedule-time">

                                {{ substr($schedule->start_time, 0, 5) }}

                                –

                                {{ substr($schedule->end_time, 0, 5) }}

                            </span>


                            @if ($schedule->status === 'booked')


                                <span class="booked-label">
                                    Sudah Dibooking
                                </span>


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


                    @empty


                        <div class="schedule-row">

                            <span class="schedule-time">
                                Belum ada jadwal.
                            </span>

                        </div>


                    @endforelse


                </div>


                {{-- =================================================
                     ACTION
                ================================================== --}}

                <div class="actions">


                    <a
                        href="{{ route('whisperly.home') }}"
                        class="button button-back"
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="button button-save"
                    >
                        Simpan Perubahan
                    </button>


                </div>


            </section>


        </div>


    </form>


</main>


<script>

    /* =========================================================
       PREVIEW FOTO SEBELUM DISIMPAN
    ========================================================= */

    const photoInput =
        document.getElementById('photo');

    const photoPreview =
        document.getElementById('photoPreview');


    if (photoInput && photoPreview) {

        photoInput.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];


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
       CHARACTER COUNTER
    ========================================================= */

    const description =
        document.getElementById('description');

    const charCount =
        document.getElementById('charCount');


    if (description && charCount) {

        description.addEventListener(
            'input',
            function () {

                charCount.textContent =
                    this.value.length;

            }
        );

    }

</script>


</body>

</html>