<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; border-radius: 10px; }
        .badge { display: inline-block; padding: 5px 10px; background: #2bb5c8; color: white; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h2>🔔 New Notification</h2>
    <p><span class="badge">{{ $notification->type }}</span></p>
    <p><strong>Message:</strong> {{ $notification->message }}</p>
    <p><strong>Date:</strong> {{ $notification->created_at }}</p>
</div>
</body>
</html>
