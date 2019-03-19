<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use \Session;

class ContrasennaRootController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ContrasennaRootController
    |--------------------------------------------------------------------------
    | This driver is responsible for handling the change of the password manage by the administrator.
    |
    */
    
    /**
     * Allow to chage the password of the system administrator.
     * @param Request $request are the new password incoming to be updated.
     */
    public function update(Request $request)
	{
        $user = User::where('id', Auth::user()->id)->first(); //User in session.
        $user->password = bcrypt($request->input('password'));
        $password = $request->input('password');  //New password incoming.
        $passwordConfirmation = $request->input("password_confirmation"); //Password confirmation incoming.
        if (strlen($password)<6) { //Error message in case of wrong format (size of the password).
            return back()->withErrors(['password' => 'La contraseña debe tener más de 6 caracteres']);
        }
        if ($password != $passwordConfirmation) { //Error message in case the passwords do not match.
            # code...
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
        }
        $user->save();
        
        Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Contraseña actualizada satisfactoriamente');//shows confirm message that the password was updated

		return redirect('cuentas');
	}
}
