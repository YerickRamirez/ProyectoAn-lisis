<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\recuperarContrasenna;
use App\User;
use App\Telefono;
use Auth;
use DB;

class recuperarContrasennaController extends Controller
{
    
    public function mail(Request $request)
{
    $email = $request->email;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $cuenta = User::where('email', '=', $email)->first();
    $cuenta->password = bcrypt($randomString);
    $cuenta->save();
   Mail::to($email)->send(new recuperarContrasenna($randomString));
   return view('auth/login');
}
}