<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Especialista;
use Illuminate\Http\Request;
use \Session;

class EspecialistaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var especialista
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
		$especialistas = Especialista::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Especialista::where('active_flag', 1);
		return view('especialistas.index', compact('especialistas', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('especialistas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$especialista = new Especialista();
		//if ($request->input("cedula_especialista") != $request->input("cedula_original")){
		$pacienteExistente = Especialista::where('cedula_especialista', $request->input("cedula_especialista"))->get();
		if(!$pacienteExistente->isEmpty() ) {
			return back()->withErrors(['cedula_especialista' => trans('Ya existe un especialista con la cédula indicada')]);
		}
		
		$cuentaExistente = User::where('email', $request->input("email"))->get();
		$cuentaA = $cuentaExistente->first();
		if(!$cuentaExistente->isEmpty()) {
			return back()->withErrors(['email' => trans('Ya existe un especialista con el correo indicado')]);
		}

		$rrr = $request->input('password');
        if (strlen($rrr)<6) {
            return back()->withErrors(['password' => 'Debe tener más de 6 caracteres']);
        }

		$user = User::create([
            'name' => $request->input("nombre"),
            'lastName' => $request->input("primer_apellido_especialista"). ' ' .$request->input("segundo_apellido_especialista"),
            'email' => $request->input("email"),
            'password' => bcrypt( $request->input("password")),
            'tipo' => 2,
            'active_flag' => 1,
        ]);

		$especialista->id_user = $user->id;
		$especialista->cedula_especialista = $request->input("cedula_especialista");
		$especialista->nombre = $request->input("nombre");
		$especialista->primer_apellido_especialista = $request->input("primer_apellido_especialista");
		$especialista->segundo_apellido_especialista = $request->input("segundo_apellido_especialista");
		$especialista->active_flag = 1;

		$this->validate($request, [
					 'cedula_especialista' => 'required',
					 'nombre' => 'required',
					 'primer_apellido_especialista' => 'required',
					 'segundo_apellido_especialista' => 'required'
			 ]);


		$especialista->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Especialista creado exitosamente');//shows confirmation message that the specialists was successfully created

		return redirect()->route('especialistas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Especialista $especialista)
	{
		//$especialista = $this->model->findOrFail($id);

		return view('especialistas.show', compact('especialista'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Especialista $especialista)
	{
		//$especialista = $this->model->findOrFail($id);

		return view('especialistas.edit', compact('especialista'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Especialista $especialista, User $user)
	{

		if ($request->input("cedula_especialista") != $request->input("cedula_original")){
			$pacienteExistente = Especialista::where('cedula_especialista', $request->input("cedula_especialista"))->get();
			if(!$pacienteExistente->isEmpty() ) {
				return back()->withErrors(['cedula_especialista' => trans('Ya existe un especialista con la cédula indicada')]);
			}
		}

		$especialista->cedula_especialista = $request->input("cedula_especialista");
		$especialista->nombre = $request->input("nombre");
		$especialista->primer_apellido_especialista = $request->input("primer_apellido_especialista");
		$especialista->segundo_apellido_especialista = $request->input("segundo_apellido_especialista");
		$especialista->active_flag = 1;

		$this->validate($request, [
					 'cedula_especialista' => 'required',
					 'nombre' => 'required',
					 'primer_apellido_especialista' => 'required',
					 'segundo_apellido_especialista' => 'required'
			 ]);

		$especialista->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Especialista modificado exitosamente');//shows confirmation message that the specialist was successfully updated
		
		return redirect()->route('especialistas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Especialista $especialista)
	{
		$especialista->active_flag = 0;
		$especialista->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Failure');
		Session::flash('error', 'Especialista desactivado satisfactoriamente');

		return redirect()->route('especialistas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Especialista $especialista)
	{
		$especialista->active_flag = 1;
		$especialista->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Especialista activado satisfactoriamente');

		return redirect()->route('especialistas.index');
	}
}
