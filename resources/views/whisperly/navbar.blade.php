{{-- ============================================================
     WHISPERLY GLOBAL NAVBAR
     File:
     resources/views/whisperly/navbar.blade.php
============================================================ --}}

@php
    $currentUser = auth('whisperly')->user();

    $currentTalentProfile = null;

    if ($currentUser && $currentUser->role === 'talent') {
        $currentTalentProfile = \App\Modules\talents\Models\talents::query()
            ->where('pengguna_id', $currentUser->id)
            ->first();
    }
@endphp

<style>
    /* =========================================================
       RESET
    ========================================================== */

    .whisperly-nav,
    .whisperly-nav *,
    .whisperly-dropdown,
    .whisperly-dropdown * {
        box-sizing: border-box;
    }


    /* =========================================================
       NAVBAR
    ========================================================== */

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

        box-shadow:
            0 10px 35px rgba(0, 0, 0, 0.16);

        font-family:
            Arial,
            Helvetica,
            sans-serif;
    }


    /* =========================================================
       BRAND
    ========================================================== */

    .whisperly-brand {
        position: relative;

        display: inline-flex;
        align-items: center;

        color: #fffaf7;

        font-family: Georgia, serif !important;

        font-size: 26px !important;
        font-weight: 700 !important;

        letter-spacing: 1px !important;

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
            0 0 16px
            rgba(231, 162, 182, 0.65);
    }

    .whisperly-brand:hover {
        color: #ded5f6;

        transform:
            translateY(-1px);
    }


    /* =========================================================
       RIGHT NAVIGATION
    ========================================================== */

    .whisperly-nav-right {
        display: flex;
        align-items: center;

        gap: 10px;

        flex-shrink: 0;
    }


    /* =========================================================
       USER PROFILE LINK
    ========================================================== */

    .whisperly-user-profile-link {
        position: relative;
        z-index: 10001;

        display: block;

        color: inherit;

        text-decoration: none;

        border-radius: 999px;

        outline: none;

        cursor: pointer;

        pointer-events: auto;
    }

    .whisperly-user-profile-link:focus-visible {
        outline:
            2px solid
            rgba(201, 185, 239, 0.55);

        outline-offset: 3px;
    }


    /* =========================================================
       USER PILL
    ========================================================== */

    .whisperly-user-pill {
        min-height: 45px;
        position: relative;
        z-index: 10001;

        display: flex;
        align-items: center;

        gap: 9px;

        padding:
            5px 14px 5px 6px;

        border:
            1px solid
            rgba(255, 255, 255, 0.10);

        border-radius: 999px;

        background:
            rgba(255, 255, 255, 0.045);

        cursor: pointer;

        transition:
            background 0.25s ease,
            border-color 0.25s ease,
            transform 0.25s ease;
    }

    .whisperly-user-profile-link:hover
    .whisperly-user-pill {
        background:
            rgba(255, 255, 255, 0.075);

        border-color:
            rgba(255, 255, 255, 0.17);

        transform:
            translateY(-1px);
    }


    /* =========================================================
       USER AVATAR
    ========================================================== */

    .whisperly-user-avatar {
        width: 34px !important;
        height: 34px !important;

        min-width: 34px !important;
        min-height: 34px !important;

        max-width: 34px !important;
        max-height: 34px !important;

        flex-shrink: 0 !important;

        display: flex;

        align-items: center;
        justify-content: center;

        overflow: hidden !important;

        border-radius: 50% !important;

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
            0 4px 14px
            rgba(0, 0, 0, 0.18);
    }

    .whisperly-user-avatar img {
        width: 34px !important;
        height: 34px !important;

        min-width: 34px !important;
        min-height: 34px !important;

        max-width: 34px !important;
        max-height: 34px !important;

        display: block !important;

        object-fit: cover !important;

        border-radius: 50% !important;
    }


    /* =========================================================
       USER INFORMATION
    ========================================================== */

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

        color:
            rgba(255, 250, 247, 0.90);

        font:
            700 12px Arial,
            sans-serif;
    }

    .whisperly-user-role {
        color:
            rgba(255, 255, 255, 0.36);

        font:
            600 8px Arial,
            sans-serif;

        letter-spacing: 0.10em;

        text-transform: uppercase;
    }


    /* =========================================================
       MENU WRAPPER
    ========================================================== */

    .whisperly-menu-wrapper {
        position: relative;
    }


    /* =========================================================
       MENU BUTTON
    ========================================================== */

    .whisperly-menu-button {
        position: relative;

        width: 45px;
        height: 45px;

        display: flex;

        align-items: center;
        justify-content: center;

        padding: 0;

        border:
            1px solid
            rgba(255, 255, 255, 0.12);

        border-radius: 15px;

        color: #fffaf7;

        background:
            rgba(255, 255, 255, 0.055);

        cursor: pointer;

        transition:
            background 0.25s ease,
            border-color 0.25s ease,
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .whisperly-menu-button:hover {
        background:
            rgba(201, 185, 239, 0.13);

        border-color:
            rgba(201, 185, 239, 0.34);

        transform:
            translateY(-2px);

        box-shadow:
            0 12px 30px
            rgba(0, 0, 0, 0.24);
    }

    .whisperly-menu-button.active {
        background:
            rgba(231, 162, 182, 0.10);

        border-color:
            rgba(231, 162, 182, 0.32);

        box-shadow:
            0 10px 28px
            rgba(0, 0, 0, 0.20);
    }


    /* =========================================================
       THREE DOTS
    ========================================================== */

    .whisperly-dots {
        display: flex;

        align-items: center;
        justify-content: center;

        gap: 4px;

        transition:
            gap 0.25s ease;
    }

    .whisperly-dots span {
        width: 4px;
        height: 4px;

        border-radius: 50%;

        background:
            currentColor;

        transition:
            transform 0.25s ease,
            opacity 0.25s ease;
    }

    .whisperly-menu-button.active
    .whisperly-dots {
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
    ========================================================== */

    .whisperly-dropdown {
        position: absolute;

        top: calc(100% + 14px);
        right: 0;

        width: 320px;

        padding: 10px;

        overflow: hidden;

        border:
            1px solid
            rgba(255, 255, 255, 0.12);

        border-radius: 25px;

        background:
            linear-gradient(
                145deg,
                rgba(37, 35, 65, 0.97),
                rgba(14, 13, 30, 0.99)
            );

        box-shadow:
            0 30px 80px
            rgba(0, 0, 0, 0.48);

        backdrop-filter:
            blur(28px);

        -webkit-backdrop-filter:
            blur(28px);

        opacity: 0;

        visibility: hidden;

        transform:
            translateY(-9px)
            scale(0.96);

        transform-origin:
            top right;

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
    ========================================================== */

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

        filter:
            blur(28px);

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

        filter:
            blur(28px);

        pointer-events: none;
    }


    /* =========================================================
       MINI PROFILE
    ========================================================== */

    .whisperly-menu-profile {
        position: relative;

        display: flex;

        align-items: center;

        gap: 12px;

        padding:
            10px
            10px
            14px;

        z-index: 2;
    }

    .whisperly-menu-profile-avatar {
        width: 44px !important;
        height: 44px !important;

        min-width: 44px !important;
        min-height: 44px !important;

        max-width: 44px !important;
        max-height: 44px !important;

        flex-shrink: 0 !important;

        display: flex;

        align-items: center;
        justify-content: center;

        overflow: hidden !important;

        border-radius:
            14px !important;

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
            0 5px 15px
            rgba(0, 0, 0, 0.18);
    }

    .whisperly-menu-profile-avatar img {
        width: 44px !important;
        height: 44px !important;

        min-width: 44px !important;
        min-height: 44px !important;

        max-width: 44px !important;
        max-height: 44px !important;

        display: block !important;

        object-fit: cover !important;

        border-radius:
            14px !important;
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

        color:
            rgba(255, 250, 247, 0.96);

        font:
            700 13px Arial,
            sans-serif;
    }

    .whisperly-menu-profile-role {
        color:
            rgba(255, 255, 255, 0.38);

        font:
            600 9px Arial,
            sans-serif;

        letter-spacing: 0.12em;

        text-transform: uppercase;
    }


    /* =========================================================
       DIVIDER
    ========================================================== */

    .whisperly-divider {
        position: relative;

        height: 1px;

        margin:
            0
            8px
            8px;

        background:
            rgba(255, 255, 255, 0.07);

        z-index: 2;
    }


    /* =========================================================
       DROPDOWN ITEM
    ========================================================== */

    .whisperly-dropdown-item {
        position: relative;

        display: flex;

        align-items: center;

        gap: 12px;

        width: 100%;

        min-height: 59px;

        margin-bottom: 4px;

        padding:
            7px
            9px;

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
    ========================================================== */

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
    ========================================================== */

    .whisperly-dropdown-icon {
        width: 40px;
        height: 40px;

        flex-shrink: 0;

        display: flex;

        align-items: center;
        justify-content: center;

        border:
            1px solid
            rgba(255, 255, 255, 0.07);

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
    ========================================================== */

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
    ========================================================== */

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
       EDIT PROFILE SPECIAL
    ========================================================== */

    .whisperly-edit-profile-item {
        border:
            1px solid
            rgba(220, 184, 102, 0.10);

        background:
            linear-gradient(
                135deg,
                rgba(220, 184, 102, 0.045),
                rgba(201, 185, 239, 0.025)
            );
    }

    .whisperly-edit-profile-item
    .whisperly-dropdown-icon {
        color: #e3c477;

        border-color:
            rgba(220, 184, 102, 0.16);

        background:
            rgba(220, 184, 102, 0.055);
    }

    .whisperly-edit-profile-item:hover
    .whisperly-dropdown-icon {
        color: #f1d58a;

        background:
            rgba(220, 184, 102, 0.12);

        border-color:
            rgba(220, 184, 102, 0.28);
    }


    /* =========================================================
       LOGOUT
    ========================================================== */

    .whisperly-logout {
        width: 100%;

        display: flex;

        align-items: center;

        gap: 12px;

        min-height: 56px;

        margin-top: 4px;

        padding:
            7px
            9px;

        border: 0;

        border-radius: 16px;

        color: #e7a2b6;

        background:
            transparent;

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
            1px solid
            rgba(231, 162, 182, 0.12);

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
    ========================================================== */

    .whisperly-logout-divider {
        height: 1px;

        margin:
            8px
            8px
            4px;

        background:
            rgba(255, 255, 255, 0.07);
    }

        /* =========================================================
       CHAT THEME - LIGHT MODE
       Mengikuti tema chat dari show.blade.php
    ========================================================== */

    body.theme-light .whisperly-nav {
        background:
            rgba(255, 255, 255, 0.90);

        border-bottom:
            1px solid
            rgba(0, 0, 0, 0.08);

        box-shadow:
            0 10px 35px
            rgba(0, 0, 0, 0.08);
    }


    /* =========================================================
       BRAND - LIGHT
    ========================================================== */

    body.theme-light .whisperly-brand {
        color: #17233f;
    }

    body.theme-light .whisperly-brand:hover {
        color: #334a78;
    }


    /* =========================================================
       USER PROFILE - LIGHT
    ========================================================== */

    body.theme-light .whisperly-user-pill {
        border-color:
            rgba(0, 0, 0, 0.10);

        background:
            rgba(0, 0, 0, 0.045);
    }

    body.theme-light
    .whisperly-user-profile-link:hover
    .whisperly-user-pill {
        background:
            rgba(0, 0, 0, 0.075);

        border-color:
            rgba(0, 0, 0, 0.15);
    }


    body.theme-light .whisperly-username {
        color:
            rgba(23, 35, 63, 0.92);
    }

    body.theme-light .whisperly-user-role {
        color:
            rgba(23, 35, 63, 0.45);
    }


    /* =========================================================
       MENU BUTTON - LIGHT
    ========================================================== */

    body.theme-light .whisperly-menu-button {
        color: #17233f;

        border-color:
            rgba(0, 0, 0, 0.10);

        background:
            rgba(0, 0, 0, 0.045);
    }

    body.theme-light .whisperly-menu-button:hover {
        background:
            rgba(201, 185, 239, 0.18);

        border-color:
            rgba(201, 185, 239, 0.40);

        box-shadow:
            0 12px 30px
            rgba(0, 0, 0, 0.10);
    }

    body.theme-light .whisperly-menu-button.active {
        background:
            rgba(231, 162, 182, 0.13);

        border-color:
            rgba(231, 162, 182, 0.35);

        box-shadow:
            0 10px 28px
            rgba(0, 0, 0, 0.10);
    }


    /* =========================================================
       DROPDOWN - LIGHT
    ========================================================== */

    body.theme-light .whisperly-dropdown {
        border-color:
            rgba(0, 0, 0, 0.10);

        background:
            linear-gradient(
                145deg,
                rgba(255, 255, 255, 0.98),
                rgba(245, 247, 252, 0.99)
            );

        box-shadow:
            0 30px 80px
            rgba(0, 0, 0, 0.18);
    }


    /* =========================================================
       DROPDOWN DECORATIVE GLOW - LIGHT
    ========================================================== */

    body.theme-light .whisperly-dropdown::before {
        background:
            rgba(201, 185, 239, 0.16);
    }

    body.theme-light .whisperly-dropdown::after {
        background:
            rgba(231, 162, 182, 0.10);
    }


    /* =========================================================
       MINI PROFILE - LIGHT
    ========================================================== */

    body.theme-light .whisperly-menu-profile-name {
        color:
            rgba(23, 35, 63, 0.96);
    }

    body.theme-light .whisperly-menu-profile-role {
        color:
            rgba(23, 35, 63, 0.42);
    }


    /* =========================================================
       DIVIDER - LIGHT
    ========================================================== */

    body.theme-light .whisperly-divider,
    body.theme-light .whisperly-logout-divider {
        background:
            rgba(0, 0, 0, 0.08);
    }


    /* =========================================================
       DROPDOWN ITEM - LIGHT
    ========================================================== */

    body.theme-light .whisperly-dropdown-item {
        color: #17233f;
    }

    body.theme-light .whisperly-dropdown-item:hover {
        background:
            rgba(0, 0, 0, 0.045);
    }


    /* =========================================================
       ICON BOX - LIGHT
    ========================================================== */

    body.theme-light .whisperly-dropdown-icon {
        color: #6675a0;

        border-color:
            rgba(0, 0, 0, 0.08);

        background:
            rgba(0, 0, 0, 0.035);
    }

    body.theme-light
    .whisperly-dropdown-item:hover
    .whisperly-dropdown-icon {
        color: #b06d86;

        background:
            rgba(231, 162, 182, 0.12);

        border-color:
            rgba(231, 162, 182, 0.20);
    }


    /* =========================================================
       DROPDOWN TEXT - LIGHT
    ========================================================== */

    body.theme-light .whisperly-dropdown-text strong {
        color:
            rgba(23, 35, 63, 0.95);
    }

    body.theme-light .whisperly-dropdown-text small {
        color:
            rgba(23, 35, 63, 0.46);
    }

    body.theme-light
    .whisperly-dropdown-item:hover
    .whisperly-dropdown-text small {
        color:
            rgba(23, 35, 63, 0.66);
    }


    /* =========================================================
       ARROW - LIGHT
    ========================================================== */

    body.theme-light .whisperly-dropdown-arrow {
        color:
            rgba(23, 35, 63, 0.30);
    }

    body.theme-light
    .whisperly-dropdown-item:hover
    .whisperly-dropdown-arrow {
        color: #b06d86;
    }


    /* =========================================================
       LOGOUT - LIGHT
    ========================================================== */

    body.theme-light .whisperly-logout {
        color: #b06d86;
    }

    body.theme-light .whisperly-logout:hover {
        background:
            rgba(231, 162, 182, 0.10);
    }

    body.theme-light .whisperly-logout-icon {
        border-color:
            rgba(231, 162, 182, 0.16);

        background:
            rgba(231, 162, 182, 0.07);
    }

    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 900px) {

        .whisperly-nav {
            pointer-events: auto;
            padding:
                13px
                24px;
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
    ========================================================== */

    @media (max-width: 700px) {

        .whisperly-nav {
            min-height: 68px;

            padding:
                11px
                17px;
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
    ========================================================== */

    @media (max-width: 420px) {

        .whisperly-nav {
            padding:
                10px
                14px;
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
            width: 40px !important;
            height: 40px !important;
        }

        .whisperly-dropdown-icon {
            width: 38px;
            height: 38px;
        }
    }


    /* =========================================================
       EXTRA SMALL PHONE
    ========================================================== */

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
            width: 32px !important;
            height: 32px !important;
        }
    }

    /* =========================================================
        NOTIFICATION
        ========================================================= */

        .notification-wrapper {
            position: relative;
            margin-right: 2px;
        }

        .notification-btn {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 15px;

            background: rgba(255, 255, 255, 0.055);

            color: #fffaf7;

            cursor: pointer;

            position: relative;

            font-size: 19px;

            transition:
                background 0.25s ease,
                border-color 0.25s ease,
                transform 0.25s ease;
        }

        .notification-btn:hover {
            background: rgba(201, 185, 239, 0.13);
            border-color: rgba(201, 185, 239, 0.34);
            transform: translateY(-2px);
        }

        .badge {
            position: absolute;

            top: -5px;
            right: -5px;

            min-width: 18px;
            height: 18px;

            padding: 0 4px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #ff3b30;
            color: #fff;

            font: 700 10px Arial, sans-serif;
        }

        .notification-dropdown {
            position: absolute;

            top: calc(100% + 14px);
            right: 0;

            width: 320px;
            max-height: 400px;

            overflow-y: auto;

            padding: 10px;

            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(37, 35, 65, 0.97),
                    rgba(14, 13, 30, 0.99)
                );

            box-shadow:
                0 30px 80px rgba(0, 0, 0, 0.48);

            z-index: 10000;

            display: none;
        }

        .notification-dropdown.show {
            display: block;
        }

        .notification-item {
            padding: 13px;

            border-bottom:
                1px solid
                rgba(255, 255, 255, 0.07);

            color: rgba(255, 250, 247, 0.85);

            font: 400 11px Arial, sans-serif;

            line-height: 1.5;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item strong {
            color: #fffaf7;
        }

        .chat-status-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 8px 14px;

            border-radius: 10px;

            font: 600 11px Arial, sans-serif;

            text-decoration: none;

            transition: .2s ease;
        }

        .chat-status-waiting {
            color: #fff3cd;
            background: rgba(245, 180, 60, .18);
            border: 1px solid rgba(245, 180, 60, .3);

            cursor: not-allowed;
        }

        .chat-status-active {
            color: #d9ffe8;
            background: rgba(40, 190, 105, .20);
            border: 1px solid rgba(40, 190, 105, .35);

            cursor: pointer;
        }

        .chat-status-active:hover {
            background: rgba(40, 190, 105, .32);
            transform: translateY(-1px);
        }

        /* ============================
        PENYESUAIAN DROPDOWN
        ============================ */

        .whisperly-dropdown {
            width: 320px !important;
            right: 0 !important;
        }

        .notification-dropdown {
        width: 250px !important;
        min-width: 250px !important;
        max-width: calc(100vw - 20px);
    }

    .notification-profile {
    display: flex;
    align-items: center;
    gap: 9px;
    margin-bottom: 8px;
}

.notification-avatar {
    width: 32px;
    height: 32px;
    min-width: 32px;
    border-radius: 50%;
    overflow: hidden;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #e7a2b6;
    color: #fff;

    font-weight: 700;
    font-size: 13px;
}

.notification-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.notification-profile strong {
    font-size: 14px;
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
        href="{{ route('whisperly.home') }}"
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
     NOTIFICATION
================================================== --}}

<div class="notification-wrapper">

    <button
        type="button"
        class="notification-btn"
        id="notificationButton"
        aria-label="Notifikasi"
    >
        🔔

        @if(isset($notificationCount) && $notificationCount > 0)
            <span class="badge">
                {{ $notificationCount }}
            </span>
        @endif
    </button>

    <div
        class="notification-dropdown"
        id="notificationDropdown"
    >

        @forelse(($notifications ?? []) as $booking)

    @php
        $status = $booking->chatStatus();
        $currentUser = auth('whisperly')->user();
    @endphp

    @if($status === 'completed')
        @continue
    @endif

    <div class="notification-item">

        @if($currentUser->role == 'talent')

            <div class="notification-profile">

    <div class="notification-avatar">

        @if($booking->pengguna->avatar_url)

            <img
                src="{{ $booking->pengguna->avatar_url }}"
                alt="{{ $booking->pengguna->username }}"
                onerror="this.onerror=null; this.src='{{ asset('assets/images/faces/1.jpg') }}';"
            >

        @else

            {{ strtoupper(
                substr(
                    $booking->pengguna->username,
                    0,
                    1
                )
            ) }}

        @endif

    </div>

    <strong>
        {{ $booking->pengguna->username }}
    </strong>

</div>

            <br>

            {{ $booking->schedule->start_time }}
            -
            {{ $booking->schedule->end_time }}

            <br><br>

        @else

    <div class="notification-profile">

        <div class="notification-avatar">

            @if($booking->talent->pengguna->avatar_url)

                <img
                    src="{{ $booking->talent->pengguna->avatar_url }}"
                    alt="{{ $booking->talent->pengguna->username }}"
                >

            @else

                {{ strtoupper(
                    substr(
                        $booking->talent->pengguna->username,
                        0,
                        1
                    )
                ) }}

            @endif

        </div>

        <strong>
            Booking dengan
            {{ $booking->talent->pengguna->username }}
        </strong>

    </div>

    <br>

    {{ $booking->schedule->start_time }}
    -
    {{ $booking->schedule->end_time }}

    <br><br>

@endif

        @if($status == 'upcoming')

            <button
                type="button"
                class="chat-status-btn chat-status-waiting"
                disabled
            >
                Belum Bisa Chat
            </button>

        @elseif($status == 'active')

            <a
                href="{{ route('whisperly.chat.show', $booking->id) }}"
                class="chat-status-btn chat-status-active"
            >
                Chat Sekarang
            </a>

        @endif

    </div>

@empty

    <div class="notification-item">
        Belum ada notifikasi.
    </div>

@endforelse

    </div>

</div>

            {{-- =================================================
                 USER PROFILE
                 KLIK UNTUK MEMBUKA HALAMAN PROFIL
            ================================================== --}}

            {{-- PROFIL ADMIN --}}
            <a
                href="{{ $currentUser->role === 'admin' ? route('admin.profile') : route('whisperly.profile') }}"
                class="whisperly-user-profile-link"
                aria-label="Buka profil {{ $currentUser->username }}"
            >
                <div class="whisperly-user-pill">

                    <div class="whisperly-user-avatar">

                        @if ($currentUser->avatar_url)
                            <img
                                src="{{ $currentUser->avatar_url }}"
                                alt="{{ $currentUser->username }}"
                                onerror="this.onerror=null; this.src='{{ asset('assets/images/faces/1.jpg') }}';"
                            >
                        @else
                            {{ strtoupper(substr($currentUser->username, 0, 1)) }}
                        @endif

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
            </a>


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

                            @if ($currentUser->avatar_url)
                                <img
                                    src="{{ $currentUser->avatar_url }}"
                                    alt="{{ $currentUser->username }}"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/images/faces/1.jpg') }}';"
                                >
                            @else
                                {{ strtoupper(substr($currentUser->username, 0, 1)) }}
                            @endif
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

                        {{-- HOME --}}

                        <a
                            href="{{ route('whisperly.home') }}"
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


                        {{-- CHAT --}}

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


                        {{-- LIHAT TALENT --}}

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


                        {{-- PENGADUAN --}}

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

                        {{-- HOME --}}

                        <a
                            href="{{ route('whisperly.home') }}"
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


                        {{-- LIHAT TALENT --}}

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


                        {{-- PENGADUAN --}}

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


                        {{-- CHAT --}}

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


                        {{-- EDIT PROFIL TALENT --}}

                        <a
                            href="{{ route('talent.edit') }}"
                            class="whisperly-dropdown-item whisperly-edit-profile-item"
                        >

                            <span class="whisperly-dropdown-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >

                                    <path
                                        d="M4.5 19.5L5.4 15.2L15.8 4.8C16.6 4 17.9 4 18.7 4L19.2 5.3C20 6.1 20 7.4 19.2 8.2L8.8 18.6L4.5 19.5Z"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M14.8 5.8L18.2 9.2"
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

                        {{-- HOME --}}

                        <a
                            href="{{ route('whisperly.home') }}"
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


                        {{-- LIHAT TALENT --}}

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


                        {{-- PENGADUAN ADMIN --}}

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


            function openMenu() {

                dropdown.classList.add('show');

                menuButton.classList.add('active');

                menuButton.setAttribute(
                    'aria-expanded',
                    'true'
                );
            }


            function closeMenu() {

                dropdown.classList.remove('show');

                menuButton.classList.remove('active');

                menuButton.setAttribute(
                    'aria-expanded',
                    'false'
                );
            }


            function toggleMenu() {

                const isOpen =
                    dropdown.classList.contains('show');

                if (isOpen) {
                    closeMenu();
                } else {
                    openMenu();
                }
            }


            menuButton.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                    toggleMenu();
                }
            );


            dropdown.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();
                }
            );


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
<script>
document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById("notificationButton");
    const notificationDropdown =
        document.getElementById("notificationDropdown");

    const menuButton =
        document.getElementById("whisperlyMenuButton");

    const menuDropdown =
        document.getElementById("whisperlyDropdown");


    if (btn && notificationDropdown) {

        btn.addEventListener("click", function (e) {

            e.stopPropagation();

            // Tutup menu titik tiga kalau sedang terbuka
            if (menuDropdown) {
                menuDropdown.classList.remove("show");
            }

            if (menuButton) {
                menuButton.classList.remove("active");
                menuButton.setAttribute(
                    "aria-expanded",
                    "false"
                );
            }

            // Buka / tutup notifikasi
            notificationDropdown.classList.toggle("show");

        });


        notificationDropdown.addEventListener(
            "click",
            function (e) {
                e.stopPropagation();
            }
        );


        document.addEventListener(
            "click",
            function () {

                notificationDropdown.classList.remove("show");

            }
        );

    }


    // Kalau tombol titik tiga diklik,
    // notifikasi juga langsung ditutup
    if (menuButton && menuDropdown) {

        menuButton.addEventListener(
            "click",
            function () {

                if (notificationDropdown) {
                    notificationDropdown.classList.remove("show");
                }

            }
        );

    }

});
</script>