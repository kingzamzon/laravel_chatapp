# laravel_chatapp
SETUP

* [List of models](#list_of_models)
* [List_of_migrations](#list_of_migrations)

use of two migrations and model excluding the [User](#user) 
| Models | Migrations |
| -------- | ----------|
| [Message](#message) | [messages](#messages) |
| [MessageComment](#messageComment) |  [message_comments](#message_comment) |


To create  models with migration file. run 

` php artisan make:model modelname -m `

***Note:***
For  each  model  and controller dont forget  to import  the proper definition by pressing your f5 key while on the  definition you  want  to  import.

# List_of_migrations

## Messages 
```php
public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sender_id');
            $table->string('receiver_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
```
## Message_comments
```php
public function up()
    {
        Schema::create('message_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('message_id');
            $table->string('user_id');
            $table->mediumText('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_comments');
    }
```

# List_of_models
## Message
```php
  protected $fillable = ['sender_id','receiver_id'];

    public function user() {
        return $this->belongsTo(User::class, 'receiver_id','id');
    }

    public function messagecomments() {
        return $this->hasMany(MessageComment::class, 'id', 'message_id');
    }
```

## User
```php
 public function messages() {
        return $this->hasMany(Message::class, 'id', 'sender_id');
    }

    public function messagecomments() {
        return $this->hasMany(MessageComment::class, 'id', 'sender_id');
    }
```

## MessageComment 
```php
    protected $fillable = ['message_id','user_id','message'];

    public function message() {
        return $this->belongsTo(Message::class, 'message_id','id');
    }

     public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
```

# List Of Controllers
## MessagesController
```php
  public function store(Request $request)
    {
        $complain = new MessageComment;
        $complain->user_id = auth()->user()->id;
        $complain->message = $request->input('message');
        $complain->message_id = 1;
        $complain->save();

        
        return redirect('/home');
        
    }
```
## HomeController
```php
   public function index()
    {
        $conversations = MessageComment::all();
        
        return view('home')->with('conversations', $conversations);
    }
```

# View
> home.blade.php

```php
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                            <!-- <input type="hidden" name="_method" value="PUT"> -->
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

```

`
Each code are explain  based on   request 
`
