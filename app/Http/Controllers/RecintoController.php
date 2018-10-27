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

    public function editarRecinto($idRecinto){
        /*$placa = Crypt::decrypt($placaParam);*/
        $recinto = Recinto::find($idRecinto);

        if($recinto == null) {
            Flash::error("Error, no se ha encontrado al especialista con la cédula: " . $idRecinto);
            return redirect('recintos');    
        } else {
            return view('Recinto.editarRecinto',["recintoEditar"=>$recinto, "idRecintos"=>$idRecinto]);
        }
	}	

	
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

    public function actualizarRecinto($id, Request $request){

    $recinto= Recinto::find($id);

        if($recinto == null) {
            Flash::error("Error, no se ha encontrado el recinto con el identificador: " + $id);
            return redirect('recintos');    
        } else {

    $recinto->Nombre=$request->get('nombre');

    $recinto->update();

    Flash::success('Recinto actualizado satisfactoriamente.');

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
