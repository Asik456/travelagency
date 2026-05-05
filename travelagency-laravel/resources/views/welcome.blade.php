<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelAgency</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; flex-direction: column; }

        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 60px 20px 40px;
        }

        .hero h1 {
            font-size: clamp(1.8rem, 5vw, 3.5rem);
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            line-height: 1.2;
        }

        .hero p {
            font-size: clamp(0.95rem, 2.5vw, 1.2rem);
            margin-bottom: 35px;
            opacity: 0.9;
            max-width: 500px;
        }

        .hero-btns {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 60px;
        }

        .btn-hero {
            padding: 14px 38px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s;
            min-width: 150px;
            text-align: center;
        }

        .btn-hero-primary {
            background: white;
            color: #667eea;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }

        .btn-hero-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,0.8);
        }
        .btn-hero-secondary:hover {
            background: white;
            color: #667eea;
            transform: translateY(-3px);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 900px;
            width: 100%;
        }

        .feature-card {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            color: white;
            transition: transform 0.3s;
        }
        .feature-card:hover { transform: translateY(-5px); }
        .feature-icon { font-size: 2.2rem; margin-bottom: 12px; }
        .feature-card h3 { font-size: 1rem; margin-bottom: 8px; font-weight: 600; }
        .feature-card p { opacity: 0.85; font-size: 0.85rem; line-height: 1.5; }

        /* Tablet */
        @media (max-width: 768px) {
            .features { grid-template-columns: repeat(2, 1fr); max-width: 500px; }
            .hero { padding: 40px 20px 30px; }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .features { grid-template-columns: 1fr; max-width: 320px; }
            .hero-btns { flex-direction: column; align-items: center; width: 100%; max-width: 280px; }
            .btn-hero { width: 100%; padding: 13px 20px; }
        }
    </style>
</head>
<body>
@include('components.navbar')

<div class="hero">
    <h1>{{ __('lang.discover') }}</h1>
    <p>{{ __('lang.book_dream') }}</p>

    <div class="hero-btns">
        <a href="/register" class="btn-hero btn-hero-primary">{{ __('lang.register') }}</a>
        <a href="/login" class="btn-hero btn-hero-secondary">{{ __('lang.login') }}</a>
    </div>

    <div class="features">
        <div class="feature-card">
            <div class="feature-icon">🌍</div>
            <h3>World Destinations</h3>
            <p>Explore hundreds of amazing destinations around the globe</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">💰</div>
            <h3>Best Prices</h3>
            <p>Find the best deals and packages for your budget</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⭐</div>
            <h3>Top Rated</h3>
            <p>Read reviews from thousands of satisfied travelers</p>
        </div>
    </div>
</div>

@include('components.footer')
</body>
</html>
