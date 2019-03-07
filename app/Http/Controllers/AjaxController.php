<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\EspecialistaModel;

use App\Recinto;

use App\Especialista;

use App\Servicio;

use App\Estado_cita;

use Auth;

use App\Cita;

use App\Dia_bloqueo_especialista;
use App\Horarios_servicio;
use App\Recinto_servicio;

use Carbon\Carbon;

use Illuminate\Support\Facades\Redirect;

use DB;

use Flash;

use DateTimeZone;

use Illuminate\Support\Facades\Crypt;


class AjaxController extends Controller {
   public function index(){
      $msg = "This is a simple message.";
      return  $msg;
   }

   public function logoutMensajeRegistro () {
    //logout user y mandar mensaje bonito :3
    auth()->logout();
    return redirect('login')->with('success', 'Su cuenta ha sido creada exitosamente');
}


public function dropDiasBloqueo(){
    /*$query=trim($request->get('searchText'));*/

    $dias=Dia_bloqueo_especialista::where('active_flag', 1)->orderBy('id','asc')->get();

    return json_encode(["dias"=>$dias]);
}




   public function combobox(){
        /*$query=trim($request->get('searchText'));*/

        $recintos=DB::table('recintos')->where('active_flag', '=', 1)->orderBy('descripcion','desc')->get();
        if ($recintos == null || $recintos->isEmpty()) {
            Flash::message("No hay recintos para mostrar");
        }
        return json_encode(["recintos"=>$recintos]);
}

public function estadosCitas(){
    /*$query=trim($request->get('searchText'));*/

    $estado_citas=DB::table('estado_citas')->where('active_flag', '=', 1)->orderBy('id','asc')->get();
    /*if ($recintos == null || $recintos->isEmpty()) {
        Flash::message("No hay recintos para mostrar");
    }*/
    return json_encode(["estado_citas"=>$estado_citas]);
}


public function comboServicios($ID_Recinto, Request $request){
    /*$query=trim($request->get('searchText'));*/

    $servicios= Recinto_servicio::where('recinto_id', $ID_Recinto)
    ->where('recinto_servicios.active_flag', 1)
    ->join('servicios', 'recinto_servicios.servicio_id', '=', 'servicios.id')->get();

    return ["servicios"=>$servicios];
}

public function cargarEspecialistas(Request $request){
    /*$query=trim($request->get('searchText'));*/
    $especialistas= Especialista::where('active_flag', 1)->get();

    return ["especialistas"=>$especialistas];
}

public function cargarEspecialistaLoggeado(Request $request){
    /*$query=trim($request->get('searchText'));*/
    $especialistas= Especialista::where('active_flag', 1)->where('id_user', Auth::user()->id)->get();
    return ["especialistas"=>$especialistas];
}

public function cargarServicios(Request $request){
    /*$query=trim($request->get('searchText'));*/

    $servicios= Servicio::where('active_flag', 1)->get();

    return ["servicios"=>$servicios];
}

public function comboEspecialistasSinHorario($ID_Servicio, $ID_Recinto, Request $request){

    $especialistas_servicio = Servicio::where('active_flag', 1)->where('id', $ID_Servicio)->firstOrFail()
    ->especialistas;/*->where('servicios.active_flag', 1)->get();/*->where('id', $ID_Servicio)->
    firstOrFail()->especialistas;/*->where('active_flag', '=', 1);//->first()*/

    //return $especialistas_servicio_recinto;
    $especialistas_return = array();
    foreach ($especialistas_servicio as $especialista) {
       
                    if (isset($especialistas_return[$especialista->id])) {//verifica si el objeto existe en array
                        // object exists in array; do something
                    } else {
                        $especialistas_return[$especialista->id] = $especialista;
                        //esto inserta en el array pero con llave única
                    }
            }
    return ["especialistas"=> $especialistas_return];
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

        if(!$horario_servicio_esp->isEmpty()) {

            foreach ($horario_servicio_esp as $horario) {
                
                if(!empty($horario)) {
                   if($horario->id_recinto == $ID_Recinto) {
                    if (isset($especialistas_return[$especialista->id])) {//verifica si el objeto existe en array
                        // object exists in array; do something
                    } else {
                        $especialistas_return[$especialista->id] = $especialista;
                        //esto inserta en el array pero con llave única
                    }
                    
                    }
                }
            }
        }
    }
    return ["especialistas"=> $especialistas_return];
}

