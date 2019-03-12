<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Mail\Confirmacion;
use App\Mail\cuentaCreada;
use Mail;
use App\Telefono;
use Illuminate\Auth\Events\Registered;
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
   /* protected function create(array $data)
    {
       

        $pacienteExistente = Paciente::where('cedula_paciente', $data['cedula'])->get();
        $user = null;
        
        if(!$pacienteExistente->isEmpty()) {
             return back()->withErrors(['email' => trans('Correo electrónico o contraseña incorrectos.')]);
        } else {
        
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
    }*/

    public function register(Request $request) {
        $contrasena = $request->input('password');
        $conrasenaConfirmada = $request->input("password_confirmation");
        if ($contrasena != $conrasenaConfirmada) {
            # code...
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
        }
        $this->validator($request->all())->validate();

        $active_flag = Cuentas_activa::orderBy('id')->first()->cuentas_activas;

        $paciente = Paciente::where('cedula_paciente', $request->cedula)->get();
        //return $paciente;
        if(!$paciente->isEmpty()) { // Existe un paciente con esa cédula
            return back()->withErrors(['cedula' => trans('Ya existe un paciente con la cédula indicada')]);
            return redirect('/register'); // ya hay un return arriba. :v
        }

        $telefono = $request->input("telefono");
        if($telefono == "" || strlen($telefono) < 4) {
			return back()->withErrors(['telefono' => trans('Digite un teléfono válido')]);
            return redirect('/register'); //ya hay un return. :v
        }
    
        $user = User::create([
            'name' =>  $request->name,
            'lastName' =>  $request->lastName. ' ' .   $request->lastName2,
            'email' =>  $request->email,
            'password' => bcrypt($request->password),
            'tipo' => 4,//tipo 4 = Paciente
            'active_flag' => $active_flag,
        ]);

        $paciente = Paciente::create([
            'id_user' => $user->id,
            'cedula_paciente' => $request->cedula,
            'nombre' => $request->name,
            'primer_apellido_paciente' => $request->lastName,
            'segundo_apellido_paciente' => $request->lastName2,
            'correo' => $request->email,
            'active_flag' => $active_flag,
        ]);

                $telefonoModel = new Telefono();
				$telefonoModel->paciente_id = $paciente->id;
				$telefonoModel->active_flag = 1;
				$telefonoModel->telefono = $telefono;
                $telefonoModel->save();
                
        event(new Registered($user));
    
        $this->guard()->login($user);
        Mail::to($request->input("email"))->send(new cuentaCreada($request->input("name"), $request->input("email")));
        //return $request->input("email");
        
        
    
        return redirect($this->redirectPath());
    }
}
