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


class AjaxController extends Controller {
   public function index(){
      $msg = "This is a simple message.";
      return  $msg;
   }

   public function combobox(){
        /*$query=trim($request->get('searchText'));*/

        $recintos=DB::table('recinto')->orderBy('Nombre','desc')->paginate(5);
        if ($recintos == null) {
            Flash::message("No hay recintos para mostrar");
        }
        return json_encode(["recintos"=>$recintos]);
}

public function comboEspecialistas($ID_Servicio, Request $request){
    /*$query=trim($request->get('searchText'));*/

    $especialistas=DB::table('servicio_especialista')->where('Servicio', '=', $ID_Servicio)->get();

    if ($especialistas->isEmpty()) {
        return view('PruebaCombobox.pruebacombo');
        } else {

    $especialistas_data = array();
    //array_shift($recinto_especialista2); //elimina primer elemento array, le hace return
    foreach ($especialistas as $especialista) {
        $cedulaEsp=$especialista->Especialista;
        array_push($especialistas_data,  DB::table('especialista')->where('Cédula', '=', $cedulaEsp)->get());
    }
    return ["especialistas"=>$especialistas_data];

    }
}

public function comboServicios($ID_Recinto, Request $request){
    /*$query=trim($request->get('searchText'));*/

    $servicios=DB::table('servicio')->where('Recinto', '=', $ID_Recinto)->get();

    if ($servicios->isEmpty()) {
        Flash::error("No hay especialistas para el recinto seleccionado recinto");
        } else {

    return ["servicios"=>$servicios];
    }
}

public function datosCita($dropRecintos, $dropServicios, $dropEspecialistas, $datepicked, Request $request){
    /*$query=trim($request->get('searchText'));*/

    //$servicios=DB::table('servicio')->where('Recinto', '=', $ID_Recinto)->get();

    //if ($servicios->isEmpty()) {
     //   Flash::error("No hay especialistas para el recinto seleccionado recinto");
     //   } else {

        $xD = $dropRecintos . ' ' . $dropServicios . ' ' . $dropEspecialistas . ' ' . $datepicked;
    return json_encode(["xD"=>$xD]);
   // }
}

}