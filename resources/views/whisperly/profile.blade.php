<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>Profil Talent | Whisperly</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        /* =========================================================
           ROOT
        ========================================================= */

        :root {

            --bg-dark: #11101f;
            --bg-soft: #1b1930;

            --white: #ffffff;
            --text-main: #f5f3ff;
            --text-soft: #b9b4cc;
            --text-muted: #88829d;

            --purple: #a78bfa;
            --purple-soft: #c4b5fd;
            --purple-dark: #7c3aed;

            --pink: #f0abfc;

            --border: rgba(255,255,255,.10);
            --border-soft: rgba(255,255,255,.06);

            --shadow:
                0 30px 80px rgba(0,0,0,.35);

            --radius-lg: 28px;
            --radius-md: 20px;
            --radius-sm: 14px;

        }


        /* =========================================================
           RESET
        ========================================================= */

        * {

            box-sizing: border-box;

            margin: 0;

            padding: 0;

        }

        html {

            scroll-behavior: smooth;

        }

        body {

            min-height: 100vh;

            font-family:
                'Plus Jakarta Sans',
                sans-serif;

            color: var(--text-main);

            background:
                radial-gradient(
                    circle at 15% 15%,
                    rgba(124,58,237,.20),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 85% 20%,
                    rgba(240,171,252,.12),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 50% 100%,
                    rgba(167,139,250,.10),
                    transparent 35%
                ),
                var(--bg-dark);

            overflow-x: hidden;

        }


        /* =========================================================
           AURORA
        ========================================================= */

        body::before {

            content: "";

            position: fixed;

            inset: 0;

            pointer-events: none;

            background:
                linear-gradient(
                    120deg,
                    transparent 0%,
                    rgba(167,139,250,.035) 40%,
                    transparent 70%
                );

            z-index: -1;

        }


        /* =========================================================
           CONTAINER
        ========================================================= */

        .profile-container {

            width:
                min(
                    calc(100% - 40px),
                    820px
                );

            margin: 0 auto;

            padding:
                60px 0
                80px;

        }


        /* =========================================================
           HEADER
        ========================================================= */

        .profile-header {

            text-align: center;

            margin-bottom: 34px;

        }

        .profile-badge {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                8px 14px;

            margin-bottom: 18px;

            border:
                1px solid
                rgba(167,139,250,.22);

            border-radius: 999px;

            background:
                rgba(167,139,250,.08);

            color:
                var(--purple-soft);

            font-size: 11px;

            font-weight: 800;

            letter-spacing: .13em;

            text-transform: uppercase;

        }

        .profile-badge::before {

            content: "";

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background:
                var(--purple);

            box-shadow:
                0 0 12px
                rgba(167,139,250,.65);

        }

        .profile-title {

            font-family:
                'Playfair Display',
                serif;

            font-size:
                clamp(38px, 6vw, 56px);

            line-height: 1.05;

            font-weight: 600;

            letter-spacing: -.025em;

            margin-bottom: 12px;

        }

        .profile-subtitle {

            max-width: 560px;

            margin: 0 auto;

            color:
                var(--text-soft);

            font-size: 14px;

            line-height: 1.8;

        }


        /* =========================================================
           PROFILE CARD
        ========================================================= */

        .profile-card {

            position: relative;

            padding: 34px;

            border:
                1px solid
                var(--border);

            border-radius:
                var(--radius-lg);

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.075),
                    rgba(255,255,255,.035)
                );

            box-shadow:
                var(--shadow);

            backdrop-filter:
                blur(22px);

            -webkit-backdrop-filter:
                blur(22px);

            overflow: hidden;

        }

        .profile-card::before {

            content: "";

            position: absolute;

            width: 260px;

            height: 260px;

            top: -140px;

            right: -100px;

            border-radius: 50%;

            background:
                rgba(167,139,250,.08);

            filter:
                blur(30px);

            pointer-events: none;

        }


        /* =========================================================
           AVATAR SECTION
        ========================================================= */

        .avatar-section {

            display: flex;

            flex-direction: column;

            align-items: center;

            text-align: center;

            padding-bottom: 12px;

            margin-bottom: 0;

            border-bottom:
                1px solid
                var(--border-soft);

        }


        /* =========================================================
           AVATAR
        ========================================================= */

        .avatar-wrapper {

            position: relative;

            width: 138px;

            height: 138px;

            margin-bottom: 18px;

            cursor: pointer;

        }

        .avatar {

            width: 100%;

            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

            border-radius: 50%;

            border:
                2px solid
                rgba(255,255,255,.15);

            background:
                linear-gradient(
                    145deg,
                    rgba(167,139,250,.20),
                    rgba(124,58,237,.12)
                );

            box-shadow:
                0 18px 45px
                rgba(0,0,0,.28);

            color:
                var(--purple-soft);

            font-size: 42px;

            font-weight: 800;

        }

        .avatar img {

            width: 100%;

            height: 100%;

            object-fit: cover;

            display: block;

        }

        .avatar-overlay {

            position: absolute;

            inset: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                rgba(17,16,31,.68);

            color: white;

            font-size: 12px;

            font-weight: 700;

            opacity: 0;

            transition:
                opacity .2s ease;

        }

        .avatar-wrapper:hover
        .avatar-overlay {

            opacity: 1;

        }

        .avatar-edit-badge {

            position: absolute;

            right: 2px;

            bottom: 4px;

            width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            border:
                3px solid
                var(--bg-dark);

            background:
                var(--purple-dark);

            color: white;

            font-size: 14px;

            box-shadow:
                0 8px 20px
                rgba(124,58,237,.35);

        }

        .avatar-name {

            font-size: 18px;

            font-weight: 800;

            margin-bottom: 5px;

        }

        .avatar-role {

            color:
                var(--purple-soft);

            font-size: 12px;

            font-weight: 700;

            letter-spacing: .08em;

            text-transform: uppercase;

        }


        /* =========================================================
           PHOTO ACTIONS
        ========================================================= */

        .photo-actions {

            display: flex;

            align-items: center;

            justify-content: center;

            flex-wrap: wrap;

            gap: 10px;

            margin-top: 14px;

        }

        .photo-button {

            border: 0;

            padding:
                10px 16px;

            border-radius:
                12px;

            font-family:
                inherit;

            font-size: 12px;

            font-weight: 700;

            cursor: pointer;

            transition:
                transform .2s ease,
                background .2s ease,
                border-color .2s ease;

        }

        .photo-button:hover {

            transform:
                translateY(-2px);

        }

        .photo-button.primary {

            background:
                rgba(167,139,250,.14);

            border:
                1px solid
                rgba(167,139,250,.20);

            color:
                var(--purple-soft);

        }

        .photo-button.primary:hover {

            background:
                rgba(167,139,250,.20);

        }

        .photo-button.danger {

            background:
                rgba(248,113,113,.08);

            border:
                1px solid
                rgba(248,113,113,.15);

            color:
                #fca5a5;

        }

        .photo-button.danger:hover {

            background:
                rgba(248,113,113,.14);

        }


        /* =========================================================
           FILE INPUT
        ========================================================= */

        #photoInput {

            display: none;

        }


        /* =========================================================
           STATUS
        ========================================================= */

        .status-message {

            display: none;

            margin-top: 8px;

            color:
                var(--text-muted);

            font-size: 11px;

            line-height: 1.4;

        }

        .status-message:not(:empty) {

            display: block;

        }

        .status-message.success {

            color:
                #86efac;

        }

        .status-message.error {

            color:
                #fca5a5;

        }


        /* =========================================================
           INFO GRID
        ========================================================= */

        .info-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 14px;

            margin-top: 12px;

            margin-bottom: 18px;

        }

        .info-item {

            min-width: 0;

            padding: 18px;

            border:
                1px solid
                var(--border-soft);

            border-radius:
                var(--radius-sm);

            background:
                rgba(255,255,255,.025);

        }

        .info-label {

            display: block;

            margin-bottom: 7px;

            color:
                var(--text-muted);

            font-size: 10px;

            font-weight: 800;

            letter-spacing: .10em;

            text-transform: uppercase;

        }

        .info-value {

            display: block;

            color:
                var(--text-main);

            font-size: 13px;

            font-weight: 600;

            word-break: break-word;

        }


        /* =========================================================
           BIO CARD
        ========================================================= */

        .bio-card {

            padding: 22px;

            border:
                1px solid
                var(--border-soft);

            border-radius:
                var(--radius-md);

            background:
                rgba(255,255,255,.025);

        }

        .bio-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 14px;

        }

        .bio-heading {

            display: flex;

            align-items: center;

            gap: 10px;

        }

        .bio-icon {

            width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            background:
                rgba(167,139,250,.10);

            color:
                var(--purple-soft);

            font-size: 14px;

        }

        .bio-title {

            font-size: 14px;

            font-weight: 800;

        }

        .bio-edit-button {

            border: 0;

            background: transparent;

            color:
                var(--purple-soft);

            font-family:
                inherit;

            font-size: 11px;

            font-weight: 700;

            cursor: pointer;

        }

        .bio-edit-button:hover {

            color: white;

        }

        .bio-text {

            color:
                var(--text-soft);

            font-size: 13px;

            line-height: 1.8;

            white-space: pre-wrap;

        }

        .bio-empty {

            color:
                var(--text-muted);

            font-style: italic;

        }


        /* =========================================================
           BIO FORM
        ========================================================= */

        .bio-form {

            display: none;

        }

        .bio-form.active {

            display: block;

        }

        .bio-input {

            width: 100%;

            min-height: 130px;

            resize: vertical;

            padding: 15px;

            border:
                1px solid
                var(--border);

            border-radius:
                14px;

            outline: none;

            background:
                rgba(0,0,0,.14);

            color:
                var(--text-main);

            font-family:
                inherit;

            font-size: 13px;

            line-height: 1.7;

            transition:
                border-color .2s ease,
                background .2s ease;

        }

        .bio-input:focus {

            border-color:
                rgba(167,139,250,.42);

            background:
                rgba(0,0,0,.20);

        }

        .bio-input::placeholder {

            color:
                var(--text-muted);

        }

        .bio-footer {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-top: 10px;

        }

        .char-counter {

            color:
                var(--text-muted);

            font-size: 10px;

        }

        .bio-actions {

            display: flex;

            gap: 8px;

        }

        .bio-button {

            border: 0;

            padding:
                9px 14px;

            border-radius:
                10px;

            font-family:
                inherit;

            font-size: 11px;

            font-weight: 700;

            cursor: pointer;

        }

        .bio-button.cancel {

            background:
                rgba(255,255,255,.06);

            color:
                var(--text-soft);

        }

        .bio-button.save {

            background:
                var(--purple-dark);

            color: white;

            box-shadow:
                0 8px 20px
                rgba(124,58,237,.22);

        }

        .bio-button:hover {

            transform:
                translateY(-1px);

        }


        /* =========================================================
           BACK
        ========================================================= */

        .back-section {

            display: flex;

            justify-content: center;

            margin-top: 24px;

        }

        .back-button {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                11px 18px;

            border:
                1px solid
                var(--border);

            border-radius:
                12px;

            background:
                rgba(255,255,255,.035);

            color:
                var(--text-soft);

            text-decoration: none;

            font-size: 12px;

            font-weight: 700;

            transition:
                transform .2s ease,
                background .2s ease,
                color .2s ease;

        }

        .back-button:hover {

            transform:
                translateY(-2px);

            background:
                rgba(255,255,255,.07);

            color:
                white;

        }


        /* =========================================================
           TOAST
        ========================================================= */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 26px;

            z-index: 9999;

            transform:
                translate(-50%, 30px);

            opacity: 0;

            pointer-events: none;

            padding:
                13px 18px;

            border:
                1px solid
                rgba(255,255,255,.10);

            border-radius:
                14px;

            background:
                rgba(27,25,48,.94);

            color:
                var(--text-main);

            box-shadow:
                0 20px 50px
                rgba(0,0,0,.35);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);

            font-size: 12px;

            font-weight: 600;

            transition:
                opacity .25s ease,
                transform .25s ease;

        }

        .toast.show {

            opacity: 1;

            transform:
                translate(-50%, 0);

        }


        /* =========================================================
           LOADING
        ========================================================= */

        .is-loading {

            opacity: .65;

            pointer-events: none;

        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 700px) {

            .profile-container {

                width:
                    min(
                        calc(100% - 24px),
                        820px
                    );

                padding:
                    35px 0 55px;

            }

            .profile-card {

                padding: 22px;

                border-radius:
                    22px;

            }

            .profile-title {

                font-size: 38px;

            }

            .profile-subtitle {

                font-size: 13px;

            }

            .info-grid {

                grid-template-columns:
                    1fr;

            }

            .bio-header {

                align-items:
                    flex-start;

            }

        }


        @media (max-width: 480px) {

            .profile-card {

                padding: 18px;

            }

            .avatar-wrapper {

                width: 120px;

                height: 120px;

            }

            .avatar {

                font-size: 36px;

            }

            .bio-card {

                padding: 18px;

            }

            .bio-footer {

                align-items:
                    flex-start;

                flex-direction:
                    column;

            }

            .bio-actions {

                width: 100%;

            }

            .bio-button {

                flex: 1;

            }

        }

    </style>

