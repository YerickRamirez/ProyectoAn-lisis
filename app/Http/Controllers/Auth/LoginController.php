<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Auth;

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
            return view('masterAdmin');
        } else {
            //return 'Error en la autenticacion';
        return back()->withErrors(['email' => trans('auth.failed')]);        
        //return back()->withErrors(['email' => 'This email does not exist']);
    }
    }

    public function mail($email)
    {
      
       Mail::to($email)->send(new Confirmacion($name));
       
       return view('login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */ /*
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
} *//*

    //Auth::logout();


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
    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('login');
    }
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */ 
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

