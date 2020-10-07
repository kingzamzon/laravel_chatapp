<?php

namespace App\Http\Controllers;

use App\User;
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
        // Get authenticated users
        $user_id = auth()->user()->id;

        $user_messages = User::where('id','!=', $user_id)->get();

        return view('home')->with('user_messages',$user_messages);
    }

}
