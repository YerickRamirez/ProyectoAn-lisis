<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\EspecialistaModel;

use App\Recinto;

use App\Servicio;

use App\Cita;

use Carbon\Carbon;

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
        if ($recintos == null || empty($recintos)) {
            Flash::message("No hay recintos para mostrar");
        }
        return json_encode(["recintos"=>$recintos]);
}

public function comboServicios($ID_Recinto, Request $request){
    /*$query=trim($request->get('searchText'));*/

    $servicios= Recinto::findOrFail($ID_Recinto)->servicios->where('active_flag', '=', 1);

    return ["servicios"=>$servicios];
}

public function comboEspecialistas($ID_Servicio, $ID_Recinto, Request $request){
    /*$query=trim($request->get('searchText'));*/
    return ["especialistas"=> Servicio::findOrFail($ID_Servicio)->especialistas];
    $especialistas_servicio = Servicio::findOrFail($ID_Servicio)->where('active_flag', '=', 1)->first()
    ->especialistas->where('active_flag', '=', 1);
    return ["especialistas"=> $especialistas_servicio];

    $especialistas_return = array();
    foreach ($especialistas_servicio as $especialista) {
       
        $horario_servicio_esp = $especialista->horarios_servicios->where
        ('active_flag', '=', 1)->where('id_servicio' , $ID_Servicio);
        
        //return ["especialistas"=> $horario_servicio_esp];

        if(!empty($horario_servicio_esp)) {

            foreach ($horario_servicio_esp as $horario) {
                
                if(!empty($horario)) {
                   // if($horario->id_recinto == $ID_Recinto) {
                    array_push($especialistas_return,  $especialista);
                    //}
                }
            }
        }
    }
    return ["especialistas"=> $especialistas_return];
}

public function datosCita($dropRecintos, $dropServicios, $dropEspecialistaxD, $datepicked, Request $request){

    
        $dropEspecialistas = $request->dropEspecialistas;
    
        $newDate = Carbon::parse($datepicked)->format('Y-m-d');

        $fechaCitas = Cita::whereDate('fecha_cita', $newDate)->get();//citas en la fecha elegida

        $horarios_deshabilitados_esp = EspecialistaModel::findOrFail($dropEspecialistas)->horario_deshabilitado;

        $horasOcupadas = array();

        if(!empty($fechaCitas)) {//citas existentes de la fecha elegidas
            foreach ($fechaCitas as $fechaCita) {
                $cualquiera=  Carbon::parse($fechaCita->fecha_cita)->format('H:i');
                array_push($horasOcupadas, $cualquiera);
            }
        }

        return json_encode(["horasOcupadas"=>$horasOcupadas]);

        if(!empty($horarios_deshabilitados_esp)) {//fecha/hora deshabilitada por el especialista 
            foreach ($horarios_deshabilitados_esp as $deshabilitado_esp) {
                $carb_inicio = Carbon::parse($deshabilitado_esp->fecha_inicio_deshabilitar)->format('Y-m-d');//fecha inicio deshabilitar
                $carb_fin = Carbon::parse($deshabilitado_esp->fecha_fin_deshabilitar)->format('Y-m-d');
                
                if($newDate->greaterThanOrEqualTo($carb_inicio) && $newDate->lessThanOrEqualTo($carb_inicio)) {
                    $hora_inicio_deshabilitar = arreglarHora($deshabilitado_esp->hora_inicio_deshabilitar);
                    $hora_fin_deshabilitar = arreglarHora($deshabilitado_esp->hora_fin_deshabilitar);
                   
                        array_push($horasOcupadas,  Carbon::parse($deshabilitado_esp->fecha_cita)->format('H:i:s'));
                    
                }
            }
        }

        /*$users = DB::table('users')
                    ->whereBetween('votes', array(1, 100))->get(); */

        //$xD = /*$dropRecintos . ' ' . $dropServicios . ' ' . $dropEspecialistas . ' ' . $newDate . ' ' .*/ $horasOcupadas;

    return json_encode(["horasOcupadas"=>$horasOcupadas]);
   // }
}

private function arreglarHora($hora) {

    $ultimos_digitos_hora  = substr($hora, -2);

    if($ultimos_digitos_hora != 00 && $ultimos_digitos_hora != 20 && $ultimos_digitos_hora != 40) {

    if($ultimos_digitos_hora < 20) {
        $nuevosMins = "20";
        $nuevaHora = strtotime(substr($hora, 0, 3) . $nuevosMins);
        $date = date('H:i' , $nuevaHora);
        return $date;

    } elseif ($ultimos_digitos_hora < 40) {
        $nuevosMins = "40";
        $nuevosMins = "20";
        $nuevaHora = strtotime(substr($hora, 0, 3) . $nuevosMins);
        $date = date('H:i' , $nuevaHora);
        return $date;

    } elseif ($ultimos_digitos_hora > 40) {
        $nuevaHora = strtotime(substr($hora, 0, 3) . "00") + 60*60;
        $date = date('H:i' , $nuevaHora);
        return $date;
    }
} else {
    return $hora;
}

   /* $ultimos_digitos_hora  = substr($hora, -2);

    if(substr($ultimos_digitos_hora, -1) != "0") { //Obliga los minutos a terminar en 0 
    $ultimos_digitos_hora  = substr($ultimos_digitos_hora, 1) . "0";
    } 
    $int_ultimos_digitos = intval($ultimos_digitos_hora);
    while($int_ultimos_digitos != 0 || $int_ultimos_digitos != 20 || $int_ultimos_digitos != 40 || $int_ultimos_digitos != 60) {
        $int_ultimos_digitos = $int_ultimos_digitos+5;
    }
    $ultimos_digitos_correctos = $int_ultimos_digitos; 

    if($int_ultimos_digitos == 60) {
        if($primeros_dos_digitos = "09"){
            return "10:" . $ultimos_digitos_correctos;
        } else {//si la hora no es 09
        $primer_digito =  substr($hora, 1);
        $primeros_dos_digitos = substr($hora, 2);
        $segundo_digito_int =  intval(substr($primeros_dos_digitos, -1));
        //$horaParse = strtotime($primer_digito . ':' . $segundo_digito_int+1 . $ultimos_digitos_correctos);
        //$horaReturn = date('H:i', $horaParse);
        $horaReturn = $primer_digito . ':' . $segundo_digito_int+1 . $ultimos_digitos_correctos;
        return $horaReturn;
        }
    } else {
        $primeros_dos_digitos = substr($hora, 2);
        $horaReturn = $primeros_dos_digitos . ':' . $ultimos_digitos_correctos;
        return $horaReturn;
    }*/
}

private function llenarArrayhoras($array, $horaInicio, $horaFin) {
    /*$timeInicio = strtotime('horaInicio');
    $timeFin = strtotime('horaFin');
    $parseTime = date('H:i', $timestamp);
    for() {

    }*/
}
}