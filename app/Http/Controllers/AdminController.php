<?php
//Created by Ronak Patel
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
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
        return view('admin.books',['books' => $books]);
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
			$user->isBan = true;
			$message = "Baned user: " . $user->name;
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
		 $bookName = $request->input('bookName');
		 $authorName = $request->input('authorName');
		 $category = $request->input('category');
		 $year = $request->input('year');
	 }
	
	
}
