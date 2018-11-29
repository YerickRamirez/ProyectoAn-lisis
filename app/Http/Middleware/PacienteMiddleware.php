<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use \Session;

class PacienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
        $user = Auth::user();
        if ($user->tipo > 4){
        Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Failure');
		Session::flash('error', 'No tiene permiso de acceder a esa sección');
            return redirect('/');
        }
        } else {
        Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Failure');
		Session::flash('info', 'Debe iniciar sesión');
        return redirect('/login'); 
        }
        return $next($request);
    }
}
