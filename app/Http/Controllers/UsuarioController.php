<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    use AuthenticatesUsers;
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
    public function createuser(Request $request)
    {

       $user = new User();
       $user->role = $request->role;
       $user->name = $request->name;
       $user->surname= $request->surname;
       $user->nick = $request->nick;
       $user->email = $request->email;
       $user->password =  Hash::make ('password');
       $user->api_token = Str::random(80);
       $user->save();

       return response()->json([
           "message" => "Usuario creado"
       ], 201);

    }
}

