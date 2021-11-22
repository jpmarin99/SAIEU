<?php

namespace App\Http\Controllers;

use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'images' => Image::orderBy('created_at', 'desc')->with('user:id,name,image')->withCount('comments', 'likes')
                ->with('likes', function($like){
                    return $like->where('user_id', auth()->user()->id)
                        ->select('id', 'user_id', 'post_id')->get();
                }),

        ]);





    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'image_path' => ['required','image' ,'mimes:jpg,jpeg,png,gif'],
            'description' => ['required', 'string','max:255'],
            'grupo' => 'required',
        ]);

        $image_path = $request->image_path;
        $description = $request->description;
        $groups = $request->group;
        $id_user = $request->id_user;

        $image = new Image();
        $image->image_path = null;
        $image->description = $description;
        $image->grupo= $groups;
        $image->fk_id_user = $id_user;

        //Subir imagen
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name,File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();
        //Envío de notificaciones push a una aplicación Android
        $SERVER_API_KEY = 'AAAA9zOkRgY:APA91bGFLkuWyjgKjBhJ_p7a5imZJ4l2jKU1jKK6OirkH7Qz9ZwdfyXOEpK9vJAYmGz685tYU3UGSYluJFwpHU1bxeWjX30PfinSwMYmJRe9LdU-Zq4U0867Ygy-wFrC7XVDiRkeOEzm';

        $token_1 = 'dNx_qOYPSw6Ns10HvUka_6:APA91bENxTSHgKUMpbSEDEMPWCSnqoUBWVEM_7aerFFinumptLJ01ZAZLXj-M1SHqNIVuHhIJYzPZUttnPPyO-p2zBo2xl6za4fWh51W3ImKWBvImlpqWxHsKFoUcy8oReLOVh8zSgvU';
        $token_2 = 'f0e6hDv1TVe_dujSPAfxrC:APA91bExhbnStsYnYSMXSLbKdy9mBkjlb7hoMCOGPW5TrEG-6AxzsG9eY5wCgj-0QQ7dKCDPzvgTdfhbVlX_q9xStPuRHvHKU6ZS7Ubaq6bq4ieobkMBYUw4RAapm8nh4fWGqD1zTj5-';
        $data = [

            "registration_ids" => [
                $token_1,
                $token_2
            ],

            "notification" => [

                "title" => 'Nuevo aviso',

                "body" => $description,

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



        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        //dd($response);

        //return response([
        //  'message' => 'Post created.',
        //    'image' => $image,
        // ], 200);

        return redirect()->route('home')->with('message', 'El aviso ha sido publicado correctamente',$response);




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $image = Image::find($id);

        return view('image.detail')->with('image', $image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);

        if($user && $image && $image->fk_id_user == $user->id_user){

            return view ('image.edit')->with('image', $image);
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)

    {
        $validatedData = $request->validate([
            'image_path' => ['image' ,'mimes:jpg,jpeg,png,gif'],
            'description' => ['required', 'string','max:255'],
            'grupo' => 'required',

        ]);

        $id_imagen = $request->input('id_imagen');
        $description = $request->input('description');
        $grupo = $request->input('grupo');
        $image_path = null;

        //Verificar si ha llegado una imagen
        if($request->image_path != null){

            $image_path = $request->image_path;
        }

        //Conseguir el objeto imagen de la DB y setear la nueva info
        $image = Image::find($id_imagen);
        $image->description = $description;
        $image->grupo= $grupo;


        //Subir imagen
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name,File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->update();

        return redirect()->route('home')->with('message', 'Aviso actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('fk_id_image', '=', $id)->get();
        $likes = Like::where('fk_id_image', '=', $id)->get();

        if($user && $image &&$image->user->id_user === $user->id_user ){

            //Eliminar comentarios
            if($comments && count($comments) > 0){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            //Eliminar likes

            if($likes && count($likes) > 0){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            //Eliminar fichero de imagen

            Storage::disk('images')->delete($image->image_path);

            //Eliminar registro de imagen

            $image->delete();

            $message = array('message' => 'El aviso se ha borrado correctamente');

        }else{
            $message = array('message' => 'El aviso NO se ha borrado correctamente');
        }

        return redirect()->route('home')->with($message);

    }

    public function getImage($fileName){
        $file  = Storage::disk('images')->get($fileName);

        return response($file, 200);
    }
}
