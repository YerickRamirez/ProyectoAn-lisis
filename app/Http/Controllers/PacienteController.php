<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Telefono;
use Auth;
use DB;

use App\Paciente;
use Illuminate\Http\Request;
use \Session;

class PacienteController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var paciente
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Paciente $model)
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
		$pacientes = $paciente = DB::table('pacientes')
		->join('telefonos', 'pacientes.id', '=', 'telefonos.paciente_id')
		->select('pacientes.active_flag as active_flag',
			'pacientes.nombre',
			'pacientes.primer_apellido_paciente',
			'pacientes.segundo_apellido_paciente',
			'pacientes.correo',
			'pacientes.cedula_paciente',
			'pacientes.id',
			'telefonos.telefono')
		->orderBy('pacientes.id', 'asc')->get();
		
		$tipo = Auth::user()->tipo;
		if($tipo == 4) {
			return redirect('paciente');
		} else{
			if($tipo == 3){
				return view('asistente.verPacientes', compact('pacientes', 'active'));
			} else{
				if($tipo == 2){
					
					return view('Especialista.verPacientes', compact('pacientes', 'active'));
				} else{
					if($tipo == 1){
						return view('pacientes.index', compact('pacientes', 'active'));
				}
			}
			}
		}

		

		/*$pacientes = Paciente::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Paciente::where('active_flag', 1);*/
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('pacientes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$paciente = new Paciente();

		$paciente->name = ucfirst($request->input("name"));
		$paciente->slug = str_slug($request->input("name"), "-");
		$paciente->description = ucfirst($request->input("description"));
		$paciente->active_flag = 1;
		$paciente->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:pacientes',
					 'description' => 'required'
			 ]);

		$paciente->save();

		return redirect()->route('pacientes.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Paciente $paciente)
	{
		//$paciente = $this->model->findOrFail($id);

		return view('pacientes.show', compact('paciente'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Paciente $paciente)
	{
		$variable = Paciente::where('id_user', Auth::user()->id)
		->join('telefonos', 'pacientes.id', '=', 'telefonos.paciente_id')->first();

		return view('pacientes.edit', compact('variable'));
	}

	public function editRoot(Paciente $paciente)
	{
		
		$pacientes = $paciente = DB::table('pacientes')->where('pacientes.id', $paciente->id)
		->join('telefonos', 'pacientes.id', '=', 'telefonos.paciente_id')->first();
		$tipo = Auth::user()->tipo;
		if($tipo == 4) {
			return redirect('paciente');
		} else{
			if($tipo == 3){
				return view('asistente.edit', compact('paciente'));
			} else{
				if($tipo == 2){
					return view('Especialista.edit', compact('paciente'));
				} else{
					if($tipo == 1){
						return view('Admin.editarDatosPaciente', compact('paciente'));
				}
			}
			}
		}
		
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Paciente $paciente, User $user)
	{
		$paciente->cedula_paciente = $request->input("cedula_paciente");
		$paciente->nombre = $request->input("nombre");
		$paciente->primer_apellido_paciente = $request->input("primer_apellido_paciente");
		$paciente->segundo_apellido_paciente = $request->input("segundo_apellido_paciente");
		$paciente->correo = $request->input("correo");
		$paciente->active_flag = 1;//change to reflect current status or changed status
		
		$telefono = Telefono::where('paciente_id', '=', $paciente->id)->first();
		$telefono->telefono = $request->input("telefono");
		$telefono->save();

		$correoNuevo = $request->input("correo");
		$user = User::where('id', $paciente->id_user)->update(array('email'=>$correoNuevo));
		//$user->save();
		$paciente->save();
		return redirect()->route('citas.index');
	}

	public function updateRoot(Request $request, Paciente $paciente, User $user)
	{

		$cuenta = User::where('id', '=', $paciente->id_user)->first();
		$cuenta->name =$request->input("nombre");
		$apellido = $request->input("primer_apellido_paciente") . " " . $request->input("segundo_apellido_paciente");
		//return $apellido;
		$cuenta->lastName = $apellido;
		$cuenta->email =$request->input("correo");
		$cuenta->save();
		
		$telefono = Telefono::where('paciente_id', '=', $paciente->id)->first();
		$telefono->telefono = $request->input("telefono");
		$telefono->save();

		$paciente->cedula_paciente = $request->input("segundo_apellido_paciente");
		$paciente->nombre = $request->input("nombre");
		$paciente->primer_apellido_paciente = $request->input("primer_apellido_paciente");
		$paciente->segundo_apellido_paciente = $request->input("segundo_apellido_paciente");
		$paciente->correo = $request->input("correo");
		//$paciente->te = $request->input("correo");
		$paciente->active_flag = 1;//change to reflect current status or changed status
		
		$correoNuevo = $request->input("correo");
		$user = User::where('id', $paciente->id_user)->update(array('email'=>$correoNuevo));
		//$user->save();
		$paciente->save();

		return redirect()->route('pacientes.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Paciente $paciente)
	{	
		//return $paciente->id_user;
		$cuenta = User::where('id', '=', $paciente->id_user)->first();
		$cuenta->active_flag = 0;
		$paciente->active_flag = 0;
		$paciente->save();
		$cuenta->save();

		return redirect()->route('pacientes.index');
	}

	public function activar(Paciente $paciente)
	{	
		
		//return $paciente->id_user;
		$cuenta = User::where('id', '=', $paciente->id_user)->first();
		$cuenta->active_flag = 1;
		$paciente->active_flag = 1;
		$paciente->save();
		$cuenta->save();

		return redirect()->route('pacientes.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Paciente $paciente)
	{
		$paciente->active_flag = 1;
		$paciente->save();

		return redirect()->route('pacientes.index');
	}
}
