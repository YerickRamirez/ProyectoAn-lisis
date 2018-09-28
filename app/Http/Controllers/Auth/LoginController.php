<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function login(){
        $this->validate(request(),[
            'email' => 'email|required|string',
            'password' => 'required|string',
            'name' => 'required|string',
            'lastName' => 'required|string'
        ]);
    }
}
