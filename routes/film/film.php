<?php

Route::group([
    'namespace' => 'Film',
    'middleware' => 'auth:api',
    'prefix' => 'films'
], function () {
    Route::get('/', 'FilmController@index');
    Route::post('/create', 'FilmController@store');
    Route::get('/{slug}', 'FilmController@show');
    // Route::post('signup', 'AuthController@signup');
    // Route::get('signup/activate/{token}', 'AuthController@signupActivate');
});
