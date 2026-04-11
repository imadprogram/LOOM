<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Annonce;
use App\Models\User;

class Report extends Model
{
    protected $fillable = ['reason' , 'status' , 'user_id' , 'annonce_id'];


    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
