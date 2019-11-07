<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Shelf;
use App\Review;

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
        return view('home');
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
		return view('book.bookProfile',['book' => $book, 'description' => $description, 'author' => $author, 'publisher' => $publisher, 'publishedDate' => $publishedDate, 'category' => $category, 'reviews' => $reviews]);
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
	
	public function addToShelf(Request $request)
	{
		//$bookShelf = $request->input('bookShelf');
		$book_id = $request-input('book_id');
		$user_id = Auth::id();
		$currentlyReading = false;
		$wantToRead = false;
		$finishedReading = false;
		echo "Recieved Message";
		// $shelf = Shelf::where([['book_id', '=' , $book_id],['user_id', '=' , $user_id]])->first();
		
		// if($shelf){
			// return "$shelf";
		// }else{
			// return "Nothing in the database";
		// }
	}
}
