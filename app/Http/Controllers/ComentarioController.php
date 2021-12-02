<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response([
                'message' => 'Post not found.'
            ], 403);
        }

        return response([
            'comments' => $post->comments()->with('user:id,name,image')->get()
        ], 200);
    }


    public function store(Request $request)
    {
        if ($request) {
            $comment = $request->input('description');
            $post_id = $request->input('post_id');
            $user_id = $request->input('user_id');

            $validatedData = $request->validate([
                'description' => ['required', 'string','max:255'],
            ]);

            $comentario = new Comment();
            $comentario->user_id = $user_id;
            $comentario->post_id = $post_id;
            $comentario->comment= $comment;
            $comentario->save();

            return back()->with('message', 'Comentario guardado correctamente');
        }
        else {
            return back()->with('message', 'Error al guardar comentario');
        }






    }




    public function destroy($id)
    {
        //Conseguir usuario
        $user = Auth::user();

        //Conseguir comentario a Eliminar
        $comment = Comment::find($id);

        if($user  && ($comment->user_id == $user->id ||  $comment->image->user_id == $user->id)){

            $comment->delete();

            return back()->with('message', 'Comentario eliminado correctamente');
        }else{
            return redirect('home');
        }
    }
}
