<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $notification = Notification::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('theme::frontend.other.notification', [
            'notifications' => $notification
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = Notification::where('id', $id)->firstOrFail();

        if ($notification->user_id !== Auth::user()->id) {
            return back()->with('error',
                __('notification.page.not-yours')
            );
        }
        $notification->delete();

        return back()->with('success',
            __('notification.page.successfully')
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::user()->id)
            ->delete();

        return back()->with('success',
            __('notification.page.successfully-all')
        );
    }
}
