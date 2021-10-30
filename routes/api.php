<?php

use App\Http\Controllers\AvisoController;
use App\Http\Controllers\UsuarioController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
   // return $request->user()->id();
//});

//Rutas de la API de avisos
    Route::get('/avisos', [AvisoController::class, 'index']); // all posts
    Route::post('/avisos', [AvisoController::class, 'store']); // create post
    Route::get('/avisos/{id_image}', [AvisoController::class, 'show']); // get single post
    Route::put('/avisos/{id_image}', [AvisoController::class, 'update']); // update post
    Route::delete('/avisos/{id_image}', [AvisoController::class, 'destroy']); // delete post


// User
Route::post('/registro', [UsuarioController::class, 'register']);
Route::post('/acceso', [UsuarioController::class, 'login']);

Route::get('/user', [UsuarioController::class, 'user']);
Route::put('/user', [UsuarioController::class, 'update']);
Route::post('/logout', [UsuarioController::class, 'logout']);//Rutas de API de usuarios



//Route::post('usuarios', 'UsuarioController@createuser');
//Route::post('login', 'UsuarioController@login');
