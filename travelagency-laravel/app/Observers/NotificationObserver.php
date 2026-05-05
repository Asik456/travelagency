<?php

namespace App\Observers;

use App\Models\Notification;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;

class NotificationObserver
{
    public function created(Notification $notification)
    {
        $notification->load('user');
        Mail::to($notification->user->email)->send(new NotificationEmail($notification));
    }
}
