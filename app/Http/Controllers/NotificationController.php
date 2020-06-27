<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index()
    {
        return view('dashboard.notifications.index',[
            'title'         => trans('software.notifications'),
            'notifications' => user()->notifications()->latest()->paginate(10),
        ]);
    }
    public function readNotification()
    {
       if (user()->notifications->count() > 0) 
       {
           user()->unreadNotifications->markAsRead();
       }
       return response(['readed' => true]);
    }

    
}
