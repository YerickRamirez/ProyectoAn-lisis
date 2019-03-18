<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Correo;
use Illuminate\Http\Request;
use \Session;

class CorreoController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var correo
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Correo $model)
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
		$correos = Correo::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Correo::where('active_flag', 1);
		return view('correos.index', compact('correos', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('correos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$correo = new Correo();

		$correo->name = ucfirst($request->input("name"));
		$correo->slug = str_slug($request->input("name"), "-");
		$correo->description = ucfirst($request->input("description"));
		$correo->active_flag = 1;
		$correo->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:correos',
					 'description' => 'required'
			 ]);

		$correo->save();
		return redirect()->route('correos.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Correo $correo)
	{
		return view('correos.show', compact('correo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Correo $correo)
	{
		//$correo = $this->model->findOrFail($id);

		return view('correos.edit', compact('correo'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Correo $correo, User $user)
	{

		$correo->name = ucfirst($request->input("name"));
    	$correo->slug = str_slug($request->input("name"), "-");
		$correo->description = ucfirst($request->input("description"));
		$correo->active_flag = 1;//change to reflect current status or changed status
		$correo->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:correos,name,' . $correo->id,
					 'description' => 'required'
			 ]);

		$correo->save();
		return redirect()->route('correos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Correo $correo)
	{
		$correo->active_flag = 0;
		$correo->save();
		return redirect()->route('correos.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Correo $correo)
	{
		$correo->active_flag = 1;
		$correo->save();
		return redirect()->route('correos.index');
	}
}
