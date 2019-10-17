<?php
//Created by Ronak Patel
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
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
        return view('admin.users', ['users' => $users, 'insertUser' => false, 'deleteUser' => false, 'banUser' => false]);
    }
	
	/**
     * handles the route /manageBooks
     *
     * @return books.blade.php
     */
	public function manageBooks()
    {
		$books = Book::all();
        return view('admin.books',['books' => $books, 'deleteBook' => false, 'insertBook' => false]);
    }
	
	/**
     * handles the route /manageAuthors
     *
     * @return authors.blade.php
     */
	public function manageAuthors()
    {
        return view('admin.authors');
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
		$users = User::all();
		return view('admin.users', ['users'=> $users,'alert' => 'Row added Successfully.', 'name' => 'User name: '.$name, 'insertUser' => true, 'deleteUser' => false, 'banUser' => false]);
	}
	
	/**
     * handles the route /deleteUser
     *
     * @return users.blade.php
     */
	 public function deleteUser($id)
	 {
		$user = User::find($id);
		$user->delete();
		$data = User::all();
		return view('admin.users', ['users' => $data, 'insertUser' => false, 'alert' => 'Deletion Successful.', 'deleteUser' => true, 'banUser' => false]);
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
		if($user->isBan){
			$user->isBan = false;
			$message = "Ban removed from user: " . $user->name;
		}else{
			if($user->type == 'default'){			
				$user->isBan = true;
				$message = "Baned user: " . $user->name;
			}else{
				$message = "cannot ban an administrator " . $user->name;
			}
		}
		$user->save();
		
		$data = User::all();
		return view('admin.users', ['users' => $data, 'insertUser' => false, 'alert' => $message, 'deleteUser' => false, 'banUser' => true]);
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
		 $title = $request->input('title');
		 $description = $request->input('description');
		 $authorName = $request->input('authorName');
		 $category = $request->input('category');
		 $publisher = $request->input('publisher');
		 $publishedDate = $request->input('publishedDate');
		 
		 $book = new Book;
		 $book->title = $request->input('title');
		 $book->description = $request->input('description');
		 $book->author = $request->input('authorName');
		 $book->category = $request->input('category');
		 $book->publisher = $request->input('publisher');
		 $book->publishedDate = $request->input('publishedDate');
		 $book->save();
		 
		 $message = "Book inserted: " . $title;
		 $data = Book::all();
		 return view('admin.books',['books' => $data, 'insertBook' => true, 'alert' => $message, 'deleteBook' => false]);
		 
	 }
	 
	 /**
     * handles the route /deleteBook
     *
     * @return books.blade.php
     */
	 public function deleteBook($id)
	 {
		 $book = Book::find($id);
		 $book->delete();
		 
		 $message = "Deletion successful.";
		 $data = Book::all();
		 return view('admin.books',['books' => $data, 'insertBook' => false, 'alert' => $message, 'deleteBook' => true]);
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
		 //need to handle onclick on 'add multiple books' by adding a JavaScript function in the addMultipleEntries.blade
		 //make a ajax request and recieve the result. Convert the result into JSON and make a post ajax request here.
		 //Use the passed data to insert into row
		 
		 //return view or a message
		 $data = json_decode($request->input('data'));
		 
		 for ($i = 0; $i < 5; $i++) {
			 $title = $data->items[$i]->volumeInfo->title;
			 //$description = $data->items[$i]->volumeInfo->description;
			 $author = $data->items[$i]->volumeInfo->authors[0];
			 //$category = $data->items[$i]->volumeInfo->categories[0];
			 //$publisher = $data->items[$i]->volumeInfo->publisher;
			 //$publishedDate = $data->items[$i]->volumeInfo->publishedDate;
			 $img_link = $data->items[$i]->volumeInfo->imageLinks->smallThumbnail;
		 }
		 
		 echo "successful";
		 
		 
	 }
	
	
}
