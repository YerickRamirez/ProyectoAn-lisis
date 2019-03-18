<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use DB;

use App\Cita;
use App\Correo;
use App\Telefono;
use Illuminate\Http\Request;
use \Session;
use Carbon\Carbon;
use App\Mail\SendMailable;
use App\Mail\reprogramarCitaAsistente;
use Mail;


class CitaControllerAsistente extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | CitaControllerAsistente
    |--------------------------------------------------------------------------
    | This driver is responsible for handling appointments manage by the assistant.
    |
	*/

	/**
	 * Variable to model
	 *
	 * @var cita
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Cita $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	 /**
	 * Show the current day appointments in the assistant module. 
	 */
	public function index()
	{
		$citas = $cita = DB::table('citas')//Get the current day appointments.
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.estado_cita_id', '!=',3)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->select('citas.id as id_cita',
			'citas.fecha_cita',
			'citas.estado_cita_id', 
			'pacientes.id',
			'pacientes.nombre',
			'pacientes.primer_apellido_paciente',
			'pacientes.segundo_apellido_paciente',
			'pacientes.cedula_paciente',       
			'telefonos.telefono',
			'pacientes.correo' )
			->orderBy('fecha_cita', 'asc')->get();
		return view('asistente.index', compact('citas', 'active'));

	}

	/** 
	* Return the appointments list for the assistant logged on the actual day.
	*/
	public function citaRecintoEstadoHoy($ID_Recinto, $estado)
	{

		if($estado == "5") {
			$citas = $this->citasReservadas_ConfirmadasHoy($ID_Recinto);
		} else {

		$fechaInicioCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->startOfDay(); //Change date format
		$fechaFinCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->endOfDay(); //Change date format

		$citas = $cita = DB::table('citas')->whereDate('fecha_cita', '>=', $fechaInicioCarbon)
		->whereDate('fecha_cita', '<=', $fechaFinCarbon)
		->where('recintos.id', $ID_Recinto)
		->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.estado_cita_id', $estado)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
		->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
		->select('citas.id as id_cita',
			'citas.fecha_cita',
			'citas.estado_cita_id', 
			'pacientes.id',
			'pacientes.nombre',
			'pacientes.primer_apellido_paciente',
			'pacientes.segundo_apellido_paciente',
			'pacientes.cedula_paciente',       
			'telefonos.telefono',
			'pacientes.correo',
			'recintos.descripcion',
			'especialistas.nombre as nombreEsp',
			'especialistas.primer_apellido_especialista as apellidoEsp',
			'especialistas.segundo_apellido_especialista as apellido2Esp',
			'servicios.nombre as nombreServ')
			->orderBy('fecha_cita', 'asc')->get();
		}
		return json_encode(["citas"=>$citas]);

	}

	/**
	 * Return the appointments list reserved and confirmed for the specialist logged on the actual day.
	 */
	private function citasReservadas_ConfirmadasHoy($ID_Recinto) {
		$fechaInicioCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->startOfDay(); //Change date format
		$fechaFinCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->endOfDay(); //Change date format
		$citas = $cita = DB::table('citas')->whereDate('fecha_cita', '>=', $fechaInicioCarbon)
		->whereDate('fecha_cita', '<=', $fechaFinCarbon)
		->where('recintos.id', $ID_Recinto)
		->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.estado_cita_id', '!=',3)
		->where('citas.estado_cita_id', '!=',4)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
		->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
		->select('citas.id as id_cita',
			'citas.fecha_cita',
			'citas.estado_cita_id', 
			'pacientes.id',
			'pacientes.nombre',
			'pacientes.primer_apellido_paciente',
			'pacientes.segundo_apellido_paciente',
			'pacientes.cedula_paciente',       
			'telefonos.telefono',
			'pacientes.correo',
			'recintos.descripcion',
			'especialistas.nombre as nombreEsp',
			'especialistas.primer_apellido_especialista as apellidoEsp',
			'especialistas.segundo_apellido_especialista as apellido2Esp',
			'servicios.nombre as nombreServ')
			->orderBy('fecha_cita', 'asc')->get();
			return $citas;
	}

	/**  
	* Return the appointments list from today onwards (future appointments) for the assistant.
	*/
	public function citaRecintoEstadoAPartirHoy($ID_Recinto, $estado)
	{

		if($estado == "5") {
			$citas = $this->citasReservadas_ConfirmadasPartirHoy($ID_Recinto);
		} else {

		$fechaInicioCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->startOfDay(); //Change date format

		$citas = $cita = DB::table('citas')
		->whereDate('fecha_cita', '>=', $fechaInicioCarbon)
		->where('recintos.id', $ID_Recinto)
		->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.estado_cita_id', $estado)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
		->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
		->select('citas.id as id_cita',
			'citas.fecha_cita',
			'citas.estado_cita_id', 
			'pacientes.id',
			'pacientes.nombre',
			'pacientes.primer_apellido_paciente',
			'pacientes.segundo_apellido_paciente',
			'pacientes.cedula_paciente',       
			'telefonos.telefono',
			'pacientes.correo',
			'recintos.descripcion',
			'especialistas.nombre as nombreEsp',
			'especialistas.primer_apellido_especialista as apellidoEsp',
			'especialistas.segundo_apellido_especialista as apellido2Esp',
			'servicios.nombre as nombreServ')
			->orderBy('fecha_cita', 'asc')->get();
		}
		return json_encode(["citas"=>$citas]);

	}

	/**
	 * Return the appointments list reserved and confirmed from today (future appointments) for the specialist.
	 */
	private function citasReservadas_ConfirmadasPartirHoy($ID_Recinto) {
		$fechaInicioCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->startOfDay(); //Change date format

		$citas = $cita = DB::table('citas')
		->whereDate('fecha_cita', '>=', $fechaInicioCarbon)
		->where('recintos.id', $ID_Recinto)
		->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.estado_cita_id', '!=',3)
		->where('citas.estado_cita_id', '!=',4)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
		->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
		->select('citas.id as id_cita',
			'citas.fecha_cita',
			'citas.estado_cita_id', 
			'pacientes.id',
			'pacientes.nombre',
			'pacientes.primer_apellido_paciente',
			'pacientes.segundo_apellido_paciente',
			'pacientes.cedula_paciente',       
			'telefonos.telefono',
			'pacientes.correo',
			'recintos.descripcion',
			'especialistas.nombre as nombreEsp',
			'especialistas.primer_apellido_especialista as apellidoEsp',
			'especialistas.segundo_apellido_especialista as apellido2Esp',
			'servicios.nombre as nombreServ')
			->orderBy('fecha_cita', 'asc')->get();
			return $citas;
	}

	/**  
	* Return the appointments list historic for the assistant.
	*/
		public function citaRecintoEstadoHist($ID_Recinto, $estado)
		{
			if($estado == "5") { //Appointmentslist reserved and confirmed historic for the specialist
				$citas = $this->citasReservadas_ConfirmadasHist($ID_Recinto);
			} else {
	
			$citas = $cita = DB::table('citas')
			->where('recintos.id', $ID_Recinto)
			->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
			->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
			->where('citas.estado_cita_id', $estado)
			->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
			->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
			->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
			->select('citas.id as id_cita',
				'citas.fecha_cita',
				'citas.estado_cita_id', 
				'pacientes.id',
				'pacientes.nombre',
				'pacientes.primer_apellido_paciente',
				'pacientes.segundo_apellido_paciente',
				'pacientes.cedula_paciente',       
				'telefonos.telefono',
				'pacientes.correo',
				'recintos.descripcion',
				'especialistas.nombre as nombreEsp',
				'especialistas.primer_apellido_especialista as apellidoEsp',
				'especialistas.segundo_apellido_especialista as apellido2Esp',
				'servicios.nombre as nombreServ')
				->orderBy('fecha_cita', 'asc')->get();
			}
			return json_encode(["citas"=>$citas]);
	
		}

	/**  
	* Return the appointmentslist reserved and confirmed historic for the specialist.
	*/
		private function citasReservadas_ConfirmadasHist($ID_Recinto) {
	
			$citas = $cita = DB::table('citas')
			->where('recintos.id', $ID_Recinto)
			->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
			->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
			->where('citas.estado_cita_id', '!=',3)
			->where('citas.estado_cita_id', '!=',4)
			->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
			->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
			->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
			->select('citas.id as id_cita',
				'citas.fecha_cita',
				'citas.estado_cita_id', 
				'pacientes.id',
				'pacientes.nombre',
				'pacientes.primer_apellido_paciente',
				'pacientes.segundo_apellido_paciente',
				'pacientes.cedula_paciente',       
				'telefonos.telefono',
				'pacientes.correo',
				'recintos.descripcion',
				'especialistas.nombre as nombreEsp',
				'especialistas.primer_apellido_especialista as apellidoEsp',
				'especialistas.segundo_apellido_especialista as apellido2Esp',
				'servicios.nombre as nombreServ')
				->orderBy('fecha_cita', 'asc')->get();
				return $citas;
		}

	/**
	 * Show the form for creating a new appointment.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('citas.create');
	}

	/**
	 * Store a newly created appointment in the table citas.
	 *
	 * @param Request $request are all data incoming of the new appointment.
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{	
		$paciente = DB::table('pacientes')->where('cedula_paciente', $request->cedula)
		->select('id')->get();
		if($paciente->isEmpty()) { //Check if the ID card entered exists.
				 Session::flash('message_type', 'negative');
				 Session::flash('message_icon', 'hide');
				 Session::flash('message_header', 'Success');
				 Session::flash('message', 'No existen pacientes con la cédula digitada');
				 if(Auth::user()->tipo == 3) {  //Check if it is an assistant, return the assistant view
				 return redirect('reservarCita');
				 }
				 if(Auth::user()->tipo == 2) { //Check if it is an specialist, return the specialist view
					return redirect('reservarCitaEsp');
				 }
		} else {
			$id = $paciente->first()->id;
			$cita = new Cita();
			$cita->estado_cita_id = 1;
			$cita->paciente_id = $id;
			$cita->servicio_id = $request->dropServicios;
			$cita->especialista_id = $request->dropEspecialistas;
			$cita->recinto_id = $request->dropRecintos;
			$fechaCita = Carbon::parse($request->datepicked)->format('Y-m-d'); //Change date format
			$minutosCita = substr($request->horaCita, -2);
			$horaCita = $request->horaCita[0];
			
			if($horaCita == "9" || $horaCita == "8") {
				$horaCita = "0" . $horaCita . ':' . $minutosCita;
			} else {
				$horaCita = $request->horaCita[0] . $request->horaCita[1]  . ':' . $minutosCita;
			}
			$cita->fecha_cita = $fechaCita . ' ' . $horaCita;
			$cita->active_flag = 1;

	
			$revisarCitas = $this->existenciaCitas($request);
			if($revisarCitas == "true") { //Check if someone took an appointment before.
				Session::flash('message_type', 'negative');
				Session::flash('message_icon', 'hide');
				Session::flash('message_header', 'Success');
				Session::flash('message', 'Ya existe una cita en la fecha seleccionada con el especialista seleccionado');
				if(Auth::user()->tipo == 3) {  //Check if it is an assistant, return the assistant view
					return redirect('reservarCita');
				}
				if(Auth::user()->tipo == 2) { //Check if it is an specialist, return the specialist view
					   return redirect('reservarCitaEsp');
				}
			} else {
				$paciente = DB::table('pacientes')->where('pacientes.id', $cita->paciente_id)
				->first();
				$nombre = $paciente->nombre;
				$email = $paciente->correo;
				$fecha = Carbon::parse($fechaCita)->format('d/m/Y'); //Change date format
				$especialista = DB::table('especialistas')->where('especialistas.id', $request->dropEspecialistas)
				->first();
				$especialista = $especialista->nombre . " " . $especialista->primer_apellido_especialista;
				$recinto = DB::table('recintos')->where('recintos.id', $request->dropRecintos)
				->first();
				$recinto = $recinto->descripcion;
				
				//This code change the military time to normal time to be send in the reserved appointment mail.
				$hora =  Carbon::parse($cita->fecha_cita)->format('H');
				$horaFormato =  Carbon::parse($cita->fecha_cita)->format('H');
				$minuto =  Carbon::parse($cita->fecha_cita)->format('i');
				if($hora == "13") {
					$hora = "01";
				} else if($hora == "14") {
					$hora = "02";
				} else if($hora == "15") {
					$hora = "03";
				} else if($hora == "16") {
					$hora = "04";
				} else if($hora == "17") {
					$hora = "05";
				}

				if($horaFormato > "12") {
					$hora = $hora . ":" . $minuto . " pm";
				} else {
					$hora = $hora . ":" . $minuto . " am";
				}
				
				$cita->save();
				Mail::to($email)->send(new SendMailable($nombre, $fecha, $hora, $recinto, $especialista)); //Send appointment reservation mail
				 
				 Session::flash('message_type', 'negative');
				 Session::flash('message_icon', 'hide');
				 Session::flash('message_header', 'Success');
				 Session::flash('message', 'Cita para el ' . $fecha . ' a las ' . $horaCita . ' reservada existosamente'); //shows appointment message successfully reserved
				if(Auth::user()->tipo == 3) { //Check if it is an assistant, return the assistant view
					return redirect()->route('asistente.index');
				}
				if(Auth::user()->tipo == 2) { //Check if it is an specialist, return the specialist view
					return redirect()->route('Especialista.index');
				}
				}
		}
	}

	/**
	 * Check if someone took an appointment before.
	 * @param Request $request are all data incoming of the new appointment.
	 */
		private function existenciaCitas(Request $request) { 
			$fechaCita = Carbon::parse($request->datepicked)->format('Y-m-d'); //Change date format
			$minutosCita = substr($request->horaCita, -2);
			$horaCita = $request->horaCita[0];
			if($horaCita == "9" || $horaCita == "8") {
				$horaCita = "0" . $horaCita . ':' . $minutosCita;
			} else {
				$horaCita = $request->horaCita[0] . $request->horaCita[1]  . ':' . $minutosCita;
			}
			$fecha_cita = $fechaCita . ' ' . $horaCita . ':' . '00';
			$citas = Cita::where('fecha_cita',  $fecha_cita)
			->where('active_flag', 1)
			->where('estado_cita_id', '!=', 3)
			->where('estado_cita_id', '!=', 4)
			->where('especialista_id', $request->dropEspecialistas)
			->get();
	
			if(!$citas->isEmpty()) {
				return "true";
			} else {
				return "false";
			}
		}

		/**
		 * Allows you to reschedule a patient's appointment.
		 * @param Request $request are all data incoming of the new appointment.
		 */
		public function reprogramarCita(Request $request, User $user)
		{
			$paciente = DB::table('pacientes')->where('cedula_paciente', $request->cedula)
			->select('id')->get();
			if($paciente->isEmpty()) { //Check if the ID card entered exists.
				Session::flash('message_type', 'negative');
				 Session::flash('message_icon', 'hide');
				 Session::flash('message_header', 'Success');
				 Session::flash('message', 'No existen pacientes con la cédula digitada');
				 return redirect('reservarCita');
			} else {
				$id = $paciente->first()->id;
				$cita = new Cita();
			
				$cita->estado_cita_id = 4;
				$cita->paciente_id = $id;
				$cita->servicio_id = $request->dropServicios;
				$cita->especialista_id = $request->dropEspecialistas;
				$cita->recinto_id = $request->dropRecintos;
				$fechaCita = Carbon::parse($request->datepicked)->format('Y-m-d'); //Change date format
				$minutosCita = substr($request->horaCita, -2);
				$horaCita = $request->horaCita[0];
				if($horaCita == "9" || $horaCita == "8") {
					$horaCita = "0" . $horaCita . ':' . $minutosCita;
				} else {
					$horaCita = $request->horaCita[0] . $request->horaCita[1]  . ':' . $minutosCita;
				}
				$cita->fecha_cita = $fechaCita . ' ' . $horaCita;
				$cita->active_flag = 1;

				$revisarCitas = $this->existenciaCitas($request);
				 if($revisarCitas == "true") {//Check if someone took an appointment before.
				 Session::flash('message_type', 'negative');
				 Session::flash('message_icon', 'hide');
				 Session::flash('message_header', 'Success');
				 Session::flash('message', 'Ya existe una cita en la fecha seleccionada con el especialista seleccionado');
				 return redirect('reservarCita');
				 } else {
				 $cita->save();
				 return redirect()->route('asistente.index');
			}
			}
		}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Cita $cita)
	{
		//$cita = $this->model->findOrFail($id);

		return view('citas.show', compact('cita'));
	}

	/**
	 * Remove the specified appointment from storage.
	 *
	 * @param  Cita $cita
	 * @return Response
	 */
	public function destroy(Cita $cita)
	{
		$cita->active_flag = 0;
		$cita->estado_cita_id = 3;
		$cita->save();
		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Cita ' . $cita->name . ' was De-Activated.');
		return redirect()->route('asistente.index');
	}

	/**
	* Allows you to reschedule a patient's appointment.
	* @param Request $request are all data incoming of the new appointment.
	*/
	public function reprogramarCitaAsistente(Request $request, User $user)
	{
		
		$paciente = DB::table('pacientes')->where('cedula_paciente', $request->cedula)
		->select('id')->get();
		if($paciente->isEmpty()) {
				 Session::flash('message_type', 'negative');
				 Session::flash('message_icon', 'hide');
				 Session::flash('message_header', 'Success');
				 Session::flash('message', 'No existen pacientes con la cédula digitada');
				 return redirect('reservarCita');
		} else {
			$id = $paciente->first()->id;
			$cita = new Cita();
			
			$cita->estado_cita_id = 1;
			$cita->paciente_id = $id;
			$cita->servicio_id = $request->dropServicios;
			$cita->especialista_id = $request->dropEspecialistas;
			$cita->recinto_id = $request->dropRecintos;
			$fechaCita = Carbon::parse($request->datepicked)->format('Y-m-d'); //Change date format
			$minutosCita = substr($request->horaCita, -2);
			$horaCita = $request->horaCita[0];
			if($horaCita == "9" || $horaCita == "8") {
				$horaCita = "0" . $horaCita . ':' . $minutosCita;
			} else {
				$horaCita = $request->horaCita[0] . $request->horaCita[1]  . ':' . $minutosCita;
			}
			$cita->fecha_cita = $fechaCita . ' ' . $horaCita;
			$cita->active_flag = 1;
	
				 $revisarCitas = $this->existenciaCitas($request);
				 if($revisarCitas == "true") { //Check if someone took an appointment before.
				 Session::flash('message_type', 'negative');
				 Session::flash('message_icon', 'hide');
				 Session::flash('message_header', 'Success');
				 Session::flash('message', 'Ya existe una cita en la fecha seleccionada con el especialista seleccionado');
				 return redirect('reservarCita');
				 } else {

				$paciente = DB::table('pacientes')->where('pacientes.id', $cita->paciente_id)
				->first();
				$nombre = $paciente->nombre;
				$email = $paciente->correo;
				$fecha = Carbon::parse($fechaCita)->format('d/m/Y'); //Change date format	
				
				$especialista = DB::table('especialistas')->where('especialistas.id', $request->dropEspecialistas)
				->first();
				$especialista = $especialista->nombre . " " . $especialista->primer_apellido_especialista;
				$recinto = DB::table('recintos')->where('recintos.id', $request->dropRecintos)
				->first();
				$recinto = $recinto->descripcion;
				
				//This code change the military time to normal time to be send in the reschedule appointment mail.
				$hora =  Carbon::parse($cita->fecha_cita)->format('H');
				$horaFormato =  Carbon::parse($cita->fecha_cita)->format('H');
				$minuto =  Carbon::parse($cita->fecha_cita)->format('i');
				if($hora == "13") {
					$hora = "01";
				} else if($hora == "14") {
					$hora = "02";
				} else if($hora == "15") {
					$hora = "03";
				} else if($hora == "16") {
					$hora = "04";
				} else if($hora == "17") {
					$hora = "05";
				}

				if($horaFormato > "12") {
					$hora = $hora . ":" . $minuto . " pm";
				} else {
					$hora = $hora . ":" . $minuto . " am";
				}
				
				Mail::to($email)->send(new reprogramarCitaAsistente($nombre, $fecha, $hora, $recinto, $especialista)); //Send appointment rescheduling mail
				 $cita->save();
				 return redirect()->route('asistente.index');
				 }
		}
	}
}
