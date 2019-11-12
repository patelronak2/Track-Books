<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Profile;
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
		//$user = Auth::user();
		$profile = Profile::find(Auth::id());
        return view('user.profile',['profile' => $profile]);
    }
	
	public function setting()
	{
		return view('user.setting');
	}
}
