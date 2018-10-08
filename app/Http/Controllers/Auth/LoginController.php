<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    public function login(){
        $credentials = $this->validate(request(),[
            'email' => 'email|required|string',
            'password' => 'required|string'//,
            //'name' => 'required|string',
            //'lastName' => 'required|string'
        ]);

        //return $credentials;
            
        if(Auth::attempt($credentials)){
            return 'The session was began';
        } // else {
            return 'Error en la autenticacion';
        //return back()->withErrors(['email' => trans('auth.failed')]);        
        //return back()->withErrors(['email' => 'This email does not exist']);
    //}
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Auth::logout();
}
