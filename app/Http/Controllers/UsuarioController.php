<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function createuser(Request $request)
    {
        $user = new User();
        $user->role = $request->role;
        $user->name = $request->name;
        $user->surname= $request->surname;
        $user->nick = $request->nick;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return response()->json([
            "message" => "Usuario creado"
        ], 201);

    }
}

