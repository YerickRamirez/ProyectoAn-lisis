<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use DB;

use Mail;
use App\Mail\confirmarCita;
use App\Mail\EnviarCanceacion;
use App\Mail\reprogramarCitaAsistente;
use App\Cita;
use App\Correo;
use App\Telefono;
use App\Paciente;
use Illuminate\Http\Request;
use \Session;
use Carbon\Carbon;


class CitaControllerEspecialista extends Controller
{

	/*
    |--------------------------------------------------------------------------
    | CitaControllerEspecialista
    |--------------------------------------------------------------------------
    | This driver is responsible for handling appointments manage by the specialist.
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
	 * Show the current day appointments in the specialist module. 
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('Especialista.index');
	}

	/**
	 * Return the appointments list reserved and confirmed for the specialist logged on the actual day.
	 */
	public function citaRecintoDia($ID_Recinto)
	{
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
		->where('especialistas.id_user', Auth::user()->id)
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
		return json_encode(["citas"=>$citas]);

	}

	/**
	 * Return the appointments list reserved and confirmed from today (future appointments) for the specialist.
	 */
	public function citaRecintoAPartirHoy($ID_Recinto)
	{
		$fechaInicioCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->startOfDay(); //Change date format

		$citas = $cita = DB::table('citas')->whereDate('fecha_cita', '>=', $fechaInicioCarbon)
		->where('recintos.id', $ID_Recinto)
		->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.estado_cita_id', '!=',3)
		->where('citas.estado_cita_id', '!=',4)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
		->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
		->where('especialistas.id_user', Auth::user()->id)
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
		return json_encode(["citas"=>$citas]);

	}

	/**  
	* Return the appointmentslist reserved and confirmed historic for the specialist.
	*/
	public function historicoCitasActivasRecinto($ID_Recinto)
	{
		$citas = $cita = DB::table('citas')
		->where('recintos.id', $ID_Recinto)
		->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.estado_cita_id', '!=',3)
		->where('citas.estado_cita_id', '!=',4)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
		->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
		->where('especialistas.id_user', Auth::user()->id)
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
		return json_encode(["citas"=>$citas]);

	}
	


	/**
	 * Store a newly created appointment in storage.
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
				 return back();
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
				return back();
				} else {
				$cita->save();
				return back();
			}
		}
		
		}

		/**
		 * Check if someone took an appointment before.
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
			//return $fecha_cita;
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
				return back();		
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
				 return back();
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
					
				 Mail::to($email)->send(new reprogramarCitaAsistente($nombre, $fecha, $hora, $recinto, $especialista));  //Send the email rescheduling the appointment.
				 $cita->save();
				 return back();
				}
				}
		}

		/**
		 * Allows you to reschedule a patient's appointment.
		 * @param Cita $cita are all data incoming of the new appointment.
		 */
		public function reprogramar(Cita $cita)
		{
			$citas = DB::table('citas')
			->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
			->select('pacientes.cedula_paciente')->get();	
			$cedula = $citas->first()->cedula_paciente;
			$cita->active_flag = 0;
			$cita->save();
			return view('Especialista.reprogramarCitaEspecialista', compact('cedula'));
			}

			public function confirmar(Cita $cita)
			{
				$cita->estado_cita_id = 2;
				$cita->save();
				return redirect()->route('Especialista.index');
			}

			/**
		 	* Allows you to confirm a patient's appointment.
		 	* $id_cita are the id of appointment incoming to be confirmed.
		 	*/
			public function confirmarCitaAjax($id_cita)
			{
				$cita = Cita::find($id_cita);
				$paciente = DB::table('pacientes')->where('pacientes.id', $cita->paciente_id)
				->first();
				$nombre = $paciente->nombre;
				$email = $paciente->correo;
				$fecha = Carbon::parse($cita->fecha_cita)->format('d/m/Y'); //Change date format

				$especialista = DB::table('especialistas')->where('especialistas.id', $cita->especialista_id)
				->first();
				$especialista = $especialista->nombre . " " . $especialista->primer_apellido_especialista;
				$recinto = DB::table('recintos')->where('recintos.id', $cita->recinto_id)
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
				Mail::to($email)->send(new confirmarCita($nombre, $fecha, $hora, $recinto, $especialista));
				$cita->estado_cita_id = 2;
				$cita->save();
		
				return back();
			}

			/**
		 	* Allows you to reschedule a patient's appointment.
		 	* $id_cita are the id of appointment incoming to be reschedule.
		 	*/
			public function reprogramarCitaAjax($id_cita)
			{
				$cita = Cita::find($id_cita);
				$cita->estado_cita_id = 4;
				$cita->save();

			$citas = Cita::where('citas.id', $id_cita)
			->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
			->select('pacientes.cedula_paciente');	
			$cedula = $citas->first()->cedula_paciente;

			if(Auth::user()->tipo == 2) {
				return view('Especialista.reprogramarCitaEspecialista', compact('cedula'));
			}
			if(Auth::user()->tipo == 3) {
				return view('asistente.reprogramarCita', compact('cedula'));
			}
		}

		
		/**
	 	* Remove an specified appointment from storage.
	 	*
	 	* $id_cita are the id of appointment incoming to be canceled.
	 	* @return Response
	 	*/
		public function cancelarCitaAjax($id_cita)
		{
		$cita = Cita::find($id_cita);
		$cita->estado_cita_id = 3;
		
		$paciente = DB::table('pacientes')->where('pacientes.id', $cita->paciente_id)
		->first();
		$nombre = $paciente->nombre;
		$email = $paciente->correo;
		$fecha = Carbon::parse($cita->fecha_cita)->format('d/m/Y'); //Change date format
		
		//This code change the military time to normal time to be send in the canceled appointment mail.
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

		$especialista = DB::table('especialistas')->where('especialistas.id', $cita->especialista_id)
		->first();
		$especialista = $especialista->nombre . " " . $especialista->primer_apellido_especialista;
		$recinto = DB::table('recintos')->where('recintos.id', $cita->recinto_id)
		->first();
		$recinto = $recinto->descripcion;
		
		Mail::to($email)->send(new EnviarCanceacion($nombre, $fecha, $hora, $recinto, $especialista)); //Send appointment cancellation mail.

		$cita->save();

		return back();
	}

	/**
	 * Display the specified appointment.
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Cita $cita)
	{
		$cita->active_flag = 0;
		$cita->estado_cita_id = 3;
		$cita->save();
		return redirect()->route('Especialista.index');
	}

	
}
