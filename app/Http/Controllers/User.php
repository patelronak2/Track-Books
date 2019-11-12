<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Shelf;
use App\Review;
use App\Rating;

class User extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the user's profile
     *
     */
    public function index()
    {
		$user = Auth::user();
        return view('user.profile',['user' => $user]);
    }
	
	public function setting()
	{
		return view('user.setting');
	}
}
