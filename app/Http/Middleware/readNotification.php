<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Symfony\Component\HttpFoundation\Response;

class readNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $notification_id = $request->query('notification_id');
        
        if ($notification_id) {
            $notification = DatabaseNotification::find($notification_id);
            if ($notification && ($notification->notifiable_id == auth()->id())) {
                $notification->markAsRead();
            }
        }
        
        return $next($request);
    }
    
}
