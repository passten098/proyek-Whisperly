<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Temukan Talent | Whisperly</title>

    <style>
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

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            width: 100%;
            min-height: 100%;
        }

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

            font-family: Arial, Helvetica, sans-serif;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .topbar {
            position: fixed;
            z-index: 50;

            top: 20px;
            left: 28px;
            right: 28px;

            height: 68px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 22px 0 28px;

            border: 1px solid rgba(255,255,255,.06);
            border-radius: 20px;

            background: rgba(20,21,43,.92);

            box-shadow:
                0 20px 50px rgba(0,0,0,.28);

            backdrop-filter: blur(18px);
        }

        .brand {
            color: #fff;
            text-decoration: none;

            font-family: Georgia, serif;
            font-size: 24px;
            font-weight: 700;

            letter-spacing: .05em;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .username {
            padding: 9px 15px;

            border: 1px solid rgba(255,255,255,.1);
            border-radius: 999px;

            color: var(--indigo-light);

            font-size: 12px;
            font-weight: 700;
        }

        .chat-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 40px;
            padding: 0 18px;

            border: 1px solid rgba(255,255,255,.12);
            border-radius: 999px;

            color: #fff;
            background: rgba(255,255,255,.06);

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;

            transition: .2s ease;
        }

        .chat-button:hover {
            background: var(--indigo);
            border-color: var(--indigo);
            transform: translateY(-2px);
        }


        /* =====================================================
           PAGE
        ===================================================== */

        .page {
            min-height: 100vh;

            display: flex;
            flex-direction: column;

            padding-top: 130px;
            padding-bottom: 80px;
        }

        .heading {
            width: min(1200px, calc(100% - 48px));

            margin: 0 auto 25px;
        }

        .eyebrow {
            margin: 0 0 10px;

            color: var(--indigo-light);

            font-size: 12px;
            font-weight: 800;

            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .heading h1 {
            margin: 0;

            font-family: Georgia, serif;

            font-size: clamp(44px, 6vw, 76px);

            font-weight: 400;

            letter-spacing: -.035em;

            line-height: .95;
        }

        .heading p {
            max-width: 600px;

            margin: 16px 0 0;

            color: var(--muted);

            font-size: 15px;

            line-height: 1.7;
        }


        /* =====================================================
           CAROUSEL WRAPPER
        ===================================================== */

        .carousel-wrapper {
            position: relative;

            width: 100%;

            margin-top: 15px;

            overflow: hidden;

            /*
             * Membuat sisi kiri dan kanan terlihat memudar.
             */
            mask-image: linear-gradient(
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

            /*
             * PENTING
             *
             * Sebelumnya width:max-content + overflow:visible.
             * Itu yang membuat carousel tidak bisa discroll.
             *
             * Sekarang carousel benar-benar menjadi
             * area horizontal yang bisa discroll.
             */
            width: 100%;

            display: flex;

            align-items: center;

            gap: 26px;

            padding-top: 55px;
            padding-bottom: 55px;

            padding-left: calc(50vw - 170px);
            padding-right: calc(50vw - 170px);

            overflow-x: auto;
            overflow-y: hidden;

            scroll-behavior: auto;

            /*
             * Menyembunyikan scrollbar.
             */
            scrollbar-width: none;

            /*
             * Mencegah browser mengubah gesture
             * menjadi scroll halaman.
             */
            overscroll-behavior-x: contain;

            cursor: grab;
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

            position: relative;

            flex: 0 0 340px;

            min-height: 465px;

            padding: 18px;

            border: 1px solid rgba(255,255,255,.08);

            border-radius: 28px;

            background:
                linear-gradient(
                    145deg,
                    rgba(36,39,72,.96),
                    rgba(19,21,43,.98)
                );

            box-shadow: var(--shadow);

            cursor: pointer;

            /*
             * Awalnya SEMUA talent normal.
             * Tidak ada talent yang otomatis naik.
             */
            opacity: .58;

            filter: blur(1px);

            transform:
                translateY(0)
                scale(.92);

            transition:
                transform .45s cubic-bezier(.2,.8,.2,1),
                opacity .4s ease,
                filter .4s ease,
                box-shadow .45s ease,
                border-color .4s ease;
        }


        /*
         * Talent yang berada di tengah setelah user scroll
         */
        .talent-card.is-center {

            opacity: .82;

            filter: blur(0);

            transform:
                translateY(-8px)
                scale(.96);
        }


        /*
         * Talent yang diklik / dipilih
         */
        .talent-card.is-selected {

            opacity: 1;

            filter: blur(0);

            transform:
                translateY(-25px)
                scale(1);

            border-color:
                rgba(139,124,255,.55);

            box-shadow:
                var(--shadow-active);
        }


        /*
         * Talent lainnya ketika ada talent yang dipilih
         */
        .carousel.has-selection
        .talent-card:not(.is-selected) {

            opacity: .25;

            filter: blur(3px);
        }


        /* =====================================================
           PHOTO
        ===================================================== */

        .talent-photo {

            position: relative;

            width: 100%;

            height: 270px;

            overflow: hidden;

            border-radius: 20px;

            background:
                linear-gradient(
                    135deg,
                    #272a50,
                    #16182e
                );
        }

        .talent-photo img {

            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform .5s ease;
        }

        .talent-card.is-selected
        .talent-photo img {

            transform: scale(1.04);
        }

        .photo-placeholder {

            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            color: var(--indigo-light);

            font-size: 13px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .08em;
        }


        /* =====================================================
           CARD CONTENT
        ===================================================== */

        .talent-content {

            padding:
                20px 5px 4px;
        }

        .talent-name {

            margin: 0;

            color: #fff;

            font-family: Georgia, serif;

            font-size: 29px;

            font-weight: 400;

            line-height: 1;
        }

        .talent-username {

            margin-top: 8px;

            color: var(--indigo-light);

            font-size: 12px;

            font-weight: 700;
        }

        .talent-description {

            min-height: 46px;

            margin:
                14px 0 20px;

            color: var(--muted);

            font-size: 13px;

            line-height: 1.6;
        }


        /* =====================================================
           PROFILE BUTTON
        ===================================================== */

        .profile-button {

            width: 100%;

            min-height: 44px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 999px;

            color: #fff;

            background:
                var(--indigo);

            text-decoration: none;

            font-size: 13px;

            font-weight: 800;

            transition: .2s ease;
        }

        .profile-button:hover {

            background:
                #a198ff;

            transform:
                translateY(-2px);
        }


        /* =====================================================
           HINT
        ===================================================== */

        .interaction-hint {

            margin-top: 18px;

            text-align: center;

            color: #73799f;

            font-size: 12px;

            letter-spacing: .04em;
        }

        .interaction-hint span {

            color:
                var(--indigo-light);

            font-weight: 700;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {

            width:
                min(600px, calc(100% - 40px));

            margin:
                50px auto;

            padding:
                40px;

            text-align: center;

            border:
                1px dashed rgba(255,255,255,.12);

            border-radius:
                24px;

            color:
                var(--muted);

            background:
                rgba(255,255,255,.025);
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 700px) {

            .topbar {

                top: 12px;

                left: 14px;

                right: 14px;

                height: 60px;

                padding:
                    0 14px;
            }

            .brand {

                font-size: 19px;
            }

            .username {

                display: none;
            }

            .chat-button {

                min-height: 36px;

                padding:
                    0 14px;
            }

            .page {

                padding-top:
                    105px;
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


<!-- =========================================================
     NAVBAR
========================================================= -->

<header class="topbar">

    <a
        href="{{ route('whisperly.home') }}"
        class="brand"
    >
        WHISPERLY
    </a>


    <div class="topbar-right">

        <span class="username">
            {{ auth('whisperly')->user()->username }}
        </span>


        @if (
            in_array(
                auth('whisperly')->user()->role,
                ['user', 'talent'],
                true
            )
        )

            <a
                href="{{ route('whisperly.chat.index') }}"
                class="chat-button"
            >
                Chat
            </a>

        @endif

    </div>

</header>



<!-- =========================================================
     MAIN
========================================================= -->

<main class="page">


    <!-- HEADING -->

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



    @if ($talents->count())


        <!-- =================================================
             CAROUSEL
        ================================================= -->

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


                    <article
                        class="talent-card"

                        tabindex="0"

                        data-index="{{ $loop->index }}"

                        data-url="{{ route(
                            'whisperly.talents.show',
                            $talent->pengguna->username
                        ) }}"
                    >


                        <!-- PHOTO -->

                        <div class="talent-photo">

                            @if ($talent->photo)

                                <img
                                    src="{{ Storage::url($talent->photo) }}"

                                    alt="Foto {{ $talent->pengguna->username }}"
                                >

                            @else

                                <div
                                    class="photo-placeholder"
                                >
                                    {{ $talent->pengguna->username }}
                                </div>

                            @endif

                        </div>



                        <!-- CONTENT -->

                        <div class="talent-content">


                            <h2 class="talent-name">

                                {{ ucfirst(
                                    $talent->pengguna->username
                                ) }}

                            </h2>


                            <div class="talent-username">

                                @{{ $talent->pengguna->username }}

                            </div>


                            <p class="talent-description">

                                {{ Str::limit(
                                    $talent->deskripsi,
                                    100
                                ) }}

                            </p>


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



        <!-- =================================================
             HINT
        ================================================= -->

        <div class="interaction-hint">

            <span>Scroll</span>
            mouse / dua jari touchpad

            &nbsp;•&nbsp;

            <span>Geser</span>
            kanan / kiri

            &nbsp;•&nbsp;

            <span>Enter</span>
            untuk membuka profil

        </div>


    @else


        <div class="empty">

            Belum ada talent yang tersedia.

        </div>


    @endif


</main>



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



        /* =====================================================
           MENCARI CARD TERDEKAT DENGAN TENGAH LAYAR
        ===================================================== */

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



        /* =====================================================
           MEMPOSISIKAN CARD KE TENGAH
        ===================================================== */

        function centerCard(card) {

            if (!card) return;


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



        /* =====================================================
           SELECT CARD
        ===================================================== */

        function selectCard(
            card,
            moveToCenter = false
        ) {

            if (!card) return;


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



        /* =====================================================
           SELESAI SCROLL
        ===================================================== */

        function finishScrolling() {

            isScrolling =
                false;


            const centerCard =
                getCenterCard();


            if (!centerCard) {
                return;
            }


            /*
             * Pusatkan terlebih dahulu.
             */

            centerCard.scrollIntoView;


            cards.forEach(card => {

                card.classList.remove(
                    'is-center'
                );

            });


            centerCard.classList.add(
                'is-center'
            );


            /*
             * Card yang berhenti di tengah
             * otomatis naik.
             */

            selectCard(
                centerCard,
                true
            );

        }



        /* =====================================================
           WHEEL / TOUCHPAD
        ===================================================== */

        function handleWheel(event) {

            /*
             * Ambil delta terbesar.
             *
             * Mouse:
             * deltaY
             *
             * Touchpad:
             * bisa deltaX atau deltaY
             */

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


            /*
             * Kalau tidak ada pergerakan,
             * abaikan.
             */

            if (movement === 0) {
                return;
            }


            /*
             * JANGAN biarkan browser
             * melakukan scroll halaman.
             */

            event.preventDefault();


            isScrolling =
                true;


            /*
             * Scroll horizontal.
             *
             * deltaY positif
             * = mouse wheel turun
             * = bergerak ke kanan
             *
             * deltaY negatif
             * = mouse wheel naik
             * = bergerak ke kiri
             */

            carousel.scrollLeft +=
                movement;


            /*
             * Tunggu sampai user berhenti
             * scrolling.
             */

            clearTimeout(
                scrollTimer
            );


            scrollTimer =
                setTimeout(
                    finishScrolling,
                    220
                );

        }



        /*
         * Event dipasang pada WRAPPER,
         * bukan hanya carousel.
         *
         * Jadi saat cursor berada di area
         * kosong sekitar card pun tetap bekerja.
         */

        carouselWrapper.addEventListener(
            'wheel',
            handleWheel,
            {
                passive: false
            }
        );



        /* =====================================================
           CLICK CARD
        ===================================================== */

        cards.forEach(card => {


            card.addEventListener(
                'click',
                function(event) {


                    /*
                     * Kalau klik tombol
                     * Lihat Profil,
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



            /* =================================================
               ENTER PADA CARD
            ================================================= */

            card.addEventListener(
                'keydown',
                function(event) {

                    if (
                        event.key === 'Enter'
                    ) {

                        event.preventDefault();


                        window.location.href =
                            card.dataset.url;

                    }

                }
            );

        });



        /* =====================================================
           ENTER PADA CAROUSEL
        ===================================================== */

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



        /* =====================================================
           CLICK WRAPPER
        ===================================================== */

        carouselWrapper.addEventListener(
            'click',
            function(event) {

                /*
                 * Kalau klik area kosong,
                 * jangan melakukan apa-apa.
                 */

                if (
                    event.target ===
                    carouselWrapper
                ) {

                    return;

                }

            }
        );



        /* =====================================================
           RESIZE
        ===================================================== */

        window.addEventListener(
            'resize',
            function() {

                /*
                 * Kalau belum memilih talent,
                 * jangan otomatis memilih.
                 */

                if (!selectedCard) {
                    return;
                }


                centerCard(
                    selectedCard
                );

            }
        );


    }

</script>


</body>
</html>
