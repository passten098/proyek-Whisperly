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
                linear-gradient(
                    rgba(183,216,246,0.55),
                    rgba(183,216,246,0.55)
                ),
                url('{{ asset('assets/images/chat-background.jpg') }}');

            background-position: center;

            background-attachment: fixed;
        }


        /* ==========================================================
           WRAPPER
        ========================================================== */

        .chat-wrapper {

            width: calc(100% - 60px);

            max-width: 1700px;

            margin: 10px auto 5px;

            height: calc(100vh - 170px);

            min-height: 650px;

            display: grid;

            grid-template-columns: 360px minmax(0, 1fr);

            background: transparent;

            border-radius: 28px;

            overflow: hidden;

        }


        /* ==========================================================
           SIDEBAR
        ========================================================== */

        .sidebar {

    background: #ffffff;

    border-right: 1px solid #dceafb;

    display: flex;

    flex-direction: column;

    min-width: 0;

    min-height: 0;

    border-top-right-radius: 40px;

    border-bottom-right-radius: 40px;

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
                linear-gradient(
                    rgba(183,216,246,0.55),
                    rgba(183,216,246,0.55)
                ),
                url('{{ asset('assets/images/chat-background.jpg') }}');

            background-size: cover;

            background-position: center;

            background-repeat: no-repeat;

            position: relative;
        }


        /* ==========================================================
           ROOM HEADER
        ========================================================== */

        .room-header {
    height: 92px;
    min-height: 92px;
    flex-shrink: 0;

    margin: 12px 12px 0;

    background:
        rgba(255, 255, 255, .96);

    border:
        1px solid #d7e8fa;

    border-radius: 28px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding:
        0 28px;

    box-shadow:
        0 5px 15px
        rgba(51, 110, 160, .08);

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
        ========================================================== */

        .schedule {

            flex-shrink: 0;

            margin:
                16px 24px 0;

            padding:
                15px 18px;

            background:
                rgba(255, 255, 255, .92);

            border:
                1px solid #d6e8fa;

            border-radius: 15px;

            color: #47739f;

            font-size: 14px;

            box-shadow:
                0 5px 15px
                rgba(51, 110, 160, .08);
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
           MESSAGE ROW
        ========================================================== */

        .message-row {

            display: flex;

            align-items: flex-end;

            gap: 9px;

            max-width: 75%;

            flex-shrink: 0;
        }


        .message-row.sent {

            align-self: flex-end;

            flex-direction: row-reverse;
        }


        .message-row.received {

            align-self: flex-start;
        }


        .message-avatar {

            width: 35px;

            height: 35px;

            flex-shrink: 0;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #c6e4ff,
                    #75b9f5
                );

            color: #1169b8;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: 700;

            font-size: 13px;

            box-shadow:
                0 3px 10px
                rgba(39, 105, 160, .15);
        }


        .message-content {

            display: flex;

            flex-direction: column;

            min-width: 0;
        }


        .sender-name {

            font-size: 11px;

            color: #416584;

            margin:
                0 0 5px 7px;
        }


        .message-row.sent .sender-name {

            text-align: right;

            margin:
                0 7px 5px 0;
        }


        .message-bubble {

            padding:
                12px 16px;

            border-radius: 18px;

            font-size: 14px;

            line-height: 1.55;

            box-shadow:
                0 6px 18px
                rgba(37, 103, 161, .18);

            word-break: break-word;

            overflow-wrap: anywhere;
        }


        .message-row.received
        .message-bubble {

            background:
                rgba(239, 247, 255, .97);

            color: #244968;

            border-bottom-left-radius: 5px;
        }


        .message-row.sent
        .message-bubble {

            background:
                linear-gradient(
                    135deg,
                    #2587ed,
                    #1374d6
                );

            color: #ffffff;

            border-bottom-right-radius: 5px;

            box-shadow:
                0 7px 20px
                rgba(23, 113, 204, .30);
        }


        .message-footer {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 4px;

            margin-top: 5px;

            padding:
                0 5px;
        }


        .message-time {

            font-size: 10px;

            color: #6d88a2;
        }


        .message-row.sent .message-time {

            color: #5f7f9d;
        }


        .message-check {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            font-size: 13px;

            line-height: 1;

            font-weight: 700;

            letter-spacing: -4px;

            width: 18px;

            height: 14px;

            position: relative;

            margin-right: 2px;
        }


        .message-check.single {

            color: #6f879d;

            letter-spacing: 0;
        }


        .message-check.double {

            color: #2386e8;

            letter-spacing: -4px;
        }


        .message-check.double::before {

            content: "✓✓";
        }


        .message-check.double {

            font-size: 12px;
        }


        .empty-message {

            margin: auto;

            text-align: center;

            background:
                rgba(255, 255, 255, .75);

            padding:
                18px 25px;

            border-radius: 18px;

            color: #557492;

            box-shadow:
                0 5px 18px
                rgba(37, 103, 161, .10);

            flex-shrink: 0;
        }


        /* ==========================================================
           COMPOSER
        ========================================================== */

        .composer {
    flex-shrink: 0;

    width: calc(100% - 24px);

    margin: 0 12px 12px;

    padding:
        15px 24px 20px;

    background:
        rgba(255, 255, 255, .97);

    border:
        1px solid #d5e7f8;

    border-radius: 28px;

    position: relative;
    z-index: 5;

    box-shadow:
        0 5px 15px
        rgba(51, 110, 160, .08);
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

                margin-left:
                    14px;

                margin-right:
                    14px;
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

        $existingRating =
            $booking->ratings?->first();

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

                        <div class="avatar">

                            {{ $itemInitial }}

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

                        {{ $otherInitial }}

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
                        >

                            <div class="message-avatar">

                                {{ $senderInitial }}

                            </div>


                            <div class="message-content">

                                <div class="sender-name">

                                    {{ $mine
                                        ? 'Anda'
                                        : ucfirst($senderName) }}

                                </div>


                                <div class="message-bubble">

                                    {{ $message->message }}

                                </div>


                                <div class="message-footer">

                                    <div class="message-time">

                                        {{ $message->created_at
                                            ?->format('H:i') }}

                                    </div>


                                    @if ($mine)

                                        @php

                                            $isRead =
                                                $message->is_read
                                                ?? false;

                                        @endphp


                                        @if ($isRead)

                                            <span
                                                class="message-check double"
                                                title="Sudah dibaca"
                                            >
                                                ✓✓
                                            </span>

                                        @else

                                            <span
                                                class="message-check single"
                                                title="Terkirim"
                                            >
                                                ✓
                                            </span>

                                        @endif

                                    @endif

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
                    >
                        @csrf

                        <textarea
                            name="message"
                            id="messageInput"
                            placeholder="Ketik pesan..."
                            required
                            maxlength="2000"
                        ></textarea>

                        <button
                            type="submit"
                            class="send-button"
                            id="sendButton"
                            title="Kirim pesan"
                        >
                            ➤
                        </button>
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

                            @if (
                                $isUser
                                && $talent?->photo
                            )

                                <img
                                    src="{{ asset(
                                        'storage/' . $talent->photo
                                    ) }}"
                                    alt="Avatar {{ $otherName }}"
                                >

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

                            {{ $contactStatus }}

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
        @if ($isUser && ! $existingRating)
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


                    const roomStatus =
                        document.getElementById(
                            'roomPresenceStatus'
                        );


                    const profileStatus =
                        document.getElementById(
                            'profilePresenceStatus'
                        );


                    if (roomStatus) {

                        roomStatus.textContent =
                            status;

                    }


                    if (profileStatus) {

                        profileStatus.lastChild.textContent =
                            ` ${status}`;


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

                        this.form.requestSubmit();

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
                messageForm.querySelectorAll('textarea, button').forEach(function (el) {
                    el.disabled = true;
                });
            }

            if (messageInput) {
                messageInput.disabled = true;
                messageInput.placeholder = 'Sesi booking telah berakhir.';
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
            openRatingModal();
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
        @if ($isUser && $ratingAvailable && ! $existingRating)
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

        /* Jangan biarkan Enter mencoba mengirim pesan setelah timer habis. */
        if (messageForm) {
            messageForm.addEventListener('submit', function (event) {
                const endValue = chatComposer?.dataset.bookingEnd;
                const endTime = endValue ? new Date(endValue).getTime() : NaN;

                if (!Number.isNaN(endTime) && Date.now() >= endTime) {
                    event.preventDefault();
                    bookingExpired();
                }
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
    </script>

</body>

</html>