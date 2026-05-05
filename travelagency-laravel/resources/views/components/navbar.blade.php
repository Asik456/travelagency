<nav class="navbar">
    <a href="/" class="logo">✈️ TravelAgency</a>

    <div class="nav-menu" id="nav-menu">
        @if(session('user_id'))
            <a href="/home">{{ __('lang.home') }}</a>
            @if(session('user_role') === 'admin')
                <a href="/dashboard">{{ __('lang.add_tour') }}</a>
                <a href="/users">User Management</a>
            @endif
        @endif
    </div>

    <div class="nav-right">
        {{-- Language switcher --}}
        <div class="lang-switcher">
            <form method="POST" action="/language/switch" style="display:inline">
                @csrf
                <input type="hidden" name="lang" value="en">
                <button type="submit" class="lang-btn {{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</button>
            </form>
            <form method="POST" action="/language/switch" style="display:inline">
                @csrf
                <input type="hidden" name="lang" value="ru">
                <button type="submit" class="lang-btn {{ app()->getLocale() === 'ru' ? 'active' : '' }}">RU</button>
            </form>
            <form method="POST" action="/language/switch" style="display:inline">
                @csrf
                <input type="hidden" name="lang" value="kk">
                <button type="submit" class="lang-btn {{ app()->getLocale() === 'kk' ? 'active' : '' }}">KK</button>
            </form>
        </div>

        @if(session('user_id'))
            <div class="user-info">
                <span class="user-name">{{ session('user_name') }}</span>
                <span class="role-badge role-{{ session('user_role') }}">{{ strtoupper(session('user_role')) }}</span>
            </div>
            <a href="/logout" class="btn-nav btn-logout">{{ __('lang.logout') }}</a>
        @else
            <a href="/login" class="btn-nav btn-login">{{ __('lang.login') }}</a>
            <a href="/register" class="btn-nav btn-register">{{ __('lang.register') }}</a>
        @endif

        <button class="burger" onclick="toggleMenu()" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<style>
    .navbar {
        background: white;
        padding: 12px 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
        gap: 10px;
    }
    .logo { font-size: 20px; font-weight: bold; color: #667eea; text-decoration: none; white-space: nowrap; }
    .nav-menu { display: flex; gap: 20px; align-items: center; }
    .nav-menu a { text-decoration: none; color: #333; font-weight: 500; font-size: 0.95rem; padding: 6px 12px; border-radius: 6px; transition: all 0.3s; }
    .nav-menu a:hover { background: #f0f4ff; color: #667eea; }
    .nav-right { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .user-info { display: flex; align-items: center; gap: 8px; }
    .user-name { color: #333; font-weight: 600; font-size: 0.9rem; }
    .role-badge { padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
    .role-admin { background: #fef3c7; color: #d97706; }
    .role-traveler { background: #dbeafe; color: #1d4ed8; }
    .btn-nav { padding: 8px 18px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.3s; white-space: nowrap; }
    .btn-login { background: white; color: #667eea; border: 2px solid #667eea; }
    .btn-login:hover { background: #667eea; color: white; }
    .btn-register { background: #667eea; color: white; border: 2px solid #667eea; }
    .btn-register:hover { background: #764ba2; border-color: #764ba2; }
    .btn-logout { background: #dc3545; color: white; border: 2px solid #dc3545; }
    .btn-logout:hover { background: #c82333; }
    .lang-switcher { display: flex; gap: 3px; }
    .lang-btn { padding: 5px 10px; border: 2px solid #e0e0e0; border-radius: 6px; background: white; cursor: pointer; font-size: 0.78rem; font-weight: 700; transition: all 0.3s; }
    .lang-btn:hover, .lang-btn.active { background: #667eea; color: white; border-color: #667eea; }
    .burger { display: none; flex-direction: column; gap: 5px; background: none; border: none; cursor: pointer; padding: 5px; }
    .burger span { display: block; width: 25px; height: 3px; background: #333; border-radius: 3px; transition: all 0.3s; }

    @media (max-width: 900px) {
        .nav-menu { display: none; position: absolute; top: 65px; left: 0; right: 0; background: white; flex-direction: column; padding: 15px 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); gap: 5px; }
        .nav-menu.open { display: flex; }
        .burger { display: flex; }
    }
    @media (max-width: 600px) {
        .navbar { padding: 12px 15px; }
        .user-name { display: none; }
        .btn-nav { padding: 7px 12px; font-size: 0.82rem; }
        .lang-btn { padding: 4px 7px; font-size: 0.72rem; }
    }
</style>

<script>
    function toggleMenu() {
        document.getElementById('nav-menu').classList.toggle('open');
    }
</script>
