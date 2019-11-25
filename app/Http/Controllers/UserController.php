<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Book;
use App\Models\Shelf;
use App\Models\Review;
use App\Models\Rating;
use App\Models\Post;
use App\Models\Friendship;
use App\Notifications\ShelfUpdated;
use App\Notifications\FriendRequestSent;
use App\Notifications\FriendRequestAccepted;

class UserController extends Controller
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
		//Auth::user() will be the user sending the friend request and user with $id will the user receiving request
		$user = User::find($id);
		$user->notify(new FriendRequestSent(Auth::id(), Auth::user()->name));
		return redirect('/showProfile/' . $id);
	}
	
	public function acceptRequest($id){
		Friendship::where('first_user', $id)->where('second_user', Auth::id())->update(['status' => 'confirmed', 'acted_user' => Auth::id()]);
		//Auth::user() will be the user accepting the request
		//User with $id will be the one who had sent the request and receiving this notification
		$user = User::find($id);
		$user->notify(new FriendRequestAccepted(Auth::id(), Auth::user()->name));
		echo "success";
	}
	
	
	
	public function friendList(){
		return view('user.friendList');
	}
	
	public function getFriendList(){
		$user = Auth::user();
		$friends = $user->friends;
		echo json_encode($friends);
	}
	
	public function deleteFriendship($id){
		$friendships = Friendship::all();
		$friendshipId = -1;
		foreach($friendships as $friendship){
			if(($friendship->first_user == Auth::id() && $friendship->second_user == $id) || ($friendship->first_user == $id && $friendship->second_user == Auth::id())){ 
				$friendshipId = $friendship->id;
			}
		}
		if($friendshipId != -1){
			$friendship = Friendship::find($friendshipId);
			$friendship->delete();
			
		}
		echo "Success";
	}
	
	public function createPost(Request $request){
		$post = new Post;
		$post->body = $request->input('body');
		$request->user()->posts()->save($post);
		return redirect('/home');
	}
}
