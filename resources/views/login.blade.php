<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Whisperly - Login</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            width: 100%;

            font-family: Arial, sans-serif;

            /* BACKGROUND */
            background-image: url("/assets/images/jep.jpeg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            position: relative;
            overflow: hidden;
        }


        /* =====================================
           LOGIN CONTAINER
        ===================================== */

        .login-container {

            position: absolute;

            /* Jarak dari tepi kanan */
            right: 6cm;

            top: 50%;

            transform: translateY(-50%);

            width: 350px;
        }


        .login-form {
            width: 100%;
        }


        /* =====================================
           INPUT
        ===================================== */

        .input-box {

            position: relative;

            width: 100%;
            height: 52px;

            margin-bottom: 22px;

            display: flex;
            align-items: center;

            background: rgba(255, 255, 255, 0.75);

            border-radius: 30px;

            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);

            box-shadow:
                inset 5px 5px 10px rgba(0, 0, 0, 0.08),
                inset -5px -5px 10px rgba(255, 255, 255, 0.9),
                0 3px 8px rgba(0, 0, 0, 0.05);

            transition: 0.3s ease;
        }


        /* INPUT HOVER */

        .input-box:focus-within {

            box-shadow:
                inset 5px 5px 10px rgba(0, 0, 0, 0.06),
                inset -5px -5px 10px rgba(255, 255, 255, 0.95),
                0 0 10px rgba(105, 160, 55, 0.15);
        }


        /* =====================================
           ICON
        ===================================== */

        .icon {

            width: 48px;

            display: flex;
            justify-content: center;
            align-items: center;

            flex-shrink: 0;
        }


        .icon svg {

            width: 19px;
            height: 19px;

            fill: none;

            stroke: #6c7565;

            stroke-width: 1.7;

            stroke-linecap: round;
            stroke-linejoin: round;
        }


        /* =====================================
           INPUT TEXT
        ===================================== */

        .input-box input {

            flex: 1;

            height: 100%;

            border: none;
            outline: none;

            background: transparent;

            color: #4d5449;

            font-size: 14px;

            padding-right: 15px;
        }


        .input-box input::placeholder {

            color: #697064;

            opacity: 1;
        }


        /* =====================================
           PASSWORD EYE
        ===================================== */

        .eye-btn {

            border: none;

            background: transparent;

            cursor: pointer;

            margin-right: 15px;

            font-size: 14px;

            opacity: 0.55;

            transition: 0.2s;
        }


        .eye-btn:hover {

            opacity: 1;
        }


        /* =====================================
           LOGIN BUTTON
        ===================================== */

        .login-btn {

            position: relative;

            width: 100%;
            height: 52px;

            border: none;

            border-radius: 30px;

            /* HIJAU MENYESUAIKAN DAUN */
            background: #78a942;

            color: white;

            font-size: 16px;

            font-weight: 600;

            cursor: pointer;

            box-shadow:
                0 5px 12px rgba(73, 105, 43, 0.25);

            transition:
                transform 0.15s ease,
                background 0.3s ease,
                box-shadow 0.3s ease;
        }


        /* =====================================
           HOVER BUTTON
        ===================================== */

        .login-btn:hover {

            background: #6f9d3d;

            box-shadow:
                0 7px 16px rgba(73, 105, 43, 0.30);
        }


        /* =====================================
           CLICK / GLOW
        ===================================== */

        .login-btn:active {

            transform: scale(0.98);

            box-shadow:

                0 0 7px rgba(255, 255, 255, 0.9),

                0 0 15px rgba(120, 169, 66, 0.8),

                0 0 28px rgba(120, 169, 66, 0.55),

                0 0 45px rgba(160, 205, 110, 0.35);
        }


        /* =====================================
           REGISTER
        ===================================== */

        .register-text {

            margin-top: 18px;

            text-align: center;

            color: #777c73;

            font-size: 12px;
        }


        .register-text a {

            color: #66705d;

            font-weight: 600;

            text-decoration: none;
        }


        .register-text a:hover {

            text-decoration: underline;
        }

        .secret-login {
            display: block;
            margin: 16px auto 0;
            border: 0;
            background: transparent;
            color: #697064;
            cursor: pointer;
            font-size: 16px;
            opacity: 0.65;
        }

        .secret-login:hover {
            opacity: 1;
        }

        .secret-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(35, 45, 31, 0.34);
            backdrop-filter: blur(6px);
            z-index: 10;
        }

        .secret-modal.is-open {
            display: flex;
        }

        .secret-box {
            position: relative;
            width: min(360px, 100%);
            padding: 30px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 24px 70px rgba(43, 64, 34, 0.25);
            animation: secret-modal-in 0.22s ease-out;
        }

        .secret-box h2 {
            margin-bottom: 18px;
            color: #4d5449;
            font-size: 20px;
        }

        .secret-box input {
            width: 100%;
            height: 48px;
            padding: 0 16px;
            border: 1px solid rgba(105, 112, 100, 0.25);
            border-radius: 14px;
            outline: none;
        }

        .secret-submit {
            width: 100%;
            height: 46px;
            margin-top: 14px;
            border: 0;
            border-radius: 14px;
            background: #78a942;
            color: #fff;
            cursor: pointer;
            font-weight: 600;
        }

        .secret-close {
            position: absolute;
            top: 12px;
            right: 15px;
            border: 0;
            background: transparent;
            color: #697064;
            cursor: pointer;
            font-size: 22px;
        }

        .secret-error {
            margin-top: 10px;
            color: #b04f4f;
            font-size: 12px;
        }

        @keyframes secret-modal-in {
            from { opacity: 0; transform: translateY(10px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }


        /* =====================================
           MOBILE
        ===================================== */

        @media (max-width: 1100px) {

            .login-container {

                right: 8%;

                width: 330px;
            }
        }


        @media (max-width: 700px) {

            body {

                background-position: left center;
            }

            .login-container {

                right: 50%;

                transform: translate(50%, -50%);

                width: min(330px, 80%);
            }
        }

    </style>
</head>


<body>


    <div class="login-container">

        <form class="login-form" method="POST" action="{{ route('login.baru.store') }}">

            @csrf


            <!-- USERNAME -->

            <div class="input-box">

                <span class="icon">

                    <svg viewBox="0 0 24 24">

                        <circle
                            cx="12"
                            cy="8"
                            r="4">
                        </circle>

                        <path
                            d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8">
                        </path>

                    </svg>

                </span>


                <input
                    type="text"
                    name="username"
                    placeholder="Username or email"
                    autocomplete="username"
                    value="{{ old('username') }}"
                    required
                >

            </div>

            @error('username')
                <div class="error-message">{{ $message }}</div>
            @enderror


            <!-- PASSWORD -->

            <div class="input-box">

                <span class="icon">

                    <svg viewBox="0 0 24 24">

                        <rect
                            x="5"
                            y="10"
                            width="14"
                            height="10"
                            rx="2">
                        </rect>

                        <path
                            d="M8 10V7a4 4 0 0 1 8 0v3">
                        </path>

                    </svg>

                </span>


                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Password"
                    autocomplete="current-password"
                    required
                >


                <button
                    type="button"
                    class="eye-btn"
                    onclick="togglePassword()">

                    👁

                </button>

            </div>


            <!-- LOGIN -->

            <button
                type="submit"
                class="login-btn">

                Login

            </button>


            <!-- SIGN UP -->

            <p class="register-text">

                Don't have an account yet?

             <a href="{{ route('register.baru') }}">
    Sign Up
</a>
            </p>

            <button type="button" class="secret-login" onclick="openSecretModal()" aria-label="Admin access">&#128272;</button>


        </form>

    </div>

    <div class="secret-modal {{ $errors->has('secret_password') ? 'is-open' : '' }}" id="secret-modal" role="dialog" aria-modal="true" aria-labelledby="secret-title">
        <div class="secret-box">
            <button type="button" class="secret-close" onclick="closeSecretModal()" aria-label="Tutup">&times;</button>
            <h2 id="secret-title">Password Rahasia</h2>
            <form method="POST" action="{{ route('login.baru.secret') }}">
                @csrf
                <input type="password" name="secret_password" required autofocus>
                @error('secret_password')
                    <div class="secret-error">{{ $message }}</div>
                @enderror
                <button type="submit" class="secret-submit">Masuk</button>
            </form>
        </div>
    </div>


    <script>

        function togglePassword() {

            const password =
                document.getElementById("password");

            const eye =
                document.querySelector(".eye-btn");


            if (password.type === "password") {

                password.type = "text";

                eye.textContent = "🙈";

            } else {

                password.type = "password";

                eye.textContent = "👁";

            }

        }

        function openSecretModal() {
            document.getElementById('secret-modal').classList.add('is-open');
        }

        function closeSecretModal() {
            document.getElementById('secret-modal').classList.remove('is-open');
        }

    </script>

</body>
</html>