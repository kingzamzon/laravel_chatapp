<div class="card">
    <div class="card-header">Select </div>
    <div class="card-body">
            @if(count($user_messages) > 0)

            @foreach ($user_messages as $single_message) 
                @if($single_message->receiver_id == Auth::user()->id)
                    <!-- <p>You are a receiver</p> -->
                    <h3><a href="/messages/{{$single_message->id}}">
                        {{$single_message->usersender->name}}
                    </a></h3>
                @else
                    <!-- <p>You are a sender </p> -->
                    <h3><a href="/messages/{{$single_message->id}}">
                        {{$single_message->userreceiver->name}}
                    </a></h3>
                @endif
            @endforeach
            @else 
                <p>No conversation so far...</p>
            @endif
    </div>
</div>