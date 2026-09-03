<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Whisperly - Register</title>

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
            width: 100%;
            min-height: 100vh;
            position: relative;

            font-family: Arial, sans-serif;

            /* BACKGROUND SAMA SEPERTI LOGIN */
            background-image: url("/assets/images/BG.jpg");
            background-size: 90% auto;
            background-position: left center;
            background-repeat: no-repeat;
            background-color: #ffffff;

            overflow: hidden;
        }


        /* =========================================================
           REGISTER CONTAINER
        ========================================================= */

        .register-container {
            position: fixed;

            right: 6cm;
            top: 50%;

            transform: translateY(-50%);

            width: 350px;

            z-index: 2;
        }

        .register-form {
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
           ICON
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
           CREATE ACCOUNT BUTTON
           SAMA SEPERTI LOGIN BUTTON
        ========================================================= */

        .register-btn {
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


        /* =========================================================
           BUTTON HOVER
        ========================================================= */

        .register-btn:hover {
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


        /* =========================================================
           BUTTON ACTIVE
        ========================================================= */

        .register-btn:active {
            transform: translateY(0);

            box-shadow:
                0 5px 13px rgba(54, 75, 43, 0.18);
        }


        /* =========================================================
           BACK TO LOGIN
        ========================================================= */

        .login-text {
            margin-top: 18px;

            text-align: center;

            color: #858b80;

            font-size: 12px;
        }


        .login-text a {
            color: #536641;

            font-weight: 600;

            text-decoration: none;

            transition: 0.2s ease;
        }


        .login-text a:hover {
            color: #354b2d;

            text-decoration: underline;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1100px) {

            .register-container {
                right: 8%;

                width: 330px;
            }
        }


        @media (max-width: 700px) {

            body {
                background-position: left center;
                background-size: auto 100%;
            }

            .register-container {
                left: 50%;
                right: auto;

                transform:
                    translate(-50%, -50%);

                width:
                    min(330px, 80%);
            }
        }

    </style>

</head>


<body>


    <!-- =========================================================
         REGISTER FORM
    ========================================================= -->

    <div class="register-container">

        <form
            class="register-form"
            method="POST"
            action="{{ route('register.baru.store') }}"
        >

            @csrf


            <!-- =================================================
                 USERNAME
            ================================================= -->

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
                    placeholder="Username"
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


            <!-- =================================================
                 EMAIL
            ================================================= -->

            <div class="input-box">

                <span class="icon">

                    <svg viewBox="0 0 24 24">

                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="14"
                            rx="2"
                        ></rect>

                        <polyline
                            points="3,7 12,13 21,7"
                        ></polyline>

                    </svg>

                </span>


                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    autocomplete="email"
                    value="{{ old('email') }}"
                    required
                >

            </div>


            @error('email')

                <div class="error-message">
                    {{ $message }}
                </div>

            @enderror


            <!-- =================================================
                 PASSWORD
            ================================================= -->

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
                    autocomplete="new-password"
                    required
                >


                <button
                    type="button"
                    class="eye-btn"
                    onclick="togglePassword('password', this)"
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


            <!-- =================================================
                 CONFIRM PASSWORD
            ================================================= -->

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
                    name="password_confirmation"
                    id="confirm-password"
                    placeholder="Confirm Password"
                    autocomplete="new-password"
                    required
                >


                <button
                    type="button"
                    class="eye-btn"
                    onclick="togglePassword('confirm-password', this)"
                    aria-label="Tampilkan password"
                >
                    👁
                </button>

            </div>


            <!-- =================================================
                 CREATE ACCOUNT
            ================================================= -->

            <button
                type="submit"
                class="register-btn"
            >
                Create Account
            </button>


            <!-- =================================================
                 LOGIN
            ================================================= -->

            <p class="login-text">

                Already have an account?

                <a href="{{ route('login.baru') }}">
                    Login
                </a>

            </p>

        </form>

    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================= -->

    <script>

        function togglePassword(id, button) {

            const password =
                document.getElementById(id);


            if (password.type === "password") {

                password.type = "text";

                button.textContent = "🙈";

                button.setAttribute(
                    "aria-label",
                    "Sembunyikan password"
                );

            } else {

                password.type = "password";

                button.textContent = "👁";

                button.setAttribute(
                    "aria-label",
                    "Tampilkan password"
                );
            }
        }

    </script>


</body>

</html>