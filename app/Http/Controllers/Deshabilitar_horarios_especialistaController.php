<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use DB;
use Carbon\Carbon;
use App\Deshabilitar_horarios_especialista;
use Illuminate\Http\Request;
use \Session;
use App\Especialista;

class Deshabilitar_horarios_especialistaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var deshabilitar_horarios_especialista
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Deshabilitar_horarios_especialista $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$deshabilitar_horarios_especialistas = DB::table('deshabilitar_horarios_especialistas')
			->join('especialistas', 'deshabilitar_horarios_especialistas.id_especialista', '=', 'especialistas.id')
			->where('especialistas.active_flag', 1)
			->where('deshabilitar_horarios_especialistas.active_flag', 1)
			->select('especialistas.*', 
			'deshabilitar_horarios_especialistas.*','deshabilitar_horarios_especialistas.id as id' )
			->get();

		$tipo_usuario = Auth::user()->tipo;
		if($tipo_usuario == 1) {
		return view('deshabilitar_horarios_especialistas.index', compact('deshabilitar_horarios_especialistas'));
		}
		if($tipo_usuario == 2) {

			$especialistaLoggeado = Especialista::where('id_user', Auth::user()->id)->first();
			//return $especialistaLoggeado->id;
			$deshabilitar_horarios_especialistas = DB::table('deshabilitar_horarios_especialistas')
			->join('especialistas', 'deshabilitar_horarios_especialistas.id_especialista', '=', 'especialistas.id')
			->where('especialistas.id', $especialistaLoggeado->id)
			->where('especialistas.active_flag', 1)
			->where('deshabilitar_horarios_especialistas.active_flag', 1)
			->select('especialistas.*',
			'deshabilitar_horarios_especialistas.*','deshabilitar_horarios_especialistas.id as id' )
			->get();

			return view('deshab_especial.index', compact('deshabilitar_horarios_especialistas'));
		}
		if($tipo_usuario == 3) {
			return view('deshab_asist.index', compact('deshabilitar_horarios_especialistas'));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tipo_usuario = Auth::user()->tipo;
		if($tipo_usuario == 1) {
			return view('deshabilitar_horarios_especialistas.create');
		}
		if($tipo_usuario == 2) {
			return view('deshab_especial.create');
		}
		if($tipo_usuario == 3) {
			return view('deshab_asist.create');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$deshabilitar_horarios_especialista = new Deshabilitar_horarios_especialista();

		$deshabilitar_horarios_especialista->name = ucfirst($request->input("name"));
		$deshabilitar_horarios_especialista->slug = str_slug($request->input("name"), "-");
		$deshabilitar_horarios_especialista->description = ucfirst($request->input("description"));
		$deshabilitar_horarios_especialista->active_flag = 1;
		$deshabilitar_horarios_especialista->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:deshabilitar_horarios_especialistas',
					 'description' => 'required'
			 ]);

		$deshabilitar_horarios_especialista->save();


		return redirect()->route('deshabilitar_horarios_especialistas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista)
	{
		//$deshabilitar_horarios_especialista = $this->model->findOrFail($id);

		return view('deshabilitar_horarios_especialistas.show', compact('deshabilitar_horarios_especialista'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista)
	{
		//$deshabilitar_horarios_especialista = $this->model->findOrFail($id);

		return view('deshabilitar_horarios_especialistas.edit', compact('deshabilitar_horarios_especialista'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista, User $user)
	{

		$deshabilitar_horarios_especialista->name = ucfirst($request->input("name"));
    $deshabilitar_horarios_especialista->slug = str_slug($request->input("name"), "-");
		$deshabilitar_horarios_especialista->description = ucfirst($request->input("description"));
		$deshabilitar_horarios_especialista->active_flag = 1;//change to reflect current status or changed status
		$deshabilitar_horarios_especialista->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:deshabilitar_horarios_especialistas,name,' . $deshabilitar_horarios_especialista->id,
					 'description' => 'required'
			 ]);

		$deshabilitar_horarios_especialista->save();


		return redirect()->route('deshabilitar_horarios_especialistas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista, $id)
	{
		$deshab_esp = Deshabilitar_horarios_especialista::where('id', $id)->first();
		$deshab_esp->active_flag = 0;
		//return $bloqueo_especialistum;
		$deshab_esp->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Failure');
		Session::flash('error', 'Deshabilitación de horario eliminada exitosamente');//shows confirm message that schedule disable was succesfully deleted
		
		return redirect()->action('Deshabilitar_horarios_especialistaController@index');
	}

	public function guardarDeshabEsp(Request $request, $dropEspecialistas, $datepickedInicio,
	$datepickedFin, $horaInicio, $horaFin)
	{
		//return json_encode(["a"=>$dropEspecialistas . $dropDiasBloqueo . $datepickedInicio. 
		//$datepickedFin . $horaInicio . $horaFin]);
		$deshab_esp = new Deshabilitar_horarios_especialista();

		$deshab_esp->id_especialista = $dropEspecialistas;
		$deshab_esp->fecha_inicio_deshabilitar = Carbon::parse($datepickedInicio)->format('Y-m-d');
		$deshab_esp->fecha_fin_deshabilitar = Carbon::parse($datepickedFin)->format('Y-m-d');
		$deshab_esp->hora_inicio_deshabilitar = $horaInicio;
		$deshab_esp->hora_fin_deshabilitar = $horaFin;
		$deshab_esp->active_flag = 1;

		//return json_encode(["a"=>$bloqueo_especialistum]);

		$deshab_esp->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Deshabilitación de horario creada exitosamente');//shows confirm message that schedule disable was succesfully created


		return json_encode(["varInnecesaria"=>"ESTOESNECESARIOSINOELAJAXNOSIRVE:c"]);
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Deshabilitar_horarios_especialista $deshabilitar_horarios_especialista)
	{
		$deshabilitar_horarios_especialista->active_flag = 1;
		$deshabilitar_horarios_especialista->save();

		return redirect()->route('deshabilitar_horarios_especialistas.index');
	}
}
