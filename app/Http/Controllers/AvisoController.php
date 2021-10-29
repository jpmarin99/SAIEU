<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return response([
            'images' => Image::orderBy('created_at', 'desc')->withCount('comments', 'likes')

                ->get()
        ], 200);





    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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
        $fk_id_user = $request->fk_id_user;

        $image = new Image();
        $image->image_path = null;
        $image->description = $description;
        $image->grupo= $grupo;
        $image->fk_id_user = $fk_id_user;

        //Subir imagen
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name,File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();
        return response([
            'message' => 'Aviso creado.',
            'images' => $image,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id_image)
    {
        return response([
            'images' => Image::where('id_image', $id_image)->withCount('comments', 'likes')->get()
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id_image)
    {
        $attrs = $request->validate([
            'image_path' => ['image', 'mimes:jpg,jpeg,png,gif'],
            'description' => ['string', 'max:255'],
            'grupo' => 'required',
        ]);

        if (Image::where('id_image', $id_image)->exists()) {
            $image = Image::find($id_image);

            $id_imagen = $request->input('id_imagen');
            $description = $request->input('description');
            $grupo = $request->input('grupo');
            $image_path = null;

            //Verificar si ha llegado una imagen
            if($request->image_path != null){

                $image_path = $request->image_path;
            }

            if($image_path){
                $image_path_name = time().$image_path->getClientOriginalName();
                Storage::disk('images')->put($image_path_name,File::get($image_path));
                $image->image_path = $image_path_name;
            }

            $image->update([
               // 'image_path' => $attrs['image_path'],
                'description' => $attrs['description'],
                'grupo' => $attrs['grupo']
            ]);

            return response([
                'message' => 'Aviso actualizado.',
                'images' => $image,
            ], 200);

        }
        else {
            return response([
                'message' => 'Aviso no encontrado.',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);

        if(!$image)
        {
            return response([
                'message' => 'Aviso no encontrado.'
            ], 403);
        }



        $image->comments()->delete();
        $image->likes()->delete();
        $image->delete();

        return response([
            'message' => 'Aviso eliminado.'
        ], 200);
    }

}
