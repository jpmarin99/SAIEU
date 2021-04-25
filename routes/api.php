<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Rutas de la API de avisos
Route::get('avisos', 'AvisoController@getAllimages');
Route::get('avisos/{id_image}', 'AvisoController@getimage');
Route::post('avisos', 'AvisoController@createimage');
Route::put('avisos/{id_image}', 'AvisoController@updateimage');
Route::delete('avisos/{id_image}','AvisoController@deleteimage');
//Rutas de API de usuarios
Route::post('usuarios', 'UsuarioController@createuser');
Route::post('login', 'UsuarioController@login');
