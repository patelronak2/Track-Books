<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
	function review() {
        return $this->hasMany('App\Review');
    }
}
