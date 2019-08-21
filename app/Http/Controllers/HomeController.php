<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageComment;
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
        $user_id = auth()->id();
        $user_messages =  Message::whereSender_idOrReceiver_id($user_id, $user_id)->get();
        return view('home')->with('user_messages',$user_messages);
    }

}
