<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('lang.register') }} - TravelAgency</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; flex-direction: column; }
        .page-center { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .card { background: white; border-radius: 20px; padding: 45px 40px; width: 100%; max-width: 520px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
        .card h2 { text-align: center; color: #333; font-size: 1.8rem; margin-bottom: 8px; }
        .subtitle { text-align: center; color: #888; margin-bottom: 30px; font-size: 0.95rem; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; color: #555; font-weight: 600; font-size: 0.9rem; }
        .form-group input, .form-group select { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: border-color 0.3s; background: white; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: #667eea; }
        .info-box { background: #f0f4ff; border: 1px solid #c7d2fe; color: #4338ca; padding: 12px 15px; border-radius: 10px; margin-bottom: 18px; font-size: 0.9rem; text-align: center; }
        .checkbox-row { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .checkbox-row input[type=checkbox] { width: auto; }
        .btn-submit { width: 100%; padding: 14px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 10px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(102,126,234,0.4); }
        .footer-text { text-align: center; margin-top: 25px; color: #888; font-size: 0.9rem; }
        .footer-text a { color: #667eea; font-weight: 600; text-decoration: none; }
        .error-msg { background: #fff0f0; border: 1px solid #ffcccc; color: #cc0000; padding: 12px 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; }

        @media (max-width: 560px) {
            .form-row { grid-template-columns: 1fr; }
            .card { padding: 30px 20px; }
            .card h2 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
@include('components.navbar')

<div class="page-center">
    <div class="card">
        <h2>{{ __('lang.register') }}</h2>
        <p class="subtitle">Join thousands of travelers worldwide</p>

        @if($errors->any())
            <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/check-register">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>{{ __('lang.full_name') }}</label>
                    <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label>{{ __('lang.phone') }}</label>
                    <input type="tel" name="phone" placeholder="+7 777 000 0000" value="{{ old('phone') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('lang.email') }}</label>
                <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>{{ __('lang.dob') }}</label>
                    <input type="date" name="dob" value="{{ old('dob') }}" required>
                </div>
                <div class="form-group">
                    <label>{{ __('lang.country') }}</label>
                    <select name="country" required>
                        <option value="">Select...</option>
                        <option value="Kazakhstan" {{ old('country')=='Kazakhstan'?'selected':'' }}>Kazakhstan</option>
                        <option value="Turkey" {{ old('country')=='Turkey'?'selected':'' }}>Turkey</option>
                        <option value="Greece" {{ old('country')=='Greece'?'selected':'' }}>Greece</option>
                        <option value="Egypt" {{ old('country')=='Egypt'?'selected':'' }}>Egypt</option>
                        <option value="Italy" {{ old('country')=='Italy'?'selected':'' }}>Italy</option>
                        <option value="Norway" {{ old('country')=='Norway'?'selected':'' }}>Norway</option>
                        <option value="USA" {{ old('country')=='USA'?'selected':'' }}>USA</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>{{ __('lang.password') }}</label>
                    <input type="password" name="password" placeholder="Min 6 characters" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm" placeholder="Repeat password" required>
                </div>
            </div>
            <div class="info-box">ℹ️ You will be registered as a <strong>TRAVELER</strong></div>
            <div class="checkbox-row">
                <input type="checkbox" name="agree" id="agree" required>
                <label for="agree" style="font-weight:normal;margin:0;">I agree to Terms and Conditions</label>
            </div>
            <button type="submit" class="btn-submit">{{ __('lang.sign_up') }}</button>
        </form>

        <div class="footer-text">
            {{ __('lang.have_account') }} <a href="/login">{{ __('lang.login') }}</a>
        </div>
    </div>
</div>
@include('components.footer')

</body>

</html>
