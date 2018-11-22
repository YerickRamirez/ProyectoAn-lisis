<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class ContrasennaRootController extends Controller
{
    public function update(Request $request)
	{
        $user = User::where('id', Auth::user()->id)->first();
        $user->password = bcrypt($request->input('password'));
        $rrr = $request->input('password');
        $conf = $request->input("password_confirmation");
        if (strlen($rrr)<6) {
            return back()->withErrors(['password' => 'Debe tener más de 6 caracteres']);
        }
        if ($rrr != $conf) {
            # code...
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
        }
        $user->save();
        
		return redirect('admin');
	}
}
