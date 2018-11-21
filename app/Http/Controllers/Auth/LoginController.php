<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App;

class LoginController extends Controller
{


    public function revisarInicio() {
        if(Auth::check()) {
            $this->logout();
          //  $this->auth->logout();
        }
        return view('auth/login');
    }

    public function login(){

        $credentials = $this->validate(request(),[
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);

     //  $credentials = $this->validate()->check($_POST,array(
       // 'email' => 'email|required|string',
       // 'password' => 'required|string'//,
    //));

        if(Auth::attempt($credentials)){

              if(Auth::user()->active_flag == 1) {
            $tipo = Auth::user()->tipo;
            if($tipo == 4) {
                return redirect('paciente');
            } else{
                if($tipo == 3){
                return redirect('asistente');
                } else{
                    if($tipo == 2){
                return redirect('especialistas');
                    } else{
                        if($tipo == 1){
                return redirect('admin');
                    }
                }
                }
               // return $dato;
            }

               // return redirect('especialistas');
          //  }
          } else {
            return back()->withErrors(['password' => 'Su cuenta está desactivada. Contacte con el 
            Servicio de Salud para verificar el procedimiento de activación']);        
        }
        } else {
        return back()->withErrors(['email' => trans('auth.failed')]);        
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
        Auth::logout();
        //$request->session()->flush();
        //Session::flush();
       //$user = Auth::user();

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

