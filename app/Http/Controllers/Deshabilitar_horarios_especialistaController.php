<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Deshabilitar_horarios_especialista;
use Illuminate\Http\Request;
use \Session;

class Deshabilitar_horarios_especialistaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var deshabilitar_horarios_especialista
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Deshabilitar_horarios_especialista $model)
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
		$deshabilitar_horarios_especialistas = Deshabilitar_horarios_especialista::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Deshabilitar_horarios_especialista::where('active_flag', 1);
		return view('deshabilitar_horarios_especialistas.index', compact('deshabilitar_horarios_especialistas', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('deshabilitar_horarios_especialistas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$deshabilitar_horarios_especialista = new Deshabilitar_horarios_especialista();

		$deshabilitar_horarios_especialista->name = ucfirst($request->input("name"));
		$deshabilitar_horarios_especialista->slug = str_slug($request->input("name"), "-");
		$deshabilitar_horarios_especialista->description = ucfirst($request->input("description"));
		$deshabilitar_horarios_especialista->active_flag = 1;
		$deshabilitar_horarios_especialista->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:deshabilitar_horarios_especialistas',
					 'description' => 'required'
			 ]);

		$deshabilitar_horarios_especialista->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Deshabilitar_horarios_especialista \"<a href='deshabilitar_horarios_especialistas/$deshabilitar_horarios_especialista->slug'>" . $deshabilitar_horarios_especialista->name . "</a>\" was Created.");

		return redirect()->route('deshabilitar_horarios_especialistas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista)
	{
		//$deshabilitar_horarios_especialista = $this->model->findOrFail($id);

		return view('deshabilitar_horarios_especialistas.show', compact('deshabilitar_horarios_especialista'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista)
	{
		//$deshabilitar_horarios_especialista = $this->model->findOrFail($id);

		return view('deshabilitar_horarios_especialistas.edit', compact('deshabilitar_horarios_especialista'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista, User $user)
	{

		$deshabilitar_horarios_especialista->name = ucfirst($request->input("name"));
    $deshabilitar_horarios_especialista->slug = str_slug($request->input("name"), "-");
		$deshabilitar_horarios_especialista->description = ucfirst($request->input("description"));
		$deshabilitar_horarios_especialista->active_flag = 1;//change to reflect current status or changed status
		$deshabilitar_horarios_especialista->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:deshabilitar_horarios_especialistas,name,' . $deshabilitar_horarios_especialista->id,
					 'description' => 'required'
			 ]);

		$deshabilitar_horarios_especialista->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Deshabilitar_horarios_especialista \"<a href='deshabilitar_horarios_especialistas/$deshabilitar_horarios_especialista->slug'>" . $deshabilitar_horarios_especialista->name . "</a>\" was Updated.");

		return redirect()->route('deshabilitar_horarios_especialistas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista)
	{
		$deshabilitar_horarios_especialista->active_flag = 0;
		$deshabilitar_horarios_especialista->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Deshabilitar_horarios_especialista ' . $deshabilitar_horarios_especialista->name . ' was De-Activated.');

		return redirect()->route('deshabilitar_horarios_especialistas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista)
	{
		$deshabilitar_horarios_especialista->active_flag = 1;
		$deshabilitar_horarios_especialista->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Deshabilitar_horarios_especialista ' . $deshabilitar_horarios_especialista->name . ' was Re-Activated.');

		return redirect()->route('deshabilitar_horarios_especialistas.index');
	}
}
