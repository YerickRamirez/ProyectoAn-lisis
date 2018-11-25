<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Paciente;
use User;

class PacientePrueba extends Controller
{
    public function insertarUsuarioPaciente($id)
	{

		return $id;
		//$user = User::where('email', Auth::user()->email);
		
		$paciente = new Paciente();

		$paciente->id_user = Auth::user()->id;
		$paciente->nombre = Auth::user()->name;
		$paciente->primer_apellido_paciente = Auth::user()->name;
		$paciente->segundo_apellido_paciente = Auth::user()->name;
		$paciente->active_flag = 0;

		$paciente->slug = str_slug($request->input("name"), "-");
		$paciente->description = ucfirst($request->input("description"));
		$paciente->active_flag = 1;
		$paciente->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:pacientes',
					 'description' => 'required'
			 ]);

		$paciente->save();
		return redirect()->route('pacientes.index');
		Auth::logout();
        return redirect('/');
        /*
		$pacientes = Paciente::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Paciente::where('active_flag', 1);
		return view('pacientes.index', compact('pacientes', 'active'));*/
	}
}
