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
Route::middleware('auth:api')->get('avisos', 'AvisoController@getAllimages');
Route::middleware('auth:api')->get('avisos/{id_image}', 'AvisoController@getimage');
Route::middleware('auth:api')->post('avisos', 'AvisoController@createimage');
Route::middleware('auth:api')->put('avisos/{id_image}', 'AvisoController@updateimage');
Route::middleware('auth:api')->delete('avisos/{id_image}','AvisoController@deleteimage');
//Rutas de API de usuarios
Route::middleware('auth:api')->post('usuarios', 'UsuarioController@createuser');
Route::middleware('auth:api')->post('login', 'UsuarioController@login');
