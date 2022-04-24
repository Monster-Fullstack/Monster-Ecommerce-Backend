<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function history()
    {
        return Notification::all()->take(10);
    }
}