public function datosSugerirCita($dropRecintos, $dropServicios, $dropEspecialista){

    
    $date =  Carbon::now(new DateTimeZone('America/Costa_Rica'));
    $end_date = Carbon::now(new DateTimeZone('America/Costa_Rica'))->addDay(7);
    
    $auxDate = $date;
    $cantidadCitasDisp = 0;
    $cantidadTotalCitas = 24;
    $maxCitasSugerir = 10;
    $disponibles = array();
    $a = array();

	while ($end_date->greaterThanOrEqualTo($date)) {

       if(!$date->isWeekend()) {
        $arrayxD = json_decode($this->datosCita($dropRecintos, $dropServicios, $dropEspecialista, $date), true);
        
        foreach ($arrayxD as $elemento) {
            
            $cantidadBloqueadas = count($elemento);
            if($cantidadBloqueadas < $cantidadTotalCitas) {//Si la cantidad de blpqueadas es menor a 24
                $cantidadCitasDisp += ($cantidadTotalCitas - $cantidadBloqueadas);
                array_push($disponibles, $auxDate->format('d/m/Y'));
                    if($cantidadCitasDisp >= $maxCitasSugerir) {
                        break;
                    }
            }
            
            //array_push($a, $arrayxD);
            
            
        }

        if($cantidadCitasDisp >= $maxCitasSugerir) {
            break;
        }

        $auxDate = $date;
        }
        
        $date = $date->addDay();
    }
    return json_encode(["disponibles"=>$disponibles]);

}

/*
private function horasLibres($arrayOcupadas) {


    $horas = array('08:00, ', '08:20, ', '08:40, ', 
                          '09:00, ', '09:20, ', '09:40, ', 
                          '10:00, ', '10:20, ', '10:40, ',
                          '11:00, ', '11:20, ', '11:40, ',
                          '13:00, ', '13:20, ', '13:40, ',
                          '14:00, ', '14:20, ', '14:40, ',
                          '15:00, ', '15:20, ', '15:40, ',
                          '16:00, ', '16:20, ', '16:40, ');
    
    foreach ($arrayOcupadas as $elemento) {
        return count($elemento);
        foreach($elemento as $elementito){
            $horas = str_replace($elementito . ', ' ,  '', $horas, $count);

        if($count > 0) {
            $counter = $counter + 1;
        }
            //reemplaza las horasOcupadas, dejando así solo las horas libres para citas
        }
    }
    return $horas;
}*/

