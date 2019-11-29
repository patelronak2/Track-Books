<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
	 * A book has many reviews
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	function review() {
        return $this->hasMany(Review::class);
    }
	
	/**
	 * A book has many reviews
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	function rating() {
        return $this->hasMany(Rating::class);
    }
}
