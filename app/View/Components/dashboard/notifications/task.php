<?php

namespace App\View\Components\dashboard\notifications;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class task extends Component
{
   public $notifications;
    public function __construct()
    {
        $this->notifications = auth()->user()->unreadNotifications;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notifications.task');
    }
}
