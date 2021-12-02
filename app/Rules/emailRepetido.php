<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class emailRepetido implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $valor = true;
        $id_user = auth()->user()->id_user;

        $user = DB::table('users')
            ->select('email')
            ->whereNotIn('id_user', array($id_user))
            ->where('email', '=', $value)
            ->get();

        if(count($user) == 0){
            //echo 'No hay usuario registrados con ese nick';
            //die();
            return $valor;
        }else{
            $valor = false;
            //echo 'Si hay usuario registrados con ese nick';
            //die();
            return $valor;

        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Este correo ya esta registrado';
    }
}
