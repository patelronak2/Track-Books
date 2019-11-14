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
		
		$allProfiles = Profile::all();
		$profileId = -1;
		
		foreach($allProfiles as $profile){
			if($profile->user_id == $user->id){
				$profileId = $profile->id;
			}
		}
		$profile = Profile::find($profileId);
		
		$shelves = Shelf::where('user_id', $user->id)->with('book')->get();
		
        return view('user.profile',['profile' => $profile, 'shelves' => $shelves]);
    }
	
	public function setting()
	{	
		$shelves = Shelf::where('user_id', Auth::id())->with('book')->get();
		return view('user.setting',['shelves' => $shelves]);
	}
	
	public function getProfileDetails(){
		
		$allProfiles = Profile::all();
		$profileId = -1;
		
		foreach($allProfiles as $profile){
			if($profile->user_id == Auth::id()){
				$profileId = $profile->id;
			}
		}
		$profile = Profile::find($profileId);
		return $profile;
	}
	
	public function editProfile(Request $request){
		$user = Auth::user();
		$allProfiles = Profile::all();
		$profileId = -1;
		
		foreach($allProfiles as $profile){
			if($profile->user_id == Auth::id()){
				$profileId = $profile->id;
			}
		}
		$profile = Profile::find($profileId);
		$profile->name = $request->input('name');
		$profile->birthday = $request->input('birthday');
		$profile->gender = $request->input('gender');
		$profile->isPrivate = $request->input('isPrivate');
		$profile->save();
		
		$user = User::find($user_id);
		$user->name = $request->input('name');
		$user->save();
		
		
	}
}
