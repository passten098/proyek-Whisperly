{{-- ============================================================
    WHISPERLY GLOBAL NAVBAR
    File:
    resources/views/whisperly/navbar.blade.php
============================================================ --}}

<style>
    /* =========================================================
       RESET NAVBAR
    ========================================================= */

    .whisperly-nav,
    .whisperly-nav * {
        box-sizing: border-box;
    }


    /* =========================================================
       NAVBAR
    ========================================================= */

    .whisperly-nav {
        position: fixed;

        top: 0;
        left: 0;
        right: 0;

        z-index: 1000;

        width: 100%;
        min-height: 68px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 10px 28px;

        background: rgba(23, 23, 47, 0.96);

        border-bottom:
            1px solid
            rgba(255, 255, 255, 0.08);

        box-shadow:
            0 8px 24px
            rgba(23, 23, 47, 0.16);

        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
    }


    /* =========================================================
       LOGO
    ========================================================= */

    .whisperly-brand {
        display: inline-flex;

        align-items: center;

        color: #fbf8f2;

        font-family:
            Georgia,
            serif;

        font-size: 23px;

        font-weight: 700;

        letter-spacing: .04em;

        text-decoration: none;

        transition:
            opacity .2s ease,
            transform .2s ease;
    }


    .whisperly-brand:hover {
        opacity: .82;

        transform:
            translateY(-1px);
    }


    /* =========================================================
       BAGIAN KANAN
    ========================================================= */

    .whisperly-nav-right {
        display: flex;

        align-items: center;

        gap: 10px;

        position: relative;
    }


    /* =========================================================
       USERNAME
    ========================================================= */

    .whisperly-username {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 36px;

        padding:
            0 14px;

        border:
            1px solid
            rgba(255, 255, 255, .14);

        border-radius:
            999px;

        color:
            #c7b6ef;

        background:
            rgba(255, 255, 255, .035);

        font-family:
            Arial,
            sans-serif;

        font-size:
            12px;

        font-weight:
            600;

        white-space:
            nowrap;
    }


    /* =========================================================
       TOMBOL TITIK TIGA
    ========================================================= */

    .whisperly-menu-button {

        width: 42px;

        height: 42px;

        display: flex;

        align-items: center;

        justify-content: center;

        padding: 0;

        border: 0;

        border-radius: 50%;

        background:
            rgba(255,255,255,.08);

        color:
            #ffffff;

        font-size: 25px;

        line-height: 1;

        cursor: pointer;

        transition:
            background .2s ease,
            transform .2s ease,
            box-shadow .2s ease;
    }


    .whisperly-menu-button:hover {

        background:
            rgba(199,182,239,.22);

        transform:
            translateY(-2px);

        box-shadow:
            0 6px 16px
            rgba(0,0,0,.18);
    }


    .whisperly-menu-button:active {

        transform:
            translateY(0);
    }


    /* =========================================================
       DROPDOWN MENU
    ========================================================= */

    .whisperly-menu {

        position: absolute;

        top: calc(100% + 12px);

        right: 0;

        width: 225px;

        padding: 8px;

        border:
            1px solid
            rgba(255,255,255,.7);

        border-radius: 18px;

        background:
            rgba(255,255,255,.96);

        box-shadow:
            0 18px 45px
            rgba(23,23,47,.20);

        backdrop-filter:
            blur(15px);

        -webkit-backdrop-filter:
            blur(15px);

        opacity: 0;

        visibility: hidden;

        transform:
            translateY(-8px)
            scale(.97);

        transform-origin:
            top right;

        transition:
            opacity .18s ease,
            visibility .18s ease,
            transform .18s ease;
    }


    /* =========================================================
       MENU TERBUKA
    ========================================================= */

    .whisperly-menu.show {

        opacity: 1;

        visibility: visible;

        transform:
            translateY(0)
            scale(1);
    }


    /* =========================================================
       HEADER MENU
    ========================================================= */

    .whisperly-menu-header {

        padding:
            10px 12px 9px;

        border-bottom:
            1px solid
            #edf0f5;

        margin-bottom:
            5px;
    }


    .whisperly-menu-header strong {

        display: block;

        color:
            #17172f;

        font-family:
            Georgia,
            serif;

        font-size:
            15px;

        font-weight:
            400;
    }


    .whisperly-menu-header span {

        display: block;

        margin-top:
            3px;

        color:
            #8991a0;

        font-family:
            Arial,
            sans-serif;

        font-size:
            10px;
    }


    /* =========================================================
       ITEM MENU
    ========================================================= */

    .whisperly-menu-item {

        display: flex;

        align-items: center;

        gap: 11px;

        width: 100%;

        min-height: 43px;

        padding:
            0 11px;

        border-radius:
            12px;

        color:
            #454c5b;

        background:
            transparent;

        font-family:
            Arial,
            sans-serif;

        font-size:
            12px;

        font-weight:
            600;

        text-decoration:
            none;

        transition:
            background .18s ease,
            color .18s ease,
            transform .18s ease;
    }


    .whisperly-menu-item:hover {

        background:
            #edf4ff;

        color:
            #5279a8;

        transform:
            translateX(2px);
    }


    /* =========================================================
       ICON
    ========================================================= */

    .whisperly-menu-icon {

        width: 27px;

        height: 27px;

        display: flex;

        align-items: center;

        justify-content: center;

        flex-shrink: 0;

        border-radius: 9px;

        background:
            #edf4ff;

        color:
            #7198c5;

        font-size:
            13px;

        transition:
            background .18s ease,
            color .18s ease;
    }


    .whisperly-menu-item:hover
    .whisperly-menu-icon {

        background:
            #dceaff;

        color:
            #5279a8;
    }


    /* =========================================================
       LOGOUT
    ========================================================= */

    .whisperly-menu-logout {

        width: 100%;

        margin-top: 5px;

        padding-top: 5px;

        border-top:
            1px solid
            #edf0f5;
    }


    .whisperly-menu-logout button {

        width: 100%;

        min-height: 43px;

        display: flex;

        align-items: center;

        gap: 11px;

        padding:
            0 11px;

        border: 0;

        border-radius: 12px;

        background:
            transparent;

        color:
            #9b6470;

        font-family:
            Arial,
            sans-serif;

        font-size:
            12px;

        font-weight:
            600;

        cursor:
            pointer;

        text-align:
            left;

        transition:
            background .18s ease,
            color .18s ease;
    }


    .whisperly-menu-logout button:hover {

        background:
            #fff0f2;

        color:
            #a64c5d;
    }


    .whisperly-menu-logout .whisperly-menu-icon {

        background:
            #fae7eb;

        color:
            #b05d6d;
    }


    /* =========================================================
       DIVIDER
    ========================================================= */

    .whisperly-menu-divider {

        height: 1px;

        margin:
            5px 7px;

        background:
            #edf0f5;
    }


    /* =========================================================
       BUTTON SYSTEM
    ========================================================= */

    .w-btn {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        min-height: 40px;

        padding:
            0 18px;

        border: 0;

        border-radius: 999px;

        font-family:
            Arial,
            Helvetica,
            sans-serif;

        font-size:
            13px;

        font-weight:
            700;

        line-height:
            1;

        text-align:
            center;

        text-decoration:
            none;

        white-space:
            nowrap;

        cursor:
            pointer;

        transition:
            transform .2s ease,
            background-color .2s ease,
            color .2s ease,
            border-color .2s ease,
            box-shadow .2s ease,
            opacity .2s ease;
    }


    .w-btn:focus-visible {

        outline:
            3px solid
            rgba(199,182,239,.35);

        outline-offset:
            3px;
    }


    .w-btn:hover {

        transform:
            translateY(-2px);
    }


    .w-btn:active {

        transform:
            translateY(0);
    }


    .w-btn:disabled,
    .w-btn[disabled] {

        opacity:
            .5;

        cursor:
            not-allowed;

        transform:
            none;

        box-shadow:
            none;
    }


    /* =========================================================
       PRIMARY
    ========================================================= */

    .w-btn--primary {

        color:
            #17172f;

        background:
            #c7b6ef;

        box-shadow:
            0 6px 16px
            rgba(199,182,239,.18);
    }


    .w-btn--primary:hover {

        color:
            #17172f;

        background:
            #d8cdf7;

        box-shadow:
            0 8px 20px
            rgba(199,182,239,.28);
    }


    /* =========================================================
       SECONDARY
    ========================================================= */

    .w-btn--secondary {

        color:
            #5279a8;

        background:
            #e6f0ff;

        box-shadow:
            0 4px 12px
            rgba(82,121,168,.10);
    }


    .w-btn--secondary:hover {

        color:
            #42688f;

        background:
            #dbeaff;

        box-shadow:
            0 6px 16px
            rgba(82,121,168,.16);
    }


    /* =========================================================
       GHOST
    ========================================================= */

    .w-btn--ghost {

        color:
            #6b7280;

        background:
            transparent;

        border:
            1.5px solid
            #dce6f2;

        box-shadow:
            none;
    }


    .w-btn--ghost:hover {

        color:
            #5279a8;

        background:
            #f0f6ff;

        border-color:
            #cbdced;
    }


    /* =========================================================
       SIZE
    ========================================================= */

    .w-btn--sm {

        min-height:
            36px;

        padding:
            0 15px;

        font-size:
            12px;
    }


    .w-btn--md {

        min-height:
            40px;

        padding:
            0 18px;

        font-size:
            13px;
    }


    .w-btn--lg {

        min-height:
            46px;

        padding:
            0 24px;

        font-size:
            14px;
    }


    .w-btn--block {

        width:
            100%;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 700px) {

        .whisperly-nav {

            min-height:
                60px;

            padding:
                9px 16px;
        }


        .whisperly-brand {

            font-size:
                19px;
        }


        .whisperly-username {

            display:
                none;
        }


        .whisperly-menu {

            right:
                -4px;

            width:
                210px;
        }

    }


    @media (max-width: 400px) {

        .whisperly-nav {

            padding:
                9px 12px;
        }


        .whisperly-brand {

            font-size:
                17px;
        }


        .whisperly-menu {

            width:
                200px;
        }

    }

