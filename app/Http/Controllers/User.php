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
		$user = Auth::user();
		$profile = Profile::where('user_id', Auth::id())->get();
		if(sizeof($profile)){
			//Profile Already Exist
		}else{
			//Create a New Profile
			$profile = new Profile;
			$profile->user_id = $user->id;
			$profile->name = $user->name;
			$profile->email = $user->email;
			$profile->save();
		}
		
        return view('user.profile',['profile' => $profile]);
    }
	
	public function setting()
	{
		return view('user.setting');
	}
}
