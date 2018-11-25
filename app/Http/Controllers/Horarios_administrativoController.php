<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Horarios_administrativo;
use Illuminate\Http\Request;
use \Session;

class Horarios_administrativoController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var horarios_administrativo
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Horarios_administrativo $model)
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
		$horarios_administrativos = Horarios_administrativo::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Horarios_administrativo::where('active_flag', 1);
		return view('horarios_administrativos.index', compact('horarios_administrativos', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('horarios_administrativos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$horarios_administrativo = new Horarios_administrativo();

		$horarios_administrativo->name = ucfirst($request->input("name"));
		$horarios_administrativo->slug = str_slug($request->input("name"), "-");
		$horarios_administrativo->description = ucfirst($request->input("description"));
		$horarios_administrativo->active_flag = 1;
		$horarios_administrativo->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:horarios_administrativos',
					 'description' => 'required'
			 ]);

		$horarios_administrativo->save();

		return redirect()->route('horarios_administrativos.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Horarios_administrativo $horarios_administrativo)
	{
		//$horarios_administrativo = $this->model->findOrFail($id);

		return view('horarios_administrativos.show', compact('horarios_administrativo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Horarios_administrativo $horarios_administrativo)
	{
		//$horarios_administrativo = $this->model->findOrFail($id);

		return view('horarios_administrativos.edit', compact('horarios_administrativo'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Horarios_administrativo $horarios_administrativo, User $user)
	{

		$horarios_administrativo->name = ucfirst($request->input("name"));
    $horarios_administrativo->slug = str_slug($request->input("name"), "-");
		$horarios_administrativo->description = ucfirst($request->input("description"));
		$horarios_administrativo->active_flag = 1;//change to reflect current status or changed status
		$horarios_administrativo->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:horarios_administrativos,name,' . $horarios_administrativo->id,
					 'description' => 'required'
			 ]);

		$horarios_administrativo->save();
		return redirect()->route('horarios_administrativos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Horarios_administrativo $horarios_administrativo)
	{
		$horarios_administrativo->active_flag = 0;
		$horarios_administrativo->save();
		return redirect()->route('horarios_administrativos.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Horarios_administrativo $horarios_administrativo)
	{
		$horarios_administrativo->active_flag = 1;
		$horarios_administrativo->save();
		return redirect()->route('horarios_administrativos.index');
	}
}
