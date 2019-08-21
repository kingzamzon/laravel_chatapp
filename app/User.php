<?php

namespace App;

use App\Message;
use App\MessageComment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages() {
        return $this->hasMany(Message::class, 'id', 'sender_id');
    }

    public function messagecomments() {
        return $this->hasMany(MessageComment::class, 'id', 'sender_id');
    }

   public function messagesender() {
        return $this->hasMany(Message::class, 'id', 'sender_id');
    }

    public function messagereceiver() {
        return $this->hasMany(Message::class, 'id', 'receiver_id');
    }
}
