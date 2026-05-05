<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TravelAgency</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
        }

        .nav-links a {
            margin: 0 1rem;
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .admin-panel {
            background: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .admin-panel h1 {
            color: #667eea;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #764ba2;
        }

        .success-message {
            background: #4caf50;
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
        }
    </style>
</head>
<body>
@include('components.navbar')


<div class="container">
    <div class="admin-panel">
        <h1>{{ __('lang.add_tour') }}</h1>

        <div class="success-message" id="success-msg">
            Tour uploaded successfully!
        </div>

        <form id="upload-form" enctype="multipart/form-data">
            <div class="form-group">
                <label>{{ __('lang.tour_name') }}</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>{{ __('lang.description') }}</label>
                <textarea name="description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label>{{ __('lang.location') }}</label>
                <input type="text" name="location" required>
            </div>

            <div class="form-group">
                <label>{{ __('lang.region') }}</label>
                <input type="text" name="region" required>
            </div>

            <div class="form-group">
                <label>{{ __('lang.price_per_night') }}</label>
                <input type="number" name="pricePerNight" step="0.01" required>
            </div>

            <div class="form-group">
                <label>{{ __('lang.tour_image') }}</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <button type="submit" class="btn-submit">{{ __('lang.upload_tour') }}</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('upload-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        try {
            const response = await fetch('/resources', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                document.getElementById('success-msg').style.display = 'block';
                e.target.reset();

                setTimeout(() => {
                    window.location.href = '/';
                }, 2000);
            } else {
                alert('Error: ' + (result.message || 'Upload failed'));
            }
        } catch (error) {
            alert('Error uploading tour: ' + error.message);
        }
    });
</script>
@include('components.footer')

</body>
</html>
