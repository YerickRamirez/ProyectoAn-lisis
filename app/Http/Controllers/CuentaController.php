<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use App\Paciente;
use App\Cuentas_activa;
use App\Especialista;

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
		//$cuentas = Cuenta::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		//$active = Cuenta::where('active_flag', 1);
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$cuenta = new Cuenta();
		$user = new User();
		$especialista = new Especialista();
		$paciente = new Paciente();

		$checked=Input::has('tipo');
		$checkValue=Input::get('tipo');

		$user = User::create([
            'name' => $request->input("name"),
            'lastName' => $request->input("lastName"). ' ' .$request->input("lastName2"),
            'email' => $request->input("email"),
            'password' => bcrypt( $request->input("password")),
            'tipo' => $checkValue,
            'active_flag' => 1,
		]);

		
		$checked2=Input::has('flag');
		$checkValue2=Input::get('flag');
		
		$this->validate($request, [
					 'name' => 'required|max:255|'//,
					
			 ]);

		if($checkValue == 2) {
		$especialista->id_user = $user->id;
		$especialista->cedula_especialista = $request->input("cedula");
		$especialista->nombre = $request->input("name");
		$especialista->primer_apellido_especialista = $user->email;
		$especialista->segundo_apellido_especialista = $request->input("lastName2");
		$especialista->active_flag = 1;

		$especialista->save();
		} else {
			if($checkValue == 4) {
				$paciente->id_user = $user->id;
				$paciente->cedula_paciente = $request->input("cedula");
				$paciente->nombre = $request->input("name");
				$paciente->primer_apellido_paciente = $request->input("lastName");
				$paciente->segundo_apellido_paciente = $request->input("lastName2");
				$paciente->correo = $user->email;
				$paciente->active_flag = 1;//change to reflect current status or changed status
		
				$paciente->save();
			}
		}

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');

		return redirect()->route('Prueba.adn');
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
