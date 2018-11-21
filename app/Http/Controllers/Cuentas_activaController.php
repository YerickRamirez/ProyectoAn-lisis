<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Cuentas_activa;
use Illuminate\Http\Request;
use \Session;

class Cuentas_activaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var cuentas_activa
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Cuentas_activa $model)
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
		$cuentas_activas = Cuentas_activa::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Cuentas_activa::where('active_flag', 1);
		return view('cuentas_activas.index', compact('cuentas_activas', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('cuentas_activas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$cuentas_activa = new Cuentas_activa();

		$cuentas_activa->name = ucfirst($request->input("name"));
		$cuentas_activa->slug = str_slug($request->input("name"), "-");
		$cuentas_activa->description = ucfirst($request->input("description"));
		$cuentas_activa->active_flag = 1;
		$cuentas_activa->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:cuentas_activas',
					 'description' => 'required'
			 ]);

		$cuentas_activa->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Cuentas_activa \"<a href='cuentas_activas/$cuentas_activa->slug'>" . $cuentas_activa->name . "</a>\" was Created.");

		return redirect()->route('cuentas_activas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Cuentas_activa $cuentas_activa)
	{
		//$cuentas_activa = $this->model->findOrFail($id);

		return view('cuentas_activas.show', compact('cuentas_activa'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Cuentas_activa $cuentas_activa)
	{
		//$cuentas_activa = $this->model->findOrFail($id);

		return view('cuentas_activas.edit', compact('cuentas_activa'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Cuentas_activa $cuentas_activa, User $user)
	{

		$cuentas_activa->name = ucfirst($request->input("name"));
    $cuentas_activa->slug = str_slug($request->input("name"), "-");
		$cuentas_activa->description = ucfirst($request->input("description"));
		$cuentas_activa->active_flag = 1;//change to reflect current status or changed status
		$cuentas_activa->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:cuentas_activas,name,' . $cuentas_activa->id,
					 'description' => 'required'
			 ]);

		$cuentas_activa->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Cuentas_activa \"<a href='cuentas_activas/$cuentas_activa->slug'>" . $cuentas_activa->name . "</a>\" was Updated.");

		return redirect()->route('cuentas_activas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Cuentas_activa $cuentas_activa)
	{
		$cuentas_activa->active_flag = 0;
		$cuentas_activa->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Cuentas_activa ' . $cuentas_activa->name . ' was De-Activated.');

		return redirect()->route('cuentas_activas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Cuentas_activa $cuentas_activa)
	{
		$cuentas_activa->active_flag = 1;
		$cuentas_activa->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Cuentas_activa ' . $cuentas_activa->name . ' was Re-Activated.');

		return redirect()->route('cuentas_activas.index');
	}
}
