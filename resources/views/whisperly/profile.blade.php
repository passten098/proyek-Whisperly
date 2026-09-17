<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Profil Saya | Whisperly</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #0c0b18;
            --bg-card: rgba(22, 20, 42, 0.72);
            --bg-card-hover: rgba(30, 27, 56, 0.85);
            --border-glass: rgba(255, 255, 255, 0.08);
            --border-glass-focus: rgba(201, 185, 239, 0.35);
            --accent-pink: #e7a2b6;
            --accent-purple: #c9b9ef;
            --text-primary: #fffaf7;
            --text-secondary: rgba(255, 250, 247, 0.65);
            --text-muted: rgba(255, 255, 255, 0.4);
            --gradient-accent: linear-gradient(135deg, #e7a2b6 0%, #c9b9ef 100%);
            --shadow-glow: 0 15px 40px -10px rgba(201, 185, 239, 0.25);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background-color: var(--bg-main);
            background-image:
                radial-gradient(circle at 85% 12%, rgba(201, 185, 239, 0.12) 0%, transparent 35%),
                radial-gradient(circle at 10% 45%, rgba(231, 162, 182, 0.09) 0%, transparent 35%),
                radial-gradient(circle at 50% 95%, rgba(147, 112, 219, 0.08) 0%, transparent 40%);
            color: var(--text-primary);
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* Container */
        .profile-container {
            width: 100%;
            max-width: 820px;
            margin: 0 auto;
            padding: 45px 24px 80px;
        }

        /* Header */
        .profile-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .profile-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border-glass);
            border-radius: 999px;
            color: var(--accent-purple);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            margin-bottom: 14px;
            backdrop-filter: blur(10px);
        }

        .profile-badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent-pink);
            box-shadow: 0 0 10px var(--accent-pink);
        }

        .profile-header h1 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(34px, 5.5vw, 48px);
            font-weight: 600;
            line-height: 1.15;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            margin-bottom: 10px;
        }

        .profile-header p {
            color: var(--text-secondary);
            font-size: 15px;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Main Card */
        .profile-card {
            position: relative;
            background: var(--bg-card);
            border: 1px solid var(--border-glass);
            border-radius: 28px;
            padding: 40px;
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(201, 185, 239, 0.4), rgba(231, 162, 182, 0.4), transparent);
        }

        /* Avatar Section */
        .avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 34px;
        }

        .avatar-wrapper {
            position: relative;
            width: 128px;
            height: 128px;
            border-radius: 50%;
            padding: 4px;
            background: var(--gradient-accent);
            box-shadow: var(--shadow-glow);
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .avatar-wrapper:hover {
            transform: scale(1.03);
            box-shadow: 0 20px 50px -10px rgba(201, 185, 239, 0.4);
        }

        .avatar-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #18152e;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .avatar-initial {
            font-size: 48px;
            font-weight: 700;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            user-select: none;
        }

        /* Overlay icon on avatar */
        .avatar-overlay {
            position: absolute;
            inset: 0;
            background: rgba(12, 11, 24, 0.65);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            color: #fff;
            opacity: 0;
            transition: opacity 0.25s ease;
            border-radius: 50%;
        }

        .avatar-wrapper:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay svg {
            width: 26px;
            height: 26px;
        }

        .avatar-overlay span {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .avatar-edit-badge {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #18152e;
            border: 2px solid var(--accent-purple);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .avatar-edit-badge:hover {
            background: var(--accent-purple);
            color: #141226;
            transform: scale(1.1);
        }

        .avatar-edit-badge svg {
            width: 18px;
            height: 18px;
        }

        /* Avatar Actions Buttons */
        .avatar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 14px;
        }

        .avatar-btn {
            background: transparent;
            border: 1px solid var(--border-glass);
            color: var(--text-secondary);
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .avatar-btn:hover {
            background: rgba(255, 255, 255, 0.06);
            color: var(--text-primary);
            border-color: var(--border-glass-focus);
        }

        .avatar-btn.danger {
            color: #f87171;
            border-color: rgba(248, 113, 113, 0.2);
        }

        .avatar-btn.danger:hover {
            background: rgba(248, 113, 113, 0.1);
            border-color: rgba(248, 113, 113, 0.4);
        }

        .avatar-status-msg {
            font-size: 12px;
            margin-top: 8px;
            color: var(--accent-purple);
            min-height: 18px;
            transition: opacity 0.2s;
        }

        /* Info Grid: Nama, Email, Tanggal Bergabung */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            border-radius: 20px;
            padding: 20px 22px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            transition: background 0.25s ease, border-color 0.25s ease, transform 0.25s ease;
        }

        .info-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(201, 185, 239, 0.2);
            transform: translateY(-2px);
        }

        .info-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .info-label svg {
            width: 14px;
            height: 14px;
            color: var(--accent-purple);
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            word-break: break-word;
            line-height: 1.4;
        }

        /* Bio Card */
        .bio-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            border-radius: 22px;
            padding: 26px;
            margin-bottom: 28px;
            transition: border-color 0.25s ease;
        }

        .bio-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .bio-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .bio-title svg {
            width: 15px;
            height: 15px;
            color: var(--accent-purple);
        }

        .bio-edit-btn {
            background: rgba(201, 185, 239, 0.1);
            border: 1px solid rgba(201, 185, 239, 0.25);
            color: var(--accent-purple);
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .bio-edit-btn:hover {
            background: rgba(201, 185, 239, 0.2);
            color: #fff;
            transform: translateY(-1px);
        }

        .bio-content {
            font-size: 15px;
            line-height: 1.7;
            color: var(--text-secondary);
            white-space: pre-wrap;
            min-height: 38px;
        }

        .bio-empty {
            color: var(--text-muted);
            font-style: italic;
        }

        /* Bio Edit Form */
        .bio-form-wrapper {
            display: none;
            margin-top: 10px;
        }

        .bio-form-wrapper.active {
            display: block;
            animation: fadeIn 0.25s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bio-textarea {
            width: 100%;
            min-height: 110px;
            background: rgba(14, 13, 30, 0.7);
            border: 1px solid var(--border-glass-focus);
            border-radius: 16px;
            padding: 14px 18px;
            color: var(--text-primary);
            font-family: inherit;
            font-size: 14px;
            line-height: 1.6;
            resize: vertical;
            outline: none;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .bio-textarea:focus {
            border-color: var(--accent-purple);
            box-shadow: 0 0 0 3px rgba(201, 185, 239, 0.15);
        }

        .bio-form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 12px;
        }

        .char-counter {
            font-size: 12px;
            color: var(--text-muted);
        }

        .bio-form-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-cancel {
            background: transparent;
            border: 1px solid var(--border-glass);
            color: var(--text-secondary);
            padding: 8px 18px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.06);
            color: var(--text-primary);
        }

        .btn-save {
            background: var(--gradient-accent);
            border: none;
            color: #161329;
            padding: 8px 22px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(201, 185, 239, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(201, 185, 239, 0.45);
        }

        .btn-save:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Back Link */
        .back-nav {
            display: flex;
            justify-content: center;
            margin-top: 32px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            transition: all 0.25s ease;
        }

        .back-link:hover {
            background: rgba(201, 185, 239, 0.1);
            color: var(--text-primary);
            border-color: rgba(201, 185, 239, 0.3);
            transform: translateX(-3px);
        }

        /* Floating Toast */
        .toast-container {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 10000;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }

        .toast {
            pointer-events: auto;
            background: rgba(26, 23, 48, 0.96);
            border: 1px solid var(--border-glass);
            border-left: 4px solid var(--accent-purple);
            padding: 14px 20px;
            border-radius: 14px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast.success {
            border-left-color: #34d399;
        }

        .toast.error {
            border-left-color: #f87171;
        }

        /* Responsive Breakpoints */
        @media (max-width: 768px) {
            .profile-container {
                padding: 30px 16px 60px;
            }

            .profile-card {
                padding: 26px 20px;
                border-radius: 22px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .avatar-wrapper {
                width: 112px;
                height: 112px;
            }

            .avatar-initial {
                font-size: 40px;
            }

            .bio-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR GLOBAL --}}
    @include('whisperly.navbar')

    <main class="profile-page">
        <div class="profile-container">

            {{-- HEADER --}}
            <header class="profile-header">
                <div class="profile-badge">
                    <span class="profile-badge-dot"></span>
                    <span>Profil Pengguna</span>
                </div>
                <h1>Profil Saya</h1>
                <p>Kelola foto profil, informasi akun, dan deskripsi singkat dirimu.</p>
            </header>

            {{-- KARTU PROFIL UTAMA --}}
            <section class="profile-card" aria-label="Informasi Profil">

                {{-- 1. FOTO PROFIL (BISA DI-EDIT & TAMBAH GAMBAR) --}}
                <div class="avatar-section">
                    <div
                        class="avatar-wrapper"
                        id="avatarWrapper"
                        role="button"
                        tabindex="0"
                        title="Klik untuk mengubah foto profil"
                        aria-label="Ubah foto profil"
                    >
                        <div class="avatar-inner" id="avatarInner">
                            @if ($currentUser->avatar_url)
                                <img
                                    src="{{ $currentUser->avatar_url }}"
                                    alt="Foto {{ $currentUser->username }}"
                                    class="avatar-img"
                                    id="avatarImage"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/images/faces/1.jpg') }}';"
                                >
                            @else
                                <span class="avatar-initial" id="avatarInitial">
                                    {{ strtoupper(substr($currentUser->username, 0, 1)) }}
                                </span>
                            @endif

                            <div class="avatar-overlay">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                    <circle cx="12" cy="13" r="4"></circle>
                                </svg>
                                <span>Ubah</span>
                            </div>
                        </div>

                        <div class="avatar-edit-badge" title="Ganti Foto">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- File Input Tersembunyi --}}
                    <input
                        type="file"
                        id="photoInput"
                        accept="image/png, image/jpeg, image/jpg, image/webp, image/gif"
                        style="display: none;"
                        aria-hidden="true"
                    >

                    {{-- Tombol Aksi Foto --}}
                    <div class="avatar-actions">
                        <button type="button" class="avatar-btn" id="btnUploadPhoto">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            <span>Ganti Foto</span>
                        </button>

                        @if ($currentUser->profil)
                            <button type="button" class="avatar-btn danger" id="btnDeletePhoto">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                <span>Hapus</span>
                            </button>
                        @endif
                    </div>

                    <div class="avatar-status-msg" id="avatarStatusMsg"></div>
                </div>

                {{-- 2. NAMA, 3. EMAIL, 4. TANGGAL BERGABUNG --}}
                <div class="info-grid">

                    {{-- NAMA --}}
                    <div class="info-card">
                        <div class="info-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>Nama</span>
                        </div>
                        <div class="info-value">
                            {{ $currentUser->username }}
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="info-card">
                        <div class="info-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <span>Email</span>
                        </div>
                        <div class="info-value">
                            {{ $currentUser->email }}
                        </div>
                    </div>

                    {{-- TANGGAL BERGABUNG --}}
                    <div class="info-card">
                        <div class="info-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>Tanggal Bergabung</span>
                        </div>
                        <div class="info-value">
                            {{ $currentUser->created_at ? $currentUser->created_at->format('d M Y') : '-' }}
                        </div>
                    </div>

                </div>

                {{-- 5. BIO (BISA DI-EDIT DAN DI-SIMPAN) --}}
                <div class="bio-card">
                    <div class="bio-header">
                        <div class="bio-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <span>Bio</span>
                        </div>

                        <button type="button" class="bio-edit-btn" id="btnToggleBioEdit">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            <span id="bioBtnText">Edit Bio</span>
                        </button>
                    </div>

                    {{-- Tampilan Teks Bio --}}
                    <div class="bio-content" id="bioDisplay">
                        @if (!empty(trim((string)$currentUser->bio)))
                            {{ $currentUser->bio }}
                        @else
                            <span class="bio-empty">Belum ada bio. Ceritakan sedikit tentang dirimu di sini...</span>
                        @endif
                    </div>

                    {{-- Form Mode Edit Bio --}}
                    <div class="bio-form-wrapper" id="bioFormWrapper">
                        <form id="bioForm">
                            <textarea
                                id="bioInput"
                                class="bio-textarea"
                                maxlength="500"
                                placeholder="Tulis bio singkatmu di sini (maksimal 500 karakter)..."
                            >{{ $currentUser->bio }}</textarea>

                            <div class="bio-form-footer">
                                <span class="char-counter" id="charCounter">0 / 500</span>

                                <div class="bio-form-actions">
                                    <button type="button" class="btn-cancel" id="btnCancelBio">Batal</button>
                                    <button type="submit" class="btn-save" id="btnSaveBio">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span>Simpan</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- NAVIGASI KEMBALI KE HOME --}}
                <div class="back-nav">
                    <a href="{{ route('whisperly.home') }}" class="back-link">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>

            </section>
        </div>
    </main>

    {{-- TOAST CONTAINER --}}
    <div class="toast-container" id="toastContainer"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // --- TOAST HELPER ---
            function showToast(message, type = 'success') {
                const container = document.getElementById('toastContainer');
                if (!container) return;

                const toast = document.createElement('div');
                toast.className = `toast ${type}`;
                toast.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        ${type === 'success'
                            ? '<polyline points="20 6 9 17 4 12"></polyline>'
                            : '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>'
                        }
                    </svg>
                    <span>${message}</span>
                `;

                container.appendChild(toast);

                requestAnimationFrame(() => {
                    toast.classList.add('show');
                });

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => toast.remove(), 350);
                }, 3500);
            }

            // --- 1. FOTO PROFIL LOGIC ---
            const avatarWrapper = document.getElementById('avatarWrapper');
            const photoInput = document.getElementById('photoInput');
            const btnUploadPhoto = document.getElementById('btnUploadPhoto');
            const btnDeletePhoto = document.getElementById('btnDeletePhoto');
            const avatarInner = document.getElementById('avatarInner');
            const avatarStatusMsg = document.getElementById('avatarStatusMsg');

            function triggerFileInput() {
                photoInput.click();
            }

            if (avatarWrapper) {
                avatarWrapper.addEventListener('click', triggerFileInput);
                avatarWrapper.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        triggerFileInput();
                    }
                });
            }

            if (btnUploadPhoto) {
                btnUploadPhoto.addEventListener('click', (e) => {
                    e.stopPropagation();
                    triggerFileInput();
                });
            }

            if (photoInput) {
                photoInput.addEventListener('change', async function () {
                    const file = this.files[0];
                    if (!file) return;

                    // Validasi tipe file client-side
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        showToast('File harus berupa gambar (JPG, PNG, WEBP, GIF).', 'error');
                        return;
                    }

                    // Validasi ukuran file client-side (3 MB)
                    if (file.size > 3 * 1024 * 1024) {
                        showToast('Ukuran gambar maksimal 3 MB.', 'error');
                        return;
                    }

                    // Tampilkan status & preview lokal seketika
                    avatarStatusMsg.textContent = 'Mengunggah foto...';
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        avatarInner.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="avatar-img" id="avatarImage">
                            <div class="avatar-overlay">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                    <circle cx="12" cy="13" r="4"></circle>
                                </svg>
                                <span>Ubah</span>
                            </div>
                        `;
                    };
                    reader.readAsDataURL(file);

                    // Kirim ke server
                    const formData = new FormData();
                    formData.append('photo', file);

                    try {
                        const response = await fetch("{{ route('whisperly.profile.photo.update') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            avatarStatusMsg.textContent = '';
                            showToast(data.message || 'Foto profil berhasil diperbarui!');

                            // Perbarui juga avatar di navbar jika ada
                            const navAvatarImg = document.querySelector('.whisperly-user-avatar img');
                            const navAvatarDiv = document.querySelector('.whisperly-user-avatar');
                            if (navAvatarImg) {
                                navAvatarImg.src = data.avatar_url;
                            } else if (navAvatarDiv && data.avatar_url) {
                                navAvatarDiv.innerHTML = `<img src="${data.avatar_url}" alt="Avatar" style="width:34px;height:34px;object-fit:cover;border-radius:50%;">`;
                            }

                            // Pastikan tombol hapus muncul jika belum ada
                            if (!document.getElementById('btnDeletePhoto')) {
                                const actions = document.querySelector('.avatar-actions');
                                const deleteBtn = document.createElement('button');
                                deleteBtn.type = 'button';
                                deleteBtn.className = 'avatar-btn danger';
                                deleteBtn.id = 'btnDeletePhoto';
                                deleteBtn.innerHTML = `
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    <span>Hapus</span>
                                `;
                                deleteBtn.addEventListener('click', deletePhotoHandler);
                                actions.appendChild(deleteBtn);
                            }
                        } else {
                            avatarStatusMsg.textContent = '';
                            showToast(data.message || 'Gagal mengunggah foto profil.', 'error');
                        }
                    } catch (err) {
                        avatarStatusMsg.textContent = '';
                        showToast('Terjadi kesalahan jaringan saat mengunggah foto.', 'error');
                    } finally {
                        photoInput.value = '';
                    }
                });
            }

            // Hapus Foto Handler
            async function deletePhotoHandler(e) {
                if (e) e.stopPropagation();
                if (!confirm('Apakah Anda yakin ingin menghapus foto profil?')) return;

                avatarStatusMsg.textContent = 'Menghapus foto...';

                try {
                    const response = await fetch("{{ route('whisperly.profile.photo.delete') }}", {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        avatarStatusMsg.textContent = '';
                        avatarInner.innerHTML = `
                            <span class="avatar-initial" id="avatarInitial">${data.initial || 'U'}</span>
                            <div class="avatar-overlay">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                    <circle cx="12" cy="13" r="4"></circle>
                                </svg>
                                <span>Ubah</span>
                            </div>
                        `;
                        const delBtn = document.getElementById('btnDeletePhoto');
                        if (delBtn) delBtn.remove();

                        // Perbarui navbar
                        const navAvatarDiv = document.querySelector('.whisperly-user-avatar');
                        if (navAvatarDiv) {
                            navAvatarDiv.innerHTML = data.initial || 'U';
                        }

                        showToast(data.message || 'Foto profil berhasil dihapus.');
                    } else {
                        avatarStatusMsg.textContent = '';
                        showToast(data.message || 'Gagal menghapus foto profil.', 'error');
                    }
                } catch (err) {
                    avatarStatusMsg.textContent = '';
                    showToast('Terjadi kesalahan saat menghapus foto.', 'error');
                }
            }

            if (btnDeletePhoto) {
                btnDeletePhoto.addEventListener('click', deletePhotoHandler);
            }

            // --- 2. BIO EDIT & SAVE LOGIC ---
            const btnToggleBioEdit = document.getElementById('btnToggleBioEdit');
            const bioBtnText = document.getElementById('bioBtnText');
            const bioDisplay = document.getElementById('bioDisplay');
            const bioFormWrapper = document.getElementById('bioFormWrapper');
            const bioForm = document.getElementById('bioForm');
            const bioInput = document.getElementById('bioInput');
            const btnCancelBio = document.getElementById('btnCancelBio');
            const btnSaveBio = document.getElementById('btnSaveBio');
            const charCounter = document.getElementById('charCounter');

            function updateCharCount() {
                const count = bioInput.value.length;
                charCounter.textContent = `${count} / 500`;
            }

            if (bioInput) {
                bioInput.addEventListener('input', updateCharCount);
                updateCharCount();
            }

            function openBioEdit() {
                bioDisplay.style.display = 'none';
                bioFormWrapper.classList.add('active');
                bioBtnText.textContent = 'Batal';
                updateCharCount();
                bioInput.focus();
            }

            function closeBioEdit() {
                bioFormWrapper.classList.remove('active');
                bioDisplay.style.display = 'block';
                bioBtnText.textContent = 'Edit Bio';
            }

            if (btnToggleBioEdit) {
                btnToggleBioEdit.addEventListener('click', function () {
                    if (bioFormWrapper.classList.contains('active')) {
                        closeBioEdit();
                    } else {
                        openBioEdit();
                    }
                });
            }

            if (btnCancelBio) {
                btnCancelBio.addEventListener('click', closeBioEdit);
            }

            if (bioForm) {
                bioForm.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    const newBio = bioInput.value.trim();
                    btnSaveBio.disabled = true;
                    btnSaveBio.querySelector('span').textContent = 'Menyimpan...';

                    try {
                        const response = await fetch("{{ route('whisperly.profile.bio.update') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ bio: newBio })
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            if (newBio.length > 0) {
                                bioDisplay.textContent = newBio;
                            } else {
                                bioDisplay.innerHTML = '<span class="bio-empty">Belum ada bio. Ceritakan sedikit tentang dirimu di sini...</span>';
                            }

                            closeBioEdit();
                            showToast(data.message || 'Bio berhasil diperbarui!');
                        } else {
                            showToast(data.message || 'Gagal menyimpan bio.', 'error');
                        }
                    } catch (err) {
                        showToast('Terjadi kesalahan jaringan saat menyimpan bio.', 'error');
                    } finally {
                        btnSaveBio.disabled = false;
                        btnSaveBio.querySelector('span').textContent = 'Simpan';
                    }
                });
            }
        });
    </script>

</body>

</html>