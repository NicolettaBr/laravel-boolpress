<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug'
    ];

    public function categories() {

        //belongsTo nel model della tabella della foreign key
        return $this->belongsTo('App\Category');

    }
}
