{{-- ============================================================
     WHISPERLY GLOBAL NAVBAR

     File:
     resources/views/whisperly/navbar.blade.php

     MENU:
     USER:
     - Home
     - Chat
     - Lihat Talent
     - Pengaduan
     - Logout

     TALENT:
     - Home
     - Lihat Talent
     - Pengaduan
     - Chat
     - Edit Profil
     - Logout

     ADMIN:
     - Home
     - Lihat Talent
     - Pengaduan
     - Logout

     TIDAK ADA:
     - Profil
     - Profil Saya
============================================================ --}}

@php
    $currentUser = auth('whisperly')->user();
@endphp

<style>
    /* =========================================================
       RESET
    ========================================================= */

    .whisperly-nav,
    .whisperly-nav *,
    .whisperly-dropdown,
    .whisperly-dropdown * {
        box-sizing: border-box;
    }

    /* =========================================================
       NAVBAR
    ========================================================= */

    .whisperly-nav {
        position: sticky;
        top: 0;
        z-index: 9999;

        width: 100%;
        min-height: 78px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 13px 34px;

        background: rgba(14, 13, 30, 0.86);

        border-bottom: 1px solid rgba(255, 255, 255, 0.08);

        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);

        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.16);

        font-family:
            Arial,
            Helvetica,
            sans-serif;
    }

    /* =========================================================
       BRAND
    ========================================================= */

    .whisperly-brand {
        position: relative;

        display: inline-flex;
        align-items: center;

        color: #fffaf7;

        font-family:
            Georgia,
            "Times New Roman",
            serif;

        font-size: 24px;
        font-weight: 700;

        letter-spacing: 0.14em;

        text-decoration: none;

        white-space: nowrap;

        transition:
            transform 0.25s ease,
            color 0.25s ease;
    }

    .whisperly-brand::before {
        content: "";

        width: 7px;
        height: 7px;

        margin-right: 10px;

        flex-shrink: 0;

        border-radius: 50%;

        background:
            linear-gradient(
                135deg,
                #e7a2b6,
                #c9b9ef
            );

        box-shadow:
            0 0 16px rgba(231, 162, 182, 0.65);
    }

    .whisperly-brand:hover {
        color: #ded5f6;

        transform: translateY(-1px);
    }

    /* =========================================================
       RIGHT NAVIGATION
    ========================================================= */

    .whisperly-nav-right {
        display: flex;
        align-items: center;

        gap: 10px;

        flex-shrink: 0;
    }

    /* =========================================================
       USER PILL
    ========================================================= */

    .whisperly-user-pill {
        min-height: 45px;

        display: flex;
        align-items: center;

        gap: 9px;

        padding: 5px 14px 5px 6px;

        border: 1px solid rgba(255, 255, 255, 0.10);

        border-radius: 999px;

        background: rgba(255, 255, 255, 0.045);

        transition:
            background 0.25s ease,
            border-color 0.25s ease;
    }

    .whisperly-user-pill:hover {
        background: rgba(255, 255, 255, 0.075);

        border-color: rgba(255, 255, 255, 0.17);
    }

    /* =========================================================
       USER AVATAR
    ========================================================= */

    .whisperly-user-avatar {
        width: 34px;
        height: 34px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        color: #241f35;

        background:
            linear-gradient(
                135deg,
                #f2c8d4,
                #c9b9ef
            );

        font:
            700 12px Arial,
            sans-serif;

        box-shadow:
            0 4px 14px rgba(0, 0, 0, 0.18);
    }

    /* =========================================================
       USER INFORMATION
    ========================================================= */

    .whisperly-user-info {
        display: flex;
        flex-direction: column;

        gap: 2px;

        min-width: 0;
    }

    .whisperly-username {
        max-width: 125px;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

        color: rgba(255, 250, 247, 0.90);

        font:
            700 12px Arial,
            sans-serif;
    }

    .whisperly-user-role {
        color: rgba(255, 255, 255, 0.36);

        font:
            600 8px Arial,
            sans-serif;

        letter-spacing: 0.10em;

        text-transform: uppercase;
    }

    /* =========================================================
       MENU WRAPPER
    ========================================================= */

    .whisperly-menu-wrapper {
        position: relative;
    }

    /* =========================================================
       MENU BUTTON
    ========================================================= */

    .whisperly-menu-button {
        position: relative;

        width: 45px;
        height: 45px;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 0;

        border: 1px solid rgba(255, 255, 255, 0.12);

        border-radius: 15px;

        color: #fffaf7;

        background: rgba(255, 255, 255, 0.055);

        cursor: pointer;

        transition:
            background 0.25s ease,
            border-color 0.25s ease,
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .whisperly-menu-button:hover {
        background: rgba(201, 185, 239, 0.13);

        border-color: rgba(201, 185, 239, 0.34);

        transform: translateY(-2px);

        box-shadow:
            0 12px 30px rgba(0, 0, 0, 0.24);
    }

    .whisperly-menu-button.active {
        background: rgba(231, 162, 182, 0.10);

        border-color: rgba(231, 162, 182, 0.32);

        box-shadow:
            0 10px 28px rgba(0, 0, 0, 0.20);
    }

    /* =========================================================
       THREE DOTS
    ========================================================= */

    .whisperly-dots {
        display: flex;
        align-items: center;
        justify-content: center;

        gap: 4px;

        transition: gap 0.25s ease;
    }

    .whisperly-dots span {
        width: 4px;
        height: 4px;

        border-radius: 50%;

        background: currentColor;

        transition:
            transform 0.25s ease,
            opacity 0.25s ease;
    }

    .whisperly-menu-button.active .whisperly-dots {
        gap: 0;
    }

    .whisperly-menu-button.active
    .whisperly-dots span:nth-child(1) {
        transform:
            translate(3px, 0)
            rotate(45deg);
    }

    .whisperly-menu-button.active
    .whisperly-dots span:nth-child(2) {
        opacity: 0;
    }

    .whisperly-menu-button.active
    .whisperly-dots span:nth-child(3) {
        transform:
            translate(-3px, 0)
            rotate(-45deg);
    }

    /* =========================================================
       DROPDOWN
    ========================================================= */

    .whisperly-dropdown {
        position: absolute;

        top: calc(100% + 14px);
        right: 0;

        width: 320px;

        padding: 10px;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, 0.12);

        border-radius: 25px;

        background:
            linear-gradient(
                145deg,
                rgba(37, 35, 65, 0.97),
                rgba(14, 13, 30, 0.99)
            );

        box-shadow:
            0 30px 80px rgba(0, 0, 0, 0.48);

        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);

        opacity: 0;
        visibility: hidden;

        transform:
            translateY(-9px)
            scale(0.96);

        transform-origin: top right;

        transition:
            opacity 0.22s ease,
            visibility 0.22s ease,
            transform 0.22s ease;
    }

    .whisperly-dropdown.show {
        opacity: 1;

        visibility: visible;

        transform:
            translateY(0)
            scale(1);
    }

    /* =========================================================
       DECORATIVE GLOW
    ========================================================= */

    .whisperly-dropdown::before {
        content: "";

        position: absolute;

        width: 190px;
        height: 190px;

        top: -110px;
        right: -70px;

        border-radius: 50%;

        background:
            rgba(201, 185, 239, 0.12);

        filter: blur(28px);

        pointer-events: none;
    }

    .whisperly-dropdown::after {
        content: "";

        position: absolute;

        width: 150px;
        height: 150px;

        bottom: -100px;
        left: -70px;

        border-radius: 50%;

        background:
            rgba(231, 162, 182, 0.07);

        filter: blur(28px);

        pointer-events: none;
    }

    /* =========================================================
       MINI PROFILE
    ========================================================= */

    .whisperly-menu-profile {
        position: relative;

        display: flex;
        align-items: center;

        gap: 12px;

        padding: 10px 10px 14px;

        z-index: 2;
    }

    .whisperly-menu-profile-avatar {
        width: 44px;
        height: 44px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 14px;

        color: #241f35;

        background:
            linear-gradient(
                135deg,
                #f2c8d4,
                #c9b9ef
            );

        font:
            700 13px Arial,
            sans-serif;

        box-shadow:
            0 5px 15px rgba(0, 0, 0, 0.18);
    }

    .whisperly-menu-profile-info {
        min-width: 0;

        display: flex;
        flex-direction: column;

        gap: 4px;
    }

    .whisperly-menu-profile-name {
        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

        color: rgba(255, 250, 247, 0.96);

        font:
            700 13px Arial,
            sans-serif;
    }

    .whisperly-menu-profile-role {
        color: rgba(255, 255, 255, 0.38);

        font:
            600 9px Arial,
            sans-serif;

        letter-spacing: 0.12em;

        text-transform: uppercase;
    }

    /* =========================================================
       DIVIDER
    ========================================================= */

    .whisperly-divider {
        position: relative;

        height: 1px;

        margin: 0 8px 8px;

        background:
            rgba(255, 255, 255, 0.07);

        z-index: 2;
    }

    /* =========================================================
       DROPDOWN ITEM
    ========================================================= */

    .whisperly-dropdown-item {
        position: relative;

        display: flex;
        align-items: center;

        gap: 12px;

        width: 100%;
        min-height: 59px;

        margin-bottom: 4px;

        padding: 7px 9px;

        border-radius: 16px;

        color: #fffaf7;

        text-decoration: none;

        overflow: hidden;

        z-index: 2;

        transition:
            background 0.25s ease,
            transform 0.25s ease;
    }

    .whisperly-dropdown-item:last-child {
        margin-bottom: 0;
    }

    .whisperly-dropdown-item:hover {
        background:
            rgba(255, 255, 255, 0.065);

        transform:
            translateX(3px);
    }

    /* =========================================================
       ACTIVE LINE
    ========================================================= */

    .whisperly-dropdown-item::before {
        content: "";

        position: absolute;

        left: 0;

        top: 10px;
        bottom: 10px;

        width: 2px;

        border-radius: 999px;

        background:
            linear-gradient(
                180deg,
                #e7a2b6,
                #c9b9ef
            );

        opacity: 0;

        transform:
            scaleY(0.3);

        transition:
            opacity 0.25s ease,
            transform 0.25s ease;
    }

    .whisperly-dropdown-item:hover::before {
        opacity: 1;

        transform:
            scaleY(1);
    }

    /* =========================================================
       ICON BOX
    ========================================================= */

    .whisperly-dropdown-icon {
        width: 40px;
        height: 40px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border:
            1px solid rgba(255, 255, 255, 0.07);

        border-radius: 12px;

        color: #ded5f6;

        background:
            rgba(255, 255, 255, 0.045);

        transition:
            background 0.25s ease,
            border-color 0.25s ease,
            color 0.25s ease,
            transform 0.25s ease;
    }

    .whisperly-dropdown-icon svg {
        width: 18px;
        height: 18px;

        display: block;
    }

    .whisperly-dropdown-item:hover
    .whisperly-dropdown-icon {
        color: #f2c8d4;

        background:
            rgba(231, 162, 182, 0.10);

        border-color:
            rgba(231, 162, 182, 0.16);

        transform:
            scale(1.06);
    }

    /* =========================================================
       TEXT
    ========================================================= */

    .whisperly-dropdown-text {
        display: flex;
        flex-direction: column;

        gap: 3px;

        min-width: 0;
    }

    .whisperly-dropdown-text strong {
        color:
            rgba(255, 250, 247, 0.95);

        font:
            700 12px Arial,
            sans-serif;
    }

    .whisperly-dropdown-text small {
        color:
            rgba(255, 255, 255, 0.34);

        font:
            400 9px Arial,
            sans-serif;

        line-height: 1.3;

        transition:
            color 0.25s ease;
    }

    .whisperly-dropdown-item:hover
    .whisperly-dropdown-text small {
        color:
            rgba(255, 255, 255, 0.54);
    }

    /* =========================================================
       ARROW
    ========================================================= */

    .whisperly-dropdown-arrow {
        margin-left: auto;

        color:
            rgba(255, 255, 255, 0.20);

        font:
            400 17px Arial,
            sans-serif;

        transition:
            color 0.25s ease,
            transform 0.25s ease;
    }

    .whisperly-dropdown-item:hover
    .whisperly-dropdown-arrow {
        color: #f2c8d4;

        transform:
            translateX(4px);
    }

    /* =========================================================
       LOGOUT
    ========================================================= */

    .whisperly-logout {
        width: 100%;

        display: flex;
        align-items: center;

        gap: 12px;

        min-height: 56px;

        margin-top: 4px;

        padding: 7px 9px;

        border: 0;

        border-radius: 16px;

        color: #e7a2b6;

        background: transparent;

        font:
            700 12px Arial,
            sans-serif;

        text-align: left;

        cursor: pointer;

        transition:
            background 0.25s ease,
            transform 0.25s ease;
    }

    .whisperly-logout:hover {
        background:
            rgba(231, 162, 182, 0.08);

        transform:
            translateX(3px);
    }

    .whisperly-logout-icon {
        width: 40px;
        height: 40px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border:
            1px solid rgba(231, 162, 182, 0.12);

        border-radius: 12px;

        background:
            rgba(231, 162, 182, 0.06);
    }

    .whisperly-logout-icon svg {
        width: 18px;
        height: 18px;
    }

    /* =========================================================
       LOGOUT DIVIDER
    ========================================================= */

    .whisperly-logout-divider {
        height: 1px;

        margin: 8px 8px 4px;

        background:
            rgba(255, 255, 255, 0.07);
    }

    /* =========================================================
       TABLET
    ========================================================= */

    @media (max-width: 900px) {
        .whisperly-nav {
            padding: 13px 24px;
        }

        .whisperly-brand {
            font-size: 22px;
        }

        .whisperly-dropdown {
            width: 315px;
        }
    }

    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 700px) {
        .whisperly-nav {
            min-height: 68px;

            padding:
                11px 17px;
        }

        .whisperly-brand {
            font-size: 20px;

            letter-spacing:
                0.12em;
        }

        .whisperly-user-info {
            display: none;
        }

        .whisperly-user-pill {
            padding: 5px;
        }

        .whisperly-menu-button {
            width: 43px;
            height: 43px;
        }

        .whisperly-dropdown {
            width:
                min(
                    320px,
                    calc(100vw - 30px)
                );

            right: -2px;
        }
    }

    /* =========================================================
       SMALL MOBILE
    ========================================================= */

    @media (max-width: 420px) {
        .whisperly-nav {
            padding:
                10px 14px;
        }

        .whisperly-brand {
            font-size: 18px;

            letter-spacing:
                0.10em;
        }

        .whisperly-dropdown {
            width:
                calc(100vw - 24px);

            right: -3px;

            border-radius:
                22px;
        }

        .whisperly-menu-profile-avatar {
            width: 40px;
            height: 40px;
        }

        .whisperly-dropdown-icon {
            width: 38px;
            height: 38px;
        }
    }

    /* =========================================================
       EXTRA SMALL PHONE
    ========================================================= */

    @media (max-width: 350px) {
        .whisperly-nav {
            padding-left: 10px;
            padding-right: 10px;
        }

        .whisperly-brand {
            font-size: 16px;

            letter-spacing:
                0.08em;
        }

        .whisperly-brand::before {
            width: 6px;
            height: 6px;

            margin-right: 7px;
        }

        .whisperly-menu-button {
            width: 40px;
            height: 40px;
        }

        .whisperly-user-avatar {
            width: 32px;
            height: 32px;
        }
    }
