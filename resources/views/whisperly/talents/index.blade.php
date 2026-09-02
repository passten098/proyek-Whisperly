<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Temukan Talent | Whisperly
    </title>


    <style>

        /* =====================================================
           ROOT
        ===================================================== */

        :root {

            --bg: #0c0d1b;

            --bg-soft: #12142a;

            --panel: #181a34;

            --panel-light: #202344;

            --text: #f7f5ff;

            --muted: #9ea3c7;

            --indigo: #8b7cff;

            --indigo-light: #b9b1ff;

            --line: rgba(255,255,255,.09);

            --shadow:
                0 30px 80px rgba(0,0,0,.45);

            --shadow-active:
                0 35px 90px rgba(104,91,255,.28);
        }


        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
        }


        html,
        body {

            margin: 0;

            width: 100%;

            min-height: 100%;
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            overflow-x: hidden;

            color: var(--text);

            background:

                radial-gradient(
                    circle at 50% 20%,
                    rgba(102, 91, 255, .15),
                    transparent 38%
                ),

                radial-gradient(
                    circle at 10% 90%,
                    rgba(89, 70, 180, .12),
                    transparent 35%
                ),

                var(--bg);

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        /* =====================================================
           PAGE
        ===================================================== */

        .page {

            min-height: 100vh;

            display: flex;

            flex-direction: column;

            padding-top: 145px;

            padding-bottom: 80px;
        }


        /* =====================================================
           HEADING
        ===================================================== */

        .heading {

            width:
                min(
                    1200px,
                    calc(100% - 48px)
                );

            margin:
                0 auto 25px;
        }


        .eyebrow {

            margin:
                0 0 10px;

            color:
                var(--indigo-light);

            font-size:
                12px;

            font-weight:
                800;

            letter-spacing:
                .16em;

            text-transform:
                uppercase;
        }


        .heading h1 {

            margin: 0;

            font-family:
                Georgia,
                serif;

            font-size:
                clamp(
                    44px,
                    6vw,
                    76px
                );

            font-weight:
                400;

            letter-spacing:
                -.035em;

            line-height:
                .95;
        }


        .heading p {

            max-width:
                600px;

            margin:
                16px 0 0;

            color:
                var(--muted);

            font-size:
                15px;

            line-height:
                1.7;
        }


        /* =====================================================
           CAROUSEL WRAPPER
        ===================================================== */

        .carousel-wrapper {

            position:
                relative;

            width:
                100%;

            margin-top:
                15px;

            overflow:
                hidden;

            mask-image:
                linear-gradient(
                    to right,
                    transparent 0%,
                    black 8%,
                    black 92%,
                    transparent 100%
                );
        }


        /* =====================================================
           CAROUSEL
        ===================================================== */

        .carousel {

            width:
                100%;

            display:
                flex;

            align-items:
                center;

            gap:
                26px;

            padding-top:
                55px;

            padding-bottom:
                55px;

            padding-left:
                calc(50vw - 170px);

            padding-right:
                calc(50vw - 170px);

            overflow-x:
                auto;

            overflow-y:
                hidden;

            scroll-behavior:
                auto;

            scrollbar-width:
                none;

            overscroll-behavior-x:
                contain;

            cursor:
                grab;
        }


        .carousel::-webkit-scrollbar {
            display: none;
        }


        .carousel:active {
            cursor: grabbing;
        }


        /* =====================================================
           TALENT CARD
        ===================================================== */

        .talent-card {

            position:
                relative;

            flex:
                0 0 340px;

            min-height:
                465px;

            padding:
                18px;

            border:
                1px solid
                rgba(
                    255,
                    255,
                    255,
                    .08
                );

            border-radius:
                28px;

            background:
                linear-gradient(
                    145deg,
                    rgba(36,39,72,.96),
                    rgba(19,21,43,.98)
                );

            box-shadow:
                var(--shadow);

            cursor:
                pointer;

            opacity:
                .58;

            filter:
                blur(1px);

            transform:
                translateY(0)
                scale(.92);

            transition:
                transform .45s
                    cubic-bezier(.2,.8,.2,1),

                opacity .4s ease,

                filter .4s ease,

                box-shadow .45s ease,

                border-color .4s ease;
        }


        /* =====================================================
           CENTER CARD
        ===================================================== */

        .talent-card.is-center {

            opacity:
                .82;

            filter:
                blur(0);

            transform:
                translateY(-8px)
                scale(.96);
        }


        /* =====================================================
           SELECTED CARD
        ===================================================== */

        .talent-card.is-selected {

            opacity:
                1;

            filter:
                blur(0);

            transform:
                translateY(-25px)
                scale(1);

            border-color:
                rgba(
                    139,
                    124,
                    255,
                    .55
                );

            box-shadow:
                var(--shadow-active);
        }


        /* =====================================================
           OTHER CARD WHEN SELECTED
        ===================================================== */

        .carousel.has-selection
        .talent-card:not(.is-selected) {

            opacity:
                .25;

            filter:
                blur(3px);
        }


        /* =====================================================
           PHOTO
        ===================================================== */

        .talent-photo {

            position:
                relative;

            width:
                100%;

            height:
                270px;

            overflow:
                hidden;

            border-radius:
                20px;

            background:
                linear-gradient(
                    135deg,
                    #272a50,
                    #16182e
                );
        }


        .talent-photo img {

            width:
                100%;

            height:
                100%;

            display:
                block;

            object-fit:
                cover;

            transition:
                transform .5s ease;
        }


        .talent-card.is-selected
        .talent-photo img {

            transform:
                scale(1.04);
        }


        /* =====================================================
           PHOTO PLACEHOLDER
        ===================================================== */

        .photo-placeholder {

            width:
                100%;

            height:
                100%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            color:
                var(--indigo-light);

            font-size:
                13px;

            font-weight:
                700;

            text-transform:
                uppercase;

            letter-spacing:
                .08em;
        }


        /* =====================================================
           CARD CONTENT
        ===================================================== */

        .talent-content {

            padding:
                20px 5px 4px;
        }


        .talent-name {

            margin:
                0;

            color:
                #fff;

            font-family:
                Georgia,
                serif;

            font-size:
                29px;

            font-weight:
                400;

            line-height:
                1;
        }


        /* =====================================================
           USERNAME
        ===================================================== */

        .talent-username {

            margin-top:
                8px;

            color:
                var(--indigo-light);

            font-size:
                12px;

            font-weight:
                700;
        }


        .talent-description {

            min-height:
                46px;

            margin:
                14px 0 20px;

            color:
                var(--muted);

            font-size:
                13px;

            line-height:
                1.6;
        }


        /* =====================================================
           PROFILE BUTTON
        ===================================================== */

        .profile-button {

            width:
                100%;

            min-height:
                44px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border:
                0;

            border-radius:
                999px;

            color:
                #17172f;

            background:
                var(--indigo-light);

            text-decoration:
                none;

            font-size:
                13px;

            font-weight:
                800;

            box-shadow:
                0 6px 16px
                rgba(
                    139,
                    124,
                    255,
                    .18
                );

            transition:
                transform .2s ease,

                background .2s ease,

                box-shadow .2s ease;
        }


        .profile-button:hover {

            background:
                #d8d2ff;

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px
                rgba(
                    139,
                    124,
                    255,
                    .28
                );
        }


        .profile-button:active {

            transform:
                translateY(0);
        }


        /* =====================================================
           HINT
        ===================================================== */

        .interaction-hint {

            margin-top:
                18px;

            text-align:
                center;

            color:
                #73799f;

            font-size:
                12px;

            letter-spacing:
                .04em;
        }


        .interaction-hint span {

            color:
                var(--indigo-light);

            font-weight:
                700;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {

            width:
                min(
                    600px,
                    calc(100% - 40px)
                );

            margin:
                50px auto;

            padding:
                40px;

            text-align:
                center;

            border:
                1px dashed
                rgba(
                    255,
                    255,
                    255,
                    .12
                );

            border-radius:
                24px;

            color:
                var(--muted);

            background:
                rgba(
                    255,
                    255,
                    255,
                    .025
                );
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 700px) {

            .page {

                padding-top:
                    110px;
            }


            .heading {

                width:
                    calc(100% - 32px);
            }


            .heading h1 {

                font-size:
                    48px;
            }


            .heading p {

                font-size:
                    14px;
            }


            .carousel {

                gap:
                    18px;

                padding-left:
                    calc(50vw - 140px);

                padding-right:
                    calc(50vw - 140px);
            }


            .talent-card {

                flex-basis:
                    280px;

                min-height:
                    420px;
            }


            .talent-photo {

                height:
                    230px;
            }


            .carousel-wrapper {

                mask-image:
                    linear-gradient(
                        to right,
                        transparent 0%,
                        black 5%,
                        black 95%,
                        transparent 100%
                    );
            }

        }

    </style>

</head>


<body>


    {{-- =====================================================
         GLOBAL NAVBAR
         Navbar tetap menggunakan file terpisah.
    ====================================================== --}}

    @include('whisperly.navbar')


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main class="page">


        {{-- =================================================
             HEADING
        ================================================== --}}

        <section class="heading">

            <p class="eyebrow">
                WHISPERLY / TALENT
            </p>


            <h1>
                Temukan<br>
                teman ceritamu.
            </h1>


            <p>
                Geser untuk melihat talent yang tersedia.
                Berhenti di tengah untuk memilih talent,
                lalu buka profilnya untuk melihat informasi
                dan jadwal.
            </p>

        </section>


        {{-- =================================================
             TALENT
        ================================================== --}}

        @if ($talents->count())


            <div
                class="carousel-wrapper"
                id="carousel-wrapper"
            >


                <div
                    class="carousel"
                    id="talent-carousel"
                    tabindex="0"
                >


                    @foreach ($talents as $talent)


                        {{-- =================================
                             TALENT CARD
                        ================================== --}}

                        <article
                            class="talent-card"
                            tabindex="0"
                            data-index="{{ $loop->index }}"
                            data-url="{{ route(
                                'whisperly.talents.show',
                                $talent->pengguna->username
                            ) }}"
                        >


                            {{-- =============================
                                 FOTO
                            ============================== --}}

                            <div class="talent-photo">


                                @if ($talent->photo)

                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::url($talent->photo) }}"
                                        alt="Foto {{ $talent->pengguna->username }}"
                                    >

                                @else

                                    <div class="photo-placeholder">

                                  
                                    </div>

                                @endif


                            </div>


                            {{-- =============================
                                 CONTENT
                            ============================== --}}

                            <div class="talent-content">


                                {{-- NAMA --}}

                                <h2 class="talent-name">

                                    {{ ucfirst(
                                        $talent->pengguna->username
                                    ) }}

                                </h2>



                                {{-- DESKRIPSI --}}

                                <p class="talent-description">

                                    {{ Str::limit(
                                        $talent->deskripsi ?? 'Belum ada deskripsi talent.',
                                        100
                                    ) }}

                                </p>


                                {{-- =========================
                                     PROFILE BUTTON
                                ========================== --}}

                                <a
                                    class="profile-button"
                                    href="{{ route(
                                        'whisperly.talents.show',
                                        $talent->pengguna->username
                                    ) }}"
                                >

                                    Lihat Profil

                                </a>


                            </div>


                        </article>


                    @endforeach


                </div>


            </div>


            {{-- =================================================
                 INTERACTION HINT
            ================================================== --}}

            <div class="interaction-hint">

                <span>
                    Scroll
                </span>

                mouse / dua jari touchpad

                &nbsp;•&nbsp;

                <span>
                    Geser
                </span>

                kanan / kiri

                &nbsp;•&nbsp;

                <span>
                    Enter
                </span>

                untuk membuka profil

            </div>


        @else


            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div class="empty">

                Belum ada talent yang tersedia.

            </div>


        @endif


    </main>


    {{-- =====================================================
         JAVASCRIPT CAROUSEL
    ====================================================== --}}

    <script>

        const carousel =
            document.getElementById(
                'talent-carousel'
            );


        const carouselWrapper =
            document.getElementById(
                'carousel-wrapper'
            );


        if (carousel) {


            const cards =
                Array.from(
                    carousel.querySelectorAll(
                        '.talent-card'
                    )
                );


            let selectedCard = null;

            let scrollTimer = null;

            let isScrolling = false;


            /* =================================================
               MENCARI CARD TERDEKAT DENGAN TENGAH LAYAR
            ================================================= */

            function getCenterCard() {

                const viewportCenter =
                    window.innerWidth / 2;


                let closest = null;

                let closestDistance =
                    Infinity;


                cards.forEach(card => {

                    const rect =
                        card.getBoundingClientRect();


                    const cardCenter =
                        rect.left +
                        (rect.width / 2);


                    const distance =
                        Math.abs(
                            cardCenter -
                            viewportCenter
                        );


                    if (
                        distance <
                        closestDistance
                    ) {

                        closestDistance =
                            distance;

                        closest =
                            card;

                    }

                });


                return closest;

            }


            /* =================================================
               MEMPOSISIKAN CARD KE TENGAH
            ================================================= */

            function centerCard(card) {

                if (!card) {
                    return;
                }


                const rect =
                    card.getBoundingClientRect();


                const viewportCenter =
                    window.innerWidth / 2;


                const cardCenter =
                    rect.left +
                    rect.width / 2;


                const difference =
                    cardCenter -
                    viewportCenter;


                carousel.scrollBy({

                    left:
                        difference,

                    behavior:
                        'smooth'

                });

            }


            /* =================================================
               SELECT CARD
            ================================================= */

            function selectCard(
                card,
                moveToCenter = false
            ) {

                if (!card) {
                    return;
                }


                selectedCard =
                    card;


                carousel.classList.add(
                    'has-selection'
                );


                cards.forEach(item => {

                    item.classList.remove(
                        'is-selected'
                    );

                    item.classList.remove(
                        'is-center'
                    );

                });


                card.classList.add(
                    'is-selected'
                );


                if (moveToCenter) {

                    centerCard(card);

                }

            }


            /* =================================================
               SELESAI SCROLL
            ================================================= */

            function finishScrolling() {

                isScrolling =
                    false;


                const centerCardElement =
                    getCenterCard();


                if (!centerCardElement) {
                    return;
                }


                cards.forEach(card => {

                    card.classList.remove(
                        'is-center'
                    );

                });


                centerCardElement.classList.add(
                    'is-center'
                );


                selectCard(
                    centerCardElement,
                    true
                );

            }


            /* =================================================
               WHEEL / TOUCHPAD
            ================================================= */

            function handleWheel(event) {

                let movement;


                if (
                    Math.abs(event.deltaX) >
                    Math.abs(event.deltaY)
                ) {

                    movement =
                        event.deltaX;

                } else {

                    movement =
                        event.deltaY;

                }


                if (movement === 0) {
                    return;
                }


                event.preventDefault();


                isScrolling =
                    true;


                carousel.scrollLeft +=
                    movement;


                clearTimeout(
                    scrollTimer
                );


                scrollTimer =
                    setTimeout(
                        finishScrolling,
                        220
                    );

            }


            /* =================================================
               WHEEL EVENT
            ================================================= */

            if (carouselWrapper) {

                carouselWrapper.addEventListener(
                    'wheel',
                    handleWheel,
                    {
                        passive: false
                    }
                );

            }


            /* =================================================
               CLICK CARD
            ================================================= */

            cards.forEach(card => {


                card.addEventListener(
                    'click',
                    function(event) {


                        /*
                         * Kalau klik Lihat Profil,
                         * biarkan link bekerja.
                         */

                        if (
                            event.target.closest(
                                '.profile-button'
                            )
                        ) {

                            return;

                        }


                        selectCard(
                            card,
                            true
                        );

                    }
                );


                /* =============================================
                   ENTER PADA CARD
                ============================================== */

                card.addEventListener(
                    'keydown',
                    function(event) {


                        if (
                            event.key !== 'Enter'
                        ) {

                            return;

                        }


                        event.preventDefault();


                        window.location.href =
                            card.dataset.url;

                    }
                );

            });


            /* =================================================
               ENTER PADA CAROUSEL
            ================================================= */

            carousel.addEventListener(
                'keydown',
                function(event) {


                    if (
                        event.key !== 'Enter'
                    ) {

                        return;

                    }


                    event.preventDefault();


                    const target =
                        selectedCard ||
                        getCenterCard();


                    if (target) {

                        window.location.href =
                            target.dataset.url;

                    }

                }
            );


            /* =================================================
               RESIZE
            ================================================= */

            window.addEventListener(
                'resize',
                function() {


                    if (!selectedCard) {
                        return;
                    }


                    centerCard(
                        selectedCard
                    );

                }
            );


            /* =================================================
               INITIAL CARD
            ================================================= */

            if (cards.length > 0) {

                const initialCard =
                    getCenterCard();


                if (initialCard) {

                    initialCard.classList.add(
                        'is-center'
                    );

                }

            }

        }

    </script>


</body>

</html>