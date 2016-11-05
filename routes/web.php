<?php

Route::get('/', function() {
    if(auth()->check())
        return redirect('home');

    return redirect('login');
});


/*Route::get('/municipality', function() {
    if(auth()->check())
        return 'MunicipalityController@access';

    return redirect('login');
});*/


//Route::get('/municipality/{municipality}', 'MunicipalityController@show');

/*Route::get('/municipality/{municipality}', function() {
    if(auth()->check())
        return 'MunicipalityController@show';

    return redirect('login');
});*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home','MunicipalityController@access');
}) ;





