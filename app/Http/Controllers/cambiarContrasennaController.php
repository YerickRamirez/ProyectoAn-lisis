<?php

namespace App\Http\Controllers;
use App\Paciente;
use App\User;
use Auth;

use Illuminate\Http\Request;


class cambiarContrasennaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | cambiarContrasennaController
    |--------------------------------------------------------------------------
    | This controller is responsible for handling the password change.
    |
	*/
    
    /**
     * This method is responsible for handling the password change of the users.
     */
    public function update(Request $request)
	{
        $user = User::where('id', Auth::user()->id)->first();
        $user->password = bcrypt($request->input('password'));
        $password = $request->input('password'); //New password incoming.
        $passwordConfirm = $request->input("password_confirmation");//Password confirmation incoming.
        if (strlen($password)<6) { //Error message in case of wrong format (size of the password).
            return back()->withErrors(['password' => 'La contraseña debe tener más de 6 caracteres']);
        }
        if ($password != $passwordConfirm) { //Error message in case the passwords do not match.
            # code...
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
        }
        $user->save();
        
		return redirect()->route('citas.index');
    }

}