</style>


{{-- ============================================================
    NAVBAR
============================================================ --}}

<header class="whisperly-nav">


    {{-- =========================================================
         LOGO
    ========================================================== --}}

    <a
        href="{{ route('whisperly.home') }}"
        class="whisperly-brand"
    >
        WHISPERLY
    </a>


    {{-- =========================================================
         BAGIAN KANAN
    ========================================================== --}}

    <div class="whisperly-nav-right">


        {{-- =====================================================
             USERNAME
        ====================================================== --}}

        @if (auth('whisperly')->check())

            <span class="whisperly-username">

                {{ auth('whisperly')->user()->username }}

            </span>

        @endif


        {{-- =====================================================
             TOMBOL TITIK TIGA
        ====================================================== --}}

        @if (auth('whisperly')->check())

            <button
                type="button"
                class="whisperly-menu-button"
                id="whisperlyMenuButton"
                aria-label="Buka menu"
                aria-expanded="false"
            >
                ⋮
            </button>


            {{-- =================================================
                 DROPDOWN MENU
            ================================================== --}}

            <div
                class="whisperly-menu"
                id="whisperlyMenu"
            >


                {{-- =================================================
                     MENU HEADER
                ================================================== --}}

                <div class="whisperly-menu-header">

                    <strong>
                        Menu Whisperly
                    </strong>

                    <span>

                        @php
                            $role =
                                auth('whisperly')->user()->role;
                        @endphp

                        {{ ucfirst($role) }}

                    </span>

                </div>


                {{-- =================================================
                     USER
                ================================================== --}}

                @if ($role === 'user')


                    {{-- HOME --}}

                    <a
                        href="{{ route('whisperly.home') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            🏠
                        </span>

                        Home

                    </a>


                    {{-- CHAT --}}

                    <a
                        href="{{ route('whisperly.chat.index') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            💬
                        </span>

                        Chat

                    </a>


                    {{-- LIHAT TALENT --}}

                    <a
                        href="{{ route('whisperly.talents.index') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            👥
                        </span>

                        Lihat Talent

                    </a>


                    {{-- PENGADUAN --}}

                    <a
                        href="#"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            ⚠
                        </span>

                        Pengaduan

                    </a>


                {{-- =================================================
                     TALENT
                ================================================== --}}

                @elseif ($role === 'talent')


                    {{-- HOME --}}

                    <a
                        href="{{ route('whisperly.home') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            🏠
                        </span>

                        Home

                    </a>


                    {{-- LIHAT TALENT --}}

                    <a
                        href="{{ route('whisperly.talents.index') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            👥
                        </span>

                        Lihat Talent

                    </a>


                    {{-- EDIT PROFIL --}}

                    <a
                        href="{{ route('talent.edit') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            ✏
                        </span>

                        Edit Profil

                    </a>


                    {{-- PROFIL --}}

                    <a
                        href="{{ route('talent') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            👤
                        </span>

                        Profil

                    </a>


                    {{-- PENGADUAN --}}

                    <a
                        href="#"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            ⚠
                        </span>

                        Pengaduan

                    </a>


                    {{-- CHAT --}}

                    <a
                        href="{{ route('whisperly.chat.index') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            💬
                        </span>

                        Chat

                    </a>


                {{-- =================================================
                     ADMIN
                ================================================== --}}

                @elseif ($role === 'admin')


                    {{-- HOME --}}

                    <a
                        href="{{ route('whisperly.home') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            🏠
                        </span>

                        Home

                    </a>


                    {{-- LIHAT TALENT --}}

                    <a
                        href="{{ route('whisperly.talents.index') }}"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            👥
                        </span>

                        Lihat Talent

                    </a>


                    {{-- PENGADUAN --}}

                    <a
                        href="#"
                        class="whisperly-menu-item"
                    >

                        <span class="whisperly-menu-icon">
                            ⚠
                        </span>

                        Pengaduan

                    </a>


                @endif


                {{-- =================================================
                     DIVIDER
                ================================================== --}}

                <div class="whisperly-menu-divider"></div>


                {{-- =================================================
                     LOGOUT
                ================================================== --}}

                <div class="whisperly-menu-logout">

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                        >

                            <span class="whisperly-menu-icon">
                                ↪
                            </span>

                            Keluar

                        </button>

                    </form>

                </div>


            </div>

        @endif


    </div>

</header>


{{-- ============================================================
    JAVASCRIPT DROPDOWN
============================================================ --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const menuButton =
                document.getElementById(
                    'whisperlyMenuButton'
                );

            const menu =
                document.getElementById(
                    'whisperlyMenu'
                );


            if (
                !menuButton ||
                !menu
            ) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | BUKA / TUTUP MENU
            |--------------------------------------------------------------------------
            */

            menuButton.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                    const isOpen =
                        menu.classList.contains('show');


                    if (isOpen) {

                        menu.classList.remove('show');

                        menuButton.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    } else {

                        menu.classList.add('show');

                        menuButton.setAttribute(
                            'aria-expanded',
                            'true'
                        );

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | KLIK DI LUAR MENU
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'click',
                function (event) {

                    if (
                        !menu.contains(event.target) &&
                        !menuButton.contains(event.target)
                    ) {

                        menu.classList.remove('show');

                        menuButton.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | ESCAPE UNTUK MENUTUP
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape'
                    ) {

                        menu.classList.remove('show');

                        menuButton.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }

                }
            );


        }
    );

</script>