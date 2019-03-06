<?php
    Route::group(['namespace' => 'Aspirantes'], function () {
        // views
        Route::group(['prefix' => 'aspirantes'], function () {
            Route::view('/registro', 'aspirantes.registro');
            /*Route::view('/create', 'users.create')->middleware('permission:create-users');
            Route::view('/{user}/edit', 'users.edit')->middleware('permission:update-users');*/
        });

        // api
        Route::group(['prefix' => 'api/aspirantes'], function () {
            Route::post('/preregistrar', 'AspiranteController@store');
            Route::post('/curp', 'AspiranteController@busqueda');
            Route::post('/guardar', 'AspiranteController@guardar');
            /*Route::get('/getUserRoles/{user}', 'UserController@getUserRoles');
            Route::get('/count', 'UserController@count');
            Route::post('/filter', 'UserController@filter')->middleware('permission:read-users');

            Route::get('/{user}', 'UserController@show')->middleware('permission:read-users');
            Route::post('/store', 'UserController@store')->middleware('permission:create-users');
            Route::put('/update/{user}', 'UserController@update')->middleware('permission:update-users');
            Route::delete('/{user}', 'UserController@destroy')->middleware('permission:delete-users');*/
        });
    });

Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Aspirantes'], function () {
        // views
        Route::group(['prefix' => 'aspirantes'], function () {
            Route::view('/', 'aspirantes.index')->middleware('permission:read-aspirantes');
            Route::view('/{aspirante}/edit', 'aspirantes.edit')->middleware('permission:read-aspirantes');
            /*Route::view('/create', 'users.create')->middleware('permission:create-users');
            Route::view('/{user}/edit', 'users.edit')->middleware('permission:update-users');*/
        });

        // api
        Route::group(['prefix' => 'api/aspirantes'], function () {
            Route::post('/filter', 'AspiranteController@filter')->middleware('permission:read-aspirantes');
            Route::post('/{aspirante}', 'AspiranteController@show')->middleware('permission:read-aspirantes');

            /*Route::get('/getUserRoles/{user}', 'UserController@getUserRoles');
            Route::get('/count', 'UserController@count');
            Route::post('/filter', 'UserController@filter')->middleware('permission:read-users');

            Route::post('/store', 'UserController@store')->middleware('permission:create-users');
            Route::put('/update/{user}', 'UserController@update')->middleware('permission:update-users');
            Route::delete('/{user}', 'UserController@destroy')->middleware('permission:delete-users');*/
        });
    });
});
