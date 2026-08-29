<style>
    .whisperly-nav {
        position: fixed;
        top: 20px;
        left: 28px;
        right: 28px;
        z-index: 1000;

        display: flex;
        align-items: center;
        justify-content: space-between;

        min-height: 70px;
        padding: 12px 24px;

        border-radius: 18px 18px 32px 32px;
        background: #17172f;

        box-shadow: 0 10px 30px rgba(23, 23, 47, 0.18);
    }

    /* =========================
       LOGO
       ========================= */

    .whisperly-brand {
        color: #fbf8f2;
        font: 700 25px Georgia, serif;
        letter-spacing: .04em;
        text-decoration: none;

        transition: opacity 0.2s ease;
    }

    .whisperly-brand:hover {
        opacity: 0.8;
    }

    /* =========================
       BAGIAN KANAN NAVBAR
       ========================= */

    .whisperly-nav-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* =========================
       USERNAME
       ========================= */

    .whisperly-username {
        padding: 8px 15px;

        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 99px;

        color: #c7b6ef;

        font: 600 12px Arial, sans-serif;

        white-space: nowrap;
    }

    /* =========================
       BUTTON CHAT
       ========================= */

    .whisperly-chat-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 40px;
        padding: 0 18px;

        border-radius: 999px;

        background: #c7b6ef;
        color: #17172f;

        font: 700 13px Arial, sans-serif;

        text-decoration: none;

        box-shadow: 0 6px 16px rgba(199, 182, 239, 0.18);

        transition:
            transform 0.2s ease,
            background 0.2s ease,
            box-shadow 0.2s ease;
    }

    .whisperly-chat-btn:hover {
        transform: translateY(-2px);

        background: #d8cdf7;

        box-shadow: 0 8px 20px rgba(199, 182, 239, 0.28);
    }

    .whisperly-chat-btn:active {
        transform: translateY(0);
    }

    /* =========================
       RESPONSIVE MOBILE
       ========================= */

    @media (max-width: 600px) {

        .whisperly-nav {
            top: 12px;
            left: 14px;
            right: 14px;

            min-height: 60px;

            padding: 10px 16px;

            border-radius: 16px 16px 26px 26px;
        }

        .whisperly-brand {
            font-size: 20px;
        }

        .whisperly-username {
            display: none;
        }

        .whisperly-chat-btn {
            min-height: 36px;
            padding: 0 14px;

            font-size: 12px;
        }
    }
</style>


<header class="whisperly-nav">

    {{-- LOGO --}}
    <a
        class="whisperly-brand"
        href="{{ route('whisperly.home') }}"
    >
        WHISPERLY
    </a>


    {{-- BAGIAN KANAN --}}
    <div class="whisperly-nav-right">

        {{-- USERNAME --}}
        @if (auth('whisperly')->check())
            <span class="whisperly-username">
                {{ auth('whisperly')->user()->username }}
            </span>
        @endif


        {{-- CHAT HANYA UNTUK USER & TALENT --}}
        @if (
            auth('whisperly')->check() &&
            in_array(
                auth('whisperly')->user()->role,
                ['user', 'talent'],
                true
            )
        )

            <a
                href="{{ route('whisperly.chat.index') }}"
                class="whisperly-chat-btn"
            >
                Chat
            </a>

        @endif

    </div>

</header>