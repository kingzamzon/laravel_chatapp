<?php

namespace App;

use App\User;
use App\Message;
use Illuminate\Database\Eloquent\Model;

class MessageComment extends Model
{
    protected $table = 'message_comments';

    protected $primaryKey = 'id';

    protected $fillable = ['message_id','user_id','message'];

    public function message() {
        return $this->belongsTo(Message::class, 'id','message_id');
    }

     public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
