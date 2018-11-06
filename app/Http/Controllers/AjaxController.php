<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\EspecialistaModel;

use App\Recinto;

use App\Servicio;

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

        $recintos=DB::table('recintos')->where('active_flag', '=', 1)->orderBy('descripcion','desc')->get();
        if ($recintos == null) {
            Flash::message("No hay recintos para mostrar");
        }
        return json_encode(["recintos"=>$recintos]);
}

public function comboServicios($ID_Recinto, Request $request){
    /*$query=trim($request->get('searchText'));*/

    $servicios= Recinto::findOrFail($ID_Recinto)->servicios->where('active_flag', '=', 1);

    return ["servicios"=>$servicios];
}

public function comboEspecialistas($ID_Servicio, Request $request){
    /*$query=trim($request->get('searchText'));*/

    $especialistas= Servicio::findOrFail($ID_Servicio)->especialistas->where('active_flag', '=', 1);

    return ["especialistas"=>$especialistas];
}

public function datosCita($dropRecintos, $dropServicios, $dropEspecialistas, $datepicked, Request $request){
    /*$query=trim($request->get('searchText'));*/

    //$servicios=DB::table('servicio')->where('Recinto', '=', $ID_Recinto)->get();

    //if ($servicios->isEmpty()) {
     //   Flash::error("No hay especialistas para el recinto seleccionado recinto");
     //   } else {

        $xD = $dropRecintos . ' ' . $dropServicios . ' ' . $dropEspecialistas . ' ' . $datepicked;

        DB::table('recinto')->where('ID_Recinto', '=', $dropRecintos)->get();

    return json_encode(["xD"=>$xD]);
   // }
}

}