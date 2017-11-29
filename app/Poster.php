<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $fillable = [
        'poster_name', 'poster_image', 'user_id', 'category_id', 'description', 'price'
    ];

    protected $hidden = [
        'category_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function poster_image(){
        return $this->hasOne('App\PosterImage');
    }
}
