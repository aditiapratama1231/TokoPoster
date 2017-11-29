<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category'
    ];

    public function poster(){
        return $this->hasOne('App\Poster');
    }
}
