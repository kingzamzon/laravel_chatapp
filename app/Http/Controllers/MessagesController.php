<?php

namespace App\Http\Controllers;

use App\User;
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
    public function show($user)
    {
        $auth_user = auth()->user()->id;

        // check if user and auth already have a message if not create
        if(Message::where(['sender_id'=> $auth_user, 'receiver_id'=> $user])->first()){

            $message_info = Message::where(['sender_id'=> $auth_user, 'receiver_id'=> $user])->first();

        }else if(Message::where(['sender_id'=> $user, 'receiver_id'=> $auth_user])->first()){

            $message_info = Message::where(['sender_id'=> $user, 'receiver_id'=> $auth_user])->first();
        }
        else {
            $message_info = Message::create(
                [
                'sender_id' => auth()->user()->id,
                'receiver_id' => $user
                ]
            );
        }

        $user_messages = User::where('id','!=',auth()->user()->id)->get();
        
        $user = User::where('id', $user)->first();

        $conversations =  MessageComment::where(['message_id'=> $message_info->id])->get();

       return view('messages', compact('user_messages', 'conversations', 'message_info' ));

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
