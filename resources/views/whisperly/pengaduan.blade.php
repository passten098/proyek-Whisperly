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

            --shadow: 0 5px 16px rgba(45, 53, 53, .12);
            --shadow-small: 0 3px 9px rgba(45, 53, 53, .08);
        }

        body {
            margin: 0;
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

        /* =========================
           BACKGROUND
        ========================= */

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
                    rgba(20,10,8,.08),
                    rgba(20,10,8,.08)
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

        /* =========================
           HEADER
        ========================= */

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

        /* =========================
           PAGE
        ========================= */

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

        /* =========================
           CONTENT
        ========================= */

        .content-grid {
            display: grid;

            grid-template-columns:
                390px
                minmax(0,1fr);

            gap: 24px;

            align-items: start;
        }

        /* =========================
           LEFT PANEL
        ========================= */

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

        /* =========================
           FORM
        ========================= */

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

        /* =========================
           BUTTON
        ========================= */

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

        /* =========================
           ALERT
        ========================= */

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

        /* =========================
           BOARD
        ========================= */

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

        /* =========================
           CATEGORY
        ========================= */

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

        /* =========================
           CARD (MENFESS) — COMPACT
        ========================= */

        .feed {
            display: grid;
            gap: 10px;
        }

        .card {
            /* padding sangat ringkas, tinggi mengikuti isi */
            padding: 12px 14px;
            height: auto;

            background: rgba(255,255,255,.85);

            border: none !important;
            outline: none !important;

            border-radius: 14px;

            box-shadow:
                0 3px 10px
                rgba(45,53,53,.08);

            transition: .2s ease;
        }

        .card:hover {
            transform: translateY(-1px);
        }

        .card-head {
            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 10px;

            margin-bottom: 6px;
        }

        .author-block {
            display: flex;

            align-items: center;

            gap: 8px;
        }

        /* =========================
           AVATAR
        ========================= */

        .avatar {
            width: 30px;
            height: 30px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #6179c7;

            color: #1c2c60;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 11px;
            font-weight: 800;

            border: none !important;
            outline: none !important;
        }

        .author {
            color: #302a26;

            font-size: 13px;

            font-weight: 700;
        }

        .meta {
            display: flex;

            align-items: center;

            gap: 5px;

            margin-top: 1px;

            color: #92867c;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;
        }

        .chip {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 22px;

            padding: 0 10px;

            border-radius: 999px;

            background: var(--green-soft);

            color: var(--green-dark);

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 11px;

            font-weight: 700;

            white-space: nowrap;

            border: none !important;
        }

        /* =========================
           MESSAGE
        ========================= */

        .message {
            width: 100%;

            margin: 4px 0 8px;

            color: #3f3934;

            font-size: 13.5px;

            font-weight: 400;

            line-height: 1.45;

            white-space: pre-wrap;

            word-break: break-word;

            text-align: left !important;
        }

        /* =========================
           REPLY
        ========================= */

        .reply-box {
            padding-top: 4px;

            border: none !important;
            border-top: none !important;
        }

        .reply-count {
            display: inline-flex;

            align-items: center;

            min-height: 20px;

            padding: 0 9px;

            margin-bottom: 6px;

            border-radius: 999px;

            background: var(--blue-soft);

            color: #536b86;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;

            font-weight: 800;

            border: none !important;
        }

        .comment-list {
            display: grid;

            gap: 5px;

            margin-bottom: 6px;
        }

        .comment {
            display: flex;

            gap: 7px;

            padding: 6px 9px;

            background: rgba(255,255,255,.57);

            border: none !important;
            outline: none !important;

            border-radius: 10px;
        }

        .comment .avatar {
            width: 22px;
            height: 22px;

            font-size: 9px;

            border: none !important;
        }

        .comment strong {
            display: block;

            color: #403a35;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 12px;

            font-weight: 700;
        }

        /* =========================
           FONT JAWABAN
        ========================= */

        .comment-text {
            margin-top: 1px;

            color: #756d66;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 12.5px !important;

            line-height: 1.4;

            font-weight: 400;
        }

        /* =========================
           REPLY FORM
        ========================= */

        .reply-form {
            display: flex;

            align-items: stretch;

            gap: 7px;
        }

        .reply-form textarea {
            flex: 1;

            min-width: 0;

            min-height: 34px;

            padding: 7px 9px;

            border: none !important;
            outline: none !important;

            border-radius: 10px;

            background: rgba(255,255,255,.78);

            color: var(--text);

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 12px;

            resize: vertical;
        }

        .reply-form button {
            flex-shrink: 0;

            width: 38px;

            min-height: 34px;

            border: none !important;
            outline: none !important;

            border-radius: 10px;

            background: var(--purple);

            color: white;

            display: flex;

            align-items: center;
            justify-content: center;

            cursor: pointer;

            transition: .2s ease;
        }

        .reply-form button:hover {
            transform: translateY(-1px);
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

        /* =========================
           EMPTY
        ========================= */

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

        /* ==================================================
           LOVE
        ================================================== */

        body.theme-love .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(217,119,91,.94),
                    rgba(239,157,122,.94) 45%,
                    rgba(248,208,170,.94)
                );
        }

        body.theme-love .page-title {
            color: #7d463d;
        }

        body.theme-love .back-button {
            color: #8f5144;
        }

        body.theme-love .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(255,232,215,.88),
                    rgba(255,242,226,.88),
                    rgba(248,224,208,.86)
                );
        }

        body.theme-love .intro p {
            color: #89564a;
        }

        body.theme-love .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(242,170,137,.86),
                    rgba(250,205,175,.84) 46%,
                    rgba(255,236,213,.90)
                );
        }

        body.theme-love .info-box,
        body.theme-love .composer-card,
        body.theme-love .board-header {
            background: rgba(255,249,241,.84);
        }

        body.theme-love .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(255,222,201,.88),
                    rgba(255,239,222,.90) 55%,
                    rgba(250,225,210,.86)
                );
        }

        body.theme-love .submit-btn {
            background:
                linear-gradient(
                    135deg,
                    #c96d5d,
                    #a95751
                );
        }

        body.theme-love .reply-form button {
            background:
                linear-gradient(
                    135deg,
                    #df9175,
                    #bd685d
                );
        }

        body.theme-love .category-toggle.active {
            background:
                linear-gradient(
                    135deg,
                    #d67b68,
                    #b75f58
                );

            color: white;
        }

        body.theme-love .chip {
            background:
                linear-gradient(
                    135deg,
                    #ffd8c5,
                    #f5bfa8
                );

            color: #a64f4b;
        }

        body.theme-love .avatar {
            background:
                linear-gradient(
                    135deg,
                    #e7a083,
                    #c76e63
                );

            color: #633d38;
        }

        /* ==================================================
           SAD
        ================================================== */

        body.theme-sad .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(225,190,120,.94),
                    rgba(244,210,145,.94) 35%,
                    rgba(248,225,180,.94) 65%,
                    rgba(225,220,190,.94)
                );
        }

        body.theme-sad .page-title {
            color: #6f6048;
        }

        body.theme-sad .back-button {
            color: #75654b;
        }

        body.theme-sad .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(250,238,205,.88),
                    rgba(242,235,210,.88),
                    rgba(225,230,215,.86)
                );
        }

        body.theme-sad .intro p {
            color: #766a52;
        }

        body.theme-sad .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(238,215,160,.88),
                    rgba(245,230,190,.86) 45%,
                    rgba(222,232,218,.88)
                );
        }

        body.theme-sad .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(248,238,210,.88),
                    rgba(240,235,215,.88) 50%,
                    rgba(220,230,220,.85)
                );
        }

        body.theme-sad .submit-btn {
            background:
                linear-gradient(
                    135deg,
                    #a68f62,
                    #827b62
                );
        }

        body.theme-sad .reply-form button {
            background:
                linear-gradient(
                    135deg,
                    #8ca09a,
                    #6f8780
                );
        }

        body.theme-sad .category-toggle.active {
            background:
                linear-gradient(
                    135deg,
                    #c8ad72,
                    #a99b70
                );

            color: white;
        }

        body.theme-sad .chip {
            background:
                linear-gradient(
                    135deg,
                    #e5d19c,
                    #d4c89f
                );

            color: #6f6045;
        }

        body.theme-sad .avatar {
            background:
                linear-gradient(
                    135deg,
                    #c9b47d,
                    #9aa89a
                );

            color: #4f5548;
        }

        /* ==================================================
           HORROR
        ================================================== */

        body.theme-horror .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(43,29,25,.96),
                    rgba(78,40,31,.95) 42%,
                    rgba(132,55,39,.94) 72%,
                    rgba(181,112,65,.92)
                );
        }

        body.theme-horror .page-title {
            color: #f1d9ad;
        }

        body.theme-horror .back-button {
            color: #efd5aa;
        }

        body.theme-horror .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(58,40,33,.90),
                    rgba(80,49,37,.88),
                    rgba(110,69,45,.84)
                );
        }

        body.theme-horror .intro p {
            color: #ead5b5;
        }

        body.theme-horror .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(49,32,28,.92),
                    rgba(79,42,34,.89) 46%,
                    rgba(123,71,47,.84)
                );
        }

        body.theme-horror .info-box,
        body.theme-horror .composer-card,
        body.theme-horror .board-header {
            background: rgba(247,229,197,.84);
        }

        body.theme-horror .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(73,47,38,.90),
                    rgba(104,61,44,.88) 48%,
                    rgba(154,91,54,.82)
                );
        }

        body.theme-horror .card .author,
        body.theme-horror .card .message,
        body.theme-horror .card .comment strong {
            color: #fff0d2;
        }

        body.theme-horror .card .meta,
        body.theme-horror .card .comment-text {
            color: #ead2b2;
        }

        body.theme-horror .comment {
            background: rgba(30,19,16,.22);
        }

        body.theme-horror .submit-btn {
            background:
                linear-gradient(
                    135deg,
                    #9d342c,
                    #5f211f
                );
        }

        body.theme-horror .reply-form button {
            background:
                linear-gradient(
                    135deg,
                    #b44d34,
                    #783029
                );
        }

        body.theme-horror .category-toggle.active {
            background:
                linear-gradient(
                    135deg,
                    #a83d31,
                    #67231f
                );

            color: #fff4df;
        }

        body.theme-horror .chip {
            background:
                linear-gradient(
                    135deg,
                    #b64b35,
                    #7d3029
                );

            color: #ffe6c4;
        }

        body.theme-horror .avatar {
            background:
                linear-gradient(
                    135deg,
                    #d1844f,
                    #8f3b2f
                );

            color: #2e1814;
        }

        /* ==================================================
           RANDOM
        ================================================== */

        body.theme-random .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(122,165,169,.95),
                    rgba(153,190,184,.94) 45%,
                    rgba(196,211,190,.93)
                );
        }

        body.theme-random .page-title {
            color: #345d62;
        }

        body.theme-random .back-button {
            color: #3f6c71;
        }

        body.theme-random .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(220,235,230,.88),
                    rgba(233,241,228,.88),
                    rgba(245,238,210,.84)
                );
        }

        body.theme-random .intro p {
            color: #496b68;
        }

        body.theme-random .composer-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(144,188,183,.87),
                    rgba(181,210,194,.84) 48%,
                    rgba(235,225,185,.88)
                );
        }

        body.theme-random .info-box,
        body.theme-random .composer-card,
        body.theme-random .board-header {
            background: rgba(248,250,240,.84);
        }

        body.theme-random .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(198,224,220,.88),
                    rgba(226,238,222,.89) 52%,
                    rgba(247,239,207,.84)
                );
        }

        body.theme-random .submit-btn {
            background:
                linear-gradient(
                    135deg,
                    #548d94,
                    #426f78
                );
        }

        body.theme-random .reply-form button {
            background:
                linear-gradient(
                    135deg,
                    #7da7a0,
                    #5c8988
                );
        }

        body.theme-random .category-toggle.active {
            background:
                linear-gradient(
                    135deg,
                    #66979b,
                    #4d7c84
                );

            color: white;
        }

        body.theme-random .chip {
            background:
                linear-gradient(
                    135deg,
                    #d4ebe0,
                    #b8d8d2
                );

            color: #3e7770;
        }

        body.theme-random .avatar {
            background:
                linear-gradient(
                    135deg,
                    #83aaa7,
                    #5d858e
                );

            color: #264f56;
        }

        /* ==================================================
           PENGHAPUS GARIS GLOBAL
        ================================================== */

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

        /* =========================
           RESPONSIVE
        ========================= */

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
                font-size: 13px;
            }

            .comment-text {
                font-size: 12.5px !important;
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

            .reply-form button {
                width: 38px;
            }

            .comment-text {
                font-size: 12.5px !important;
            }
        }
    </style>
