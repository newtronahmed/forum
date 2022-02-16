<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',function(){
    return redirect('/discussions');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/discussions/create','DiscussionsController@create')->name('discussions.create');
// Route::post('/discussions','DiscussionsController@store')->name('discussions.store');
// Route::get('/discussions','DiscussionsController@index')->name('discussions.index');
Route::get('/notifications','HomeController@notifications')->name('notifications');
Route::resource('discussions','DiscussionsController');
Route::resource('/discussions/{discussion}/replies','RepliesController');
Route::post('/discussions/{discussion}/replies/{reply}/markAsBestReply','DiscussionsController@markAsBestReply')->name('markAsBestReply');
Route::post('/discussions/{discussion}/like','LikesController@store')->name('discussion.like');
Route::delete('/discussions/{discussion}/dislike','LikesController@delete')->name('discussion.dislike');
