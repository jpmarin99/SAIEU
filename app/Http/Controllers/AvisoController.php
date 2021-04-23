<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function getAllimages() {
        $images = Image::get()->toJson(JSON_PRETTY_PRINT);
        return response($images, 200);
    }

    public function getimage($id_image) {
        if (Image::where('id_image', $id_image)->exists()) {
            $image = Image::where('id_image', $id_image)->get()->toJson(JSON_PRETTY_PRINT);
            return response($image, 200);
        } else {
            return response()->json([
                "message" => "Aviso no encontrado"
            ], 404);
        }
    }

    public function createimage(Request $request) {

        $image_path = $request->image_path;
        $description = $request->description;
        $grupo = $request->grupo;
        $id_user = $request->id_user;

        $image = new Image();
        $image->image_path = null;
        $image->description = $description;
        $image->grupo= $grupo;
        $image->fk_id_user = $id_user;
        //subir imagen
        if($image_path){

            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('gcs')->put($image_path_name,File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();
        return response()->json([
            "message" => "Aviso no encontrado"
        ], 404);


    }
    public function updateimage(Request $request, $id_image) {
        if (Image::where('id_image', $id_image)->exists()) {
            $image = Image::find($id_image);

            $image->description = is_null($request->description) ? $image->description : $image->description;
            $image->grupo = is_null($request->grupo) ? $image->grupo : $image->grupo;
            $image->update();

            return response()->json([
                "message" => "Aviso actualizado correctamente"
            ], 200);
        } else {
            return response()->json([
                "message" => "Aviso no encontrado"
            ], 404);
        }
    }
    public function deleteimage ($id_image) {
        if(Image::where('id_image', $id_image)->exists()) {
            $image = Image::find($id_image);
            $image->delete();

            return response()->json([
                "message" => "Aviso eliminado"
            ], 202);
        } else {
            return response()->json([
                "message" => "Aviso no encontrado "
            ], 404);
        }
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
            Storage::disk('gcs')->put($image_path_name,File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $image = Image::find($id);

        return response()->json($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
