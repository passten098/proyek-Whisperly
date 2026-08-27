<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat dengan {{ auth('whisperly')->user()->role === 'user' ? ($booking->talent?->pengguna?->username ?? 'Talent') : ($booking->pengguna?->username ?? 'User') }}</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: #f4c5d2; color: #241b31; font-family: Arial, sans-serif; }
        .layout { width: min(1100px, calc(100% - 32px)); margin: 120px auto 40px; display: grid; grid-template-columns: 320px 1fr; gap: 20px; }
        .card { background: rgba(255,255,255,.82); border-radius: 24px; box-shadow: 0 20px 50px rgba(94,45,76,.15); }
        .profile { padding: 24px; }
        .profile h2 { margin: 0 0 8px; font: 400 30px Georgia, serif; }
        .profile p { color: #65455d; line-height: 1.7; }
        .schedule-box { margin-top: 18px; padding: 14px 16px; border-radius: 14px; background: #f8e5ea; }
        .chat { display: flex; flex-direction: column; min-height: 620px; overflow: hidden; }
        .chat-header { padding: 22px 28px; border-bottom: 1px solid rgba(95,69,81,.12); }
        .chat-header h3 { margin: 0; font-size: 30px; }
        .messages { display: flex; flex-direction: column; gap: 12px; padding: 20px 24px; flex: 1; background: rgba(255,255,255,.28); }
        .message { max-width: 72%; padding: 12px 16px; border-radius: 16px; line-height: 1.5; }
        .message.sent { align-self: flex-end; background: #eea9bf; color: #2e1d2b; }
        .message.received { align-self: flex-start; background: #f0e3ea; color: #2e1d2b; }
        .composer { padding: 18px 24px 22px; border-top: 1px solid rgba(95,69,81,.12); }
        form { display: flex; gap: 10px; }
        textarea { flex: 1; min-height: 52px; resize: vertical; border: 1px solid #d8c8cf; border-radius: 12px; padding: 12px 14px; font: 14px Arial, sans-serif; }
        button { border: 0; border-radius: 12px; background: #241b31; color: #fff; padding: 0 18px; font-weight: 700; cursor: pointer; }
        button:disabled { background: #bba7b2; cursor: not-allowed; }
        .notice { padding: 12px 16px; margin: 18px 0 0; border-radius: 12px; background: #f6e7ec; color: #69485e; }
        @media (max-width: 820px) { .layout { grid-template-columns: 1fr; } .chat { min-height: 500px; } }
    </style>
</head>
<body>
    @include('whisperly.navbar')
    <main class="layout">
        <aside class="card profile">
            <h2>{{ auth('whisperly')->user()->role === 'user' ? ucfirst($booking->talent?->pengguna?->username) : ucfirst($booking->pengguna?->username) }}</h2>
            <p>{{ auth('whisperly')->user()->role === 'user' ? ($booking->talent?->deskripsi ?? 'Profil talent.') : 'User yang melakukan booking.' }}</p>
            <div class="schedule-box">
                <strong>Jadwal</strong><br>
                {{ substr($booking->schedule?->start_time ?? '00:00', 0, 5) }} - {{ substr($booking->schedule?->end_time ?? '00:00', 0, 5) }}
            </div>
            @if ($notice)
                <div class="notice">{{ $notice }}</div>
            @endif
            
            @if ($status === 'completed' && auth('whisperly')->user()->role === 'user' && ! $booking->ratings()->where('pengguna_id', auth('whisperly')->id())->exists())
                <div class="notice" style="margin-top: 16px;">
                    <strong>Bagaimana pengalamanmu dengan talent ini?</strong>
                    <form method="POST" action="{{ route('whisperly.bookings.rating.store', $booking->id) }}" style="display: grid; gap: 10px; margin-top: 12px;">
                        @csrf
                        <label style="display: grid; gap: 6px;">
                            <span>Rating (1-5)</span>
                            <select name="rating" required style="padding: 10px 12px; border: 1px solid #d8c8cf; border-radius: 10px;">
                                <option value="5">5 - Sangat bagus</option>
                                <option value="4">4 - Bagus</option>
                                <option value="3">3 - Cukup</option>
                                <option value="2">2 - Kurang</option>
                                <option value="1">1 - Buruk</option>
                            </select>
                        </label>
                        <label style="display: grid; gap: 6px;">
                            <span>Ulasan</span>
                            <textarea name="ulasan" rows="3" placeholder="Tulis ulasan singkat..." style="padding: 10px 12px; border: 1px solid #d8c8cf; border-radius: 10px; resize: vertical;"></textarea>
                        </label>
                        <button type="submit" style="padding: 12px 18px; border-radius: 10px;">Kirim Rating</button>
                    </form>
                </div>
            @endif
        </aside>

        <section class="card chat">
            <div class="chat-header">
                <h3>{{ auth('whisperly')->user()->role === 'user' ? ucfirst($booking->talent?->pengguna?->username) : ucfirst($booking->pengguna?->username) }}</h3>
            </div>
            <div class="messages">
                @forelse ($messages as $message)
                    @php $mine = $message->sender_id === auth('whisperly')->id(); @endphp
                    <div class="message {{ $mine ? 'sent' : 'received' }}">
                        {{ $message->message }}
                    </div>
                @empty
                    <div class="message received">Belum ada pesan untuk booking ini.</div>
                @endforelse
            </div>
            <div class="composer">
                @if ($canChat)
                    <form method="POST" action="{{ route('whisperly.chat.store', $booking->id) }}">
                        @csrf
                        <textarea name="message" placeholder="Ketik pesan..." required></textarea>
                        <button type="submit">Send</button>
                    </form>
                @else
                    <button type="button" disabled>Send</button>
                @endif
            </div>
        </section>
    </main>
</body>
</html>
