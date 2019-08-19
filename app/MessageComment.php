<?php

namespace App;

use App\Message;
use Illuminate\Database\Eloquent\Model;

class MessageComment extends Model
{
    protected $table = 'message_comments';

    protected $primaryKey = 'id';

    protected $fillable = ['message_id','user_id','message'];

    public function message() {
        return $this->belongsTo(Message::class, 'message_id','id');
    }
}
