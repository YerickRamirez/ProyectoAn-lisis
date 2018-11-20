<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PacientePrueba extends Controller
{
    public function index()
	{
        return Auth::user();
        /*
		$pacientes = Paciente::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Paciente::where('active_flag', 1);
		return view('pacientes.index', compact('pacientes', 'active'));*/
	}
}
