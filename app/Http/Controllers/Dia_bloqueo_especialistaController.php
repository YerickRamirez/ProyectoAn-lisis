<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Dia_bloqueo_especialista;
use Illuminate\Http\Request;
use \Session;

class Dia_bloqueo_especialistaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var dia_bloqueo_especialista
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Dia_bloqueo_especialista $model)
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
		$dia_bloqueo_especialistas = Dia_bloqueo_especialista::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Dia_bloqueo_especialista::where('active_flag', 1);
		return view('dia_bloqueo_especialistas.index', compact('dia_bloqueo_especialistas', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('dia_bloqueo_especialistas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$dia_bloqueo_especialista = new Dia_bloqueo_especialista();

		$dia_bloqueo_especialista->name = ucfirst($request->input("name"));
		$dia_bloqueo_especialista->slug = str_slug($request->input("name"), "-");
		$dia_bloqueo_especialista->description = ucfirst($request->input("description"));
		$dia_bloqueo_especialista->active_flag = 1;
		$dia_bloqueo_especialista->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:dia_bloqueo_especialistas',
					 'description' => 'required'
			 ]);

		$dia_bloqueo_especialista->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Dia_bloqueo_especialista \"<a href='dia_bloqueo_especialistas/$dia_bloqueo_especialista->slug'>" . $dia_bloqueo_especialista->name . "</a>\" was Created.");

		return redirect()->route('dia_bloqueo_especialistas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Dia_bloqueo_especialista $dia_bloqueo_especialista)
	{
		//$dia_bloqueo_especialista = $this->model->findOrFail($id);

		return view('dia_bloqueo_especialistas.show', compact('dia_bloqueo_especialista'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Dia_bloqueo_especialista $dia_bloqueo_especialista)
	{
		//$dia_bloqueo_especialista = $this->model->findOrFail($id);

		return view('dia_bloqueo_especialistas.edit', compact('dia_bloqueo_especialista'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Dia_bloqueo_especialista $dia_bloqueo_especialista, User $user)
	{

		$dia_bloqueo_especialista->name = ucfirst($request->input("name"));
    $dia_bloqueo_especialista->slug = str_slug($request->input("name"), "-");
		$dia_bloqueo_especialista->description = ucfirst($request->input("description"));
		$dia_bloqueo_especialista->active_flag = 1;//change to reflect current status or changed status
		$dia_bloqueo_especialista->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:dia_bloqueo_especialistas,name,' . $dia_bloqueo_especialista->id,
					 'description' => 'required'
			 ]);

		$dia_bloqueo_especialista->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Dia_bloqueo_especialista \"<a href='dia_bloqueo_especialistas/$dia_bloqueo_especialista->slug'>" . $dia_bloqueo_especialista->name . "</a>\" was Updated.");

		return redirect()->route('dia_bloqueo_especialistas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Dia_bloqueo_especialista $dia_bloqueo_especialista)
	{
		$dia_bloqueo_especialista->active_flag = 0;
		$dia_bloqueo_especialista->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Dia_bloqueo_especialista ' . $dia_bloqueo_especialista->name . ' was De-Activated.');

		return redirect()->route('dia_bloqueo_especialistas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Dia_bloqueo_especialista $dia_bloqueo_especialista)
	{
		$dia_bloqueo_especialista->active_flag = 1;
		$dia_bloqueo_especialista->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Dia_bloqueo_especialista ' . $dia_bloqueo_especialista->name . ' was Re-Activated.');

		return redirect()->route('dia_bloqueo_especialistas.index');
	}
}
