<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ruang Pengaduan | Whisperly</title>

    <style>

        * {
            box-sizing: border-box;
        }

        :root {
            --dark: #30251f;
            --text: #45403b;
            --muted: #817970;

            --green-soft: #dce9df;
            --green: #718d78;
            --green-dark: #526b58;

            --blue: #6078c7;
            --blue-soft: #dce7f3;

            --purple: #756dcc;

            --shadow: 0 5px 16px rgba(45,53,53,.12);
            --shadow-small: 0 3px 9px rgba(45,53,53,.08);
        }


        /* =====================================================
           RESET
        ===================================================== */

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;

            font-family:
                "Cambria",
                Georgia,
                "Times New Roman",
                serif;

            color: var(--text);

            background:
                linear-gradient(
                    180deg,
                    #edf4f7,
                    #f5f7f7
                );

            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }


        /* =====================================================
           BACKGROUND
        ===================================================== */

        body.theme-random {
            background-image:
                linear-gradient(
                    rgba(255,255,255,.12),
                    rgba(255,255,255,.12)
                ),
                url("{{ asset('assets/images/CAMPURAN.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body.theme-horror {
            background-image:
                linear-gradient(
                    rgba(30,16,12,.08),
                    rgba(30,16,12,.08)
                ),
                url("{{ asset('assets/images/HOROR.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body.theme-love {
            background-image:
                linear-gradient(
                    rgba(255,255,255,.10),
                    rgba(255,255,255,.10)
                ),
                url("{{ asset('assets/images/CINTA.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body.theme-sad {
            background-image:
                linear-gradient(
                    rgba(255,255,255,.12),
                    rgba(255,255,255,.12)
                ),
                url("{{ asset('assets/images/SEDIH.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .top-header {
            width: 100%;
            min-height: 82px;

            display: flex;
            align-items: center;

            position: relative;

            padding: 0 42px;

            background: rgba(255,255,255,.90);

            border: none !important;
            outline: none !important;

            box-shadow:
                0 4px 12px
                rgba(40,48,48,.10);
        }

        .back-button {
            display: inline-flex;
            align-items: center;

            gap: 8px;

            padding: 10px 15px;

            color: #5c554f;

            text-decoration: none;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 18px;
            font-weight: 600;

            border-radius: 10px;

            border: none !important;
            outline: none !important;

            transition: .2s ease;
        }

        .back-button:hover {
            transform: translateY(-1px);
        }

        .page-title {
            position: absolute;

            left: 50%;

            transform: translateX(-50%);

            margin: 0;

            color: var(--dark);

            font-size: 29px;
            font-weight: 700;

            white-space: nowrap;
        }


        /* =====================================================
           PAGE
        ===================================================== */

        .page {
            width: min(1500px, calc(100% - 48px));

            margin: 28px auto 60px;
        }

        .intro {
            padding: 19px 28px;

            margin-bottom: 20px;

            background: rgba(255,255,255,.82);

            border: none !important;
            outline: none !important;

            border-radius: 16px;

            box-shadow: var(--shadow-small);

            text-align: center;
        }

        .intro p {
            margin: 0;

            color: #756d66;

            font-size: 16px;
            line-height: 1.5;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content-grid {
            display: grid;

            grid-template-columns:
                390px
                minmax(0,1fr);

            gap: 24px;

            align-items: start;
        }


        /* =====================================================
           LEFT PANEL
        ===================================================== */

        .composer-panel {
            position: sticky;
            top: 20px;

            min-height: 650px;

            padding: 25px;

            border-radius: 24px;

            background:
                linear-gradient(
                    180deg,
                    rgba(220,233,223,.90),
                    rgba(232,238,230,.90) 40%,
                    rgba(255,245,217,.90)
                );

            border: none !important;
            outline: none !important;

            box-shadow: var(--shadow);
        }

        .info-box {
            padding: 20px;

            margin-bottom: 18px;

            background: rgba(255,255,255,.78);

            border-radius: 18px;

            border: none !important;
            outline: none !important;
        }

        .info-box h3 {
            margin: 0 0 12px;

            color: var(--dark);

            font-size: 15px;
            font-weight: 700;
        }

        .info-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .info-box li {
            margin-bottom: 7px;

            color: #5d5a55;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 13px;
            line-height: 1.5;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .composer-card {
            padding: 22px;

            background: rgba(255,255,255,.84);

            border-radius: 18px;

            border: none !important;
            outline: none !important;
        }

        .composer-title {
            margin: 0 0 20px;

            color: var(--dark);

            font-size: 22px;
            font-weight: 500;

            line-height: 1.4;
        }

        .field {
            margin-bottom: 17px;
        }

        .field label {
            display: block;

            margin-bottom: 7px;

            color: #756d66;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 13px;
            font-weight: 700;
        }

        .field textarea {
            width: 100%;

            min-height: 175px;

            resize: vertical;

            line-height: 1.6;

            border: none !important;
            outline: none !important;

            border-radius: 13px;

            background: rgba(255,255,255,.92);

            color: var(--text);

            padding: 13px 14px;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 14px;

            transition: .2s ease;
        }

        .field textarea:focus,
        .reply-form textarea:focus {
            outline: none !important;
            background: white;
            border: none !important;
            box-shadow: none !important;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .submit-btn {
            width: 100%;

            min-height: 47px;

            padding: 0 20px;

            border: none !important;
            outline: none !important;

            border-radius: 12px;

            background: var(--dark);

            color: white;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s ease;
        }

        .submit-btn:hover {
            transform: translateY(-1px);
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .form-alert {
            margin-top: 16px;

            padding: 13px 15px;

            border-radius: 12px;

            border: none !important;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 13px;

            line-height: 1.5;
        }

        .form-alert.error {
            background: #fde4e4;
            color: #a62f2f;
        }

        .form-alert.success {
            background: #def1e3;
            color: #2c7446;
        }


        /* =====================================================
           BOARD
        ===================================================== */

        .board {
            min-width: 0;
        }

        .board-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            min-height: 70px;

            padding: 13px 18px;

            margin-bottom: 16px;

            background: rgba(255,255,255,.90);

            border-radius: 15px;

            border: none !important;
            outline: none !important;

            box-shadow: var(--shadow-small);
        }

        .board-info {
            min-width: 230px;
        }

        .board-title {
            color: var(--dark);

            font-size: 22px;
            font-weight: 700;
        }

        .board-subtitle {
            margin-left: 7px;

            color: #917d70;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 15px;
        }


        /* =====================================================
           CATEGORY
        ===================================================== */

        .category-bar {
            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 10px;

            flex-wrap: wrap;
        }

        .category-toggle {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 43px;

            padding: 0 19px;

            border: none !important;
            outline: none !important;

            border-radius: 12px;

            background: #f5e8cb;

            color: #64594b;

            text-decoration: none;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 15px;
            font-weight: 700;

            transition: .2s ease;
        }

        .category-toggle:hover {
            transform: translateY(-1px);
        }


        /* =====================================================
           FEED
        ===================================================== */

        .feed {
            display: grid;

            gap: 15px;

            align-items: start;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .card {
            padding: 14px 16px 16px;

            min-height: 0 !important;
            height: auto !important;

            display: block !important;

            background:
                linear-gradient(
                    135deg,
                    rgba(198,224,220,.88),
                    rgba(226,238,222,.89) 52%,
                    rgba(247,239,207,.84)
                );

            border:
                1px solid
                rgba(116,170,172,.52);

            outline: none !important;

            border-radius: 16px;

            box-shadow:
                0 4px 14px
                rgba(45,53,53,.11);

            transition: .2s ease;
        }

        .card:hover {
            transform: translateY(-1px);
        }

        .card-head {
            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 15px;

            margin: 0 0 6px 0 !important;

            padding: 0 !important;
        }

        .author-block {
            display: flex;

            align-items: center;

            gap: 10px;
        }


        /* =====================================================
           AVATAR
        ===================================================== */

        .avatar {
            width: 42px;
            height: 42px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #83aaa7,
                    #5d858e
                );

            color: #264f56;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 15px;

            font-weight: 800;

            border:
                2px solid
                rgba(255,255,255,.75);
        }


        /* =====================================================
           AUTHOR
        ===================================================== */

        .author {
            color: #302a26;

            font-size: 16px;

            font-weight: 700;
        }

        .meta {
            display: flex;

            align-items: center;

            gap: 6px;

            margin-top: 2px;

            color: #92867c;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;
        }


        /* =====================================================
           CHIP
        ===================================================== */

        .chip {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 31px;

            padding: 0 14px;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #d4ebe0,
                    #b8d8d2
                );

            color: #3e7770;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 13px;

            font-weight: 700;

            white-space: nowrap;

            border: none !important;
        }


        /* =====================================================
           ISI MENFESS
        ===================================================== */

        .message {
            width: 100%;

            margin: 0 0 14px 0 !important;

            padding: 0 !important;

            min-height: 0 !important;
            height: auto !important;

            display: block !important;

            color: #3f3934;

            font-family:
                "Cambria",
                Georgia,
                "Times New Roman",
                serif;

            font-size: 20px;

            font-weight: 500;

            line-height: 1.6;

            white-space: pre-line;

            word-break: break-word;

            text-align: left !important;

            vertical-align: top !important;
        }


        /* =====================================================
           REPLY BOX
        ===================================================== */

        .reply-box {
            padding-top: 0 !important;

            margin-top: 14px !important;

            border: none !important;
            border-top: none !important;
        }


        /* =====================================================
           JUMLAH KOMENTAR
        ===================================================== */

        .reply-count {
            display: block !important;

            width: fit-content !important;

            min-height: 0 !important;

            margin: 0 0 14px 0 !important;

            padding: 0 !important;

            background: transparent !important;

            border: none !important;
            border-radius: 0 !important;

            color: #817970 !important;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif !important;

            font-size: 11px !important;

            font-weight: 700 !important;

            line-height: 1.3 !important;
        }


        /* =====================================================
           COMMENT LIST
        ===================================================== */

        .comment-list {
            display: flex !important;

            flex-direction: column !important;

            gap: 14px !important;

            width: 100% !important;

            margin: 0 0 12px 0 !important;

            padding: 0 !important;
        }


        /* =====================================================
           COMMENT THREAD
        ===================================================== */

        .comment-thread {
            width: 100% !important;

            margin: 0 !important;

            padding: 0 !important;
        }


        /* =====================================================
           COMMENT UTAMA
        ===================================================== */

        .comment {
            display: flex !important;

            align-items: flex-start !important;

            gap: 9px !important;

            width: 100% !important;

            margin: 0 !important;

            padding: 0 !important;

            background: transparent !important;

            border: none !important;

            border-radius: 0 !important;

            outline: none !important;

            box-shadow: none !important;

            transform: none !important;
        }

        .comment:hover {
            transform: none !important;

            background: transparent !important;
        }


        /* =====================================================
           AVATAR COMMENT
        ===================================================== */

        .comment .avatar {
            width: 29px !important;
            height: 29px !important;

            min-width: 29px !important;

            margin: 0 !important;

            padding: 0 !important;

            display: flex !important;

            align-items: center !important;
            justify-content: center !important;

            border-radius: 50% !important;

            border: none !important;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif !important;

            font-size: 10px !important;

            font-weight: 800 !important;
        }


        /* =====================================================
           COMMENT CONTENT
        ===================================================== */

        .comment-content {
            display: block !important;

            flex: 1 !important;

            min-width: 0 !important;

            margin: 0 !important;

            padding: 0 !important;

            background: transparent !important;

            border: none !important;

            box-shadow: none !important;
        }


        /* =====================================================
           AUTHOR COMMENT
        ===================================================== */

        .comment-author {
            display: inline !important;

            margin: 0 !important;

            padding: 0 !important;

            vertical-align: baseline !important;

            line-height: 1.5 !important;
        }


        /* =====================================================
           USERNAME
        ===================================================== */

        .reply-target {
            display: inline !important;

            margin: 0 !important;

            padding: 0 !important;

            color: #302a26 !important;

            background: transparent !important;

            border: none !important;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif !important;

            font-size: 12.5px !important;

            font-weight: 800 !important;

            line-height: 1.45 !important;

            cursor: default !important;
        }


        /* =====================================================
           VERIFIED
        ===================================================== */

        .verified-badge {
            display: inline-flex !important;

            align-items: center !important;
            justify-content: center !important;

            width: 13px !important;
            height: 13px !important;

            min-width: 13px !important;

            margin: 0 2px 0 2px !important;

            padding: 0 !important;

            border-radius: 50% !important;

            color: #fff !important;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif !important;

            font-size: 8px !important;

            font-weight: 900 !important;

            line-height: 1 !important;

            vertical-align: middle !important;
        }

        .verified-talent {
            background:
                linear-gradient(
                    135deg,
                    #6f8cff,
                    #4865d8
                ) !important;

            box-shadow:
                0 2px 5px
                rgba(72,101,216,.20) !important;
        }

        .verified-admin {
            background:
                linear-gradient(
                    135deg,
                    #f1cf68,
                    #c99727
                ) !important;

            box-shadow:
                0 2px 5px
                rgba(201,151,39,.22) !important;
        }


        /* =====================================================
           COMMENT TEXT
        ===================================================== */

        .comment-text {
            display: inline !important;

            width: auto !important;

            max-width: none !important;

            margin: 0 !important;

            padding: 0 !important;

            color: #4a443f !important;

            background: transparent !important;

            border: none !important;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif !important;

            font-size: 12.5px !important;

            font-weight: 400 !important;

            line-height: 1.5 !important;

            white-space: pre-line !important;

            overflow: visible !important;

            text-overflow: clip !important;

            word-break: break-word !important;

            text-align: left !important;
        }


        /* =====================================================
           BALAS
        ===================================================== */

        .comment-content > .comment-reply-button {
            display: block !important;

            margin: 4px 0 0 0 !important;

            padding: 0 !important;

            color: #827970 !important;

            background: transparent !important;

            border: none !important;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif !important;

            font-size: 10px !important;

            font-weight: 700 !important;

            line-height: 1.3 !important;

            cursor: pointer !important;

            transform: none !important;
        }

        .comment-content > .comment-reply-button:hover {
            color: #4f4741 !important;

            transform: none !important;
        }


        /* =====================================================
           TOGGLE BALASAN
        ===================================================== */

        .toggle-replies {
            display: flex !important;

            align-items: center !important;

            gap: 8px !important;

            width: fit-content !important;

            margin: 7px 0 0 38px !important;

            padding: 0 !important;

            background: transparent !important;

            border: none !important;

            outline: none !important;

            color: #817970 !important;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif !important;

            font-size: 10.5px !important;

            font-weight: 700 !important;

            line-height: 1.3 !important;

            cursor: pointer !important;

            appearance: none !important;
        }

        .toggle-replies:hover {
            color: #4e4640 !important;
        }

        .toggle-replies[aria-expanded="true"] {
            color: #62584f !important;
        }

        .reply-line {
            display: block !important;

            width: 22px !important;

            height: 1px !important;

            flex-shrink: 0 !important;

            background: currentColor !important;

            opacity: .55 !important;
        }


        /* =====================================================
           NESTED REPLIES
        ===================================================== */

        .nested-replies {
            display: none !important;

            flex-direction: column !important;

            gap: 12px !important;

            width: auto !important;

            margin: 10px 0 0 38px !important;

            padding: 0 0 0 14px !important;

            border-left:
                1px solid
                rgba(120,110,105,.20) !important;
        }

        .nested-replies.open {
            display: flex !important;
        }


        /* =====================================================
           REPLY
        ===================================================== */

        .comment-reply {
            display: flex !important;

            align-items: flex-start !important;

            gap: 8px !important;

            width: 100% !important;

            margin: 0 !important;

            padding: 0 !important;

            background: transparent !important;

            border: none !important;

            box-shadow: none !important;
        }

        .comment-reply .avatar {
            width: 25px !important;
            height: 25px !important;

            min-width: 25px !important;

            font-size: 9px !important;
        }

        .comment-reply .reply-target {
            font-size: 11.5px !important;
        }

        .comment-reply .comment-text {
            font-size: 12px !important;

            line-height: 1.5 !important;
        }


        /* =====================================================
           FORM KOMENTAR
        ===================================================== */

        .reply-form {
            display: flex !important;

            align-items: center !important;

            gap: 8px !important;

            width: 100% !important;

            margin: 14px 0 0 0 !important;

            padding: 0 !important;

            background: transparent !important;

            border: none !important;
        }

        .reply-form textarea {
            flex: 1 !important;

            min-width: 0 !important;

            min-height: 40px !important;

            max-height: 120px !important;

            margin: 0 !important;

            padding: 10px 13px !important;

            resize: none !important;

            border: none !important;

            outline: none !important;

            border-radius: 18px !important;

            background:
                rgba(255,255,255,.70) !important;

            color: var(--text) !important;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif !important;

            font-size: 12px !important;

            line-height: 1.4 !important;

            box-shadow: none !important;
        }

        .reply-form textarea:focus {
            border: none !important;

            outline: none !important;

            box-shadow: none !important;

            background:
                rgba(255,255,255,.90) !important;
        }

        .reply-form textarea.replying {
            background:
                rgba(255,255,255,.95) !important;
        }


        /* =====================================================
           SEND
        ===================================================== */

        .reply-form > button {
            width: 36px !important;

            height: 36px !important;

            min-width: 36px !important;

            min-height: 36px !important;

            padding: 0 !important;

            display: flex !important;

            align-items: center !important;
            justify-content: center !important;

            border: none !important;

            border-radius: 50% !important;

            cursor: pointer !important;

            transition:
                transform .18s ease,
                opacity .18s ease !important;
        }

        .reply-form > button:hover {
            transform:
                translateX(2px) !important;

            opacity: .9 !important;
        }

        .send-icon {
            width: 17px;
            height: 17px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;

            stroke-linecap: round;
            stroke-linejoin: round;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {
            min-height: 160px;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 30px;

            border: none !important;
            outline: none !important;

            border-radius: 18px;

            background: rgba(255,255,255,.62);

            color: #8c837b;

            text-align: center;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;
        }


        /* =====================================================
           LOVE
        ===================================================== */

        body.theme-love .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(217,119,91,.94),
                    rgba(239,157,122,.94) 45%,
                    rgba(248,208,170,.94)
                ) !important;
        }

        body.theme-love .page-title {
            color: #7d463d !important;
        }

        body.theme-love .back-button {
            color: #8f5144 !important;
        }

        body.theme-love .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(255,232,215,.88),
                    rgba(255,242,226,.88),
                    rgba(248,224,208,.86)
                ) !important;
        }

        body.theme-love .intro p {
            color: #89564a !important;
        }

        body.theme-love .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(242,170,137,.86),
                    rgba(250,205,175,.84) 46%,
                    rgba(255,236,213,.90)
                ) !important;
        }

        body.theme-love .info-box,
        body.theme-love .composer-card,
        body.theme-love .board-header {
            background: rgba(255,249,241,.84) !important;
        }

        body.theme-love .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(255,222,201,.88),
                    rgba(255,239,222,.90) 55%,
                    rgba(250,225,210,.86)
                ) !important;
        }

        body.theme-love .submit-btn {
            background:
                linear-gradient(
                    135deg,
                    #c96d5d,
                    #a95751
                ) !important;
        }

        body.theme-love .reply-form > button {
            background:
                linear-gradient(
                    135deg,
                    #df9175,
                    #bd685d
                ) !important;
        }

        body.theme-love .category-toggle.active {
            background:
                linear-gradient(
                    135deg,
                    #d67b68,
                    #b75f58
                ) !important;

            color: white !important;
        }

        body.theme-love .chip {
            background:
                linear-gradient(
                    135deg,
                    #ffd8c5,
                    #f5bfa8
                ) !important;

            color: #a64f4b !important;
        }

        body.theme-love .avatar {
            background:
                linear-gradient(
                    135deg,
                    #e7a083,
                    #c76e63
                ) !important;

            color: #633d38 !important;
        }

        body.theme-love .comment,
        body.theme-love .comment:hover {
            background: transparent !important;
        }

        body.theme-love .reply-target {
            color: #5e403a !important;
        }

        body.theme-love .comment-text {
            color: #654d47 !important;
        }


        /* =====================================================
           SAD
        ===================================================== */

        body.theme-sad .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(225,190,120,.94),
                    rgba(244,210,145,.94) 35%,
                    rgba(248,225,180,.94) 65%,
                    rgba(225,220,190,.94)
                ) !important;
        }

        body.theme-sad .page-title {
            color: #6f6048 !important;
        }

        body.theme-sad .back-button {
            color: #75654b !important;
        }

        body.theme-sad .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(250,238,205,.88),
                    rgba(242,235,210,.88),
                    rgba(225,230,215,.86)
                ) !important;
        }

        body.theme-sad .intro p {
            color: #766a52 !important;
        }

        body.theme-sad .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(238,215,160,.88),
                    rgba(245,230,190,.86) 45%,
                    rgba(222,232,218,.88)
                ) !important;
        }

        body.theme-sad .info-box,
        body.theme-sad .composer-card,
        body.theme-sad .board-header {
            background: rgba(248,246,233,.86) !important;
        }

        body.theme-sad .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(248,238,210,.88),
                    rgba(240,235,215,.88) 50%,
                    rgba(220,230,220,.85)
                ) !important;
        }

        body.theme-sad .submit-btn {
            background:
                linear-gradient(
                    135deg,
                    #a68f62,
                    #827b62
                ) !important;
        }

        body.theme-sad .reply-form > button {
            background:
                linear-gradient(
                    135deg,
                    #8ca09a,
                    #6f8780
                ) !important;
        }

        body.theme-sad .category-toggle.active {
            background:
                linear-gradient(
                    135deg,
                    #c8ad72,
                    #a99b70
                ) !important;

            color: white !important;
        }

        body.theme-sad .chip {
            background:
                linear-gradient(
                    135deg,
                    #e5d19c,
                    #d4c89f
                ) !important;

            color: #6f6045 !important;
        }

        body.theme-sad .avatar {
            background:
                linear-gradient(
                    135deg,
                    #c9b47d,
                    #9aa89a
                ) !important;

            color: #4f5548 !important;
        }

        body.theme-sad .comment,
        body.theme-sad .comment:hover {
            background: transparent !important;
        }

        body.theme-sad .reply-target {
            color: #50483e !important;
        }

        body.theme-sad .comment-text {
            color: #625c52 !important;
        }


        /* =====================================================
           HORROR — SESUAI SCREENSHOT
        ===================================================== */

        body.theme-horror .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(43,27,23,.98),
                    rgba(77,40,31,.97) 38%,
                    rgba(126,60,40,.95) 68%,
                    rgba(179,108,61,.93)
                ) !important;
        }

        body.theme-horror .page-title {
            color: #f2d9ae !important;
        }

        body.theme-horror .back-button {
            color: #efd5aa !important;
        }


        /* =====================================================
           HORROR INTRO
        ===================================================== */

        body.theme-horror .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(57,36,30,.93),
                    rgba(80,48,36,.90) 48%,
                    rgba(108,65,43,.87)
                ) !important;

            box-shadow:
                0 5px 16px
                rgba(39,23,18,.18) !important;
        }

        body.theme-horror .intro p {
            color: #ead4b2 !important;
        }


        /* =====================================================
           HORROR PANEL KIRI
        ===================================================== */

        body.theme-horror .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(52,31,27,.97),
                    rgba(78,41,32,.95) 46%,
                    rgba(119,68,45,.92)
                ) !important;

            box-shadow:
                0 6px 18px
                rgba(38,23,18,.22) !important;
        }

        body.theme-horror .info-box,
        body.theme-horror .composer-card {
            background:
                rgba(247,229,197,.90) !important;
        }

        body.theme-horror .info-box h3,
        body.theme-horror .composer-title {
            color: #3d2b23 !important;
        }

        body.theme-horror .info-box li {
            color: #69584c !important;
        }

        body.theme-horror .field label {
            color: #786658 !important;
        }

        body.theme-horror .field textarea {
            background:
                rgba(255,249,237,.95) !important;

            color: #4a3930 !important;
        }


        /* =====================================================
           HORROR BOARD
        ===================================================== */

        body.theme-horror .board-header {
            background:
                rgba(248,232,202,.92) !important;

            box-shadow:
                0 5px 15px
                rgba(50,31,23,.14) !important;
        }

        body.theme-horror .board-title {
            color: #3e2c25 !important;
        }

        body.theme-horror .board-subtitle {
            color: #967a67 !important;
        }


        /* =====================================================
           HORROR CATEGORY
        ===================================================== */

        body.theme-horror .category-toggle {
            background:
                #f5e7c9 !important;

            color:
                #655448 !important;
        }

        body.theme-horror .category-toggle:hover {
            background:
                #efddba !important;
        }

        body.theme-horror .category-toggle.active {
            background:
                linear-gradient(
                    135deg,
                    #a83d31,
                    #71251f
                ) !important;

            color:
                #fff3df !important;

            box-shadow:
                0 3px 8px
                rgba(112,36,29,.24) !important;
        }


        /* =====================================================
           HORROR CARD
        ===================================================== */

        body.theme-horror .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(72,45,36,.94),
                    rgba(104,61,44,.92) 48%,
                    rgba(153,89,53,.86)
                ) !important;

            border:
                1px solid
                rgba(174,112,69,.18) !important;

            box-shadow:
                0 5px 16px
                rgba(43,25,19,.22) !important;
        }

        body.theme-horror .card:hover {
            transform:
                translateY(-1px) !important;
        }


        /* =====================================================
           HORROR HEADER CARD
        ===================================================== */

        body.theme-horror .card .author {
            color:
                #fff0d3 !important;
        }

        body.theme-horror .card .meta {
            color:
                #d9bfa0 !important;
        }


        /* =====================================================
           HORROR AVATAR
        ===================================================== */

        body.theme-horror .avatar {
            background:
                linear-gradient(
                    135deg,
                    #d1814e,
                    #95402f
                ) !important;

            color:
                #351d17 !important;
        }


        /* =====================================================
           HORROR CHIP
        ===================================================== */

        body.theme-horror .chip {
            background:
                linear-gradient(
                    135deg,
                    #c05238,
                    #8b3029
                ) !important;

            color:
                #ffe8ca !important;

            box-shadow:
                0 2px 7px
                rgba(111,39,30,.18) !important;
        }


        /* =====================================================
           HORROR MESSAGE
        ===================================================== */

        body.theme-horror .card .message {
            color:
                #fff0d2 !important;
        }


        /* =====================================================
           HORROR COMMENTS
        ===================================================== */

        body.theme-horror .reply-count {
            color:
                #d8bda0 !important;
        }

        body.theme-horror .comment,
        body.theme-horror .comment:hover {
            background:
                transparent !important;

            box-shadow:
                none !important;
        }

        body.theme-horror .reply-target {
            color:
                #fff0d2 !important;
        }

        body.theme-horror .comment-text {
            color:
                #ead2b2 !important;
        }

        body.theme-horror .comment-reply-button,
        body.theme-horror .toggle-replies {
            color:
                #ddc4a1 !important;
        }

        body.theme-horror .comment-reply-button:hover,
        body.theme-horror .toggle-replies:hover {
            color:
                #fff0d2 !important;
        }

        body.theme-horror .toggle-replies[aria-expanded="true"] {
            color:
                #f2d9b0 !important;
        }

        body.theme-horror .reply-line {
            color:
                #c6a98b !important;
        }

        body.theme-horror .nested-replies {
            border-left:
                1px solid
                rgba(220,185,145,.24) !important;
        }


        /* =====================================================
           HORROR FORM KOMENTAR
        ===================================================== */

        body.theme-horror .reply-form textarea {
            background:
                rgba(255,246,227,.74) !important;

            color:
                #4b392f !important;
        }

        body.theme-horror .reply-form textarea:focus {
            background:
                rgba(255,249,237,.95) !important;
        }


        /* =====================================================
           HORROR BUTTON
        ===================================================== */

        body.theme-horror .submit-btn {
            background:
                linear-gradient(
                    135deg,
                    #9f352c,
                    #63211f
                ) !important;

            color:
                #fff3df !important;
        }

        body.theme-horror .reply-form > button {
            background:
                linear-gradient(
                    135deg,
                    #b64e35,
                    #792d28
                ) !important;

            color:
                #fff4df !important;
        }


        /* =====================================================
           RANDOM
        ===================================================== */

        body.theme-random .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(122,165,169,.95),
                    rgba(153,190,184,.94) 45%,
                    rgba(196,211,190,.93)
                ) !important;
        }

        body.theme-random .page-title {
            color: #345d62 !important;
        }

        body.theme-random .back-button {
            color: #3f6c71 !important;
        }

        body.theme-random .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(220,235,230,.88),
                    rgba(233,241,228,.88),
                    rgba(245,238,210,.84)
                ) !important;
        }

        body.theme-random .intro p {
            color: #496b68 !important;
        }

        body.theme-random .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(144,188,183,.87),
                    rgba(181,210,194,.84) 48%,
                    rgba(235,225,185,.88)
                ) !important;
        }

        body.theme-random .info-box,
        body.theme-random .composer-card,
        body.theme-random .board-header {
            background: rgba(248,250,240,.84) !important;
        }

        body.theme-random .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(198,224,220,.88),
                    rgba(226,238,222,.89) 52%,
                    rgba(247,239,207,.84)
                ) !important;
        }

        body.theme-random .submit-btn {
            background:
                linear-gradient(
                    135deg,
                    #548d94,
                    #426f78
                ) !important;
        }

        body.theme-random .reply-form > button {
            background:
                linear-gradient(
                    135deg,
                    #7da7a0,
                    #5c8988
                ) !important;
        }

        body.theme-random .category-toggle.active {
            background:
                linear-gradient(
                    135deg,
                    #66979b,
                    #4d7c84
                ) !important;

            color: white !important;
        }

        body.theme-random .chip {
            background:
                linear-gradient(
                    135deg,
                    #d4ebe0,
                    #b8d8d2
                ) !important;

            color: #3e7770 !important;
        }

        body.theme-random .avatar {
            background:
                linear-gradient(
                    135deg,
                    #83aaa7,
                    #5d858e
                ) !important;

            color: #264f56 !important;
        }

        body.theme-random .comment,
        body.theme-random .comment:hover {
            background: transparent !important;
        }

        body.theme-random .reply-target {
            color: #3f3935 !important;
        }

        body.theme-random .comment-text {
            color: #4a4540 !important;
        }


        /* =====================================================
           REMOVE OLD COMMENT RECTANGLE
        ===================================================== */

        .comment,
        .comment:hover,
        .comment-content,
        .comment-author,
        .comment-text,
        .comment-reply {
            box-shadow: none !important;

            border-top: none !important;
            border-right: none !important;
            border-bottom: none !important;
            border-left: none !important;
        }


        /* =====================================================
           NO BORDER
        ===================================================== */

        header,
        div,
        section,
        article,
        aside,
        form,
        textarea,
        input,
        button,
        a {
            border-color: transparent !important;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1050px) {

            .content-grid {
                grid-template-columns:
                    330px
                    minmax(0,1fr);
            }

            .board-header {
                flex-direction: column;

                align-items: flex-start;
            }

            .category-bar {
                justify-content: flex-start;
            }
        }


        @media (max-width: 760px) {

            .top-header {
                min-height: 64px;

                padding: 0 15px;
            }

            .page-title {
                font-size: 20px;
            }

            .page {
                width: calc(100% - 18px);

                margin: 14px auto 30px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .composer-panel {
                position: static;

                min-height: auto;

                padding: 16px;
            }

            .board-header {
                padding: 14px;
            }

            .category-toggle {
                min-height: 39px;

                padding: 0 15px;

                font-size: 13px;
            }

            .message {
                margin: 0 0 14px 0 !important;

                padding: 0 !important;

                font-size: 20px !important;

                font-weight: 500 !important;

                line-height: 1.6 !important;

                text-align: left !important;
            }

            .comment-text {
                font-size: 14px !important;
            }
        }


        @media (max-width: 430px) {

            .page-title {
                font-size: 16px;
            }

            .category-bar {
                width: 100%;
            }

            .category-toggle {
                flex: 1;

                min-height: 38px;

                font-size: 12px;
            }

            .reply-form > button {
                width: 38px !important;
            }

            .message {
                margin: 0 0 14px 0 !important;

                padding: 0 !important;

                font-size: 18px !important;

                text-align: left !important;
            }

            .comment-text {
                font-size: 14px !important;
            }

            .toggle-replies {
                margin-left: 36px !important;
            }

            .nested-replies {
                margin-left: 36px !important;

                padding-left: 12px !important;
            }
        }
/* =====================================================
   TOGGLE KOMENTAR UTAMA (TAMPILKAN / SEMBUNYIKAN SEMUA)
   ===================================================== */

.comment-visibility-toggle {
    display: flex !important;

    align-items: center !important;

    gap: 8px !important;

    width: fit-content !important;

    margin: 2px 0 12px 0 !important;

    padding: 0 !important;

    background: transparent !important;

    border: none !important;

    outline: none !important;

    color: #817970 !important;

    font-family:
        "Segoe UI",
        Arial,
        sans-serif !important;

    font-size: 11px !important;

    font-weight: 700 !important;

    line-height: 1.3 !important;

    cursor: pointer !important;

    appearance: none !important;
}

.comment-visibility-toggle:hover {
    color: #4e4640 !important;
}

.comment-visibility-toggle[aria-expanded="true"] {
    color: #62584f !important;
}

.comment-visibility-line {
    display: block !important;

    width: 22px !important;

    height: 1px !important;

    flex-shrink: 0 !important;

    background: currentColor !important;

    opacity: .55 !important;
}

.comments-content {
    display: none !important;
}

.comments-content.open {
    display: block !important;
}


/* HORROR */

body.theme-horror .comment-visibility-toggle {
    color: #ddc4a1 !important;
}

body.theme-horror .comment-visibility-toggle:hover {
    color: #fff0d2 !important;
}

body.theme-horror .comment-visibility-toggle[aria-expanded="true"] {
    color: #f2d9b0 !important;
}

body.theme-horror .comment-visibility-line {
    color: #c6a98b !important;
}
    </style>
</head>


@php

    $currentCategory = strtolower(
        trim($selectedCategory ?? 'random')
    );

    if ($currentCategory === 'horor') {

        $currentCategory = 'horror';

    } elseif ($currentCategory === 'cinta') {

        $currentCategory = 'love';

    } elseif ($currentCategory === 'sedih') {

        $currentCategory = 'sad';

    } elseif ($currentCategory === 'campuran') {

        $currentCategory = 'random';

    }


    if ($currentCategory === 'horror') {

        $theme = 'theme-horror';

    } elseif ($currentCategory === 'love') {

        $theme = 'theme-love';

    } elseif ($currentCategory === 'sad') {

        $theme = 'theme-sad';

    } else {

        $theme = 'theme-random';

        $currentCategory = 'random';

    }

@endphp


<body class="{{ $theme }}">


@include('whisperly.navbar')


<header class="top-header">

    <h1 class="page-title">
        Ruang Pengaduan
    </h1>

</header>


<div class="page">


    <!-- =====================================================
         INTRO
    ====================================================== -->

    <div class="intro">

        <p>
            Sampaikan cerita, harapan, atau keluhanmu dengan aman dan anonim.
        </p>

    </div>


    <div class="content-grid">


        <!-- =================================================
             FORM MENFESS
        ================================================== -->

        <aside class="composer-panel">


            <div class="info-box">

                <h3>
                    Sebelum mulai cerita, baca ini dulu ya
                </h3>


                <ul>

                    <li>
                        Cerita akan dibagikan ke publik setelah diverifikasi.
                    </li>

                    <li>
                        Identitas kamu tetap aman dan anonim.
                    </li>

                    <li>
                        Admin akan mengecek cerita terlebih dahulu.
                    </li>

                    <li>
                        Dengan mengirim cerita, kamu setuju dengan ketentuan yang berlaku.
                    </li>

                </ul>

            </div>


            <div class="composer-card">


                <h2 class="composer-title">

                    @if ($currentCategory === 'love')

                        Apa cerita cinta yang sedang kamu alami?

                    @elseif ($currentCategory === 'horror')

                        Pernah mengalami kejadian menyeramkan?

                    @elseif ($currentCategory === 'sad')

                        Apa yang sedang membuatmu merasa sedih?

                    @else

                        Cerita apa saja yang ingin kamu bagikan?

                    @endif

                </h2>


                <form
                    method="POST"
                    action="{{ route('pengaduan.store') }}"
                >

                    @csrf


                    <input
                        type="hidden"
                        name="id_kategori"
                        value="{{ $activeCategory->id ?? '' }}"
                    >


                    <div class="field">

                        <label for="isi_pesan">

                            @if ($currentCategory === 'love')

                                Cerita cinta

                            @elseif ($currentCategory === 'horror')

                                Cerita horror

                            @elseif ($currentCategory === 'sad')

                                Cerita sedih

                            @else

                                Cerita random

                            @endif

                        </label>


                        <textarea
                            id="isi_pesan"
                            name="isi_pesan"
                            required
                            placeholder="@if ($currentCategory === 'love')
Ceritakan kisah cinta yang sedang kamu alami...
@elseif ($currentCategory === 'horror')
Ceritakan kejadian menyeramkan yang pernah kamu alami...
@elseif ($currentCategory === 'sad')
Ceritakan hal yang sedang membuatmu sedih...
@else
Ceritakan apa saja yang ingin kamu sampaikan...
@endif"
                        >{{ old('isi_pesan') }}</textarea>

                    </div>


                    <button
                        type="submit"
                        class="submit-btn"
                    >
                        Kirim Menfess
                    </button>


                </form>


                @if ($errors->any())

                    <div class="form-alert error">

                        @foreach ($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                @endif


                @if (session('message_success'))

                    <div class="form-alert success">

                        {{ session('message_success') }}

                    </div>

                @endif


            </div>


        </aside>


        <!-- =================================================
             BOARD
        ================================================== -->

        <main class="board">


            <div class="board-header">


                <div class="board-info">

                    <span class="board-title">
                        Broadcast Publik
                    </span>


                    <span class="board-subtitle">
                        Semua cerita di sini sudah diverifikasi admin.
                    </span>

                </div>


                <div class="category-bar">


                    <a
                        class="category-toggle {{ $currentCategory === 'random' ? 'active' : '' }}"
                        href="{{ route('pengaduan', ['kategori' => 'random']) }}"
                    >
                        Random
                    </a>


                    <a
                        class="category-toggle {{ $currentCategory === 'love' ? 'active' : '' }}"
                        href="{{ route('pengaduan', ['kategori' => 'love']) }}"
                    >
                        Love
                    </a>


                    <a
                        class="category-toggle {{ $currentCategory === 'horror' ? 'active' : '' }}"
                        href="{{ route('pengaduan', ['kategori' => 'horror']) }}"
                    >
                        Horror
                    </a>


                    <a
                        class="category-toggle {{ $currentCategory === 'sad' ? 'active' : '' }}"
                        href="{{ route('pengaduan', ['kategori' => 'sad']) }}"
                    >
                        Sad
                    </a>


                </div>


            </div>


            <!-- =================================================
                 LIST MENFESS
            ================================================== -->

            <section class="feed">


                @forelse ($items as $item)


                    @php

                        $tone = strtolower(
                            trim(
                                $item->kategori?->jenis_kategori ?? 'random'
                            )
                        );

                        if ($tone === 'campuran') {
                            $tone = 'random';
                        }

                        if ($tone === 'cinta') {
                            $tone = 'love';
                        }

                        if ($tone === 'horor') {
                            $tone = 'horror';
                        }

                        if ($tone === 'sedih') {
                            $tone = 'sad';
                        }


                        $anonymousCode = strtoupper(
                            substr(
                                hash(
                                    'sha256',
                                    'whisperly-' . $item->id
                                ),
                                0,
                                4
                            )
                        );


                        $anonymousName =
                            'Anonim-' . $anonymousCode;

                    @endphp


                    <article
                        class="card"
                        data-tone="{{ $tone }}"
                    >


                        <!-- =================================================
                             HEADER MENFESS
                        ================================================== -->

                        <div class="card-head">


                            <div class="author-block">


                                <div class="avatar">
                                    A
                                </div>


                                <div>

                                    <div class="author">
                                        {{ $anonymousName }}
                                    </div>


                                    <div class="meta">

                                        <span>
                                            {{
                                                $item->created_at
                                                ?->translatedFormat('d M, H:i')
                                                ?? $item->created_at
                                            }}
                                        </span>

                                        <span>
                                            •
                                        </span>

                                        <span>
                                            Anonim
                                        </span>

                                    </div>

                                </div>


                            </div>


                            <span class="chip">

                                @if ($tone === 'horror')

                                    Horror

                                @elseif ($tone === 'love')

                                    Love

                                @elseif ($tone === 'sad')

                                    Sad

                                @elseif ($tone === 'random')

                                    Random

                                @else

                                    {{ ucfirst($tone) }}

                                @endif

                            </span>


                        </div>


                        <!-- =================================================
                             ISI MENFESS
                        ================================================== -->

                        <div class="message">
                            {{ $item->isi_pesan }}
                        </div>


                        <!-- =================================================
                             KOMENTAR / BALASAN
                        ================================================== -->

                        <div class="reply-box">


                            @php

                                $allComments = $item->comments
                                    ->sortBy('created_at');

                                $mainComments = $allComments
                                    ->filter(function ($comment) {

                                        return empty(
                                            $comment->reply_to
                                        );

                                    });

                                $totalComments =
                                    $allComments->count();

                                $commentsPanelId =
                                    'comments-panel-' . $item->id;

                            @endphp


                            @if ($totalComments > 0)


                                <!-- =================================================
                                     TOMBOL TAMPILKAN / SEMBUNYIKAN KOMENTAR
                                ================================================== -->

                                <button
                                    type="button"
                                    class="comment-visibility-toggle"
                                    data-target="{{ $commentsPanelId }}"
                                    data-count="{{ $totalComments }}"
                                    aria-expanded="false"
                                >

                                    <span class="comment-visibility-line"></span>

                                    <span class="comment-visibility-text">
                                        Tampilkan {{ $totalComments }} komentar
                                    </span>

                                </button>


                                <!-- =================================================
                                     PANEL KOMENTAR (TERSEMBUNYI DEFAULT)
                                ================================================== -->

                                <div
                                    class="comments-content"
                                    id="{{ $commentsPanelId }}"
                                >


                                    <div class="comment-list">


                                        @foreach ($mainComments as $comment)


                                            @php

                                                $commentUser =
                                                    $comment->pengguna;

                                                $commentUsername =
                                                    $commentUser?->username
                                                    ?? 'Pengguna';

                                                $commentRole =
                                                    strtolower(
                                                        trim(
                                                            (string) (
                                                                $commentUser?->role
                                                                ?? ''
                                                            )
                                                        )
                                                    );

                                                $commentInitial =
                                                    strtoupper(
                                                        mb_substr(
                                                            $commentUsername,
                                                            0,
                                                            1
                                                        )
                                                    );

                                                $isTalent =
                                                    $commentRole === 'talent';

                                                $isAdmin =
                                                    $commentRole === 'admin';


                                                $replies =
                                                    $allComments->filter(
                                                        function ($reply) use ($comment) {

                                                            return
                                                                (string)
                                                                $reply->reply_to
                                                                ===
                                                                (string)
                                                                $comment->id;

                                                        }
                                                    );


                                                $replyCount =
                                                    $replies->count();


                                                $replyContainerId =
                                                    'replies-'
                                                    . $item->id
                                                    . '-'
                                                    . $comment->id;

                                            @endphp


                                            <div class="comment-thread">


                                                <!-- =====================================
                                                     KOMENTAR UTAMA
                                                ====================================== -->

                                                <div class="comment">


                                                    <div class="avatar">
                                                        {{ $commentInitial }}
                                                    </div>


                                                    <div class="comment-content">


                                                        <div class="comment-author">


                                                            <span class="reply-target">
                                                                {{ $commentUsername }}
                                                            </span>


                                                            @if ($isTalent)

                                                                <span
                                                                    class="verified-badge verified-talent"
                                                                    title="Talent Terverifikasi"
                                                                >
                                                                    ✓
                                                                </span>

                                                            @elseif ($isAdmin)

                                                                <span
                                                                    class="verified-badge verified-admin"
                                                                    title="Admin Whisperly"
                                                                >
                                                                    ✓
                                                                </span>

                                                            @endif


                                                            <span class="comment-text">
                                                                {{ $comment->komentar }}
                                                            </span>


                                                        </div>


                                                        <button
                                                            type="button"
                                                            class="comment-reply-button"
                                                            data-comment-id="{{ $comment->id }}"
                                                            data-username="{{ $commentUsername }}"
                                                        >
                                                            Balas
                                                        </button>


                                                    </div>


                                                </div>


                                                <!-- =====================================
                                                     TOGGLE BALASAN
                                                ====================================== -->

                                                @if ($replyCount > 0)


                                                    <button
                                                        type="button"
                                                        class="toggle-replies"
                                                        data-target="{{ $replyContainerId }}"
                                                        data-count="{{ $replyCount }}"
                                                        aria-expanded="false"
                                                    >

                                                        <span class="reply-line"></span>

                                                        <span class="toggle-replies-text">
                                                            Lihat {{ $replyCount }} balasan
                                                        </span>

                                                    </button>


                                                    <!-- =====================================
                                                         NESTED REPLIES
                                                    ====================================== -->

                                                    <div
                                                        class="nested-replies"
                                                        id="{{ $replyContainerId }}"
                                                    >


                                                        @foreach ($replies as $reply)


                                                            @php

                                                                $replyUser =
                                                                    $reply->pengguna;

                                                                $replyUsername =
                                                                    $replyUser?->username
                                                                    ?? 'Pengguna';

                                                                $replyRole =
                                                                    strtolower(
                                                                        trim(
                                                                            (string) (
                                                                                $replyUser?->role
                                                                                ?? ''
                                                                            )
                                                                        )
                                                                    );

                                                                $replyInitial =
                                                                    strtoupper(
                                                                        mb_substr(
                                                                            $replyUsername,
                                                                            0,
                                                                            1
                                                                        )
                                                                    );

                                                                $replyIsTalent =
                                                                    $replyRole === 'talent';

                                                                $replyIsAdmin =
                                                                    $replyRole === 'admin';

                                                            @endphp


                                                            <div class="comment comment-reply">


                                                                <div class="avatar">
                                                                    {{ $replyInitial }}
                                                                </div>


                                                                <div class="comment-content">


                                                                    <div class="comment-author">


                                                                        <span class="reply-target">
                                                                            {{ $replyUsername }}
                                                                        </span>


                                                                        @if ($replyIsTalent)

                                                                            <span
                                                                                class="verified-badge verified-talent"
                                                                                title="Talent Terverifikasi"
                                                                            >
                                                                                ✓
                                                                            </span>

                                                                        @elseif ($replyIsAdmin)

                                                                            <span
                                                                                class="verified-badge verified-admin"
                                                                                title="Admin Whisperly"
                                                                            >
                                                                                ✓
                                                                            </span>

                                                                        @endif


                                                                        <span class="comment-text">
                                                                            {{ $reply->komentar }}
                                                                        </span>


                                                                    </div>


                                                                    <button
                                                                        type="button"
                                                                        class="comment-reply-button"
                                                                        data-comment-id="{{ $reply->id }}"
                                                                        data-username="{{ $replyUsername }}"
                                                                    >
                                                                        Balas
                                                                    </button>


                                                                </div>


                                                            </div>


                                                        @endforeach


                                                    </div>


                                                @endif


                                            </div>


                                        @endforeach


                                    </div>


                                </div>


                            @endif


                            <!-- =================================================
                                 FORM KOMENTAR
                            ================================================== -->

                            <form
                                method="POST"
                                action="{{ route('pengaduan.comments.store', $item->id) }}"
                                class="reply-form"
                            >

                                @csrf


                                <input
                                    type="hidden"
                                    name="reply_to"
                                    class="reply-to-input"
                                    value=""
                                >


                                <textarea
                                    name="komentar"
                                    class="comment-input"
                                    placeholder="Tulis tanggapanmu..."
                                    required
                                ></textarea>


                                <button
                                    type="submit"
                                    aria-label="Kirim balasan"
                                    title="Kirim balasan"
                                >

                                    <svg
                                        class="send-icon"
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >

                                        <path d="M22 2L11 13" />

                                        <path
                                            d="M22 2L15 22L11 13L2 9L22 2Z"
                                        />

                                    </svg>

                                </button>


                            </form>


                        </div>


                    </article>


                @empty


                    <div class="empty">

                        Belum ada cerita yang diterima untuk kategori ini.

                    </div>


                @endforelse


            </section>


        </main>


    </div>


</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =========================================================
       TAMPILKAN / SEMBUNYIKAN SEMUA KOMENTAR MENFESS
    ========================================================= */

    document.addEventListener('click', function (e) {

        const visButton =
            e.target.closest('.comment-visibility-toggle');


        if (!visButton) {
            return;
        }


        e.preventDefault();


        const targetId =
            visButton.getAttribute(
                'data-target'
            );


        if (!targetId) {
            return;
        }


        const target =
            document.getElementById(
                targetId
            );


        if (!target) {

            console.warn(
                'Panel komentar tidak ditemukan:',
                targetId
            );

            return;
        }


        const isOpen =
            target.classList.contains(
                'open'
            );


        const text =
            visButton.querySelector(
                '.comment-visibility-text'
            );


        const count =
            visButton.getAttribute(
                'data-count'
            ) || '0';


        if (isOpen) {


            /* ==============================
               SEMBUNYIKAN KOMENTAR
            ============================== */

            target.classList.remove(
                'open'
            );


            visButton.setAttribute(
                'aria-expanded',
                'false'
            );


            if (text) {

                text.textContent =
                    'Tampilkan ' +
                    count +
                    ' komentar';

            }


        } else {


            /* ==============================
               TAMPILKAN KOMENTAR
            ============================== */

            target.classList.add(
                'open'
            );


            visButton.setAttribute(
                'aria-expanded',
                'true'
            );


            if (text) {

                text.textContent =
                    'Sembunyikan komentar';

            }

        }

    });


    /* =========================================================
       LIHAT / SEMBUNYIKAN BALASAN
    ========================================================= */

    document.addEventListener('click', function (e) {

        const toggleButton =
            e.target.closest('.toggle-replies');


        if (!toggleButton) {
            return;
        }


        e.preventDefault();


        const targetId =
            toggleButton.getAttribute(
                'data-target'
            );


        if (!targetId) {
            return;
        }


        const target =
            document.getElementById(
                targetId
            );


        if (!target) {

            console.warn(
                'Target balasan tidak ditemukan:',
                targetId
            );

            return;
        }


        const isOpen =
            target.classList.contains(
                'open'
            );


        const text =
            toggleButton.querySelector(
                '.toggle-replies-text'
            );


        const count =
            toggleButton.getAttribute(
                'data-count'
            ) || '0';


        if (isOpen) {


            /* ==============================
               SEMBUNYIKAN BALASAN
            ============================== */

            target.classList.remove(
                'open'
            );


            toggleButton.setAttribute(
                'aria-expanded',
                'false'
            );


            if (text) {

                text.textContent =
                    'Lihat ' +
                    count +
                    ' balasan';

            }


        } else {


            /* ==============================
               TAMPILKAN BALASAN
            ============================== */

            target.classList.add(
                'open'
            );


            toggleButton.setAttribute(
                'aria-expanded',
                'true'
            );


            if (text) {

                text.textContent =
                    'Sembunyikan balasan';

            }

        }

    });


    /* =========================================================
       TOMBOL BALAS KOMENTAR
    ========================================================= */

    document.addEventListener('click', function (e) {

        const button =
            e.target.closest(
                '.comment-reply-button'
            );


        if (!button) {
            return;
        }


        e.preventDefault();


        const commentId =
            button.getAttribute(
                'data-comment-id'
            );


        const username =
            button.getAttribute(
                'data-username'
            ) ||
            'Pengguna';


        const card =
            button.closest(
                '.card'
            );


        if (!card) {
            return;
        }


        const form =
            card.querySelector(
                '.reply-form'
            );


        if (!form) {
            return;
        }


        const textarea =
            form.querySelector(
                '.comment-input'
            );


        const replyInput =
            form.querySelector(
                '.reply-to-input'
            );


        if (!textarea || !replyInput) {
            return;
        }


        /* ==============================
           BUKA PANEL KOMENTAR JIKA MASIH TERSEMBUNYI
           (misal user klik "Balas" pada balasan
           yang induk komentarnya lagi ketutup)
        ============================== */

        const commentsPanel =
            card.querySelector(
                '.comments-content'
            );


        if (commentsPanel && !commentsPanel.classList.contains('open')) {

            commentsPanel.classList.add('open');


            const visButton =
                card.querySelector(
                    '.comment-visibility-toggle'
                );


            if (visButton) {

                visButton.setAttribute(
                    'aria-expanded',
                    'true'
                );


                const visText =
                    visButton.querySelector(
                        '.comment-visibility-text'
                    );


                if (visText) {

                    visText.textContent =
                        'Sembunyikan komentar';

                }

            }

        }


        /* ==============================
           SIMPAN ID KOMENTAR
        ============================== */

        replyInput.value =
            commentId || '';


        /* ==============================
           MASUKKAN @USERNAME
        ============================== */

        const mention =
            '@' +
            username +
            ' ';


        textarea.value =
            mention;


        /* ==============================
           TANDA SEDANG MEMBALAS
        ============================== */

        textarea.classList.add(
            'replying'
        );


        /* ==============================
           FOKUS TEXTAREA
        ============================== */

        textarea.focus();


        /* ==============================
           KURSOR KE AKHIR
        ============================== */

        try {

            textarea.setSelectionRange(
                textarea.value.length,
                textarea.value.length
            );

        } catch (error) {}


        /* ==============================
           SCROLL KE FORM
        ============================== */

        textarea.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });

    });


    /* =========================================================
       ENTER UNTUK KIRIM
    ========================================================= */

    document.querySelectorAll(
        '.reply-form textarea'
    ).forEach(function (commentInput) {


        commentInput.addEventListener(
            'keydown',
            function (e) {


                if (
                    e.key === 'Enter' &&
                    !e.shiftKey &&
                    !e.isComposing
                ) {

                    e.preventDefault();


                    const form =
                        this.closest(
                            'form'
                        );


                    if (form) {

                        if (
                            typeof form.requestSubmit ===
                            'function'
                        ) {

                            form.requestSubmit();

                        } else {

                            form.submit();

                        }

                    }

                }

            }
        );


        /* =====================================================
           AUTO HEIGHT TEXTAREA
        ===================================================== */

        commentInput.addEventListener(
            'input',
            function () {

                this.style.height =
                    'auto';


                this.style.height =
                    Math.min(
                        this.scrollHeight,
                        120
                    ) + 'px';

            }
        );

    });


});

</script>


</body>

</html>