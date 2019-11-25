<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Book;
use App\Models\Shelf;
use App\Models\Review;
use App\Models\Post;
use App\Models\Rating;
use App\Models\Friendship;
use App\Notifications\ShelfUpdated;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
		$posts = Post::all();
        return view('home', ['posts' => $posts]);
    }
	
	public function showBook($id)
	{
		$book = Book::find($id);
		$description = true;
		$author = true;
		$publisher = true;
		$publishedDate = true;
		$category = true;
		if($book->description == "Information not Available"){
			$description = false;
		}
		if($book->author == "Information not Available"){
			$author = false;
		}
		if($book->publisher == "Information not Available"){
			$publisher = false;
		}
		if($book->publishedDate == "Information not Available"){
			$publishedDate = false;
		}
		if($book->category == "Information not Available"){
			$category = false;
		}
		
		$reviews = Review::where('book_id', $id)->orderBy('id', 'desc')->get();
		$wantToRead = false;
		$currentlyReading = false;
		$finishedReading = false;
		$shelves = Shelf::all();
		foreach($shelves as $shelf){
			if($shelf->book_id == $id && $shelf->user_id == Auth::id()){
				if($shelf->wantToRead){
					$wantToRead = true;
				}elseif($shelf->currentlyReading){
					$currentlyReading = true;
				}else{
					$finishedReading = true;
				}
			}
		}
		
		
		$allRating = Rating::where('book_id', $id)->get();
		$finalRating = 0;
		if(sizeof($allRating)){
			$totalRating = 0;
			foreach($allRating as $allUserRating){
				$totalRating += $allUserRating->rating;
			}
			$finalRating = $totalRating/sizeof($allRating);
		}
				
		return view('book.bookProfile',['book' => $book, 'description' => $description, 'author' => $author, 'publisher' => $publisher, 'publishedDate' => $publishedDate, 'category' => $category, 'reviews' => $reviews, 'wantToRead' => $wantToRead, 'currentlyReading' => $currentlyReading, 'finishedReading' => $finishedReading, 'finalRating' => $finalRating, 'totalRatings'=> sizeof($allRating)]);
	}
	
	public function addReview(Request $request)
	{
		$validatedData = $request->validate([
            'review' => ['required'],			
        ]);
		
		$user_id = Auth::id();
		$book_id = $request->input('id');
		$userReview = $request->input('review');
		
		$review = new Review;
		$review->user_id = $user_id;
		$review->book_id = $book_id;
		$review->review = $userReview;
		$review->save();
		
		$reviews = Review::where('book_id', $book_id)->orderBy('id', 'desc')->with('user')->get();
		echo json_encode(array('data' => $reviews, 'userType' => Auth::user()->type, 'userId' => $user_id));
	}
	
	public function deleteReview(Request $request){
		
		$book_id = $request->input('book_id');
		$review_id = $request->input('review_id');
		
		$review = Review::find($review_id);
		$review->delete();
		
		$reviews = Review::where('book_id', $book_id)->orderBy('id', 'desc')->with('user')->get();
		echo json_encode(array('data' => $reviews, 'userType' => Auth::user()->type, 'userId' => Auth::id()));	
	}
	
	public function rateBook(Request $request){
		$book_id = $request->input('book_id');
		$user_id = Auth::id();
		//$rating = Rating::where('book_id', $book_id)->where('user_id', $user_id)->get();
		$rating = Rating::all();
		$ratingId = -1;
		foreach($rating as $temp){
			if($temp->user_id == $user_id && $temp->book_id == $book_id){
				$ratingId = $temp->id;
			}
		}
		
		if($ratingId != -1){
			$rating = Rating::find($ratingId);
			$rating->rating = $request->input('rating');
			$rating->save();
		}else{
			$rating = new Rating;
			$rating->user_id = $user_id;
			$rating->book_id = $book_id;
			$rating->rating = $request->input('rating');
			$rating->save();
		}
		
		$allRating = Rating::where('book_id', $book_id)->get();
		
		$totalRating = 0;
		foreach($allRating as $allUserRating){
			$totalRating += $allUserRating->rating;
		}
		
		$finalRating = $totalRating/sizeof($allRating);
		$book = Book::findorfail($book_id);
		$book->rating = $finalRating;
		
		return json_encode(array('finalRating' => $finalRating, 'totalRatings' => sizeof($allRating)));
		
	}
	
	public function addToShelf(Request $request)
	{
		$bookShelf = $request->input('bookShelf');
		$book_id = $request->input('book_id');
		$user_id = Auth::id();
		$currentlyReading = false;
		$wantToRead = false;
		$finishedReading = false;
		$message = "";
		if($bookShelf == "Want to Read"){
			$wantToRead = true;
			$message = 'Added to "Want To Read" shelf.';
		}
		if($bookShelf == "Currently Reading"){
			$currentlyReading = true;
			$message = 'Added to "Currently Reading" shelf.';
		}
		if($bookShelf == "Finished Reading"){
			$finishedReading = true;
			$message = 'Added to "Finished Reading" shelf.';
		}
		$shelfId = -1;
		$shelves = Shelf::all();
		foreach($shelves as $shelf){
			if($shelf->book_id == $book_id && $shelf->user_id == $user_id){
				$shelfId = $shelf->id;
			}
		}
		if($shelfId != -1){
			$shelf = Shelf::find($shelfId);
			$shelf->currentlyReading = $currentlyReading;
			$shelf->wantToRead = $wantToRead;
			$shelf->finishedReading = $finishedReading;
			$shelf->save();
			//fire notification from here to show that book shelf has been updated
			
		}else{
			$shelf = new Shelf;
			$shelf->user_id = $user_id;
			$shelf->book_id = $book_id;
			$shelf->currentlyReading = $currentlyReading;
			$shelf->wantToRead = $wantToRead;
			$shelf->finishedReading = $finishedReading;
			$shelf->save();
			//fire notification to show that book has been added to shelf
		}
		
		$user = Auth::user();
		$book = Book::findorfail($book_id);
		$user->notify(new ShelfUpdated($user, $book, $message));
	}
	
	public function getNotificationCount(){
		$user = Auth::user();
		$count = $user->unreadNotifications()->count();
		return ['count' => $count];
	}
	
	public function	getNotifications(){
		
		$user = Auth::user();
		$user->unreadNotifications->markAsRead();
		$data = array();
		foreach($user->notifications as $notification){
			array_push($data, $notification->created_at->diffForHumans());
		}
		return ['notification' => $user->notifications,'timeStamp' => $data];
	}
	
	public function getUserList(){
		
		//Get only those users where account is public
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
	
}
