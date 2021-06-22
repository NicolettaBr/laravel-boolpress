<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){

        //hasMany nel model della tabella senza foreign key
        return $this->hasMany('App\Post');
    }
}
