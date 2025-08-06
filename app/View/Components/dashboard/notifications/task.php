<?php

namespace App\View\Components\dashboard\notifications;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class task extends Component
{
   public $notifications;
   public $count;
    public function __construct()
    {
        $user = Auth::user();
        $this->count = $user->unreadNotifications()->count();
        $this->notifications = $user->unreadNotifications()->paginate(7);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notifications.task');
    }
}
