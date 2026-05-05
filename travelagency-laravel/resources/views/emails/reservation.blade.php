<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { max-width: 600px; margin: 20px auto; background: white; padding: 30px; border-radius: 10px; }
        .header { background: #2bb5c8; color: white; padding: 20px; text-align: center; border-radius: 5px; }
        .info { margin: 20px 0; line-height: 1.8; }
        .footer { text-align: center; margin-top: 30px; color: #666; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🎉 Booking Confirmed!</h1>
    </div>
    <div class="info">
        <p><strong>Reservation ID:</strong> #{{ $reservation->id }}</p>
        <p><strong>Total Price:</strong> ${{ $reservation->totalPrice }}</p>
        <p><strong>Status:</strong> {{ $reservation->status }}</p>
        <p><strong>Check-in:</strong> {{ $reservation->startTime }}</p>
        <p><strong>Check-out:</strong> {{ $reservation->endTime }}</p>
    </div>
    <div class="footer">
        <p>Thank you for choosing TravelAgency!</p>
    </div>
</div>
</body>
</html>
