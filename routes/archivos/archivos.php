<?php
Route::group(['namespace' => 'Archivos'], function() {
        // views
      // Route::group(['prefix' => 'aspirantes'], function() {
      //     Route::view('/registro', 'aspirantes.registro');
      //     /*Route::view('/create', 'users.create')->middleware('permission:create-users');
      //     Route::view('/{user}/edit', 'users.edit')->middleware('permission:update-users');*/
      // });

      // api
      Route::group(['prefix' => 'api/archivos'], function() {
        Route::post('/visualizar', 'ArchivoController@visualizar');
        Route::post('/eliminar', 'ArchivoController@eliminar');

        // Route::post('/curp', 'AspiranteController@busqueda');
        // Route::post('/guardar', 'AspiranteController@guardar');
          /*Route::get('/getUserRoles/{user}', 'UserController@getUserRoles');
          Route::get('/count', 'UserController@count');
          Route::post('/filter', 'UserController@filter')->middleware('permission:read-users');

          Route::get('/{user}', 'UserController@show')->middleware('permission:read-users');
          Route::post('/store', 'UserController@store')->middleware('permission:create-users');
          Route::put('/update/{user}', 'UserController@update')->middleware('permission:update-users');
          Route::delete('/{user}', 'UserController@destroy')->middleware('permission:delete-users');*/
    });
});
