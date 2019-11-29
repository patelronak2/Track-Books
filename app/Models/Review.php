<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
	 * A review belong to a user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	
	/**
	 * A review belong to a book
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	function book() {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
