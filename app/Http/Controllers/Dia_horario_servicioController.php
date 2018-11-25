<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Dia_horario_servicio;
use Illuminate\Http\Request;
use \Session;

class Dia_horario_servicioController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var dia_horario_servicio
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Dia_horario_servicio $model)
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
		$dia_horario_servicios = Dia_horario_servicio::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Dia_horario_servicio::where('active_flag', 1);
		return view('dia_horario_servicios.index', compact('dia_horario_servicios', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('dia_horario_servicios.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$dia_horario_servicio = new Dia_horario_servicio();

		$dia_horario_servicio->name = ucfirst($request->input("name"));
		$dia_horario_servicio->slug = str_slug($request->input("name"), "-");
		$dia_horario_servicio->description = ucfirst($request->input("description"));
		$dia_horario_servicio->active_flag = 1;
		$dia_horario_servicio->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:dia_horario_servicios',
					 'description' => 'required'
			 ]);

		$dia_horario_servicio->save();

		return redirect()->route('dia_horario_servicios.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Dia_horario_servicio $dia_horario_servicio)
	{
		//$dia_horario_servicio = $this->model->findOrFail($id);

		return view('dia_horario_servicios.show', compact('dia_horario_servicio'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Dia_horario_servicio $dia_horario_servicio)
	{
		//$dia_horario_servicio = $this->model->findOrFail($id);

		return view('dia_horario_servicios.edit', compact('dia_horario_servicio'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Dia_horario_servicio $dia_horario_servicio, User $user)
	{

		$dia_horario_servicio->name = ucfirst($request->input("name"));
    $dia_horario_servicio->slug = str_slug($request->input("name"), "-");
		$dia_horario_servicio->description = ucfirst($request->input("description"));
		$dia_horario_servicio->active_flag = 1;//change to reflect current status or changed status
		$dia_horario_servicio->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:dia_horario_servicios,name,' . $dia_horario_servicio->id,
					 'description' => 'required'
			 ]);

		$dia_horario_servicio->save();


		return redirect()->route('dia_horario_servicios.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Dia_horario_servicio $dia_horario_servicio)
	{
		$dia_horario_servicio->active_flag = 0;
		$dia_horario_servicio->save();

		return redirect()->route('dia_horario_servicios.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Dia_horario_servicio $dia_horario_servicio)
	{
		$dia_horario_servicio->active_flag = 1;
		$dia_horario_servicio->save();
		return redirect()->route('dia_horario_servicios.index');
	}
}
