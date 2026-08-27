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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =====================================
           BODY
        ===================================== */

        body {

            width: 100%;
            min-height: 100vh;

            position: relative;

            font-family: Arial, sans-serif;

            background: #fafaf5;

            overflow: hidden;
        }


        /* =====================================
           BACKGROUND
        ===================================== */

        .bg-image {

            position: fixed;

            left: 0;
            top: 50%;

            transform: translateY(-50%);

            width: 560px;
            height: auto;

            pointer-events: none;
            user-select: none;

            z-index: 0;
        }


        /* =====================================
           REGISTER CONTAINER
        ===================================== */

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


        /* =====================================
           INPUT
        ===================================== */

        .input-box {

            position: relative;

            width: 100%;
            height: 52px;

            margin-bottom: 18px;

            display: flex;
            align-items: center;

            background: rgba(255, 255, 255, 0.78);

            border-radius: 30px;

            backdrop-filter: blur(5px);

            -webkit-backdrop-filter: blur(5px);

            box-shadow:

                inset 5px 5px 10px rgba(0, 0, 0, 0.07),

                inset -5px -5px 10px rgba(255, 255, 255, 0.95),

                0 3px 8px rgba(0, 0, 0, 0.04);

            transition: 0.3s ease;
        }


        .input-box:focus-within {

            box-shadow:

                inset 5px 5px 10px rgba(0, 0, 0, 0.05),

                inset -5px -5px 10px rgba(255, 255, 255, 0.95),

                0 0 12px rgba(120, 169, 66, 0.20);
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

            stroke: #697363;

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

            color: #4d5549;

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
           REGISTER BUTTON
        ===================================== */

        .register-btn {

            width: 100%;

            height: 52px;

            border: none;

            border-radius: 30px;

            background: #79a943;

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
           BUTTON HOVER
        ===================================== */

        .register-btn:hover {

            background: #6f9d3d;

            box-shadow:

                0 7px 16px rgba(73, 105, 43, 0.30);
        }


        /* =====================================
           BUTTON CLICK GLOW
        ===================================== */

        .register-btn:active {

            transform: scale(0.98);

            box-shadow:

                0 0 7px rgba(255, 255, 255, 0.95),

                0 0 15px rgba(120, 169, 66, 0.85),

                0 0 28px rgba(120, 169, 66, 0.60),

                0 0 45px rgba(160, 205, 110, 0.40);
        }


        /* =====================================
           BACK TO LOGIN
        ===================================== */

        .login-text {

            margin-top: 18px;

            text-align: center;

            color: #777c73;

            font-size: 12px;
        }


        .login-text a {

            color: #66705d;

            font-weight: 600;

            text-decoration: none;
        }


        .login-text a:hover {

            text-decoration: underline;
        }


        /* =====================================
           VALIDATION ERROR
        ===================================== */

        .error-message {

            color: #c45b5b;

            font-size: 11px;

            margin-top: -10px;

            margin-bottom: 10px;

            padding-left: 15px;
        }


        /* =====================================
           MOBILE
        ===================================== */

        @media (max-width: 1100px) {

            .register-container {

                right: 7%;

                width: 330px;
            }
        }


        @media (max-width: 700px) {

            .bg-image {

                width: 450px;

                left: -30px;
            }


            .register-container {

                left: 50%;

                right: auto;

                transform: translate(-50%, -50%);

                width: min(330px, 80%);
            }

        }

    </style>

</head>


<body>


    <!-- =====================================
         BACKGROUND
    ===================================== -->

    <img
        src="{{ asset('assets/images/jep.jpeg') }}"
        class="bg-image"
        alt="Whisperly Background"
    >


    <!-- =====================================
         REGISTER FORM
    ===================================== -->

    <div class="register-container">

        <form
            class="register-form"
            method="POST"
            action="{{ route('register.baru.store') }}"
        >

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


            <!-- EMAIL -->

            <div class="input-box">

                <span class="icon">

                    <svg viewBox="0 0 24 24">

                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="14"
                            rx="2">
                        </rect>

                        <polyline
                            points="3,7 12,13 21,7">
                        </polyline>

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
                    autocomplete="new-password"
                    required
                >


                <button
                    type="button"
                    class="eye-btn"
                    onclick="togglePassword('password', this)"
                >
                    👁
                </button>

            </div>

            @error('password')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror


            <!-- CONFIRM PASSWORD -->

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
                >
                    👁
                </button>

            </div>


            <!-- CREATE ACCOUNT -->

            <button
                type="submit"
                class="register-btn"
            >
                Create Account
            </button>


            <!-- LOGIN -->

            <p class="login-text">

                Already have an account?

                <a href="{{ route('login.baru') }}">
                    Login
                </a>

            </p>


        </form>

    </div>


    <!-- =====================================
         JAVASCRIPT
    ===================================== -->

    <script>

        function togglePassword(id, button) {

            const password =
                document.getElementById(id);


            if (password.type === "password") {

                password.type = "text";

                button.textContent = "🙈";

            } else {

                password.type = "password";

                button.textContent = "👁";

            }

        }

    </script>


</body>

</html>