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

use App\image;
use App\Http\Controllers\PushNotificationController;

Route::get('/', function () {
    $SERVER_API_KEY = 'AAAAuR-UQis:APA91bFEW2MtVJvdck_cQ0Z_piqq6mv1JfPnYRo29nXl5Za4soqDAEikqLweKi_TJuquGqgg6FxNXwDRjbe5tlTIvejWANdZpEQeAj4xAcvvuEWmlDj0TP1an8yl5qUBeT6jEWQPfTwN';

    $token_1 = 'cIXSv0SuTpu6GbF0AbFZST:APA91bEzbWQdDy5rLcRzTexc1T1vGWByA8tvNsWA0WQL8cE7BIYyz0b-kWm8QtyyjdI2GDLle-H_g1UViHWcn1x17d_DEUPsdGCyH77Vm0qRV8oF8TCtMasumqSjsq27ENkgJGG0Pizw';
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






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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


