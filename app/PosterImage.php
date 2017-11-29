<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosterImage extends Model
{
    protected $fillable = [
        'poster_id', 'filename'
    ];

    public function poster(){
        return $this->belongsTo('App/Poster');
    }
}
