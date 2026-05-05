<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('lang.welcome') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {.
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        .navbar {
            background: white;
            padding: 1rem 3rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        .logo {
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            font-weight: bold;
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
            font-size: clamp(0.9rem, 1.5vw, 1rem);
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .language-dropdown {
            position: relative;
        }

        .lang-current {
            padding: 0.6rem 1.2rem;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.3s;
            font-size: clamp(0.9rem, 1.5vw, 1rem);
        }

        .lang-current:hover {
            background: #764ba2;
        }

        .lang-current::after {
            content: "▼";
            font-size: 0.8rem;
        }

        .lang-options {
            position: absolute;
            top: 110%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: none;
            min-width: 120px;
            overflow: hidden;
        }

        .lang-options.show {
            display: block;
        }

        .lang-option {
            padding: 0.8rem 1.2rem;
            cursor: pointer;
            transition: background 0.3s;
            border: none;
            width: 100%;
            text-align: left;
            background: white;
            color: #333;
            font-weight: 500;
            font-size: clamp(0.85rem, 1.5vw, 0.95rem);
        }

        .lang-option:hover {
            background: #f0f0f0;
        }

        .lang-option.active {
            background: #667eea;
            color: white;
        }

        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
            width: 100%;
        }

        .hero h1 {
            font-size: clamp(1.5rem, 5vw, 3.5rem);
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: clamp(0.9rem, 2.5vw, 1.3rem);
            opacity: 0.9;
        }

        .search-section {
            max-width: 1200px;
            width: 90%;
            margin: -3rem auto 2rem;
            padding: 0 2rem;
        }

        .search-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .filter-group label {
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
            font-size: clamp(0.85rem, 1.5vw, 1rem);
        }

        .filter-group input,
        .filter-group select {
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            width: 100%;
            font-size: clamp(0.85rem, 1.5vw, 1rem);
        }

        .btn-search {
            padding: 0.8rem 2rem;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
            font-size: clamp(0.9rem, 1.5vw, 1rem);
        }

        .btn-search:hover {
            background: #764ba2;
        }

        .tours-section {
            max-width: 1400px;
            width: 90%;
            margin: 3rem auto;
            padding: 0 2rem;
        }

        .section-title {
            font-size: clamp(1.3rem, 3vw, 2rem);
            margin-bottom: 2rem;
            color: #333;
        }

        .tours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            width: 100%;
        }

        .tour-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
        }

        .tour-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .tour-image {
            width: 100%;
            max-width: 100%;
            height: 250px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .tour-content {
            padding: 1.5rem;
            width: 100%;
        }

        .tour-title {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            margin-bottom: 0.8rem;
            color: #333;
        }

        .tour-location {
            color: #666;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: clamp(0.85rem, 1.5vw, 1rem);
        }

        .tour-description {
            color: #555;
            margin-bottom: 1rem;
            line-height: 1.6;
            font-size: clamp(0.85rem, 1.5vw, 0.95rem);
        }

        .tour-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e0e0e0;
            width: 100%;
        }

        .tour-price {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            color: #667eea;
            font-weight: bold;
        }

        .btn-book {
            padding: 0.8rem 1.5rem;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s;
            font-weight: 600;
            font-size: clamp(0.85rem, 1.5vw, 1rem);
        }

        .btn-book:hover {
            background: #764ba2;
        }

        .footer {
            background: #2c3e50;
            color: white;
            padding: 3rem 2rem;
            margin-top: 4rem;
            width: 100%;
        }

        .footer-content {
            max-width: 1200px;
            width: 90%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            color: #667eea;
            font-size: clamp(1rem, 2vw, 1.2rem);
        }

        .footer-section p,
        .footer-section a {
            color: #ecf0f1;
            text-decoration: none;
            line-height: 2;
            font-size: clamp(0.85rem, 1.5vw, 1rem);
        }

        .footer-section a:hover {
            color: #667eea;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #34495e;
            color: #95a5a6;
            font-size: clamp(0.8rem, 1.5vw, 0.9rem);
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                flex-direction: column;
                gap: 0.5rem;
                width: 100%;
                text-align: center;
            }

            .language-dropdown {
                width: 100%;
            }

            .lang-current {
                width: 100%;
                justify-content: center;
            }

            .search-container {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .tours-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .hero {
                padding: 2rem 1rem;
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }

        @media (min-width: 601px) and (max-width: 900px) {
            .navbar {
                padding: 1rem 2rem;
            }

            .tours-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .search-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero h1 {
                font-size: 2.5rem;
            }
        }

        @media (min-width: 901px) and (max-width: 1200px) {
            .tours-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .search-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 1201px) {
            .tours-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .search-container {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 900px) and (orientation: landscape) {
            .hero {
                padding: 2rem 1rem;
            }

            .hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
@include('components.navbar')




<div class="hero">
    <h1>{{ __('lang.discover') }}</h1>
    <p>{{ __('lang.book_dream') }}</p>
</div>

<div class="search-section">
    <div class="search-container">
        <div class="filter-group">
            <label>{{ __('lang.location') }}</label>
            <input type="text" id="search-location" placeholder="Enter location...">
        </div>
        <div class="filter-group">
            <label>{{ __('lang.region') }}</label>
            <select id="search-region">
                <option value="">All Regions</option>
                <option value="Asia">Asia</option>
                <option value="Europe">Europe</option>
                <option value="Americas">Americas</option>
                <option value="Africa">Africa</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Max Price</label>
            <input type="number" id="search-price" placeholder="$0 - $1000">
        </div>
        <div class="filter-group">
            <button class="btn-search" onclick="filterTours()">🔍 Search</button>
        </div>
    </div>
</div>

<div class="tours-section">
    <h2 class="section-title">🌍 Popular Destinations</h2>
    <div id="tours-grid" class="tours-grid"></div>
</div>



<script>
    let allTours = [];

    function toggleLangMenu() {
        document.getElementById('lang-menu').classList.toggle('show');
    }

    window.onclick = function(event) {
        if (!event.target.matches('.lang-current')) {
            const dropdown = document.getElementById('lang-menu');
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    }

    function switchLang(lang) {
        document.getElementById('lang-input').value = lang;
        document.querySelector('form').submit();
    }

    async function loadTours() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/travel_resources');
            const data = await response.json();
            allTours = data.member || [];
            displayTours(allTours);
        } catch (error) {
            console.error('Error loading tours:', error);
        }
    }

    function displayTours(tours) {
        const toursGrid = document.getElementById('tours-grid');

        if (tours.length > 0) {
            toursGrid.innerHTML = tours.map(tour => `
                <div class="tour-card">
                    <img src="${tour.imageUrl || ''}" class="tour-image" alt="${tour.name}">
                    <div class="tour-content">
                        <h3 class="tour-title">${tour.name}</h3>
                        <p class="tour-location">
                            <span>📍</span>
                            <span>${tour.location}, ${tour.region}</span>
                        </p>
                        <p class="tour-description">${tour.description}</p>
                        <div class="tour-footer">
                            <div class="tour-price">$${tour.pricePerNight}<small>/{{ __('lang.night') }}</small></div>
                            <a href="#" class="btn-book">{{ __('lang.book_now') }}</a>
                        </div>
                    </div>
                </div>
            `).join('');
        } else {
            toursGrid.innerHTML = '<p style="text-align: center; color: #666; grid-column: 1/-1;">No tours available</p>';
        }
    }

    function filterTours() {
        const location = document.getElementById('search-location').value.toLowerCase();
        const region = document.getElementById('search-region').value.toLowerCase();
        const maxPrice = parseFloat(document.getElementById('search-price').value) || Infinity;

        const filtered = allTours.filter(tour => {
            const matchLocation = !location || tour.location.toLowerCase().includes(location);
            const matchRegion = !region || tour.region.toLowerCase().includes(region);
            const matchPrice = tour.pricePerNight <= maxPrice;
            return matchLocation && matchRegion && matchPrice;
        });

        displayTours(filtered);
    }

    loadTours();
</script>
@include('components.footer')

</body>
</html>
