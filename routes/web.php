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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/profile/{slug}', 'ProfilesController@index')->name('profile');
	Route::get('profile/edit/profile', 'ProfilesController@edit')->name('profile.edit');
	Route::post('profile/update/profile', 'ProfilesController@update')->name('profile.update');

	Route::get('/check_relationship_status/{id}', 'FriendshipsController@check')->name('check');
	Route::get('/add_friend/{id}', 'FriendshipsController@add_friend')->name('add_friend');
	Route::get('/accept_friend/{id}', 'FriendshipsController@accept_friend')->name('accept_friend');

	Route::get('/get_unread', function () {
		return Auth::user()->unreadNotifications;
	});

	Route::get('/notifications', 'HomeController@notifications')->name('notifications');
	Route::get('/feed', 'FeedsController@feed')->name('feed');
	Route::post('/create/post', 'PostsController@store');

	Route::get('/get_auth_user_data', function () {
		return Auth::user();
	});

	Route::get('/like/{id}', 'LikesController@like');
	Route::get('/unlike/{id}', 'LikesController@unlike');

	Route::get('/chat', 'ChatsController@chat');
	Route::post('/send', 'ChatsController@send');

	Route::get('/findfriends', 'ProfilesController@findfriends')->name('findfriends');
});
