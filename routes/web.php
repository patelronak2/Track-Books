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

Auth::routes(['verify' => true]);
Route::get('/profile','UserController@index');
Route::get('/setting','UserController@setting')->middleware('verified')->name('home');
Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');
Route::get('/admin', 'AdminController@admin')->middleware('is_admin')->name('admin');
Route::get('/manageUsers','AdminController@manageUsers')->middleware('is_admin')->name('admin');
Route::get('/manageBooks','AdminController@manageBooks')->middleware('is_admin')->name('admin');
Route::get('/manageAuthors','AdminController@manageAuthors')->middleware('is_admin')->name('admin');
Route::get('/addEntries','AdminController@addEntries')->middleware('is_admin')->name('admin');
Route::post('/insertUser','AdminController@insertUser')->middleware('is_admin')->name('admin');
Route::post('/insertBook','AdminController@insertBook')->middleware('is_admin')->name('admin');
Route::post('/insertAuthor','AdminController@insertAuthor')->middleware('is_admin')->name('admin');
Route::get('/deleteUser/{id}', 'AdminController@deleteUser')->middleware('is_admin')->name('admin');
Route::get('/banUser/{id}','AdminController@banUser')->middleware('is_admin')->name('admin');
Route::get('/deleteBook/{id}','AdminController@deleteBook')->middleware('is_admin')->name('admin');
Route::get('/addMultipleEntries','AdminController@addMultipleEntries')->middleware('is_admin')->name('admin');
Route::post('/insertMultipleBooks', 'AdminController@insertMultipleBooks')->middleware('is_admin')->name('admin');
Route::post('/ajaxBookInsert', 'AdminController@ajaxBookInsert')->middleware('is_admin')->name('admin');
Route::post('/searchInsert', 'AdminController@searchInsert');
Route::get('/showBook/{id}','HomeController@showBook');
Route::post('/addReview', 'HomeController@addReview');
Route::post('/deleteReview', 'HomeController@deleteReview');
Route::get('/manageReviews','AdminController@manageReviews')->middleware('is_admin')->name('admin');
Route::get('/deleteReview/{id}', 'AdminController@deleteReview' )->middleware('is_admin')->name('admin');
Route::post('/addToShelf','HomeController@addToShelf');
Route::get('/count', 'HomeController@getNotificationCount');
Route::get('/getNotification','HomeController@getNotifications');
Route::post('/rateBook', 'HomeController@rateBook');
Route::get('/getProfileDetails','UserController@getProfileDetails');
Route::post('/editProfile', 'UserController@editProfile');
Route::get('/deleteShelfBook/{id}', 'UserController@deleteShelfBook');
Route::get('/getUserList','HomeController@getUserList');
Route::get('/showProfile/{id}', 'HomeController@showProfile');

//-----------------------------------------------------------------------------
Route::get('/test', function(){
	$user = Auth::user();
	$user->notifications()->delete();
});
Route::get('/pendingRequest','HomeController@pendingRequest');
//---------------------------------------------------------------------
Route::get('/sendFriendRequest/{id}','UserController@sendFriendRequest');
Route::get('/friendList','UserController@friendList');
Route::get('/getFriendList','UserController@getFriendList');
Route::get('/removeFriendRecord/{id}', 'UserController@deleteFriendship');
Route::get('/acceptRequest/{id}','UserController@acceptRequest');
