<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        Chat dengan
        {{ auth('whisperly')->user()->role === 'user'
            ? ($booking->talent?->pengguna?->username ?? 'Talent')
            : ($booking->pengguna?->username ?? 'User') }}
    </title>


    <style>
        /* Global font: Arial */
        * {
            font-family: Arial, sans-serif !important;
        }


        * {
            box-sizing: border-box;
        }


        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }


        body {

            font-family: Arial, sans-serif;

            color: #183153;

            background-color: #a9d2f5;

            background-image:
    
                url('{{ asset('assets/images/chat-background.jpg') }}');

            background-position: center;

            background-attachment: fixed;
        }


        /* ==========================================================
           WRAPPER
           (Diubah: jadi satu panel utuh, radius cuma di sisi luar,
           shadow satu kali untuk seluruh panel — bukan per-elemen)
        ========================================================== */

        .chat-wrapper {

            width: calc(100% - 60px);

            max-width: 1700px;

            margin: 10px auto 5px;

            height: calc(100vh - 170px);

            min-height: 650px;

            display: grid;

            grid-template-columns: 360px minmax(0, 1fr);

            background: #ffffff;

            border-radius: 16px;

            overflow: hidden;

            box-shadow:
                0 10px 40px
                rgba(51, 110, 160, .12);

        }


        /* ==========================================================
           SIDEBAR
           (Diubah: hapus radius sendiri supaya nempel rata ke room)
        ========================================================== */

        .sidebar {

            background: #ffffff;

            border-right: 1px solid #dceafb;

            display: flex;

            flex-direction: column;

            min-width: 0;

            min-height: 0;

            border-radius: 0;

            overflow: hidden;
        }


        .sidebar-header {

            padding:
                30px 24px 20px;

            flex-shrink: 0;
        }


        .sidebar-title {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 22px;
        }


        .sidebar-title h1 {

            margin: 0;

            font-family: Georgia, serif;

            font-size: 36px;

            font-weight: 400;

            color: #132b4f;
        }


        /* ==========================================================
           SEARCH
        ========================================================== */

        .search-box {

            position: relative;
        }


        .search-box input {

            width: 100%;

            height: 50px;

            border:
                1px solid #d6e6f8;

            border-radius: 15px;

            padding:
                0 16px 0 44px;

            outline: none;

            font-size: 14px;

            background: #f9fcff;

            color: #23466d;
        }


        .search-box input:focus {

            border-color: #5da5ed;

            box-shadow:
                0 0 0 3px
                rgba(93, 165, 237, .12);
        }


        .search-icon {

            position: absolute;

            left: 16px;

            top: 50%;

            transform:
                translateY(-50%);

            color: #5288bd;

            font-size: 17px;
        }


        /* ==========================================================
           FILTER
        ========================================================== */

        .filters {

            display: flex;

            gap: 8px;

            margin-top: 16px;
        }


        .filter {

            border: none;

            background: transparent;

            color: #53708f;

            padding:
                8px 14px;

            border-radius: 12px;

            cursor: pointer;

            font-size: 13px;

            transition: .2s ease;
        }


        .filter:hover {

            background: #f2f8ff;
        }


        .filter.active {

            background: #e4f1ff;

            color: #1674d1;

            font-weight: 700;
        }


        /* ==========================================================
           CHAT LIST
        ========================================================== */

        .chat-list {

            flex: 1;

            min-height: 0;

            overflow-y: auto;

            padding:
                10px 12px 20px;
        }


        .chat-list::-webkit-scrollbar {

            width: 6px;
        }


        .chat-list::-webkit-scrollbar-thumb {

            background: #c8def4;

            border-radius: 10px;
        }


        .chat-item {

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                13px 12px;

            margin-bottom: 5px;

            border-radius: 17px;

            text-decoration: none;

            color: inherit;

            transition: .2s ease;

            cursor: pointer;
        }


        .chat-item:hover {

            background: #f2f8ff;
        }


        .chat-item.active {

            background: #dceeff;
        }


        .chat-item.unread .chat-name {

            color: #126bc0;

            font-weight: 800;
        }


        .chat-item.unread .chat-preview {

            color: #315e87;

            font-weight: 700;
        }


        /* ==========================================================
           AVATAR
        ========================================================== */

        .avatar {

            width: 48px;

            height: 48px;

            flex-shrink: 0;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #b9dcff,
                    #75b8f4
                );

            color: #1267b7;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

            font-weight: 700;

            border:
                2px solid #ffffff;

            box-shadow:
                0 3px 10px
                rgba(48, 119, 184, .15);
        }


        .chat-info {

            flex: 1;

            min-width: 0;
        }


        .chat-name {

            font-weight: 700;

            font-size: 14px;

            color: #193a5d;

            margin-bottom: 5px;
        }


        .chat-preview {

            font-size: 12px;

            color: #6d88a3;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .chat-time {

            align-self: flex-start;

            font-size: 11px;

            color: #6d8cab;
        }


        .unread-badge {

            min-width: 21px;

            height: 21px;

            padding:
                0 6px;

            border-radius: 999px;

            background: #2386e8;

            color: #ffffff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 10px;

            font-weight: 700;
        }


        /* ==========================================================
           ROOM
        ========================================================== */

        .room {
            min-width: 0;
            min-height: 0;

            display: flex;
            flex-direction: column;
            overflow: hidden;

            background-color: #a9d2f5;

            background-image:
                
                url('{{ asset('assets/images/chat-background.jpg') }}');

            background-size: cover;

            background-position: center;

            background-repeat: no-repeat;

            position: relative;
        }


        /* ==========================================================
           ROOM HEADER
           (Diubah: hilangkan margin/radius/shadow sendiri,
           jadi strip putih rata yang nyatu di atas panel,
           dipisah cuma dengan garis tipis)
        ========================================================== */

        .room-header {

            height: 92px;

            min-height: 92px;

            flex-shrink: 0;

            margin: 0;

            background: #ffffff;

            border: none;

            border-bottom: 1px solid #dceafb;

            border-radius: 0;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding:
                0 28px;

            box-shadow: none;

            position: relative;
            z-index: 5;
        }


        .room-person {

            display: flex;

            align-items: center;

            gap: 13px;

            min-width: 0;
        }


        .room-person .avatar {

            width: 52px;

            height: 52px;
        }


        .room-person-info {

            min-width: 0;
        }


        .room-person-info h2 {

            margin:
                0 0 4px;

            font-family:
                Georgia, serif;

            font-size: 27px;

            font-weight: 400;

            color: #173456;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .online-text {

            font-size: 13px;

            color: #5c7895;
        }


        /* ==========================================================
           INFO BUTTON
        ========================================================== */

        .info-button {

            width: 48px;

            height: 48px;

            flex-shrink: 0;

            border: none;

            border-radius: 15px;

            background: #e9f4ff;

            color: #1674d1;

            display: flex;

            align-items: center;

            justify-content: center;

            text-decoration: none;

            font-size: 20px;

            transition: .2s ease;
        }


        .info-button:hover {

            background: #d7ebff;

            transform:
                translateY(-1px);

            cursor: pointer;
        }


        .info-menu {

            position: relative;
        }


        .info-menu summary {

            list-style: none;
        }


        .info-menu summary::-webkit-details-marker {

            display: none;
        }


        .info-menu-list {

            position: absolute;

            top: 56px;

            right: 0;

            z-index: 20;

            min-width: 170px;

            padding: 6px;

            border: 1px solid #dceafb;

            border-radius: 10px;

            background: #ffffff;

            box-shadow:
                0 8px 20px
                rgba(35, 101, 160, .16);
        }


        .info-menu-list form {

            margin: 0;
        }


        .info-menu-list button {

            width: 100%;

            padding:
                8px 10px;

            border: 0;

            background: transparent;

            color: #183153;

            text-align: left;

            font-size: 12px;

            cursor: pointer;
        }


        .info-menu-list button:hover {

            background: #eef7ff;
        }


        /* ==========================================================
           ACCOUNT INFO PANEL
        ========================================================== */

        .account-info-panel {

            position: fixed;

            right: 0;

            top: 0;

            width: 100%;

            height: 100%;

            background:
                rgba(0, 0, 0, 0.5);

            display: none;

            align-items: center;

            justify-content: flex-end;

            z-index: 1000;

            opacity: 0;

            transition:
                opacity 0.3s ease;
        }


        .account-info-panel.active {

            display: flex;

            opacity: 1;
        }


        .account-info-panel-content {

            background: white;

            width: 100%;

            max-width: 420px;

            height: 100%;

            overflow-y: auto;

            animation:
                slideInRight 0.3s ease;

            box-shadow:
                -10px 0 40px
                rgba(35, 101, 160, 0.15);
        }


        @keyframes slideInRight {

            from {

                transform:
                    translateX(100%);

                opacity: 0;
            }

            to {

                transform:
                    translateX(0);

                opacity: 1;
            }
        }


        .account-info-header {

            padding:
                28px 24px;

            border-bottom:
                1px solid #e4f0ff;

            display: flex;

            align-items: center;

            justify-content: space-between;
        }


        .account-info-header h3 {

            margin: 0;

            font-family:
                Georgia, serif;

            font-size: 22px;

            font-weight: 400;

            color: #173456;
        }


        .account-info-close {

            background: none;

            border: none;

            font-size: 24px;

            color: #5da5ed;

            cursor: pointer;

            padding: 0;

            width: 32px;

            height: 32px;

            display: flex;

            align-items: center;

            justify-content: center;

            transition: .2s ease;

            border-radius: 8px;
        }


        .account-info-close:hover {

            background: #f0f6ff;

            color: #1976d2;
        }


        .account-info-body {

            padding: 24px;
        }


        .account-profile-section {

            text-align: center;

            margin-bottom: 32px;

            padding-bottom: 28px;

            border-bottom:
                1px solid #e4f0ff;
        }


        .account-profile-avatar {

            width: 100px;

            height: 100px;

            margin:
                0 auto 18px;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #c8e5ff,
                    #9fd0fa
                );

            color: #1976d2;

            font-size: 42px;

            font-weight: 700;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow:
                0 8px 24px
                rgba(25, 118, 210, 0.18);
        }


        .account-profile-avatar img {

            width: 100%;

            height: 100%;

            border-radius: 50%;

            object-fit: cover;
        }


        .account-name {

            font-size: 20px;

            font-weight: 700;

            color: #173456;

            margin-bottom: 6px;
        }


        .account-username {

            font-size: 14px;

            color: #5c7895;

            margin-bottom: 12px;
        }


        .account-status {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            font-size: 13px;

            font-weight: 600;

            padding:
                6px 14px;

            border-radius: 20px;

            background: #f0f6ff;

            color: #1976d2;
        }


        .account-status.online {

            background:
                rgba(35, 190, 104, 0.12);

            color: #23be68;
        }


        .account-status.offline {

            background:
                rgba(102, 128, 155, 0.12);

            color: #668099;
        }


        .account-status-dot {

            width: 8px;

            height: 8px;

            border-radius: 50%;

            background: currentColor;
        }


        .account-info-item {

            margin-bottom: 20px;

            padding-bottom: 20px;

            border-bottom:
                1px solid #f0f6ff;
        }


        .account-info-item:last-child {

            border-bottom: none;

            margin-bottom: 0;

            padding-bottom: 0;
        }


        .account-info-label {

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;

            color: #7890a8;

            margin-bottom: 8px;

            letter-spacing: .5px;
        }


        .account-info-value {

            font-size: 14px;

            color: #183153;

            line-height: 1.5;

            word-break: break-word;
        }


        .account-info-value strong {

            color: #173456;

            font-weight: 700;
        }


        .account-booking-grid {

            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 14px;

            margin-bottom: 20px;
        }


        .account-booking-item {

            background: #f8fcff;

            padding:
                14px 12px;

            border-radius: 12px;

            border:
                1px solid #e4f0ff;

            text-align: center;
        }


        .account-booking-item-label {

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;

            color: #7890a8;

            margin-bottom: 6px;

            letter-spacing: .5px;
        }


        .account-booking-item-value {

            font-size: 18px;

            font-weight: 700;

            color: #1976d2;
        }


        /* ==========================================================
           SCHEDULE
           (Diubah: dari card ngambang jadi strip info rata,
           dipisah dengan garis tipis dari area pesan)
        ========================================================== */

        .schedule {

            flex-shrink: 0;

            margin: 0;

            padding:
                12px 24px;

            background:
                rgba(255, 255, 255, .85);

            border: none;

            border-bottom:
                1px solid #dceafb;

            border-radius: 0;

            color: #47739f;

            font-size: 13px;

            box-shadow: none;
        }


        .schedule strong {

            color: #234f7b;
        }


        /* ==========================================================
           MESSAGES
        ========================================================== */

        .messages {

            flex: 1;

            min-height: 0;

            overflow-y: auto;

            overflow-x: hidden;

            padding:
                25px 30px 30px;

            display: flex;

            flex-direction: column;

            gap: 18px;
        }


        .messages::-webkit-scrollbar {

            width: 7px;
        }


        .messages::-webkit-scrollbar-thumb {

            background:
                rgba(39, 120, 196, .35);

            border-radius: 10px;
        }


        /* ==========================================================
           BOOKING DIVIDER
        ========================================================== */

        .booking-divider {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 14px;

            margin:
                25px 0 5px;

            flex-shrink: 0;
        }


        .booking-divider-line {

            flex: 1;

            height: 1px;

            background:
                rgba(100, 120, 150, .20);
        }


        .booking-divider-content {

            display: flex;

            align-items: center;

            gap: 7px;

            padding:
                8px 14px;

            border-radius: 999px;

            background:
                rgba(255, 255, 255, .78);

            border:
                1px solid
                rgba(100, 120, 150, .14);

            box-shadow:
                0 4px 12px
                rgba(60, 80, 120, .05);

            white-space: nowrap;
        }


        .booking-divider-title {

            color: #71839a;

            font-size: 11px;

            font-weight: 600;
        }


        .booking-divider-time {

            color: #2467a8;

            font-size: 11px;

            font-weight: 700;
        }


        .booking-divider-status {

            color: #8b7890;

            font-size: 10px;

            font-weight: 600;
        }


        .empty-message-small {

            padding: 15px;

            text-align: center;

            color: #8190a3;

            font-size: 12px;
        }


        /* ==========================================================
           MESSAGE ROW — GAYA iMESSAGE / iPHONE
        ========================================================== */

        .message-row {
            display: flex;
            align-items: flex-end;
            width: 100%;
            max-width: 100%;
            flex-shrink: 0;
            padding: 0 8px;
        }

        .message-row.sent {
            align-self: flex-end;
            justify-content: flex-end;
        }

        .message-row.received {
            align-self: flex-start;
            justify-content: flex-start;
        }

        /* Tidak ada PP/avatar di dalam isi chat. PP hanya di header room. */
        .message-avatar {
            display: none !important;
        }

        .message-content {
            display: flex;
            flex-direction: column;
            min-width: 0;
            width: fit-content;
            max-width: min(72%, 620px);
        }

        .sender-name {
            display: none !important;
        }

        .message-bubble {
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 15px;
            line-height: 1.38;
            word-break: break-word;
            overflow-wrap: anywhere;
            box-shadow: none;
            border: none;
        }

        .message-row.received .message-bubble {
            background: #f1f2f6;
            color: #172033;
            border-bottom-left-radius: 6px;
        }

        .message-row.sent .message-bubble {
            background: #1683f7;
            color: #ffffff;
            border-bottom-right-radius: 6px;
            box-shadow: none;
        }

        .message-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 4px;
            margin-top: 3px;
            padding: 0 5px;
        }

        .message-time {
            font-size: 9px;
            color: rgba(67, 91, 118, .72);
        }

        .message-row.sent .message-time {
            color: rgba(67, 91, 118, .72);
        }

        .message-check {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            line-height: 1;
            font-weight: 700;
            letter-spacing: -3px;
            width: 17px;
            height: 13px;
            position: relative;
            margin-right: 1px;
        }

        .message-check.single { color: #7188a0; }
        .message-check.double { color: #1683f7; }

        /* Status hanya dipasang pada bubble terakhir dalam satu rangkaian. */
        .message-row.sent .message-check {
            margin-left: 2px;
            transform: translateY(-1px);
        }

        .messages {
            gap: 8px;
            padding: 18px 14px 22px;
        }

        .booking-divider {
            margin: 2px 0 10px;
            opacity: .85;
        }

        .booking-divider-line { display: none; }

        .booking-divider-content {
            justify-content: center;
            gap: 5px;
            border: 0;
            background: rgba(255,255,255,.72);
            border-radius: 999px;
            padding: 5px 11px;
            width: fit-content;
            margin: 0 auto;
        }

        .booking-divider-title { display: none; }

        .booking-divider-time,
        .booking-divider-status {
            font-size: 10px;
        }

        /* ==========================================================
           COMPOSER
           (Diubah: dari card ngambang jadi strip rata di bawah,
           nyatu dengan panel, dipisah garis tipis)
        ========================================================== */

        .composer {

            flex-shrink: 0;

            width: 100%;

            margin: 0;

            padding:
                15px 24px 20px;

            background: #ffffff;

            border: none;

            border-top:
                1px solid #dceafb;

            border-radius: 0;

            position: relative;
            z-index: 5;

            box-shadow: none;
        }


        .composer form {

            width: 100%;

            display: flex;

            align-items: flex-end;

            gap: 10px;
        }


        .composer textarea {

            flex: 1;

            width: 100%;

            min-width: 0;

            min-height: 50px;

            height: 50px;

            max-height: 130px;

            resize: vertical;

            border:
                1px solid #cfe2f6;

            border-radius: 16px;

            padding:
                14px 16px;

            outline: none;

            font-family:
                Arial, sans-serif;

            font-size: 14px;

            line-height: 1.4;

            color: #23466d;

            background: #f8fcff;
        }


        .composer textarea:focus {

            border-color: #4b9bed;

            box-shadow:
                0 0 0 3px
                rgba(75, 155, 237, .10);
        }


        .composer textarea::placeholder {

            color: #91a6bb;
        }


        .send-button {

            width: 55px;

            height: 50px;

            flex-shrink: 0;

            border: none;

            border-radius: 15px;

            background: #2386e8;

            color: white;

            font-size: 20px;

            cursor: pointer;

            box-shadow:
                0 7px 18px
                rgba(31, 124, 218, .25);

            transition: .2s ease;
        }


        .send-button:hover {

            background: #1475d2;

            transform:
                translateY(-1px);
        }


        .send-button:disabled {

            background: #a9c9e8;

            cursor: not-allowed;

            box-shadow: none;
        }


        /* ==========================================================
           CLOSED CHAT
        ========================================================== */

        .closed-composer {

            width: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding:
                13px;

            border-radius: 14px;

            background: #edf5fc;

            color: #54728f;

            font-size: 13px;

            text-align: center;
        }


        /* ==========================================================
           ⭐ RATING PREMIUM
        ========================================================== */

        .rating-wrapper {

            width: 100%;

            padding: 4px 0 0;
        }


        .rating-card {

            position: relative;

            width: 100%;

            padding:
                20px 22px 18px;

            border-radius: 22px;

            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    rgba(255,255,255,.98),
                    rgba(239,248,255,.98)
                );

            border:
                1px solid rgba(76,145,205,.20);

            box-shadow:
                0 12px 35px
                rgba(35,101,160,.13);
        }


        .rating-card::before {

            content: "";

            position: absolute;

            top: -70px;

            right: -45px;

            width: 170px;

            height: 170px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(93,165,237,.18),
                    transparent 68%
                );

            pointer-events: none;
        }


        .rating-card::after {

            content: "";

            position: absolute;

            bottom: -90px;

            left: -60px;

            width: 190px;

            height: 190px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(124,186,237,.13),
                    transparent 68%
                );

            pointer-events: none;
        }


        .rating-top {

            position: relative;

            z-index: 2;

            display: flex;

            align-items: center;

            gap: 13px;

            margin-bottom: 13px;
        }


        .rating-icon {

            width: 46px;

            height: 46px;

            flex-shrink: 0;

            border-radius: 15px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;

            background:
                linear-gradient(
                    135deg,
                    #e8f5ff,
                    #cfe9ff
                );

            box-shadow:
                inset 0 1px 0 rgba(255,255,255,.8),
                0 6px 18px
                rgba(44,126,198,.12);
        }


        .rating-heading {

            min-width: 0;
        }


        .rating-heading h3 {

            margin: 0 0 3px;

            color: #173456;

            font-family: Georgia, serif;

            font-size: 21px;

            font-weight: 400;
        }


        .rating-heading p {

            margin: 0;

            color: #69839c;

            font-size: 12px;

            line-height: 1.45;
        }


        .rating-stars {

            position: relative;

            z-index: 2;

            display: flex;

            justify-content: center;

            gap: 7px;

            margin:
                13px 0 11px;
        }


        .rating-star {

            width: 43px;

            height: 43px;

            border: none;

            border-radius: 13px;

            background: #f5faff;

            color: #b7c9da;

            font-size: 22px;

            cursor: pointer;

            display: flex;

            align-items: center;

            justify-content: center;

            transition:
                transform .18s ease,
                color .18s ease,
                background .18s ease,
                box-shadow .18s ease;
        }


        .rating-star:hover {

            transform:
                translateY(-3px)
                scale(1.04);

            color: #f0b429;

            background: #fff8df;

            box-shadow:
                0 7px 18px
                rgba(225,174,44,.16);
        }


        .rating-star.selected {

            color: #f0b429;

            background: #fff8df;

            box-shadow:
                0 7px 18px
                rgba(225,174,44,.16);
        }


        .rating-star.pop {

            animation:
                starPop .22s ease;
        }


        @keyframes starPop {

            0% {

                transform: scale(.82);
            }

            65% {

                transform: scale(1.15);
            }

            100% {

                transform: scale(1);
            }
        }


        .rating-label {

            position: relative;

            z-index: 2;

            text-align: center;

            min-height: 18px;

            color: #46749d;

            font-size: 12px;

            font-weight: 700;

            margin-bottom: 10px;
        }


        .rating-textarea {

            position: relative;

            z-index: 2;

            width: 100%;

            min-height: 65px;

            resize: vertical;

            border:
                1px solid #d7e8f8;

            border-radius: 14px;

            padding:
                12px 14px;

            outline: none;

            font-family: Arial, sans-serif;

            font-size: 13px;

            line-height: 1.45;

            color: #244968;

            background:
                rgba(255,255,255,.88);

            transition:
                .2s ease;
        }


        .rating-textarea:focus {

            border-color: #62a8e8;

            box-shadow:
                0 0 0 3px
                rgba(98,168,232,.10);
        }


        .rating-textarea::placeholder {

            color: #91a6bb;
        }


        .rating-submit {

            position: relative;

            z-index: 2;

            width: 100%;

            margin-top: 10px;

            height: 43px;

            border: none;

            border-radius: 13px;

            background:
                linear-gradient(
                    135deg,
                    #2587ed,
                    #1374d6
                );

            color: #ffffff;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 8px 20px
                rgba(31,124,218,.20);

            transition:
                .2s ease;
        }


        .rating-submit:hover {

            transform:
                translateY(-1px);

            box-shadow:
                0 10px 24px
                rgba(31,124,218,.28);
        }


        .rating-submit:disabled {

            background:
                #b9cfe4;

            cursor:
                not-allowed;

            box-shadow:
                none;

            transform:
                none;
        }


        .rating-completed {

            position: relative;

            z-index: 2;

            text-align: center;

            padding:
                7px 0 2px;

            color: #527693;

            font-size: 13px;
        }


        .rating-completed strong {

            display: block;

            color: #236da8;

            font-size: 14px;

            margin-bottom: 4px;
        }


        .rating-divider {

            height: 1px;

            width: 100%;

            margin:
                2px 0 12px;

            background:
                rgba(80,130,170,.12);
        }


        /* ==========================================================
           MODAL
        ========================================================== */

        .modal-overlay {

            position: fixed;

            inset: 0;

            z-index: 9999;

            background:
                rgba(14, 39, 65, .45);

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 20px;

            backdrop-filter: blur(4px);
        }


        .modal {

            width:
                min(420px, 100%);

            background: #ffffff;

            border-radius: 25px;

            padding: 30px;

            text-align: center;

            box-shadow:
                0 25px 70px
                rgba(19, 61, 98, .30);

            animation:
                popup .25s ease;
        }


        @keyframes popup {

            from {

                opacity: 0;

                transform:
                    translateY(15px)
                    scale(.96);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);
            }
        }


        .modal-icon {

            width: 65px;

            height: 65px;

            margin:
                0 auto 16px;

            border-radius: 50%;

            background: #e6f2ff;

            color: #1d7bd6;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 28px;
        }


        .modal h3 {

            margin:
                0 0 10px;

            font-family:
                Georgia, serif;

            font-size: 27px;

            font-weight: 400;

            color: #173456;
        }
        .modal p {

            margin: 0;

            color: #68819b;

            font-size: 14px;

            line-height: 1.6;
        }


        .modal-button {

            margin-top: 22px;

            border: none;

            background: #2386e8;

            color: white;

            padding:
                11px 24px;

            border-radius: 12px;

            cursor: pointer;

            font-weight: 700;
        }


        /* ==========================================================
           CHAT COUNTDOWN / EXPIRED STATE
        ========================================================== */
        .chat-countdown {
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            color: #6d88a2;
            font-size: 11px;
            font-weight: 600;
        }

        .chat-countdown-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #27ae60;
            box-shadow: 0 0 0 4px rgba(39,174,96,.10);
        }

        .chat-countdown.expired {
            color: #8b7890;
        }

        .chat-countdown.expired .chat-countdown-dot {
            background: #9aa8b5;
            box-shadow: none;
        }

        .rating-modal {
            text-align: center;
        }

        .rating-modal .rating-stars {
            justify-content: center;
            margin: 20px 0 8px;
        }

        .rating-modal .rating-textarea {
            width: 100%;
            margin-top: 14px;
        }

        .rating-modal .rating-submit {
            margin-top: 12px;
        }

        .rating-modal-overlay {
            z-index: 10000;
        }

        .rating-modal {
            position: relative;
            text-align: center;
        }

        .rating-close {
            position: absolute;
            top: 14px;
            right: 16px;
            width: 34px;
            height: 34px;
            border: none;
            background: transparent;
            color: rgba(255,255,255,.65);
            font-size: 28px;
            line-height: 1;
            cursor: pointer;
            transition: .2s ease;
            z-index: 2;
        }

        .rating-close:hover {
            color: #fff;
            transform: scale(1.1);
        }

        .thank-you-overlay {
            z-index: 11000;
            animation: thankYouFadeIn .35s ease forwards;
        }

        .thank-you-card {
            width: min(420px, calc(100vw - 40px));
            padding: 38px 30px 34px;
            text-align: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg, rgba(42,25,67,.98), rgba(15,9,28,.99));
            border: 1px solid rgba(218,185,108,.35);
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0,0,0,.55), 0 0 50px rgba(218,185,108,.12);
            animation: thankYouPop .55s cubic-bezier(.2,.8,.2,1) forwards;
        }

        .thank-you-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(218,185,108,.1);
            border: 1px solid rgba(218,185,108,.45);
            animation: thankYouIcon .7s ease forwards;
        }

        .thank-you-icon span {
            font-size: 38px;
            color: #daba6c;
            animation: thankYouStar .8s ease forwards;
        }

        .thank-you-card h3 {
            margin: 0 0 10px;
            font-family: "Playfair Display", serif;
            font-size: 29px;
            color: #fff;
            animation: thankYouText .6s .15s ease both;
        }

        .thank-you-card p {
            margin: 0;
            color: rgba(255,255,255,.68);
            font-size: 14px;
            line-height: 1.6;
            animation: thankYouText .6s .25s ease both;
        }

        @keyframes thankYouFadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes thankYouPop { from { opacity: 0; transform: scale(.82) translateY(15px); } to { opacity: 1; transform: scale(1) translateY(0); } }
        @keyframes thankYouIcon { from { transform: scale(.3) rotate(-25deg); opacity: 0; } 70% { transform: scale(1.12) rotate(5deg); } to { transform: scale(1) rotate(0); opacity: 1; } }
        @keyframes thankYouStar { from { transform: scale(0); opacity: 0; } 60% { transform: scale(1.25); } to { transform: scale(1); opacity: 1; } }
        @keyframes thankYouText { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

        /* ==========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 950px) {

            .chat-wrapper {

                width:
                    calc(100% - 30px);

                grid-template-columns:
                    290px minmax(0, 1fr);

                margin-top:
                    125px;
            }


            .message-row {

                max-width: 85%;
            }


            .account-info-panel-content {

                max-width: 360px;
            }

        }


        @media (max-width: 720px) {

            .chat-wrapper {

                width:
                    calc(100% - 20px);

                height:
                    calc(100vh - 140px);

                margin-top:
                    115px;

                grid-template-columns:
                    1fr;

                min-height:
                    600px;
            }


            .sidebar {

                display: none;
            }


            .room-header {

                padding:
                    0 18px;
            }


            .schedule {

                padding:
                    12px 18px;
            }


            .messages {

                padding:
                    20px 15px;
            }


            .composer {

                padding:
                    12px;
            }


            .message-row {

                max-width:
                    90%;
            }


            .booking-divider {

                gap:
                    7px;
            }


            .booking-divider-content {

                padding:
                    7px 10px;

                gap:
                    5px;
            }


            .booking-divider-title {

                display: none;
            }


            .room-person-info h2 {

                font-size:
                    22px;
            }


            .info-button {

                width:
                    42px;

                height:
                    42px;
            }


            .account-info-panel-content {

                max-width: 100%;
            }


            .rating-card {

                padding:
                    17px 14px 15px;
            }


            .rating-star {

                width: 38px;

                height: 38px;

                font-size: 19px;
            }


            .rating-stars {

                gap: 5px;
            }

        }


        /* ==========================================================
           WHATSAPP DESKTOP - FULL PANEL / NO FLOATING CARDS
        ========================================================== */
        body {
            overflow: hidden;
        }

        .chat-wrapper {
            width: 100%;
            max-width: none;
            height: calc(100vh - 82px);
            min-height: 0;
            margin: 0;
            border-radius: 0;
            box-shadow: none;
        }

        .sidebar,
        .room {
            border-radius: 0 !important;
        }

        .sidebar {
            border-right: 1px solid #dceafb;
        }

        .room-header,
        .schedule,
        .composer {
            border-radius: 0 !important;
        }

        .avatar img,
        .message-avatar img {
            width: 100%;
            height: 100%;
            display: block;
            border-radius: 50%;
            object-fit: cover;
        }

        .room-person .avatar {
            overflow: hidden;
        }

        @media (max-width: 700px) {
            body { overflow: auto; }
            .chat-wrapper {
                height: auto;
                min-height: 0;
            }
        }


        /* ==========================================================
           iMESSAGE OVERRIDE — PESAN TANPA FOTO PROFILE
        ========================================================== */
        .messages .message-row .message-avatar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .messages .message-row .sender-name {
            display: none !important;
        }

        .messages .message-row.sent .message-content,
        .messages .message-row.received .message-content {
            margin: 0;
        }

        @media (max-width: 700px) {
            .message-content { max-width: 82%; }
            .message-bubble {
                font-size: 15px;
                padding: 9px 14px;
            }
        }

    

        /* ==========================================================
           DARK iMESSAGE THEME
           ----------------------------------------------------------
           Room chat dibuat hitam seperti iPhone Messages.
           Bubble lawan = dark gray, bubble sendiri = iMessage blue.
        ========================================================== */

        html,
        body {
            background: #000000 !important;
            color: #f5f5f7 !important;
        }

        body {
            background-color: #000000 !important;
            background-image: none !important;
        }

        .chat-wrapper {
            background: #000000 !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .45) !important;
        }

        .sidebar {
            background: #050506 !important;
            border-right-color: #242428 !important;
        }

        .sidebar-header,
        .chat-list {
            background: #050506 !important;
        }

        .sidebar-title h1 {
            color: #f5f5f7 !important;
        }

        .search-box input {
            background: #17171b !important;
            border-color: #303036 !important;
            color: #f5f5f7 !important;
        }

        .search-box input::placeholder {
            color: #8e8e93 !important;
        }

        .search-icon,
        .filter {
            color: #a1a1a6 !important;
        }

        .filter:hover {
            background: #1c1c20 !important;
        }

        .filter.active {
            background: #1d3556 !important;
            color: #5eb0ff !important;
        }

        .chat-item {
            color: #f5f5f7 !important;
        }

        .chat-item:hover {
            background: #17171b !important;
        }

        .chat-item.active {
            background: #202a3d !important;
        }

        .chat-name {
            color: #f5f5f7 !important;
        }

        .chat-preview,
        .chat-time {
            color: #98989f !important;
        }

        .chat-item.unread .chat-name,
        .chat-item.unread .chat-preview {
            color: #5eb0ff !important;
        }

        .room {
            background: #000000 !important;
            background-image: none !important;
        }

        .room-header {
            background: #1c1c1e !important;
            border-bottom-color: #38383a !important;
            color: #f5f5f7 !important;
        }

        .room-person-info h2 {
            color: #f5f5f7 !important;
        }

        .online-text {
            color: #8e8e93 !important;
        }

        .info-button {
            background: #2c2c2e !important;
            color: #5eb0ff !important;
        }

        .schedule {
            background: #101012 !important;
            border-bottom-color: #2c2c2e !important;
            color: #8e8e93 !important;
        }

        .booking-divider-content {
            background: #1c1c1e !important;
            border-color: #38383a !important;
            box-shadow: none !important;
        }

        .booking-divider-title,
        .booking-divider-status {
            color: #98989f !important;
        }

        .booking-divider-time {
            color: #5eb0ff !important;
        }

        .messages {
            background: #000000 !important;
            background-image: none !important;
            scrollbar-color: #3a3a3c #000000;
        }

        .messages::-webkit-scrollbar-track {
            background: #000000;
        }

        .messages::-webkit-scrollbar-thumb {
            background: #3a3a3c !important;
        }

        .message-bubble {
            font-size: 16px !important;
            line-height: 1.3 !important;
            padding: 9px 14px !important;
            border-radius: 19px !important;
            box-shadow: none !important;
        }

        .message-row.received .message-bubble {
            background: #2c2c2e !important;
            color: #f5f5f7 !important;
            border-bottom-left-radius: 5px !important;
        }

        .message-row.sent .message-bubble {
            background: #0a84ff !important;
            color: #ffffff !important;
            border-bottom-right-radius: 5px !important;
        }

        .message-time {
            color: #8e8e93 !important;
        }

        .message-row.sent .message-time {
            color: #8e8e93 !important;
        }

        .message-check.single,
        .message-check.double {
            color: #5eb0ff !important;
        }

        .empty-message,
        .empty-message-small {
            color: #8e8e93 !important;
        }

        /* ==========================================================
           TYPING INDICATOR — tiga titik seperti iMessage
        ========================================================== */

        .typing-indicator {
            display: none;
            align-self: flex-start;
            align-items: center;
            gap: 4px;
            width: fit-content;
            min-width: 52px;
            height: 31px;
            padding: 7px 11px;
            margin: 0 0 2px 4px;
            border-radius: 17px;
            background: #2c2c2e;
            flex-shrink: 0;
        }

        .typing-indicator.active {
            display: flex;
        }

        /* ==========================================================
           TYPING DOCK — SLOT KHUSUS DI BAWAH AREA PESAN
           BUKAN overlay dan BUKAN bagian dari scroll pesan.
           Posisi dock selalu tepat di atas composer.
        ========================================================== */
        .room {
            position: relative !important;
        }

        .typing-dock {
            position: relative !important;
            flex: 0 0 30px !important;
            width: 100% !important;
            height: 30px !important;
            min-height: 30px !important;
            display: flex !important;
            align-items: flex-end !important;
            justify-content: flex-start !important;
            padding: 0 0 5px 14px !important;
            box-sizing: border-box !important;
            z-index: 6 !important;
            pointer-events: none !important;
            background: transparent !important;
        }

        .typing-dock .typing-indicator {
            position: static !important;
            margin: 0 !important;
            flex: 0 0 auto !important;
            pointer-events: none !important;
        }

        .typing-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #8e8e93;
            animation: whisperlyTyping 1.15s infinite ease-in-out;
        }

        .typing-dot:nth-child(2) {
            animation-delay: .15s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: .30s;
        }

        @keyframes whisperlyTyping {
            0%, 60%, 100% {
                transform: translateY(0);
                opacity: .45;
            }
            30% {
                transform: translateY(-4px);
                opacity: 1;
            }
        }

        /* Composer hitam seperti iMessage */
        .composer {
            background: #000000 !important;
            border-top-color: #242428 !important;
            color: #f5f5f7 !important;
        }

        .composer form {
            background: #000000 !important;
        }

        .composer textarea,
        #messageInput,
        .message-input-editor {
            background: #1c1c1e !important;
            border-color: #3a3a3c !important;
            color: #f5f5f7 !important;
            border-radius: 20px !important;
        }

        .composer textarea::placeholder,
        #messageInput::placeholder,
        .message-input-editor::placeholder {
            color: #8e8e93 !important;
        }

        .composer textarea:focus,
        #messageInput:focus,
        .message-input-editor:focus {
            border-color: #5eb0ff !important;
            box-shadow: 0 0 0 2px rgba(10, 132, 255, .18) !important;
        }

        .send-button {
            background: #0a84ff !important;
            color: #ffffff !important;
            border-radius: 50% !important;
        }

        .chat-countdown {
            color: #8e8e93 !important;
        }

        .chat-countdown-dot {
            background: #30d158 !important;
        }

        .closed-composer {
            background: #1c1c1e !important;
            color: #98989f !important;
        }

        @media (max-width: 700px) {
            .message-content {
                max-width: 82% !important;
            }

            .message-bubble {
                font-size: 16px !important;
            }
        }


        /* ==========================================================
           iMESSAGE ENHANCEMENTS — DARK / LIGHT + ACTIONS
        ========================================================== */
        :root {
            --im-bg: #000000;
            --im-surface: #1c1c1e;
            --im-surface-2: #2c2c2e;
            --im-text: #f5f5f7;
            --im-muted: #8e8e93;
            --im-blue: #0a84ff;
            --im-blue-soft: #5eb0ff;
            --im-divider: #2c2c2e;
        }

        body.theme-dark {
            background: #000 !important;
            color: var(--im-text) !important;
        }

        body.theme-dark .chat-wrapper,
        body.theme-dark .room,
        body.theme-dark .messages,
        body.theme-dark .composer {
            background: var(--im-bg) !important;
            color: var(--im-text) !important;
        }

        body.theme-dark .sidebar {
            background: #0b0b0d !important;
            border-right-color: #2c2c2e !important;
        }

        body.theme-dark .sidebar-header,
        body.theme-dark .chat-list,
        body.theme-dark .chat-item,
        body.theme-dark .chat-search,
        body.theme-dark .room-header {
            background: #0b0b0d !important;
            color: var(--im-text) !important;
        }

        body.theme-dark .chat-item:hover { background: #1c1c1e !important; }
        body.theme-dark .chat-item.active { background: #1c1c1e !important; }
        body.theme-dark .sidebar-title,
        body.theme-dark .chat-name,
        body.theme-dark .chat-preview,
        body.theme-dark .chat-time,
        body.theme-dark .room-person-info h2 { color: var(--im-text) !important; }

        body.theme-dark .search-input,
        body.theme-dark .composer textarea,
        body.theme-dark #messageInput {
            background: #1c1c1e !important;
            color: #fff !important;
            border-color: #3a3a3c !important;
        }

        body.theme-dark .room-header { border-bottom-color: #2c2c2e !important; }
        body.theme-dark .booking-divider-content { background: #1c1c1e !important; }
        body.theme-dark .booking-divider { color: #8e8e93 !important; }

        body.theme-light {
            background: #f2f2f7 !important;
            color: #111 !important;
        }

        body.theme-light .chat-wrapper,
        body.theme-light .room,
        body.theme-light .messages,
        body.theme-light .composer {
            background: #fff !important;
            color: #111 !important;
        }

        body.theme-light .sidebar,
        body.theme-light .sidebar-header,
        body.theme-light .chat-list,
        body.theme-light .chat-item,
        body.theme-light .room-header {
            background: #fff !important;
            color: #111 !important;
        }

        body.theme-light .chat-item:hover { background: #f2f2f7 !important; }
        body.theme-light .chat-item.active { background: #dceeff !important; }
        body.theme-light .sidebar-title,
        body.theme-light .chat-name,
        body.theme-light .chat-preview,
        body.theme-light .chat-time,
        body.theme-light .room-person-info h2 { color: #111 !important; }

        body.theme-light .messages {
            background: #fff !important;
            background-image: none !important;
            scrollbar-color: #c7c7cc #fff;
        }

        body.theme-light .composer { border-top-color: #d1d1d6 !important; }
        body.theme-light .composer textarea,
        body.theme-light #messageInput {
            background: #f2f2f7 !important;
            color: #111 !important;
            border-color: #c7c7cc !important;
        }
        body.theme-light .typing-indicator { background: #e5e5ea !important; }
        body.theme-light .typing-dot { background: #636366 !important; }
        body.theme-light .message-row.received .message-bubble {
            background: #e5e5ea !important;
            color: #111 !important;
        }
        body.theme-light .message-time { color: #8e8e93 !important; }

        .theme-toggle-button,
        .emoji-button {
            border: 0;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #1c1c1e;
            color: #fff;
            font-size: 19px;
            flex: 0 0 auto;
        }

        .theme-toggle-button:hover,
        .emoji-button:hover { background: #2c2c2e; }

        .composer form { position: relative; }
        .composer-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
        }
        .composer-controls #messageInput { flex: 1 1 auto; min-width: 0; }

        /* FOTO / ATTACHMENT */
        .attachment-button { width: 40px; height: 40px; flex: 0 0 auto; border: 0; border-radius: 50%; background: #1c1c1e; color: #fff; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; font-size: 25px; }
        .attachment-button:hover { background: #2c2c2e; }
        .attachment-input { display: none; }
        .image-preview { display: none; position: relative; width: min(100%, 520px); margin: 0 0 8px; padding: 8px; border-radius: 18px; background: #1c1c1e; border: 1px solid #3a3a3c; }
        .image-preview.active { display: block; }
        .image-preview img { display: block; width: 100%; max-height: 300px; object-fit: contain; border-radius: 13px; background: #000; }
        .image-preview-remove { position: absolute; top: 14px; right: 14px; width: 30px; height: 30px; border: 0; border-radius: 50%; background: rgba(70,70,73,.9); color: #fff; font-size: 22px; line-height: 1; cursor: pointer; }
        .message-image { display: block; width: min(100%, 360px); max-height: 430px; object-fit: cover; border-radius: 15px; cursor: pointer; }

        /* Foto + teks: bubble mengikuti isi, tanpa ruang kosong di kanan. */
        .message-bubble {
            width: fit-content;
            max-width: 100%;
        }

        /* Beri jarak yang jelas antara foto dan caption/pesan. */
        .message-bubble .message-image + .message-text {
            margin-top: 11px;
            padding: 0 6px 4px;
        }

        .message-bubble.image-only { padding: 4px !important; overflow: hidden; }
        .message-bubble.image-only .message-image { border-radius: 16px; }
        body.theme-light .attachment-button { background: #e5e5ea; color: #111; }
        body.theme-light .attachment-button:hover { background: #d1d1d6; }
        body.theme-light .image-preview { background: #f2f2f7; border-color: #d1d1d6; }

        .emoji-picker {
            position: absolute;
            left: 14px;
            bottom: 72px;
            z-index: 1000;
            width: min(360px, calc(100vw - 28px));
            max-height: 310px;
            padding: 12px;
            border: 1px solid #3a3a3c;
            border-radius: 20px;
            background: rgba(28,28,30,.98);
            box-shadow: 0 14px 40px rgba(0,0,0,.5);
            display: none;
            grid-template-columns: repeat(6, 1fr);
            gap: 6px;
            overflow-y: auto;
            overscroll-behavior: contain;
            scrollbar-width: thin;
        }

        .emoji-picker.open {
            display: grid;
        }

        .emoji-picker button.custom-emoji-option {
            width: 50px;
            height: 50px;
            border: 0;
            border-radius: 12px;
            background: transparent;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .15s ease, transform .15s ease;
        }

        .emoji-picker button.custom-emoji-option img {
            width: 42px;
            height: 42px;
            object-fit: contain;
            display: block;
            pointer-events: none;
            user-select: none;
        }

        .emoji-picker button.custom-emoji-option:hover {
            background: #3a3a3c;
            transform: scale(1.08);
        }

        .emoji-picker button.custom-emoji-option:active {
            transform: scale(.92);
        }

        .emoji-picker::-webkit-scrollbar {
            width: 6px;
        }

        .emoji-picker::-webkit-scrollbar-thumb {
            background: rgba(142,142,147,.45);
            border-radius: 10px;
        }

        /* ==========================================================
           INPUT PESAN BERGAMBAR
           Contenteditable dipakai supaya gambar emoji benar-benar
           terlihat DI DALAM kotak chat, bukan hanya Unicode.
        ========================================================== */
        .message-input-editor {
            flex: 1 1 auto;
            min-width: 0;
            min-height: 50px;
            max-height: 130px;
            overflow-y: auto;
            border: 1px solid #cfe2f6;
            border-radius: 20px;
            padding: 10px 16px;
            outline: none;
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
            color: #23466d;
            background: #f8fcff;
            word-break: break-word;
            white-space: pre-wrap;
            cursor: text;
        }

        .message-input-editor:focus {
            border-color: #4b9bed;
            box-shadow: 0 0 0 3px rgba(75,155,237,.10);
        }

        .message-input-editor:empty::before {
            content: attr(data-placeholder);
            color: #91a6bb;
            pointer-events: none;
        }

        .message-input-editor img.custom-emoji-inline {
            width: 30px;
            height: 30px;
            object-fit: contain;
            vertical-align: middle;
            display: inline-block;
            margin: 0 1px;
            user-select: none;
        }

        .composer-controls #messageInput {
            flex: 1 1 auto;
            min-width: 0;
        }

        body.theme-dark .message-input-editor {
            background: #1c1c1e !important;
            color: #fff !important;
            border-color: #3a3a3c !important;
        }

        body.theme-dark .message-input-editor:focus {
            border-color: #5eb0ff !important;
            box-shadow: 0 0 0 2px rgba(10,132,255,.18) !important;
        }

        body.theme-dark .message-input-editor:empty::before {
            color: #8e8e93 !important;
        }

        body.theme-light .message-input-editor {
            background: #f2f2f7 !important;
            color: #111 !important;
            border-color: #c7c7cc !important;
        }

        body.theme-light .message-input-editor:empty::before {
            color: #8e8e93 !important;
        }


        .message-text .message-custom-emoji {
            width: 34px;
            height: 34px;
            object-fit: contain;
            vertical-align: middle;
            display: inline-block;
            margin: -2px 1px;
        }

        .message-text:has(.message-custom-emoji) {
            line-height: 1.5;
        }
        @media (max-width: 700px) {
            .emoji-picker {
                left: 8px;
                bottom: 70px;
                width: min(340px, calc(100vw - 16px));
                grid-template-columns: repeat(6, 1fr);
                max-height: 280px;
            }

            .emoji-picker button.custom-emoji-option {
                width: 46px;
                height: 46px;
            }

            .emoji-picker button.custom-emoji-option img {
                width: 38px;
                height: 38px;
            }
        }

        .reply-preview {
            display: none;
            align-items: center;
            gap: 10px;
            margin: 0 0 8px;
            padding: 8px 10px;
            border-left: 3px solid var(--im-blue);
            border-radius: 8px;
            background: #1c1c1e;
            color: #f5f5f7;
        }
        .reply-preview.active { display: flex; }
        .reply-preview-text { flex: 1; min-width: 0; }
        .reply-preview-label { font-size: 11px; color: #5eb0ff; font-weight: 700; }
        .reply-preview-quote { font-size: 12px; color: #c7c7cc; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .reply-cancel { border: 0; background: transparent; color: #8e8e93; cursor: pointer; font-size: 20px; }

        .message-content { position: relative; }
        .message-bubble { cursor: pointer; user-select: text; }
        .message-reply-quote {
            margin: -3px 0 7px;
            padding: 6px 9px;
            border-left: 3px solid rgba(255,255,255,.55);
            border-radius: 6px;
            background: rgba(0,0,0,.18);
            font-size: 12px;
            line-height: 1.25;
            color: rgba(255,255,255,.78);
        }
        .received .message-reply-quote { border-left-color: #0a84ff; color: #b9dfff; }

        .message-reaction {
            position: absolute;
            bottom: -12px;
            left: 8px;
            min-width: 25px;
            height: 25px;
            padding: 2px 6px;
            display: none;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: #3a3a3c;
            border: 2px solid #000;
            font-size: 14px;
            z-index: 5;
        }
        .message-row.sent .message-reaction { left: auto; right: 8px; }
        .message-reaction.active { display: flex; }

        .message-action-sheet {
            position: fixed;
            z-index: 3000;
            width: min(340px, calc(100vw - 24px));
            border-radius: 16px;
            overflow: hidden;
            background: rgba(28,28,30,.98);
            border: 1px solid #3a3a3c;
            box-shadow: 0 18px 50px rgba(0,0,0,.6);
            backdrop-filter: blur(20px);
        }
        .reaction-row {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 8px 7px;
            border-bottom: 1px solid #3a3a3c;
        }
        .reaction-choice {
            border: 0;
            background: transparent;
            cursor: pointer;
            font-size: 25px;
            padding: 3px 5px;
            border-radius: 9px;
        }
        .reaction-choice:hover { background: #3a3a3c; transform: scale(1.1); }
        .message-action {
            width: 100%;
            border: 0;
            border-bottom: 1px solid #3a3a3c;
            background: #1c1c1e;
            color: #f5f5f7;
            text-align: left;
            padding: 12px 15px;
            font-size: 14px;
            cursor: pointer;
        }
        .message-action:last-child { border-bottom: 0; }
        .message-action:hover { background: #2c2c2e; }

        body.theme-light .theme-toggle-button,
        body.theme-light .emoji-button { background: #e5e5ea; color: #111; }
        body.theme-light .emoji-picker,
        body.theme-light .message-action-sheet { background: rgba(255,255,255,.98); border-color: #c7c7cc; }
        body.theme-light .reaction-row,
        body.theme-light .message-action { border-color: #d1d1d6; }
        body.theme-light .message-action { background: #fff; color: #111; }
        body.theme-light .message-action:hover,
        body.theme-light .reaction-choice:hover,
        body.theme-light .emoji-picker button:hover { background: #f2f2f7; }
        body.theme-light .message-reaction { border-color: #fff; background: #e5e5ea; }

        @media (max-width: 700px) {
            .theme-toggle-button { width: 36px; height: 36px; }
            .emoji-button { width: 38px; height: 38px; }
            .composer-controls { gap: 5px; }
            .message-content { max-width: 84% !important; }
        }


        /* ==========================================================
           iMESSAGE LONG-PRESS / DOUBLE-CLICK OVERLAY
           Pesan terpilih dibuat benar-benar "mengambang" di atas chat.
        ========================================================== */
        .message-focus-backdrop {
            position: fixed;
            inset: 0;
            z-index: 3998;
            background: rgba(0,0,0,.62);
            backdrop-filter: blur(7px);
            -webkit-backdrop-filter: blur(7px);
        }

        .message-focus-stage {
            position: fixed;
            z-index: 3999;
            left: 0;
            top: 0;
            width: min(92vw, 430px);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            pointer-events: none;
        }

        /* Saat pesan dipilih, bubble + menu mengikuti posisi pesan asal. */
        .message-focus-stage .message-focus-card {
            width: 100%;
            display: flex;
        }

        .message-focus-reaction-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }
        .message-focus-reaction-hint {
            color: #f5f5f7;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            text-shadow: 0 1px 3px rgba(0,0,0,.4);
        }
        .message-focus-reactions {
            display: flex;
            align-items: center;
            gap: 3px;
            padding: 7px 10px;
            border-radius: 999px;
            background: rgba(44,44,46,.98);
            box-shadow: 0 10px 30px rgba(0,0,0,.45);
            border: 1px solid rgba(255,255,255,.08);
            pointer-events: auto;
        }

        .message-focus-reaction {
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 50%;
            background: transparent;
            font-size: 24px;
            cursor: pointer;
            transition: transform .14s ease, background .14s ease;
        }
        .message-focus-reaction:hover {
            transform: scale(1.15);
            background: rgba(255,255,255,.09);
        }
        .message-focus-reaction-more {
            font-size: 29px;
            color: #f5f5f7;
        }

        .message-focus-card {
            width: 100%;
            display: flex;
            justify-content: center;
            pointer-events: none;
        }

        .message-focus-row {
            width: auto !important;
            max-width: 88% !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex !important;
            pointer-events: none;
        }
        .message-focus-row.sent { justify-content: flex-end !important; align-self: flex-end !important; }
        .message-focus-row.received { justify-content: flex-start !important; align-self: flex-start !important; }
        .message-focus-row .message-content {
            max-width: 100% !important;
            width: auto !important;
        }
        .message-focus-row .message-bubble {
            font-size: 17px !important;
            line-height: 1.34 !important;
            padding: 11px 16px !important;
            box-shadow: 0 12px 35px rgba(0,0,0,.45) !important;
        }
        .message-focus-row .message-footer { margin-top: 4px !important; }
        .message-focus-row .message-reaction { display: none !important; }

        .message-focus-actions {
            width: min(300px, 82vw);
            overflow: hidden;
            border-radius: 14px;
            background: rgba(44,44,46,.98);
            border: 1px solid rgba(255,255,255,.08);
            box-shadow: 0 15px 45px rgba(0,0,0,.5);
            pointer-events: auto;
        }
        .message-focus-action {
            width: 100%;
            min-height: 48px;
            padding: 0 18px;
            border: 0;
            border-bottom: 1px solid rgba(255,255,255,.12);
            background: transparent;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 16px;
            text-align: left;
            cursor: pointer;
        }
        .message-focus-action:last-child { border-bottom: 0; }
        .message-focus-action:hover { background: rgba(255,255,255,.08); }
        .message-focus-action.delete { color: #ff375f; }
        .message-focus-action-icon { font-size: 18px; opacity: .9; }

        body.theme-light .message-focus-backdrop { background: rgba(0,0,0,.22); }
        body.theme-light .message-focus-reactions,
        body.theme-light .message-focus-actions {
            background: rgba(255,255,255,.98);
            border-color: #d1d1d6;
        }
        body.theme-light .message-focus-reaction-more { color: #111; }
        body.theme-light .message-focus-action {
            color: #111;
            border-bottom-color: #d1d1d6;
        }
        body.theme-light .message-focus-action:hover { background: #f2f2f7; }
        body.theme-light .message-focus-action.delete { color: #ff375f; }

        .message-row.message-selected-original {
            opacity: 0 !important;
            pointer-events: none !important;
        }

        /* ==========================================================
           FINAL THEME FIX
           Mode terang benar-benar terang, tanpa panel hitam.
           Tombol tema berada di menu ☰, bukan di header.
        ========================================================== */

        .theme-menu-item {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        body.theme-light,
        body.theme-light .navbar-wrapper,
        body.theme-light .chat-wrapper,
        body.theme-light .sidebar,
        body.theme-light .sidebar-header,
        body.theme-light .chat-list,
        body.theme-light .room,
        body.theme-light .room-header,
        body.theme-light .messages,
        body.theme-light .composer {
            background: #ffffff !important;
            background-image: none !important;
            color: #111111 !important;
        }

        body.theme-light .sidebar {
            border-right-color: #e5e5ea !important;
        }

        body.theme-light .room-header {
            border-bottom-color: #e5e5ea !important;
        }

        body.theme-light .schedule {
            background: #f8f8fa !important;
            border-bottom-color: #e5e5ea !important;
            color: #636366 !important;
        }

        body.theme-light .booking-divider-content {
            background: #f2f2f7 !important;
            border-color: #d1d1d6 !important;
        }

        body.theme-light .booking-divider-time {
            color: #007aff !important;
        }

        body.theme-light .booking-divider-status,
        body.theme-light .online-text,
        body.theme-light .message-time {
            color: #8e8e93 !important;
        }

        body.theme-light .sidebar-title h1,
        body.theme-light .room-person-info h2,
        body.theme-light .chat-name {
            color: #111111 !important;
        }

        body.theme-light .chat-preview,
        body.theme-light .chat-time {
            color: #636366 !important;
        }

        body.theme-light .search-box input,
        body.theme-light .composer textarea,
        body.theme-light #messageInput {
            background: #f2f2f7 !important;
            color: #111111 !important;
            border-color: #d1d1d6 !important;
        }

        body.theme-light .search-box input::placeholder,
        body.theme-light #messageInput::placeholder {
            color: #8e8e93 !important;
        }

        body.theme-light .chat-item:hover {
            background: #f2f2f7 !important;
        }

        body.theme-light .chat-item.active {
            background: #dceeff !important;
        }

        body.theme-light .message-row.received .message-bubble {
            background: #e5e5ea !important;
            color: #111111 !important;
        }

        body.theme-light .message-row.sent .message-bubble {
            background: #007aff !important;
            color: #ffffff !important;
        }

        body.theme-light .typing-indicator {
            background: #e5e5ea !important;
        }

        body.theme-light .typing-dot {
            background: #636366 !important;
        }

        /* FINAL TYPING DOCK: tetap menjadi baris tersendiri di atas composer */
        .room .typing-dock {
            position: relative !important;
            bottom: auto !important;
            left: auto !important;
            right: auto !important;
            height: 30px !important;
            min-height: 30px !important;
            flex: 0 0 30px !important;
        }

        body.theme-light .info-button {
            background: #f2f2f7 !important;
            color: #007aff !important;
        }

        body.theme-light .info-menu-list {
            background: #ffffff !important;
            border-color: #d1d1d6 !important;
            box-shadow: 0 8px 25px rgba(0,0,0,.12) !important;
        }

        body.theme-light .info-menu-list button {
            color: #111111 !important;
        }

        body.theme-light .info-menu-list button:hover {
            background: #f2f2f7 !important;
        }

        body.theme-light .composer {
            border-top-color: #d1d1d6 !important;
        }

        body.theme-light .send-button {
            background: #007aff !important;
            color: #ffffff !important;
        }

        body.theme-light .emoji-button {
            background: #e5e5ea !important;
            color: #111111 !important;
        }

        body.theme-light .emoji-picker {
            background: #ffffff !important;
            border-color: #d1d1d6 !important;
        }

        body.theme-light .message-focus-backdrop {
            background: rgba(0,0,0,.28) !important;
            backdrop-filter: blur(7px);
        }

        body.theme-light .message-focus-reaction-hint {
            color: #ffffff !important;
        }

        body.theme-light .message-focus-reactions,
        body.theme-light .message-focus-actions {
            background: rgba(255,255,255,.98) !important;
            border-color: #d1d1d6 !important;
            color: #111111 !important;
        }

        body.theme-light .message-focus-action {
            background: #ffffff !important;
            color: #111111 !important;
            border-bottom-color: #d1d1d6 !important;
        }

        body.theme-light .message-focus-action:hover {
            background: #f2f2f7 !important;
        }

        body.theme-light .message-focus-action.delete {
            color: #ff375f !important;
        }

        /* Navbar partial: paksa permukaan navigasi ikut tema halaman. */
        body.theme-light .navbar-wrapper {
            background: #ffffff !important;
            color: #111111 !important;
        }

        /* Navbar ikut terang juga, termasuk dropdown menu global. */
        body.theme-light .whisperly-nav {
            background: rgba(255,255,255,.96) !important;
            border-bottom-color: #e5e5ea !important;
            box-shadow: 0 8px 24px rgba(0,0,0,.08) !important;
            color: #111111 !important;
        }

        body.theme-light .whisperly-brand {
            color: #111111 !important;
        }

        body.theme-light .whisperly-username {
            color: #111111 !important;
        }

        body.theme-light .whisperly-user-role {
            color: #8e8e93 !important;
        }

        body.theme-light .whisperly-user-pill {
            background: #f2f2f7 !important;
            border-color: #d1d1d6 !important;
        }

        body.theme-light .whisperly-menu-button {
            background: #f2f2f7 !important;
            border-color: #d1d1d6 !important;
            color: #111111 !important;
        }

        body.theme-light .whisperly-dropdown {
            background: rgba(255,255,255,.99) !important;
            border-color: #d1d1d6 !important;
            box-shadow: 0 20px 55px rgba(0,0,0,.16) !important;
        }

        body.theme-light .whisperly-dropdown-item {
            color: #111111 !important;
        }

        body.theme-light .whisperly-dropdown-item:hover {
            background: #f2f2f7 !important;
        }

        body.theme-light .whisperly-dropdown-text strong {
            color: #111111 !important;
        }

        body.theme-light .whisperly-dropdown-text small {
            color: #8e8e93 !important;
        }

        body.theme-light .whisperly-dropdown-icon {
            background: #f2f2f7 !important;
            border-color: #d1d1d6 !important;
            color: #007aff !important;
        }

        body.theme-light .whisperly-divider {
            background: #e5e5ea !important;
        }

        body.theme-light .whisperly-logout {
            color: #ff375f !important;
        }

        body.theme-light .navbar-wrapper * {
            border-color: #e5e5ea !important;
        }

        @media (max-width: 700px) {
            .message-focus-stage {
                width: min(94vw, 390px);
            }
        }

    
        /* ==========================================================
           FIX BUBBLE FOTO — JANGAN STRETCH KE LEBAR ROOM
           Bubble harus mengikuti ukuran foto/teks yang sebenarnya.
        ========================================================== */
        .messages .message-row .message-content {
            align-items: flex-start !important;
        }

        .messages .message-row .message-bubble {
            width: fit-content !important;
            max-width: min(360px, 100%) !important;
            align-self: flex-start !important;
        }

        .messages .message-row.sent .message-bubble {
            align-self: flex-end !important;
        }

        .messages .message-row .message-bubble .message-image {
            display: block !important;
            width: 100% !important;
            max-width: 360px !important;
            height: auto !important;
            max-height: 430px !important;
            object-fit: cover !important;
        }

        .messages .message-row .message-bubble .message-image + .message-text {
            margin-top: 16px !important;
            padding: 0 2px 3px !important;
        }



        /* ==========================================================
           iOS / iMESSAGE POLISH — POPUP + THEME MENU
           - Popup translucent, mengikuti tema
           - Sudut lembut, tidak kotak
           - Muncul smooth seperti iPhone
           - Menu info tetap gelap walaupun halaman sedang terang
           - Label tema hanya menunjukkan aksi berikutnya: Terang/Gelap
        ========================================================== */
        .message-focus-backdrop {
            background: rgba(0, 0, 0, .46) !important;
            backdrop-filter: blur(12px) saturate(115%) !important;
            -webkit-backdrop-filter: blur(12px) saturate(115%) !important;
            animation: whisperlyBackdropIn .22s ease-out both;
        }

        .message-focus-stage {
            gap: 11px !important;
            pointer-events: none;
        }

        .message-focus-reaction-wrap,
        .message-focus-card,
        .message-focus-actions {
            animation: whisperlyPopupIn .28s cubic-bezier(.22, 1, .36, 1) both;
        }

        .message-focus-reactions,
        .message-focus-actions {
            background: rgba(38, 38, 40, .72) !important;
            border: 1px solid rgba(255, 255, 255, .13) !important;
            box-shadow:
                0 18px 50px rgba(0, 0, 0, .32),
                inset 0 1px 0 rgba(255, 255, 255, .06) !important;
            backdrop-filter: blur(24px) saturate(145%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(145%) !important;
            border-radius: 20px !important;
        }

        .message-focus-reactions {
            padding: 7px 9px !important;
        }

        .message-focus-actions {
            overflow: hidden;
        }

        .message-focus-action {
            min-height: 49px !important;
            background: transparent !important;
            border-bottom-color: rgba(255, 255, 255, .10) !important;
            transition: background .16s ease, transform .16s ease;
        }

        .message-focus-action:hover {
            background: rgba(255, 255, 255, .09) !important;
        }

        .message-focus-action:active {
            background: rgba(255, 255, 255, .14) !important;
            transform: scale(.985);
        }

        /* Saat halaman terang, popup tetap terang/transparan dan teks gelap. */
        body.theme-light .message-focus-backdrop {
            background: rgba(0, 0, 0, .25) !important;
            backdrop-filter: blur(12px) saturate(110%) !important;
            -webkit-backdrop-filter: blur(12px) saturate(110%) !important;
        }

        body.theme-light .message-focus-reactions,
        body.theme-light .message-focus-actions {
            background: rgba(255, 255, 255, .68) !important;
            border-color: rgba(0, 0, 0, .10) !important;
            box-shadow:
                0 18px 50px rgba(0, 0, 0, .18),
                inset 0 1px 0 rgba(255, 255, 255, .72) !important;
            backdrop-filter: blur(24px) saturate(145%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(145%) !important;
        }

        body.theme-light .message-focus-action {
            color: #111 !important;
            border-bottom-color: rgba(0, 0, 0, .08) !important;
        }

        body.theme-light .message-focus-action:hover {
            background: rgba(0, 0, 0, .055) !important;
        }

        body.theme-light .message-focus-action:active {
            background: rgba(0, 0, 0, .09) !important;
        }

        /* Info menu: selalu glass gelap ala iOS, termasuk saat halaman terang. */
        .info-menu-list {
            border-radius: 18px !important;
            background: rgba(36, 36, 38, .82) !important;
            border: 1px solid rgba(255, 255, 255, .12) !important;
            box-shadow:
                0 18px 45px rgba(0, 0, 0, .28),
                inset 0 1px 0 rgba(255, 255, 255, .06) !important;
            backdrop-filter: blur(24px) saturate(140%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(140%) !important;
        }

        .info-menu-list button {
            color: #fff !important;
        }

        .info-menu-list button:hover {
            background: rgba(255, 255, 255, .09) !important;
        }

        body.theme-light .info-menu-list {
            background: rgba(36, 36, 38, .84) !important;
            border-color: rgba(255, 255, 255, .12) !important;
            box-shadow: 0 18px 45px rgba(0, 0, 0, .25) !important;
        }

        body.theme-light .info-menu-list button {
            color: #fff !important;
        }

        body.theme-light .info-menu-list button:hover {
            background: rgba(255, 255, 255, .10) !important;
        }

        .theme-menu-item #themeMenuIcon {
            opacity: .9;
            transition: transform .25s ease;
        }

        .theme-menu-item:active #themeMenuIcon {
            transform: rotate(15deg) scale(.92);
        }

        @keyframes whisperlyBackdropIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes whisperlyPopupIn {
            from {
                opacity: 0;
                transform: translateY(10px) scale(.94);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .message-focus-backdrop,
            .message-focus-reaction-wrap,
            .message-focus-card,
            .message-focus-actions {
                animation: none !important;
            }
        }


        /* ==========================================================
           FINAL iOS GLASS + CHAT THEME OVERRIDES
           - light mode benar-benar tanpa strip/panel hitam
           - info menu tetap gelap
           - popup double-click tetap di sisi chat dan muncul di bawahnya
        ========================================================== */

        /* LIGHT: jangan biarkan closed-composer mewarisi hitam dari dark CSS */
        body.theme-light .closed-composer {
            background: rgba(242, 242, 247, .92) !important;
            color: #636366 !important;
            border: 1px solid rgba(60, 60, 67, .12) !important;
            box-shadow: none !important;
        }

        body.theme-light .composer,
        body.theme-light .composer form {
            background: #ffffff !important;
            color: #111111 !important;
        }

        body.theme-light .messages,
        body.theme-light .room,
        body.theme-light .chat-wrapper {
            background: #ffffff !important;
        }

        /* Popup glass: transparan, lembut, tidak terlalu kotak */
        .message-focus-backdrop {
            background: rgba(0, 0, 0, .30) !important;
            backdrop-filter: blur(10px) saturate(115%) !important;
            -webkit-backdrop-filter: blur(10px) saturate(115%) !important;
            opacity: 0;
            animation: focusBackdropIn .20s ease-out forwards;
        }

        .message-focus-stage {
            width: max-content !important;
            max-width: min(340px, calc(100vw - 20px)) !important;
            align-items: stretch !important;
            gap: 8px !important;
            opacity: 0;
            transform: translateY(-5px) scale(.97);
            transform-origin: top center;
            animation: focusStageIn .24s cubic-bezier(.22, .8, .24, 1) forwards;
        }

        .message-focus-stage.focus-align-sent {
            align-items: flex-end !important;
        }

        .message-focus-stage.focus-align-received {
            align-items: flex-start !important;
        }

        .message-focus-stage .message-focus-card {
            width: auto !important;
            max-width: min(340px, calc(100vw - 20px)) !important;
            display: flex !important;
        }

        .message-focus-stage.focus-align-sent .message-focus-card {
            justify-content: flex-end !important;
        }

        .message-focus-stage.focus-align-received .message-focus-card {
            justify-content: flex-start !important;
        }

        .message-focus-stage .message-focus-row {
            width: auto !important;
            max-width: min(340px, calc(100vw - 20px)) !important;
        }

        .message-focus-stage .message-focus-actions {
            width: min(300px, calc(100vw - 28px)) !important;
            border-radius: 17px !important;
            background: rgba(36, 36, 38, .78) !important;
            border: 1px solid rgba(255, 255, 255, .13) !important;
            box-shadow:
                0 18px 48px rgba(0, 0, 0, .32),
                inset 0 1px 0 rgba(255, 255, 255, .07) !important;
            backdrop-filter: blur(26px) saturate(150%) !important;
            -webkit-backdrop-filter: blur(26px) saturate(150%) !important;
            overflow: hidden !important;
        }

        .message-focus-stage .message-focus-action {
            min-height: 46px !important;
            background: transparent !important;
            border-bottom-color: rgba(255, 255, 255, .10) !important;
            color: #ffffff !important;
            transition: background .16s ease, transform .12s ease !important;
        }

        .message-focus-stage .message-focus-action:hover {
            background: rgba(255, 255, 255, .08) !important;
        }

        .message-focus-stage .message-focus-action:active {
            background: rgba(255, 255, 255, .13) !important;
            transform: scale(.985);
        }

        .message-focus-stage .message-focus-reactions {
            background: rgba(36, 36, 38, .76) !important;
            border: 1px solid rgba(255, 255, 255, .13) !important;
            box-shadow: 0 16px 40px rgba(0, 0, 0, .28) !important;
            backdrop-filter: blur(26px) saturate(150%) !important;
            -webkit-backdrop-filter: blur(26px) saturate(150%) !important;
        }

        /* Light mode: popup tetap gelap/transparan seperti menu iOS,
           tetapi halaman di belakang tetap terang. */
        body.theme-light .message-focus-backdrop {
            background: rgba(0, 0, 0, .20) !important;
        }

        body.theme-light .message-focus-stage .message-focus-actions,
        body.theme-light .message-focus-stage .message-focus-reactions {
            background: rgba(36, 36, 38, .76) !important;
            border-color: rgba(255, 255, 255, .13) !important;
            color: #ffffff !important;
        }

        body.theme-light .message-focus-stage .message-focus-action {
            color: #ffffff !important;
            border-bottom-color: rgba(255, 255, 255, .10) !important;
        }

        body.theme-light .message-focus-stage .message-focus-action:hover {
            background: rgba(255, 255, 255, .08) !important;
        }

        @keyframes focusBackdropIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes focusStageIn {
            from {
                opacity: 0;
                transform: translateY(-5px) scale(.97);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .message-focus-backdrop,
            .message-focus-stage {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }


        /* ==========================================================
           FINAL FINAL — iOS GLASS THEME POLISH
           - Popup benar-benar translucent dan mengikuti tema
           - Light: teks popup hitam
           - Dark: teks popup putih
           - Filter Semua/Belum Dibaca tetap terbaca di dark mode
           - Tidak ada panel hitam tersisa di light mode
        ========================================================== */

        /* Popup glass default = dark translucent */
        .message-focus-stage .message-focus-actions,
        .message-focus-stage .message-focus-reactions {
            background: rgba(30, 30, 32, .52) !important;
            border: 1px solid rgba(255,255,255,.16) !important;
            box-shadow:
                0 18px 55px rgba(0,0,0,.24),
                inset 0 1px 0 rgba(255,255,255,.08) !important;
            backdrop-filter: blur(30px) saturate(155%) !important;
            -webkit-backdrop-filter: blur(30px) saturate(155%) !important;
        }

        .message-focus-stage .message-focus-action {
            color: #ffffff !important;
            background: transparent !important;
            border-bottom-color: rgba(255,255,255,.10) !important;
        }

        .message-focus-stage .message-focus-action:hover {
            background: rgba(255,255,255,.07) !important;
        }

        .message-focus-stage .message-focus-reaction-hint {
            color: #ffffff !important;
        }

        /* Light mode: glass putih, transparan, teks hitam */
        body.theme-light .message-focus-backdrop {
            background: rgba(80,80,85,.12) !important;
            backdrop-filter: blur(14px) saturate(115%) !important;
            -webkit-backdrop-filter: blur(14px) saturate(115%) !important;
        }

        body.theme-light .message-focus-stage .message-focus-actions,
        body.theme-light .message-focus-stage .message-focus-reactions {
            background: rgba(255,255,255,.48) !important;
            border-color: rgba(60,60,67,.16) !important;
            box-shadow:
                0 18px 55px rgba(0,0,0,.18),
                inset 0 1px 0 rgba(255,255,255,.62) !important;
            backdrop-filter: blur(30px) saturate(150%) !important;
            -webkit-backdrop-filter: blur(30px) saturate(150%) !important;
        }

        body.theme-light .message-focus-stage .message-focus-action {
            color: #111111 !important;
            border-bottom-color: rgba(60,60,67,.12) !important;
            text-shadow: none !important;
        }

        body.theme-light .message-focus-stage .message-focus-action:hover {
            background: rgba(255,255,255,.30) !important;
        }

        body.theme-light .message-focus-stage .message-focus-action-icon {
            color: #111111 !important;
        }

        body.theme-light .message-focus-stage .message-focus-action.delete,
        body.theme-light .message-focus-stage .message-focus-action.delete .message-focus-action-icon {
            color: #ff375f !important;
        }

        body.theme-light .message-focus-stage .message-focus-reaction-hint {
            color: #111111 !important;
            text-shadow: 0 1px 2px rgba(255,255,255,.65) !important;
        }

        body.theme-light .message-focus-stage .message-focus-reaction-more {
            color: #111111 !important;
        }

        /* Bubble terpilih juga sedikit translucent agar menyatu dengan tema. */
        body.theme-light .message-focus-row.received .message-bubble {
            background: rgba(229,229,234,.86) !important;
            color: #111111 !important;
        }

        body.theme-light .message-focus-row.sent .message-bubble {
            background: rgba(0,122,255,.88) !important;
            color: #ffffff !important;
        }

        body.theme-dark .message-focus-row.received .message-bubble {
            background: rgba(58,58,60,.88) !important;
            color: #ffffff !important;
        }

        body.theme-dark .message-focus-row.sent .message-bubble {
            background: rgba(10,132,255,.90) !important;
            color: #ffffff !important;
        }

        /* Dark mode: tombol filter harus terang/terbaca, bukan hitam. */
        body.theme-dark .filter {
            color: #b8b8bf !important;
            background: transparent !important;
        }

        body.theme-dark .filter:hover {
            color: #ffffff !important;
            background: rgba(255,255,255,.08) !important;
        }

        body.theme-dark .filter.active {
            color: #ffffff !important;
            background: rgba(10,132,255,.24) !important;
            font-weight: 700 !important;
        }

        body.theme-dark .chat-item.unread .chat-name {
            color: #5eb0ff !important;
        }

        body.theme-dark .chat-item.unread .chat-preview {
            color: #a9d5ff !important;
        }

        /* Light mode: pastikan tidak ada latar hitam pada area chat bawah. */
        body.theme-light .closed-composer,
        body.theme-light .composer,
        body.theme-light .composer form {
            background-color: #ffffff !important;
            background-image: none !important;
            color: #111111 !important;
        }

</style>


<style id="final-all-light-theme-fix">
/* ==========================================================
   FINAL LIGHT MODE — SEMUA KOMPONEN TERANG
   ========================================================== */

body.theme-light,
body.theme-light html {
    background: #ffffff !important;
    color: #111111 !important;
}

/* Header / sidebar / room */
body.theme-light .navbar,
body.theme-light .topbar,
body.theme-light .sidebar,
body.theme-light .chat-sidebar,
body.theme-light .chat-main,
body.theme-light .chat-room,
body.theme-light .messages,
body.theme-light .messages-container,
body.theme-light .chat-content,
body.theme-light .room-header,
body.theme-light .chat-header,
body.theme-light .schedule-bar,
body.theme-light .composer,
body.theme-light .composer-bar,
body.theme-light .closed-composer {
    background: #ffffff !important;
    color: #111111 !important;
}

/* Remove any inherited black strip/panel */
body.theme-light .messages,
body.theme-light .messages-container,
body.theme-light .chat-main {
    background-image: none !important;
}

/* Main text */
body.theme-light h1,
body.theme-light h2,
body.theme-light h3,
body.theme-light p,
body.theme-light span,
body.theme-light label,
body.theme-light .chat-title,
body.theme-light .chat-subtitle {
    color: #111111;
}

/* Search + composer */
body.theme-light input,
body.theme-light textarea,
body.theme-light .message-input,
body.theme-light #messageInput {
    background: rgba(245,245,250,.88) !important;
    color: #111111 !important;
    border-color: rgba(60,60,67,.22) !important;
}

body.theme-light input::placeholder,
body.theme-light textarea::placeholder {
    color: #6d6d72 !important;
}

/* Filter buttons */
body.theme-light .filter-button,
body.theme-light .chat-filter,
body.theme-light .filter-btn {
    background: rgba(242,242,247,.9) !important;
    color: #111111 !important;
    border-color: rgba(60,60,67,.16) !important;
}

body.theme-light .filter-button.active,
body.theme-light .chat-filter.active,
body.theme-light .filter-btn.active,
body.theme-light [class*="filter"].active {
    background: #dcecff !important;
    color: #0879e8 !important;
    border-color: rgba(10,132,255,.18) !important;
}

/* Hamburger / info button */
body.theme-light .info-button,
body.theme-light .menu-button,
body.theme-light .chat-menu-button,
body.theme-light #infoButton,
body.theme-light #chatInfoButton {
    background: rgba(242,242,247,.88) !important;
    color: #0879e8 !important;
    border-color: rgba(60,60,67,.12) !important;
}

/* Info menu becomes light glass too */
body.theme-light .info-menu-list,
body.theme-light .info-menu,
body.theme-light .chat-info-menu {
    background: rgba(255,255,255,.70) !important;
    color: #111111 !important;
    border: 1px solid rgba(60,60,67,.14) !important;
    box-shadow: 0 18px 50px rgba(0,0,0,.16) !important;
    backdrop-filter: blur(28px) saturate(155%) !important;
    -webkit-backdrop-filter: blur(28px) saturate(155%) !important;
}

body.theme-light .info-menu-list button,
body.theme-light .info-menu button,
body.theme-light .chat-info-menu button,
body.theme-light .theme-menu-item {
    color: #111111 !important;
}

body.theme-light .info-menu-list button:hover,
body.theme-light .info-menu button:hover,
body.theme-light .chat-info-menu button:hover {
    background: rgba(0,0,0,.055) !important;
}

/* Light message bubbles */
body.theme-light .message-row.received .message-bubble,
body.theme-light .message-row:not(.sent) .message-bubble,
body.theme-light .incoming-message,
body.theme-light .received-message {
    background: #e5e5ea !important;
    color: #111111 !important;
}

body.theme-light .message-row.sent .message-bubble,
body.theme-light .outgoing-message,
body.theme-light .sent-message {
    background: #a9d8ff !important;
    color: #111111 !important;
}

/* Message metadata */
body.theme-light .message-time,
body.theme-light .message-status,
body.theme-light .message-meta {
    color: #6d6d72 !important;
}

/* Closed composer */
body.theme-light .closed-composer {
    border: 1px solid rgba(60,60,67,.16) !important;
    box-shadow: none !important;
}

/* ==========================================================
   DOUBLE CLICK POPUP — LIGHT GLASS
   ========================================================== */
body.theme-light .message-focus-backdrop {
    background: rgba(255,255,255,.42) !important;
    backdrop-filter: blur(8px) saturate(110%) !important;
    -webkit-backdrop-filter: blur(8px) saturate(110%) !important;
}

body.theme-light .message-focus-stage .message-focus-reactions,
body.theme-light .message-focus-stage .message-focus-actions {
    background: rgba(255,255,255,.62) !important;
    color: #111111 !important;
    border: 1px solid rgba(60,60,67,.18) !important;
    box-shadow:
        0 18px 50px rgba(0,0,0,.15),
        inset 0 1px 0 rgba(255,255,255,.75) !important;
    backdrop-filter: blur(30px) saturate(160%) !important;
    -webkit-backdrop-filter: blur(30px) saturate(160%) !important;
}

body.theme-light .message-focus-stage .message-focus-action {
    color: #111111 !important;
    border-bottom-color: rgba(60,60,67,.12) !important;
}

body.theme-light .message-focus-stage .message-focus-action:hover {
    background: rgba(0,0,0,.055) !important;
}

body.theme-light .message-focus-reaction-hint {
    color: #111111 !important;
    text-shadow: none !important;
}

/* Selected message remains readable */
body.theme-light .message-focus-stage .message-focus-card,
body.theme-light .message-focus-stage .message-focus-row {
    color: #111111 !important;
}

/* Buttons / icons in light mode */
body.theme-light .emoji-button,
body.theme-light .theme-toggle-button {
    background: rgba(242,242,247,.9) !important;
    color: #111111 !important;
    border-color: rgba(60,60,67,.14) !important;
}

/* Don't let old dark declarations win */
body.theme-light [style*="background: #000"],
body.theme-light [style*="background:#000"],
body.theme-light [style*="background: rgb(0, 0, 0)"] {
    background: #ffffff !important;
    color: #111111 !important;
}
</style>

<style id="final-delete-red-fix">
        .message-focus-action.delete,
        .message-focus-action.delete span,
        .message-focus-action.delete .message-focus-action-icon {
            color: #ff3b30 !important;
        }
        body.theme-light .message-focus-action.delete,
        body.theme-light .message-focus-action.delete span,
        body.theme-light .message-focus-action.delete .message-focus-action-icon {
            color: #ff3b30 !important;
        }
    </style>

<style>

        /* ==========================================================
           CUSTOM CHAT BUBBLE COLORS
        ========================================================== */
        .bubble-color-panel {
            margin: 2px 0 6px;
            padding: 10px;
            border-radius: 12px;
            background: rgba(245, 247, 250, .96);
            border: 1px solid #dceafb;
        }

        .bubble-color-panel[hidden] { display: none !important; }
        .bubble-color-title {
            margin: 2px 2px 7px;
            font-size: 11px;
            font-weight: 700;
            color: #5c7895;
        }
        .bubble-color-title-received { margin-top: 12px; }
        .bubble-color-swatches {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }
        .bubble-color-swatch {
            width: 25px;
            height: 25px;
            padding: 0;
            border: 2px solid rgba(255,255,255,.9);
            border-radius: 50%;
            background: var(--swatch);
            box-shadow: 0 0 0 1px rgba(0,0,0,.12);
            cursor: pointer;
        }
        .bubble-color-swatch:hover { transform: scale(1.08); }
        .bubble-color-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
            font-size: 11px;
            color: #5c7895;
        }
        .bubble-color-custom input {
            width: 34px;
            height: 24px;
            padding: 0;
            border: 0;
            background: transparent;
            cursor: pointer;
        }
        .bubble-color-reset {
            width: 100%;
            margin-top: 10px;
            padding: 7px 8px;
            border: 1px solid #d6e6f8;
            border-radius: 8px;
            background: #fff;
            color: #315e87;
            font-size: 11px;
            cursor: pointer;
        }
        .bubble-color-reset:hover { background: #eef7ff; }

        body .message-row.sent .message-bubble {
            background: var(--whisperly-sent-bubble, #0a84ff) !important;
            color: var(--whisperly-sent-text, #fff) !important;
        }
        body .message-row.received .message-bubble {
            background: var(--whisperly-received-bubble, #2c2c2e) !important;
            color: var(--whisperly-received-text, #f5f5f7) !important;
        }
        body.theme-light .message-row.received .message-bubble {
            color: var(--whisperly-received-text, #111) !important;
        }
        body.theme-light .message-row.sent .message-bubble {
            color: var(--whisperly-sent-text, #fff) !important;
        }
</style>
</head>


<body>

    <div class="navbar-wrapper">

        @include('whisperly.navbar')

    </div>


    @php

        $currentUser =
            auth('whisperly')->user();

        $isUser =
            $currentUser->role === 'user';


        $otherName =
            $isUser
                ? (
                    $booking
                        ->talent
                        ?->pengguna
                        ?->username
                    ?? 'Talent'
                )
                : (
                    $booking
                        ->pengguna
                        ?->username
                    ?? 'User'
                );


        $otherInitial =
            strtoupper(
                substr(
                    $otherName,
                    0,
                    1
                )
            );

        /*
         * FOTO PROFIL LAWAN CHAT
         *
         * Ambil dari avatar_url milik pengguna terlebih dahulu.
         * Jika belum ada, fallback ke kolom photo lama.
         *
         * USER   -> foto pengguna milik talent
         * TALENT -> foto pengguna yang booking
         */
        $otherPhoto = $isUser
            ? (
                $talent?->pengguna?->avatar_url
                ?? $talent?->pengguna?->photo
                ?? $talent?->photo
                ?? null
            )
            : (
                $pengguna?->avatar_url
                ?? $pengguna?->photo
                ?? null
            );

        /*
         * avatar_url bisa berupa:
         * - URL lengkap (https://...)
         * - path /storage/...
         * - path storage/...
         * - nama/path file biasa
         *
         * Jangan menambahkan "storage/" dua kali.
         */
        $makeAvatarUrl = function ($photo) {
            if (!$photo) {
                return null;
            }

            $photo = trim((string) $photo);

            if (
                str_starts_with($photo, 'http://')
                || str_starts_with($photo, 'https://')
                || str_starts_with($photo, '//')
                || str_starts_with($photo, '/')
            ) {
                return $photo;
            }

            if (str_starts_with($photo, 'storage/')) {
                return asset($photo);
            }

            return asset('storage/' . ltrim($photo, '/'));
        };

        $otherPhotoUrl = $makeAvatarUrl($otherPhoto);


        /*
        |--------------------------------------------------------------------------
        | CEK WAKTU BOOKING
        |--------------------------------------------------------------------------
        |
        | Rating baru muncul setelah end_time pada tanggal booking benar-benar
        | lewat. Tidak hanya mengandalkan $status dari controller.
        |
        */

        $ratingAvailable = false;

        $bookingEndedAt = null;

        if (
            $isUser
            && $booking->schedule
        ) {

            $timezone = 'Asia/Jakarta';

            $nowJakarta =
                now()->setTimezone($timezone);

            $scheduleDate =
                \Carbon\Carbon::parse(
                    $booking->schedule->date,
                    $timezone
                )->toDateString();


            $bookingStart =
                \Carbon\Carbon::parse(
                    $scheduleDate
                    . ' '
                    . $booking->schedule->start_time,
                    $timezone
                );


            $bookingEndedAt =
                \Carbon\Carbon::parse(
                    $scheduleDate
                    . ' '
                    . $booking->schedule->end_time,
                    $timezone
                );


            /*
             * Mendukung jadwal yang melewati tengah malam.
             */

            if (
                $bookingEndedAt->lt(
                    $bookingStart
                )
            ) {

                $bookingEndedAt->addDay();

            }


            $ratingAvailable =
                $nowJakarta->gte(
                    $bookingEndedAt
                );

        }


        /*
        |--------------------------------------------------------------------------
        | RATING EXISTING
        |--------------------------------------------------------------------------
        |
        | Tidak membuat query dengan nama kolom rating tertentu.
        | Kita cukup melihat apakah booking ini sudah memiliki rating.
        |
        */

        
    @endphp



    <main class="chat-wrapper">


        {{-- ========================================================
             SIDEBAR
        ========================================================= --}}

        <aside class="sidebar">

            <div class="sidebar-header">

                <div class="sidebar-title">

                    <h1>
                        Chat
                    </h1>

                </div>


                <div class="search-box">

                    <span class="search-icon">
                        ⌕
                    </span>


                    <input
                        type="text"
                        id="searchChat"
                        placeholder="Cari Obrolan..."
                    >

                </div>


                <div class="filters">

                    <button
                        type="button"
                        class="filter active"
                        data-filter="all"
                    >
                        Semua
                    </button>


                    <button
                        type="button"
                        class="filter"
                        data-filter="unread"
                    >
                        Belum Dibaca
                    </button>

                </div>

            </div>



            {{-- ====================================================
                 LIST CHAT
            ===================================================== --}}

            <div class="chat-list">

                @forelse ($bookings as $item)

                    @php

                        $itemName =
                            $isUser
                                ? (
                                    $item
                                        ->talent
                                        ?->pengguna
                                        ?->username
                                    ?? 'Talent'
                                )
                                : (
                                    $item
                                        ->pengguna
                                        ?->username
                                    ?? 'User'
                                );


                        $itemInitial =
                            strtoupper(
                                substr(
                                    $itemName,
                                    0,
                                    1
                                )
                            );


                        $lastMessage =
                            $item->last_message
                            ?? null;


                        $messageTime =
                            $lastMessage
                                ? $lastMessage->created_at->format('H:i')
                                : substr(
                                    $item->schedule?->start_time
                                    ?? '00:00',
                                    0,
                                    5
                                );


                        $isLastMessageFromCurrentUser =
                            false;

                        $lastMessageIsRead =
                            true;


                        if ($lastMessage) {

                            $isLastMessageFromCurrentUser =
                                (string) $lastMessage->sender_id
                                ===
                                (string) $currentUser->id;


                            if (
                                $isLastMessageFromCurrentUser
                            ) {

                                $lastRead =
                                    $item->conversation?->last_read_at;


                                if ($lastRead) {

                                    $lastMessageIsRead =
                                        $lastMessage->created_at
                                        <=
                                        $lastRead;

                                }

                            }

                        }


                        $isActive =
                            $item->id === $booking->id;


                        $unreadCount =
                            $item->unread_count
                            ?? 0;


                        $hasUnread =
                            $unreadCount > 0
                            &&
                            !$isLastMessageFromCurrentUser;

                    @endphp


                    <a
                        href="{{ route(
                            'whisperly.chat.show',
                            $item->id
                        ) }}"
                        class="
                            chat-item
                            {{ $isActive ? 'active' : '' }}
                            {{ $hasUnread ? 'unread' : '' }}
                        "
                        data-name="{{ strtolower($itemName) }}"
                        data-unread="{{ $hasUnread ? '1' : '0' }}"
                    >

                        @php
                            /*
                             * Foto untuk setiap item di sidebar.
                             * Gunakan avatar_url terlebih dahulu agar sama
                             * dengan foto profil yang dipakai sistem pengguna.
                             */
                            $itemPhoto = $isUser
                                ? (
                                    $item->talent?->pengguna?->avatar_url
                                    ?? $item->talent?->pengguna?->photo
                                    ?? $item->talent?->photo
                                    ?? null
                                )
                                : (
                                    $item->pengguna?->avatar_url
                                    ?? $item->pengguna?->photo
                                    ?? null
                                );

                            $itemPhotoUrl = $makeAvatarUrl($itemPhoto);
                        @endphp

                        <div class="avatar">

                            @if ($itemPhotoUrl)
                                <img
                                    src="{{ $itemPhotoUrl }}"
                                    alt="Profil {{ $itemName }}"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >
                                <span
                                    style="
                                        display:none;
                                        width:100%;
                                        height:100%;
                                        align-items:center;
                                        justify-content:center;
                                    "
                                >{{ $itemInitial }}</span>
                            @else
                                {{ $itemInitial }}
                            @endif

                        </div>


                        <div class="chat-info">

                            <div class="chat-name">

                                {{ ucfirst($itemName) }}

                            </div>


                            <div class="chat-preview">

                                @if ($lastMessage)

                                    {{ Str::limit(
                                        $lastMessage->message,
                                        35
                                    ) }}

                                @else

                                    Belum ada pesan

                                @endif

                            </div>

                        </div>


                        <div style="
                            display:flex;
                            flex-direction:column;
                            align-items:flex-end;
                            gap:7px;
                        ">

                            <div class="chat-time">

                                {{ $messageTime }}

                            </div>


                            @if ($lastMessage)

                                @if ($isLastMessageFromCurrentUser)

                                    <span style="
                                        font-size:11px;
                                        font-weight:700;
                                        color:#2388e8;
                                        white-space:nowrap;
                                    ">

                                        @if ($lastMessageIsRead)
                                            ✓✓
                                        @else
                                            ✓
                                        @endif

                                    </span>

                                @elseif ($hasUnread)

                                    <div class="unread-badge">

                                        {{ $unreadCount > 99
                                            ? '99+'
                                            : $unreadCount }}

                                    </div>

                                @endif

                            @endif

                        </div>

                    </a>

                @empty

                    <div style="
                        padding:30px 16px;
                        color:#68819b;
                        font-size:13px;
                        text-align:center;
                    ">

                        Belum ada percakapan
                        untuk booking Anda.

                    </div>

                @endforelse

            </div>

        </aside>



        {{-- ========================================================
             ROOM CHAT
        ========================================================= --}}

        <section class="room">


            {{-- ====================================================
                 HEADER
            ===================================================== --}}

            <header class="room-header">

                <div class="room-person">

                    <div class="avatar">

                        @if ($otherPhotoUrl)
                            <img
                                src="{{ $otherPhotoUrl }}"
                                alt="Profil {{ $otherName }}"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >
                            <span
                                style="
                                    display:none;
                                    width:100%;
                                    height:100%;
                                    align-items:center;
                                    justify-content:center;
                                "
                            >{{ $otherInitial }}</span>
                        @else
                            {{ $otherInitial }}
                        @endif

                    </div>


                    <div class="room-person-info">

                        <h2>

                            {{ ucfirst($otherName) }}

                        </h2>


                        <div
                            class="online-text"
                            id="roomPresenceStatus"
                        >

                            {{ $contactStatus }}

                        </div>

                    </div>

                </div>



                <details
                    class="info-menu"
                    onclick="event.stopPropagation()"
                >

                    <summary
                        class="info-button"
                        aria-label="Menu informasi chat"
                    >
                        ☰
                    </summary>


                    <div
                        class="info-menu-list"
                        onclick="event.stopPropagation()"
                    >

                        <button
                            type="button"
                            id="themeToggleButton"
                            class="theme-menu-item"
                            aria-label="Ganti tema gelap atau terang"
                        >
                            <span id="themeMenuLabel">Terang</span>
                            <span id="themeMenuIcon" aria-hidden="true">☀️</span>
                        </button>

                        <button
                            type="button"
                            id="bubbleColorToggle"
                            class="theme-menu-item"
                            aria-expanded="false"
                        >
                            <span>🎨 Warna Bubble</span>
                            <span aria-hidden="true">›</span>
                        </button>

                        <div id="bubbleColorPanel" class="bubble-color-panel" hidden>
                            <div class="bubble-color-title">Warna pesan saya</div>
                            <div class="bubble-color-swatches" data-color-target="sent">
                                <button type="button" class="bubble-color-swatch" data-color="#0a84ff" style="--swatch:#0a84ff" aria-label="Biru"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#34c759" style="--swatch:#34c759" aria-label="Hijau"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#ff9500" style="--swatch:#ff9500" aria-label="Oranye"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#ff2d55" style="--swatch:#ff2d55" aria-label="Pink"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#af52de" style="--swatch:#af52de" aria-label="Ungu"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#5856d6" style="--swatch:#5856d6" aria-label="Indigo"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#8e8e93" style="--swatch:#8e8e93" aria-label="Abu-abu"></button>
                            </div>
                            <label class="bubble-color-custom">
                                Pilih sendiri
                                <input type="color" id="sentBubbleColor" value="#0a84ff" aria-label="Pilih warna bubble saya">
                            </label>

                            <div class="bubble-color-title bubble-color-title-received">Warna pesan lawan</div>
                            <div class="bubble-color-swatches" data-color-target="received">
                                <button type="button" class="bubble-color-swatch" data-color="#2c2c2e" style="--swatch:#2c2c2e" aria-label="Abu gelap"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#e5e5ea" style="--swatch:#e5e5ea" aria-label="Abu terang"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#d1f7c4" style="--swatch:#d1f7c4" aria-label="Hijau muda"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#d9eaff" style="--swatch:#d9eaff" aria-label="Biru muda"></button>
                                <button type="button" class="bubble-color-swatch" data-color="#ffe0b2" style="--swatch:#ffe0b2" aria-label="Oranye muda"></button>
                            </div>
                            <label class="bubble-color-custom">
                                Pilih sendiri
                                <input type="color" id="receivedBubbleColor" value="#2c2c2e" aria-label="Pilih warna bubble lawan">
                            </label>

                            <button type="button" id="resetBubbleColors" class="bubble-color-reset">Kembalikan warna awal</button>
                        </div>

                        <button
                            type="button"
                            id="accountInfoToggle"
                        >
                            Informasi Akun
                        </button>


                        <form
                            method="POST"
                            action="{{ route(
                                'whisperly.chat.clear',
                                $booking->id
                            ) }}"
                            onsubmit="return confirm('Bersihkan seluruh isi chat ini dari akun Anda?')"
                        >

                            @csrf

                            <button type="submit">
                                Bersihkan Chat
                            </button>

                        </form>


                        <form
                            method="POST"
                            action="{{ route(
                                'whisperly.chat.delete',
                                $booking->id
                            ) }}"
                            onsubmit="return confirm('Hapus chat ini dari akun Anda?')"
                        >

                            @csrf

                            <button type="submit">
                                Hapus Chat
                            </button>

                        </form>

                    </div>

                </details>

            </header>



            {{-- ====================================================
                 JADWAL
            ===================================================== --}}

            <div class="schedule">

                🕐 &nbsp; Jadwal:

                <strong>

                    {{ substr(
                        $booking
                            ->schedule
                            ?->start_time
                        ?? '00:00',
                        0,
                        5
                    ) }}

                    -

                    {{ substr(
                        $booking
                            ->schedule
                            ?->end_time
                        ?? '00:00',
                        0,
                        5
                    ) }}

                    WIB

                </strong>

            </div>



            {{-- ====================================================
                 SEMUA RIWAYAT CHAT
            ===================================================== --}}

            <div
                class="messages"
                id="messages"
            >

                @forelse ($roomMessages as $room)

                    @php

                        $roomBooking =
                            $room['booking'];

                        $roomMessagesList =
                            $room['messages'];

                    @endphp



                    <div class="booking-divider">

                        <div
                            class="booking-divider-line"
                        ></div>


                        <div
                            class="booking-divider-content"
                        >

                            <span
                                class="booking-divider-title"
                            >
                                Booking
                            </span>


                            <span
                                class="booking-divider-time"
                            >

                                {{ substr(
                                    $roomBooking
                                        ->schedule
                                        ?->start_time
                                    ?? '00:00',
                                    0,
                                    5
                                ) }}

                                -

                                {{ substr(
                                    $roomBooking
                                        ->schedule
                                        ?->end_time
                                    ?? '00:00',
                                    0,
                                    5
                                ) }}

                                WIB

                            </span>


                            <span
                                class="booking-divider-status"
                            >

                                @if (
                                    $roomBooking->status
                                    === 'completed'
                                )

                                    Selesai

                                @elseif (
                                    $roomBooking->chatStatus()
                                    === 'active'
                                )

                                    Aktif

                                @elseif (
                                    $roomBooking->chatStatus()
                                    === 'upcoming'
                                )

                                    Akan datang

                                @else

                                    Ditutup

                                @endif

                            </span>

                        </div>


                        <div
                            class="booking-divider-line"
                        ></div>

                    </div>



                    @forelse (
                        $roomMessagesList
                        as $message
                    )

                        @php

                            $mine =
                                (string)
                                $message->sender_id
                                ===
                                (string)
                                $currentUser->id;


                            $senderName =
                                $message
                                    ->sender
                                    ?->username
                                ??
                                (
                                    $mine
                                        ? 'Anda'
                                        : $otherName
                                );


                            $senderInitial =
                                strtoupper(
                                    substr(
                                        $senderName,
                                        0,
                                        1
                                    )
                                );

                        @endphp


                        <div
    class="
        message-row
        {{ $mine
            ? 'sent'
            : 'received' }}
    "
    data-message-id="{{ $message->id }}"
    data-sender-id="{{ $message->sender_id }}"
    data-sender-name="{{ e($senderName) }}"
    data-is-read="{{ ($message->is_read ?? false) ? '1' : '0' }}"
>

                            <div class="message-avatar">

                                @if (!$mine && $otherPhoto)
                                    <img
                                        src="{{ $otherPhotoUrl }}"
                                        alt="Profil {{ $senderName }}"
                                    >
                                @else
                                    {{ $senderInitial }}
                                @endif

                            </div>


                            <div class="message-content">

                                <div class="sender-name">

                                    {{ $mine
                                        ? 'Anda'
                                        : ucfirst($senderName) }}

                                </div>


                                @php
                                    $rawMessage = (string) $message->message;
                                    $replyMatch = preg_match('/^↪\s*([^:]+):\s*"(.*?)"\s*\n(.*)$/us', $rawMessage, $replyParts);
                                    $displayMessage = $replyMatch ? $replyParts[3] : $rawMessage;
                                @endphp

                                <div
                                    class="message-bubble {{ $message->image_path && !$displayMessage ? 'image-only' : '' }}"
                                    data-plain-text="{{ e($displayMessage) }}"
                                >
                                    @if ($message->image_path)
                                        <img
                                            class="message-image"
                                            src="{{ asset('storage/' . $message->image_path) }}"
                                            alt="Foto yang dikirim"
                                            loading="lazy"
                                        >
                                    @endif

                                    @if ($replyMatch)
                                        <div class="message-reply-quote">
                                            {{ $replyParts[1] }}: “{{ $replyParts[2] }}”
                                        </div>
                                    @endif

                                    @if ($displayMessage !== '')
                                        <div class="message-text">{{ $displayMessage }}</div>
                                    @endif
                                </div>

                                <span class="message-reaction" aria-label="Reaksi"></span>


                                <div class="message-footer">

                                    <div class="message-time">

                                        {{ $message->created_at
                                            ?->format('H:i') }}

                                    </div>



                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="empty-message-small">

                            Belum ada pesan pada
                            booking ini.

                        </div>

                    @endforelse


                @empty

                    <div class="empty-message">

                        💬

                        <br><br>

                        Belum ada pesan
                        di chat ini.

                    </div>

                @endforelse

            </div>

            {{-- Typing dock sengaja DI LUAR .messages supaya posisinya
                 selalu menempel di bawah area chat, tepat di atas composer. --}}
            <div
                class="typing-dock"
                aria-hidden="true"
            >
                <div
                    class="typing-indicator"
                    id="typingIndicator"
                    aria-live="polite"
                    aria-label="Sedang mengetik"
                >
                    <span class="typing-dot"></span>
                    <span class="typing-dot"></span>
                    <span class="typing-dot"></span>
                </div>
            </div>


            {{-- ====================================================
                 COMPOSER
            ===================================================== --}}

            <div
                class="composer"
                id="chatComposer"
                data-booking-end="{{ $bookingEndedAt?->toIso8601String() }}"
            >
                @if ($canChat)
                    <form
                        method="POST"
                        action="{{ route('whisperly.chat.store', $booking->id) }}"
                        id="messageForm"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="reply-preview" id="replyPreview">
                            <div class="reply-preview-text">
                                <div class="reply-preview-label" id="replyPreviewLabel">Membalas</div>
                                <div class="reply-preview-quote" id="replyPreviewQuote"></div>
                            </div>
                            <button type="button" class="reply-cancel" id="replyCancel" aria-label="Batal membalas">×</button>
                        </div>

                        <div class="image-preview" id="imagePreview">
                            <img id="imagePreviewImg" src="" alt="Pratinjau foto">
                            <button type="button" class="image-preview-remove" id="imagePreviewRemove" aria-label="Hapus foto">×</button>
                        </div>

                        <input type="file" name="image" id="imageInput" class="attachment-input" accept="image/jpeg,image/png,image/webp,image/gif">

                        <div class="composer-controls">
                            <button type="button" class="attachment-button" id="attachmentButton" title="Kirim foto" aria-label="Kirim foto">+</button>

                            <button
                                type="button"
                                class="emoji-button"
                                id="emojiButton"
                                title="Emoji"
                                aria-label="Buka emoji"
                            >
                                😊
                            </button>

                            <input
                                type="hidden"
                                name="message"
                                id="messageValue"
                                value=""
                            >

                            <div
                                id="messageInput"
                                class="message-input-editor"
                                contenteditable="true"
                                role="textbox"
                                aria-multiline="true"
                                data-placeholder="Whisperly"
                                tabindex="0"
                            ></div>

                            <button
                                type="submit"
                                class="send-button"
                                id="sendButton"
                                title="Kirim pesan"
                            >
                                ➤
                            </button>
                        </div>

                        <div
                            class="emoji-picker"
                            id="emojiPicker"
                            aria-label="Pilihan emoji"
                        >
                            <button type="button" class="custom-emoji-option" data-emoji="🙂" data-emoji-id="01" aria-label="Emoji 01">
                                <img src="{{ asset('assets/images/emoji_01.png') }}" alt="Emoji 01" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😵‍💫" data-emoji-id="02" aria-label="Emoji 02">
                                <img src="{{ asset('assets/images/emoji_02.png') }}" alt="Emoji 02" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😭" data-emoji-id="03" aria-label="Emoji 03">
                                <img src="{{ asset('assets/images/emoji_03.png') }}" alt="Emoji 03" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="🤭" data-emoji-id="04" aria-label="Emoji 04">
                                <img src="{{ asset('assets/images/emoji_04.png') }}" alt="Emoji 04" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😲" data-emoji-id="05" aria-label="Emoji 05">
                                <img src="{{ asset('assets/images/emoji_05.png') }}" alt="Emoji 05" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😓" data-emoji-id="06" aria-label="Emoji 06">
                                <img src="{{ asset('assets/images/emoji_06.png') }}" alt="Emoji 06" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😑" data-emoji-id="07" aria-label="Emoji 07">
                                <img src="{{ asset('assets/images/emoji_07.png') }}" alt="Emoji 07" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😂" data-emoji-id="08" aria-label="Emoji 08">
                                <img src="{{ asset('assets/images/emoji_08.png') }}" alt="Emoji 08" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😏" data-emoji-id="09" aria-label="Emoji 09">
                                <img src="{{ asset('assets/images/emoji_09.png') }}" alt="Emoji 09" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😎" data-emoji-id="10" aria-label="Emoji 10">
                                <img src="{{ asset('assets/images/emoji_10.png') }}" alt="Emoji 10" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😐" data-emoji-id="11" aria-label="Emoji 11">
                                <img src="{{ asset('assets/images/emoji_11.png') }}" alt="Emoji 11" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😆" data-emoji-id="12" aria-label="Emoji 12">
                                <img src="{{ asset('assets/images/emoji_12.png') }}" alt="Emoji 12" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😢" data-emoji-id="13" aria-label="Emoji 13">
                                <img src="{{ asset('assets/images/emoji_13.png') }}" alt="Emoji 13" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="🤩" data-emoji-id="14" aria-label="Emoji 14">
                                <img src="{{ asset('assets/images/emoji_14.png') }}" alt="Emoji 14" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😗" data-emoji-id="15" aria-label="Emoji 15">
                                <img src="{{ asset('assets/images/emoji_15.png') }}" alt="Emoji 15" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😍" data-emoji-id="16" aria-label="Emoji 16">
                                <img src="{{ asset('assets/images/emoji_16.png') }}" alt="Emoji 16" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="🥶" data-emoji-id="17" aria-label="Emoji 17">
                                <img src="{{ asset('assets/images/emoji_17.png') }}" alt="Emoji 17" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="🤣" data-emoji-id="18" aria-label="Emoji 18">
                                <img src="{{ asset('assets/images/emoji_18.png') }}" alt="Emoji 18" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="🥵" data-emoji-id="19" aria-label="Emoji 19">
                                <img src="{{ asset('assets/images/emoji_19.png') }}" alt="Emoji 19" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😚" data-emoji-id="20" aria-label="Emoji 20">
                                <img src="{{ asset('assets/images/emoji_20.png') }}" alt="Emoji 20" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😎" data-emoji-id="21" aria-label="Emoji 21">
                                <img src="{{ asset('assets/images/emoji_21.png') }}" alt="Emoji 21" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😁" data-emoji-id="22" aria-label="Emoji 22">
                                <img src="{{ asset('assets/images/emoji_22.png') }}" alt="Emoji 22" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😊" data-emoji-id="23" aria-label="Emoji 23">
                                <img src="{{ asset('assets/images/emoji_23.png') }}" alt="Emoji 23" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😒" data-emoji-id="24" aria-label="Emoji 24">
                                <img src="{{ asset('assets/images/emoji_24.png') }}" alt="Emoji 24" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="🤓" data-emoji-id="25" aria-label="Emoji 25">
                                <img src="{{ asset('assets/images/emoji_25.png') }}" alt="Emoji 25" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😪" data-emoji-id="26" aria-label="Emoji 26">
                                <img src="{{ asset('assets/images/emoji_26.png') }}" alt="Emoji 26" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="🤢" data-emoji-id="27" aria-label="Emoji 27">
                                <img src="{{ asset('assets/images/emoji_27.png') }}" alt="Emoji 27" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😶" data-emoji-id="28" aria-label="Emoji 28">
                                <img src="{{ asset('assets/images/emoji_28.png') }}" alt="Emoji 28" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😍" data-emoji-id="29" aria-label="Emoji 29">
                                <img src="{{ asset('assets/images/emoji_29.png') }}" alt="Emoji 29" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😠" data-emoji-id="30" aria-label="Emoji 30">
                                <img src="{{ asset('assets/images/emoji_30.png') }}" alt="Emoji 30" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😊" data-emoji-id="31" aria-label="Emoji 31">
                                <img src="{{ asset('assets/images/emoji_31.png') }}" alt="Emoji 31" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😛" data-emoji-id="32" aria-label="Emoji 32">
                                <img src="{{ asset('assets/images/emoji_32.png') }}" alt="Emoji 32" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😮" data-emoji-id="33" aria-label="Emoji 33">
                                <img src="{{ asset('assets/images/emoji_33.png') }}" alt="Emoji 33" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😂" data-emoji-id="34" aria-label="Emoji 34">
                                <img src="{{ asset('assets/images/emoji_34.png') }}" alt="Emoji 34" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😡" data-emoji-id="35" aria-label="Emoji 35">
                                <img src="{{ asset('assets/images/emoji_35.png') }}" alt="Emoji 35" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😎" data-emoji-id="36" aria-label="Emoji 36">
                                <img src="{{ asset('assets/images/emoji_36.png') }}" alt="Emoji 36" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😉" data-emoji-id="37" aria-label="Emoji 37">
                                <img src="{{ asset('assets/images/emoji_37.png') }}" alt="Emoji 37" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😞" data-emoji-id="38" aria-label="Emoji 38">
                                <img src="{{ asset('assets/images/emoji_38.png') }}" alt="Emoji 38" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="🥺" data-emoji-id="39" aria-label="Emoji 39">
                                <img src="{{ asset('assets/images/emoji_39.png') }}" alt="Emoji 39" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😛" data-emoji-id="40" aria-label="Emoji 40">
                                <img src="{{ asset('assets/images/emoji_40.png') }}" alt="Emoji 40" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😇" data-emoji-id="41" aria-label="Emoji 41">
                                <img src="{{ asset('assets/images/emoji_41.png') }}" alt="Emoji 41" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😎" data-emoji-id="42" aria-label="Emoji 42">
                                <img src="{{ asset('assets/images/emoji_42.png') }}" alt="Emoji 42" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😌" data-emoji-id="43" aria-label="Emoji 43">
                                <img src="{{ asset('assets/images/emoji_43.png') }}" alt="Emoji 43" draggable="false">
                            </button>
                            <button type="button" class="custom-emoji-option" data-emoji="😏" data-emoji-id="44" aria-label="Emoji 44">
                                <img src="{{ asset('assets/images/emoji_44.png') }}" alt="Emoji 44" draggable="false">
                            </button>
                        </div>
                    </form>

                    <div class="chat-countdown" id="chatCountdown" aria-live="polite">
                        <span class="chat-countdown-dot"></span>
                        <span id="chatCountdownText">Sesi aktif</span>
                    </div>
                @else
                    <div class="closed-composer" id="closedComposer">
                        🔒
                        <span>
                            @if ($status === 'upcoming')
                                Chat akan terbuka sesuai jadwal booking.
                            @else
                                Chat sudah ditutup karena waktu booking telah selesai.
                            @endif
                        </span>
                    </div>
                @endif
            </div>

        </section>
        {{-- ====================================================
             ACCOUNT INFO PANEL
        ===================================================== --}}

        <div
            class="account-info-panel"
            id="accountInfoPanel"
        >

            <div class="account-info-panel-content">


                <div class="account-info-header">

                    <h3>
                        Informasi Akun
                    </h3>


                    <button
                        type="button"
                        class="account-info-close"
                        id="accountInfoClose"
                    >
                        ✕
                    </button>

                </div>


                <div class="account-info-body">


                    <div class="account-profile-section">

                        <div class="account-profile-avatar">

                            @if ($otherPhotoUrl)

                                <img
                                    src="{{ $otherPhotoUrl }}"
                                    alt="Avatar {{ $otherName }}"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >

                                <span
                                    style="
                                        display:none;
                                        width:100%;
                                        height:100%;
                                        align-items:center;
                                        justify-content:center;
                                    "
                                >{{ $otherInitial }}</span>

                            @else

                                {{ $otherInitial }}

                            @endif

                        </div>


                        <div class="account-name">

                            {{ ucfirst($otherName) }}

                        </div>


                        <div
                            class="
                                account-status
                                {{
                                    in_array(
                                        $contactStatus,
                                        ['Online', 'Mengetik...'],
                                        true
                                    )
                                    ? 'online'
                                    : 'offline'
                                }}
                            "
                            id="profilePresenceStatus"
                        >

                            <span
                                class="account-status-dot"
                            ></span>

                            <span id="profilePresenceText">{{ $contactStatus }}</span>

                        </div>

                    </div>



                    @if (
                        $isUser
                        && $talent?->deskripsi
                    )

                        <div class="account-info-item">

                            <div class="account-info-label">
                                Tentang
                            </div>


                            <div class="account-info-value">

                                {{ $talent->deskripsi }}

                            </div>

                        </div>

                    @endif



                    <div class="account-info-item">

                        <div class="account-info-label">
                            Informasi Booking
                        </div>


                        <div class="account-booking-grid">


                            <div class="account-booking-item">

                                <div class="account-booking-item-label">
                                    Jam
                                </div>


                                <div class="account-booking-item-value">

                                    {{ substr(
                                        $booking->schedule?->start_time
                                        ?? '00:00',
                                        0,
                                        5
                                    ) }}

                                </div>

                            </div>



                            <div class="account-booking-item">

                                <div class="account-booking-item-label">
                                    Durasi
                                </div>


                                <div class="account-booking-item-value">

                                    {{ round(
                                        $booking->durationHours(),
                                        1
                                    ) }}h

                                </div>

                            </div>


                        </div>

                    </div>



                    <div class="account-info-item">

                        <div class="account-info-label">
                            Status Booking
                        </div>


                        <div class="account-info-value">

                            <strong>

                                @if ($status === 'active')

                                    🟢 Aktif

                                @elseif ($status === 'upcoming')

                                    🔵 Akan Datang

                                @elseif ($status === 'completed')

                                    ✓ Selesai

                                @else

                                    ⚪ {{ ucfirst($status) }}

                                @endif

                            </strong>

                        </div>

                    </div>



                    <div class="account-info-item">

                        <div class="account-info-label">
                            Tanggal Booking
                        </div>


                        <div class="account-info-value">

                            {{ $booking->created_at?->format('d M Y') ?? '-' }}

                        </div>

                    </div>



                    <div class="account-info-item">

                        <div class="account-info-label">
                            Total Pesan
                        </div>


                        <div class="account-info-value">

                            <strong>
                                {{ $messages->count() }} pesan
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- ====================================================
             POPUP BOOKING SELESAI UNTUK TALENT
        ===================================================== --}}
        @if ($status === 'completed' && ! $isUser)
            <div class="modal-overlay" id="bookingFinishedModal" style="display:flex;">
                <div class="modal">
                    <div class="modal-icon">✓</div>
                    <h3>Booking Selesai</h3>
                    <p>
                        Waktu booking dengan
                        <strong>{{ ucfirst($otherName) }}</strong>
                        telah berakhir.<br><br>
                        Chat ini sudah ditutup dan kamu tidak dapat mengirim pesan lagi.
                    </p>
                    <button type="button" class="modal-button" onclick="closeFinishedModal()">
                        Mengerti
                    </button>
                </div>
            </div>
        @endif

        {{-- ====================================================
             POPUP RATING USER
        ===================================================== --}}
        @if ($isUser && $canRate)
            <div
                class="modal-overlay rating-modal-overlay"
                id="ratingModal"
                style="display:none;"
                aria-hidden="true"
            >
                <div class="modal rating-modal">
                    <button type="button" class="rating-close" onclick="closeRatingModal()" aria-label="Tutup">×</button>

                    <div class="modal-icon">⭐</div>

                    <h3>Beri Penilaian</h3>

                    <p>
                        Bagaimana pengalamanmu bersama
                        <strong>{{ ucfirst($otherName) }}</strong>?
                    </p>

                    <form
                        method="POST"
                        action="{{ route('whisperly.chat.rating.store', $booking->id) }}"
                        id="ratingForm"
                    >
                        @csrf

                        <div class="rating-stars" id="ratingStars" aria-label="Pilih rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <button
                                    type="button"
                                    class="rating-star"
                                    data-value="{{ $i }}"
                                    aria-label="{{ $i }} bintang"
                                >★</button>
                            @endfor
                        </div>

                        <div class="rating-label" id="ratingLabel">
                            Pilih jumlah bintang
                        </div>

                        <input
                            type="hidden"
                            name="nilai_rating"
                            id="ratingValue"
                            value=""
                        >

                        <textarea
                            class="rating-textarea"
                            name="ulasan"
                            id="ratingComment"
                            maxlength="1000"
                            required
                            placeholder="Tulis pengalamanmu tentang sesi ini..."
                        ></textarea>

                        <button
                            type="submit"
                            class="rating-submit"
                            id="ratingSubmit"
                            disabled
                        >
                            Kirim Penilaian
                        </button>
                    </form>
                </div>
            </div>
        @endif

    <script>

        /* ==========================================================
           AUTO SCROLL
        ========================================================== */

        const messages =
            document.getElementById('messages');


        if (messages) {

            messages.scrollTop =
                messages.scrollHeight;

        }



        /* ==========================================================
           FOCUS INPUT
        ========================================================== */

        const messageInput =
            document.getElementById('messageInput');

        const messageValue =
            document.getElementById('messageValue');

        /*
         * Daftar emoji custom. Gambar dipakai sebagai tampilan,
         * sedangkan data-emoji menyimpan karakter yang dikirim ke server.
         */
        const CUSTOM_EMOJI_MAP = {
            '01': { emoji: '🙂', file: 'emoji_01.png' },
            '02': { emoji: '😵‍💫', file: 'emoji_02.png' },
            '03': { emoji: '😭', file: 'emoji_03.png' },
            '04': { emoji: '🤭', file: 'emoji_04.png' },
            '05': { emoji: '😲', file: 'emoji_05.png' },
            '06': { emoji: '😓', file: 'emoji_06.png' },
            '07': { emoji: '😑', file: 'emoji_07.png' },
            '08': { emoji: '😂', file: 'emoji_08.png' },
            '09': { emoji: '😏', file: 'emoji_09.png' },
            '10': { emoji: '😎', file: 'emoji_10.png' },
            '11': { emoji: '😐', file: 'emoji_11.png' },
            '12': { emoji: '😆', file: 'emoji_12.png' },
            '13': { emoji: '😢', file: 'emoji_13.png' },
            '14': { emoji: '🤩', file: 'emoji_14.png' },
            '15': { emoji: '😗', file: 'emoji_15.png' },
            '16': { emoji: '😍', file: 'emoji_16.png' },
            '17': { emoji: '🥶', file: 'emoji_17.png' },
            '18': { emoji: '🤣', file: 'emoji_18.png' },
            '19': { emoji: '🥵', file: 'emoji_19.png' },
            '20': { emoji: '😚', file: 'emoji_20.png' },
            '21': { emoji: '😎', file: 'emoji_21.png' },
            '22': { emoji: '😁', file: 'emoji_22.png' },
            '23': { emoji: '😊', file: 'emoji_23.png' },
            '24': { emoji: '😒', file: 'emoji_24.png' },
            '25': { emoji: '🤓', file: 'emoji_25.png' },
            '26': { emoji: '😪', file: 'emoji_26.png' },
            '27': { emoji: '🤢', file: 'emoji_27.png' },
            '28': { emoji: '😶', file: 'emoji_28.png' },
            '29': { emoji: '😍', file: 'emoji_29.png' },
            '30': { emoji: '😠', file: 'emoji_30.png' },
            '31': { emoji: '😊', file: 'emoji_31.png' },
            '32': { emoji: '😛', file: 'emoji_32.png' },
            '33': { emoji: '😮', file: 'emoji_33.png' },
            '34': { emoji: '😂', file: 'emoji_34.png' },
            '35': { emoji: '😡', file: 'emoji_35.png' },
            '36': { emoji: '😎', file: 'emoji_36.png' },
            '37': { emoji: '😉', file: 'emoji_37.png' },
            '38': { emoji: '😞', file: 'emoji_38.png' },
            '39': { emoji: '🥺', file: 'emoji_39.png' },
            '40': { emoji: '😛', file: 'emoji_40.png' },
            '41': { emoji: '😇', file: 'emoji_41.png' },
            '42': { emoji: '😎', file: 'emoji_42.png' },
            '43': { emoji: '😌', file: 'emoji_43.png' },
            '44': { emoji: '😏', file: 'emoji_44.png' }
        };

        const CUSTOM_EMOJI_FALLBACK = {};
        Object.keys(CUSTOM_EMOJI_MAP).forEach(function (id) {
            const item = CUSTOM_EMOJI_MAP[id];
            if (!CUSTOM_EMOJI_FALLBACK[item.emoji]) {
                CUSTOM_EMOJI_FALLBACK[item.emoji] = id;
            }
        });

        function emojiToken(id) {
            const normalizedId = String(id || '').padStart(2, '0');
            const item = CUSTOM_EMOJI_MAP[normalizedId];

            if (!item) return '';

            /*
             * PENTING:
             * Emoji custom sebelumnya dikirim sebagai marker:
             * [[WEMO:02]]
             *
             * Marker tersebut kemudian ikut masuk ke kolom `message`,
             * sehingga preview/notifikasi daftar chat menampilkan kode
             * mentah seperti [WEMO:02].
             *
             * Sekarang yang disimpan ke server adalah Unicode emoji-nya.
             * Di dalam tampilan chat, emoji Unicode tersebut tetap akan
             * diubah menjadi gambar custom oleh emojiImageForText().
             * Dengan begitu:
             *   - pesan teks + emoji tetap menjadi SATU pesan,
             *   - preview chat tidak menampilkan kode [[WEMO:xx]],
             *   - emoji tetap tampil sebagai gambar custom di bubble chat.
             */
            return item.emoji;
        }

        function serializeComposerNode(node) {
            let result = '';

            node.childNodes.forEach(function (child) {
                if (child.nodeType === Node.TEXT_NODE) {
                    result += child.nodeValue || '';
                    return;
                }

                if (child.nodeType !== Node.ELEMENT_NODE) {
                    return;
                }

                const element = child;

                if (element.matches('img.custom-emoji-inline')) {
                    const id = element.dataset.emojiId || '';
                    const token = emojiToken(id);
                    result += token || (element.dataset.emoji || '');
                    return;
                }

                if (element.tagName === 'BR') {
                    result += '\n';
                    return;
                }

                result += serializeComposerNode(element);

                /* Block elements created by contenteditable need a newline
                 * between them so normal text is never swallowed. */
                if (/^(DIV|P|LI)$/.test(element.tagName)) {
                    result += '\n';
                }
            });

            return result;
        }

        function getComposerText() {
            if (!messageInput) return '';

            return serializeComposerNode(messageInput)
                .replace(/\u00a0/g, ' ')
                .replace(/\n{3,}/g, '\n\n')
                .trim();
        }

        function normalizeOutgoingEmojiText(value) {
            let text = String(value || '');

            /*
             * Jaga-jaga jika marker lama masuk ke composer melalui paste,
             * autofill, atau DOM lama. Sebelum dikirim, ubah marker menjadi
             * Unicode emoji sehingga kode internal tidak pernah dikirim ke
             * server sebagai isi pesan baru.
             */
            text = text.replace(/\[\[WEMO:(\d{2})\]\]/g, function (full, id) {
                const item = CUSTOM_EMOJI_MAP[String(id)];
                return item ? item.emoji : full;
            });

            text = text.replace(/\uE000(\d{2})\uE001/g, function (full, id) {
                const item = CUSTOM_EMOJI_MAP[String(id)];
                return item ? item.emoji : full;
            });

            text = text.replace(/\u200B\u2060(\d{2})\u2060/g, function (full, id) {
                const item = CUSTOM_EMOJI_MAP[String(id)];
                return item ? item.emoji : full;
            });

            return text;
        }

        function syncComposerValue() {
            const value = normalizeOutgoingEmojiText(getComposerText());

            if (messageValue) {
                messageValue.value = value;
            }

            return value;
        }

        function clearComposer() {
            if (messageInput) {
                messageInput.innerHTML = '';
            }

            if (messageValue) {
                messageValue.value = '';
            }
        }

        function insertCustomEmoji(emoji, imageUrl, emojiId) {
            if (!messageInput) return;

            messageInput.focus();

            const selection = window.getSelection();
            let range = null;

            if (selection && selection.rangeCount > 0 && messageInput.contains(selection.anchorNode)) {
                range = selection.getRangeAt(0);
            } else {
                range = document.createRange();
                range.selectNodeContents(messageInput);
                range.collapse(false);
            }

            range.deleteContents();

            const img = document.createElement('img');
            img.className = 'custom-emoji-inline';
            img.src = imageUrl;
            img.alt = emoji;
            img.dataset.emoji = emoji;
            img.dataset.emojiId = String(emojiId || '').padStart(2, '0');
            img.draggable = false;

            range.insertNode(img);

            const spacer = document.createTextNode('');
            range.setStartAfter(img);
            range.collapse(true);
            range.insertNode(spacer);
            range.setStartAfter(spacer);
            range.collapse(true);

            selection.removeAllRanges();
            selection.addRange(range);

            syncComposerValue();

            messageInput.dispatchEvent(new Event('input', { bubbles: true }));
        }


        if (messageInput) {

            messageInput.focus();

        }


        const csrfToken =
            document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;


        const heartbeatUrl =
            @json(
                route(
                    'whisperly.chat.heartbeat'
                )
            );


        const typingUrl =
            @json(
                route(
                    'whisperly.chat.typing'
                )
            );


        const presenceUrl =
            @json(
                route(
                    'whisperly.chat.presence',
                    $booking->id
                )
            );


        function sendPresenceRequest(
            url,
            body = null
        ) {

            return fetch(
                url,
                {
                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN':
                            csrfToken,

                        'Accept':
                            'application/json',

                        ...(body
                            ? {
                                'Content-Type':
                                    'application/json'
                            }
                            : {}
                        ),
                    },

                    body:
                        body
                            ? JSON.stringify(body)
                            : null,
                }
            );

        }


        function updateContactStatus() {

            fetch(
                presenceUrl,
                {
                    headers: {
                        'Accept':
                            'application/json'
                    }
                }
            )

            .then(
                response =>
                    response.json()
            )

            .then(
                data => {

                    const status =
                        data.status;

                    const typingIndicator =
                        document.getElementById(
                            'typingIndicator'
                        );

                    const isTyping =
                        status === 'Mengetik...';

                    if (typingIndicator) {
                        typingIndicator.classList.toggle(
                            'active',
                            isTyping
                        );

                        if (isTyping && messages) {
                            messages.scrollTop =
                                messages.scrollHeight;
                        }
                    }


                    const roomStatus =
                        document.getElementById(
                            'roomPresenceStatus'
                        );


                    const profileStatus =
                        document.getElementById(
                            'profilePresenceStatus'
                        );

                    const profilePresenceText =
                        document.getElementById(
                            'profilePresenceText'
                        );


                    if (roomStatus) {

                        roomStatus.textContent =
                            isTyping ? 'Mengetik...' : status;

                    }


                    if (profilePresenceText) {

                        profilePresenceText.textContent =
                            isTyping ? 'Mengetik...' : status;

                    }

                    if (profileStatus) {

                        profileStatus.classList.toggle(
                            'online',
                            status !== 'Offline'
                        );


                        profileStatus.classList.toggle(
                            'offline',
                            status === 'Offline'
                        );

                    }

                }
            );

        }


        sendPresenceRequest(
            heartbeatUrl
        );


        updateContactStatus();


        setInterval(
            function () {

                sendPresenceRequest(
                    heartbeatUrl
                );


                updateContactStatus();

            },
            10000
        );


        /* Cek status lawan lebih cepat supaya indikator mengetik terasa realtime. */
        updateContactStatus();

        setInterval(
            updateContactStatus,
            1000
        );



        if (messageInput) {

            let typingTimer;


            messageInput.addEventListener(
                'input',
                function () {

                    sendPresenceRequest(
                        typingUrl,
                        {
                            typing: true
                        }
                    );


                    clearTimeout(
                        typingTimer
                    );


                    typingTimer =
                        setTimeout(
                            function () {

                                sendPresenceRequest(
                                    typingUrl,
                                    {
                                        typing: false
                                    }
                                );

                            },
                            4500
                        );

                }
            );

        }



        /* ==========================================================
           SEARCH
        ========================================================== */

        const searchInput =
            document.getElementById(
                'searchChat'
            );


        function applyChatFilter() {

            const keyword =
                searchInput
                    ? searchInput.value
                        .toLowerCase()
                        .trim()
                    : '';


            const activeFilter =
                document
                    .querySelector(
                        '.filter.active'
                    )
                    ?.dataset.filter
                    ?? 'all';


            document
                .querySelectorAll(
                    '.chat-item'
                )
                .forEach(
                    function (item) {

                        const name =
                            item
                                .querySelector(
                                    '.chat-name'
                                )
                                ?.textContent
                                .toLowerCase()
                                ?? '';


                        const preview =
                            item
                                .querySelector(
                                    '.chat-preview'
                                )
                                ?.textContent
                                .toLowerCase()
                                ?? '';


                        const unread =
                            item.dataset.unread
                            === '1';


                        const matchesSearch =
                            name.includes(
                                keyword
                            )
                            ||
                            preview.includes(
                                keyword
                            );


                        const matchesFilter =
                            activeFilter === 'all'
                            ||
                            (
                                activeFilter === 'unread'
                                &&
                                unread
                            );


                        item.style.display =
                            matchesSearch
                            && matchesFilter
                                ? 'flex'
                                : 'none';

                    }
                );

        }


        if (searchInput) {

            searchInput.addEventListener(
                'input',
                applyChatFilter
            );

        }



        /* ==========================================================
           FILTER
        ========================================================== */

        document
            .querySelectorAll('.filter')
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            document
                                .querySelectorAll(
                                    '.filter'
                                )
                                .forEach(
                                    function (btn) {

                                        btn.classList
                                            .remove(
                                                'active'
                                            );

                                    }
                                );


                            this.classList.add(
                                'active'
                            );


                            applyChatFilter();

                        }
                    );

                }
            );



        /* ==========================================================
           MODAL
        ========================================================== */

        function closeFinishedModal() {

            const modal =
                document.getElementById(
                    'bookingFinishedModal'
                );


            if (modal) {

                modal.style.display =
                    'none';

            }

        }



        /* ==========================================================
           ACCOUNT INFO PANEL
        ========================================================== */

        const accountInfoPanel =
            document.getElementById(
                'accountInfoPanel'
            );


        const accountInfoToggle =
            document.getElementById(
                'accountInfoToggle'
            );


        const accountInfoClose =
            document.getElementById(
                'accountInfoClose'
            );


        if (accountInfoToggle) {

            accountInfoToggle.addEventListener(
                'click',
                function () {

                    if (accountInfoPanel) {

                        accountInfoPanel.classList.add(
                            'active'
                        );

                    }

                }
            );

        }


        if (accountInfoClose) {

            accountInfoClose.addEventListener(
                'click',
                function () {

                    if (accountInfoPanel) {

                        accountInfoPanel.classList.remove(
                            'active'
                        );

                    }

                }
            );

        }


        if (accountInfoPanel) {

            accountInfoPanel.addEventListener(
                'click',
                function (e) {

                    if (
                        e.target ===
                        accountInfoPanel
                    ) {

                        accountInfoPanel.classList.remove(
                            'active'
                        );

                    }

                }
            );

        }


        if (
            accountInfoPanel
            &&
            new URLSearchParams(
                window.location.search
            ).get('info') === '1'
        ) {

            accountInfoPanel.classList.add(
                'active'
            );

        }



        /* ==========================================================
           ENTER UNTUK MENGIRIM PESAN
        ========================================================== */

        if (messageInput) {

            messageInput.addEventListener(
                'keydown',
                function (e) {

                    if (
                        e.key === 'Enter'
                        &&
                        !e.shiftKey
                    ) {

                        e.preventDefault();

                        /*
                         * messageInput sekarang adalah DIV contenteditable,
                         * bukan <textarea>, jadi this.form tidak tersedia.
                         * Ambil form chat secara langsung.
                         */
                        const form = document.getElementById('messageForm');
                        if (form) {
                            form.requestSubmit();
                        }

                    }

                }
            );

        }



        /* ==========================================================
           ⭐ RATING INTERACTION
        ========================================================== */

        const ratingStars =
            document.querySelectorAll(
                '.rating-star'
            );


        const ratingValue =
            document.getElementById(
                'ratingValue'
            );


        const ratingLabel =
            document.getElementById(
                'ratingLabel'
            );


        const ratingSubmit =
            document.getElementById(
                'ratingSubmit'
            );


        const ratingComment =
            document.getElementById(
                'ratingComment'
            );


        const ratingTexts = {

            1:
                'Kurang memuaskan',

            2:
                'Masih perlu ditingkatkan',

            3:
                'Cukup baik',

            4:
                'Sangat baik',

            5:
                'Luar biasa! ⭐'

        };


        function updateRatingStars(
            value
        ) {

            ratingStars.forEach(
                function (star) {

                    const starValue =
                        Number(
                            star.dataset.value
                        );


                    star.classList.toggle(
                        'selected',
                        starValue <= value
                    );

                }
            );


            if (ratingLabel) {

                ratingLabel.textContent =
                    ratingTexts[value]
                    || 'Pilih jumlah bintang';

            }

        }


        ratingStars.forEach(
            function (star) {

                star.addEventListener(
                    'click',
                    function () {

                        const value =
                            Number(
                                this.dataset.value
                            );


                        if (ratingValue) {

                            ratingValue.value =
                                value;

                        }


                        updateRatingStars(
                            value
                        );


                        this.classList.remove(
                            'pop'
                        );


                        void this.offsetWidth;


                        this.classList.add(
                            'pop'
                        );


                        if (ratingSubmit) {

                            ratingSubmit.disabled =
                                value < 1;

                        }

                    }
                );


                star.addEventListener(
                    'mouseenter',
                    function () {

                        const value =
                            Number(
                                this.dataset.value
                            );


                        ratingStars.forEach(
                            function (item) {

                                item.classList.toggle(
                                    'selected',
                                    Number(
                                        item.dataset.value
                                    ) <= value
                                );

                            }
                        );

                    }
                );


                star.addEventListener(
                    'mouseleave',
                    function () {

                        const selected =
                            Number(
                                ratingValue?.value
                                || 0
                            );


                        updateRatingStars(
                            selected
                        );

                    }
                );

            }
        );


        /* ==========================================================
           BOOKING TIMER -> LOCK CHAT -> OPEN RATING
        ========================================================== */
        const chatComposer = document.getElementById('chatComposer');
        const messageForm = document.getElementById('messageForm');
        const attachmentButton = document.getElementById('attachmentButton');
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewImg = document.getElementById('imagePreviewImg');
        const imagePreviewRemove = document.getElementById('imagePreviewRemove');
        const chatCountdown = document.getElementById('chatCountdown');
        const chatCountdownText = document.getElementById('chatCountdownText');
        const ratingModal = document.getElementById('ratingModal');
        const ratingForm = document.getElementById('ratingForm');

        let ratingOpened = false;

        function openRatingModal() {
            if (!ratingModal || ratingOpened) return;

            ratingOpened = true;
            ratingModal.style.display = 'flex';
            ratingModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeRatingModal() {
            if (!ratingModal) return;
            ratingModal.style.display = 'none';
            ratingModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        function lockChat() {
            if (messageForm) {
                messageForm.querySelectorAll('textarea, button, [contenteditable="true"]').forEach(function (el) {
                    el.disabled = true;
                });
            }

            if (messageInput) {
                messageInput.setAttribute('contenteditable', 'false');
                messageInput.setAttribute('aria-disabled', 'true');
                messageInput.dataset.placeholder = 'Sesi booking telah berakhir.';
            }

            if (chatCountdown) {
                chatCountdown.classList.add('expired');
            }

            if (chatCountdownText) {
                chatCountdownText.textContent = 'Sesi selesai';
            }
        }

        function formatRemaining(ms) {
            const totalSeconds = Math.max(0, Math.floor(ms / 1000));
            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;

            return [hours, minutes, seconds]
                .map(function (value) {
                    return String(value).padStart(2, '0');
                })
                .join(':');
        }

        function bookingExpired() {
    lockChat();

    @if ($isUser && $canRate)
        openRatingModal();
    @endif
}

        function updateBookingTimer() {
            if (!chatComposer) return;

            const endValue = chatComposer.dataset.bookingEnd;
            if (!endValue) return;

            const endTime = new Date(endValue).getTime();
            if (Number.isNaN(endTime)) return;

            const remaining = endTime - Date.now();

            if (remaining <= 0) {
                bookingExpired();
                return;
            }

            if (chatCountdownText) {
                chatCountdownText.textContent = 'Sisa waktu ' + formatRemaining(remaining);
            }
        }

        updateBookingTimer();
        setInterval(updateBookingTimer, 500);

        /* Jika halaman dibuka setelah waktu selesai, popup langsung muncul. */
        @if ($isUser && $canRate)
    openRatingModal();
@endif
        {{-- ANIMASI TERIMA KASIH SETELAH RATING BERHASIL --}}
        @if ($isUser && session('rating_success'))
            <div class="modal-overlay thank-you-overlay" id="thankYouModal">
                <div class="thank-you-card">
                    <div class="thank-you-icon"><span>★</span></div>
                    <h3>Terima Kasih!</h3>
                    <p>Penilaianmu sudah berhasil disimpan.</p>
                </div>
            </div>
        @endif

        /*
         * KIRIM PESAN TANPA REFRESH
         *
         * Form tetap memakai route Laravel yang sama, tetapi submit diambil
         * alih oleh fetch(). Server mengembalikan JSON, lalu pesan langsung
         * dimasukkan ke DOM. Jadi pengirim dan penerima sama-sama melihat
         * pesan tanpa perlu menekan refresh.
         */
        function clearSelectedImage() {
            if (imageInput) imageInput.value = '';
            if (imagePreviewImg) imagePreviewImg.src = '';
            if (imagePreview) imagePreview.classList.remove('active');
        }

        if (attachmentButton && imageInput) {
            attachmentButton.addEventListener('click', function () {
                imageInput.click();
            });
        }

        if (imageInput) {
            imageInput.addEventListener('change', function () {
                const file = this.files && this.files[0];
                if (!file) { clearSelectedImage(); return; }
                if (!file.type.startsWith('image/')) { alert('File yang dipilih harus berupa foto.'); clearSelectedImage(); return; }
                if (file.size > 5 * 1024 * 1024) { alert('Ukuran foto maksimal 5 MB.'); clearSelectedImage(); return; }
                const reader = new FileReader();
                reader.onload = function (event) {
                    if (imagePreviewImg) imagePreviewImg.src = event.target.result;
                    if (imagePreview) imagePreview.classList.add('active');
                };
                reader.readAsDataURL(file);
            });
        }

        if (imagePreviewRemove) {
            imagePreviewRemove.addEventListener('click', clearSelectedImage);
        }

        let sendingMessage = false;

        if (messageForm) {
            messageForm.addEventListener('submit', function (event) {
                event.preventDefault();

                /*
                 * Jangan mengandalkan disabled pada tombol untuk mencegah
                 * double-submit. Setelah request selesai, flag ini selalu
                 * dikembalikan ke false sehingga foto/pesan berikutnya bisa
                 * dikirim tanpa refresh halaman.
                 */
                if (sendingMessage) return;

                const endValue = chatComposer?.dataset.bookingEnd;
                const endTime = endValue ? new Date(endValue).getTime() : NaN;

                if (!Number.isNaN(endTime) && Date.now() >= endTime) {
                    bookingExpired();
                    return;
                }

                const input = document.getElementById('messageInput');
                const button = document.getElementById('sendButton');
                const message = syncComposerValue().trim();
                const hasImage = !!(imageInput && imageInput.files && imageInput.files.length);

                if (!message && !hasImage) {
                    return;
                }

                sendingMessage = true;

                syncComposerValue();

                const formData = new FormData(messageForm);

                /*
                 * Pastikan nilai final yang dikirim selalu bersih dari
                 * marker emoji internal.
                 */
                formData.set(
                    'message',
                    normalizeOutgoingEmojiText(
                        String(formData.get('message') || '')
                    ).trim()
                );

                if (replyTarget) {
                    const quoted = escapeText(replyTarget.quote).replace(/"/g, '\"');
                    const original = normalizeOutgoingEmojiText(
                        String(formData.get('message') || '')
                    ).trim();
                    formData.set(
                        'message',
                        '↪ ' + replyTarget.sender + ': "' + quoted + '"\n' + original
                    );
                }

                fetch(messageForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                    .then(async function (response) {
                        let data = null;

                        try {
                            data = await response.json();
                        } catch (error) {
                            throw new Error('Server tidak mengembalikan JSON.');
                        }

                        if (!response.ok) {
                            if (data && data.expired) {
                                bookingExpired();
                            }

                            throw new Error(
                                data?.message || 'Pesan gagal dikirim.'
                            );
                        }

                        return data;
                    })
                    .then(function (data) {
                        if (!data || !data.ok || !data.message) {
                            throw new Error('Data pesan tidak valid.');
                        }

                        /*
                         * appendNewMessage() didefinisikan di bawah, tetapi
                         * function declaration tetap tersedia saat event ini
                         * dijalankan.
                         */
                        appendNewMessage(data.message);

                        if (input) {
                            clearComposer();
                            input.focus();
                        }

                        clearSelectedImage();
                        clearReplyTarget();
                        if (emojiPicker) emojiPicker.classList.remove('open');

                        const container =
                            document.getElementById('messages');

                        if (container) {
                            container.scrollTop =
                                container.scrollHeight;
                        }
                    })
                    .catch(function (error) {
                        console.error('Gagal mengirim pesan:', error);
                    })
                    .finally(function () {
                        sendingMessage = false;

                        /*
                         * WAJIB aktif lagi setelah setiap request, baik
                         * berhasil maupun gagal. Ini yang membuat user bisa
                         * mengirim foto kedua/ketiga tanpa refresh.
                         */
                        if (button) {
                            button.disabled = false;
                            button.removeAttribute('aria-busy');
                        }

                        if (attachmentButton) {
                            attachmentButton.disabled = false;
                        }

                        if (imageInput) {
                            imageInput.disabled = false;
                        }
                    });
            });
        }

        if (ratingForm) {
            ratingForm.addEventListener('submit', function (event) {
                const value = Number(document.getElementById('ratingValue')?.value || 0);
                const comment = document.getElementById('ratingComment')?.value.trim() || '';

                if (value < 1 || !comment) {
                    event.preventDefault();
                    return;
                }

                const submit = document.getElementById('ratingSubmit');
                if (submit) {
                    submit.disabled = true;
                    submit.textContent = 'Menyimpan...';
                }
            });
        }
        const thankYouModal = document.getElementById('thankYouModal');

        if (thankYouModal) {
            document.body.style.overflow = 'hidden';

            setTimeout(function () {
                thankYouModal.style.transition = 'opacity .45s ease';
                thankYouModal.style.opacity = '0';

                setTimeout(function () {
                    thankYouModal.remove();
                    document.body.style.overflow = '';
                }, 450);
            }, 1800);
        }

                /* ==========================================================
           iMESSAGE INTERACTIONS
           - dark/light mode
           - emoji picker
           - double click message => reaction/action sheet
           - reaction badge
           - reply (disimpan sebagai quote di isi pesan)
           - copy message
        ========================================================== */

        const themeToggleButton = document.getElementById('themeToggleButton');
        const themeMenuIcon = document.getElementById('themeMenuIcon');
        const themeMenuLabel = document.getElementById('themeMenuLabel');
        const savedTheme = localStorage.getItem('whisperly-chat-theme') || 'dark';

        function applyTheme(theme) {
            const dark = theme === 'dark';
            document.body.classList.toggle('theme-dark', dark);
            document.body.classList.toggle('theme-light', !dark);
            localStorage.setItem('whisperly-chat-theme', dark ? 'dark' : 'light');

            if (themeMenuIcon) {
                themeMenuIcon.textContent = dark ? '☀️' : '🌙';
            }

            if (themeMenuLabel) {
                themeMenuLabel.textContent = dark ? 'Terang' : 'Gelap';
            }

            if (themeToggleButton) {
                themeToggleButton.title = dark ? 'Beralih ke mode terang' : 'Beralih ke mode gelap';
                themeToggleButton.setAttribute('aria-label', dark ? 'Beralih ke mode terang' : 'Beralih ke mode gelap');
            }
        }

        applyTheme(savedTheme === 'light' ? 'light' : 'dark');

        if (themeToggleButton) {
            themeToggleButton.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                const dark = document.body.classList.contains('theme-dark');
                applyTheme(dark ? 'light' : 'dark');
            });
        }


        /* ==========================================================
           CUSTOM BUBBLE COLOR
           Warna disimpan di browser agar tetap sama setelah refresh.
        ========================================================== */
        const bubbleColorToggle = document.getElementById('bubbleColorToggle');
        const bubbleColorPanel = document.getElementById('bubbleColorPanel');
        const sentBubbleColor = document.getElementById('sentBubbleColor');
        const receivedBubbleColor = document.getElementById('receivedBubbleColor');
        const resetBubbleColors = document.getElementById('resetBubbleColors');
        const bubbleColorDefaults = {
            sent: '#0a84ff',
            received: '#2c2c2e'
        };

        function colorToTextColor(hex) {
            const clean = String(hex || '').replace('#', '');
            if (clean.length !== 6) return '#ffffff';
            const r = parseInt(clean.slice(0, 2), 16);
            const g = parseInt(clean.slice(2, 4), 16);
            const b = parseInt(clean.slice(4, 6), 16);
            const luminance = (0.299 * r) + (0.587 * g) + (0.114 * b);
            return luminance > 165 ? '#111111' : '#ffffff';
        }

        function applyBubbleColor(target, color, save = true) {
            const safeColor = /^#[0-9a-fA-F]{6}$/.test(String(color || ''))
                ? String(color)
                : bubbleColorDefaults[target];

            if (target === 'sent') {
                document.documentElement.style.setProperty('--whisperly-sent-bubble', safeColor);
                document.documentElement.style.setProperty('--whisperly-sent-text', colorToTextColor(safeColor));
                if (sentBubbleColor) sentBubbleColor.value = safeColor;
                if (save) localStorage.setItem('whisperly-sent-bubble', safeColor);
            }

            if (target === 'received') {
                document.documentElement.style.setProperty('--whisperly-received-bubble', safeColor);
                document.documentElement.style.setProperty('--whisperly-received-text', colorToTextColor(safeColor));
                if (receivedBubbleColor) receivedBubbleColor.value = safeColor;
                if (save) localStorage.setItem('whisperly-received-bubble', safeColor);
            }
        }

        applyBubbleColor('sent', localStorage.getItem('whisperly-sent-bubble') || bubbleColorDefaults.sent, false);
        applyBubbleColor('received', localStorage.getItem('whisperly-received-bubble') || bubbleColorDefaults.received, false);

        if (bubbleColorToggle && bubbleColorPanel) {
            bubbleColorToggle.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                const willOpen = bubbleColorPanel.hidden;
                bubbleColorPanel.hidden = !willOpen;
                bubbleColorToggle.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
            });
        }

        document.querySelectorAll('.bubble-color-swatch').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                const target = button.closest('.bubble-color-swatches')?.dataset.colorTarget;
                if (target) applyBubbleColor(target, button.dataset.color);
            });
        });

        if (sentBubbleColor) {
            sentBubbleColor.addEventListener('input', function () {
                applyBubbleColor('sent', this.value);
            });
        }
        if (receivedBubbleColor) {
            receivedBubbleColor.addEventListener('input', function () {
                applyBubbleColor('received', this.value);
            });
        }
        if (resetBubbleColors) {
            resetBubbleColors.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                applyBubbleColor('sent', bubbleColorDefaults.sent);
                applyBubbleColor('received', bubbleColorDefaults.received);
            });
        }

        const emojiButton = document.getElementById('emojiButton');
        const emojiPicker = document.getElementById('emojiPicker');

        if (emojiButton && emojiPicker) {
            emojiButton.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                emojiPicker.classList.toggle('open');
            });

            emojiPicker.querySelectorAll('button.custom-emoji-option').forEach(function (button) {
                button.addEventListener('mousedown', function (event) {
                    /*
                     * Jangan biarkan klik picker menghilangkan selection/cursor
                     * pada contenteditable sebelum emoji dimasukkan.
                     */
                    event.preventDefault();
                });

                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    const emoji = button.dataset.emoji || '';
                    const image = button.querySelector('img');

                    if (!emoji || !image) return;

                    insertCustomEmoji(
                        emoji,
                        image.getAttribute('src'),
                        button.dataset.emojiId
                    );

                    emojiPicker.classList.remove('open');
                });
            });
        }

        document.addEventListener('click', function (event) {
            if (emojiPicker && !emojiPicker.contains(event.target) && event.target !== emojiButton) {
                emojiPicker.classList.remove('open');
            }
        });

        if (messageInput) {
            messageInput.addEventListener('input', function () {
                syncComposerValue();
            });
        }

        const replyPreview = document.getElementById('replyPreview');
        const replyPreviewLabel = document.getElementById('replyPreviewLabel');
        const replyPreviewQuote = document.getElementById('replyPreviewQuote');
        const replyCancel = document.getElementById('replyCancel');
        let replyTarget = null;

        function escapeText(value) {
            return String(value ?? '').replace(/\s+/g, ' ').trim();
        }

        function setReplyTarget(row) {
            if (!row) return;
            const bubble = row.querySelector('.message-bubble');
            const quote = escapeText(bubble?.dataset?.plainText || bubble?.textContent || '');
            const sender = row.classList.contains('sent') ? 'Anda' : (row.dataset.senderName || '{{ addslashes($otherName) }}');
            replyTarget = { sender: sender, quote: quote };
            if (replyPreviewLabel) replyPreviewLabel.textContent = 'Membalas ' + sender;
            if (replyPreviewQuote) replyPreviewQuote.textContent = quote;
            replyPreview?.classList.add('active');
            messageInput?.focus();
        }

        function clearReplyTarget() {
            replyTarget = null;
            replyPreview?.classList.remove('active');
            if (replyPreviewQuote) replyPreviewQuote.textContent = '';
        }

        replyCancel?.addEventListener('click', clearReplyTarget);

        function getMessagePlainText(row) {
            const bubble = row?.querySelector('.message-bubble');
            if (!bubble) return '';
            return bubble.dataset.plainText || bubble.textContent || '';
        }

        @php
            $reactionUrlTemplate = route(
                'whisperly.chat.message.react',
                [
                    'booking' => $booking->id,
                    'message' => '__MESSAGE__',
                ]
            );

            $deleteMessageUrlTemplate = route(
                'whisperly.chat.message.delete',
                [
                    'booking' => $booking->id,
                    'message' => '__MESSAGE__',
                ]
            );
        @endphp

        const currentUserId = String(@json((string) $currentUser->id));

        const reactionUrlTemplate = @json($reactionUrlTemplate);

        const deleteMessageUrlTemplate = @json($deleteMessageUrlTemplate);

        function messageActionUrl(template, messageId) {
            return template.replace('__MESSAGE__', encodeURIComponent(String(messageId)));
        }

        function normalizeReactions(reactions) {
            if (!Array.isArray(reactions)) return [];

            return reactions
                .map(function (reaction) {
                    if (typeof reaction === 'string') {
                        return {
                            user_id: '',
                            emoji: reaction
                        };
                    }

                    return {
                        user_id: String(reaction?.user_id ?? ''),
                        emoji: String(reaction?.emoji ?? '')
                    };
                })
                .filter(function (reaction) {
                    return reaction.emoji !== '';
                });
        }

        function renderMessageReactions(row, reactions) {
            if (!row) return;

            let badge = row.querySelector('.message-reaction');

            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'message-reaction';

                const content = row.querySelector('.message-content');
                if (content) content.appendChild(badge);
            }

            const normalized = normalizeReactions(reactions);
            const emojis = normalized.map(function (reaction) {
                return reaction.emoji;
            });

            badge.textContent = emojis.join(' ');
            badge.classList.toggle('active', emojis.length > 0);
            row._reactions = normalized;
        }

        function getRowReactions(row) {
            return normalizeReactions(row?._reactions || []);
        }

        function getMyReaction(row) {
            return getRowReactions(row).find(function (reaction) {
                return String(reaction.user_id) === currentUserId;
            })?.emoji || '';
        }

        async function setReaction(row, emoji) {
            if (!row) return;

            const messageId = String(row.dataset.messageId || '');
            if (!messageId) return;

            const myCurrentReaction = getMyReaction(row);
            const nextEmoji = myCurrentReaction === emoji ? '' : emoji;

            const formData = new FormData();
            formData.append('emoji', nextEmoji);

            const response = await fetch(
                messageActionUrl(reactionUrlTemplate, messageId),
                {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin',
                    cache: 'no-store'
                }
            );

            let data = null;
            try {
                data = await response.json();
            } catch (error) {}

            if (!response.ok || !data?.ok) {
                throw new Error(data?.message || 'Reaction gagal disimpan.');
            }

            renderMessageReactions(row, data.reactions || []);

            /* Clone di popup juga langsung mengikuti reaction terbaru. */
            if (activeMessageOverlay?.originalRow === row) {
                const clone = activeMessageOverlay.root?.querySelector('.message-focus-row');
                if (clone) renderMessageReactions(clone, data.reactions || []);
            }

            return data;
        }

        function restoreServerReactions(row, reactions) {
            renderMessageReactions(row, reactions || []);
        }

        let activeMessageOverlay = null;

        function closeActionSheet() {
            if (activeMessageOverlay) {
                const original = activeMessageOverlay.originalRow;
                if (original) original.classList.remove('message-selected-original');
                activeMessageOverlay.root?.remove();
                activeMessageOverlay.backdrop?.remove();
                activeMessageOverlay = null;
            }
        }

        function makeFocusAction(label, icon, handler, extraClass) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'message-focus-action' + (extraClass ? ' ' + extraClass : '');
            btn.innerHTML = '<span>' + label + '</span><span class="message-focus-action-icon">' + icon + '</span>';
            btn.addEventListener('click', function (event) {
                event.stopPropagation();
                handler();
            });
            return btn;
        }

        function openMessageActions(row) {
            if (!row) return;
            closeActionSheet();

            row.classList.add('message-selected-original');

            const backdrop = document.createElement('div');
            backdrop.className = 'message-focus-backdrop';

            const stage = document.createElement('div');
            stage.className = 'message-focus-stage';

            /* Reaction bar ala iMessage */
            const reactionBar = document.createElement('div');
            const reactionWrap = document.createElement('div');
            reactionWrap.className = 'message-focus-reaction-wrap';

            const reactionHint = document.createElement('div');
            reactionHint.className = 'message-focus-reaction-hint';
            reactionHint.textContent = 'Tap and hold to super react';
            reactionWrap.appendChild(reactionHint);

            reactionBar.className = 'message-focus-reactions';
            reactionBar.setAttribute('aria-label', 'Reaction pesan');

            ['❤️', '😂', '😮', '😢', '😡', '👎'].forEach(function (emoji) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'message-focus-reaction';
                btn.textContent = emoji;
                btn.title = 'React ' + emoji;
                btn.addEventListener('click', async function (event) {
                    event.stopPropagation();
                    btn.disabled = true;
                    try {
                        await setReaction(row, emoji);
                        closeActionSheet();
                    } catch (error) {
                        console.error('Gagal menyimpan reaction:', error);
                    } finally {
                        btn.disabled = false;
                    }
                });
                reactionBar.appendChild(btn);
            });

            const moreReaction = document.createElement('button');
            moreReaction.type = 'button';
            moreReaction.className = 'message-focus-reaction message-focus-reaction-more';
            moreReaction.textContent = '+';
            moreReaction.title = 'Reaction lainnya';
            moreReaction.addEventListener('click', async function (event) {
                event.stopPropagation();
                const emoji = window.prompt('Masukkan emoji reaction:');
                if (emoji && emoji.trim()) {
                    try {
                        await setReaction(row, emoji.trim());
                        closeActionSheet();
                    } catch (error) {
                        console.error('Gagal menyimpan reaction:', error);
                    }
                }
            });
            reactionBar.appendChild(moreReaction);
            reactionWrap.appendChild(reactionBar);
            stage.appendChild(reactionWrap);

            /* Bubble dibuat clone supaya benar-benar terapung */
            const card = document.createElement('div');
            card.className = 'message-focus-card';
            const clone = row.cloneNode(true);

            /*
             * PENTING: row asli diberi class message-selected-original agar
             * disembunyikan saat overlay terbuka. cloneNode() ikut menyalin
             * class tersebut, sehingga sebelumnya bubble clone ikut opacity:0
             * dan TIDAK KELIHATAN. Hapus class itu dari clone.
             */
            clone.classList.remove('message-selected-original');
            clone.classList.add('message-focus-row');
            clone.dataset.interactionsBound = '1';
            clone.querySelectorAll('.message-reaction').forEach(function (el) { el.remove(); });
            card.appendChild(clone);
            stage.appendChild(card);

            /* Menu bawah: hanya Reply, Copy, Delete */
            const actions = document.createElement('div');
            actions.className = 'message-focus-actions';

            actions.appendChild(makeFocusAction('Salin', '▢', async function () {
                const text = getMessagePlainText(row);
                try {
                    await navigator.clipboard.writeText(text);
                } catch (error) {
                    const helper = document.createElement('textarea');
                    helper.value = text;
                    helper.style.position = 'fixed';
                    helper.style.opacity = '0';
                    document.body.appendChild(helper);
                    helper.select();
                    document.execCommand('copy');
                    helper.remove();
                }
                closeActionSheet();
            }));

            actions.appendChild(makeFocusAction('Balas', '↩', function () {
                setReplyTarget(row);
                closeActionSheet();
            }));

            actions.appendChild(makeFocusAction('Hapus', '⌫', function () {
                const messageId = String(row.dataset.messageId || '');
                if (!messageId) return;

                const mine = String(row.dataset.senderId || '') === String(currentUserId);
                const confirmText = mine
                    ? 'Hapus pesan ini untuk semua orang? Pesan akan dihapus permanen dari chat.'
                    : 'Hapus pesan ini untuk saya saja? Pesan akan tetap terlihat oleh orang lain.';

                if (!window.confirm(confirmText)) return;

                fetch(
                    messageActionUrl(deleteMessageUrlTemplate, messageId),
                    {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        credentials: 'same-origin',
                        cache: 'no-store'
                    }
                )
                    .then(async function (response) {
                        let data = null;
                        try { data = await response.json(); } catch (error) {}

                        if (!response.ok || !data?.ok) {
                            throw new Error(data?.message || 'Pesan gagal dihapus.');
                        }

                        row.remove();
                        syncActiveSidebarPreview();
                        closeActionSheet();
                    })
                    .catch(function (error) {
                        console.error('Gagal menghapus pesan:', error);
                    });
            }, 'delete'));

            stage.appendChild(actions);
            document.body.appendChild(backdrop);
            document.body.appendChild(stage);

            activeMessageOverlay = { root: stage, backdrop: backdrop, originalRow: row };

            /*
             * Posisikan seluruh popup berdasarkan pesan yang benar-benar
             * diklik. Bubble clone berada di tengah, reaction di atasnya,
             * dan Salin/Balas/Hapus tepat di bawah bubble.
             */
            requestAnimationFrame(function () {
                const originalRect = row.getBoundingClientRect();
                const stageRect = stage.getBoundingClientRect();
                const selectedBubble = stage.querySelector('.message-focus-row .message-bubble');
                const margin = 10;
                const gap = 10;

                if (!selectedBubble) return;

                /*
                 * iMessage:
                 * Popup TIDAK dipindah ke tengah layar.
                 * Stage mengikuti sisi bubble asli:
                 * - pesan kanan -> popup rata kanan di bawah pesan
                 * - pesan kiri -> popup rata kiri di bawah pesan
                 */
                const isSent = row.classList.contains('sent');

                let left = isSent
                    ? originalRect.right - stageRect.width
                    : originalRect.left;

                let top = originalRect.bottom + gap;

                /* Tetap berada di dalam viewport. */
                left = Math.max(
                    margin,
                    Math.min(left, window.innerWidth - stageRect.width - margin)
                );

                /*
                 * Utamakan posisi DI BAWAH bubble. Kalau ruang bawah tidak cukup,
                 * naik sedikit agar popup tetap terlihat, tanpa memindahkannya
                 * ke tengah layar.
                 */
                const maxTop = window.innerHeight - stageRect.height - margin;
                if (top > maxTop) {
                    top = Math.max(margin, maxTop);
                }

                stage.style.left = left + 'px';
                stage.style.top = top + 'px';
                stage.classList.add(isSent ? 'focus-align-sent' : 'focus-align-received');
            });

            backdrop.addEventListener('click', closeActionSheet);
            document.addEventListener('keydown', function escHandler(event) {
                if (event.key === 'Escape') {
                    closeActionSheet();
                    document.removeEventListener('keydown', escHandler);
                }
            });
        }

        /*
         * STATUS PESAN — GAYA iMESSAGE
         * Centang hanya muncul pada pesan TERAKHIR dari rangkaian pesan
         * yang dikirim berturut-turut oleh user. Jadi spam 4 pesan akan
         * terlihat sebagai 4 bubble bersih, lalu hanya bubble ke-4 yang
         * mempunyai ✓ / ✓✓ di bagian bawahnya.
         */
        function updateOutgoingMessageChecks(root) {
            if (!root) return;

            /*
             * Status centang sengaja DIHAPUS sesuai permintaan UI.
             * Yang tetap dipertahankan hanya aturan jam: jam tampil pada
             * pesan terakhir dari rangkaian pesan sender yang sama.
             */
            const rows = Array.from(
                root.querySelectorAll('.message-row[data-message-id]')
            );

            rows.forEach(function (row, index) {
                const footer = row.querySelector('.message-footer');
                if (!footer) return;

                const time = footer.querySelector('.message-time');
                const nextRow = rows[index + 1] || null;
                const currentSender = row.classList.contains('sent') ? 'sent' : 'received';
                const nextSender = nextRow
                    ? (nextRow.classList.contains('sent') ? 'sent' : 'received')
                    : null;

                const isLastInSenderGroup =
                    !nextRow || nextSender !== currentSender;

                if (time) {
                    time.style.display = isLastInSenderGroup ? 'block' : 'none';
                }

                /* Hapus sisa centang dari versi lama jika masih ada di DOM. */
                footer.querySelectorAll('.message-check').forEach(function (check) {
                    check.remove();
                });
            });
        }

        function bindMessageInteractions(root) {
            if (!root) return;
            root.querySelectorAll('.message-row[data-message-id]').forEach(function (row) {
                if (row.dataset.interactionsBound === '1') return;
                row.dataset.interactionsBound = '1';
                restoreServerReactions(row, []);
                row.addEventListener('dblclick', function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    openMessageActions(row);
                });
            });
        }

        /* ==========================================================
           AUTO UPDATE PESAN
           ----------------------------------------------------------
           Pesan baru dicek otomatis setiap 1 detik.
           Tidak perlu refresh halaman.
        ========================================================== */

        const messagesContainer =
            document.getElementById('messages');

        const messagesUrl =
            @json(
                route(
                    'whisperly.chat.messages',
                    $booking->id
                )
            );

        let latestMessageId = null;
        let loadingMessages = false;

        if (messagesContainer) {

            const existingMessageRows =
                messagesContainer.querySelectorAll(
                    '.message-row[data-message-id]'
                );

            if (existingMessageRows.length > 0) {
                const lastRow =
                    existingMessageRows[
                        existingMessageRows.length - 1
                    ];

                latestMessageId =
                    lastRow.dataset.messageId;
            }

            function emojiImageForText(text) {
                const fragment = document.createDocumentFragment();
                const value = String(text || '');
                const tokenRegex = /\[\[WEMO:(\d{2})\]\]|\uE000(\d{2})\uE001|\u200B\u2060(\d{2})\u2060/g;

                /*
                 * Pesan lama pernah menyimpan ID emoji sebagai karakter biasa
                 * pada kondisi tertentu. Jika isi pesan memang hanya rangkaian
                 * emoji custom lalu dua digit ID, buang ID yatim tersebut agar
                 * angka seperti 28/26/06 tidak ikut tampil.
                 */
                const emojiKeysForCleanup = Object.keys(CUSTOM_EMOJI_FALLBACK)
                    .sort(function (a, b) { return b.length - a.length; });
                const escapedEmojiKeys = emojiKeysForCleanup
                    .map(function (emoji) {
                        return emoji.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                    })
                    .join('|');
                let cleanedValue = value;
                if (escapedEmojiKeys) {
                    const orphanIdRegex = new RegExp(
                        '^\\s*(?:(?:' + escapedEmojiKeys + ')\\s*)+\\d{2}\\s*$'
                    );
                    if (orphanIdRegex.test(cleanedValue)) {
                        cleanedValue = cleanedValue.replace(/\s*\d{2}\s*$/, '');
                    }
                }

                /* Token legacy dan token baru sama-sama didukung. */
                cleanedValue = cleanedValue.replace(/\u200B\u2060(\d{2})\u2060/g, '\uE000$1\uE001');
                const renderValue = cleanedValue;
                let last = 0;
                let match;

                function appendFallbackText(chunk) {
                    if (!chunk) return;
                    const emojiKeys = Object.keys(CUSTOM_EMOJI_FALLBACK).sort(function (a, b) {
                        return b.length - a.length;
                    });
                    let i = 0;
                    let buffer = '';
                    function flush() {
                        if (buffer) {
                            fragment.appendChild(document.createTextNode(buffer));
                            buffer = '';
                        }
                    }
                    while (i < chunk.length) {
                        let found = null;
                        for (let j = 0; j < emojiKeys.length; j++) {
                            const key = emojiKeys[j];
                            if (chunk.startsWith(key, i)) {
                                found = key;
                                break;
                            }
                        }
                        if (!found) {
                            buffer += chunk[i++];
                            continue;
                        }
                        flush();
                        const id = CUSTOM_EMOJI_FALLBACK[found];
                        const item = CUSTOM_EMOJI_MAP[id];
                        const img = document.createElement('img');
                        img.className = 'custom-emoji-inline message-custom-emoji';
                        img.src = '{{ asset('assets/images') }}/' + item.file;
                        img.alt = found;
                        img.title = found;
                        img.draggable = false;
                        fragment.appendChild(img);
                        i += found.length;
                    }
                    flush();
                }

                while ((match = tokenRegex.exec(renderValue)) !== null) {
                    appendFallbackText(renderValue.slice(last, match.index));
                    const id = match[1] || match[2] || match[3];
                    const item = CUSTOM_EMOJI_MAP[id];
                    if (item) {
                        const img = document.createElement('img');
                        img.className = 'custom-emoji-inline message-custom-emoji';
                        img.src = '{{ asset('assets/images') }}/' + item.file;
                        img.alt = item.emoji;
                        img.title = item.emoji;
                        img.draggable = false;
                        fragment.appendChild(img);
                    } else {
                        appendFallbackText(match[0]);
                    }
                    last = tokenRegex.lastIndex;
                }

                appendFallbackText(renderValue.slice(last));
                return fragment;
            }

            function renderCustomEmojiElement(element) {
                if (!element || element.dataset.customEmojiRendered === '1') {
                    return;
                }

                const text = element.textContent || '';
                if (!text) return;

                const fragment = emojiImageForText(text);
                element.innerHTML = '';
                element.appendChild(fragment);
                element.dataset.customEmojiRendered = '1';
            }

            function renderCustomEmojisInMessages(root) {
                if (!root) return;

                root.querySelectorAll('.message-text').forEach(function (element) {
                    renderCustomEmojiElement(element);
                });
            }

            /*
             * SIDEBAR PREVIEW
             * ----------------
             * Preview sidebar harus mengambil pesan TERAKHIR yang benar-benar
             * sedang tampil di room ini, bukan bergantung pada nilai
             * $item->last_message dari hasil render controller.
             *
             * Dengan begitu:
             * - kalau room berisi "bg", "woi", "kenapa", "ada apa", "nbg",
             *   preview menjadi "nbg";
             * - kalau chat baru saja menerima pesan, preview ikut berubah;
             * - kalau pesan terakhir dihapus, preview mundur ke pesan sebelumnya.
             */
            function syncActiveSidebarPreview() {
                const activeChat = document.querySelector(
                    '.chat-item.active'
                );

                if (!activeChat || !messagesContainer) {
                    return;
                }

                const preview = activeChat.querySelector(
                    '.chat-preview'
                );

                const time = activeChat.querySelector(
                    '.chat-time'
                );

                if (!preview) {
                    return;
                }

                const rows = Array.from(
                    messagesContainer.querySelectorAll(
                        '.message-row[data-message-id]'
                    )
                );

                if (rows.length === 0) {
                    preview.textContent = 'Belum ada pesan';
                    return;
                }

                const lastRow = rows[rows.length - 1];
                let previewText = getMessagePlainText(lastRow).trim();

                /*
                 * Pesan foto tanpa teks tidak mempunyai message-text.
                 * Tetap tampilkan keterangan agar preview tidak kosong.
                 */
                if (!previewText && lastRow.querySelector('.message-image')) {
                    previewText = '📷 Foto';
                }

                if (!previewText) {
                    previewText = 'Pesan';
                }

                /*
                 * Samakan batas preview dengan tampilan server-side.
                 */
                if (previewText.length > 35) {
                    previewText = previewText.substring(0, 35).trimEnd() + '...';
                }

                preview.textContent = previewText;

                /*
                 * Ambil jam dari bubble terakhir yang benar-benar tampil.
                 */
                const lastTime = lastRow.querySelector('.message-time');

                if (time && lastTime) {
                    const timeText = lastTime.textContent.trim();

                    if (timeText) {
                        time.textContent = timeText;
                    }
                }
            }

            function loadNewMessages() {

                if (loadingMessages) {
                    return;
                }

                loadingMessages = true;

                fetch(
                    messagesUrl,
                    {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        cache: 'no-store'
                    }
                )
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Gagal mengambil pesan.');
                        }

                        return response.json();
                    })
                    .then(function (data) {

                        if (
                            !data.messages ||
                            !Array.isArray(data.messages)
                        ) {
                            return;
                        }

                        /*
                         * Sinkronkan reaction/read state sekaligus hapus pesan
                         * yang sudah benar-benar dihapus dari database.
                         * Jadi kalau user A menekan Hapus, user B yang sedang
                         * membuka room yang sama juga kehilangan pesan itu
                         * pada polling berikutnya tanpa refresh.
                         */
                        const serverIds = new Set(
                            data.messages.map(function (message) {
                                return String(message.id);
                            })
                        );

                        messagesContainer
                            .querySelectorAll('.message-row[data-message-id]')
                            .forEach(function (row) {
                                const id = String(row.dataset.messageId || '');

                                if (id && !serverIds.has(id)) {
                                    row.remove();
                                }
                            });

                        data.messages.forEach(function (message) {
                            const row = messagesContainer.querySelector(
                                '.message-row[data-message-id="' + message.id + '"]'
                            );

                            if (row) {
                                restoreServerReactions(row, message.reactions || []);
                                row.dataset.isRead = message.is_read ? '1' : '0';
                            }
                        });

                        /*
                         * Gunakan semua ID yang sudah ada di DOM.
                         * Jangan hanya membandingkan latestMessageId karena
                         * room dapat berisi riwayat dari beberapa booking.
                         */
                        const existingIds = new Set();

                        messagesContainer
                            .querySelectorAll(
                                '.message-row[data-message-id]'
                            )
                            .forEach(function (row) {
                                existingIds.add(
                                    String(row.dataset.messageId)
                                );
                            });

                        const newMessages =
                            data.messages.filter(
                                function (message) {
                                    const id = String(message.id);
                                    return !existingIds.has(id);
                                }
                            );

                        if (newMessages.length === 0) {
                            if (data.messages.length > 0) {
                                latestMessageId =
                                    data.messages[
                                        data.messages.length - 1
                                    ].id;
                            }

                            updateOutgoingMessageChecks(messagesContainer);
                            syncActiveSidebarPreview();
                            return;
                        }

                        messagesContainer
                            .querySelectorAll(
                                '.empty-message, .empty-message-small'
                            )
                            .forEach(function (element) {
                                element.remove();
                            });

                        newMessages.forEach(
                            function (message) {
                                appendNewMessage(message);
                            }
                        );

                        if (data.messages.length > 0) {
                            latestMessageId =
                                data.messages[
                                    data.messages.length - 1
                                ].id;
                        }

                        updateOutgoingMessageChecks(messagesContainer);
                        syncActiveSidebarPreview();

                        messagesContainer.scrollTop =
                            messagesContainer.scrollHeight;
                    })
                    .catch(function () {
                        /* Polling akan mencoba lagi. */
                    })
                    .finally(function () {
                        loadingMessages = false;
                    });
            }

            function appendNewMessage(message) {

                if (!messagesContainer) {
                    return;
                }

                if (
                    messagesContainer.querySelector(
                        '[data-message-id="' + message.id + '"]'
                    )
                ) {
                    return;
                }

                const currentUserId =
                    '{{ $currentUser->id }}';

                const mine =
                    String(message.sender_id) ===
                    String(currentUserId);

                const senderName =
                    mine
                        ? 'Anda'
                        : (
                            message.sender_name ||
                            '{{ $otherName }}'
                        );

                const senderInitial =
                    senderName
                        .substring(0, 1)
                        .toUpperCase();

                const row =
                    document.createElement('div');

                row.className =
                    'message-row ' +
                    (mine ? 'sent' : 'received');

                row.dataset.messageId =
                    message.id;
                row.dataset.senderId =
                    String(message.sender_id || '');
                row.dataset.isRead =
                    message.is_read ? '1' : '0';

                const avatar =
                    document.createElement('div');

                avatar.className =
                    'message-avatar';

                avatar.textContent =
                    senderInitial;

                const content =
                    document.createElement('div');

                content.className =
                    'message-content';

                const sender =
                    document.createElement('div');

                sender.className =
                    'sender-name';

                sender.textContent =
                    senderName;

                const bubble =
                    document.createElement('div');

                bubble.className =
                    'message-bubble';

                const rawText = String(message.message || '');
                const replyMatch = rawText.match(/^↪\s*([^:]+):\s*"(.*?)"\s*\n(.*)$/s);
                const displayText = replyMatch ? replyMatch[3] : rawText;
                bubble.dataset.plainText = displayText;

                if (message.image_url) {
                    const image = document.createElement('img');
                    image.className = 'message-image';
                    image.src = message.image_url;
                    image.alt = 'Foto yang dikirim';
                    image.loading = 'lazy';
                    bubble.appendChild(image);
                    if (!displayText) bubble.classList.add('image-only');
                }

                if (replyMatch) {
                    const quote = document.createElement('div');
                    quote.className = 'message-reply-quote';
                    quote.textContent = replyMatch[1] + ': “' + replyMatch[2] + '”';
                    bubble.appendChild(quote);
                }

                if (displayText) {
                    const textNode = document.createElement('div');
                    textNode.className = 'message-text';

                    /*
                     * WAJIB isi textContent sebelum dirender.
                     * Sebelumnya textNode masih kosong ketika
                     * renderCustomEmojiElement() dipanggil, sehingga pesan
                     * baru bisa tampil sebagai bubble kecil/kosong sampai
                     * halaman direfresh.
                     */
                    textNode.textContent = displayText;
                    bubble.appendChild(textNode);
                    renderCustomEmojiElement(textNode);
                }

                const footer =
                    document.createElement('div');

                footer.className =
                    'message-footer';

                const time =
                    document.createElement('div');

                time.className =
                    'message-time';

                time.textContent =
                    message.time || '';

                footer.appendChild(time);

                content.appendChild(sender);
                content.appendChild(bubble);

                const reaction = document.createElement('span');
                reaction.className = 'message-reaction';
                reaction.setAttribute('aria-label', 'Reaksi');
                content.appendChild(reaction);

                renderMessageReactions(row, message.reactions || []);

                content.appendChild(footer);

                row.appendChild(avatar);
                row.appendChild(content);

                row.dataset.senderName = senderName;
                messagesContainer.appendChild(row);
                bindMessageInteractions(messagesContainer);
                updateOutgoingMessageChecks(messagesContainer);
            }

            bindMessageInteractions(messagesContainer);
            updateOutgoingMessageChecks(messagesContainer);
            syncActiveSidebarPreview();

            /*
             * Ubah emoji Unicode yang sudah ada pada riwayat menjadi
             * gambar custom sejak halaman pertama kali dibuka.
             */
            renderCustomEmojisInMessages(messagesContainer);

            /* Cek langsung saat halaman dibuka, lalu setiap 1 detik. */
            loadNewMessages();

            setInterval(
                loadNewMessages,
                1000
            );
        }

    </script>

</body>

</html>
