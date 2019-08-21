@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
                @include('sidebar',['user_messages'=>$user_messages])
        </div> 
        <div class="col-md-8"> 
            <div class="card">
                <div class="card-header">Chat</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="max-height:300px;height:300px;overflow-y: scroll;">
                        @if (count($conversations) > 0)
                        @foreach ($conversations as $c)
                            <div class="card">
                                <div class="card-body">
                                <b>{{$c->user->name}}</b> <br>
                                {{$c->message}}
                                </div>
                            </div><br>
                            
                        @endforeach
                        @else 
                            <p>No conversation so far. Start a conversation</p>
                        @endif
                                 </div>
                    
                    <div>
                        <form role="form" class="form-group" method="POST" action="{{action('MessagesController@store')}}" style="margin-top: 20px">
                            {{csrf_field()}}
                            <div class="input-group">
                              <input type="text" name="message" autocomplete="off" chat-box class="form-control" placeholder="Type...">
                              <div class="input-group-prepend">
                                <button type="submit" class="input-group-text">Send</button>
                              </div>
                            </div> 
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
