<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Notification;
use App\Observers\UserObserver;
use App\Observers\ReservationObserver;
use App\Observers\NotificationObserver;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Reservation::observe(ReservationObserver::class);
        Notification::observe(NotificationObserver::class);
    }

    public function register(): void
    {
        //
    }
}
