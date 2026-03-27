<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    protected $fillable = ['sender_id' , 'receiver_id' , 'annonce_id' , 'content', 'is_read'];


    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }
}
