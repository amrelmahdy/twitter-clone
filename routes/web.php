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


/* LOGIN ROUTES */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('postLogin');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// social login
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name('loginFacebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::get('login/google', 'Auth\LoginController@redirectToGoogle')->name('loginGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');


/* RESET PASSWORD */
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('sendResetEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('passwordReset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('resetPassword');



Route::group(['middleware' => 'auth'], function (){
    Route::get('/', 'HomeController@index');

    Route::get('/{username}', 'ProfileController@profile')->name('profile');
    Route::post('/set-avatar', 'ProfileController@setAvatar')->name('setAvatar');

    Route::get('/who-to-follow', 'HomeController@whoToFollow');

    Route::post('/tweets/add-tweet', 'TweetController@create')->name('createTweet');
    Route::get('/tweets/reload-tweets/{id?}', 'TweetController@reloadTweets')->name('reloadTweets');
    Route::post('/tweets/favourite', 'TweetController@favouriteTweet')->name('favouriteTweet');
    Route::get('/tweets/reload-tweet-info/{tweet_id}', 'TweetController@reloadTweetInfo')->name('reloadTweetInfo');
    Route::get('/tweets/reload-user-info', 'TweetController@reloadUserInfo')->name('reloadUserInfo');


    Route::post('/follow', 'FollowController@follow')->name('follow');
    Route::get('/follow/reload-who-to-follow', 'FollowController@reloadWhoToFollow')->name('reloadWhoToFollow');
});