public function datosCita($dropRecintos, $dropServicios, $dropEspecialistaxD, $datepicked){

    
        $dropEspecialistas = $dropEspecialistaxD;
    
        $fechaElegidaCarbon = Carbon::createFromFormat('Y-m-d', Carbon::parse($datepicked)->format('Y-m-d'), 
        'America/Costa_Rica');//hace un string de la fecha elegida por el usuario y luego lo hace un Carbon*/
      

        $diaElegido = $fechaElegidaCarbon->dayOfWeek;
        $diaElegido2 = $fechaElegidaCarbon->dayOfWeek;

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


        $horas_manana = array("8:00", "8:20", "8:40", "9:00", "9:20", "9:40", "10:00", 
        "10:20", "10:40", "11:00", "11:20", "11:40");

        $horas_tarde = array("13:00", "13:20", "13:40", "14:00", "14:20", "14:40", "15:00", 
        "15:20", "15:40", "16:00", "16:20", "16:40");

        $fechaCitas = Cita::where('estado_cita_id', '!=', 3)->where('estado_cita_id', '!=', 4)->where('servicio_id' , $dropServicios)
        ->where('especialista_id', $dropEspecialistas)->where('recinto_id', $dropRecintos)->whereDate('fecha_cita', $fechaElegidaCarbon->toDateString())
        ->get();//citas en la fecha elegida

        //return $fechaCitas;
        //para comparara en whereDate() se le manda el atributo de BD y un string.


        $horarios_deshabilitados_esp = EspecialistaModel::findOrFail($dropEspecialistas)->horario_deshabilitado->where('active_flag', 1);
        //rango de fechas. Cosas como reuniones

        $horarios_bloqueados_esp = EspecialistaModel::findOrFail($dropEspecialistas)->bloqueo_horario->where('active_flag', 1);

        $horarios_servicios_especialista = Horarios_servicio::where('id_especialista', $dropEspecialistas)->where('id_servicio', $dropServicios)
        ->where('id_recinto', $dropRecintos)->where('active_flag', 1)->get();

        //rango de fechas bloqueando un día en específico, como los miércoles en la mañana.

        //return $horarios_bloqueados_esp;

        $horasOcupadas = array();

        if(!$fechaCitas->isEmpty()) {//citas existentes de la fecha elegidas
            foreach ($fechaCitas as $fechaCita) {
                $cualquiera=  Carbon::parse($fechaCita->fecha_cita)->format('H:i');
                if(substr($cualquiera, 0,1) == "0"){
                    array_push($horasOcupadas, substr($cualquiera, 1));
                } else {
                array_push($horasOcupadas, $cualquiera);
            }
            }
        }


        //return $horasOcupadas;

        //return json_encode(["horasOcupadas"=>$horasOcupadas]);

        if(!$horarios_deshabilitados_esp->isEmpty()) {//fecha/hora deshabilitada por el especialista reuniones etc
            foreach ($horarios_deshabilitados_esp as $deshabilitado_esp) {
                
                $fechaInicioCarbon = Carbon::createFromFormat('Y-m-d', Carbon::parse($deshabilitado_esp->fecha_inicio_deshabilitar)
                ->format('Y-m-d'), 'America/Costa_Rica')->startOfDay();

                $fechaFinCarbon = Carbon::createFromFormat('Y-m-d', Carbon::parse($deshabilitado_esp->fecha_fin_deshabilitar)
                ->format('Y-m-d'), 'America/Costa_Rica')->endOfDay();
                
                if($fechaElegidaCarbon->greaterThanOrEqualTo($fechaInicioCarbon) && $fechaElegidaCarbon->lessThanOrEqualTo($fechaFinCarbon)) {
                    $hora_inicio_deshabilitar = $this->arreglarHora(substr($deshabilitado_esp->hora_inicio_deshabilitar, 0, 5));
                    $hora_fin_deshabilitar = $this->arreglarHora(substr($deshabilitado_esp->hora_fin_deshabilitar, 0, 5));


                    //$a = $hora_inicio_deshabilitar . ' hasta las ' . $hora_fin_deshabilitar;
                    //return json_encode(["horasOcupadas"=>$a]);
                    if(!($hora_inicio_deshabilitar == $hora_fin_deshabilitar)){
                        $this->llenarArrayhoras($horasOcupadas, $hora_inicio_deshabilitar, $hora_fin_deshabilitar);
                    } else {
                        array_push($horasOcupadas, $hora_inicio_deshabilitar);
                    }
                    //return json_encode(["horasOcupadas"=>$horasOcupadas]);
                }
            }
        }// fin revisar horario_deshabilitado por reuniones

        if(!$horarios_servicios_especialista->isEmpty()) {//citas existentes de la fecha elegidas
            foreach ($horarios_servicios_especialista as $horarios_servicio) {
                if($horarios_servicio->disponibilidad_manana == 0) {
                    foreach ($horas_manana as $hora) {
                        if($diaElegido2 == $horarios_servicio->id_dia) {
                            array_push($horasOcupadas, $hora);
                        }
                    }
                }
                if($horarios_servicio->disponibilidad_tarde == 0) {
                    foreach ($horas_tarde as $hora) {
                        if($diaElegido2 == $horarios_servicio->id_dia) {
                            array_push($horasOcupadas, $hora);
                        }
                    }
                }
                
            }
        }

        if(!$horarios_bloqueados_esp->isEmpty()) {//fecha/hora deshabilitada por el especialista por miércoles administrativo etc

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

                //return $fechaInicioCarbon . ' ' .$fechaFinCarbon;
                
                    //return json_encode($fechaElegidaCarbon->greaterThanOrEqualTo($fechaFinCarbon));

                if($fechaElegidaCarbon->greaterThanOrEqualTo($fechaInicioCarbon) && $fechaElegidaCarbon->lessThanOrEqualTo($fechaFinCarbon)) {
                    $hora_inicio_deshabilitar = $this->arreglarHora(substr($bloqueado_esp->hora_inicio_bloqueo_especialista, 0, 5));
                    $hora_fin_deshabilitar = $this->arreglarHora(substr($bloqueado_esp->hora_fin_bloqueo_especialista, 0, 5));


                    //$a = $hora_inicio_deshabilitar . ' hasta las ' . $hora_fin_deshabilitar;
                    //return json_encode(["horasOcupadas"=>$a]);
                    if(!($hora_inicio_deshabilitar == $hora_fin_deshabilitar)){
                    $this->llenarArrayhoras($horasOcupadas, $hora_inicio_deshabilitar, $hora_fin_deshabilitar);
                        } else {
                            array_push($horasOcupadas, $hora_inicio_deshabilitar);
                        }
                }
                }
            }
            //return json_encode(["horasOcupadas"=>$horasOcupadas]);
        }// fin revisar horario_deshabilitado por reuniones

        $horasOcupadas = array_unique($horasOcupadas);
    return json_encode(["horasOcupadas"=>$horasOcupadas]);
   // }
}

