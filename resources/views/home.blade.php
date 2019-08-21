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
                    Continue chat or start a new Conversation
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
