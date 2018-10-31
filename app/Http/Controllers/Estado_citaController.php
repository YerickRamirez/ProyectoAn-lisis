<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Estado_cita;
use Illuminate\Http\Request;
use \Session;

class Estado_citaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var estado_cita
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Estado_cita $model)
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
		$estado_citas = Estado_cita::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Estado_cita::where('active_flag', 1);
		return view('estado_citas.index', compact('estado_citas', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('estado_citas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$estado_cita = new Estado_cita();

		$estado_cita->name = ucfirst($request->input("name"));
		$estado_cita->slug = str_slug($request->input("name"), "-");
		$estado_cita->description = ucfirst($request->input("description"));
		$estado_cita->active_flag = 1;
		$estado_cita->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:estado_citas',
					 'description' => 'required'
			 ]);

		$estado_cita->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Estado_cita \"<a href='estado_citas/$estado_cita->slug'>" . $estado_cita->name . "</a>\" was Created.");

		return redirect()->route('estado_citas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Estado_cita $estado_cita)
	{
		//$estado_cita = $this->model->findOrFail($id);

		return view('estado_citas.show', compact('estado_cita'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Estado_cita $estado_cita)
	{
		//$estado_cita = $this->model->findOrFail($id);

		return view('estado_citas.edit', compact('estado_cita'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Estado_cita $estado_cita, User $user)
	{

		$estado_cita->name = ucfirst($request->input("name"));
    $estado_cita->slug = str_slug($request->input("name"), "-");
		$estado_cita->description = ucfirst($request->input("description"));
		$estado_cita->active_flag = 1;//change to reflect current status or changed status
		$estado_cita->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:estado_citas,name,' . $estado_cita->id,
					 'description' => 'required'
			 ]);

		$estado_cita->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Estado_cita \"<a href='estado_citas/$estado_cita->slug'>" . $estado_cita->name . "</a>\" was Updated.");

		return redirect()->route('estado_citas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Estado_cita $estado_cita)
	{
		$estado_cita->active_flag = 0;
		$estado_cita->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Estado_cita ' . $estado_cita->name . ' was De-Activated.');

		return redirect()->route('estado_citas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Estado_cita $estado_cita)
	{
		$estado_cita->active_flag = 1;
		$estado_cita->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Estado_cita ' . $estado_cita->name . ' was Re-Activated.');

		return redirect()->route('estado_citas.index');
	}
}
