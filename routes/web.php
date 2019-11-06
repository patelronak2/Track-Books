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
Route::get('/profile','User@index');
Route::get('/setting','User@setting');
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