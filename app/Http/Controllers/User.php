<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    /**
     * Show the user's profile
     *
     */
    public function index()
    {
        return view('user.profile');
    }
	
	public function setting()
	{
		return view('user.setting');
	}
}
