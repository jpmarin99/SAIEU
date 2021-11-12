<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    use AuthenticatesUsers;

    public function register(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'role' => ['required','string','max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            //'api_token'=>['required','string','max:80'],

        ]);

        $user = User::create([
            'role' => $attrs['role'],
            'name' => $attrs['name'],
            'surname'=> $attrs['surname'],
            'nick'=> $attrs['nick'],
            'email' => $attrs['email'],
            'password' => bcrypt($attrs['password']),
         // 'api_token' =>  $attrs->api_token = Str::random(80),
          //'api_token' => Str::random(80),
        ]);

        //return user
        return response([
            'message' => 'Usuario creado correctamente',
            'user' => $user,        // 'token' => $user->api_token,
            //'api_token' => $user->Str::random(80)
        ], 200);

    }


       //$user = new User();
       //$user->role = $request->role;
      // $user->name = $request->name;
      // $user->surname= $request->surname;
       //$user->nick = $request->nick;
       //$user->email = $request->email;
      // $user->password =  Hash::make ('password');
      // $user->api_token = Str::random(80);
      // $user->save();


    public function user()
    {
        return response([
            'user' => auth()->user()
        ], 200);
    }

    public function login(Request $request)
    {


        //validate fields
        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // attempt login
        if(!Auth::attempt($attrs))
        {
            return response([
                'message' => 'Datos introducidos incorrectos.'
            ], 403);
        }

        //return user & token in response
        return response([
            'user' => auth()->user(),
         // 'api_token' => auth()->user()->Str::random(80)
        ], 200);

    }
    // logout user
    public function logout()
    {
      //auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success.'
        ], 200);
    }
    // update user
    public function update(Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required|string'
        ]);

        $image = $this->saveImage($request->image, 'users');

        auth()->user()->update([
            'name' => $attrs['name'],
            'image' => $image
        ]);

        return response([
            'message' => 'User updated.',
            'user' => auth()->user()
        ], 200);
    }




}

