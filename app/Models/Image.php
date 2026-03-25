<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Annonce;

class Image extends Model
{
    protected $fillable = ['file_path' , 'annonce_id'];

    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }
}