</style>


{{-- ============================================================
     NAVBAR
============================================================ --}}

<header class="whisperly-nav">

    {{-- ========================================================
         BRAND
    ========================================================= --}}

    <a
        href="{{ url('/whisperly') }}"
        class="whisperly-brand"
    >
        WHISPERLY
    </a>


    {{-- ========================================================
         RIGHT NAVIGATION
    ========================================================= --}}

    <div class="whisperly-nav-right">

        @if ($currentUser)

            {{-- =================================================
                 USER PILL
            ================================================== --}}

            <div class="whisperly-user-pill">

                <div class="whisperly-user-avatar">
                    {{ strtoupper(
                        substr(
                            $currentUser->username,
                            0,
                            1
                        )
                    ) }}
                </div>

                <div class="whisperly-user-info">

                    <span class="whisperly-username">
                        {{ $currentUser->username }}
                    </span>

                    <span class="whisperly-user-role">
                        {{ $currentUser->role }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                 MENU WRAPPER
            ================================================== --}}

            <div class="whisperly-menu-wrapper">

                {{-- =================================================
                     MENU BUTTON
                ================================================== --}}

                <button
                    type="button"
                    class="whisperly-menu-button"
                    id="whisperlyMenuButton"
                    aria-label="Buka menu"
                    aria-expanded="false"
                >

                    <span class="whisperly-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>

                </button>


                {{-- =================================================
                     DROPDOWN
                ================================================== --}}

                <div
                    class="whisperly-dropdown"
                    id="whisperlyDropdown"
                >

                    {{-- =================================================
                         HEADER USER
                    ================================================== --}}

                    <div class="whisperly-menu-profile">

                        <div class="whisperly-menu-profile-avatar">
                            {{ strtoupper(
                                substr(
                                    $currentUser->username,
                                    0,
                                    1
                                )
                            ) }}
                        </div>

                        <div class="whisperly-menu-profile-info">

                            <span class="whisperly-menu-profile-name">
                                {{ $currentUser->username }}
                            </span>

                            <span class="whisperly-menu-profile-role">
                                {{ $currentUser->role }}
                            </span>

                        </div>

                    </div>


                    <div class="whisperly-divider"></div>


                    {{-- =================================================
                         USER MENU
                    ================================================== --}}

                    @if ($currentUser->role === 'user')

                        {{-- =================================================
                             HOME
                        ================================================== --}}

                        <a
                            href="{{ url('/whisperly') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M3.5 10.7L12 3.7L20.5 10.7V20H14.8V14.4H9.2V20H3.5V10.7Z"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linejoin="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Home
                                </strong>

                                <small>
                                    Kembali ke halaman utama
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>


                        {{-- =================================================
                             CHAT
                        ================================================== --}}

                        <a
                            href="{{ route('whisperly.chat.index') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M5 5.5H19V16H9L5 19V5.5Z"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M8.5 9.5H15.5"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M8.5 12.5H13"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Chat
                                </strong>

                                <small>
                                    Mulai percakapan
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>


                        {{-- =================================================
                             LIHAT TALENT
                        ================================================== --}}

                        <a
                            href="{{ route('whisperly.talents.index') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <circle
                                        cx="12"
                                        cy="8"
                                        r="3"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    />

                                    <path
                                        d="M5.5 20C5.9 16.1 8 14 12 14C16 14 18.1 16.1 18.5 20"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Lihat Talent
                                </strong>

                                <small>
                                    Temukan talent yang tersedia
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>


                        {{-- =================================================
                             PENGADUAN
                        ================================================== --}}

                        <a
                            href="{{ route('pengaduan') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M5 4.5H19V16H9L5 19.5V4.5Z"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M8.5 9H15.5"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M8.5 12H13"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Pengaduan
                                </strong>

                                <small>
                                    Sampaikan ceritamu
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>

                    @endif


                    {{-- =================================================
                         TALENT MENU
                    ================================================== --}}

                    @if ($currentUser->role === 'talent')

                        {{-- =================================================
                             HOME
                        ================================================== --}}

                        <a
                            href="{{ url('/whisperly') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M3.5 10.7L12 3.7L20.5 10.7V20H14.8V14.4H9.2V20H3.5V10.7Z"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linejoin="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Home
                                </strong>

                                <small>
                                    Kembali ke halaman utama
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>


                        {{-- =================================================
                             LIHAT TALENT
                        ================================================== --}}

                        <a
                            href="{{ route('whisperly.talents.index') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <circle
                                        cx="12"
                                        cy="8"
                                        r="3"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    />

                                    <path
                                        d="M5.5 20C5.9 16.1 8 14 12 14C16 14 18.1 16.1 18.5 20"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Lihat Talent
                                </strong>

                                <small>
                                    Lihat daftar talent
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>


                        {{-- =================================================
                             PENGADUAN
                        ================================================== --}}

                        <a
                            href="{{ route('pengaduan') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M5 4.5H19V16H9L5 19.5V4.5Z"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M8.5 9H15.5"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M8.5 12H13"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Pengaduan
                                </strong>

                                <small>
                                    Sampaikan ceritamu
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>


                        {{-- =================================================
                             CHAT
                        ================================================== --}}

                        <a
                            href="{{ route('whisperly.chat.index') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M5 5.5H19V16H9L5 19V5.5Z"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M8.5 9.5H15.5"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M8.5 12.5H13"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Chat
                                </strong>

                                <small>
                                    Mulai percakapan
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>


                        {{-- =================================================
                             EDIT PROFIL
                        ================================================== --}}

                        <a
                            href="{{ route('talent.edit') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M4.5 19.5L5.4 15.2L15.8 4.8C16.6 4 17.9 4 18.7 4.8L19.2 5.3C20 6.1 20 7.4 19.2 8.2L8.8 18.6L4.5 19.5Z"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M14.8 5.8L18.2 9.2"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Edit Profil
                                </strong>

                                <small>
                                    Ubah profil dan jadwalmu
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>

                    @endif


                    {{-- =================================================
                         ADMIN MENU
                    ================================================== --}}

                    @if ($currentUser->role === 'admin')

                        {{-- =================================================
                             HOME
                        ================================================== --}}

                        <a
                            href="{{ url('/whisperly') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M3.5 10.7L12 3.7L20.5 10.7V20H14.8V14.4H9.2V20H3.5V10.7Z"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linejoin="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Home
                                </strong>

                                <small>
                                    Kembali ke Whisperly
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>


                        {{-- =================================================
                             LIHAT TALENT
                        ================================================== --}}

                        <a
                            href="{{ route('whisperly.talents.index') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <circle
                                        cx="12"
                                        cy="8"
                                        r="3"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    />

                                    <path
                                        d="M5.5 20C5.9 16.1 8 14 12 14C16 14 18.1 16.1 18.5 20"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Lihat Talent
                                </strong>

                                <small>
                                    Kelola daftar talent
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>


                        {{-- =================================================
                             PENGADUAN ADMIN
                        ================================================== --}}

                        <a
                            href="{{ route('admin.menfess.index') }}"
                            class="whisperly-dropdown-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M5 4.5H19V16H9L5 19.5V4.5Z"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M8.5 9H15.5"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M8.5 12H13"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span class="whisperly-dropdown-text">

                                <strong>
                                    Pengaduan
                                </strong>

                                <small>
                                    Kelola ruang pengaduan
                                </small>

                            </span>


                            <span class="whisperly-dropdown-arrow">
                                →
                            </span>

                        </a>

                    @endif


                    {{-- =================================================
                         LOGOUT
                    ================================================== --}}

                    <div class="whisperly-logout-divider"></div>


                    <form
                        method="POST"
                        action="{{ route('logout.baru') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="whisperly-logout"
                        >

                            <span class="whisperly-logout-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M10 5H6.5C5.67 5 5 5.67 5 6.5V17.5C5 18.33 5.67 19 6.5 19H10"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M14 8L18 12L14 16"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M18 12H9"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span>
                                Keluar
                            </span>

                        </button>

                    </form>

                </div>

            </div>

        @endif

    </div>

