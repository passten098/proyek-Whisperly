<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moderasi Menfess | Whisperly</title>

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

            --approve: #65d477;
            --approve-dark: #348e47;

            --reject: #e85c5c;
            --reject-dark: #b93636;

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
                    rgba(255,255,255,.12),
                    rgba(255,255,255,.12)
                ),
                url("{{ asset('assets/images/CAMPURAN.jpeg') }}");

            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* =========================================
           HEADER
        ========================================= */

        .top-header {
            width: 100%;
            min-height: 82px;

            display: flex;
            align-items: center;

            position: relative;

            padding: 0 42px;

            background:
                linear-gradient(
                    90deg,
                    rgba(122,165,169,.95),
                    rgba(153,190,184,.94) 45%,
                    rgba(196,211,190,.93)
                );

            border-bottom:
                1px solid rgba(91,139,145,.44);

            box-shadow:
                0 4px 12px
                rgba(40,48,48,.10);
        }

        .back-button {
            display: inline-flex;
            align-items: center;

            gap: 8px;

            padding: 10px 15px;

            color: #3f6c71;

            text-decoration: none;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 18px;
            font-weight: 600;

            border-radius: 10px;

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

            color: #345d62;

            font-size: 29px;
            font-weight: 700;

            white-space: nowrap;
        }

        /* =========================================
           PAGE
        ========================================= */

        .page {
            width: min(1500px, calc(100% - 48px));

            margin: 28px auto 60px;
        }

        /* =========================================
           INTRO
        ========================================= */

        .intro {
            padding: 19px 28px;

            margin-bottom: 20px;

            background:
                linear-gradient(
                    90deg,
                    rgba(220,235,230,.88),
                    rgba(233,241,228,.88),
                    rgba(245,238,210,.84)
                );

            border:
                1px solid rgba(123,170,170,.50);

            border-radius: 16px;

            box-shadow: var(--shadow-small);

            text-align: center;
        }

        .intro p {
            margin: 0;

            color: #496b68;

            font-size: 16px;
            line-height: 1.5;
        }

        /* =========================================
           CONTENT GRID
        ========================================= */

        .content-grid {
            display: grid;

            grid-template-columns:
                390px
                minmax(0, 1fr);

            gap: 24px;

            align-items: start;
        }

        /* =========================================
           ADMIN PANEL KIRI
        ========================================= */

        .admin-panel {
            position: sticky;

            top: 20px;

            min-height: 650px;

            padding: 25px;

            border-radius: 24px;

            background:
                linear-gradient(
                    180deg,
                    rgba(144,188,183,.90),
                    rgba(181,210,194,.88) 48%,
                    rgba(235,225,185,.90)
                );

            border:
                1px solid rgba(88,151,160,.62);

            box-shadow: var(--shadow);
        }

        .info-box {
            padding: 20px;

            margin-bottom: 18px;

            background: rgba(255,255,255,.82);

            border-radius: 18px;

            border:
                1px solid
                rgba(255,255,255,.45);
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

        /* =========================================
           ADMIN TOOLS
        ========================================= */

        .admin-tools {
            padding: 20px;

            background:
                rgba(255,255,255,.78);

            border-radius: 18px;

            border:
                1px solid
                rgba(255,255,255,.45);
        }

        .admin-title {
            margin: 0 0 15px;

            color: var(--dark);

            font-size: 20px;

            font-weight: 700;
        }

        .pending-count {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 32px;
            height: 27px;

            margin-left: 5px;

            padding: 0 9px;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #e8c84c,
                    #dcae35
                );

            color: #5c4814;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 11px;

            font-weight: 800;
        }

        .pending-list {
            display: grid;

            gap: 12px;
        }

        .pending-item {
            padding: 13px;

            background:
                rgba(255,255,255,.70);

            border:
                1px solid
                rgba(210,215,210,.70);

            border-radius: 13px;
        }

        .pending-meta {
            margin-bottom: 6px;

            color: #817970;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;
        }

        .pending-message {
            color: #413b36;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 12px;

            line-height: 1.5;
        }

        /* =========================================
           BOARD
        ========================================= */

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

            background:
                rgba(248,250,240,.88);

            border:
                1px solid
                rgba(128,175,173,.48);

            border-radius: 15px;

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

        .pending-badge {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 40px;

            padding: 0 17px;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #e7c950,
                    #d9ae35
                );

            color: #5b4817;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 12px;

            font-weight: 800;
        }

        /* =========================================
           FEED
        ========================================= */

        .feed {
            display: grid;

            gap: 12px;
        }

        /* =========================================
           MENFESS CARD
        ========================================= */

        .card {
            padding: 14px 16px;

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

            border-radius: 16px;

            box-shadow:
                0 4px 14px
                rgba(45,53,53,.11);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .card:hover {
            transform: translateY(-1px);

            box-shadow:
                0 6px 18px
                rgba(45,53,53,.13);
        }

        /* =========================================
           CARD HEADER
        ========================================= */

        .card-head {
            display: flex;

            align-items: flex-start;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 8px;
        }

        .author-block {
            display: flex;

            align-items: center;

            gap: 9px;
        }

        .avatar {
            width: 39px;
            height: 39px;

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

            font-size: 14px;

            font-weight: 800;

            border:
                2px solid
                rgba(255,255,255,.75);
        }

        .author {
            color: #302a26;

            font-size: 15px;

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

        .chip {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 28px;

            padding: 0 12px;

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

            font-size: 12px;

            font-weight: 700;

            white-space: nowrap;
        }

        /* =========================================
           STATUS
        ========================================= */

        .pending-status,
        .published-status {
            display: inline-flex;

            align-items: center;

            padding: 5px 10px;

            margin-bottom: 7px;

            border-radius: 999px;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 9px;

            font-weight: 800;
        }

        .pending-status {
            background:
                rgba(231,201,80,.28);

            color: #80661c;
        }

        .published-status {
            background:
                rgba(101, 212, 119, 0.18);

            color: #287245;
        }

        /* =========================================
           PESAN MENFESS
        ========================================= */

        .message {
            margin: 0 0 12px 0 !important;
            padding: 0 !important;

            color: #302a26;

            font-size: 17px !important;
            font-weight: 500 !important;
            line-height: 1.45 !important;

            text-align: left !important;

            word-break: break-word;
        }

        /* =========================================
           TOGGLE KOMENTAR UTAMA
        ========================================= */

        .comments-toggle {
            display: flex;

            align-items: center;

            gap: 7px;

            width: fit-content;

            padding: 6px 10px;

            margin: 0;

            border: none;

            border-radius: 999px;

            background:
                rgba(96,120,199,.11);

            color: #556cb0;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;

            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }

        .comments-toggle:hover {
            background:
                rgba(96,120,199,.18);

            transform: translateY(-1px);
        }

        .comments-toggle .toggle-arrow {
            display: inline-block;

            font-size: 9px;

            transition: transform .2s ease;
        }

        .comments-toggle.open .toggle-arrow {
            transform: rotate(180deg);
        }

        /* =========================================
           COMMENTS WRAPPER
        ========================================= */

        .comments-section {
            display: none;

            margin-top: 12px;

            padding-top: 12px;

            border-top:
                1px solid
                rgba(110,135,130,.28);

            /*
             * PENTING:
             * Jangan biarkan style dari elemen lain
             * membuat isi komentar berada di tengah.
             */
            text-align: left !important;
        }

        .comments-section.open {
            display: block;

            animation:
                commentsOpen .22s ease;
        }

        @keyframes commentsOpen {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .comments-title {
            margin-bottom: 9px;

            color: #4e6965;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .4px;

            text-align: left !important;
        }

        /* =========================================
           COMMENT LIST
        ========================================= */

        .comment-list {
            display: block;

            width: 100%;

            margin: 0;

            padding: 0;

            text-align: left !important;
        }

        /* =========================================
           KOMENTAR — LAYOUT FINAL
           USERNAME / ISI KOMEN / BALAS = SATU GARIS KIRI
        ========================================= */

        .comments-section .comment-list {
            display: block !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            text-align: left !important;
        }

        .comments-section .comment-item {
            display: grid !important;
            grid-template-columns: minmax(0, 1fr) !important;
            justify-items: start !important;
            align-items: start !important;

            width: 100% !important;
            max-width: 100% !important;

            margin: 0 !important;
            padding: 10px 0 11px !important;

            background: transparent !important;
            border: none !important;
            border-radius: 0 !important;

            text-align: left !important;
        }

        .comments-section .comment-item + .comment-item {
            border-top:
                1px solid
                rgba(110,135,130,.20) !important;
        }

        /* =========================================
           HEADER KOMENTAR
           Avatar | Username
                   tanggal · role
        ========================================= */
        .comments-section .comment-top {
            grid-column: 1 !important;
            justify-self: start !important;

            display: flex !important;
            align-items: flex-start !important;
            justify-content: flex-start !important;

            width: auto !important;
            max-width: 100% !important;
            min-width: 0 !important;

            margin: 0 0 10px 0 !important;
            padding: 0 !important;

            gap: 9px !important;
            text-align: left !important;
        }

        .comments-section .comment-avatar {
            width: 27px !important;
            height: 27px !important;
            min-width: 27px !important;
            max-width: 27px !important;

            display: flex !important;
            align-items: center !important;
            justify-content: center !important;

            margin: 0 !important;
            padding: 0 !important;

            border-radius: 50% !important;
            background: #6f999c !important;
            color: #f5f7f4 !important;

            font-family: "Segoe UI", Arial, sans-serif !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            line-height: 1 !important;

            flex: 0 0 27px !important;
            box-sizing: border-box !important;
        }

        .comments-section .comment-user-wrap {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            justify-content: flex-start !important;

            min-width: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .comments-section .comment-user {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;

            width: auto !important;
            max-width: 100% !important;
            min-width: 0 !important;

            margin: 0 !important;
            padding: 0 !important;

            gap: 5px !important;

            color: #39332e !important;
            font-family: "Segoe UI", Arial, sans-serif !important;
            font-size: 13px !important;
            font-weight: 800 !important;
            line-height: 1.1 !important;

            text-align: left !important;
        }

        .comments-section .comment-meta {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 4px !important;

            margin: 3px 0 0 0 !important;
            padding: 0 !important;

            color: #68706d !important;
            font-family: "Segoe UI", Arial, sans-serif !important;
            font-size: 9px !important;
            font-weight: 400 !important;
            line-height: 1.2 !important;

            white-space: nowrap !important;
            text-align: left !important;
        }

        .comments-section .comment-time {
            margin: 0 !important;
            padding: 0 !important;
            flex-shrink: 0 !important;
            color: inherit !important;
            text-align: left !important;
        }

        .comments-section .comment-role-dot,
        .comments-section .comment-role {
            color: #68706d !important;
        }

        /* ISI KOMEN — WAJIB MULAI DARI KIRI */
        .comments-section .comment-item > .comment-text,
        .comments-section p.comment-text {
            grid-column: 1 !important;
            justify-self: start !important;

            display: block !important;

            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;

            margin: 0 !important;
            padding: 0 !important;

            color: #4a443f;
            font-family:
                "Segoe UI",
                Arial,
                sans-serif;
            font-size: 15px !important;
            font-weight: 400 !important;
            line-height: 1.55 !important;

            text-align: left !important;
            text-indent: 0 !important;

            white-space: pre-wrap !important;
            word-break: break-word !important;
            overflow-wrap: anywhere !important;

            position: static !important;
            inset: auto !important;
            transform: none !important;
            float: none !important;
            clear: none !important;
        }

        /* BALAS — WAJIB MULAI DARI KIRI */
        .comments-section .comment-actions {
            grid-column: 1 !important;
            justify-self: start !important;

            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;

            width: 100% !important;
            margin: 5px 0 0 0 !important;
            padding: 0 !important;

            text-align: left !important;
        }

        .comments-section .comment-reply-button {
            margin: 0 !important;
            padding: 2px 0 !important;

            border: none !important;
            border-radius: 0 !important;
            background: transparent !important;

            color: #556cb0;
            font-family:
                "Segoe UI",
                Arial,
                sans-serif;
            font-size: 10px;
            font-weight: 700;

            cursor: pointer;
            text-align: left !important;
        }

        .comments-section .comment-reply-button:hover {
            background: transparent !important;
            transform: none !important;
            color: #40559a;
        }

        /* =========================================
           VERIFIED BADGE
        ========================================= */

        .verified-badge {
            width: 15px;
            height: 15px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            color: white;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 9px;

            font-weight: 900;

            line-height: 1;
        }

        .verified-badge.talent {
            background:
                linear-gradient(
                    135deg,
                    #6c8ff4,
                    #476bcf
                );

            box-shadow:
                0 2px 5px
                rgba(71,107,207,.25);
        }

        .verified-badge.admin {
            background:
                linear-gradient(
                    135deg,
                    #e9c85d,
                    #c79b32
                );

            color: #594612;

            box-shadow:
                0 2px 5px
                rgba(199,155,50,.25);
        }

        /* =========================================
           TOGGLE BALASAN
        ========================================= */

        .toggle-replies {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            margin-top: 3px;

            padding: 2px 0;

            border: none;

            background: transparent;

            color: #66788a;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 9px;

            font-weight: 700;

            cursor: pointer;

            text-align: left !important;

            transition: .2s ease;
        }

        .toggle-replies:hover {
            color: #4e6380;
        }

        .toggle-replies-line {
            width: 24px;

            height: 1px;

            background:
                rgba(92,111,126,.42);

            display: inline-block;
        }

        .toggle-replies-arrow {
            font-size: 9px;

            transition:
                transform .2s ease;
        }

        .toggle-replies.open
        .toggle-replies-arrow {
            transform: rotate(180deg);
        }

        /* =========================================
           NESTED REPLIES
        ========================================= */

        .nested-replies {
            display: none !important;

            width: 100%;

            margin-top: 5px;

            padding-left: 30px;

            position: relative;

            text-align: left !important;
        }

        .nested-replies.open {
            display: block !important;
        }

        .nested-replies::before {
            content: "";

            position: absolute;

            left: 11px;

            top: 2px;

            bottom: 8px;

            width: 1px;

            background:
                rgba(105,126,125,.28);
        }

        .nested-replies .comment-item {
            position: relative;

            display: grid !important;
            grid-template-columns: minmax(0, 1fr) !important;
            justify-items: start !important;

            width: 100% !important;
            padding: 8px 0 9px !important;

            border-top: none !important;
            box-sizing: border-box !important;
        }

        .nested-replies .comment-top {
            margin-bottom: 7px !important;
        }

        .nested-replies .comment-text,
        .nested-replies .comment-actions {
            width: calc(100% - 36px) !important;
            margin-left: 36px !important;
            box-sizing: border-box !important;
        }

        .nested-replies .comment-item::before {
            content: "";

            position: absolute;

            left: -19px;

            top: 22px;

            width: 12px;

            height: 1px;

            background:
                rgba(105,126,125,.28);
        }

        .nested-replies .comment-text {
            font-size: 14px !important;

            line-height: 1.5 !important;
        }

        /* =========================================
           REPLY FORM
        ========================================= */

        .reply-form {
            display: flex;

            align-items: flex-end;

            gap: 8px;

            margin-top: 9px;

            padding-top: 9px;

            border-top:
                1px dashed
                rgba(113,137,132,.30);
        }

        .reply-input-wrap {
            flex: 1;

            min-width: 0;
        }

        .comment-input {
            width: 100%;

            min-height: 40px;

            max-height: 110px;

            padding: 9px 11px;

            resize: vertical;

            outline: none;

            border:
                1px solid
                rgba(116,146,142,.35);

            border-radius: 10px;

            background:
                rgba(255,255,255,.72);

            color: #3d3732;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 11px;

            line-height: 1.4;

            transition: .2s ease;
        }

        .comment-input::placeholder {
            color: #9b9188;
        }

        .comment-input:focus {
            border-color:
                rgba(96,120,199,.60);

            background:
                rgba(255,255,255,.90);

            box-shadow:
                0 0 0 3px
                rgba(96,120,199,.10);
        }

        .reply-submit {
            min-height: 40px;

            padding: 0 14px;

            border: none;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #6078c7,
                    #4f65ae
                );

            color: white;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;

            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 4px 9px
                rgba(78,101,174,.20);

            transition: .2s ease;
        }

        .reply-submit:hover {
            transform: translateY(-1px);

            filter: brightness(.97);
        }

        .no-comments {
            padding: 5px 0 7px;

            color: #8d837a;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;

            text-align: left !important;
        }

        /* =========================================
           ADMIN ACTION
        ========================================= */

        .admin-actions {
            display: flex;

            align-items: center;

            gap: 10px;

            padding-top: 10px;

            margin-top: 11px;

            border-top:
                1px dashed
                #d5cbb5;
        }

        .admin-actions form {
            margin: 0;
        }

        .admin-btn {
            min-height: 36px;

            padding: 0 17px;

            border: none;

            border-radius: 999px;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 11px;

            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }

        .admin-btn:hover {
            transform: translateY(-1px);

            filter: brightness(.96);
        }

        .approve-btn {
            background:
                linear-gradient(
                    135deg,
                    #70dc82,
                    #55c96b
                );

            color: #24552d;

            box-shadow:
                0 3px 8px
                rgba(67,172,85,.20);
        }

        .reject-btn {
            background:
                linear-gradient(
                    135deg,
                    #ef6b6b,
                    #dc4f4f
                );

            color: white;

            box-shadow:
                0 3px 8px
                rgba(210,70,70,.20);
        }

        .btn-delete {
            min-height: 35px;

            padding: 0 14px;

            border: none;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #ef6b6b,
                    #dc4f4f
                );

            color: white;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 10px;

            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }

        .btn-delete:hover {
            transform: translateY(-1px);

            filter: brightness(.96);
        }

        /* =========================================
           EMPTY
        ========================================= */

        .empty {
            min-height: 160px;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 30px;

            border:
                2px dashed
                #d6d5cf;

            border-radius: 18px;

            background:
                rgba(255,255,255,.62);

            color: #8c837b;

            text-align: center;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;
        }

        /* =========================================
           HOROR
        ========================================= */

        body.theme-horor {
            background:
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

        body.theme-horor .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(43,29,25,.96),
                    rgba(78,40,31,.95) 42%,
                    rgba(132,55,39,.94) 72%,
                    rgba(181,112,65,.92)
                );
        }

        body.theme-horor .page-title {
            color: #f1d9ad;
        }

        body.theme-horor .back-button {
            color: #efd5aa;
        }

        body.theme-horor .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(58,40,33,.90),
                    rgba(80,49,37,.88),
                    rgba(110,69,45,.84)
                );
        }

        body.theme-horor .intro p {
            color: #ead5b5;
        }

        body.theme-horor .admin-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(49,32,28,.92),
                    rgba(79,42,34,.89) 46%,
                    rgba(123,71,47,.84)
                );
        }

        body.theme-horor .info-box,
        body.theme-horor .admin-tools {
            background:
                rgba(247,229,197,.84);
        }

        body.theme-horor .board-header {
            background:
                rgba(247,229,197,.84);
        }

        body.theme-horor .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(73,47,38,.90),
                    rgba(104,61,44,.88) 48%,
                    rgba(154,91,54,.82)
                );

            border-color:
                rgba(186,102,60,.56);
        }

        body.theme-horor .author,
        body.theme-horor .message {
            color: #fff0d2;
        }

        body.theme-horor .meta {
            color: #ead2b2;
        }

        body.theme-horor .chip {
            background:
                linear-gradient(
                    135deg,
                    #b64b35,
                    #7d3029
                );

            color: #ffe6c4;
        }

        body.theme-horor .avatar {
            background:
                linear-gradient(
                    135deg,
                    #d1844f,
                    #8f3b2f
                );

            color: #2e1814;
        }

        /* =========================================
           CINTA
        ========================================= */

        body.theme-cinta {
            background:
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

        body.theme-cinta .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(217,119,91,.94),
                    rgba(239,157,122,.94) 45%,
                    rgba(248,208,170,.94)
                );
        }

        body.theme-cinta .page-title {
            color: #7d463d;
        }

        body.theme-cinta .back-button {
            color: #8f5144;
        }

        body.theme-cinta .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(255,232,215,.88),
                    rgba(255,242,226,.88),
                    rgba(248,224,208,.86)
                );
        }

        body.theme-cinta .intro p {
            color: #89564a;
        }

        body.theme-cinta .admin-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(242,170,137,.86),
                    rgba(250,205,175,.84) 46%,
                    rgba(255,236,213,.90)
                );
        }

        body.theme-cinta .info-box,
        body.theme-cinta .admin-tools,
        body.theme-cinta .board-header {
            background:
                rgba(255,249,241,.84);
        }

        body.theme-cinta .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(255,222,201,.88),
                    rgba(255,239,222,.90) 55%,
                    rgba(250,225,210,.86)
                );

            border-color:
                rgba(226,163,140,.54);
        }

        body.theme-cinta .chip {
            background:
                linear-gradient(
                    135deg,
                    #ffd8c5,
                    #f5bfa8
                );

            color: #a64f4b;
        }

        body.theme-cinta .avatar {
            background:
                linear-gradient(
                    135deg,
                    #e7a083,
                    #c76e63
                );

            color: #633d38;
        }

        /* =========================================
           SEDIH
        ========================================= */

        body.theme-sedih {
            background:
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

        body.theme-sedih .top-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(225,190,120,.94),
                    rgba(244,210,145,.94) 35%,
                    rgba(248,225,180,.94) 65%,
                    rgba(225,220,190,.94)
                );
        }

        body.theme-sedih .page-title {
            color: #6f6048;
        }

        body.theme-sedih .back-button {
            color: #75654b;
        }

        body.theme-sedih .intro {
            background:
                linear-gradient(
                    90deg,
                    rgba(250,238,205,.88),
                    rgba(242,235,210,.88),
                    rgba(225,230,215,.86)
                );
        }

        body.theme-sedih .intro p {
            color: #766a52;
        }

        body.theme-sedih .admin-panel {
            background:
                linear-gradient(
                    180deg,
                    rgba(238,215,160,.88),
                    rgba(245,230,190,.86) 45%,
                    rgba(222,232,218,.88)
                );
        }

        body.theme-sedih .info-box,
        body.theme-sedih .admin-tools {
            background:
                rgba(255,250,235,.84);
        }

        body.theme-sedih .board-header {
            background:
                linear-gradient(
                    90deg,
                    rgba(247,235,205,.88),
                    rgba(235,235,215,.86),
                    rgba(220,230,220,.84)
                );
        }

        body.theme-sedih .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(248,238,210,.88),
                    rgba(240,235,215,.88) 50%,
                    rgba(220,230,220,.85)
                );
        }

        body.theme-sedih .chip {
            background:
                linear-gradient(
                    135deg,
                    #e5d19c,
                    #d4c89f
                );

            color: #6f6045;
        }

        body.theme-sedih .avatar {
            background:
                linear-gradient(
                    135deg,
                    #c9b47d,
                    #9aa89a
                );

            color: #4f5548;
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

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

            .admin-panel {
                position: static;

                min-height: auto;

                padding: 16px;
            }

            .board-header {
                padding: 14px;
            }

            .card {
                padding: 13px;
            }

            .message {
                font-size: 16px !important;
            }

            .reply-form {
                flex-direction: column;

                align-items: stretch;
            }

            .reply-submit {
                width: 100%;
            }

            .comments-section .comment-text,
            .comment-item .comment-text,
            p.comment-text {
                font-size: 15px !important;

                text-align: left !important;
            }

            .nested-replies {
                padding-left: 25px;
            }
        }

        @media (max-width: 430px) {

            .page-title {
                font-size: 16px;
            }

            .card-head {
                flex-direction: column;
            }

            .chip {
                align-self: flex-start;
            }

            .admin-actions {
                flex-direction: column;

                align-items: stretch;
            }

            .admin-actions form,
            .admin-btn {
                width: 100%;
            }

            .comment-top {
                align-items: flex-start;

                flex-direction: row;

                gap: 7px;
            }
        }
    
        /* =========================================
           FINAL COMMENT LAYOUT FIX
           Komentar utama dimulai dari sisi kiri card.
           Reply tetap menjorok secara terpisah.
        ========================================= */

        .comments-section .comment-list {
            display: block !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            text-align: left !important;
        }

        .comments-section .comment-list > .comment-item {
            display: block !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 10px 0 11px !important;
            box-sizing: border-box !important;
            text-align: left !important;
            justify-items: initial !important;
        }

        .comments-section .comment-list > .comment-item > .comment-top {
            display: flex !important;
            width: auto !important;
            max-width: 100% !important;
            margin: 0 0 10px 0 !important;
            padding: 0 !important;
            text-align: left !important;
        }

        .comments-section .comment-list > .comment-item > p.comment-text {
            display: block !important;
            width: 100% !important;
            max-width: none !important;
            min-width: 0 !important;
            height: auto !important;
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
            position: static !important;
            left: auto !important;
            right: auto !important;
            top: auto !important;
            bottom: auto !important;
            inset: auto !important;
            transform: none !important;
            translate: none !important;
            float: none !important;
            clear: none !important;
            text-align: left !important;
            text-indent: 0 !important;
            direction: ltr !important;
            justify-self: initial !important;
            align-self: initial !important;
            grid-column: auto !important;
            grid-row: auto !important;
            font-size: 15px !important;
            font-weight: 400 !important;
            line-height: 1.55 !important;
            color: #4a443f !important;
            white-space: pre-wrap !important;
            word-break: break-word !important;
            overflow-wrap: anywhere !important;
        }

        .comments-section .comment-list > .comment-item > .comment-actions {
            display: flex !important;
            width: 100% !important;
            margin: 5px 0 0 0 !important;
            padding: 0 !important;
            justify-content: flex-start !important;
            text-align: left !important;
        }

        /* Reply: hanya reply yang diberi indent. */
        .comments-section .nested-replies {
            display: none !important;
            width: 100% !important;
            margin: 5px 0 0 0 !important;
            padding-left: 30px !important;
            box-sizing: border-box !important;
            text-align: left !important;
        }

        .comments-section .nested-replies.open {
            display: block !important;
        }

        .comments-section .nested-replies .comment-item {
            display: block !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 8px 0 9px !important;
            box-sizing: border-box !important;
            text-align: left !important;
        }

        .comments-section .nested-replies .comment-top {
            display: flex !important;
            width: auto !important;
            max-width: 100% !important;
            margin: 0 0 8px 0 !important;
            padding: 0 !important;
            text-align: left !important;
        }

        .comments-section .nested-replies .comment-item > p.comment-text {
            display: block !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
            text-align: left !important;
            position: static !important;
            transform: none !important;
            float: none !important;
        }

        .comments-section .nested-replies .comment-actions {
            display: flex !important;
            width: 100% !important;
            margin: 5px 0 0 0 !important;
            padding: 0 !important;
            justify-content: flex-start !important;
            text-align: left !important;
        }

