<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function notifications(){
        //mark all unread notifs as read
        auth()->user()->unreadNotifications->markAsRead();
        //return view with all unread notifications

        return view('notifications')->with('notifications',auth()->user()->notifications()->latest()->paginate(5));
    }
}
