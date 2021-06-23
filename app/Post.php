<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    public function category() {

        //belongsTo nel model della tabella della foreign key
        return $this->belongsTo('App\Category');

    }
}