</style>
</head>

@php
    $currentCategory = strtolower(
        trim($selectedCategory ?? 'campuran')
    );

    if ($currentCategory === 'horor') {
        $theme = 'theme-horor';
    } elseif ($currentCategory === 'cinta') {
        $theme = 'theme-cinta';
    } elseif ($currentCategory === 'sedih') {
        $theme = 'theme-sedih';
    } else {
        $theme = 'theme-campuran';
    }
@endphp

<body class="{{ $theme }}">

    @include('whisperly.navbar')

    <!-- HEADER -->
    <header class="top-header">

        <h1 class="page-title">
            Ruang Pengaduan
        </h1>

    </header>


    <div class="page">

        <!-- INTRO -->
        <div class="intro">

            <p>
                Menfess yang dikirim pengguna harus diverifikasi
                admin sebelum ditampilkan ke publik.
            </p>

        </div>


        <div class="content-grid">

            <!-- =================================
                 ADMIN TOOLS / KIRI
            ================================== -->

            <aside class="admin-panel">

                <div class="info-box">

                    <h3>
                        Sebelum mengelola menfess, baca ini:
                    </h3>

                    <ul>

                        <li>
                            Menfess baru tidak langsung tampil ke publik.
                        </li>

                        <li>
                            Admin harus memeriksa setiap menfess terlebih dahulu.
                        </li>

                        <li>
                            Klik Setujui jika menfess layak ditampilkan.
                        </li>

                        <li>
                            Klik Tolak jika menfess tidak sesuai ketentuan.
                        </li>

                        <li>
                            Identitas pengirim tetap anonim.
                        </li>

                        <li>
                            Admin dapat ikut membalas percakapan pada menfess yang telah dipublikasikan.
                        </li>

                    </ul>

                </div>


                <div class="admin-tools">

                    <h2 class="admin-title">

                        ADMIN TOOLS

                        <span class="pending-count">
                            {{ $pendingItems->count() }}
                        </span>

                    </h2>


                    <div class="pending-list">

                        @forelse ($pendingItems as $item)

                            @php

                                $pendingName =
                                    $item->anonymous_display_name
                                    ?? 'Anonim';

                            @endphp

                            <div class="pending-item">

                                <div class="pending-meta">

                                    {{ $item->created_at?->translatedFormat('d M, H:i') ?? $item->created_at }}

                                    ·

                                    {{ $pendingName }}

                                </div>

                                <div class="pending-message">

                                    {{ $item->isi_pesan }}

                                </div>

                                <div class="admin-actions" style="margin-top: 12px;">

                                    <form
                                        method="POST"
                                        action="{{ route('menfess.approve', $item->id) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="admin-btn approve-btn"
                                        >
                                            ✓ Setujui
                                        </button>

                                    </form>


                                    <form
                                        method="POST"
                                        action="{{ route('menfess.reject', $item->id) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="admin-btn reject-btn"
                                        >
                                            ✕ Tolak
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @empty

                            <div class="pending-item">

                                <div class="pending-message">

                                    Tidak ada menfess yang menunggu persetujuan.

                                </div>

                            </div>

                        @endforelse

                    </div>

                </div>

            </aside>


            <!-- =================================
                 BOARD / KANAN
            ================================== -->

            <main class="board">

                <div class="board-header">

                    <div class="board-info">

                        <span class="board-title">
                            Menfess Masuk
                        </span>

                        <span class="board-subtitle">
                            Periksa sebelum dipublikasikan.
                        </span>

                    </div>


                    <div class="pending-badge">

                        {{ $pendingItems->count() }}

                        Menunggu Persetujuan

                    </div>

                </div>


                <!-- LIST MENFESS -->

                <section class="feed">

                    @forelse ($approvedItems as $item)

                        @php

                            $tone = strtolower(
                                trim(
                                    $item->kategori?->jenis_kategori
                                    ?? 'campuran'
                                )
                            );

                            $displayName =
                                $item->anonymous_display_name
                                ?? 'Anonim';

                            $initial = strtoupper(
                                mb_substr(
                                    $displayName,
                                    0,
                                    1
                                )
                            );

                            $itemCategory = strtolower(
                                trim(
                                    $item->kategori?->jenis_kategori
                                    ?? ''
                                )
                            );

                            /*
                             * =========================================
                             * KOMENTAR
                             * =========================================
                             */

                            $allComments =
                                $item->comments
                                    ? $item->comments
                                        ->sortBy('created_at')
                                        ->values()
                                    : collect();

                            /*
                             * Hanya komentar utama.
                             * Komentar yang memiliki reply_to
                             * akan dimasukkan ke nested reply.
                             */

                            $mainComments =
                                $allComments
                                    ->filter(function ($comment) {
                                        return empty($comment->reply_to);
                                    })
                                    ->values();

                            /*
                             * Semua reply dikelompokkan berdasarkan
                             * ID komentar induknya.
                             */

                            $repliesByParent =
                                $allComments
                                    ->filter(function ($comment) {
                                        return !empty($comment->reply_to);
                                    })
                                    ->groupBy('reply_to');

                            $commentCount =
                                $allComments->count();

                        @endphp


                        <!-- CARD MENFESS -->

                        <article
                            class="card"
                            data-tone="{{ $tone }}"
                        >

                            <!-- HEADER -->

                            <div class="card-head">

                                <div class="author-block">

                                    <div class="avatar">
                                        {{ $initial }}
                                    </div>


                                    <div>

                                        <div class="author">
                                            {{ $displayName }}
                                        </div>


                                        <div class="meta">

                                            <span>
                                                {{
                                                    $item->created_at
                                                    ?->translatedFormat(
                                                        'd M, H:i'
                                                    )
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

                                    @if ($itemCategory === 'horor')

                                        Horror

                                    @elseif ($itemCategory === 'cinta')

                                        Love

                                    @elseif ($itemCategory === 'sedih')

                                        Sedih

                                    @elseif ($itemCategory === 'campuran')

                                        Random

                                    @else

                                        {{
                                            ucfirst(
                                                $item->kategori
                                                ?->jenis_kategori
                                                ?? 'Random'
                                            )
                                        }}

                                    @endif

                                </span>

                            </div>


                            <!-- STATUS -->

                            <div class="published-status">

                                Sudah dipublikasikan

                            </div>


                            <!-- ISI MENFESS -->

                            <div class="message">

                                {{ $item->isi_pesan }}

                            </div>


                            <!-- =================================
                                 TOGGLE BUKA/TUTUP KOMENTAR
                            ================================== -->

                            <button
                                type="button"
                                class="comments-toggle"
                                data-target="comments-{{ $item->id }}"
                                data-count="{{ $commentCount }}"
                                aria-expanded="false"
                            >

                                <span class="toggle-label">

                                    @if ($commentCount > 0)

                                        Tampilkan {{ $commentCount }} komentar

                                    @else

                                        Tampilkan komentar

                                    @endif

                                </span>

                                <span class="toggle-arrow">
                                    ▾
                                </span>

                            </button>


                            <!-- =================================
                                 KOMENTAR / BALASAN
                            ================================== -->

                            <div
                                id="comments-{{ $item->id }}"
                                class="comments-section"
                            >

                                <div class="comments-title">
                                    Balasan
                                </div>


                                @if ($commentCount > 0)

                                    <div class="comment-list">

                                        @foreach ($mainComments as $comment)

                                            @php

                                                $commentUsername =
                                                    $comment->pengguna?->username
                                                    ?? 'Pengguna';

                                                $commentRole =
                                                    strtolower(
                                                        trim(
                                                            (string) (
                                                                $comment->pengguna?->role
                                                                ?? ''
                                                            )
                                                        )
                                                    );

                                                $isTalent =
                                                    $commentRole === 'talent';

                                                $isAdmin =
                                                    $commentRole === 'admin';

                                                $commentReplies =
                                                    $repliesByParent
                                                        ->get(
                                                            $comment->id,
                                                            collect()
                                                        )
                                                        ->sortBy(
                                                            'created_at'
                                                        )
                                                        ->values();

                                                $replyCount =
                                                    $commentReplies->count();

                                                $replyTargetId =
                                                    'replies-' .
                                                    $item->id .
                                                    '-' .
                                                    $comment->id;

                                            @endphp


                                            <!-- =================================
                                                 KOMENTAR UTAMA
                                            ================================== -->

                                            <div
                                                class="comment-item"
                                                data-comment-id="{{ $comment->id }}"
                                            >

                                                <div class="comment-top">

                                                    <div class="comment-avatar">
                                                        {{ strtoupper(mb_substr($commentUsername, 0, 1)) }}
                                                    </div>

                                                    <div class="comment-user-wrap">

                                                        <div class="comment-user">
                                                            <span>{{ $commentUsername }}</span>

                                                            @if ($isTalent)
                                                                <span
                                                                    class="verified-badge talent"
                                                                    title="Talent terverifikasi"
                                                                >
                                                                    ✓
                                                                </span>
                                                            @elseif ($isAdmin)
                                                                <span
                                                                    class="verified-badge admin"
                                                                    title="Admin terverifikasi"
                                                                >
                                                                    ✓
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="comment-meta">
                                                            <span class="comment-time">
                                                                {{
                                                                    $comment->created_at
                                                                    ?->translatedFormat('d M, H:i')
                                                                    ?? $comment->created_at
                                                                }}
                                                            </span>
                                                            <span class="comment-role-dot">·</span>
                                                            <span class="comment-role">
                                                                {{ $commentRole === 'admin' ? 'Admin' : ($commentRole === 'talent' ? 'Talent' : 'Anonim') }}
                                                            </span>
                                                        </div>

                                                    </div>

                                                </div>


                                                <!-- TEKS KOMENTAR (dirapikan: satu baris, dibungkus trim()
                                                     supaya tidak ada whitespace/baris kosong yang ikut
                                                     dirender karena white-space: pre-wrap) -->
                                                <p class="comment-text" style="display:block !important;width:100% !important;max-width:none !important;margin:0 !important;padding:0 !important;text-align:left !important;position:static !important;transform:none !important;float:none !important;">{{ trim($comment->komentar) }}</p>


                                                <!-- ACTION -->

                                                <div class="comment-actions">

                                                    <button
                                                        type="button"
                                                        class="comment-reply-button"
                                                        data-comment-id="{{ $comment->id }}"
                                                        data-username="{{ $commentUsername }}"
                                                    >
                                                        Balas
                                                    </button>

                                                </div>


                                                <!-- =================================
                                                     LIHAT BALASAN
                                                ================================== -->

                                                @if ($replyCount > 0)

                                                    <button
                                                        type="button"
                                                        class="toggle-replies"
                                                        data-target="{{ $replyTargetId }}"
                                                        data-count="{{ $replyCount }}"
                                                        aria-expanded="false"
                                                    >

                                                        <span class="toggle-replies-line"></span>

                                                        <span class="toggle-replies-text">
                                                            Lihat {{ $replyCount }} balasan
                                                        </span>

                                                        <span class="toggle-replies-arrow">
                                                            ▾
                                                        </span>

                                                    </button>


                                                    <!-- =================================
                                                         NESTED REPLIES
                                                    ================================== -->

                                                    <div
                                                        id="{{ $replyTargetId }}"
                                                        class="nested-replies"
                                                    >

                                                        @foreach ($commentReplies as $reply)

                                                            @php

                                                                $replyUsername =
                                                                    $reply->pengguna?->username
                                                                    ?? 'Pengguna';

                                                                $replyRole =
                                                                    strtolower(
                                                                        trim(
                                                                            (string) (
                                                                                $reply->pengguna?->role
                                                                                ?? ''
                                                                            )
                                                                        )
                                                                    );

                                                                $replyIsTalent =
                                                                    $replyRole === 'talent';

                                                                $replyIsAdmin =
                                                                    $replyRole === 'admin';

                                                            @endphp


                                                            <div
                                                                class="comment-item"
                                                                data-comment-id="{{ $reply->id }}"
                                                            >

                                                                <div class="comment-top">

                                                                    <div class="comment-avatar">
                                                                        {{ strtoupper(mb_substr($replyUsername, 0, 1)) }}
                                                                    </div>

                                                                    <div class="comment-user-wrap">

                                                                        <div class="comment-user">
                                                                            <span>{{ $replyUsername }}</span>

                                                                            @if ($replyIsTalent)
                                                                                <span
                                                                                    class="verified-badge talent"
                                                                                    title="Talent terverifikasi"
                                                                                >
                                                                                    ✓
                                                                                </span>
                                                                            @elseif ($replyIsAdmin)
                                                                                <span
                                                                                    class="verified-badge admin"
                                                                                    title="Admin terverifikasi"
                                                                                >
                                                                                    ✓
                                                                                </span>
                                                                            @endif
                                                                        </div>

                                                                        <div class="comment-meta">
                                                                            <span class="comment-time">
                                                                                {{
                                                                                    $reply->created_at
                                                                                    ?->translatedFormat('d M, H:i')
                                                                                    ?? $reply->created_at
                                                                                }}
                                                                            </span>
                                                                            <span class="comment-role-dot">·</span>
                                                                            <span class="comment-role">
                                                                                {{ $replyRole === 'admin' ? 'Admin' : ($replyRole === 'talent' ? 'Talent' : 'Anonim') }}
                                                                            </span>
                                                                        </div>

                                                                    </div>

                                                                </div>


                                                                <!-- TEKS BALASAN (dirapikan: satu baris + trim()) -->
                                                                <p class="comment-text" style="display:block !important;width:100% !important;max-width:none !important;margin:0 !important;padding:0 !important;text-align:left !important;position:static !important;transform:none !important;float:none !important;">{{ trim($reply->komentar) }}</p>


                                                                <div class="comment-actions">

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

                                @else

                                    <div class="no-comments">
                                        Belum ada balasan pada menfess ini.
                                    </div>

                                @endif


                                <!-- =================================
                                     FORM BALAS ADMIN
                                ================================== -->

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


                                    <div class="reply-input-wrap">

                                        <textarea
                                            name="komentar"
                                            class="comment-input"
                                            placeholder="Tulis balasan sebagai admin..."
                                            required
                                        ></textarea>

                                    </div>


                                    <button
                                        type="submit"
                                        class="reply-submit"
                                    >
                                        Kirim Balasan
                                    </button>

                                </form>

                            </div>


                            <!-- ADMIN ACTION -->

                            <div
                                class="admin-actions"
                                style="justify-content: flex-end;"
                            >

                                <form
                                    action="{{ route('menfess.destroy', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus menfess ini?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-delete"
                                    >
                                        🗑 Hapus Menfess
                                    </button>

                                </form>

                            </div>

                        </article>


                    @empty

                        <div class="empty">

                            Tidak ada menfess yang sudah
                            dipublikasikan.

                        </div>

                    @endforelse

                </section>

            </main>

        </div>

    </div>


    <!-- =========================================
         SCRIPT
    ========================================= -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* =========================================
               TOGGLE KOMENTAR UTAMA
            ========================================= */

            document.addEventListener('click', function (e) {

                const toggleButton =
                    e.target.closest('.comments-toggle');

                if (!toggleButton) {
                    return;
                }

                e.preventDefault();

                const targetId =
                    toggleButton.getAttribute('data-target');

                if (!targetId) {
                    return;
                }

                const section =
                    document.getElementById(targetId);

                if (!section) {
                    return;
                }

                const isOpen =
                    section.classList.contains('open');

                const label =
                    toggleButton.querySelector(
                        '.toggle-label'
                    );

                const count =
                    parseInt(
                        toggleButton.getAttribute(
                            'data-count'
                        ) || '0',
                        10
                    );


                if (isOpen) {

                    section.classList.remove('open');

                    toggleButton.classList.remove('open');

                    toggleButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                    if (label) {

                        if (count > 0) {

                            label.textContent =
                                'Tampilkan ' +
                                count +
                                ' komentar';

                        } else {

                            label.textContent =
                                'Tampilkan komentar';

                        }

                    }

                } else {

                    section.classList.add('open');

                    toggleButton.classList.add('open');

                    toggleButton.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                    if (label) {

                        label.textContent =
                            'Sembunyikan komentar';

                    }

                }

            });


            /* =========================================
               TOGGLE BALASAN
            ========================================= */

            document.addEventListener('click', function (e) {

                const toggleButton =
                    e.target.closest('.toggle-replies');

                if (!toggleButton) {
                    return;
                }

                e.preventDefault();

                const targetId =
                    toggleButton.getAttribute('data-target');

                if (!targetId) {
                    return;
                }

                const target =
                    document.getElementById(targetId);

                if (!target) {
                    console.warn(
                        'Target balasan tidak ditemukan:',
                        targetId
                    );

                    return;
                }

                const isOpen =
                    target.classList.contains('open');

                const text =
                    toggleButton.querySelector(
                        '.toggle-replies-text'
                    );

                const count =
                    parseInt(
                        toggleButton.getAttribute(
                            'data-count'
                        ) || '0',
                        10
                    );


                if (isOpen) {

                    target.classList.remove('open');

                    toggleButton.classList.remove('open');

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

                    target.classList.add('open');

                    toggleButton.classList.add('open');

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


            /* =========================================
               BALAS KOMENTAR
            ========================================= */

            document.addEventListener('click', function (e) {

                const button =
                    e.target.closest(
                        '.comment-reply-button'
                    );

                if (!button) {
                    return;
                }

                e.preventDefault();

                const username =
                    button.getAttribute(
                        'data-username'
                    ) || 'Pengguna';

                const commentId =
                    button.getAttribute(
                        'data-comment-id'
                    ) || '';

                const card =
                    button.closest('.card');

                if (!card) {
                    return;
                }

                const section =
                    card.querySelector(
                        '.comments-section'
                    );

                const form =
                    card.querySelector(
                        '.reply-form'
                    );

                if (!section || !form) {
                    return;
                }


                /*
                 * Kalau bagian komentar utama masih
                 * tertutup, buka otomatis.
                 */

                if (!section.classList.contains('open')) {

                    section.classList.add('open');

                    const mainToggle =
                        card.querySelector(
                            '.comments-toggle'
                        );

                    if (mainToggle) {

                        mainToggle.classList.add('open');

                        mainToggle.setAttribute(
                            'aria-expanded',
                            'true'
                        );

                        const label =
                            mainToggle.querySelector(
                                '.toggle-label'
                            );

                        if (label) {

                            label.textContent =
                                'Sembunyikan komentar';

                        }

                    }

                }


                /*
                 * Kalau tombol Balas berasal dari
                 * komentar nested, buka juga nested
                 * reply tersebut.
                 */

                const nestedReplies =
                    button.closest(
                        '.nested-replies'
                    );

                if (nestedReplies) {

                    nestedReplies.classList.add('open');

                    const nestedToggle =
                        nestedReplies
                            .previousElementSibling;

                    if (
                        nestedToggle &&
                        nestedToggle.classList.contains(
                            'toggle-replies'
                        )
                    ) {

                        nestedToggle.classList.add(
                            'open'
                        );

                        nestedToggle.setAttribute(
                            'aria-expanded',
                            'true'
                        );

                        const nestedText =
                            nestedToggle.querySelector(
                                '.toggle-replies-text'
                            );

                        if (nestedText) {

                            nestedText.textContent =
                                'Sembunyikan balasan';

                        }

                    }

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


                /*
                 * Simpan ID komentar yang akan
                 * dibalas.
                 */

                replyInput.value =
                    commentId;


                /*
                 * Masukkan @username.
                 */

                textarea.value =
                    '@' + username + ' ';


                textarea.focus();


                /*
                 * Letakkan cursor di paling belakang.
                 */

                try {

                    textarea.setSelectionRange(
                        textarea.value.length,
                        textarea.value.length
                    );

                } catch (error) {}


                /*
                 * Scroll sedikit ke area form.
                 */

                textarea.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

            });


            /* =========================================
               ENTER = KIRIM
               SHIFT + ENTER = BARIS BARU
            ========================================= */

            document
                .querySelectorAll(
                    '.reply-form textarea'
                )
                .forEach(function (textarea) {

                    textarea.addEventListener(
                        'keydown',
                        function (e) {

                            if (
                                e.key === 'Enter' &&
                                !e.shiftKey &&
                                !e.isComposing
                            ) {

                                e.preventDefault();

                                const form =
                                    this.closest('form');

                                if (!form) {
                                    return;
                                }

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
                    );


                    /*
                     * Tinggi textarea otomatis
                     * mengikuti isi.
                     */

                    textarea.addEventListener(
                        'input',
                        function () {

                            this.style.height =
                                'auto';

                            this.style.height =
                                Math.min(
                                    this.scrollHeight,
                                    110
                                ) + 'px';

                        }
                    );

                });

        });
    </script>

</body>

</html>