<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Servicio;
use Illuminate\Http\Request;
use \Session;

class ServicioController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var servicio
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Servicio $model)
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
		$servicios = Servicio::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Servicio::where('active_flag', 1);
		return view('servicio.index', compact('servicios', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('servicio.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$servicio = new Servicio();

		$servicio->nombre = ucfirst($request->input("nombre"));
		$servicio->descripcion = ucfirst($request->input("descripcion"));
		$servicio->active_flag = 1;
		$servicio->author_id = $request->user()->id;

		$this->validate($request, [
					 'nombre' => 'required|max:255',
					 'descripcion' => 'required|max:255'
			 ]);

		$servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Servicio \"<a href='servicios/$servicio->slug'>" . $servicio->nombre . "</a>\" was Created.");

		return redirect()->route('servicios.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Servicio $servicio)
	{
		//$servicio = $this->model->findOrFail($id);

		return view('servicio.show', compact('servicio'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Servicio $servicio)
	{
		//$servicio = $this->model->findOrFail($id);

		return view('servicio.edit', compact('servicio'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Servicio $servicio, User $user)
	{

		$servicio->nombre = ucfirst($request->input("nombre"));
		$servicio->descripcion = ucfirst($request->input("descripcion"));
		$servicio->active_flag = 1;//change to reflect current status or changed status
		$servicio->author_id = $request->user()->id;

		$this->validate($request, [
					 'nombre' => 'required|max:255' . $servicio->nombre,
					 'descripcion' => 'required|max:255'.$servicio->descripcion
			 ]);

		$servicio->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		//Session::flash('message', "The Servicio \"<a href='servicios/$servicio->slug'>" . $servicio->nombre . "</a>\" was Updated.");

		return redirect()->route('servicios.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Servicio $servicio)
	{
		$servicio->active_flag = 0;
		$servicio->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Servicio ' . $servicio->nombre . ' was De-Activated.');

		return redirect()->route('servicios.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Servicio $servicio)
	{
		$servicio->active_flag = 1;
		$servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Servicio ' . $servicio->nombre . ' was Re-Activated.');

		return redirect()->route('servicios.index');
	}
}
