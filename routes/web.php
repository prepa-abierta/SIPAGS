<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/curp', 'CurpController@getCurp');

Route::post('/preregistrar', 'AspiranteController@store');

Route::get('/home', 'HomeController@index')->name('home');

require __DIR__ . '/aspirantes/aspirantes.php';
require __DIR__ . '/codigop/codigop.php';
require __DIR__ . '/entidades/entidades.php';
require __DIR__ . '/paises/paises.php';
require __DIR__ . '/poblaciones/poblaciones.php';
require __DIR__ . '/archivos/archivos.php';
require __DIR__ . '/discapacidades/discapacidades.php';



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
