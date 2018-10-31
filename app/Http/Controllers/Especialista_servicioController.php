<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Especialista_servicio;
use Illuminate\Http\Request;
use \Session;

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
		$especialista_servicios = Especialista_servicio::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Especialista_servicio::where('active_flag', 1);
		return view('especialista_servicios.index', compact('especialista_servicios', 'active'));
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
	public function store(Request $request, User $user)
	{
		$especialista_servicio = new Especialista_servicio();

		$especialista_servicio->name = ucfirst($request->input("name"));
		$especialista_servicio->slug = str_slug($request->input("name"), "-");
		$especialista_servicio->description = ucfirst($request->input("description"));
		$especialista_servicio->active_flag = 1;
		$especialista_servicio->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:especialista_servicios',
					 'description' => 'required'
			 ]);

		$especialista_servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Especialista_servicio \"<a href='especialista_servicios/$especialista_servicio->slug'>" . $especialista_servicio->name . "</a>\" was Created.");

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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Especialista_servicio $especialista_servicio)
	{
		$especialista_servicio->active_flag = 0;
		$especialista_servicio->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Especialista_servicio ' . $especialista_servicio->name . ' was De-Activated.');

		return redirect()->route('especialista_servicios.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Especialista_servicio $especialista_servicio)
	{
		$especialista_servicio->active_flag = 1;
		$especialista_servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Especialista_servicio ' . $especialista_servicio->name . ' was Re-Activated.');

		return redirect()->route('especialista_servicios.index');
	}
}
