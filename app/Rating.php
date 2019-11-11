<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
	function book() {
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }
}
