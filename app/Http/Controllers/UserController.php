<?php
/*
	This page handles requests related to user's profile.
	Created By: Ronak Patel
*/
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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the user's profile
     *
	 * return profile.blade.php page
     */
    public function index()
    {
		try{
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
		}catch(Exception $e){
			return back()->withError("Something went Wrong while Finishing Request")->withInput();
		}
		
        return view('user.profile',['profile' => $profile, 'shelves' => $shelves, 'totalFriends' => $totalFriends]);
    }
	
	/**
	*Show the user's account setting page
	*
	*return setting.blage.php page
	*/
	public function setting()
	{	
		try{
			$shelves = Shelf::where('user_id', Auth::id())->with('book')->get();
		}catch(Exception $e){
			return back()->withError("Something went Wrong while Finishing Request")->withInput();
		}
		return view('user.setting',['shelves' => $shelves]);
	}
	
	/**
	*Handle the ajax request 
	*
	*return array containing a user profile's detail
	*/
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
	
	/**
	*Update changes made to user profile and save them
	*
	*/
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
	
	
	/**
	*Delete a book from user's Book Shelf
	*
	*/
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
	
	
	/**
	*Send a notification to a different user. Also, notifies that user
	*
	*/
	public function sendFriendRequest($id){
		$friendship = new Friendship;
		$friendship->first_user = Auth::id();
		$friendship->second_user = $id;
		$friendship->acted_user = Auth::id();
		$friendship->status = 'pending';
		$friendship->save();
		try{
			//Notify the user with id => $id about the Friend Request
			//Auth::user() will be the user sending the friend request and user with $id will the user receiving request
			$user = User::find($id);
			$user->notify(new FriendRequestSent(Auth::id(), Auth::user()->name));
		}catch(Exception $e){
			return back()->withError("Something went Wrong while Finishing Request")->withInput();
		}
		
		return redirect('/showProfile/' . $id);
	}
	
	/**
	*handles the request of adding friend from ajax calls
	*/
	public function acceptRequest($id){
		$alert = $this->addFriend($id);
		if($alert){
			echo "Success";
		}else{
			echo "Failed";
		}
	}
	
	/**
	*Change database record to reflect that the user has been added as friend
	*/
	public function addFriend($id){
		Friendship::where('first_user', $id)->where('second_user', Auth::id())->update(['status' => 'confirmed', 'acted_user' => Auth::id()]);
		//Auth::user() will be the user accepting the request
		//User with $id will be the one who had sent the request and receiving this notification
		$user = User::find($id);
		$user->notify(new FriendRequestAccepted(Auth::id(), Auth::user()->name));
		return true;
	}
	
	/**
	*Accept friend request from friend List page
	*
	*/
	public function acceptFriendRequest($id){
		$alert = $this->addFriend($id);
		$user = User::find($id);
		$message = "Couldn't add as Friend";
		if($alert){
			$message = $user->name . ": Added as Friend!";
		}
		return redirect('/friendList')->with(['alert' => !$alert, 'message' => $message]);
	}
	
	/**
	*Show user's friend and pending requests 
	*
	*return friendList.blade.php
	*/
	public function friendList(){
		$user = Auth::user();
		$friends = $user->friends;
		$user = Auth::user();
		$pendingRequests = $user->friend_requests;
		$users = User::all();
		$requests = [];
		foreach($pendingRequests as $pendingRequest){
			foreach($users as $tempUser){
				if($pendingRequest->first_user == $tempUser->id){
					$requests[] = [ $pendingRequest->first_user, $tempUser->name];
				}
			}
		}
		
		return view('user.friendList', ['friends' => $friends, 'requests' => $requests]);
	}
	
	/**
	*This function handles the request from friendList.blade, declines the friend request and send back a message!
	*
	*/
	public function declineRequest($id){
		try{
			$user = User::find($id);
			$alert = $this->removeFriendFromDatabase($id);
			if($alert){
				$message = "You Denied Friend request from " . $user->name;
			}
		}catch(Exception $e){
			return back()->withError("Request couldn't be complete. Record with id: ". $id . "may not exist in database anymore.")->withInput();
		}
		
		return redirect('/friendList')->with(['alert' => !$alert, 'message' => $message]);
	}
	
	/**
	*This Function Handles Ajax Requests that is being sent from anotherUserProfile.blade
	*
	*/
	public function deleteFriendship($id){
		$alert = $this->removeFriendFromDatabase($id);
		if($alert){
			echo "Success";
		}else{
			echo "Failed";
		}
		
	}
	
	/**
	*This Function deletes Friendship Record from the database
	*Provides the functionality of Decline Friend Request or Unfriend
	*/
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
	
	/**
	*This function handles the requests from the FriendList Page
	*
	*/
	public function unFriend($id){
		try{
			$user = User::find($id);
			$alert = $this->removeFriendFromDatabase($id);
			if($alert){
				$message = $user->name . ": Removed from your Friend List.";
			}
		}catch(Exception $e){
			return back()->withError("Request couldn't be complete. Record with id: ". $id . "may not exist in database anymore.")->withInput();
		}
		return redirect('/friendList')->with(['alert' => !$alert, 'message' => $message]);
	}
	
	/**
	*This function validates user input and create a post
	*
	*/
	public function createPost(Request $request){
		
		$this->validate($request, [
			'body' => 'required|max:1000',
		]);
		try{
			$post = new Post;
			$post->body = $request->input('body');
			$post->user_id = Auth::id();
			$message = "There was as error creating post.";
			if($post->save()){
				$message = "Post Created Successfully";
			}
		}catch(Exception $e){
			return back()->withError("Something went Wrong while Finishing Request")->withInput();
		}
		
		return redirect('/home')->with(['alert' => false, 'message' => $message]);
	}
	
	/**
	*This function delete a post with the received id
	*
	*/
	public function deletePost($id){
		try{
			$post = Post::find($id);
			$message = "Post Deletion Failed";
			if($post->delete()){
				$message = "Post Deletion Successful";
			}
		}catch(Exception $e){
			return back()->withError("Couldn't complete request. Requested data may not exist.")->withInput();
		}
				
		return redirect('/home')->with(['alert' => false, 'message' => $message]);
	}
	
	/**
	*This functions returns list of all the users from the database
	*
	*/
	public function getUserList(){
		$users = User::all();
		return json_encode($users);
	}
	
	/**
	*This function collects all data of a user and return profile of that user
	*
	*/
	public function showProfile($id){
		if($id == Auth::id()){
			return redirect('/profile');
		}else{
			try{
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
		}catch(Exception $exception){
			return back()->withError("Request couldn't be complete. Record with id: ". $id . "may not exist in database anymore.")->withInput();
		}
			return view('user.anotherUserProfile',['user' => $user, 'shelves' => $shelves, 'totalFriends' => $totalFriends, 'isFriend' => $isFriend, 'isRequestSent' =>  $isRequestSent, 'hasRecievedRequest' => $hasRecievedRequest]); 
		}
	}
	
}
