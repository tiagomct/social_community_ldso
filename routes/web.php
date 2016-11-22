<?php

Route::get('/', function() {
    if(auth()->check())
        return redirect()->action('MunicipalityController@access');

    return redirect('login');
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home','MunicipalityController@access');

    Route::get('forums', 'ForumsController@index');
    Route::get('forums/create', 'ForumsController@create');
    Route::post('forums/create', 'ForumsController@store');
    Route::get('forums/{forum}', 'ForumsController@show');
    Route::post('forums/{forum}', 'ForumsController@submitEntry');
    Route::get('forums/{forum}/like', 'ForumsController@submitLike');
    Route::get('forums/{forum}/deslike', 'ForumsController@submitDeslike');
    Route::get('forums/{forum}/like/{forum_entry}', 'ForumsController@submitLikeEntry');
    Route::get('forums/{forum}/deslike/{forum_entry}', 'ForumsController@submitDeslikeEntry');

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
