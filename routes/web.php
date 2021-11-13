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
use App\image;
use App\Http\Controllers\PushNotificationController;
use Illuminate\Support\Facades\Storage;

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

Route::name('print')->get('/imprimir', 'PdfController@imprimir');

Route::get('/sitemap', function () {
    return view('sitemap');


});
Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reload-captcha', [RegisterController::class, 'reloadCaptcha']);
 // Rutas de usuario
Route::get('/user/all/{search?}', 'UserController@index')->name('user.index');
Route::get('/user/config', 'UserController@config')->name('config');
Route::post('/user/edit', 'UserController@update')->name('update_user');
Route::get('/my_profile/{id}', 'UserController@profile')->name('myprofile');
Route::get('/user/avatar/{filename?}', 'UserController@getImage')->name('user.image');

//Rutas de imagenes
Route::get('/image/create', 'ImageController@create')->name('image.create');
Route::post('/image/store', 'ImageController@store')->name('image.store');

Route::get('/image/get/{filename?}', 'ImageController@getImage')->name('image.get');
Route::get('/image/show/{id}', 'ImageController@show')->name('image.show');
Route::get('/image/delete/{id}', 'ImageController@destroy')->name('image.delete');
Route::get('/image/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'ImageController@update')->name('image.update');

//Rutas de comentarios
Route::post('/comment/store', 'CommentController@store')->name('comment.store');
Route::get('/comment/delete/{id}', 'CommentController@destroy')->name('comment.destroy');

//Rutas de Likes
Route::get('/like/{id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{id}', 'LikeController@dislike')->name('dislike');
Route::get('/mis_likes', 'LikeController@mis_likes')->name('mislikes');


