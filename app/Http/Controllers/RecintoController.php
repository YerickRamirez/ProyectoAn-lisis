<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\Recinto;

use Illuminate\Support\Facades\Redirect;

use DB;

use Flash;

use Illuminate\Support\Facades\Crypt;



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
		/*$this->model = $model;*/
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if ($request) {
			$recintos=DB::table('recinto')->orderBy('Nombre','desc')->paginate(5);
			if ($recintos == null) {
                Flash::message("No hay recintos para mostrar");
            }
		}
		return view('Admin/configurarRecintos', ["recintos"=>$recintos]);
		
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	   public function agregarRecinto(Request $request)
    {
        $recinto = new Recinto();

        $recinto->Nombre = $request->nombre;
        
        $recinto->save();

        /*Flash::success("Recinto " . $recinto->Nombre . " guardado satisfactoriamente");*/

        return redirect('recintos');
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

		$recinto->name = ucfirst($request->input("name"));
		$recinto->slug = str_slug($request->input("name"), "-");
		$recinto->description = ucfirst($request->input("description"));
		$recinto->active_flag = 1;
		$recinto->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:recintos',
					 'description' => 'required'
			 ]);

		$recinto->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Recinto \"<a href='recintos/$recinto->slug'>" . $recinto->name . "</a>\" was Created.");

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
		//$recinto = $this->model->findOrFail($id);

		return view('recintos.edit', compact('recinto'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Recinto $recinto, User $user)
	{

		$recinto->name = ucfirst($request->input("name"));
    $recinto->slug = str_slug($request->input("name"), "-");
		$recinto->description = ucfirst($request->input("description"));
		$recinto->active_flag = 1;//change to reflect current status or changed status
		$recinto->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:recintos,name,' . $recinto->id,
					 'description' => 'required'
			 ]);

		$recinto->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Recinto \"<a href='recintos/$recinto->slug'>" . $recinto->name . "</a>\" was Updated.");

		return redirect()->route('recintos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function eliminarRecinto($ID_Recinto)
    {
        /*$placaDecrypted = Crypt::decrypt($placa);*/
        $recinto= Recinto::find($ID_Recinto);

        if($recinto == null) {
                Flash::error("Error, no se ha encontrado el recinto: " + $ID_Recinto);
                return redirect('recintos');
            } else {

		//$especialista->estado= estado_deshabilitado;
        //$especialista->update();

        Flash::error('Especialista eliminado satisfactoriamente.');

        return redirect('recintos');    
    }
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

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Recinto ' . $recinto->name . ' was Re-Activated.');

		return redirect()->route('recintos.index');
	}
}
