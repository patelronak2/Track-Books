<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	function book() {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
