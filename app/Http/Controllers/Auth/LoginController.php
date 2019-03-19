<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen.
    |
    */

    /**
     * Method in charge of verifying the credential and the type of users that 
     * enter in the system.
     */
    public function login(){
        $credentials = $this->validate(request(),[
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($credentials)){ //In case the credentials are corect.
            if(Auth::user()->active_flag == 1) { //In case the patient's account is active.
            $tipo = Auth::user()->tipo;
            if($tipo == 4) {
                return redirect('paciente');
            } else {
                if($tipo == 3){
                return redirect('asistente');
                } else{
                    if($tipo == 2){
                return redirect()->route('Especialista.index');
                    } else{
                        if($tipo == 1){
                return redirect('admin');
                    }
                }
              }
            }

          } else { //In case the patient's account was desactive.
            return back()->withErrors(['password' => 'Su cuenta está desactivada. Contacte con el 
            Servicio de Salud para verificar el procedimiento de activación']);        
        }
        } else {  //In case the credentials are incorect.
        return back()->withErrors(['email' => trans('Correo electrónico o contraseña incorrectos.')]);        
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
     */ 

    public function logout () {
        auth()->logout();
        Auth::logout();

        return redirect('/');
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

