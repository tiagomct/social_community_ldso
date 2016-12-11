<?php
Auth::loginUsingId(1);

Route::get('/', function () {
    if (auth()->check())
        return redirect()->action('MunicipalityController@access');

    return redirect('login');
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'MunicipalityController@access');

    Route::get('forum-entries', 'ForumEntriesController@index');
    Route::get('forums-entries/create', 'ForumEntriesController@create');
    Route::post('forums-entries', 'ForumEntriesController@store');
    Route::get('forums-entries/{forumEntry}', 'ForumEntriesController@show');

    Route::get('users', 'UsersController@index');
    Route::get('users/{user}', 'UsersController@show');
    Route::get('users/{user}/edit', 'UsersController@edit');
    Route::post('users/{user}/edit', 'UsersController@update');
    Route::get('feed/subscriptions', 'FeedsController@subscriptions');

    Route::get('referendums', 'ReferendumsController@index');
    Route::get('referendums/create', 'ReferendumsController@create');
    Route::post('referendums', 'ReferendumsController@store');
    Route::get('referendums/{referendum}', 'ReferendumsController@show');

    Route::get('ideas', 'IdeaEntriesController@index');
    Route::get('ideas/create', 'IdeaEntriesController@create');
    Route::get('ideas/{ideaEntry}', 'IdeaEntriesController@show');
    Route::post('ideas', 'IdeaEntriesController@store');


    Route::get('malfunctions/create', 'MalfunctionEntriesController@create');
    Route::get('malfunctions/{status?}', 'MalfunctionEntriesController@index');
    Route::post('malfunctions', 'MalfunctionEntriesController@store');
    Route::get('malfunctions/{malfunctionId}/show', 'MalfunctionEntriesController@show');


    Route::get('vote/{pollableType}/{pollableId}/{pollAnswer}', 'PollsController@submitVote');

    Route::get('toggle-like/{relatedType}/{relatedId}', 'LikesController@toggleLike');
    Route::get('toggle-flag/{relatedType}/{relatedId}', 'FlagsController@toggleFlag');
    Route::get('toggle-follow/{relatedType}/{relatedId}', 'FollowsController@toggleFollow');
    Route::post('comments/{relatedType}/{relatedId}', 'CommentsController@store');

    Route::get('test-profile-data', function() {
        $user = auth()->user()->load('votingLocation');

        return $user;
    });

});

Route::group(['middleware' => 'moderator'], function () {
    Route::get('moderators/referendums/pending', 'ReferendumsController@pendingList');
    Route::get('moderators/referendums/{referendum}', 'ReferendumsController@pendingShow');
    Route::get('moderators/referendums/{referendum}/approve', 'ReferendumsController@approve');


    Route::get('moderators/malfunctions/{malfunctionEntry}/edit', 'MalfunctionEntriesController@edit');
    Route::post('moderators/malfunctions/{malfunctionEntry}/update', 'MalfunctionEntriesController@update');


});
