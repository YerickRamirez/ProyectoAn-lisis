<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Horarios_servicio;
use Illuminate\Http\Request;
use \Session;

class Horarios_servicioController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var horarios_servicio
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Horarios_servicio $model)
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
		$horarios_servicios = Horarios_servicio::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Horarios_servicio::where('active_flag', 1);
		return view('horarios_servicios.index', compact('horarios_servicios', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('horarios_servicios.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$horarios_servicio = new Horarios_servicio();
		
		//for ($i = 1; $i < 6; $i ++ ){
			$horarios_servicio->id_dia = $request->dia;
			$horarios_servicio->id_recinto = $request->recinto;
			$horarios_servicio->id_servicio = $request->servicio;
			$horarios_servicio->id_especialista = $request->especialista;
			$horarios_servicio->disponibilidad_manana = $request->manana;
			$horarios_servicio->disponibilidad_tarde = $request->tarde;
			$horarios_servicio->active_flag = 1;
			//$horarios_servicio->save();
		//}
		
		

		//$horarios_servicio->author_id = $request->user()->id;

		/*$this->validate($request, [
					 'name' => 'required|max:255|unique:horarios_servicios',
					 'description' => 'required'
			 ]);*/

			 $horarios_servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Horarios_servicio \"<a href='horarios_servicios/$horarios_servicio->slug'>" . $horarios_servicio->name . "</a>\" was Created.");

		return redirect()->route('horarios_servicios.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Horarios_servicio $horarios_servicio)
	{
		//$horarios_servicio = $this->model->findOrFail($id);

		return view('horarios_servicios.show', compact('horarios_servicio'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Horarios_servicio $horarios_servicio)
	{
		//$horarios_servicio = $this->model->findOrFail($id);

		return view('horarios_servicios.edit', compact('horarios_servicio'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Horarios_servicio $horarios_servicio, User $user)
	{

		$horarios_servicio->name = ucfirst($request->input("name"));
    $horarios_servicio->slug = str_slug($request->input("name"), "-");
		$horarios_servicio->description = ucfirst($request->input("description"));
		$horarios_servicio->active_flag = 1;//change to reflect current status or changed status
		$horarios_servicio->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:horarios_servicios,name,' . $horarios_servicio->id,
					 'description' => 'required'
			 ]);

		$horarios_servicio->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Horarios_servicio \"<a href='horarios_servicios/$horarios_servicio->slug'>" . $horarios_servicio->name . "</a>\" was Updated.");

		return redirect()->route('horarios_servicios.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Horarios_servicio $horarios_servicio)
	{
		$horarios_servicio->active_flag = 0;
		$horarios_servicio->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Horarios_servicio ' . $horarios_servicio->name . ' was De-Activated.');

		return redirect()->route('horarios_servicios.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Horarios_servicio $horarios_servicio)
	{
		$horarios_servicio->active_flag = 1;
		$horarios_servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Horarios_servicio ' . $horarios_servicio->name . ' was Re-Activated.');

		return redirect()->route('horarios_servicios.index');
	}

	public function annadirActualizarHorarios(Request $request, User $user, $array_horario_servicio)
	{
		$horarios_servicio_param = json_decode($array_horario_servicio);

		//este return muestra todo el objeto que viene de parámetro
		//return $horarios_servicio_param;
		
		//este return por ejemplo trae para el Lunes (osea [0]) el id_dia 
		//return $horarios_servicio_param[0]->id_dia;

		//si quiere ver todo un objeto específico del array tiene dos opciones
		// hacerle json_encode(array[0]);
		//hacerle var_dump(array[0]);

		//La idea es entonces sacarle el id día, el id especialista, el  id servicio y el de recinto
		//y (puede que haya que considerar active_flag) a cada uno de los 5 objetos de array, y buscar si existe en la BD (CREO que se puede
		//hacer con un if(!empty($objeto)) )
		//En caso de que el objeto exista, lo actualiza
		//En caso de que no, lo inserta.

		//Como consejo, cada que agregue un where() a cada consulta, devuelvalo y haga pruebas
		//teniendo varias tuplas de diferentes especialistas (tanto con active_flag 0 y como active_flag 1)
		//con eso se asegura de que la consulta va bien, a veces uno la concatena mal 
		//o termina pidiendo solo una condición (por ejemplo CREO que si el último where es por ejemplo 
		// active flag, 1, el mae le va a traer los activos, obviando todos los where de especialistas
		//, recintos etc.). 

		//$horarioServicio = Horarios_servicio::where('id_recinto', $recinto)->where('id_especialista', $especialista)
    //->where('id_servicio', $servicio);
		$horarios_servicio = new Horarios_servicio();
		
		$horarios_servicio->id_dia = $request->dia;
		$horarios_servicio->id_recinto = $request->recinto;
		$horarios_servicio->id_servicio = $request->servicio;
		$horarios_servicio->id_especialista = $request->especialista;
		$horarios_servicio->disponibilidad_manana = $request->manana;
		$horarios_servicio->disponibilidad_tarde = $request->tarde;
		$horarios_servicio->active_flag = 1;

		//$horarios_servicio->author_id = $request->user()->id;

		/*$this->validate($request, [
					 'name' => 'required|max:255|unique:horarios_servicios',
					 'description' => 'required'
			 ]);*/

		$horarios_servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Horarios_servicio \"<a href='horarios_servicios/$horarios_servicio->slug'>" . $horarios_servicio->name . "</a>\" was Created.");

		return redirect()->route('horarios_servicios.index');
	}
}
