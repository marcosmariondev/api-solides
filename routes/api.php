<?php

use Illuminate\Http\Request;


Route::group([
    'prefix' => 'auth',
    'namespace' => 'Api'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::post('add-points', 'UserController@addPoints');
        Route::get('list-points', 'UserController@listPoints');
    });
});