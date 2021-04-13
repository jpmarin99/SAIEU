<?php

namespace App\Http\Controllers;

use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        //
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
            $grupo = $request->grupo;
            $id_user = $request->id_user;

            $image = new Image();
            $image->image_path = null;
            $image->description = $description;
            $image->grupo= $grupo;
            $image->fk_id_user = $id_user;

            //Subir imagen
            if($image_path){
                $image_path_name = time().$image_path->getClientOriginalName();
                Storage::disk('images')->put($image_path_name,File::get($image_path));
                $image->image_path = $image_path_name;
            }

            $image->save();
        //Envío de notificaciones push a una aplicación Android
        $SERVER_API_KEY = 'AAAAuR-UQis:APA91bFEW2MtVJvdck_cQ0Z_piqq6mv1JfPnYRo29nXl5Za4soqDAEikqLweKi_TJuquGqgg6FxNXwDRjbe5tlTIvejWANdZpEQeAj4xAcvvuEWmlDj0TP1an8yl5qUBeT6jEWQPfTwN';

        $token_1 = 'cIXSv0SuTpu6GbF0AbFZST:APA91bEzbWQdDy5rLcRzTexc1T1vGWByA8tvNsWA0WQL8cE7BIYyz0b-kWm8QtyyjdI2GDLle-H_g1UViHWcn1x17d_DEUPsdGCyH77Vm0qRV8oF8TCtMasumqSjsq27ENkgJGG0Pizw';
        $data = [

            "registration_ids" => [
                $token_1
            ],

            "notification" => [

                "title" => 'Nuevo aviso',

                "body" => 'Se ha publicado un nuevo aviso',

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
        //dd($response);
           return redirect()->route('home')->with('message', 'El aviso ha sido publicado correctamente');




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

        if($user && $image &&$image->user->id_user == $user->id_user ){

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
