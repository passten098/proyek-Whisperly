<style>
    .whisperly-nav { position: fixed; top: 20px; left: 28px; right: 28px; z-index: 5; display: flex; align-items: center; justify-content: space-between; min-height: 70px; padding: 12px 16px 12px 24px; border-radius: 18px 18px 32px 32px; background: #17172f; }
    .whisperly-brand { color: #fbf8f2; font: 700 25px Georgia, serif; letter-spacing: .04em; text-decoration: none; }
    .whisperly-nav-right { display: flex; align-items: center; gap: 12px; }
    .whisperly-username { padding: 8px 15px; border: 1px solid rgba(255,255,255,.18); border-radius: 99px; color: #c7b6ef; font: 600 12px Arial, sans-serif; }
    .whisperly-menu-wrap { position: relative; }
    .whisperly-menu-button { width: 42px; height: 42px; border: 0; border-radius: 50%; color: #fff; background: rgba(255,255,255,.12); cursor: pointer; letter-spacing: 2px; }
    .whisperly-menu { position: absolute; top: 54px; right: 0; display: none; width: 180px; padding: 8px; border-radius: 14px; background: #1c1b38; box-shadow: 0 18px 40px rgba(0,0,0,.3); }
    .whisperly-menu.is-open { display: grid; }
    .whisperly-menu a, .whisperly-menu button { padding: 11px 12px; border: 0; border-radius: 9px; color: #f7f3ed; background: transparent; font: 14px Arial, sans-serif; text-align: left; text-decoration: none; cursor: pointer; }
    .whisperly-menu a:hover, .whisperly-menu button:hover { background: rgba(255,255,255,.1); }
    @media (max-width: 600px) { .whisperly-nav { top: 12px; left: 14px; right: 14px; padding-left: 16px; } .whisperly-brand { font-size: 20px; } }
</style>
<header class="whisperly-nav">
    <a class="whisperly-brand" href="{{ route('whisperly.home') }}">WHISPERLY</a>
    <div class="whisperly-nav-right">
        <span class="whisperly-username">{{ auth('whisperly')->user()->username }}</span>
        <div class="whisperly-menu-wrap">
            <button class="whisperly-menu-button" type="button" data-whisperly-menu-button aria-label="Buka menu">•••</button>
            <nav class="whisperly-menu" data-whisperly-menu aria-label="Menu utama">
                <a href="{{ route('whisperly.home') }}">Home</a>
                <a href="{{ route('pengaduan') }}">Pengaduan</a>
                <a href="{{ route('booking') }}">Booking</a>
                @if (auth('whisperly')->check() && in_array(auth('whisperly')->user()->role, ['user', 'talent'], true))
                    <a href="{{ route('whisperly.chat.index') }}">Chat</a>
                @endif
                <form method="POST" action="{{ route('logout.baru') }}">@csrf<button type="submit">Keluar</button></form>
            </nav>
        </div>
    </div>
</header>
<script>
    document.querySelectorAll('[data-whisperly-menu-button]').forEach((button) => {
        button.addEventListener('click', () => {
            button.nextElementSibling.classList.toggle('is-open');
        });
    });
</script>
