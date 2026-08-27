<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
</head>
<body>
    <h1>Selamat Datang, {{ ucfirst(auth()->user()->username) }}</h1>
</body>
</html><!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Whisperly - Beranda</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {

            min-height: 100vh;

            font-family: Arial, sans-serif;

            background: #fafaf5;

            display: flex;

            justify-content: center;

            align-items: center;

            color: #4d5549;
        }


        /* =====================================
           CONTAINER
        ===================================== */

        .welcome-container {

            text-align: center;

            padding: 50px;
        }


        /* =====================================
           TITLE
        ===================================== */

        .welcome-title {

            font-size: 38px;

            font-weight: 600;

            color: #59634f;

            margin-bottom: 15px;
        }


        .username {

            color: #79a943;
        }


        /* =====================================
           DESCRIPTION
        ===================================== */

        .welcome-description {

            font-size: 15px;

            color: #777c73;

            margin-bottom: 30px;
        }


        /* =====================================
           BUTTON
        ===================================== */

        .start-btn {

            display: inline-block;

            padding: 13px 30px;

            border-radius: 30px;

            background: #79a943;

            color: white;

            text-decoration: none;

            font-size: 14px;

            font-weight: 600;

            box-shadow:
                0 5px 12px rgba(73, 105, 43, 0.25);

            transition: 0.3s ease;
        }


        .start-btn:hover {

            background: #6f9d3d;

            box-shadow:
                0 7px 18px rgba(73, 105, 43, 0.35);

            transform: translateY(-2px);
        }


    </style>

</head>


<body>


    <div class="welcome-container">


        <h1 class="welcome-title">

            Selamat datang,

            <span class="username">
                {{ Auth::user()->username }}
            </span>

            👋

        </h1>


        <p class="welcome-description">

            Selamat datang di Whisperly.
            Senang melihatmu kembali.

        </p>


        <a
            href="#"
            class="start-btn"
        >
            Mulai
        </a>


    </div>


</body>

</html>