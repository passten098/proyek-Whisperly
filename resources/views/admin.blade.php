<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Whisperly</title>

    <style>
        :root {
            color-scheme: dark;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background:
                linear-gradient(
                    135deg,
                    rgba(5, 8, 25, 0.95),
                    rgba(16, 24, 55, 0.9)
                ),
                #050505;
            color: #f5f1e8;
            font-family: Georgia, serif;
            overflow-x: hidden;
        }

        main {
            width: min(900px, 100%);
            margin: 0 auto;
            padding: 100px 40px;
        }

        .eyebrow {
            color: #b5cf7a;
            font: 600 12px Arial, sans-serif;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        h1 {
            max-width: 760px;
            margin: 18px 0 12px;
            font-size: clamp(42px, 8vw, 88px);
            font-weight: 400;
            line-height: 0.98;
        }

        h1 span {
            color: #fff3a6;
            font-style: italic;
        }

        .description {
            margin: 0;
            max-width: 560px;
            color: #b9b4aa;
            font: 16px/1.8 Arial, sans-serif;
        }

        .buttons {
            display: flex;
            gap: 14px;
            margin-top: 34px;
            flex-wrap: wrap;
        }

        .admin-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 190px;
            padding: 14px 28px;

            border-radius: 30px;
            border: 1px solid rgba(255,255,255,.25);

            background: linear-gradient(
                180deg,
                #456aa3,
                #142b55
            );

            color: white;
            text-decoration: none;

            font: 600 14px Arial, sans-serif;
            letter-spacing: .04em;

            cursor: pointer;

            transition:
                background .25s ease,
                color .25s ease,
                box-shadow .25s ease,
                transform .15s ease;
        }

        .admin-button:hover {
            transform: translateY(-2px);
        }

        /*
         * SAAT DIKLIK
         */
        .admin-button.clicked {
            background: linear-gradient(
                180deg,
                #fff3a6,
                #e99a21
            );

            color: #211600;

            border-color: #ffe08a;

            box-shadow:
                0 0 10px rgba(255, 193, 64, .7),
                0 0 30px rgba(255, 166, 40, .45);
        }

        .talents {
            display: grid;
            gap: 10px;
            margin-top: 50px;
            font: 14px Arial, sans-serif;
        }

        .talent {
            padding: 14px 16px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 12px;
            color: #d6d0cb;
            background: rgba(255,255,255,.02);
        }

        .talent a {
            color: #b5cf7a;
            text-decoration: none;
        }

        .bottom-buttons {
            position: fixed;
            right: 32px;
            bottom: 18px;

            display: flex;
            gap: 12px;
        }

        .bottom-button {
            padding: 12px 24px;

            border-radius: 30px;

            border: 1px solid rgba(255,255,255,.2);

            background: linear-gradient(
                180deg,
                #456aa3,
                #142b55
            );

            color: white;

            text-decoration: none;

            font: 600 12px Arial, sans-serif;
            letter-spacing: .04em;

            transition: .25s ease;
        }

        .bottom-button:hover {
            background: linear-gradient(
                180deg,
                #fff3a6,
                #e99a21
            );

            color: #211600;
        }

        @media (max-width: 600px) {

            main {
                padding: 80px 24px;
            }

            h1 {
                font-size: 52px;
            }

            .bottom-buttons {
                position: static;
                padding: 20px 24px;
            }
        }
    </style>
</head>

<body>

    @include('whisperly.navbar')

    <main>

        <div class="eyebrow">
            Whisperly / Admin
        </div>

        <h1>
            Welcome to
            <br>
            <span>Quiet Kampus</span>
        </h1>

        <p class="description">
            Ruang administrasi Whisperly untuk mengelola
            talent dan pengaduan dari pengguna.
        </p>

        <div class="buttons">

            {{-- TOMBOL RUANG PENGADUAN --}}
      <a href="{{ route('menfess.admin') }}"
   class="admin-button"
   id="menfessButton">
    Ruang Pengaduan
</a>

        </div>


        {{-- DAFTAR TALENT --}}
        <div class="talents">

            @forelse ($talents as $talent)

                <div class="talent">

                    <a href="{{ route('whisperly.talents.show', $talent->pengguna->username) }}">
                        {{ ucfirst($talent->pengguna->username) }}
                    </a>

                    <br>

                    {{ $talent->deskripsi }}

                </div>

            @empty

                <div class="talent">
                    Belum ada data Talent.
                </div>

            @endforelse

        </div>

    </main>


    <div class="bottom-buttons">

        <a href="{{ route('login.baru') }}" class="bottom-button">
            KEMBALI
        </a>

        <a href="{{ route('whisperly.talents.index') }}" class="bottom-button">
            LANJUT
        </a>

    </div>


    <script>

        const menfessButton =
            document.getElementById('menfessButton');

        menfessButton.addEventListener('click', function () {

            this.classList.add('clicked');

        });

    </script>

</body>
</html>