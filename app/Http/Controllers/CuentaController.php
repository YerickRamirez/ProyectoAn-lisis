<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use App\Paciente;
use App\Cuentas_activa;
use App\Especialista;
Use DB;
use Illuminate\Support\Facades\Validator;
use App\Telefono;
use App\Mail\Confirmacion;
use App\Mail\cuentaCreada;
use Mail;

use Illuminate\Support\Facades\Input;
use App\Cuenta;
use Illuminate\Http\Request;
use \Session;

class CuentaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var cuenta
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Especialista $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	
		$cuentas = User::where('tipo', '!=', 1)->orderBy('id', 'asc')->get();
		$active = User::where('active_flag', 1);
		$opcion = Cuentas_activa::where('id', 1)->first();
		if(Auth::user()->tipo == 1) {
			return view('cuentas.index', compact('cuentas', 'active', 'opcion'));
		} 
		
		if(Auth::user()->tipo == 3) {
				return view('cuentas_asistente.index', compact('cuentas', 'active'));
		} 
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::user()->tipo == 1) {
			return view('cuentas.create');
		} 
		
		if(Auth::user()->tipo == 3) {
				return view('cuentas_asistente.create');
		} 
	}

	protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$this->validator($request->all())->validate();
		
		$telefono = $request->input("telefono");
		$checked=Input::has('tipo');
		$checkValue=Input::get('tipo');

		$checked2=Input::has('flag');
		$checkValue2=Input::get('flag');
		//return $checkValue2 . '';

        $rrr = $request->input('password');
        $conf = $request->input("password_confirmation");
        if (strlen($rrr)<6) {
            return back()->withErrors(['password' => 'La contraseña debe tener más de 6 caracteres']);
        }
        if ($rrr != $conf) {
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
		}
		
		if($checkValue == 4) {//si es paciente, revisar si ya existe esa cédula
			$pacienteExistente = Paciente::where('cedula_paciente', $request->cedula)->get();
			if(!$pacienteExistente->isEmpty()) {
				return back()->withErrors(['cedula' => trans('Ya existe un paciente con la cédula indicada')]);
		    }
		}

		if($checkValue == 2) {//si es especialista revisar que si ya existe uno con esa cédula
			$especialistaExistente = Especialista::where('cedula_especialista', $request->cedula)->get();
			if(!$especialistaExistente->isEmpty()) {
				return back()->withErrors(['cedula' => trans('Ya existe un especialista con la cédula indicada')]);
		    }
		}

		//return $telefono; 
		if($telefono == "" || strlen($telefono) < 8) {
			if($checkValue == 4) {
				return back()->withErrors(['telefono' => trans('El paciente debe tener un teléfono válido')]);
			} else {
		
		$cuenta = new Cuenta();
		$user = new User();
		$especialista = new Especialista();
		$paciente = new Paciente();
		$opcion = Cuentas_activa::where('id', 1)->first();

		$user = User::create([
			'name' => $request->input("name"),
			'lastName' => $request->input("lastName"). ' ' .$request->input("lastName2"),
			'email' => $request->input("email"),
			'password' => bcrypt($request->input("password")),
			'tipo' => $checkValue,
			'active_flag' => $checkValue2,
		]);
		
		Mail::to($request->input("email"))->send(new cuentaCreada($request->input("name"), $request->input("email")));

		if($checkValue == 2) {
		$especialista->id_user = $user->id;
		$especialista->cedula_especialista = $request->input("cedula");
		$especialista->nombre = $request->input("name");
		$especialista->primer_apellido_especialista = $request->input("lastName");
		$especialista->segundo_apellido_especialista = $request->input("lastName2");
		$especialista->active_flag = $checkValue2;

		$especialista->save();
		}

		if(Auth::user()->tipo == 1) {
		return redirect()->route('cuentas.index');
		} 
		if(Auth::user()->tipo == 3) {
			return redirect()->route('cuentas_asistente.index');
		} 
		}// fin else, si no hay teléfono pero NO es paciente.
		} else {		
		$cuenta = new Cuenta();
		$user = new User();
		$especialista = new Especialista();
		$paciente = new Paciente();

		$user = User::create([
            'name' => $request->input("name"),
            'lastName' => $request->input("lastName"). ' ' .$request->input("lastName2"),
            'email' => $request->input("email"),
            'password' => bcrypt( $request->input("password")),
            'tipo' => $checkValue,
            'active_flag' => $checkValue2,
		]);
		
		Mail::to($request->input("email"))->send(new cuentaCreada($request->input("name"), $request->input("email")));

		if($checkValue == 2) {
		$especialista->id_user = $user->id;
		$especialista->cedula_especialista = $request->input("cedula");
		$especialista->nombre = $request->input("name");
		$especialista->primer_apellido_especialista = $user->email;
		$especialista->segundo_apellido_especialista = $request->input("lastName2");
		$especialista->active_flag = $checkValue2;

		$especialista->save();
		} else {
			if($checkValue == 4) {
				////////////////////////////////////////
				$paciente->id_user = $user->id;
				$paciente->cedula_paciente = $request->input("cedula");
				$paciente->nombre = $request->input("name");
				$paciente->primer_apellido_paciente = $request->input("lastName");
				$paciente->segundo_apellido_paciente = $request->input("lastName2");
				$paciente->correo = $user->email;
				$paciente->active_flag = $checkValue2;//change to reflect current status or changed status
				$paciente->save();

				$telefonoModel = new Telefono();
				$telefonoModel->paciente_id = $paciente->id;
				$telefonoModel->active_flag = 1;
				$telefonoModel->telefono = $telefono;
				$telefonoModel->save();

			}
		}

		if(Auth::user()->tipo == 1) {
			return redirect()->route('cuentas.index');
			} 
			if(Auth::user()->tipo == 3) {
				return redirect()->route('cuentas_asistente.index');
			} 
	}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Cuenta $cuenta)
	{

		if(Auth::user()->tipo == 1) {
			return view('cuentas.show', compact('cuenta'));
			} 
			if(Auth::user()->tipo == 3) {
				return view('cuentas_asistente.show', compact('cuenta'));
			} 
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(User $cuenta)
	{
		//$cuenta = $this->model->findOrFail($id);

		if(Auth::user()->tipo == 1) {
			return view('cuentas.edit', compact('cuenta'));
			} 
			if(Auth::user()->tipo == 3) {
				return view('cuentas_asistente.edit', compact('cuenta'));
			} 
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, User $cuenta)
	{
		
		//return $cuenta;
		/*$rrr = $request->input('password');
        $conf = $request->input("password-confirm");
        if (strlen($rrr)<6) {
            return back()->withErrors(['password' => 'Debe tener más de 6 caracteres']);
        }
        if ($rrr != $conf) {
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
		}*/
		//return $request->email;
		if($request->email != $cuenta->email){//quiere cambiar de correo
			$usuarioConCorreo = User::where('email', $request->email)->get();
			if(!$usuarioConCorreo->isEmpty()) {//en caso de que exista una cuenta con el nuevo correo
				return back()->withErrors(['email' => trans('Ya existe una cuenta con el correo dado')]);
		    } else {//cambia correo pero sí es nuevo


			$cuenta->name = $request->name;
			$cuenta->lastName = $request->lastName . ' ' . $request->lastName2;
			$cuenta->password = bcrypt($request->password);
			$cuenta->email = $request->email;

			if($cuenta->tipo == 4) {
				$paciente = Paciente::where('id_user', $cuenta->id)->first();
				$paciente->nombre = $request->name;
				$paciente->primer_apellido_paciente = $request->lastName;
				$paciente->segundo_apellido_paciente = $request->lastName2;
				$paciente->correo = $request->email;
				$paciente->save();
			} else if($cuenta->tipo == 2) {
				$especialista = Especialista::where('id_user',$cuenta->id)->first();
				$especialista->nombre = $request->name;
				$especialista->primer_apellido_especialista = $request->lastName;
				$especialista->segundo_apellido_especialista = $request->lastName2;
				$especialista->save();
			}
				$cuenta->save();
		}//fin correo nuevo
		} else {//mismo correo
			$cuenta->name = $request->name;
			$cuenta->lastName = $request->lastName . ' ' . $request->lastName2;
			$cuenta->password = bcrypt($request->password);
			//$cuenta->email = $request->email;

			if($cuenta->tipo == 4) {
				$paciente = Paciente::where('id_user', $cuenta->id)->first();
				$paciente->nombre = $request->name;
				$paciente->primer_apellido_paciente = $request->lastName;
				$paciente->segundo_apellido_paciente = $request->lastName2;
				//$paciente->correo = $request->email;
				$paciente->save();
			} else if($cuenta->tipo == 2) {
				$especialista = Especialista::where('id_user',$cuenta->id)->first();
				$especialista->nombre = $request->name;
				$especialista->primer_apellido_especialista = $request->lastName;
				$especialista->segundo_apellido_especialista = $request->lastName2;
				$especialista->save();
			}
			$cuenta->save();
		}
		if(Auth::user()->tipo == 1) {
		return redirect()->route('cuentas.index');
		} 
		if(Auth::user()->tipo == 3) {
			return redirect()->route('cuentas_asistente.index');
		} 

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(User $cuenta, Request $request)
	{	
		//return "hola";
		$cuenta = $request->cuenta;
		//return $cuenta;
		$cuenta->active_flag = 0;

		if($cuenta->tipo == 4) {
			$paciente = Paciente::where('id_user',$cuenta->id)->first();
			$paciente->active_flag = 0;
			$paciente->save();
		} else if($cuenta->tipo == 2) {
			$especialista = Especialista::where('id_user',$cuenta->id)->first();
			$especialista->active_flag = 0;
			$especialista->save();
		}
		$cuenta->save();

		if(Auth::user()->tipo == 1) {
			return redirect()->route('cuentas.index');
			} 
			if(Auth::user()->tipo == 3) {
				return redirect()->route('cuentas_asistente.index');
			} 
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(User $cuenta, Request $request)
	{	
		//return "hola";
		$cuenta = $request->cuenta;
		//return $cuenta;
		$cuenta->active_flag = 1;

		if($cuenta->tipo == 4) {
			$paciente = Paciente::where('id_user',$cuenta->id)->first();
			$paciente->active_flag = 1;
			$paciente->save();
		} else if($cuenta->tipo == 2) {
			$especialista = Especialista::where('id_user',$cuenta->id)->first();
			$especialista->active_flag = 1;
			$especialista->save();
		}
		$cuenta->save();

		if(Auth::user()->tipo == 1) {
		return redirect()->route('cuentas.index');
		} 
		if(Auth::user()->tipo == 3) {
			return redirect()->route('cuentas_asistente.index');
		} 
	}
}
