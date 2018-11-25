<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Recinto;
use Illuminate\Http\Request;
use \Session;

class RecintoController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var recinto
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Recinto $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if ($request) {
		
		$recintos = Recinto::where('active_flag', 1)->orderBy('id', 'asc')->paginate(10);
		$active = Recinto::where('active_flag', 1);
        return view('recintos.index', compact('recintos', 'active'));
        /*return view('recintos.index', ["recintos"=>$recintos]);*/
			
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('recintos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$recinto = new Recinto();

		/*$recinto->name = ucfirst($request->input("name"));
		$recinto->slug = str_slug($request->input("name"), "-");*/
		$recinto->descripcion = ucfirst($request->input("descripcion"));
		$recinto->active_flag = 1;
		/*$recinto->author_id = $request->user()->id;*/

		$this->validate($request, [
					 /*'name' => 'required|max:255|unique:recintos',*/
					 'descripcion' => 'required'
			 ]);

		$recinto->save();

		return redirect()->route('recintos.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Recinto $recinto)
	{
		//$recinto = $this->model->findOrFail($id);

		return view('recintos.show', compact('recinto'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Recinto $recinto)
	{
		return view('recintos.edit', compact('recinto'));
		//return view('recintos.edit')->with('recinto', $recinto);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Recinto $recinto)
	{


		/*$recinto->name = ucfirst($request->input("name"));
		$recinto->slug = str_slug($request->input("name"), "-");*/
		$recinto->descripcion = ucfirst($request->input("descripcion"));
		$recinto->active_flag = 1;//change to reflect current status or changed status
		/*$recinto->author_id = $request->user()->id;*/

		$this->validate($request, [
					 /*'name' => 'required|max:255|unique:recintos,name,' . $recinto->id,*/
					 'descripcion' => 'required'
			 ]);

		$recinto->save();

		return redirect()->route('recintos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Recinto $recinto)
	{
		$recinto->active_flag = 0;
		$recinto->save();
		return redirect()->route('recintos.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Recinto $recinto)
	{
		$recinto->active_flag = 1;
		$recinto->save();

		return redirect()->route('recintos.index');
	}
}
