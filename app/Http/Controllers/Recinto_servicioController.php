<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Recinto_servicio;
use App\Recinto;
use App\Servicio;
use Illuminate\Http\Request;
use \Session;

use DB;

class Recinto_servicioController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var recinto_servicio
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Recinto_servicio $model)
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
		$vinculos = $users = DB::table('recinto_servicios')
			->join('servicios', 'recinto_servicios.servicio_id', '=', 'servicios.id')
			->where('servicios.active_flag', 1)
			->where('recinto_servicios.active_flag', 1)
			->join('recintos', 'recinto_servicios.recinto_id', '=', 'recintos.id')
			->where('recintos.active_flag', 1)
			->orderBy('recinto_id', 'asc')->get();
		return view('recinto_servicios.index', compact('vinculos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('recinto_servicios.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user, $servicio, $recinto)
	{
		$recinto_servicio = new Recinto_servicio();

		$recinto_servicio->servicio_id = $servicio;
		$recinto_servicio->recinto_id = $recinto;
		$recinto_servicio->active_flag = 1;
		$recinto_servicio->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Recinto_servicio \"<a href='recinto_servicios/$recinto_servicio->slug'>" . $recinto_servicio->name . "</a>\" was Created.");

		return redirect()->route('recinto_servicios.index');
	}


		public function eliminar($servicio, $recinto)
	{
		$vinculos = $users = Recinto_servicio::
		where('active_flag', 1)
		->where('servicio_id', $servicio)
		->where('recinto_id', $recinto)->update(['active_flag'=>0]);
		
		return redirect()->route('recinto_servicios.index');
	}
}
