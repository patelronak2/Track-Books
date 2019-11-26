<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.front');
});

Route::group(['middleware' => ['is_admin', 'verified']],function(){
	Route::get('/admin', 'AdminController@admin');
	Route::get('/manageUsers','AdminController@manageUsers');
	Route::get('/manageBooks','AdminController@manageBooks');
	Route::get('/manageAuthors','AdminController@manageAuthors');
	Route::get('/deleteAuthor/{id}','AdminController@deleteAuthor');
	Route::get('/addEntries','AdminController@addEntries');
	Route::post('/insertUser','AdminController@insertUser');
	Route::post('/insertBook','AdminController@insertBook');
	Route::post('/insertAuthor','AdminController@insertAuthor');
	Route::get('/deleteUser/{id}', 'AdminController@deleteUser');
	Route::get('/banUser/{id}','AdminController@banUser');
	Route::get('/deleteBook/{id}','AdminController@deleteBook');
	Route::get('/addMultipleEntries','AdminController@addMultipleEntries');
	Route::post('/insertMultipleBooks', 'AdminController@insertMultipleBooks');
	Route::post('/ajaxBookInsert', 'AdminController@ajaxBookInsert');
	Route::get('/manageReviews','AdminController@manageReviews');
	Route::get('/deleteReview/{id}', 'AdminController@deleteReview');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified']],function(){
	Route::get('/profile','UserController@index');
	Route::get('/setting','UserController@setting');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::post('/searchInsert', 'AdminController@searchInsert');
	Route::get('/showBook/{id}','HomeController@showBook');
	Route::post('/addReview', 'HomeController@addReview');
	Route::post('/deleteReview', 'HomeController@deleteReview');
	Route::post('/addToShelf','HomeController@addToShelf');
	Route::get('/count', 'HomeController@getNotificationCount');
	Route::get('/getNotification','HomeController@getNotifications');
	Route::post('/rateBook', 'HomeController@rateBook');
	Route::get('/getProfileDetails','UserController@getProfileDetails');
	Route::post('/editProfile', 'UserController@editProfile');
	Route::get('/deleteShelfBook/{id}', 'UserController@deleteShelfBook');
	Route::get('/getUserList','HomeController@getUserList');
	Route::get('/showProfile/{id}', 'HomeController@showProfile');
	Route::get('/pendingRequest','HomeController@pendingRequest');
	Route::get('/sendFriendRequest/{id}','UserController@sendFriendRequest');
	Route::get('/friendList','UserController@friendList');
	Route::get('/getFriendList','UserController@getFriendList');
	Route::get('/removeFriendRecord/{id}', 'UserController@deleteFriendship');
	Route::get('/acceptRequest/{id}','UserController@acceptRequest');
	Route::post('/createPost', 'UserController@createPost');
	Route::get('/deletePost/{id}','UserController@deletePost');
	Route::get('/groupChat', 'ChatsController@index');
	Route::get('/messages', 'ChatsController@fetchMessages');
	
});
