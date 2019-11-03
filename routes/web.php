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
Route::get('/admin', 'AdminController@admin')    
    ->middleware('is_admin')    
    ->name('admin');
Route::get('/manageUsers','AdminController@manageUsers');
Route::get('/manageBooks','AdminController@manageBooks');
Route::get('/manageAuthors','AdminController@manageAuthors');
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
Route::post('/test', 'User@index');