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
		$profiles = Profile::where('user_id', Auth::id())->get();
				
		if(!sizeof($profiles)){
			$profile = new Profile;
			$profile->user_id = $user->id;
			$profile->name = $user->name;
			$profile->email = $user->email;
			$profile->save();
		}
		
		$allProfiles = Profile::all();
		$profileId = -1;
		
		foreach($allProfiles as $profile){
			if($profile->user_id == $user->id){
				$profileId = $profile->id;
			}
		}
		$profile = Profile::find($profileId);
		
        return view('user.profile',['profile' => $profile]);
    }
	
	public function setting()
	{
		return view('user.setting');
	}
}