</head>

@php

    /*
    |--------------------------------------------------------------------------
    | KATEGORI AKTIF
    |--------------------------------------------------------------------------
    */

    $currentCategory = strtolower(
        trim($selectedCategory ?? 'random')
    );

    /*
    |--------------------------------------------------------------------------
    | NORMALISASI KATEGORI
    |--------------------------------------------------------------------------
    */

    if ($currentCategory === 'horor') {
        $currentCategory = 'horror';
    } elseif ($currentCategory === 'cinta') {
        $currentCategory = 'love';
    } elseif ($currentCategory === 'sedih') {
        $currentCategory = 'sad';
    } elseif ($currentCategory === 'campuran') {
        $currentCategory = 'random';
    }

    /*
    |--------------------------------------------------------------------------
    | THEME
    |--------------------------------------------------------------------------
    */

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

<header class="top-header">

    <a
        class="back-button"
        href="{{ route('whisperly.home') }}"
    >
        ← Kembali
    </a>

    <h1 class="page-title">
        Ruang Pengaduan
    </h1>

</header>

<div class="page">

    <div class="intro">

        <p>
            Sampaikan cerita, harapan, atau keluhanmu dengan aman dan anonim.
        </p>

    </div>

    <div class="content-grid">

        <!-- =========================
             FORM MENFESS
        ========================= -->

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

        <!-- =========================
             BOARD
        ========================= -->

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

            <!-- =========================
                 LIST MENFESS
            ========================= -->

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

                        /*
                        |--------------------------------------------------------------------------
                        | KODE ANONIM
                        |--------------------------------------------------------------------------
                        */

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

                        <!-- =========================
                             HEADER MENFESS
                        ========================= -->

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

                            <!-- KATEGORI -->

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

                        <!-- =========================
                             ISI MENFESS
                        ========================= -->

                        <div class="message">

                            {{ $item->isi_pesan }}

                        </div>

                        <!-- =========================
                             BALASAN
                        ========================= -->

                        <div class="reply-box">

                            <div class="reply-count">

                                {{ $item->comments->count() }}

                                Balasan

                            </div>

                            <div class="comment-list">

                                @foreach ($item->comments as $comment)

                                    <div class="comment">

                                        <div class="avatar">
                                            {{
                                                strtoupper(
                                                    substr(
                                                        $comment->pengguna?->username ?? 'P',
                                                        0,
                                                        1
                                                    )
                                                )
                                            }}
                                        </div>

                                        <div>

                                            <strong>
                                                {{ $comment->pengguna?->username ?? 'Pengguna' }}
                                            </strong>

                                            <div class="comment-text">

                                                {{ $comment->komentar }}

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                            <!-- =========================
                                 FORM BALAS
                            ========================= -->

                            <form
                                method="POST"
                                action="{{ route('pengaduan.comments.store', $item->id) }}"
                                class="reply-form"
                            >

                                @csrf

                                <textarea
                                    name="komentar"
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

</body>

</html>