<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Auth::user()->notifications;
        return view('dashboard.notifications.index', compact('notifications'));
    }
}
