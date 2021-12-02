<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
            'images' => Post::orderBy('created_at', 'desc')->with('user:id,name,image')->withCount('comments', 'likes')
                ->with('likes', function($like){
                    return $like->where('user_id', auth()->user()->id)
                        ->select('id', 'user_id', 'post_id')->get();
                }),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'body' => 'required|string',

        ]);

        $image = $this->saveImageWeb($request->image, 'posts');

        $post = Post::create([
            'body' => $attrs['body'],
            'user_id' => auth()->user()->id,
            'image' => $image,
            'grupo' => 'Todos'
        ]);

        return redirect()->route('home')->with('message', 'El aviso ha sido publicado correctamente',$post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Post::find($id);

        return view('image.detail')->with('image', $image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $user =\Auth::user();
        $image = Post::find($id);

        if($user && $image && $image->user_id == $user->id){

            return view ('image.edit')->with('image', $image);
        }else{
            return redirect()->route('home')->with('message', 'No tienes permisos para editar este aviso');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([

            'body' => ['required', 'string', 'max:255']


        ]);

        $id = $request->input('post_id');
        $body = $request->input('body');

       // $image = null;


        //Conseguir el objeto imagen de la DB y setear la nueva info
        $image = Post::find($id);
        $image->body = $body;



        //Subir imagen


        $image->update();

        return redirect()->route('home')->with('message', 'Aviso actualizado con exito');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = \Auth::user();
        $image = Post::find($id);
        $comments = Comment::where('post_id', '=', $id)->get();
        $likes = Like::where('post_id', '=', $id)->get();

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

            Storage::disk('posts')->delete($image->image);

            //Eliminar registro de imagen

            $image->delete();

            $message = array('message' => 'El aviso se ha borrado correctamente');

        }else{
            $message = array('message' => 'El aviso NO se ha borrado correctamente');
        }

        return redirect()->route('home')->with($message);
    }
}
