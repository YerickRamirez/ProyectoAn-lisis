<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\Confirmacion;
use Mail;
use App\Paciente;
use App\Cuentas_activa;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'logoutUsuarioRecienRegistrado';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function mail($email, $name)
    {
       Mail::to($email)->send(new SendMailable($name));
       Auth::logout();
      // return view('');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       Mail::to($data['email'])->send(new Confirmacion($data['name']));
        $tipo = 'paciente';


        $active_flag = Cuentas_activa::orderBy('id')->first()->cuentas_activas;

        $user = User::create([
            'name' => $data['name'],
            'lastName' => $data['lastName']. ' ' .  $data['lastName2'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'tipo' => 4,//tipo 4 = Paciente
            'active_flag' => $active_flag,
        ]);

        Paciente::create([
            'id_user' => $user->id,
            'cedula_paciente' => $data['cedula'],
            'nombre' => $data['name'],
            'primer_apellido_paciente' => $data['lastName'],
            'segundo_apellido_paciente' => $data['lastName2'],
            'correo' => $data['email'],
            'active_flag' => $active_flag,
        ]);
        
        
        return $user;
    }
}
