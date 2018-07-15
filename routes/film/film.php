<?php

Route::group([
    'namespace' => 'Film',
    'middleware' => 'api',
    'prefix' => 'films'
], function () {
    Route::get('/', 'FilmController@index');
    Route::get('/{slug}', 'FilmController@show');

    Route::group([
        'middleware' => 'auth:api',
    ], function() {
        Route::post('/mine', 'FilmController@filmsMine');
        Route::post('/create', 'FilmController@store');
        Route::post('/{film_id}/comments', 'CommentController@store');
    });
});