/*
private function diferenciaMenorIgual40Minutos(&$array, $horaInicio, $horaFin) {

    $ultimos_digitos_hora_inicio  = intval(substr($horaInicio, -2));
    $ultimos_digitos_hora_fin  = intval(substr($horaFin, -2));

    $primeros_digitos_hora_inicio = substr($horaInicio, 0, 2);
    $primeros_digitos_hora_fin = substr($horaFin, 0, 2);

    if($horaInicio == $horaFin) {//if  horas iguales
        for($i = $horaInicio; $i <= $horaFin); $i+=20) {
        }
    }//fin if horas iguales


}*/

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
    //$x = "";

    //return substr($horaInicio, 0, 1);   

    $terminaExacto = false;

    if(substr($horaInicio, 0, 1) == 0) {
        $horaInicio = substr($horaInicio, 1);
    }
    if(substr($horaFin, 0, 1) == 0) {
        $horaFin = substr($horaFin, 1);
    }
    $horaInicio = str_replace(':', '', $horaInicio);
    $horaFin = str_replace(':', '', $horaFin);

    
    if(substr($horaFin, -2) == "00") {//si la hora termina en 00 había un error, este if la corrije
        $terminaExacto = true;
        $auxInicioDeHoraFin = intval(substr($horaFin, 0, 2)) - 1;
        $horaFin = $auxInicioDeHoraFin . "40";
    }
    //return $horaInicio .' '  . $horaFin;

    $horaFin = intval($horaFin);
    $i = intval($horaInicio);

    if($i < 800) {
        $i = 800; 
    }

    if($horaFin > 1700) {
        $horaFin = 1700; 
    }

    for($i; $i <= intval($horaFin); $i= $i + 20) {

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
        //////////AQUÍ ORIGINALMENTE NO VA EL IF de +20, LO PUSE DE PRUEBA ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if((($i + 20) >=  intval($horaFin)) && !$terminaExacto) {
            break;
        }
 //////////////////////////FIN IF PRUEBA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    //return $x;
}



public function horarioServicios($recinto, $servicio, $especialista, Request $request){
    $horarioServicio = Horarios_servicio::where('id_recinto', $recinto)->where('id_especialista', $especialista)
    ->where('id_servicio', $servicio)->get();//citas en la fecha elegida
    
    $horasOcupadas = array();

    if(!$horarioServicio->isEmpty()) {//citas existentes de la fecha elegidas
        foreach ($horarioServicio as $horario) {
            array_push($horasOcupadas,  $horario);
        }
    }

    $xD = $horasOcupadas;
    
    return json_encode(["horario"=>$xD]);
}

public function horarioServiciosEspecialista($recinto, $servicio, Request $request){
    $name = Auth::user()->id;
    	$especialista = DB::table('especialistas')->where('id_user', $name)
            ->select('id')->get();
		$id = $especialista->first()->id;

    $horarioServicio = Horarios_servicio::where('id_recinto', $recinto)->where('id_especialista',  $id)
    ->where('id_servicio', $servicio)->get();//citas en la fecha elegida
    
    $horasOcupadas = array();

    if(!$horarioServicio->isEmpty()) {//citas existentes de la fecha elegidas
        foreach ($horarioServicio as $horario) {
            array_push($horasOcupadas,  $horario);
        }
    }

    $xD = $horasOcupadas;
    
    return json_encode(["horario"=>$xD]);
}

public function cargarCitas() {

    $citas=DB::table('citas')->where('active_flag', '=', 1)->orderBy('fecha_cita','desc')->get();
    if ($citas == null || $citas->isEmpty()) {
        Flash::message("No hay citas para mostrar");
    }
    //return $citas;
    return json_encode(["citas"=>$citas]);
}



}