</head>


<body>


    @include('whisperly.navbar')


    <main class="profile-container">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <header class="profile-header">

            <div class="profile-badge">
                Profil Talent
            </div>

            <h1 class="profile-title">
                Profil Talent
            </h1>

            <p class="profile-subtitle">
                Kelola foto profil, informasi akun,
                dan deskripsi singkat tentang dirimu sebagai
                Talent Whisperly.
            </p>

        </header>


        <!-- =====================================================
             MAIN CARD
        ====================================================== -->

        <section class="profile-card">


            <!-- =================================================
                 AVATAR SECTION
            ================================================== -->

            <div class="avatar-section">


                <div
                    class="avatar-wrapper"
                    id="avatarWrapper"
                    title="Klik untuk mengganti foto"
                >

                    <div
                        class="avatar"
                        id="avatarContainer"
                    >

                        @if ($currentTalentProfile && !empty($currentTalentProfile->photo))

                            @php

                                $talentPhoto = trim(
                                    (string) $currentTalentProfile->photo
                                );

                                if (filter_var($talentPhoto, FILTER_VALIDATE_URL)) {

                                    $talentAvatarUrl = $talentPhoto;

                                } else {

                                    $talentAvatarUrl = asset(
                                        'storage/' .
                                        ltrim(
                                            preg_replace(
                                                '#^public/#',
                                                '',
                                                $talentPhoto
                                            ),
                                            '/'
                                        )
                                    );

                                }

                            @endphp

                            <img
                                src="{{ $talentAvatarUrl }}"
                                alt="Foto profil {{ $currentUser->username }}"
                                id="avatarImage"
                            >

                        @else

                            <span id="avatarInitial">

                                {{ strtoupper(substr($currentUser->username ?? 'T', 0, 1)) }}

                            </span>

                        @endif

                    </div>


                    <div class="avatar-overlay">
                        Ubah
                    </div>


                    <div class="avatar-edit-badge">
                        ✎
                    </div>

                </div>


                <div class="avatar-name">

                    {{ $currentUser->username }}

                </div>


                <div class="avatar-role">

                    Talent

                </div>


                <input
                    type="file"
                    id="photoInput"
                    accept="image/jpeg,image/png,image/jpg,image/webp,image/gif"
                >


                <div class="photo-actions">

                    <button
                        type="button"
                        class="photo-button primary"
                        id="changePhotoButton"
                    >
                        Ganti Foto
                    </button>


                    @if ($currentTalentProfile && !empty($currentTalentProfile->photo))

                        <button
                            type="button"
                            class="photo-button danger"
                            id="deletePhotoButton"
                        >
                            Hapus Foto
                        </button>

                    @endif

                </div>


                <div
                    class="status-message"
                    id="photoStatus"
                ></div>


            </div>


            <!-- =================================================
                 ACCOUNT INFO
            ================================================== -->

            <div class="info-grid">


                <div class="info-item">

                    <span class="info-label">
                        Nama
                    </span>

                    <span class="info-value">
                        {{ $currentUser->username }}
                    </span>

                </div>


                <div class="info-item">

                    <span class="info-label">
                        Email
                    </span>

                    <span class="info-value">
                        {{ $currentUser->email }}
                    </span>

                </div>


                <div class="info-item">

                    <span class="info-label">
                        Bergabung
                    </span>

                    <span class="info-value">

                        @if ($currentUser->created_at)

                            {{ $currentUser->created_at->translatedFormat('d M Y') }}

                        @else

                            -

                        @endif

                    </span>

                </div>


            </div>


            <!-- =================================================
                 TALENT DESCRIPTION
            ================================================== -->

            <div class="bio-card">


                <div class="bio-header">


                    <div class="bio-heading">

                        <div class="bio-icon">
                            ✦
                        </div>

                        <div class="bio-title">
                            Deskripsi Talent
                        </div>

                    </div>


                    <button
                        type="button"
                        class="bio-edit-button"
                        id="editBioButton"
                    >
                        Edit
                    </button>


                </div>


                <div id="bioDisplay">

                    @if (
                        $currentTalentProfile &&
                        !empty($currentTalentProfile->deskripsi)
                    )

                        <div class="bio-text">
                            {{ $currentTalentProfile->deskripsi }}
                        </div>

                    @else

                        <div class="bio-text bio-empty">
                            Belum ada deskripsi.
                            Tambahkan sedikit informasi tentang
                            dirimu dan bagaimana kamu menemani
                            pengguna Whisperly.
                        </div>

                    @endif

                </div>


                <div
                    class="bio-form"
                    id="bioForm"
                >

                    <textarea
                        id="bioInput"
                        class="bio-input"
                        maxlength="500"
                        placeholder="Tulis deskripsi singkat tentang dirimu sebagai Talent Whisperly..."
                    >{{ $currentTalentProfile->deskripsi ?? '' }}</textarea>


                    <div class="bio-footer">


                        <div
                            class="char-counter"
                            id="charCounter"
                        >
                            {{ strlen($currentTalentProfile->deskripsi ?? '') }}/500
                        </div>


                        <div class="bio-actions">

                            <button
                                type="button"
                                class="bio-button cancel"
                                id="cancelBioButton"
                            >
                                Batal
                            </button>


                            <button
                                type="button"
                                class="bio-button save"
                                id="saveBioButton"
                            >
                                Simpan
                            </button>

                        </div>


                    </div>

                </div>


            </div>


        </section>


        <!-- =====================================================
             BACK
        ====================================================== -->

        <div class="back-section">

            <a
                href="{{ route('whisperly.home') }}"
                class="back-button"
            >
                ← Kembali ke Home
            </a>

        </div>


    </main>


    <!-- =========================================================
         TOAST
    ========================================================== -->

    <div
        class="toast"
        id="toast"
    ></div>


    <script>

        /* =========================================================
           CSRF
        ========================================================= */

        const csrfToken =
            document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');


        /* =========================================================
           ELEMENTS
        ========================================================= */

        const photoInput =
            document.getElementById('photoInput');

        const avatarWrapper =
            document.getElementById('avatarWrapper');

        const avatarContainer =
            document.getElementById('avatarContainer');

        const changePhotoButton =
            document.getElementById('changePhotoButton');

        const photoStatus =
            document.getElementById('photoStatus');

        const toast =
            document.getElementById('toast');

        const editBioButton =
            document.getElementById('editBioButton');

        const cancelBioButton =
            document.getElementById('cancelBioButton');

        const saveBioButton =
            document.getElementById('saveBioButton');

        const bioDisplay =
            document.getElementById('bioDisplay');

        const bioForm =
            document.getElementById('bioForm');

        const bioInput =
            document.getElementById('bioInput');

        const charCounter =
            document.getElementById('charCounter');


        /* =========================================================
           TOAST
        ========================================================= */

        function showToast(message) {

            toast.textContent = message;

            toast.classList.add('show');

            setTimeout(() => {

                toast.classList.remove('show');

            }, 2500);

        }


        /* =========================================================
           PHOTO STATUS
        ========================================================= */

        function setPhotoStatus(
            message,
            type = ''
        ) {

            photoStatus.textContent =
                message;

            photoStatus.className =
                'status-message';

            if (type) {

                photoStatus.classList.add(
                    type
                );

            }

        }


        /* =========================================================
           OPEN FILE PICKER
        ========================================================= */

        avatarWrapper.addEventListener(
            'click',
            function () {

                photoInput.click();

            }
        );


        changePhotoButton.addEventListener(
            'click',
            function () {

                photoInput.click();

            }
        );


        /* =========================================================
           PHOTO UPLOAD
        ========================================================= */

        photoInput.addEventListener(
            'change',
            async function () {

                const file =
                    this.files[0];

                if (!file) {

                    return;

                }


                const allowedTypes = [

                    'image/jpeg',
                    'image/png',
                    'image/jpg',
                    'image/webp',
                    'image/gif'

                ];


                if (
                    !allowedTypes.includes(
                        file.type
                    )
                ) {

                    setPhotoStatus(
                        'Format foto harus JPG, PNG, WEBP, atau GIF.',
                        'error'
                    );

                    this.value = '';

                    return;

                }


                if (
                    file.size >
                    3 * 1024 * 1024
                ) {

                    setPhotoStatus(
                        'Ukuran foto maksimal 3 MB.',
                        'error'
                    );

                    this.value = '';

                    return;

                }


                const formData =
                    new FormData();


                formData.append(
                    'photo',
                    file
                );


                formData.append(
                    '_token',
                    csrfToken
                );


                setPhotoStatus(
                    'Mengunggah foto...'
                );


                changePhotoButton.classList.add(
                    'is-loading'
                );


                try {

                    const response =
                        await fetch(
                            "{{ route('whisperly.profile.photo.update') }}",
                            {

                                method: 'POST',

                                headers: {

                                    'X-CSRF-TOKEN':
                                        csrfToken,

                                    'Accept':
                                        'application/json'

                                },

                                body:
                                    formData

                            }
                        );


                    const data =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            'Gagal mengunggah foto.'
                        );

                    }


                    /*
                    Update avatar Talent
                    */

                    const avatarUrl =
                        data.avatar_url ||
                        data.url;


                    if (avatarUrl) {

                        avatarContainer.innerHTML = '';


                        const img =
                            document.createElement(
                                'img'
                            );


                        img.src =
                            avatarUrl;


                        img.alt =
                            'Foto profil {{ $currentUser->username }}';


                        img.id =
                            'avatarImage';


                        avatarContainer.appendChild(
                            img
                        );


                        const navAvatar =
                            document.querySelector(
                                '.whisperly-user-avatar'
                            );


                        if (navAvatar) {

                            navAvatar.innerHTML =
                                `<img src="${avatarUrl}" alt="Avatar">`;

                        }

                    }


                    setPhotoStatus(
                        data.message ||
                        'Foto profil berhasil diperbarui.',
                        'success'
                    );


                    showToast(
                        data.message ||
                        'Foto profil berhasil diperbarui.'
                    );


                    /*
                    Tambahkan tombol hapus
                    */

                    if (
                        !document.getElementById(
                            'deletePhotoButton'
                        )
                    ) {

                        const button =
                            document.createElement(
                                'button'
                            );


                        button.type =
                            'button';


                        button.className =
                            'photo-button danger';


                        button.id =
                            'deletePhotoButton';


                        button.textContent =
                            'Hapus Foto';


                        document
                            .querySelector(
                                '.photo-actions'
                            )
                            .appendChild(
                                button
                            );


                        bindDeletePhotoButton();

                    }


                } catch (error) {

                    setPhotoStatus(
                        error.message ||
                        'Terjadi kesalahan saat mengunggah foto.',
                        'error'
                    );


                    showToast(
                        'Foto gagal diperbarui.'
                    );

                } finally {

                    changePhotoButton.classList.remove(
                        'is-loading'
                    );

                    photoInput.value = '';

                }

            }
        );


        /* =========================================================
           DELETE PHOTO
        ========================================================= */

        function bindDeletePhotoButton() {

            const button =
                document.getElementById(
                    'deletePhotoButton'
                );


            if (!button) {

                return;

            }


            button.onclick =
                async function () {


                    const confirmed =
                        confirm(
                            'Hapus foto profil talent?'
                        );


                    if (!confirmed) {

                        return;

                    }


                    button.classList.add(
                        'is-loading'
                    );


                    setPhotoStatus(
                        'Menghapus foto...'
                    );


                    try {

                        const response =
                            await fetch(
                                "{{ route('whisperly.profile.photo.delete') }}",
                                {

                                    method: 'DELETE',

                                    headers: {

                                        'X-CSRF-TOKEN':
                                            csrfToken,

                                        'Accept':
                                            'application/json'

                                    }

                                }
                            );


                        const data =
                            await response.json();


                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                'Gagal menghapus foto.'
                            );

                        }


                        avatarContainer.innerHTML =
                            `<span id="avatarInitial">
                                {{ strtoupper(substr($currentUser->username ?? 'T', 0, 1)) }}
                            </span>`;


                        const navAvatar =
                            document.querySelector(
                                '.whisperly-user-avatar'
                            );


                        if (navAvatar) {

                            navAvatar.innerHTML =
                                `{{ strtoupper(substr($currentUser->username ?? 'T', 0, 1)) }}`;

                        }


                        button.remove();


                        setPhotoStatus(
                            data.message ||
                            'Foto profil berhasil dihapus.',
                            'success'
                        );


                        showToast(
                            data.message ||
                            'Foto profil berhasil dihapus.'
                        );


                    } catch (error) {

                        setPhotoStatus(
                            error.message ||
                            'Gagal menghapus foto.',
                            'error'
                        );


                        showToast(
                            'Foto gagal dihapus.'
                        );


                        button.classList.remove(
                            'is-loading'
                        );

                    }

                };

        }


        bindDeletePhotoButton();


        /* =========================================================
           DESCRIPTION EDIT
        ========================================================= */

        editBioButton.addEventListener(
            'click',
            function () {

                bioDisplay.style.display =
                    'none';

                bioForm.classList.add(
                    'active'
                );

                editBioButton.style.display =
                    'none';

                bioInput.focus();

            }
        );


        /* =========================================================
           DESCRIPTION CANCEL
        ========================================================= */

        cancelBioButton.addEventListener(
            'click',
            function () {

                bioForm.classList.remove(
                    'active'
                );

                bioDisplay.style.display =
                    '';

                editBioButton.style.display =
                    '';

                bioInput.value =
                    @json($currentTalentProfile->deskripsi ?? '');

                updateCounter();

            }
        );


        /* =========================================================
           DESCRIPTION COUNTER
        ========================================================= */

        function updateCounter() {

            const length =
                bioInput.value.length;

            charCounter.textContent =
                `${length}/500`;

        }


        bioInput.addEventListener(
            'input',
            updateCounter
        );


        /* =========================================================
           DESCRIPTION SAVE
        ========================================================= */

        saveBioButton.addEventListener(
            'click',
            async function () {

                const bio =
                    bioInput.value.trim();


                if (bio.length > 500) {

                    showToast(
                        'Deskripsi maksimal 500 karakter.'
                    );

                    return;

                }


                saveBioButton.classList.add(
                    'is-loading'
                );


                try {

                    const formData =
                        new FormData();


                    formData.append(
                        'bio',
                        bio
                    );


                    formData.append(
                        '_token',
                        csrfToken
                    );


                    const response =
                        await fetch(
                            "{{ route('whisperly.profile.bio.update') }}",
                            {

                                method: 'POST',

                                headers: {

                                    'X-CSRF-TOKEN':
                                        csrfToken,

                                    'Accept':
                                        'application/json'

                                },

                                body:
                                    formData

                            }
                        );


                    const data =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            'Gagal menyimpan deskripsi.'
                        );

                    }


                    if (bio) {

                        bioDisplay.innerHTML =
                            `<div class="bio-text"></div>`;


                        bioDisplay
                            .querySelector(
                                '.bio-text'
                            )
                            .textContent =
                                bio;

                    } else {

                        bioDisplay.innerHTML =
                            `<div class="bio-text bio-empty">
                                Belum ada deskripsi.
                                Tambahkan sedikit informasi tentang
                                dirimu dan bagaimana kamu menemani
                                pengguna Whisperly.
                            </div>`;

                    }


                    bioForm.classList.remove(
                        'active'
                    );


                    bioDisplay.style.display =
                        '';


                    editBioButton.style.display =
                        '';


                    showToast(
                        data.message ||
                        'Deskripsi Talent berhasil diperbarui.'
                    );


                } catch (error) {

                    showToast(
                        error.message ||
                        'Gagal menyimpan deskripsi.'
                    );

                } finally {

                    saveBioButton.classList.remove(
                        'is-loading'
                    );

                }

            }
        );


        /* =========================================================
           INITIAL COUNTER
        ========================================================= */

        updateCounter();

    </script>


</body>

</html>