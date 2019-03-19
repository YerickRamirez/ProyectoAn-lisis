<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Especialista;
use Auth;
use Carbon\Carbon;

use App\Bloqueo_especialistum;
use Illuminate\Http\Request;
use \Session;
use DB;
class Bloqueo_especialistumController extends Controller
{
	  /*
    |--------------------------------------------------------------------------
    | Bloqueo_especialistumController
    |--------------------------------------------------------------------------
    | This controller is responsible for handling the schedule
	| blockages of the specialists.
    |
	*/
	
	/**
	 * Variable to model
	 *
	 * @var bloqueo_especialistum
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Bloqueo_especialistum $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the schedule locks.
	 *
	 * @return Response
	 */
	public function index()
	{
		$bloqueo_especialistas = DB::table('bloqueo_especialistas')
			->join('especialistas', 'bloqueo_especialistas.id_especialista', '=', 'especialistas.id')
			->where('especialistas.active_flag', 1)
			->where('bloqueo_especialistas.active_flag', 1)
			->join('dia_bloqueo_especialistas', 'bloqueo_especialistas.id_dia_bloqueo_especialistas', '=', 'dia_bloqueo_especialistas.id')
			->where('dia_bloqueo_especialistas.active_flag', 1)
			->select('especialistas.*', 'dia_bloqueo_especialistas.dia', 
			'bloqueo_especialistas.*','bloqueo_especialistas.id as id' )
			->get();

		$tipo_usuario = Auth::user()->tipo;
		if($tipo_usuario == 1) {//if the user is the administrator
		return view('bloqueo_especialistas.index', compact('bloqueo_especialistas'));
		}
		if($tipo_usuario == 2) {//If the user is an '0especialist' (doctor, nurse)
			$especialistaLoggeado = Especialista::where('id_user', Auth::user()->id)->first();
			$bloqueo_especialistas = DB::table('bloqueo_especialistas')
			->join('especialistas', 'bloqueo_especialistas.id_especialista', '=', 'especialistas.id')
			->where('especialistas.id', $especialistaLoggeado->id)
			->where('especialistas.active_flag', 1)
			->where('bloqueo_especialistas.active_flag', 1)
			->join('dia_bloqueo_especialistas', 'bloqueo_especialistas.id_dia_bloqueo_especialistas', '=', 'dia_bloqueo_especialistas.id')
			->where('dia_bloqueo_especialistas.active_flag', 1)
			->select('especialistas.*', 'dia_bloqueo_especialistas.dia', 
			'bloqueo_especialistas.*','bloqueo_especialistas.id as id' )
			->get();

			return view('bloqueo_especialistas_especial.index', compact('bloqueo_especialistas'));
		}
		if($tipo_usuario == 3) {//If the user is an assistant
			return view('bloqueo_especialistas_asist.index', compact('bloqueo_especialistas'));
		}
	}

	/**
	 * Show the form for creating a new schedule locks
	 * depending on the type of user.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tipo_usuario = Auth::user()->tipo;
		if($tipo_usuario == 1) {
			return view('bloqueo_especialistas.create');
		}
		if($tipo_usuario == 2) {
			return view('bloqueo_especialistas_especial.create');
		}
		if($tipo_usuario == 3) {
			return view('bloqueo_especialistas_asist.create');
		}
	}


	/**
	 * Store a newly created schedule locks in the table bloqueo_especialistas.
	 * @param  $dropEspecialistas the id of the espacilist in the table especialista.
	 * @param  $dropDiasBloqueo the id of the day in the table dia_bloqueo_especialistas.
	 * @param  $datepickedInicio is the start date of the lock.
	 * @param  $datepickedFin is the end date of the lock.
	 * @param  $horaInicio is the start time of the lock.
	 * @param  $horaFin is the end time of the lock.
	 * 
	 */	

	public function guardarBloqueoEsp(Request $request, $dropEspecialistas, $dropDiasBloqueo, $datepickedInicio,
	$datepickedFin, $horaInicio, $horaFin)
	{
		$bloqueo_especialistum = new Bloqueo_especialistum();
		$bloqueo_especialistum->id_especialista = $dropEspecialistas;
		$bloqueo_especialistum->id_dia_bloqueo_especialistas = $dropDiasBloqueo;
		$bloqueo_especialistum->fecha_inicio_bloqueo_especialista = Carbon::parse($datepickedInicio)->format('Y-m-d');
		$bloqueo_especialistum->fecha_fin_bloqueo_especialista = Carbon::parse($datepickedFin)->format('Y-m-d');
		$bloqueo_especialistum->hora_inicio_bloqueo_especialista = $horaInicio;
		$bloqueo_especialistum->hora_fin_bloqueo_especialista = $horaFin;
		$bloqueo_especialistum->active_flag = 1;

		$bloqueo_especialistum->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Bloqueo de horario creado existosamente');//shows schedule lock creation success message

		return json_encode(["varInnecesaria"=>"ESTOESNECESARIOSINOELAJAXNOSIRVE:c"]);
	}

	/**
	 * Remove the specified schedule locks from storage.
	 *
	 * @param  int  $id unique identifier of the schedule locks to be eliminated.
	 * @return Response
	 */
	public function destroy(Bloqueo_especialistum $bloqueo_especialistum, $id)
	{
		$bloqueo_especialistum = Bloqueo_especialistum::where('id', $id)->first();
		$bloqueo_especialistum->active_flag = 0;
		$bloqueo_especialistum->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Failure');
		Session::flash('error', 'Bloqueo de horario eliminado exitosamente');

		return redirect()->action('Bloqueo_especialistumController@index');
	}

	
}
