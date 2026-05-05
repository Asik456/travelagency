<footer class="footer">
    <div class="footer-container">
        <div class="footer-col">
            <h3>✈️ TravelAgency</h3>
            <p>{{ __('lang.about_text') }}</p>
        </div>
        <div class="footer-col">
            <h4>{{ __('lang.quick_links') }}</h4>
            <ul>
                <li><a href="/">{{ __('lang.home') }}</a></li>
                @if(session('user_id'))
                    <li><a href="/home">{{ __('lang.discover') }}</a></li>
                    @if(session('user_role') === 'admin')
                        <li><a href="/dashboard">{{ __('lang.create_tour') }}</a></li>
                        <li><a href="/users">{{ __('lang.user_management') }}</a></li>
                    @else
                        <li><a href="/home">{{ __('lang.my_reservations') }}</a></li>
                    @endif
                    <li><a href="/logout">{{ __('lang.logout') }}</a></li>
                @else
                    <li><a href="/login">{{ __('lang.login') }}</a></li>
                    <li><a href="/register">{{ __('lang.register') }}</a></li>
                @endif
            </ul>
        </div>
        <div class="footer-col">
            <h4>{{ __('lang.contact_us') }}</h4>
            <p>📧 info@travelagency.com</p>
            <p>📱 +7 777 123 4567</p>
            <p>📍 Almaty, Kazakhstan</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} TravelAgency. {{ __('lang.all_rights') }}</p>
    </div>
</footer>

<style>
    .footer { background: #1a1a2e; color: #ccc; margin-top: auto; }
    .footer-container { max-width: 1200px; margin: 0 auto; padding: 50px 30px 30px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; }
    .footer-col h3 { color: #667eea; font-size: 1.2rem; margin-bottom: 15px; }
    .footer-col h4 { color: white; font-size: 1rem; margin-bottom: 15px; }
    .footer-col p { font-size: 0.9rem; line-height: 1.7; margin-bottom: 8px; }
    .footer-col ul { list-style: none; }
    .footer-col ul li { margin-bottom: 8px; }
    .footer-col ul li a { color: #ccc; text-decoration: none; font-size: 0.9rem; transition: color 0.3s; }
    .footer-col ul li a:hover { color: #667eea; }
    .footer-bottom { border-top: 1px solid #333; text-align: center; padding: 20px 30px; font-size: 0.85rem; color: #888; }

    @media (max-width: 600px) {
        .footer-container { padding: 30px 20px 20px; gap: 25px; }
    }
</style>
