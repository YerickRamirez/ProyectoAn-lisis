<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Recinto_servicio;
use Illuminate\Http\Request;
use \Session;

class Recinto_servicioController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var recinto_servicio
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Recinto_servicio $model)
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
		$recinto_servicios = Recinto_servicio::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Recinto_servicio::where('active_flag', 1);
		return view('recinto_servicios.index', compact('recinto_servicios', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('recinto_servicios.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$recinto_servicio = new Recinto_servicio();

		$recinto_servicio->name = ucfirst($request->input("name"));
		$recinto_servicio->slug = str_slug($request->input("name"), "-");
		$recinto_servicio->description = ucfirst($request->input("description"));
		$recinto_servicio->active_flag = 1;
		$recinto_servicio->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:recinto_servicios',
					 'description' => 'required'
			 ]);

		$recinto_servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Recinto_servicio \"<a href='recinto_servicios/$recinto_servicio->slug'>" . $recinto_servicio->name . "</a>\" was Created.");

		return redirect()->route('recinto_servicios.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Recinto_servicio $recinto_servicio)
	{
		//$recinto_servicio = $this->model->findOrFail($id);

		return view('recinto_servicios.show', compact('recinto_servicio'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Recinto_servicio $recinto_servicio)
	{
		//$recinto_servicio = $this->model->findOrFail($id);

		return view('recinto_servicios.edit', compact('recinto_servicio'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Recinto_servicio $recinto_servicio, User $user)
	{

		$recinto_servicio->name = ucfirst($request->input("name"));
    $recinto_servicio->slug = str_slug($request->input("name"), "-");
		$recinto_servicio->description = ucfirst($request->input("description"));
		$recinto_servicio->active_flag = 1;//change to reflect current status or changed status
		$recinto_servicio->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:recinto_servicios,name,' . $recinto_servicio->id,
					 'description' => 'required'
			 ]);

		$recinto_servicio->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Recinto_servicio \"<a href='recinto_servicios/$recinto_servicio->slug'>" . $recinto_servicio->name . "</a>\" was Updated.");

		return redirect()->route('recinto_servicios.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Recinto_servicio $recinto_servicio)
	{
		$recinto_servicio->active_flag = 0;
		$recinto_servicio->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Recinto_servicio ' . $recinto_servicio->name . ' was De-Activated.');

		return redirect()->route('recinto_servicios.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Recinto_servicio $recinto_servicio)
	{
		$recinto_servicio->active_flag = 1;
		$recinto_servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Recinto_servicio ' . $recinto_servicio->name . ' was Re-Activated.');

		return redirect()->route('recinto_servicios.index');
	}
}
