<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Telefono;
use Illuminate\Http\Request;
use \Session;

class TelefonoController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var telefono
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Telefono $model)
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
		$telefonos = Telefono::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Telefono::where('active_flag', 1);
		return view('telefonos.index', compact('telefonos', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('telefonos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$telefono = new Telefono();

		$telefono->name = ucfirst($request->input("name"));
		$telefono->slug = str_slug($request->input("name"), "-");
		$telefono->description = ucfirst($request->input("description"));
		$telefono->active_flag = 1;
		$telefono->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:telefonos',
					 'description' => 'required'
			 ]);

		$telefono->save();

		return redirect()->route('telefonos.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Telefono $telefono)
	{
		//$telefono = $this->model->findOrFail($id);

		return view('telefonos.show', compact('telefono'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Telefono $telefono)
	{
		//$telefono = $this->model->findOrFail($id);

		return view('telefonos.edit', compact('telefono'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Telefono $telefono, User $user)
	{

		$telefono->name = ucfirst($request->input("name"));
    $telefono->slug = str_slug($request->input("name"), "-");
		$telefono->description = ucfirst($request->input("description"));
		$telefono->active_flag = 1;//change to reflect current status or changed status
		$telefono->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:telefonos,name,' . $telefono->id,
					 'description' => 'required'
			 ]);

		$telefono->save();

		return redirect()->route('telefonos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Telefono $telefono)
	{
		$telefono->active_flag = 0;
		$telefono->save();

		return redirect()->route('telefonos.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Telefono $telefono)
	{
		$telefono->active_flag = 1;
		$telefono->save();
		return redirect()->route('telefonos.index');
	}
}
