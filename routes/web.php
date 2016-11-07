<?php

Route::get('/', function() {
    if(auth()->check())
        return redirect('home');

    return redirect('login');
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('pages.home');
    });

    Route::get('profile/{user}', 'ProfileController@show');
    Route::any('user/edit', 'ProfileController@update');


    Route::get('test-profile-data', function() {
        $user = auth()->user()->load('votingLocation');

        return $user;
    });
}) ;
