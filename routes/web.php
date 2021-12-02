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

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvisoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\LikeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Http\Controllers\PushNotificationController;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
App::setLocale("es");
//Envio de notificaciones
Route::get('/', function () {
    $SERVER_API_KEY = 'AAAA9zOkRgY:APA91bGFLkuWyjgKjBhJ_p7a5imZJ4l2jKU1jKK6OirkH7Qz9ZwdfyXOEpK9vJAYmGz685tYU3UGSYluJFwpHU1bxeWjX30PfinSwMYmJRe9LdU-Zq4U0867Ygy-wFrC7XVDiRkeOEzm';

    $token_1 = 'f0e6hDv1TVe_dujSPAfxrC:APA91bExhbnStsYnYSMXSLbKdy9mBkjlb7hoMCOGPW5TrEG-6AxzsG9eY5wCgj-0QQ7dKCDPzvgTdfhbVlX_q9xStPuRHvHKU6ZS7Ubaq6bq4ieobkMBYUw4RAapm8nh4fWGqD1zTj5-';
    $data = [

        "registration_ids" => [
            $token_1
        ],

        "notification" => [

            "title" => 'Welcome',

            "body" => 'Description',

            "sound"=> "default" // required for sound on ios

        ],

    ];

    $dataString = json_encode($data);

    $headers = [

        'Authorization: key=' . $SERVER_API_KEY,

        'Content-Type: application/json',

    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    return view('welcome')->with($response);
});

Route::name('print')->get('/imprimir', [PdfController::class, 'imprimir']);

Route::get('/sitemap', function () {
    return view('sitemap');


});
//Ruta Offline
Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});
Route::get('/reload-captcha', [RegisterController::class, 'reloadCaptcha']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('storage-link',function(){
    Artisan::call('storage:link');
});


// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {



// Rutas de usuario
    Route::get('/user/all/{search?}', 'UserController@index')->name('user.index');
    Route::get('/user/config', 'UserController@config')->name('user.config');
    Route::post('/user/edit', 'UserController@update')->name('update_user');
    Route::get('/my_profile/{id}', 'UserController@profile')->name('myprofile');
    //Route::get('/user/avatar/{filename?}', 'UserController@getImage')->name('user.image');



    //Rutas de comentarios
    Route::post('/comentario/store', 'ComentarioController@store')->name('comment.store');
    Route::get('/comentario/delete/{id}', 'ComentarioController@destroy')->name('comment.destroy');



    // User

    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::get('/avisos', 'AvisoController@index')->name('avisos.index');
    //Route::get('/posts/{id}', 'AvisoController@getImage')->name('image.get');

    // Post
    Route::get('/posts/{id}', 'PostController@showpost')->name('posts.getweb'); // get single post

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // all posts
    Route::post('/posts/create', [PostController::class, 'store']); // create post

    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show'); // show post
     // get single post
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update'); // update post
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); // delete post

    // Comment
   // Route::get('/posts/{id}/comments', [CommentController::class, 'index']); // all comments of a post
  //  Route::post('/posts/{id}/comments', [CommentController::class, 'store']); // create comment on a post
   // Route::put('/comments/{id}', [CommentController::class, 'update']); // update a comment
   // Route::delete('/comments/{id}', [CommentController::class, 'destroy']); // delete a comment

    // Like
    Route::post('/posts/{id}/likes', [LikeController::class, 'likeOrUnlike']);
});// like or dislike back a post




Auth::routes();
//Rutas de imagenes
Route::get('/image/create', 'ImageController@create')->name('image.create');
Route::post('/image/store', 'ImageController@store')->name('image.store');
Route::get('/image/show/{id}', 'ImageController@show')->name('image.show');
Route::get('/image/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::get('/image/delete/{id}', 'ImageController@destroy')->name('image.delete');
Route::post('/image/update', 'ImageController@update')->name('image.update');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/reload-captcha', [RegisterController::class, 'reloadCaptcha']);
