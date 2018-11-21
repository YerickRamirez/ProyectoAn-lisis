<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use DB;
use Auth;

use App\Cita;
use Illuminate\Http\Request;
use \Session;
use Carbon\Carbon;
use App\Paciente;

class CitaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var cita
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Cita $model)
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
		/*$citas = Cita::where('active_flag', 1)
		->orderBy('id', 'desc')->paginate(10);
		$active = Cita::where('active_flag', 1);*/

		$paciente = Paciente::where('id_user', Auth::user()->id)->select('pacientes.id')->get();
		$paciente_id = $paciente->first()->id;

		$fechaInicioDia = Carbon::createFromFormat('Y-m-d', Carbon::parse(Carbon::now())
				->format('Y-m-d'), 'America/Costa_Rica')->startOfDay()->format('Y-m-d H:i');
		
		$fechaFinDia = Carbon::createFromFormat('Y-m-d', Carbon::parse(Carbon::now())
		->format('Y-m-d'), 'America/Costa_Rica')->endOfDay()->format('Y-m-d H:i');
				
		//return $fechaInicioCarbon;

		$citas = DB::table('citas')
		->join('estado_citas', 'citas.estado_cita_id', 'estado_citas.id')
		->where('citas.estado_cita_id', '!=', 3)
		->where('citas.estado_cita_id', '!=', 4)
		->where('pacientes.id', $paciente_id)
		->whereDate('citas.fecha_cita', '>=', $fechaInicioDia)
		->where('estado_citas.active_flag', 1)
		->join('pacientes', 'citas.paciente_id', 'pacientes.id')
		->where('pacientes.active_flag', 1)
		->where('citas.active_flag', 1)
		->join('servicios', 'citas.servicio_id', 'servicios.id')
		->where('servicios.active_flag', 1)
		->where('citas.active_flag', 1)
		->join('especialistas', 'citas.especialista_id', 'especialistas.id')
		->where('especialistas.active_flag', 1)
		->where('citas.active_flag', 1)
		->join('recintos', 'citas.recinto_id', 'recintos.id')
		->where('recintos.active_flag', 1)
		->where('citas.active_flag', 1)
		->select('citas.fecha_cita', 'citas.id', 
		'especialistas.nombre as nombreEspecialista', 
		'especialistas.primer_apellido_especialista as apellidoE1',
		'especialistas.segundo_apellido_especialista as apellidoE2',
		'servicios.nombre as servicio',
		'recintos.descripcion as recinto',
		'estado_citas.descripcion_estado_cita as estadoCita',
		'pacientes.nombre as nombrePaciente',
		'pacientes.primer_apellido_paciente as apellidoP1',
		'pacientes.segundo_apellido_paciente as apellidoP2')
		->orderBy('fecha_cita', 'asc')->get();

		return view('citas.index', compact('citas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('citas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$cita = new Cita();

		$cita->estado_cita_id = 1;
		//return "a";
		$paciente = Paciente::where('id_user', Auth::user()->id)->select('pacientes.id')->get();
		$cita->paciente_id = $paciente->first()->id;
		$cita->servicio_id = $request->dropServicios;
		$cita->especialista_id = $request->dropEspecialistas;
		$cita->recinto_id = $request->dropRecintos;
		$fechaCita = Carbon::parse($request->datepicked)->format('Y-m-d');
		$minutosCita = substr($request->horaCita, -2);
		$horaCita = $request->horaCita[0];
		if($horaCita == "9" || $horaCita == "8") {
			$horaCita = "0" . $horaCita . ':' . $minutosCita;
		} else {
			$horaCita = $request->horaCita[0] . $request->horaCita[1]  . ':' . $minutosCita;
		}
		//return json_encode(["xD"=>$fechaCita . ' - ' . $horaCita]);
		$cita->fecha_cita = $fechaCita . ' ' . $horaCita;
		$cita->active_flag = 1;
		//$cita->author_id = $request->user()->id;

		/*$this->validate($request, [
					 'name' => 'required|max:255|unique:citas',
					 'description' => 'required'
			 ]);*/

		$cita->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "La cita fue añadida exitosamente");

		return redirect()->route('citas.index');
		}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Cita $cita)
	{
		//$cita = $this->model->findOrFail($id);

		return view('citas.show', compact('cita'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Cita $cita)
	{
		//$cita = $this->model->findOrFail($id);

		return view('citas.edit', compact('cita'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Cita $cita, User $user)
	{

		$cita->name = ucfirst($request->input("name"));
    $cita->slug = str_slug($request->input("name"), "-");
		$cita->description = ucfirst($request->input("description"));
		$cita->active_flag = 1;//change to reflect current status or changed status
		$cita->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:citas,name,' . $cita->id,
					 'description' => 'required'
			 ]);

		$cita->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Cita \"<a href='citas/$cita->slug'>" . $cita->name . "</a>\" was Updated.");

		return redirect()->route('citas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Cita $cita)
	{
		//return $cita;
		$cita->estado_cita_id = 3;
		$cita->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Cita ' . $cita->name . ' was De-Activated.');
		return redirect()->route('citas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Cita $cita)
	{
		$cita->active_flag = 1;
		$cita->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Cita ' . $cita->name . ' was Re-Activated.');

		return redirect()->route('citas.index');
	}
}
