<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\EspecialistaModel;

use App\Recinto;

use App\Servicio;

use App\Cita;

use App\Dia_bloqueo_especialista;
use App\Horarios_servicio;

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

    $servicios= Recinto::where('active_flag', 1)->where('id', $ID_Recinto)->
    firstOrFail()->servicios->where('active_flag', '=', 1);

    return ["servicios"=>$servicios];
}

public function comboEspecialistas($ID_Servicio, $ID_Recinto, Request $request){

    // return ["especialistas"=> Servicio::findOrFail($ID_Servicio)->especialistas->where('active_flag', '=', 1)];
    $especialistas_servicio = Servicio::where('active_flag', 1)->where('id', $ID_Servicio)->
    firstOrFail()->especialistas->where('active_flag', '=', 1);//->first()
    //->especialistas->where('active_flag', '=', 1);
    //return ["especialistas"=> $especialistas_servicio];

    $especialistas_return = array();
    foreach ($especialistas_servicio as $especialista) {
       
        $horario_servicio_esp = $especialista->horarios_servicios->where
        ('active_flag', '=', 1)->where('id_servicio' , $ID_Servicio);
        
        //return ["especialistas"=> $horario_servicio_esp];

        if(!empty($horario_servicio_esp)) {

            foreach ($horario_servicio_esp as $horario) {
                
                if(!empty($horario)) {
                   if($horario->id_recinto == $ID_Recinto) {
                    array_push($especialistas_return,  $especialista);
                    }
                }
            }
        }
    }
    return ["especialistas"=> $especialistas_return];
}

