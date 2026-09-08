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

            background-size: cover;

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

            background: rgba(255, 255, 255, .96);

            border-radius: 28px;

            overflow: hidden;

            box-shadow:
                0 20px 60px
                rgba(35, 101, 160, .20);
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

            background:
                rgba(255, 255, 255, .96);

            border-bottom:
                1px solid #d7e8fa;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                0 28px;
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

            box-shadow: 0 8px 20px rgba(35, 101, 160, .16);
        }


        .info-menu-list form {

            margin: 0;
        }


        .info-menu-list button {

            width: 100%;

            padding: 8px 10px;

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

            background: rgba(0, 0, 0, 0.5);

            display: none;

            align-items: center;

            justify-content: flex-end;

            z-index: 1000;

            opacity: 0;

            transition: opacity 0.3s ease;
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

            animation: slideInRight 0.3s ease;

            box-shadow: -10px 0 40px rgba(35, 101, 160, 0.15);
        }

        @keyframes slideInRight {

            from {

                transform: translateX(100%);

                opacity: 0;
            }

            to {

                transform: translateX(0);

                opacity: 1;
            }
        }

        .account-info-header {

            padding: 28px 24px;

            border-bottom: 1px solid #e4f0ff;

            display: flex;

            align-items: center;

            justify-content: space-between;
        }

        .account-info-header h3 {

            margin: 0;

            font-family: Georgia, serif;

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

            transition: 0.2s ease;

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

            border-bottom: 1px solid #e4f0ff;
        }

        .account-profile-avatar {

            width: 100px;

            height: 100px;

            margin: 0 auto 18px;

            border-radius: 50%;

            background: linear-gradient(135deg, #c8e5ff, #9fd0fa);

            color: #1976d2;

            font-size: 42px;

            font-weight: 700;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow: 0 8px 24px rgba(25, 118, 210, 0.18);
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

            padding: 6px 14px;

            border-radius: 20px;

            background: #f0f6ff;

            color: #1976d2;
        }

        .account-status.online {

            background: rgba(35, 190, 104, 0.12);

            color: #23be68;
        }

        .account-status.offline {

            background: rgba(102, 128, 155, 0.12);

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

            border-bottom: 1px solid #f0f6ff;
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

            letter-spacing: 0.5px;
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

            grid-template-columns: 1fr 1fr;

            gap: 14px;

            margin-bottom: 20px;
        }

        .account-booking-item {

            background: #f8fcff;

            padding: 14px 12px;

            border-radius: 12px;

            border: 1px solid #e4f0ff;

            text-align: center;
        }

        .account-booking-item-label {

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;

            color: #7890a8;

            margin-bottom: 6px;

            letter-spacing: 0.5px;
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
           MESSAGES AREA
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

            padding:
                15px;

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


        /* ==========================================================
           MESSAGE AVATAR
        ========================================================== */

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


        /* ==========================================================
           MESSAGE CONTENT
        ========================================================== */

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


        /* ==========================================================
           MESSAGE FOOTER
        ========================================================== */

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


        /* ==========================================================
           CHECKLIST PESAN
        ========================================================== */

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


        /* Satu centang */

        .message-check.single {

            color: #6f879d;

            letter-spacing: 0;
        }


        /* Dua centang */

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


        /* ==========================================================
           EMPTY MESSAGE
        ========================================================== */

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

            width: 100%;

            padding:
                15px 24px 20px;

            background:
                rgba(255, 255, 255, .97);

            border-top:
                1px solid #d5e7f8;

            position: relative;

            z-index: 5;
        }


        .composer form {

            width: 100%;

            display: flex;

            align-items: flex-end;

            gap: 10px;
        }


        .composer textarea {flex: 1;

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
           CLOSED COMPOSER
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


                {{-- SEARCH --}}

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


                {{-- FILTER --}}

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


                        /*
                        |--------------------------------------
                        | AMBIL PESAN TERAKHIR
                        |--------------------------------------
                        |
                        | PENTING:
                        | $item adalah booking REPRESENTATIF room
                        | (dipilih dari created_at booking, BUKAN
                        | dari pesan terakhir). Kalau pesan terakhir
                        | diambil dari $item->conversation saja, hasilnya
                        | bisa beda dengan room chat di sebelah kanan
                        | (yang menggabungkan semua booking di room).
                        |
                        | Maka dari itu, pesan terakhir yang benar
                        | sudah dihitung di controller (show()) dari
                        | SELURUH booking dalam room yang sama, lalu
                        | dititipkan lewat $item->last_message.
                        |--------------------------------------
                        */

                        $lastMessage =
                            $item->last_message
                            ?? null;


                        /*
                        |--------------------------------------
                        | WAKTU PESAN TERAKHIR
                        |--------------------------------------
                        */

                        $messageTime =
                            $lastMessage
                                ? $lastMessage->created_at->format('H:i')
                                : substr(
                                    $item->schedule?->start_time
                                    ?? '00:00',
                                    0,
                                    5
                                );


                        /*
                        |--------------------------------------
                        | STATUS PESAN TERAKHIR
                        | UNTUK CHECKLIST DAN BADGE
                        |--------------------------------------
                        */

                        $isLastMessageFromCurrentUser = false;
                        $lastMessageIsRead = true;

                        if ($lastMessage) {

                            $isLastMessageFromCurrentUser =
                                (string) $lastMessage->sender_id
                                ===
                                (string) $currentUser->id;

                            if ($isLastMessageFromCurrentUser) {

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

                        {{-- AVATAR --}}

                        <div class="avatar">

                            {{ $itemInitial }}

                        </div>


                        {{-- INFO --}}

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


                        {{-- RIGHT SIDE --}}

                        <div style="
                            display:flex;
                            flex-direction:column;
                            align-items:flex-end;
                            gap:7px;
                        ">

                            <div class="chat-time">

                                {{ $messageTime }}

                            </div>


                            {{-- INDIKATOR PESAN TERAKHIR --}}

                            @if ($lastMessage)

                                @if ($isLastMessageFromCurrentUser)

                                    {{-- CHECKLIST UNTUK PESAN DARI USER LOGIN --}}

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

                                    {{-- BADGE UNREAD UNTUK PESAN DARI ORANG LAIN --}}

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


                        <div class="online-text" id="roomPresenceStatus">

                            {{ $contactStatus }}

                        </div>

                    </div>

                </div>



                {{-- PROFILE --}}

                <details class="info-menu" onclick="event.stopPropagation()">
                    <summary class="info-button" aria-label="Menu informasi chat">☰</summary>
                    <div class="info-menu-list" onclick="event.stopPropagation()">
                        <button type="button" id="accountInfoToggle">Informasi Akun</button>
                        <form method="POST" action="{{ route('whisperly.chat.clear', $booking->id) }}" onsubmit="return confirm('Bersihkan seluruh isi chat ini dari akun Anda?')">
                            @csrf
                            <button type="submit">Bersihkan Chat</button>
                        </form>
                        <form method="POST" action="{{ route('whisperly.chat.delete', $booking->id) }}" onsubmit="return confirm('Hapus chat ini dari akun Anda?')">
                            @csrf
                            <button type="submit">Hapus Chat</button>
                        </form>
                    </div>
                </details>

            </header>



            {{-- ====================================================
                 JADWAL BOOKING AKTIF
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



                    {{-- ==================================================
                         PEMBATAS BOOKING
                    =================================================== --}}

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



                    {{-- ==================================================
                         PESAN BOOKING
                    =================================================== --}}

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

                            {{-- AVATAR --}}

                            <div class="message-avatar">

                                {{ $senderInitial }}

                            </div>


                            {{-- CONTENT --}}

                            <div class="message-content">

                                <div class="sender-name">

                                    {{ $mine
                                        ? 'Anda'
                                        : ucfirst($senderName) }}

                                </div>


                                <div class="message-bubble">

                                    {{ $message->message }}

                                </div>


                                {{-- WAKTU + CHECKLIST --}}

                                <div class="message-footer">

                                    <div class="message-time">

                                        {{ $message->created_at
                                            ?->format('H:i') }}

                                    </div>


                                    @if ($mine)

                                        @php

                                            /*
                                             * Jika nanti controller/model
                                             * sudah memiliki status read,
                                             * gunakan nilai tersebut.
                                             *
                                             * Untuk sekarang:
                                             * pesan dianggap terkirim.
                                             */

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



            {{-- ========================================================
                 COMPOSER
            ========================================================= --}}

            <div class="composer">

                @if ($canChat)

                    <form
                        method="POST"
                        action="{{ route(
                            'whisperly.chat.store',
                            $booking->id
                        ) }}"
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
                            title="Kirim pesan"
                        >

                            ➤

                        </button>

                    </form>

                @else

                    <div class="closed-composer">

                        🔒

                        <span>

                            Chat sudah ditutup
                            karena waktu booking
                            telah selesai.

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

                {{-- HEADER --}}

                <div class="account-info-header">

                    <h3>Informasi Akun</h3>

                    <button
                        type="button"
                        class="account-info-close"
                        id="accountInfoClose"
                    >
                        ✕
                    </button>

                </div>

                {{-- BODY --}}

                <div class="account-info-body">

                    {{-- PROFILE SECTION --}}

                    <div class="account-profile-section">

                        <div class="account-profile-avatar">

                            @if ($isUser && $talent?->photo)

                                <img
                                    src="{{ asset('storage/' . $talent->photo) }}"
                                    alt="Avatar {{ $otherName }}"
                                >

                            @else

                                {{ $otherInitial }}

                            @endif

                        </div>

                        <div class="account-name">
                            {{ ucfirst($otherName) }}
                        </div>

                        <div class="account-status {{ in_array($contactStatus, ['Online', 'Mengetik...'], true) ? 'online' : 'offline' }}" id="profilePresenceStatus">
                            <span class="account-status-dot"></span>
                            {{ $contactStatus }}
                        </div>

                    </div>

                    {{-- BIO --}}

                    @if ($isUser && $talent?->deskripsi)

                        <div class="account-info-item">

                            <div class="account-info-label">
                                Tentang
                            </div>

                            <div class="account-info-value">
                                {{ $talent->deskripsi }}
                            </div>

                        </div>

                    @endif

                    {{-- BOOKING INFO --}}

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
                                        $booking->schedule?->start_time ?? '00:00',
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

                                    {{ round($booking->durationHours(), 1) }}h

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- STATUS BOOKING --}}

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

                    {{-- BOOKING DATE --}}

                    <div class="account-info-item">

                        <div class="account-info-label">
                            Tanggal Booking
                        </div>

                        <div class="account-info-value">

                            {{ $booking->created_at?->format('d M Y') ?? '-' }}

                        </div>

                    </div>

                    {{-- TOTAL MESSAGES --}}

                    <div class="account-info-item">

                        <div class="account-info-label">
                            Total Pesan
                        </div>

                        <div class="account-info-value">

                            <strong>{{ $messages->count() }} pesan</strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>



    {{-- ================================================================
         POPUP BOOKING SELESAI
    ================================================================= --}}

    @if ($status === 'completed')

        <div
            class="modal-overlay"
            id="bookingFinishedModal"
        >

            <div class="modal">

                <div class="modal-icon">

                    ✓

                </div>


                <h3>

                    Booking Selesai

                </h3>


                <p>

                    Waktu booking dengan

                    <strong>
                        {{ ucfirst($otherName) }}
                    </strong>

                    telah berakhir.

                    <br><br>

                    Chat ini sudah ditutup
                    dan kamu tidak dapat
                    mengirim pesan lagi.

                </p>


                <button
                    type="button"
                    class="modal-button"
                    onclick="closeFinishedModal()"
                >

                    Mengerti

                </button>

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
            document.querySelector('meta[name="csrf-token"]')?.content;

        const heartbeatUrl =
            @json(route('whisperly.chat.heartbeat'));

        const typingUrl =
            @json(route('whisperly.chat.typing'));

        const presenceUrl =
            @json(route('whisperly.chat.presence', $booking->id));

        function sendPresenceRequest(url, body = null) {
            return fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    ...(body ? {'Content-Type': 'application/json'} : {}),
                },
                body: body ? JSON.stringify(body) : null,
            });
        }

        function updateContactStatus() {
            fetch(presenceUrl, {
                headers: {'Accept': 'application/json'},
            })
                .then(response => response.json())
                .then(data => {
                    const status = data.status;
                    const roomStatus = document.getElementById('roomPresenceStatus');
                    const profileStatus = document.getElementById('profilePresenceStatus');

                    if (roomStatus) roomStatus.textContent = status;
                    if (profileStatus) {
                        profileStatus.lastChild.textContent = ` ${status}`;
                        profileStatus.classList.toggle('online', status !== 'Offline');
                        profileStatus.classList.toggle('offline', status === 'Offline');
                    }
                });
        }

        sendPresenceRequest(heartbeatUrl);
        updateContactStatus();
        setInterval(function () {
            sendPresenceRequest(heartbeatUrl);
            updateContactStatus();
        }, 10000);

        if (messageInput) {
            let typingTimer;

            messageInput.addEventListener('input', function () {
                sendPresenceRequest(typingUrl, {typing: true});
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function () {
                    sendPresenceRequest(typingUrl, {typing: false});
                }, 4500);
            });
        }



        /* ==========================================================
           SEARCH
        ========================================================== */

        const searchInput =
            document.getElementById('searchChat');


        function applyChatFilter() {

            const keyword =
                searchInput
                    ? searchInput.value
                        .toLowerCase()
                        .trim()
                    : '';


            const activeFilter =
                document
                    .querySelector('.filter.active')
                    ?.dataset.filter
                    ?? 'all';


            document
                .querySelectorAll('.chat-item')
                .forEach(function (item) {

                    const name =
                        item
                            .querySelector('.chat-name')
                            ?.textContent
                            .toLowerCase()
                            ?? '';


                    const preview =
                        item
                            .querySelector('.chat-preview')
                            ?.textContent
                            .toLowerCase()
                            ?? '';


                    const unread =
                        item.dataset.unread === '1';


                    const matchesSearch =
                        name.includes(keyword)
                        ||
                        preview.includes(keyword);


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

                });

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
            .forEach(function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        document
                            .querySelectorAll('.filter')
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

            });



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
            document.getElementById('accountInfoPanel');

        const accountInfoToggle =
            document.getElementById('accountInfoToggle');

        const accountInfoClose =
            document.getElementById('accountInfoClose');


        // Open panel
        if (accountInfoToggle) {

            accountInfoToggle.addEventListener('click', function() {

                if (accountInfoPanel) {

                    accountInfoPanel.classList.add('active');

                }

            });

        }


        // Close panel with button
        if (accountInfoClose) {

            accountInfoClose.addEventListener('click', function() {

                if (accountInfoPanel) {

                    accountInfoPanel.classList.remove('active');

                }

            });

        }


        // Close panel with background click
        if (accountInfoPanel) {

            accountInfoPanel.addEventListener('click', function(e) {

                if (e.target === accountInfoPanel) {

                    accountInfoPanel.classList.remove('active');

                }

            });

        }

        if (
            accountInfoPanel
            && new URLSearchParams(window.location.search).get('info') === '1'
        ) {
            accountInfoPanel.classList.add('active');
        }

    </script>

</body>

</html>