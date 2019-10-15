<?php
//Created by Ronak Patel
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Http\Controllers\Controller;

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
        return view('admin.users', ['users' => $users, 'insertUser' => false]);
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
	
	public function insertUser(Request $request)
	{
		$name = $request->input('name');
		$email = $request->input('email');
		$password = $request->input('password');
		$confirmPassword = $request->input('password-confirm');
		
		return view('admin.users', ['alert' => 'Row added Successfully', 'email' => $email, 'insertUser' => true]);
	}
}
