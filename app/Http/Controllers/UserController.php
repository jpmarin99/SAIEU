<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search = null)
    {

        if ($search != null) {
            $all_users = User::where('name', 'like', '%' . $search . '%')

                ->orderBy('id', 'desc')
                ->paginate(5);
        } else {

            $all_users = User::orderBy('id', 'desc')
                ->paginate(5);
        }


        return view('user.all_users')->with('users', $all_users);
    }

    public function config()
    {
        //Proteger Vista
        //Entra en acción el middlware que esta arriba

        return view('user.config');
    }

//Perfil del usuario
    public function profile($id)
    {
        $user = User::find($id);

        return view('user.my_profile')->with('user', $user);
    }


    public function update(Request $request)
    {

        $attrs = $request->validate([
            'name' => 'required|string'
        ]);

        $image = $this->saveImageWeb($request->image, 'profiles');

        auth()->user()->update([
            'name' => $attrs['name'],
            'image' => $image
        ]);

        return redirect()->route('user.config')->with('message', 'Usuario actualizado correctamente',$image);
    }
}




