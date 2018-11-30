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
	/**ESTE VA A MOSTRAR LAS CITAS DEL DIA ACTUAL EN EL MODULO ESPECIALISTA*/
	public function index()
	{
		/*$fechaInicioCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->startOfDay();
		$fechaFinCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->endOfDay();
		//Carbon::createFromFormat(Carbon::now(), 'America/Costa_Rica')->startOfDay();
		//return $fechaInicioCarbon. ' ' . $fechaFinCarbon;
		//$citas = Cita::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		//$active = Cita::where('active_flag', 1);
		$citas = $cita = DB::table('citas')->whereDate('fecha_cita', '>=', $fechaInicioCarbon)
		->whereDate('fecha_cita', '<=', $fechaFinCarbon)
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.active_flag', '!=',0)
		->where('citas.estado_cita_id', '!=',3)
		->where('telefonos.active_flag', 1)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->where('pacientes.active_flag', 1)
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
			//return $citas;*/
		return view('Especialista.index');

	}

	//DEVUELVE SOLICITADAS Y CONFIRMADAS para el especialista loggeado el día actual!
	public function citaRecintoDia($ID_Recinto)
	{
		$fechaInicioCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->startOfDay();
		$fechaFinCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->endOfDay();

		$citas = $cita = DB::table('citas')->whereDate('fecha_cita', '>=', $fechaInicioCarbon)
		->whereDate('fecha_cita', '<=', $fechaFinCarbon)
		->where('recintos.id', $ID_Recinto)
		->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
		->where('recintos.active_flag', '!=',0)
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.active_flag', '!=',0)
		->where('citas.estado_cita_id', '!=',3)
		->where('citas.estado_cita_id', '!=',4)
		->where('telefonos.active_flag', 1)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->where('pacientes.active_flag', 1)
		->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
		->where('especialistas.active_flag', 1)
		->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
		->where('servicios.active_flag', 1)
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
			//return $citas;
		return json_encode(["citas"=>$citas]);

	}

	//DEVUELVE SOLICITADAS Y CONFIRMADAS para el especialista loggeado A PARTIR del día actual!
	public function citaRecintoAPartirHoy($ID_Recinto)
	{
		$fechaInicioCarbon = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->startOfDay();

		$citas = $cita = DB::table('citas')->whereDate('fecha_cita', '>=', $fechaInicioCarbon)
		->where('recintos.id', $ID_Recinto)
		->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
		->where('recintos.active_flag', '!=',0)
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.active_flag', '!=',0)
		->where('citas.estado_cita_id', '!=',3)
		->where('citas.estado_cita_id', '!=',4)
		->where('telefonos.active_flag', 1)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->where('pacientes.active_flag', 1)
		->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
		->where('especialistas.active_flag', 1)
		->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
		->where('servicios.active_flag', 1)
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
			//return $citas;
		return json_encode(["citas"=>$citas]);

	}

	public function historicoCitasActivasRecinto($ID_Recinto)
	{

		$citas = $cita = DB::table('citas')
		->where('recintos.id', $ID_Recinto)
		->join('recintos', 'citas.recinto_id', '=', 'recintos.id')
		->where('recintos.active_flag', '!=',0)
		->join('telefonos', 'citas.paciente_id', '=', 'telefonos.paciente_id')
		->where('citas.active_flag', '!=',0)
		->where('citas.estado_cita_id', '!=',3)
		->where('citas.estado_cita_id', '!=',4)
		->where('telefonos.active_flag', 1)
		->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
		->where('pacientes.active_flag', 1)
		->join('especialistas', 'citas.especialista_id', '=', 'especialistas.id')
		->where('especialistas.active_flag', 1)
		->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
		->where('servicios.active_flag', 1)
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
			//return $citas;
		return json_encode(["citas"=>$citas]);

	}
	

	/*CREO QUE EL ESPECIALISTA NO OCUPA ESTO

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('citas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		
		$paciente = DB::table('pacientes')->where('cedula_paciente', $request->cedula)
		->select('id')->get();
		if($paciente->isEmpty()) {
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
			$fechaCita = Carbon::parse($request->datepicked)->format('Y-m-d');
			$minutosCita = substr($request->horaCita, -2);
			$horaCita = $request->horaCita[0];
			if($horaCita == "9" || $horaCita == "8") {
				$horaCita = "0" . $horaCita . ':' . $minutosCita;
			} else {
				$horaCita = $request->horaCita[0] . $request->horaCita[1]  . ':' . $minutosCita;
			}
			$cita->fecha_cita = $fechaCita . ' ' . $horaCita;
			$cita->active_flag = 1;
			//$cita->author_id = $request->user()->id;
	
			/*$this->validate($request, [
						 'name' => 'required|max:255|unique:citas',
						 'description' => 'required'
				 ]);*/
	
				 $revisarCitas = $this->existenciaCitas($request);
				 if($revisarCitas == "true") {//Revisa si alguien le ganó el espacio
				 Session::flash('message_type', 'negative');
				 Session::flash('message_icon', 'hide');
				 Session::flash('message_header', 'Success');
				 Session::flash('message', 'Ya existe una cita en la fecha seleccionada con el especialista seleccionado');
				 ////////////AQUÍ HAY QUE ARREGLAR LA RUTA CUANDO ELE GANAN LA CITA//////////////////////////////////////////////////////////////////////////////////////////////
				 return back();
				 } else {
				 $cita->save();
				 return back();
				 }
		}
		
		}

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
			//return $fecha_cita;
			$citas = Cita::where('fecha_cita',  $fecha_cita)
			->where('active_flag', 1)
			->where('estado_cita_id', '!=', 3)
			->where('estado_cita_id', '!=', 4)
			->where('especialista_id', $request->dropEspecialistas)
			->get();
	
			if(!$citas->isEmpty()) {//
				return "true";
			} else {
				return "false";
			}
		}

		public function reprogramarCita(Request $request, User $user)
		{
			$paciente = DB::table('pacientes')->where('cedula_paciente', $request->cedula)
			->select('id')->get();
			if($paciente->isEmpty()) {
				Session::flash('message_type', 'negative');
				 Session::flash('message_icon', 'hide');
				 Session::flash('message_header', 'Success');
				 Session::flash('message', 'No existen pacientes con la cédula digitada');
	////////////AQUÍ HAY QUE ARREGLAR LA RUTA CUANDO EL PACIENTE CON ESA CÉDULA NO EXISTE//////////////////////////////////////////////////////////////////////////////////////////////
				return back();		
				} else {
				$id = $paciente->first()->id;
				$cita = new Cita();
			
				$cita->estado_cita_id = 1;
				$cita->paciente_id = $id;
				$cita->servicio_id = $request->dropServicios;
				$cita->especialista_id = $request->dropEspecialistas;
				$cita->recinto_id = $request->dropRecintos;
				$fechaCita = Carbon::parse($request->datepicked)->format('Y-m-d');
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
				 if($revisarCitas == "true") {//Revisa si alguien le ganó el espacio
				 Session::flash('message_type', 'negative');
				 Session::flash('message_icon', 'hide');
				 Session::flash('message_header', 'Success');
				 Session::flash('message', 'Ya existe una cita en la fecha seleccionada con el especialista seleccionado');
				 ////////////AQUÍ HAY QUE ARREGLAR LA RUTA CUANDO ELE GANAN LA CITA//////////////////////////////////////////////////////////////////////////////////////////////
				 return back();
				 } else {
					$paciente = DB::table('pacientes')->where('pacientes.id', $cita->paciente_id)
					->first();
					$nombre = $paciente->nombre;
					$email = $paciente->correo;
					$fecha = Carbon::parse($fechaCita)->format('d/m/Y');	
	
					
					Mail::to($email)->send(new reprogramarCitaAsistente($nombre, $fecha, $horaCita));

				 $cita->save();
				 return back();
				}
				}
		}

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
				//return "a";
				//return redirect()->route('Especialista.index');
				
				$cita->estado_cita_id = 2;
				$cita->save();
		
				Session::flash('message_type', 'negative');
				Session::flash('message_icon', 'hide');
				Session::flash('message_header', 'Success');
				Session::flash('message', 'The Cita ' . $cita->name . ' was De-Activated.');
				//return "hola";
				return redirect()->route('Especialista.index');
		
			}

			public function confirmarCitaAjax($id_cita)
			{
				//return "a";
				$cita = Cita::find($id_cita);
				$paciente = DB::table('pacientes')->where('pacientes.id', $cita->paciente_id)
				->first();
				$nombre = $paciente->nombre;
				$email = $paciente->correo;
				$fecha = Carbon::parse($cita->fecha_cita)->format('d/m/Y H:i');
				Mail::to($email)->send(new confirmarCita($nombre, $fecha));
				//return $cita;
				$cita->estado_cita_id = 2;
				$cita->save();
		
				return back();
			}

			public function reprogramarCitaAjax($id_cita)
			{
				//return "a";
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

		public function cancelarCitaAjax($id_cita)
	{

		
		$cita = Cita::find($id_cita);
		$cita->estado_cita_id = 3;

		
		$paciente = DB::table('pacientes')->where('pacientes.id', $cita->paciente_id)
		->first();
		$nombre = $paciente->nombre;
		$email = $paciente->correo;
		$fecha = Carbon::parse($cita->fecha_cita)->format('d/m/Y H:i');
		//return $fecha;
		
		Mail::to($email)->send(new EnviarCanceacion($nombre, $fecha));
   		//return "Correo enviado exitosamente";
		//$paciente_id = $paciente->first()->id;

		//return $cita;
		$cita->save();

		//return "hola";
		return back();
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Cita $cita)
	{
		//$cita = $this->model->findOrFail($id);

		return view('citas.edit', compact('cita'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Cita $cita, User $user)
	{
		$cita->name = ucfirst($request->input("name"));
    	$cita->slug = str_slug($request->input("name"), "-");
		$cita->description = ucfirst($request->input("description"));
		$cita->active_flag = 1;//change to reflect current status or changed status
		$cita->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:citas,name,' . $cita->id,
					 'description' => 'required'
			 ]);

		$cita->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Cita \"<a href='citas/$cita->slug'>" . $cita->name . "</a>\" was Updated.");

		return redirect()->route('citas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Cita $cita)
	{
		//return $cita;
		$cita->active_flag = 0;
		$cita->estado_cita_id = 3;
		$cita->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Cita ' . $cita->name . ' was De-Activated.');
		//return "hola";
		return redirect()->route('Especialista.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Cita $cita)
	{
		$cita->active_flag = 1;
		$cita->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Cita ' . $cita->name . ' was Re-Activated.');

		return redirect()->route('citas.index');
	}
}
