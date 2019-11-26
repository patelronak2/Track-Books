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
		$user = Auth::user();
		$friends = $user->friends;
		return view('user.friendList', ['friends' => $friends]);
	}
	
	//This Function Handles Ajax Requests that is being sent from anotherUserProfile.blade
	public function deleteFriendship($id){
		$alert = $this->removeFriendFromDatabase($id);
		if($alert){
			echo "Success";
		}else{
			echo "Failed";
		}
		
	}
	
	//This Function deletes Friendship Record from the database
	//Provides the functionality of Decline Friend Request or Unfriend
	public function removeFriendFromDatabase($id){
		$friendships = Friendship::all();
		$friendshipId = -1;
		foreach($friendships as $friendship){
			if(($friendship->first_user == Auth::id() && $friendship->second_user == $id) || ($friendship->first_user == $id && $friendship->second_user == Auth::id())){ 
				$friendshipId = $friendship->id;
			}
		}
		if($friendshipId != -1){
			$friendship = Friendship::find($friendshipId);
			if($friendship->delete()){
				return true;
			}
		}
		return false;
	}
	
	//This function handles the requests from the FriendList Page
	public function unFriend($id){
		$user = User::find($id);
		$alert = $this->removeFriendFromDatabase($id);
		if($alert){
			$message = $user->name . "removed from your Friend List.";
		}
		return redirect('/friendList')->with(['alert' => !$alert, 'message' => $message]);
	}
	
	public function createPost(Request $request){
		
		$this->validate($request, [
			'body' => 'required|max:1000',
		]);
		$post = new Post;
		$post->body = $request->input('body');
		$post->user_id = Auth::id();
		$message = "There was as error creating post.";
		if($post->save()){
			$message = "Post Created Successfully";
		}
		return redirect('/home')->with(['alert' => false, 'message' => $message]);
	}
	
	public function deletePost($id){
		$post = Post::find($id);
		$message = "Post Deletion Failed";
		if($post->delete()){
			$message = "Post Deletion Successful";
		}
		
		return redirect('/home')->with(['alert' => false, 'message' => $message]);
	}
	
	public function pendingRequest(){
		$user = Auth::user();
		$pendingRequests = $user->friend_requests;
		$users = User::all();
		$detailRecord = array();
		foreach($pendingRequests as $pendingRequest){
			foreach($users as $tempUser){
				if($pendingRequest->first_user == $tempUser->id){
					array_push($detailRecord, array($pendingRequest->first_user, $tempUser->name));
				}
			}
		}
		echo json_encode($detailRecord);
	}
	
	public function getUserList(){
		$users = User::all();
		return json_encode($users);
	}
	
	public function showProfile($id){
		if($id == Auth::id()){
			return redirect('/profile');
		}else{
			
			//$profile = Profile::find($id);
			$shelves = Shelf::where('user_id', $id)->with('book')->get();
			$user = User::find($id);
			$totalFriends = count($user->friends);
			
			//Determine if the logged in user has sent or recieved a request from the user whose profile is being viewed
			$friendships = Friendship::all();
			$isFriend = false;
			$isRequestSent = false;
			$hasRecievedRequest = false;
			foreach($friendships as $friendship){
				
				//Find Record between logged in user and the user whose profile is being viewed
				if(($friendship->first_user == Auth::id() && $friendship->second_user == $id) || ($friendship->first_user == $id && $friendship->second_user == Auth::id())){ 
					
					if($friendship->acted_user == Auth::id() && $friendship->status == 'pending'){
						//Current User has sent the request but the other user hasn't accepted
						//Button to show = Request Sent
						$isRequestSent = true;
					}elseif($friendship->acted_user == $id && $friendship->status == 'pending'){
						//Current User has recieved the request from the other user and hasn't responded yet
						//Button to show = Accept Request
						$hasRecievedRequest = true;
					}elseif($friendship->status == 'confirmed'){
						//Both users are already friends
						//Button to show = Unfriend
						$isFriend = true;
					}
				}
			}
			
			//If no record found at the end of the loop,
			//It means nobody has sent any request
			//All three boolean is false at this point and Button will show 'Add Friend'
			
			return view('user.anotherUserProfile',['user' => $user, 'shelves' => $shelves, 'totalFriends' => $totalFriends, 'isFriend' => $isFriend, 'isRequestSent' =>  $isRequestSent, 'hasRecievedRequest' => $hasRecievedRequest]); 
		}
	}
	
}
