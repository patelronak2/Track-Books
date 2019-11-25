<?php
//Created by Ronak Patel
namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Book;
use App\Models\Author;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
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
     * handles the route /admin
     *
     * @return dashboard.blade.php
     */
    public function admin()
    {
        return view('admin.dashboard');
    }
	
	/**
     * handles the route /manageUsers
     *
     * @return users.blade.php
     */
	public function manageUsers()
    {
		$users = User::all();
        return view('admin.users', ['users' => $users]);
    }
	
	/**
     * handles the route /manageBooks
     *
     * @return books.blade.php
     */
	public function manageBooks()
    {
		$books = Book::all();
        return view('admin.books',['books' => $books]);
    }
	
	/**
     * handles the route /manageAuthors
     *
     * @return authors.blade.php
     */
	public function manageAuthors()
    {
		$authors = Author::all();
        return view('admin.authors', ['authors' => $author]);
    }
	
	/**
     * handles the route /addEntries
     *
     * @return addEntries.blade.php
     */
	public function addEntries()
    {
        return view('admin.addEntries');
    }
	
	/**
     * handles the route /insertUser and insert a new record into user table
     *
     * @return addEntries.blade.php
     */
	public function insertUser(Request $request)
	{
		
		$validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
			'type' => User::DEFAULT_TYPE,
			
        ]);
		
		$name = $request->input('name');
		$email = $request->input('email');
		$password = $request->input('password');
		$confirmPassword = $request->input('password-confirm');
		$user = new User;
		$user->name = $name;
		$user->password = Hash::make($password);
		$user->email = $email;
		$user->save();
		$message = "Record insertion successful. User Added: " . $name;
		return redirect('/manageUsers')->with(['message' => $message, 'alert' => false]);
	}
	
	/**
     * handles the route /deleteUser
     *
     * @return users.blade.php
     */
	 public function deleteUser($id)
	 {
		$user = User::find($id);
		$name = $user->name;
		$user->delete();
		$message = "Deletion Successful: ". $name . " Deleted";
		return redirect('/manageUsers')->with(['message' => $message, 'alert' => false]);
	 }
	 
	 /**
     * handles the route /banUser
     *
     * @return users.blade.php
     */
	 public function banUser($id)
	 {
		$user = User::find($id);
		$message = "";
		$alert = false;
		if($user->isBan){
			$user->isBan = false;
			$message = "Ban removed from user: " . $user->name;
		}else{
			if($user->type == 'default'){			
				$user->isBan = true;
				$message = "Baned user: " . $user->name;
			}else{
				$message = "cannot ban an administrator " . $user->name;
				$alert = true;
			}
		}
		$user->save();
		
		return redirect('/manageUsers')->with(['message' => $message, 'alert' => $alert]);
	 }
	 
	 /**
     * handles the route /insertBook
     *
     * @return books.blade.php
     */
	 public function insertBook(Request $request)
	 {
		 $validatedData = $request->validate([
            'title' => ['required', 'unique:books'],			
        ]);
		 
		 $book = new Book;
		 $book->title = $request->input('title');
		 $book->description = $request->input('description');
		 $book->author = $request->input('authorName');
		 $book->category = $request->input('category');
		 $book->publisher = $request->input('publisher');
		 $book->publishedDate = $request->input('publishedDate');
		 $book->save();
		 
		 $message = "Book inserted: " . $title;
		 return redirect('manageBooks')->with(['alert' => false, 'message' => $message]);
		 
	 }
	 
	 /**
     * handles the route /deleteBook
     *
     * @return books.blade.php
     */
	 public function deleteBook($id)
	 {
		 
		 $book = Book::find($id);
		 $title = $book->title;
		 $book->delete();
		 
		 $message = "Book Deleted: " . $title;
		 return redirect('manageBooks')->with(['message' => $message, 'alert' => false]);
	 }
	 
	 /**
     * handles the route /addMultipleEntries
     *
     * @return addMultipleEntries.blade.php
     */
	 public function addMultipleEntries()
	 {
		 return view('admin.addMultipleEntries');
	 }
	 
	 /**
     * handles the route /insertMultipleBooks
     *
     * @return 
     */
	 public function insertMultipleBooks(Request $request)
	 {
		 $alert = "One or more insertion failed. Try another term";
		 return redirect('/addMultipleEntries')->with(['alert' => true, 'message' => $alert]);
	 }
	 
	 public function ajaxBookInsert(Request $request)
	 {
		 $validatedData = $request->validate([
            'title' => ['required', 'unique:books'],			
        ]);
		 
		 $book = new Book;
		 $book->title = $request->input('title');
		 $book->description = $request->input('description');
		 $book->author = $request->input('author');
		 $book->category = $request->input('category');
		 $book->publisher = $request->input('publisher');
		 $book->publishedDate = $request->input('publishedDate');
		 $book->img_link = $request->input('imgLink');
		 $book->save();
	 }
	 
	 /**
     * handles the route /searchInsert
     *
     * @return 
     */
	 public function searchInsert(Request $request)
	 {
				
		$validator = Validator::make($request->all(), [
            'title' => 'required|unique:books',
        ]);

        if ($validator->fails()) {
            
        }else{
			 $book = new Book;
			 $book->title = $request->input('title');
			 $book->description = $request->input('description');
			 $book->author = $request->input('author');
			 $book->category = $request->input('category');
			 $book->publisher = $request->input('publisher');
			 $book->publishedDate = $request->input('publishedDate');
			 $book->img_link = $request->input('imgLink');
			 $book->save();
		}
		 $books = Book::all();
		 foreach ($books as $book){
			if($book->title == $request->input('title')){
				return $book->id;	
			} 
		}
		 
	 }
	 
	 /**
     * handles the route /manageReviews
     *
     * @return reviews.blade.php
     */
	 public function manageReviews()
	 {
		$reviews = Review::all();
        return view('admin.reviews',['reviews' => $reviews]);
	 }
	 
	 public function deleteReview($id)
	 {
		 $review = Review::find($id);
		 $review->delete();
		 
		 $message = "Review Deleted";
		 return view('/manageReviews')->with(['message' => $message, 'alert' => false]); 
	 }
	
	public function insertAuthor(Request $request){
		$this->validate($request, [
			'authorName' => 'required|max:50|unique:authors',
		]);
		$author = new Author;
		$author->name = $request->input('authorName');
		$message = "There was as error inserting Author.";
		$alert = true;
		if($author->save()){
			$message = "Author added Successfully: " . $request->input('authorName');
			$alert = false;
		}
		return redirect('/manageAuthors')->with(['alert' => $alert, 'message' => $message]);
	}
	
	public function deleteAuthor($id){
		$author = Author::find($id);
		$name = $author->name;
		$message = "Couldn't delete author: " . $name;
		$alert = true;
		if($author->delete()){
			$message = "Author deleted successfully: " . $name;
			$alert = false;
		}
		return redirect('/manageAuthors')->with(['alert' => $alert, 'message' => $message]);
	}
}
