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
Route::get('/profile','UserController@index')->middleware('verified');
Route::get('/setting','UserController@setting')->middleware('verified');
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
Route::post('/searchInsert', 'AdminController@searchInsert')->middleware('verified');;
Route::get('/showBook/{id}','HomeController@showBook')->middleware('verified');;
Route::post('/addReview', 'HomeController@addReview')->middleware('verified');;
Route::post('/deleteReview', 'HomeController@deleteReview')->middleware('verified');;
Route::get('/manageReviews','AdminController@manageReviews')->middleware('is_admin')->name('admin');
Route::get('/deleteReview/{id}', 'AdminController@deleteReview' )->middleware('is_admin')->name('admin');
Route::post('/addToShelf','HomeController@addToShelf')->middleware('verified');;
Route::get('/count', 'HomeController@getNotificationCount')->middleware('verified');;
Route::get('/getNotification','HomeController@getNotifications')->middleware('verified');;
Route::post('/rateBook', 'HomeController@rateBook')->middleware('verified');;
Route::get('/getProfileDetails','UserController@getProfileDetails')->middleware('verified');;
Route::post('/editProfile', 'UserController@editProfile')->middleware('verified');;
Route::get('/deleteShelfBook/{id}', 'UserController@deleteShelfBook')->middleware('verified');;
Route::get('/getUserList','HomeController@getUserList')->middleware('verified');;
Route::get('/showProfile/{id}', 'HomeController@showProfile')->middleware('verified');;

//-----------------------------------------------------------------------------
Route::get('/test', function(){
	$user = Auth::user();
	$user->notifications()->delete();
});
Route::get('/pendingRequest','HomeController@pendingRequest')->middleware('verified');;
//---------------------------------------------------------------------
Route::get('/sendFriendRequest/{id}','UserController@sendFriendRequest')->middleware('verified');;
Route::get('/friendList','UserController@friendList')->middleware('verified');;
Route::get('/getFriendList','UserController@getFriendList')->middleware('verified');;
Route::get('/removeFriendRecord/{id}', 'UserController@deleteFriendship')->middleware('verified');;
Route::get('/acceptRequest/{id}','UserController@acceptRequest')->middleware('verified');;
