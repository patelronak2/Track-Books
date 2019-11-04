<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Book;
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
		
		$reviews = Review::where('book_id', $id)->get();
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
		
		$reviews = Review::where('book_id', $book_id)->get();	
		return $reviews;
	}
}