public function datosCita($dropRecintos, $dropServicios, $dropEspecialistaxD, $datepicked, Request $request){

    
        $dropEspecialistas = $request->dropEspecialistas;
    
        $fechaElegidaCarbon = Carbon::createFromFormat('Y-m-d', Carbon::parse($datepicked)->format('Y-m-d'), 
        'America/Costa_Rica');//hace un string de la fecha elegida por el usuario y luego lo hace un Carbon*/
      

        $diaElegido = $fechaElegidaCarbon->dayOfWeek;

                switch ($diaElegido) {
                    case 1:
                    $diaElegido = "LUNES";
                        break;
                    case 2:
                    $diaElegido = "MARTES";
                        break;
                    case 3:
                    $diaElegido = "MIéRCOLES";//no tocar, dejar la 'é'
                        break;
                    case 4:
                    $diaElegido = "JUEVES";
                        break;
                    case 5:
                    $diaElegido = "VIERNES";
                        break;
                    default:
                    abort(404, 'Día de la semana no válido. La oficina ofrece citas de Lunes a Viernes');
                }

        $fechaCitas = Cita::whereDate('fecha_cita', $fechaElegidaCarbon->toDateString())->get();//citas en la fecha elegida
        //return $fechaCitas;
        //para comparara en whereDate() se le manda el atributo de BD y un string.


        $horarios_deshabilitados_esp = EspecialistaModel::findOrFail($dropEspecialistas)->horario_deshabilitado->where('active_flag', 1);
        //rango de fechas. Cosas como reuniones

        $horarios_bloqueados_esp = EspecialistaModel::findOrFail($dropEspecialistas)->bloqueo_horario->where('active_flag', 1);
        //rango de fechas bloqueando un día en específico, como los miércoles en la mañana.

        //return $horarios_bloqueados_esp;

        $horasOcupadas = array();

        if(!empty($fechaCitas)) {//citas existentes de la fecha elegidas
            foreach ($fechaCitas as $fechaCita) {
                $cualquiera=  Carbon::parse($fechaCita->fecha_cita)->format('H:i');
                array_push($horasOcupadas, $cualquiera);
            }
        }

        //return json_encode(["horasOcupadas"=>$horasOcupadas]);

        if(!empty($horarios_deshabilitados_esp)) {//fecha/hora deshabilitada por el especialista reuniones etc
            foreach ($horarios_deshabilitados_esp as $deshabilitado_esp) {
                
                $fechaInicioCarbon = Carbon::createFromFormat('Y-m-d', Carbon::parse($deshabilitado_esp->fecha_inicio_deshabilitar)
                ->format('Y-m-d'), 'America/Costa_Rica')->startOfDay();

                $fechaFinCarbon = Carbon::createFromFormat('Y-m-d', Carbon::parse($deshabilitado_esp->fecha_fin_deshabilitar)
                ->format('Y-m-d'), 'America/Costa_Rica')->endOfDay();
                
                if($fechaElegidaCarbon->greaterThanOrEqualTo($fechaInicioCarbon) && $fechaElegidaCarbon->lessThanOrEqualTo($fechaFinCarbon)) {
                    $hora_inicio_deshabilitar = $this->arreglarHora(substr($deshabilitado_esp->hora_inicio_deshabilitar, 0, 5));
                    $hora_fin_deshabilitar = $this->arreglarHora(substr($deshabilitado_esp->hora_fin_deshabilitar, 0, 5));


                    $a = $hora_inicio_deshabilitar . ' hasta las ' . $hora_fin_deshabilitar;
                    //return json_encode(["horasOcupadas"=>$a]);
                    $this->llenarArrayhoras($horasOcupadas, $hora_inicio_deshabilitar, $hora_fin_deshabilitar);

                    //return json_encode(["horasOcupadas"=>$horasOcupadas]);
                }
            }
        }// fin revisar horario_deshabilitado por reuniones


        if(!empty($horarios_bloqueados_esp)) {//fecha/hora deshabilitada por el especialista por miércoles administrativo etc

            foreach ($horarios_bloqueados_esp as $bloqueado_esp) {
                
                /*Servicio::where('active_flag', 1)->where('id', $ID_Servicio)->firstOrFail()->especialistas->where('active_flag', '=', 1)*/
                $diaBloqueado = Dia_bloqueo_especialista::findOrFail($bloqueado_esp->id_dia_bloqueo_especialistas);
                //return $diaBloqueado;
                $diaBloqueado = strtoupper($diaBloqueado->dia);
                if($diaBloqueado == "MIÉRCOLES" || $diaBloqueado == "MIERCOLES") {
                    $diaBloqueado = "MIéRCOLES";
                }
                //return $diaBloqueado;
                if($diaBloqueado == $diaElegido) {

                $fechaInicioCarbon = Carbon::createFromFormat('Y-m-d', Carbon::parse($bloqueado_esp->fecha_inicio_bloqueo_especialista)
                ->format('Y-m-d'), 'America/Costa_Rica')->startOfDay();

                $fechaFinCarbon = Carbon::createFromFormat('Y-m-d', Carbon::parse($bloqueado_esp->fecha_fin_bloqueo_especialista)
                ->format('Y-m-d'), 'America/Costa_Rica')->endOfDay();
                
                if($fechaElegidaCarbon->greaterThanOrEqualTo($fechaInicioCarbon) && $fechaElegidaCarbon->lessThanOrEqualTo($fechaFinCarbon)) {
                    $hora_inicio_deshabilitar = $this->arreglarHora(substr($bloqueado_esp->hora_inicio_bloqueo_especialista, 0, 5));
                    $hora_fin_deshabilitar = $this->arreglarHora(substr($bloqueado_esp->hora_fin_bloqueo_especialista, 0, 5));


                    //$a = $hora_inicio_deshabilitar . ' hasta las ' . $hora_fin_deshabilitar;
                    //return json_encode(["horasOcupadas"=>$a]);
                    $this->llenarArrayhoras($horasOcupadas, $hora_inicio_deshabilitar, $hora_fin_deshabilitar);

                }
                }
            }
            return json_encode(["horasOcupadas"=>$horasOcupadas]);
        }// fin revisar horario_deshabilitado por reuniones

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

private function llenarArrayhoras(&$array, $horaInicio, $horaFin) {
    $x = "";

    //return substr($horaInicio, 0, 1);   
    if(substr($horaInicio, 0, 1) == 0) {
        $horaInicio = substr($horaInicio, 1);
    }
    if(substr($horaFin, 0, 1) == 0) {
        $horaFin = substr($horaFin, 1);
    }
    $horaInicio = str_replace(':', '', $horaInicio);
    $horaFin = str_replace(':', '', $horaFin);
    //return $horaInicio .' '  . $horaFin;

    $horaFin = intval($horaFin);
    $i = intval($horaInicio);

    if($i < 800) {
        $i = 800; 
    }

    if($horaFin > 1700) {
        $horaFin = 1700; 
    }

    for($i; $i <= intval($horaFin); $i+=20) {
        if(substr($i, 1) == "60" || substr($i, 2) == "60") {
        $i = $i + 40;
        }
        if($i != 1200 && $i != 1220 && $i != 1240) {//horas de almuerzo
        if(strlen($i) == 3) {//si es una hora de 3 dígitos como 8:00
            $varInsert = substr_replace($i, ":" ,1,2) . substr($i, 1);
            //reemplazar aquí para poner los ":"
        }
        if(strlen($i) == 4) {//si es una hora de 4 dígitos como 13:00
            $varInsert = substr_replace($i, ":" ,2,2) . substr($i, 2);
        }
        array_push($array, $varInsert);
        //$x = $x . ' ' . $varInsert;
    }
    }
    //return $x;
}



public function horarioServicios($recinto, $servicio, $especialista, Request $request){
    $horarioServicio = Horarios_servicio::where('id_recinto', $recinto)->where('id_especialista', $especialista)
    ->where('id_servicio', $servicio)->get();//citas en la fecha elegida
    
    $horasOcupadas = array();

    if(!empty($horarioServicio)) {//citas existentes de la fecha elegidas
        foreach ($horarioServicio as $horario) {
            array_push($horasOcupadas,  $horario);
        }
    }

    $xD = $horasOcupadas;
    
    return json_encode(["horario"=>$xD]);
}



}