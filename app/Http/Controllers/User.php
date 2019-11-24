<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Profile;
use App\Book;
use App\Shelf;
use App\Review;
use App\Rating;
use App\Friendship;
use App\Notifications\ShelfUpdated;

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
		$totalFriends = count($user->friends);
        return view('user.profile',['profile' => $profile, 'shelves' => $shelves, 'totalFriends' => $totalFriends]);
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
		
		$user->name = $request->input('name');
		$user->save();
		
		echo "success";
		
		
	}
	
	public function deleteShelfBook($id){
		$shelves = Shelf::where('user_id', Auth::id())->where('book_id',$id)->get();
		$book = Book::find($id);
		$shelfId = -1;
		
		foreach($shelves as $shelf){
			if($shelf->book_id == $id){
				$shelfId = $shelf->id;
			}
		}
		if($shelfId != -1){
			$user = Auth::user();
			$shelf = Shelf::find($shelfId);
			$shelf->delete();
			//send a notification
			$user->notify(new ShelfUpdated($user, $book, "Book removed from the shelf"));
			echo "Success";
		}	
	}
	
	
	
	public function sendFriendRequest($id){
		$friendship = new Friendship;
		$friendship->first_user = Auth::id();
		$friendship->second_user = $id;
		$friendship->acted_user = Auth::id();
		$friendship->status = 'pending';
		$friendship->save();
		
		//Notify the user with id => $id about the Friend Request
		return redirect('/showProfile/' . $id);
	}
	
	public function acceptRequest(){
		Friendship::where('first_user', 1 )->where('second_user', Auth::id())->update(['status' => 'confirmed', 'acted_user' => Auth::id()]);
		
		$friendships = Friendship::all();
		print_r(json_encode($friendships));
	}
	
	public function pendingRequest(){
		$user = Auth::user();
		print_r(json_encode($user->friend_requests));
	}
	
	public function friendList(){
		$user = Auth::user();
		$friends = $user->friends;
		$pendingRequest = $user->friend_requests; 
		return view('user.friendList',['user' => $user, 'friends' => $friends, 'totalFriends' => count($friends), 'totalPendingRequest' => count($pendingRequest), 'pendingRequests' => $pendingRequest]);
	}
	
	public function removeFriend($id){
		$friendships = Friendship::all();
		$friendshipId = -1;
		foreach($friendships as $friendship){
			if(($friendship->first_user == Auth::id() && $friendship->second_user == $id) || ($friendship->first_user == $id && $friendship->second_user == Auth::id())){ 
				if($friendship->status == 'confirmed'){
					$friendshipId = $friendship->id;
				}
			}
		}
		die;
		if($friendshipId != -1){
			$friendship = Friendship::find($friendshipId);
			$friendship->delete();
			return true;
		}else{
			return false;
		}
	}
}