</header>


{{-- ============================================================
     JAVASCRIPT
============================================================ --}}

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const menuButton =
                document.getElementById(
                    'whisperlyMenuButton'
                );

            const dropdown =
                document.getElementById(
                    'whisperlyDropdown'
                );


            if (
                !menuButton ||
                !dropdown
            ) {
                return;
            }


            /* =====================================================
               OPEN MENU
            ===================================================== */

            function openMenu() {

                dropdown.classList.add('show');

                menuButton.classList.add('active');

                menuButton.setAttribute(
                    'aria-expanded',
                    'true'
                );
            }


            /* =====================================================
               CLOSE MENU
            ===================================================== */

            function closeMenu() {

                dropdown.classList.remove('show');

                menuButton.classList.remove('active');

                menuButton.setAttribute(
                    'aria-expanded',
                    'false'
                );
            }


            /* =====================================================
               TOGGLE MENU
            ===================================================== */

            function toggleMenu() {

                const isOpen =
                    dropdown.classList.contains('show');

                if (isOpen) {

                    closeMenu();

                } else {

                    openMenu();

                }
            }


            /* =====================================================
               BUTTON CLICK
            ===================================================== */

            menuButton.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                    toggleMenu();
                }
            );


            /* =====================================================
               DROPDOWN CLICK
            ===================================================== */

            dropdown.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();
                }
            );


            /* =====================================================
               OUTSIDE CLICK
            ===================================================== */

            document.addEventListener(
                'click',
                function (event) {

                    if (
                        !dropdown.contains(
                            event.target
                        ) &&
                        !menuButton.contains(
                            event.target
                        )
                    ) {

                        closeMenu();
                    }
                }
            );


            /* =====================================================
               ESCAPE
            ===================================================== */

            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape'
                    ) {

                        closeMenu();

                        menuButton.focus();
                    }
                }
            );


            /* =====================================================
               MENU ITEM
            ===================================================== */

            const menuItems =
                dropdown.querySelectorAll(
                    '.whisperly-dropdown-item'
                );


            menuItems.forEach(
                function (item) {

                    item.addEventListener(
                        'click',
                        function () {

                            closeMenu();
                        }
                    );
                }
            );

        }
    );
</script>