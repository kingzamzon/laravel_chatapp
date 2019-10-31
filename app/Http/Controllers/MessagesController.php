<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageComment;
use Illuminate\Http\Request;

class MessagesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $conversation = new MessageComment;
        $conversation->user_id = auth()->user()->id;
        $conversation->message = $request->message;
        $conversation->message_id = $request->message_id;
        $conversation->save();
        return response()->json($conversation);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $conversations =  MessageComment::where(['message_id'=>1])->get();
        $user_id = auth()->id();
        $user_messages =  Message::whereSender_idOrReceiver_id($user_id, $user_id)->get();
       return view('messages', compact('user_messages', 'conversations','id' ));

    }

     public function getConversations(Request $request)
    {
       $conversations =  MessageComment::where(['message_id'=>$request->id])->with('user')->get();
        return $conversations;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
