<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts(){

        //belongsToMany = relazione tra model di tipo many to many
        return $this->belongsToMany('App\Post');

    }
}
