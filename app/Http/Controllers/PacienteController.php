<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

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
		$pacientes = Paciente::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Paciente::where('active_flag', 1);
		return view('pacientes.index', compact('pacientes', 'active'));
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

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Paciente \"<a href='pacientes/$paciente->slug'>" . $paciente->name . "</a>\" was Created.");

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
		//$paciente = $this->model->findOrFail($id);

		return view('pacientes.edit', compact('paciente'));
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

		$paciente->name = ucfirst($request->input("name"));
    $paciente->slug = str_slug($request->input("name"), "-");
		$paciente->description = ucfirst($request->input("description"));
		$paciente->active_flag = 1;//change to reflect current status or changed status
		$paciente->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:pacientes,name,' . $paciente->id,
					 'description' => 'required'
			 ]);

		$paciente->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Paciente \"<a href='pacientes/$paciente->slug'>" . $paciente->name . "</a>\" was Updated.");

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
		$paciente->active_flag = 0;
		$paciente->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Paciente ' . $paciente->name . ' was De-Activated.');

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

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Paciente ' . $paciente->name . ' was Re-Activated.');

		return redirect()->route('pacientes.index');
	}
}
