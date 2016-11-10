<?php

Route::get('/', function() {
    if(auth()->check())
        return redirect()->action('UsersController@index');

    return redirect('login');
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('users', 'UsersController@index');
    Route::get('users/{user}', 'UsersController@show');
    Route::get('users/{user}/edit', 'UsersController@edit');
    Route::post('users/{user}/edit', 'UsersController@update');

    Route::get('referendums', 'ReferendumsController@index');
    Route::get('referendums/{referendum}', 'ReferendumsController@show');
    Route::get('referendums/{referendum}/submit/{referendumAnswer}', 'ReferendumsController@submitVote');


    Route::get('test-profile-data', function() {
        $user = auth()->user()->load('votingLocation');

        return $user;
    });


}) ;
