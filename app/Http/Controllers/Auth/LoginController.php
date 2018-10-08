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

        //return $credentials;
            
        if(Auth::attempt($credentials)){
            return 'The session was began';
        } // else {
            return 'Error en la autenticacion';
        //return back()->withErrors(['email' => trans('auth.failed')]);        
        //return back()->withErrors(['email' => 'This email does not exist']);
    //}
    }
}

/*<?php

namespace blog\Http\Controllers\Auth;

use blog\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
/*
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */ /* 
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
*/
