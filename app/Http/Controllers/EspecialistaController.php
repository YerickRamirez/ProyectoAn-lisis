<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\EspecialistaModel;

use Illuminate\Support\Facades\Redirect;

use DB;

use Flash;

use Illuminate\Support\Facades\Crypt;


class EspecialistaController extends Controller
{
    public function __construct() {

    }

    /*public function show()
	{
		return view('Especialista.annadirEspecialista');
	}*/ 

    public function index(Request $request){
		if ($request) {
			/*$query=trim($request->get('searchText'));*/
            
            
		$especialistas = EspecialistaModel::where('estado', 1)->orderBy('primer_apellido_especialista', 'desc')->get();
        
        return view('Especialista.mostrarEspecialistas', ["especialistas"=>$especialistas]);


       // $especialistas = EspecialistaModel::where('estado', 1)->orderBy('primer_apellido_especialista', 'desc')->get();

       // $especialistas_data = array();
        //foreach ($especialistas as $especialista) {
         //   array_push($especialistas_data,  $especialista->bloqueo_horario);
        //}
        
       // return  ["especialistas"=>$especialistas_data];

		}
    }

    public function agregarEspecialista(Request $request)
    {
        $especialista = new EspecialistaModel();

        $especialista->Cédula = $request->cedula;

        $especialista->Nombre = $request->nombre;

        $especialista->Primer_Apellido = $request->primer_apellido;

        $especialista->Segundo_Apellido = $request->segundo_apellido;
        
        $especialista->save();

        Flash::success("Especialista " . $especialista->Nombre . " guardado satisfactoriamente");

        return redirect('especialistas');
    }

    public function eliminarEspecialista($cedulaEspecialista)
    {
        /*$placaDecrypted = Crypt::decrypt($placa);*/
        $especialista= EspecialistaModel::find($cedulaEspecialista);

        if($especialista == null) {
                Flash::error("Error, no se ha encontrado al especialista con la cédula: " + $cedulaEspecialista);
                return redirect('especialistas');
            } else {

		//$especialista->estado= estado_deshabilitado;
        //$especialista->update();

        Flash::error('Especialista eliminado satisfactoriamente.');

        return redirect('especialistas');    
    }
    }

    public function editarEspecialista($cedulaEspecialista){
        /*$placa = Crypt::decrypt($placaParam);*/
        $especialista = EspecialistaModel::find($cedulaEspecialista);

        if($especialista == null) {
            Flash::error("Error, no se ha encontrado al especialista con la cédula: " . $cedulaEspecialista);
            return redirect('especialistas');    
        } else {
            return view('Especialista.editarEspecialista',["especialistaEditar"=>$especialista, "cedEspecialista"=>$cedulaEspecialista]);
        }
}

public function actualizarEspecialista($cedula, Request $request){

    $especialista= EspecialistaModel::find($cedula);

        if($especialista == null) {
            Flash::error("Error, no se ha encontrado al especialista con la cédula: " + $cedula);
            return redirect('especialistas');    
        } else {

    $especialista->Nombre=$request->get('nombre');
    $especialista->Primer_Apellido=$request->get('primer_apellido');
    $especialista->Segundo_Apellido=$request->get('segundo_apellido');

    $especialista->update();

    Flash::success('Especialista actualizado satisfactoriamente.');

    return redirect('especialistas');    
}
}

//public function combobox(Request $request){
   // if ($request) {
        /*$query=trim($request->get('searchText'));*/
     //   $conditionForSelected = "";
        
     //   $recintos=DB::table('recinto')->orderBy('Nombre','desc')->paginate(5);
       // if ($recintos == null) {
       //     Flash::message("No hay recintos para mostrar");
       // }
       // return view('PruebaCombobox.pruebacombo', ["recintos"=>$recintos, "conditionForSelected"=>$conditionForSelected]);
   // }
//}

}
