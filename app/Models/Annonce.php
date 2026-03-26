<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = ['title' , 'description' , 'price' , 'location' , 'status' , 'user_id' , 'category_id' , 'is_boosted' , 'boosted_until'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function image() {
        return $this->hasOne(Image::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
