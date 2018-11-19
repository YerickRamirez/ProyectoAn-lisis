<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Especialista_servicio;
use Illuminate\Http\Request;
use \Session;
use DB;
use Flash;

class Especialista_servicioController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var especialista_servicio
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Especialista_servicio $model)
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
		$vinculos = DB::table('especialista_servicios')
			->join('servicios', 'especialista_servicios.id_servicio', '=', 'servicios.id')
			->where('servicios.active_flag', 1)
			->where('especialista_servicios.active_flag', 1)
			->join('recintos', 'especialista_servicios.id_recinto', '=', 'recintos.id')
			->where('recintos.active_flag', 1)
			->join('especialistas', 'especialista_servicios.id_especialista', '=', 'especialistas.id')
			->where('especialistas.active_flag', 1)
			->select('especialista_servicios.id_servicio', 
			'especialista_servicios.id_recinto', 
			'especialista_servicios.id_especialista',
			'recintos.descripcion as Recinto' ,
			'servicios.nombre as Servicio',
			'especialistas.nombre as nombreEspecialista', 
			'especialistas.primer_apellido_especialista as apellido1', 
			'especialistas.segundo_apellido_especialista as apellido2')
			->orderBy('id_recinto', 'asc')->get();
			
		return view('especialista_servicios.index', compact('vinculos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('especialista_servicios.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user, $servicio, $recinto, $especialista)
	{

		$sentencia = Especialista_servicio::
		where('active_flag', 1)
		->where('id_servicio', $servicio)
		->where('id_recinto', $recinto)
		->where('id_especialista', $especialista)->get();

		if ($sentencia->count())
            {
                Flash::error("Ya existe ese servicio vinculado al recinto seleccionado");
            }
            else{
                $especialista_servicio = new Especialista_servicio();
				$especialista_servicio->id_servicio = $servicio;
				$especialista_servicio->id_recinto = $recinto;
				$especialista_servicio->id_especialista = $especialista;
				$especialista_servicio->active_flag = 1;
				$especialista_servicio->save();
		}
		return redirect()->route('especialista_servicios.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Especialista_servicio $especialista_servicio)
	{
		//$especialista_servicio = $this->model->findOrFail($id);

		return view('especialista_servicios.show', compact('especialista_servicio'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Especialista_servicio $especialista_servicio)
	{
		//$especialista_servicio = $this->model->findOrFail($id);

		return view('especialista_servicios.edit', compact('especialista_servicio'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Especialista_servicio $especialista_servicio, User $user)
	{

		$especialista_servicio->name = ucfirst($request->input("name"));
    $especialista_servicio->slug = str_slug($request->input("name"), "-");
		$especialista_servicio->description = ucfirst($request->input("description"));
		$especialista_servicio->active_flag = 1;//change to reflect current status or changed status
		$especialista_servicio->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:especialista_servicios,name,' . $especialista_servicio->id,
					 'description' => 'required'
			 ]);

		$especialista_servicio->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Especialista_servicio \"<a href='especialista_servicios/$especialista_servicio->slug'>" . $especialista_servicio->name . "</a>\" was Updated.");

		return redirect()->route('especialista_servicios.index');
	}


	public function eliminar($servicio, $recinto, $especialista)
	{
		$vinculos = $users = Especialista_servicio::
		where('active_flag', 1)
		->where('id_servicio', $servicio)
		->where('id_recinto', $recinto)
		->where('id_especialista', $especialista)->update(['active_flag'=>0]);
		
		return redirect()->route('especialista_servicios.index');
	}
}
