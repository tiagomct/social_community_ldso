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

    Route::get('users/{user}', 'ProfileController@show');

    Route::get('users/{user}/edit', 'ProfileController@edit');
    Route::post('users/{user}/edit', 'ProfileController@update');

    Route::get('referendums/{referendum}', 'ReferendumController@show');
    Route::get('referendums/{referendum}/submit/{referendumAnswer}', 'ReferendumController@submitVote');


    Route::get('test-profile-data', function() {
        $user = auth()->user()->load('votingLocation');

        return $user;
    });

    Route::get('users', 'ProfileController@list');

}) ;
