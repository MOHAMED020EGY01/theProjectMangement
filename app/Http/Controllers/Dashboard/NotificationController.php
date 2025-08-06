<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Summary of __construct
     * @Check Auth
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Summary of index
     * @return mixed|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if ($this->currentUser()) {
            $notifications = $this->currentUser()->notifications()->paginate(7);
            return view('dashboard.notifications.index', compact('notifications'));
        }
        return redirect()->route('dashboard');
    }
    /**
     * Summary of unreadNotification
     * @return mixed|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function unreadNotification()
    {
        if ($this->currentUser()) {
            $notifications = $this->currentUser()->unreadNotifications()->paginate(7);
            return view('dashboard.notifications.unreadNotification', compact('notifications'));
        }
        return redirect()->route('dashboard');
    }

    /**
     * Summary of readNotification
     * @return mixed|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function readNotification()
    {
        if ($this->currentUser()) {
            $notifications = $this->currentUser()->readNotifications()->paginate(7);
            return view('dashboard.notifications.readNotification', compact('notifications'));
        }
        return redirect()->route('dashboard');
    }
    /**
     * Summary of trach
     * @return mixed|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function trach()
    {
        if ($this->currentUser()) {
            $notifications = $this->currentUser()->notifications()->onlyTrashed()->paginate(7);
            return view('dashboard.notifications.trach', compact('notifications'));
        }
        return redirect()->route('dashboard');
    }

    public function read($notification_id)
    {
        if ($this->currentUser()->notifications()->where('id', $notification_id)->exists()) {
            $notification = $this->currentUser()->notifications()->where('id', $notification_id)->first();
            $notification->markAsRead();
            return redirect()->route('notifications.index');
        }
        return redirect()->route('dashboard');
    }
    /**
     * Summary of restore
     * @param mixed $notification_id
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function restore($notification_id)
    {

        if ($this->currentUser()->notifications()->onlyTrashed()->where('id', $notification_id)->exists()) {
            $notification = $this->currentUser()->notifications()->onlyTrashed()->where('id', $notification_id)->first();
            try {
                DB::beginTransaction();
                $notification->restore();
                $notification->restore = now();
                $notification->save();
                DB::commit();
                return redirect()->route('notifications.index')->with('info', 'Notification restored successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Notification restore failed: ' . $e->getMessage());
                return redirect()->route('notifications.index')->with('error', 'Notification restore failed');
            }
        }
        return redirect()->route('dashboard');
    }
    /**
     * Summary of delete
     * @param mixed $notification_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($notification_id)
    {
        if ($this->currentUser()->notifications()->where('id', $notification_id)->exists()) {
            $notification = $this->currentUser()->notifications()->where('id', $notification_id)->first();
            try {
                DB::beginTransaction();
                if ($notification->restore) {
                    $notification->restore = null;
                    $notification->save();
                }
                $notification->delete();

                DB::commit();
                return redirect()->route('notifications.index')->with('warning', 'Notification deleted successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Notification delete failed: ' . $e->getMessage());
                return redirect()->route('notifications.index')->with('error', 'Notification move to trach');
            }
        }
        return redirect()->route('dashboard')->with('error', 'Notification not found');
    }

    /**
     * Summary of forceDelete
     * @param mixed $notification_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($notification_id)
    {
        if ($this->currentUser()->notifications()->onlyTrashed()->where('id', $notification_id)->exists()) {
            $notification = $this->currentUser()->notifications()->onlyTrashed()->where('id', $notification_id)->first();
            try {
                DB::beginTransaction();
                $notification->forceDelete();
                DB::commit();
                return redirect()->route('notifications.trach')->with('warning', 'Notification deleted from trach successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Notification delete failed: ' . $e->getMessage());
                return redirect()->route('notifications.trach')->with('error', 'Notification delete failed');
            }
        }
        return redirect()->route('dashboard')->with('error', 'Notification not found');
    }

    /**
     * Summary of forceDeleteAll
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteAll()
    {
        if ($this->currentUser()->notifications()->onlyTrashed()->exists()) {
            $notifications = $this->currentUser()->notifications()->onlyTrashed()->get();
            try {
                DB::beginTransaction();
                foreach ($notifications as $notification) {
                    $notification->forceDelete();
                }
                DB::commit();
                return redirect()->route('notifications.trach')->with('warning', 'Notification deleted for all notification successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Notification delete failed: ' . $e->getMessage());
                return redirect()->route('notifications.trach')->with('error', 'Notification delete failed');
            }
        }
        return redirect()->route('dashboard')->with('error', 'Notification not found');
    }

    /**
     * Summary of DeleteAll
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteAll()
    {
        if ($this->currentUser()->notifications()) {
            $notifications = $this->currentUser()->notifications()->get();
            try {
                DB::beginTransaction();
                foreach ($notifications as $notification) {
                    $notification->delete();
                }
                DB::commit();
                return redirect()->route('notifications.index')->with('warning', 'Notification deleted for all notification successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Notification delete failed: ' . $e->getMessage());
                return redirect()->route('notifications.index')->with('error', 'Notification delete failed');
            }
        }
        return redirect()->route('dashboard')->with('error', 'Notification not found');
    }



    /**
     * Summary of currentUser
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function currentUser()
    {
        return Auth::user();
    }
}
