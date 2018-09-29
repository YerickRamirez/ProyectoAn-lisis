<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    public function login(){
        $credentials = $this->validate(request(),[
            'email' => 'email|required|string',
            'password' => 'required|string',
            'name' => 'required|string',
            'lastName' => 'required|string'
        ]);

        if(Auth::attempt($credentials)){
            return 'The session was began';
        }  
        return back()->withErrors(['email' => trans('auth.failed')]);        
        //return back()->withErrors(['email' => 'This email does not exist']);
    }
}
