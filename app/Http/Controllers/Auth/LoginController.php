<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App;

class LoginController extends Controller
{
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
//            if(auth()->user()->tipo() => 'paciente'){
          //  if(Auth::attempt(['tipo'=> 'paciente'])){
          // return view('Paciente.index');
          //$user = Auth::user();
        //  $tipo = Auth::tipo();
         // return $tipo;
            //    return redirect('especialistas');
               // return redirect('paciente');
          //  } else{
            $dato = Auth::user()->tipo;
            if($dato == 'paciente') {
                return redirect('masterPaciente');
        //        return $dato;
            } else{
                if($dato == 'asistente'){
                return redirect('masterAdmin');
                } else{
                    if($dato == 'especialista'){
                return redirect('masterEspecialista');
                    } else{
                return redirect('masterRoot');
                    }
                }
               // return $dato;
            }

               // return redirect('especialistas');
          //  }
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
       // App::after(function ($request, $response) {
         //   $response->headers->set("Cache-Control","no-cache,no-store, must-revalidate");
           // $response->headers->set("Pragma", "no-cache"); //HTTP 1.0
            //$response->headers->set("Expires"," Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        //});
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

