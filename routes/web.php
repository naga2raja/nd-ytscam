<?php

use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;

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
Route::get('/clear-cache', function() {
   $exitCode = Artisan::call('cache:clear');
   return 'success';
});

Route::get('/', function () {
    return view('home');
    //return redirect(RouteServiceProvider::HOME);
});

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/new-theme-index', function () {
    return view('layouts/newapp');
});

Route::get('/auth/callback', 'App\Http\Controllers\Auth\RegisteredUserController@loginWithGoogle');

Route::group(['middleware' => ['auth']], function () {
    //only authorized users can access these routes
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/test', 'App\Http\Controllers\TestController@test');

	Route::get('/video', 'App\Http\Controllers\VideoController@index')->name('video');
	Route::post('/channel/videos/{channelId}', 'App\Http\Controllers\VideoController@videosList');
	Route::post('/video/comments/{videoId}', 'App\Http\Controllers\VideoController@allCommentsList');
	Route::post('/comments/delete', 'App\Http\Controllers\VideoController@deleteComments');
    Route::post('/comments/search', 'App\Http\Controllers\VideoController@searchComments');
    
    Route::get('/video-details/{videoId}', 'App\Http\Controllers\VideoController@details');

    Route::get('/subscribe-now/{planId}', 'App\Http\Controllers\SubscriptionController@subscribeNow');
    Route::resource('/define-spam-words', 'App\Http\Controllers\DefineSpamController', ['names' => ['index' =>'spamwords.list']]);
    Route::resource('/no-spam-words', 'App\Http\Controllers\NoSpamWordController');

});
    Route::get('/log_out', 'App\Http\Controllers\VideoController@logout')->name('log_out');


require __DIR__.'/auth.php';
