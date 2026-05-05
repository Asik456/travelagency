<?php

namespace App\Observers;

use App\Models\Reservation;
use App\Mail\ReservationEmail;
use Illuminate\Support\Facades\Mail;

class ReservationObserver
{
    public function created(Reservation $reservation)
    {
        $reservation->load('user');
        Mail::to($reservation->user->email)->send(new ReservationEmail($reservation));
    }
}
