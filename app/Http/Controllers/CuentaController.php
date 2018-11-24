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
	
		$cuentas = User::where('active_flag', 1)->orderBy('id', 'asc')->get();
		$active = User::where('active_flag', 1);
		return view('cuentas.index', compact('cuentas', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('cuentas.create');
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
            return back()->withErrors(['password' => 'Debe tener más de 6 caracteres']);
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

		//return "aquíxD";
		if($telefono == "" || strlen($telefono) < 4) {
			if($checkValue == 4) {
				return back()->withErrors(['telefono' => trans('El paciente debe tener un teléfono válido')]);
			} else {
		
		$cuenta = new Cuenta();
		$user = new User();
		$especialista = new Especialista();
		$paciente = new Paciente();

		$user = User::create([
            'name' => $request->input("name"),
            'lastName' => $request->input("lastName"). ' ' .$request->input("lastName2"),
            'email' => $request->input("email"),
            'password' => bcrypt($request->input("password")),
            'tipo' => $checkValue,
            'active_flag' => $checkValue2,
		]);

		if($checkValue == 2) {
		$especialista->id_user = $user->id;
		$especialista->cedula_especialista = $request->input("cedula");
		$especialista->nombre = $request->input("name");
		$especialista->primer_apellido_especialista = $user->email;
		$especialista->segundo_apellido_especialista = $request->input("lastName2");
		$especialista->active_flag = $checkValue2;

		$especialista->save();
		}

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');

		return redirect()->route('cuentas.index');
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

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');

		return redirect()->route('cuentas.index');
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

		return view('cuentas.show', compact('cuenta'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Cuenta $cuenta)
	{
		//$cuenta = $this->model->findOrFail($id);

		return view('cuentas.edit', compact('cuenta'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Cuenta $cuenta, User $user)
	{
		/** 
		*$cuenta->name = ucfirst($request->input("name"));
   * $cuenta->slug = str_slug($request->input("name"), "-");
	*	$cuenta->description = ucfirst($request->input("description"));
		*$cuenta->active_flag = 1;//change to reflect current status or changed status
		*$cuenta->author_id = $request->user()->id;

		*$this->validate($request, [
		*			 'name' => 'required|max:255|unique:cuentas,name,' . $cuenta->id//,
		*			// 'description' => 'required'
		*	 ]);

		*$cuenta->save();

		*Session::flash('message_type', 'blue');
		*Session::flash('message_icon', 'checkmark');
		*Session::flash('message_header', 'Success');
		*Session::flash('message', "The Cuenta \"<a href='cuentas/$cuenta->slug'>" . $cuenta->name . "</a>\" was Updated.");
				*/
		return redirect()->route('cuentas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Cuenta $cuenta)
	{	
		return $cuenta;
		$cuenta->active_flag = 0;
		$cuenta->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		//Session::flash('message', 'The Cuenta ' . $cuenta->name . ' was De-Activated.');

		return redirect()->route('cuentas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Cuenta $cuenta)
	{
		$cuenta->active_flag = 1;
		$cuenta->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Cuenta ' . $cuenta->name . ' was Re-Activated.');

		return redirect()->route('cuentas.index');
	}
}
