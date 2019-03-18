<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\Mail\SendMailable;
use App\Mail\EnviarCanceacion;
use App\User;
use DB;
use Auth;

use App\Cita;
use Illuminate\Http\Request;
use \Session;
use Carbon\Carbon;
use App\Paciente;

class CitaController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | CitaController
    |--------------------------------------------------------------------------
    | This driver is responsible for handling appointments reserved and deleted by patients.
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
	 * Display a listing of the appointments of the patient.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Auth::check()) { //To determine if the user is already logged which will return true if the user is authenticated.
			Session::flash('message_type', 'negative');
			Session::flash('message_icon', 'hide');
			Session::flash('message_header', 'Failure');
			Session::flash('info', 'Debe iniciar sesión');
			return redirect('/login'); 
		}

		if(Auth::user()->tipo < 4) {
			Session::flash('message_type', 'negative');
			Session::flash('message_icon', 'hide');
			Session::flash('message_header', 'Failure');
			Session::flash('error', 'No tiene permiso de acceder a esa sección');
			return redirect('/'); 
		}

		$paciente = Paciente::where('id_user', Auth::user()->id)->select('pacientes.id')->get();
		$paciente_id = $paciente->first()->id;

		$fechaInicioDia = Carbon::createFromFormat('Y-m-d', Carbon::parse(Carbon::now())
				->format('Y-m-d'), 'America/Costa_Rica')->startOfDay()->format('Y-m-d H:i');//Change date format
		
		$fechaFinDia = Carbon::createFromFormat('Y-m-d', Carbon::parse(Carbon::now())//Change date format
		->format('Y-m-d'), 'America/Costa_Rica')->endOfDay()->format('Y-m-d H:i');

		$citas = DB::table('citas') //Get the patient's appointment list.
		->join('estado_citas', 'citas.estado_cita_id', 'estado_citas.id')
		->where('citas.estado_cita_id', '!=', 3)
		->where('citas.estado_cita_id', '!=', 4)
		->where('pacientes.id', $paciente_id)
		->whereDate('citas.fecha_cita', '>=', $fechaInicioDia)
		->join('pacientes', 'citas.paciente_id', 'pacientes.id')
		->join('servicios', 'citas.servicio_id', 'servicios.id')
		->join('especialistas', 'citas.especialista_id', 'especialistas.id')
		->join('recintos', 'citas.recinto_id', 'recintos.id')
		->select('citas.fecha_cita', 'citas.id', 
		'especialistas.nombre as nombreEspecialista', 
		'especialistas.primer_apellido_especialista as apellidoE1',
		'especialistas.segundo_apellido_especialista as apellidoE2',
		'servicios.nombre as servicio',
		'recintos.descripcion as recinto',
		'estado_citas.descripcion_estado_cita as estadoCita',
		'pacientes.nombre as nombrePaciente',
		'pacientes.primer_apellido_paciente as apellidoP1',
		'pacientes.segundo_apellido_paciente as apellidoP2')
		->orderBy('fecha_cita', 'asc')->get();

		return view('citas.index', compact('citas')); //Return the appointment list to the view of the patient.
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
	 * Store a newly created appointment in table citas.
	 *
	 * @param Request $request is all data incoming of the new appointment.
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{

		$cita = new Cita();
		$cita->estado_cita_id = 1;
		$paciente = Paciente::where('id_user', Auth::user()->id)->select('pacientes.id')->get();
		$cita->paciente_id = $paciente->first()->id;
		$cita->servicio_id = $request->dropServicios;
		$cita->especialista_id = $request->dropEspecialistas;
		$cita->recinto_id = $request->dropRecintos;
		$fechaCita = Carbon::parse($request->datepicked)->format('Y-m-d');
		$minutosCita = substr($request->horaCita, -2);
		$horaCita = $request->horaCita[0];
		if($horaCita == "9" || $horaCita == "8") { //Provides format to the time to be stored in the table
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
		Session::flash('error', 'Ya existe una cita en la fecha seleccionada con el especialista seleccionado');
		return redirect()->route('citas.index');
		} else {
		$user = User::where('id', Auth::user()->id)->first();
		$email = $user->email;
		$fecha = Carbon::parse($fechaCita)->format('d/m/Y');	
		$cita->save();
		
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

		Mail::to($email)->send(new SendMailable($user->name, $fecha, $hora, $recinto, $especialista));//send appointment reservation mail
		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Cita para el ' . $fecha . ' a las ' . $horaCita . ' reservada existosamente');//shows appointment message successfully reserved
		return redirect()->route('citas.index');
		}

	}

	/**
	 * Check if someone took an appointment before.
	 */
	private function existenciaCitas(Request $request) {
		$fechaCita = Carbon::parse($request->datepicked)->format('Y-m-d');
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
		->get();//Get the list of appointment that aren't canceled (3) or reprogrammed (4)

		if(!$citas->isEmpty()) {
            return "true";
        } else {
			return "false";
		}
	}

	

	/**
	 * Remove an specified appointment from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Cita $cita)
	{
		$cita->estado_cita_id = 3;//3 it is the status of canceled appointments
		$cita->save(); //Save the state of the appointment.

		$paciente = DB::table('pacientes')->where('pacientes.id', $cita->paciente_id)
		->first();
		$nombre = $paciente->nombre;
		$email = $paciente->correo;
		$fecha = Carbon::parse($cita->fecha_cita)->format('d/m/Y');
		$hora =  Carbon::parse($cita->fecha_cita)->format('H:i');

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

		return redirect()->route('citas.index');
	}

}
