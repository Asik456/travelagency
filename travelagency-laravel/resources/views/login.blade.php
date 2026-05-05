<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('lang.login') }} - TravelAgency</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; flex-direction: column; }
        .page-center { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .card { background: white; border-radius: 20px; padding: 45px 40px; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
        .card h2 { text-align: center; color: #333; font-size: 1.8rem; margin-bottom: 8px; }
        .subtitle { text-align: center; color: #888; margin-bottom: 30px; font-size: 0.95rem; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 6px; color: #555; font-weight: 600; font-size: 0.9rem; }
        .form-group input { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s; }
        .form-group input:focus { outline: none; border-color: #667eea; }
        .btn-submit { width: 100%; padding: 14px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 10px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s; margin-top: 10px; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(102,126,234,0.4); }
        .footer-text { text-align: center; margin-top: 25px; color: #888; font-size: 0.9rem; }
        .footer-text a { color: #667eea; font-weight: 600; text-decoration: none; }
        .error-msg { background: #fff0f0; border: 1px solid #ffcccc; color: #cc0000; padding: 12px 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; }

        @media (max-width: 480px) {
            .card { padding: 30px 20px; border-radius: 15px; }
            .card h2 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
@include('components.navbar')

<div class="page-center">
    <div class="card">
        <h2>{{ __('lang.login') }}</h2>
        <p class="subtitle">{{ __('lang.sign_in') }}</p>

        @if($errors->any())
            <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/check-login">
            @csrf
            <div class="form-group">
                <label>{{ __('lang.email') }}</label>
                <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>{{ __('lang.password') }}</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-submit">{{ __('lang.sign_in') }}</button>
        </form>

        <div class="footer-text">
            {{ __('lang.no_account') }} <a href="/register">{{ __('lang.register') }}</a>
        </div>
    </div>
</div>
@include('components.footer')

</body>
</html>
