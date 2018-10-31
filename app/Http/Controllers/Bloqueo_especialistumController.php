<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Bloqueo_especialistum;
use Illuminate\Http\Request;
use \Session;

class Bloqueo_especialistumController extends Controller
{
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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$bloqueo_especialistas = Bloqueo_especialistum::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Bloqueo_especialistum::where('active_flag', 1);
		return view('bloqueo_especialistas.index', compact('bloqueo_especialistas', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('bloqueo_especialistas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$bloqueo_especialistum = new Bloqueo_especialistum();

		$bloqueo_especialistum->name = ucfirst($request->input("name"));
		$bloqueo_especialistum->slug = str_slug($request->input("name"), "-");
		$bloqueo_especialistum->description = ucfirst($request->input("description"));
		$bloqueo_especialistum->active_flag = 1;
		$bloqueo_especialistum->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:bloqueo_especialistas',
					 'description' => 'required'
			 ]);

		$bloqueo_especialistum->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Bloqueo_especialistum \"<a href='bloqueo_especialistas/$bloqueo_especialistum->slug'>" . $bloqueo_especialistum->name . "</a>\" was Created.");

		return redirect()->route('bloqueo_especialistas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Bloqueo_especialistum $bloqueo_especialistum)
	{
		//$bloqueo_especialistum = $this->model->findOrFail($id);

		return view('bloqueo_especialistas.show', compact('bloqueo_especialistum'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Bloqueo_especialistum $bloqueo_especialistum)
	{
		//$bloqueo_especialistum = $this->model->findOrFail($id);

		return view('bloqueo_especialistas.edit', compact('bloqueo_especialistum'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Bloqueo_especialistum $bloqueo_especialistum, User $user)
	{

		$bloqueo_especialistum->name = ucfirst($request->input("name"));
    $bloqueo_especialistum->slug = str_slug($request->input("name"), "-");
		$bloqueo_especialistum->description = ucfirst($request->input("description"));
		$bloqueo_especialistum->active_flag = 1;//change to reflect current status or changed status
		$bloqueo_especialistum->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:bloqueo_especialistas,name,' . $bloqueo_especialistum->id,
					 'description' => 'required'
			 ]);

		$bloqueo_especialistum->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Bloqueo_especialistum \"<a href='bloqueo_especialistas/$bloqueo_especialistum->slug'>" . $bloqueo_especialistum->name . "</a>\" was Updated.");

		return redirect()->route('bloqueo_especialistas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Bloqueo_especialistum $bloqueo_especialistum)
	{
		$bloqueo_especialistum->active_flag = 0;
		$bloqueo_especialistum->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Bloqueo_especialistum ' . $bloqueo_especialistum->name . ' was De-Activated.');

		return redirect()->route('bloqueo_especialistas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Bloqueo_especialistum $bloqueo_especialistum)
	{
		$bloqueo_especialistum->active_flag = 1;
		$bloqueo_especialistum->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Bloqueo_especialistum ' . $bloqueo_especialistum->name . ' was Re-Activated.');

		return redirect()->route('bloqueo_especialistas.index');
	}
}
