```html
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Whisperly - Login</title>


    <style>

        /* =========================================================
           RESET
        ========================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =========================================================
           BODY
        ========================================================= */

        body {
            min-height: 100vh;
            width: 100%;

            font-family: Arial, sans-serif;

            background-image: url("/assets/images/BG.jpg");
            background-size: 90% auto;
            background-position: left center;
            background-repeat: no-repeat;
            background-color: #ffffff;

            position: relative;

            overflow: hidden;
        }


        /* =========================================================
           LOGIN CONTAINER
        ========================================================= */

        .login-container {
            position: absolute;

            right: 6cm;
            top: 50%;

            transform: translateY(-50%);

            width: 350px;
        }


        .login-form {
            width: 100%;
        }


        /* =========================================================
           INPUT BOX
        ========================================================= */

        .input-box {
            position: relative;

            width: 100%;
            height: 52px;

            margin-bottom: 20px;

            display: flex;
            align-items: center;

            background: rgba(255, 255, 255, 0.82);

            border: 1px solid rgba(76, 94, 58, 0.18);

            border-radius: 999px;

            backdrop-filter: blur(9px);
            -webkit-backdrop-filter: blur(9px);

            box-shadow:
                0 6px 18px rgba(48, 65, 38, 0.07);

            transition: 0.25s ease;
        }


        .input-box:hover {
            background: rgba(255, 255, 255, 0.92);

            border-color:
                rgba(76, 94, 58, 0.28);

            box-shadow:
                0 8px 22px rgba(48, 65, 38, 0.09);
        }


        .input-box:focus-within {
            background: rgba(255, 255, 255, 0.96);

            border-color:
                rgba(73, 96, 54, 0.48);

            box-shadow:
                0 8px 22px rgba(48, 65, 38, 0.09),
                0 0 0 4px rgba(76, 101, 57, 0.06);
        }


        /* =========================================================
           INPUT ICON
        ========================================================= */

        .icon {
            width: 50px;

            display: flex;

            justify-content: center;
            align-items: center;

            flex-shrink: 0;
        }


        .icon svg {
            width: 19px;
            height: 19px;

            fill: none;

            stroke: #607051;

            stroke-width: 1.7;

            stroke-linecap: round;
            stroke-linejoin: round;
        }


        /* =========================================================
           INPUT
        ========================================================= */

        .input-box input {
            flex: 1;

            width: 100%;
            height: 100%;

            border: none;
            outline: none;

            background: transparent;

            color: #414a3b;

            font-size: 14px;

            padding-right: 15px;
        }


        .input-box input::placeholder {
            color: #788073;

            opacity: 1;
        }


        /* =========================================================
           CHROME AUTOFILL
        ========================================================= */

        .input-box input:-webkit-autofill,
        .input-box input:-webkit-autofill:hover,
        .input-box input:-webkit-autofill:focus,
        .input-box input:-webkit-autofill:active {

            -webkit-box-shadow:
                0 0 0 1000px #ffffff inset !important;

            -webkit-text-fill-color:
                #414a3b !important;

            caret-color:
                #414a3b !important;

            transition:
                background-color 9999s ease-in-out 0s;
        }


        /* =========================================================
           PASSWORD EYE
        ========================================================= */

        .eye-btn {
            width: 42px;
            height: 100%;

            border: none;

            background: transparent;

            color: #68735f;

            cursor: pointer;

            font-size: 14px;

            opacity: 0.50;

            transition: 0.2s ease;
        }


        .eye-btn:hover {
            opacity: 1;

            transform: scale(1.08);
        }


        /* =========================================================
           ERROR
        ========================================================= */

        .error-message {
            margin-top: -12px;
            margin-bottom: 12px;

            padding-left: 18px;

            color: #b04f4f;

            font-size: 12px;
        }


        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .login-btn {
            width: 100%;
            height: 52px;

            margin-top: 3px;

            border: none;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #52663f 0%,
                    #3d5230 100%
                );

            color: #ffffff;

            font-size: 15px;

            font-weight: 600;

            letter-spacing: 0.2px;

            cursor: pointer;

            box-shadow:
                0 8px 20px rgba(54, 75, 43, 0.20);

            transition: 0.25s ease;
        }


        .login-btn:hover {
            background:
                linear-gradient(
                    135deg,
                    #607649 0%,
                    #465e37 100%
                );

            transform: translateY(-2px);

            box-shadow:
                0 11px 25px rgba(54, 75, 43, 0.25);
        }


        .login-btn:active {
            transform: translateY(0);

            box-shadow:
                0 5px 13px rgba(54, 75, 43, 0.18);
        }


        /* =========================================================
           REGISTER
        ========================================================= */

        .register-text {
            margin-top: 18px;

            text-align: center;

            color: #858b80;

            font-size: 12px;
        }


        .register-text a {
            color: #536641;

            font-weight: 600;

            text-decoration: none;

            transition: 0.2s ease;
        }


        .register-text a:hover {
            color: #354b2d;

            text-decoration: underline;
        }


        /* =========================================================
           ADMIN ACCESS
        ========================================================= */

        .secret-login {

            display: flex;

            align-items: center;
            justify-content: center;

            gap: 9px;

            margin: 17px auto 0;

            padding: 9px 17px;

            border:
                1px solid rgba(83, 102, 65, 0.25);

            border-radius: 999px;

            background:
                rgba(255, 255, 255, 0.72);

            color: #526341;

            cursor: pointer;

            font-family: Arial, sans-serif;

            font-size: 12px;

            font-weight: 600;

            letter-spacing: 0.15px;

            opacity: 0.95;

            backdrop-filter: blur(7px);
            -webkit-backdrop-filter: blur(7px);

            box-shadow:
                0 5px 14px rgba(55, 73, 43, 0.09);

            transition:
                background 0.25s ease,
                color 0.25s ease,
                border-color 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }


        .secret-login:hover {

            background: #536641;

            color: #ffffff;

            border-color: #536641;

            transform: translateY(-2px);

            box-shadow:
                0 8px 18px rgba(55, 73, 43, 0.18);
        }


        .secret-login:active {
            transform: translateY(0);
        }


        /* =========================================================
           LOCK ICON
        ========================================================= */

        .lock-icon {

            position: relative;

            width: 21px;
            height: 23px;

            display: block;

            flex-shrink: 0;
        }


        .lock-body {

            position: absolute;

            left: 1px;
            bottom: 0;

            width: 19px;
            height: 14px;

            background: currentColor;

            border-radius: 3px;
        }


        .lock-shackle {

            position: absolute;

            z-index: 1;

            left: 5px;
            top: 0;

            width: 11px;
            height: 11px;

            border:
                2px solid currentColor;

            border-bottom: none;

            border-radius:
                9px 9px 0 0;
        }


        .lock-hole {

            position: absolute;

            z-index: 3;

            left: 9px;
            bottom: 5px;

            width: 3px;
            height: 5px;

            border-radius: 2px;

            background: #ffffff;
        }


        .lock-hole::before {

            content: "";

            position: absolute;

            left: 0;
            top: -2px;

            width: 3px;
            height: 3px;

            border-radius: 50%;

            background: #ffffff;
        }


        .secret-login:hover .lock-hole,
        .secret-login:hover .lock-hole::before {

            background: #536641;
        }


        /* =========================================================
           SECRET MODAL
        ========================================================= */

        .secret-modal {

            position: fixed;

            inset: 0;

            display: none;

            align-items: center;
            justify-content: center;

            padding: 20px;

            background:
                rgba(35, 45, 31, 0.40);

            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);

            z-index: 999;
        }


        .secret-modal.is-open {
            display: flex;
        }


        /* =========================================================
           SECRET BOX
        ========================================================= */

        .secret-box {

            position: relative;

            width: min(360px, 100%);

            padding: 30px;

            border-radius: 24px;

            background:
                rgba(255, 255, 255, 0.97);

            border:
                1px solid rgba(74, 91, 55, 0.12);

            box-shadow:
                0 24px 70px rgba(43, 64, 34, 0.25);

            animation:
                secret-modal-in 0.22s ease-out;
        }


        .secret-box h2 {

            margin-bottom: 8px;

            color: #4d5845;

            font-size: 20px;
        }


        .secret-description {

            margin-bottom: 18px;

            color: #858b80;

            font-size: 12px;

            line-height: 1.5;
        }


        /* =========================================================
           SECRET FIELD
        ========================================================= */

        .secret-field {

            margin-bottom: 13px;
        }


        .secret-label {

            display: block;

            margin: 0 0 7px 14px;

            color: #59634f;

            font-size: 12px;

            font-weight: 600;
        }


        /* =========================================================
           SECRET INPUT
        ========================================================= */

        .secret-input-wrap {

            position: relative;

            width: 100%;
        }


        .secret-box input {

            width: 100%;

            height: 48px;

            padding: 0 16px;

            border:
                1px solid rgba(88, 101, 75, 0.22);

            border-radius: 999px;

            outline: none;

            color: #4d5449;

            background: #fafbf7;

            transition: 0.2s ease;
        }


        .secret-box input:focus {

            border-color: #66784b;

            box-shadow:
                0 0 0 3px rgba(102, 120, 75, 0.08);
        }


        .secret-box input::placeholder {

            color: #969c91;
        }


        /* =========================================================
           SECRET PASSWORD EYE
        ========================================================= */

        .secret-eye {

            position: absolute;

            top: 50%;
            right: 14px;

            transform: translateY(-50%);

            width: 32px;
            height: 32px;

            border: none;

            background: transparent;

            color: #68735f;

            cursor: pointer;

            opacity: 0.55;

            font-size: 14px;

            transition: 0.2s ease;
        }


        .secret-eye:hover {

            opacity: 1;

            transform:
                translateY(-50%)
                scale(1.08);
        }


        /* =========================================================
           SECRET SUBMIT
        ========================================================= */

        .secret-submit {

            width: 100%;

            height: 46px;

            margin-top: 5px;

            border: none;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #536a3e,
                    #3e572f
                );

            color: #ffffff;

            cursor: pointer;

            font-weight: 600;

            transition: 0.2s ease;
        }


        .secret-submit:hover {

            background:
                linear-gradient(
                    135deg,
                    #60784a,
                    #476238
                );

            transform: translateY(-1px);
        }


        .secret-submit:active {

            transform: translateY(0);
        }


        /* =========================================================
           SECRET CLOSE
        ========================================================= */

        .secret-close {

            position: absolute;

            top: 12px;
            right: 15px;

            width: 30px;
            height: 30px;

            border: none;

            border-radius: 50%;

            background: transparent;

            color: #697064;

            cursor: pointer;

            font-size: 22px;

            transition: 0.2s ease;
        }


        .secret-close:hover {

            background:
                rgba(70, 87, 55, 0.08);

            color: #3f5134;
        }


        /* =========================================================
           SECRET ERROR
        ========================================================= */

        .secret-error {

            margin-top: 8px;

            margin-left: 14px;

            color: #b04f4f;

            font-size: 12px;
        }


        /* =========================================================
           MODAL ANIMATION
        ========================================================= */

        @keyframes secret-modal-in {

            from {

                opacity: 0;

                transform:
                    translateY(10px)
                    scale(0.97);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 1100px) {

            .login-container {

                right: 8%;

                width: 330px;
            }
        }


        @media (max-width: 700px) {

            body {

                background-position:
                    left center;
            }


            .login-container {

                right: 50%;

                transform:
                    translate(50%, -50%);

                width:
                    min(330px, 80%);
            }
        }

    </style>

</head>


<body>


    <!-- =========================================================
         LOGIN
    ========================================================= -->

    <div class="login-container">

        <form
            class="login-form"
            method="POST"
            action="{{ route('login.baru.store') }}"
        >

            @csrf


            <!-- USERNAME -->

            <div class="input-box">

                <span class="icon">

                    <svg viewBox="0 0 24 24">

                        <circle
                            cx="12"
                            cy="8"
                            r="4"
                        ></circle>

                        <path
                            d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"
                        ></path>

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

                <div class="error-message">
                    {{ $message }}
                </div>

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
                            rx="2"
                        ></rect>

                        <path
                            d="M8 10V7a4 4 0 0 1 8 0v3"
                        ></path>

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
                    onclick="togglePassword()"
                    aria-label="Tampilkan password"
                >
                    👁
                </button>

            </div>


            @error('password')

                <div class="error-message">
                    {{ $message }}
                </div>

            @enderror


            <!-- LOGIN -->

            <button
                type="submit"
                class="login-btn"
            >
                Login
            </button>


            <!-- REGISTER -->

            <p class="register-text">

                Don't have an account yet?

                <a href="{{ route('register.baru') }}">
                    Sign Up
                </a>

            </p>


            <!-- =================================================
                 ADMIN ACCESS
            ================================================= -->

            <button
                type="button"
                class="secret-login"
                onclick="openSecretModal()"
                aria-label="Login Admin"
                title="Login Admin"
            >

                <span class="lock-icon">

                    <span class="lock-shackle"></span>

                    <span class="lock-body"></span>

                    <span class="lock-hole"></span>

                </span>


                <span>
                    Admin Access
                </span>

            </button>

        </form>

    </div>



    <!-- =========================================================
         SECRET MODAL
    ========================================================= -->

    <div
        class="secret-modal {{ $errors->has('secret_password') || $errors->has('secret_username') ? 'is-open' : '' }}"
        id="secret-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="secret-title"
    >

        <div class="secret-box">


            <!-- CLOSE -->

            <button
                type="button"
                class="secret-close"
                onclick="closeSecretModal()"
                aria-label="Tutup"
            >
                &times;
            </button>


            <h2 id="secret-title">
                Admin Access
            </h2>


            <p class="secret-description">
                Masukkan USN dan password admin untuk melanjutkan.
            </p>


            <form
                method="POST"
                action="{{ route('login.baru.secret') }}"
            >

                @csrf


                <!-- USN -->

                <div class="secret-field">

                    <label
                        for="secret_username"
                        class="secret-label"
                    >
                        USN
                    </label>


                    <input
                        type="text"
                        id="secret_username"
                        name="secret_username"
                        placeholder="Masukkan username admin"
                        autocomplete="username"
                        value="{{ old('secret_username') }}"
                        required
                    >


                    @error('secret_username')

                        <div class="secret-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- PASSWORD -->

                <div class="secret-field">

                    <label
                        for="secret_password"
                        class="secret-label"
                    >
                        Password
                    </label>


                    <div class="secret-input-wrap">

                        <input
                            type="password"
                            id="secret_password"
                            name="secret_password"
                            placeholder="Masukkan password admin"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            class="secret-eye"
                            onclick="toggleSecretPassword()"
                            aria-label="Tampilkan password admin"
                        >
                            👁
                        </button>

                    </div>


                    @error('secret_password')

                        <div class="secret-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- SUBMIT -->

                <button
                    type="submit"
                    class="secret-submit"
                >
                    Masuk sebagai Admin
                </button>

            </form>

        </div>

    </div>



    <!-- =========================================================
         JAVASCRIPT
    ========================================================= -->

    <script>


        /* =========================================================
           SHOW / HIDE LOGIN PASSWORD
        ========================================================= */

        function togglePassword() {

            const password =
                document.getElementById("password");

            const eye =
                document.querySelector(".eye-btn");


            if (password.type === "password") {

                password.type = "text";

                eye.textContent = "🙈";

                eye.setAttribute(
                    "aria-label",
                    "Sembunyikan password"
                );

            } else {

                password.type = "password";

                eye.textContent = "👁";

                eye.setAttribute(
                    "aria-label",
                    "Tampilkan password"
                );

            }

        }


        /* =========================================================
           SHOW / HIDE ADMIN PASSWORD
        ========================================================= */

        function toggleSecretPassword() {

            const password =
                document.getElementById("secret_password");

            const eye =
                document.querySelector(".secret-eye");


            if (password.type === "password") {

                password.type = "text";

                eye.textContent = "🙈";

                eye.setAttribute(
                    "aria-label",
                    "Sembunyikan password admin"
                );

            } else {

                password.type = "password";

                eye.textContent = "👁";

                eye.setAttribute(
                    "aria-label",
                    "Tampilkan password admin"
                );

            }

        }


        /* =========================================================
           OPEN SECRET MODAL
        ========================================================= */

        function openSecretModal() {

            document
                .getElementById("secret-modal")
                .classList
                .add("is-open");

            setTimeout(function() {

                document
                    .getElementById("secret_username")
                    .focus();

            }, 100);

        }


        /* =========================================================
           CLOSE SECRET MODAL
        ========================================================= */

        function closeSecretModal() {

            document
                .getElementById("secret-modal")
                .classList
                .remove("is-open");

        }


        /* =========================================================
           CLICK OUTSIDE MODAL
        ========================================================= */

        document
            .getElementById("secret-modal")
            .addEventListener(
                "click",
                function(event) {

                    if (event.target === this) {

                        closeSecretModal();

                    }

                }
            );


        /* =========================================================
           ESC TO CLOSE
        ========================================================= */

        document.addEventListener(
            "keydown",
            function(event) {

                if (event.key === "Escape") {

                    closeSecretModal();

                }

            }
        );

    </script>


</body>

</html>
