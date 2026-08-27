<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Whisperly</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: #f4c5d2; color: #241b31; font-family: Arial, sans-serif; }
        main { width: min(980px, calc(100% - 32px)); margin: 120px auto 40px; }
        .panel { border-radius: 24px; background: rgba(255,255,255,.82); padding: 28px; box-shadow: 0 20px 50px rgba(94,45,76,.15); }
        h1 { margin: 0 0 22px; font: 400 clamp(34px, 6vw, 58px) Georgia, serif; }
        .list { display: grid; gap: 16px; }
        .item { display: flex; justify-content: space-between; gap: 18px; padding: 18px 20px; border: 1px solid rgba(103,64,83,.18); border-radius: 18px; background: #fff8fb; text-decoration: none; color: inherit; }
        .meta strong { display: block; font-size: 22px; }
        .summary { color: #65455d; margin-top: 6px; }
        .preview { margin-top: 10px; font-style: italic; color: #5a3e4c; }
        .status { white-space: nowrap; font-weight: 700; text-transform: capitalize; }
        .active { color: #2d6a41; } .completed { color: #6a4b5d; } .upcoming { color: #8a651e; }
    </style>
</head>
<body>
    @include('whisperly.navbar')
    <main>
        <section class="panel">
            <h1>{{ auth('whisperly')->user()->role === 'user' ? 'Chat Saya' : 'Chat Masuk' }}</h1>
            <div class="list">
                @forelse ($bookings as $booking)
                    @php
                        $otherUser = $booking->pengguna;
                        $otherName = $booking->pengguna?->username ?? 'User';
                        $lastMessage = $booking->conversation?->messages->last();
                        $status = $booking->chatStatus();
                    @endphp
                    <a class="item" href="{{ route('whisperly.chat.show', $booking->id) }}">
                        <div class="meta">
                            <strong>{{ auth('whisperly')->user()->role === 'user' ? ($booking->talent?->pengguna?->username ?? 'Talent') : $booking->pengguna?->username }}</strong>
                            <div class="summary">
                                {{ substr($booking->schedule?->start_time ?? '00:00', 0, 5) }} - {{ substr($booking->schedule?->end_time ?? '00:00', 0, 5) }}
                            </div>
                            @if ($lastMessage)
                                <div class="preview">"{{ Str::limit($lastMessage->message, 80) }}"</div>
                            @endif
                        </div>
                        <div class="status {{ $status }}">{{ $status === 'upcoming' ? 'Upcoming' : ($status === 'completed' ? 'Completed' : 'Active') }}</div>
                    </a>
                @empty
                    <p>Belum ada chat untuk booking Anda.</p>
                @endforelse
            </div>
        </section>
    </main>
</body>
</html>
