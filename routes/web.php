<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*//*

//CREO QUE NINGUNO ES NECESARIO
Route::get('master', function () {
    return view('masterAdmin');
});//->middleware('auth.basic');
/*
Route::get('root', function () {
    return view('masterRoot');
});//->middleware('auth.basic');

/*CREO QUE NO ES NECESARIO ESTE
Route::get('patient', function () {
    return view('masterPatient');
});//->middleware('auth.basic');




Route::get('prueba', function () {
    return view('Paciente/index') ;
})->middleware('auth.basic');
*/

Route::get('/',function () {
    if(Auth::check()) {
        auth()->logout();
    }
    return view('auth/login');
});//->middleware('auth.basic');


//---------------------------------------
//Rutas de Adminitrador
//---------------------------------------

Route::get('admin', function () {
    return view('Admin/index') ;
});//->middleware('auth.basic');

Route::get('cuentas', function () {
    return view('Admin/configurarCuentas') ;
});//->middleware('auth.basic');

Route::get('crearCuentas', function () {
    return view('cuentas/create') ;
});//->middleware('auth.basic');


Route::get('horarios', function () {
    return view('Admin/configurarHorarios') ;
});//->middleware('auth.basic');


Route::get('recintos', function () {
    return view('recintos/index');
});//->name('recintosA');

Route::get('cuentas/create', function(){return view('cuentas/create');}) ->name('Prueba.adn');
//Route::get('cuentas/create', 'CuentaController@store') ->name('store.adn');
Route::post('crearCuenta', 'CuentaController@store');



Route::get('Admin/configurarRecintos')->name('admin.recintos');

Route::resource('servicio', 'ServicioController');

/*
Route::get('servicios', 'ServicioController@index')->name('servicios.index');//->middleware('auth.basic');
Route::get('mostrarServicio', 'ServicioController@show')->name('servicios.show');//->middleware('auth.basic');
Route::get('editarServicio', 'ServicioController@edit')->name('servicios.edit');//->middleware('auth.basic');
Route::post('eliminarServicio', 'ServicioController@destroy')->name('servicios.destroy');//->middleware('auth.basic');
Route::get('crearServicio', 'ServicioController@create')->name('servicios.create');//->middleware('auth.basic');
Route::post('almacenarServicio', 'ServicioController@store')->name('servicios.store');//->middleware('auth.basic');
Route::post('actualizarServicio', 'ServicioController@update')->name('servicios.update');//->middleware('auth.basic');

*/

//---------------------------------------
//Rutas Paciente
//---------------------------------------
//Para acceder a metodos del controlador Paciente
Route::resource('pacientes', 'PacienteController');

//Pestanna para cambiar contrasenna
Route::get('cambioContrasenna', function () {
    return view('pacientes/cambiarContrasenna');
});
//Controlador para contrasennas de pacientes
Route::resource('contrasennas', 'cambiarContrasennaController');

//Para acceder a la pagina de editar generada por el scaffold
Route::get('perfilPaciente', 'PacienteController@edit');

//Para dirigir a la pagina principal de pacientes sin tener que poner citas en la url
Route::get('paciente', function () {
    return redirect()->route('citas.index');
});//->middleware('auth');
Route::get('insertarUserPaciente', 'PacientePrueba@insertarUsuarioPaciente');//->middleware('auth');


/*CAMBIO DE CONTRASENNA ROOT */
Route::get('contrasennaAdmin', function() {
    return view('Admin/cambiarContrasenna');
});
Route::resource('cambiarContrasennaAdmin', 'ContrasennaRootController');
/*FIN CAMBIO DE CONTRASENNA ROOT */

/*
Route::get('citas', function () {
    return view('Paciente/citas') ;
})->middleware('auth');

Route::get('perfil', function () {
    return view('Paciente/perfil') ;
});//->middleware('auth');

Route::get('informacion', function () {
    return view('Paciente/informacion') ;
});//->middleware('auth');
*/
Route::get('datepicker', function () {
    return view('Paciente/datepicker');
});


//---------------------------------------
//---------------------------------------

Route::post('login', 'Auth\LoginController@login')-> name('login')-> middleware('guest');
//Route::post('login', 'Auth\LoginController@login')-> name('login');

Route::post('/test/save', ['as' => 'save-date',
                           'uses' => 'DateController@showDate', 
                            function () {
                                return '';
                            }]);
                            
// Rutas de la tabla especialista
/*
Route::get('especialistas', 'EspecialistaController@index');
Route::get('especialistas/{cedula}/editarEspecialista', 'EspecialistaController@editarEspecialista');
Route::get('especialistas/{cedula}/eliminarEspecialista', 'EspecialistaController@eliminarEspecialista');
Route::post('especialistas/{cedula}/actualizarEspecialista', 'EspecialistaController@actualizarEspecialista');
Route::view('especialistas/viewAnnadir', 'Especialista.annadirEspecialista');
Route::post('especialistas/agregarEspecialista', 'EspecialistaController@agregarEspecialista');
//Fin rutas tabla especialista
*/

Route::resource('especialistas', 'EspecialistaController');

//Route::get('vinculoRecinto', 'Recinto_servicioController@index');

Route::resource('recinto_servicios', 'Recinto_servicioController');
Route::get('eliminarVinculo/{servicio}/{recinto}', 
['as'=>'eliminarVinculo1','uses'=>'Recinto_servicioController@eliminar']);


Route::resource('especialista_servicios', 'Especialista_servicioController');

Route::get('eliminarVinculoEspecialista/{servicio}/{recinto}/{especialista}',
 ['as'=>'eliminarVinculoEspecialista1','uses'=>'Especialista_servicioController@eliminar']);

 Route::get('/vincularEspecialista/{servicio}/{recinto}/{especialista}', 
 'Especialista_servicioController@store');

 //sirve para traer todos los especialistas (bloqueo_esp root, master, asist)
 Route::get('cargarEspecialistas', 'AjaxController@cargarEspecialistas');
 

//Rutas tabla recinto
Route::resource('recintos', 'RecintoController');
//Fin rutas recinto


//------------------------Rutas para correos
//Route::get('send/email/{email}/{name}/{fecha}', 'correoCitaController@mail');

Route::get('send/email/{email}/{name}/{fecha}/{hora}', 'CorreoCitaController@mail');

Route::get('sendCancelacion/email/{email}/{name}/{fecha}', 'CancelacionCitaController@mail');


//Rutas prueba ajax
Route::get('/recintosCombo', 'AjaxController@combobox');
Route::get('/serviciosCombo/{ID_Recinto}', 'AjaxController@comboServicios');
Route::get('/serviciosCombo', 'AjaxController@cargarServicios');
Route::get('/vincular/{servicio}/{recinto}', 'Recinto_servicioController@store');
Route::get('/especialistasCombo/{ID_Servicio}/{ID_Recinto}', 'AjaxController@comboEspecialistas');
Route::get('/especialistasComboSinHorario/{ID_Servicio}/{ID_Recinto}', 'AjaxController@comboEspecialistasSinHorario');
Route::get('/verificarCitas/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}', 'AjaxController@datosCita');
//fin rutas de ajax

//Ruta citas
Route::resource('citas', 'CitaController');
Route::get('/annadirCita/{horaCita}/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}', 'CitaController@store');
Route::get('/annadirCitaAsistente/{horaCita}/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}/{cedula}', 'CitaControllerAsistente@store');
//

Route::get('combobox',function(){
    return view('PruebaCombobox.pruebacombo');
 });

Route::get('ajax',function(){
    return view('message');
 });
 Route::get('/getmsg','AjaxController@index');
 
//Fin rutas pruebas combobox autorefresh



// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas horarios servicios////////////////////////////////////////
Route::get('horarios', function () {
    return view('Admin/configurarHorarios') ;
})->name('Admin.horarios');

Route::get('horarios_servicios', function () {
    return view('horarios_servicios/index') ;
})->name('horarios_servicios.index');

Route::get('/verificarHorarioServicio/{recinto}/{servicio}/{especialista}', 'AjaxController@horarioServicios');
Route::get('/annadirHorarioServicio/{array_horario_servicio}', 'Horarios_servicioController@annadirActualizarHorarios');


/**Rutas Asistente index, configurar horarios, reservar y reprogramar citas  */
Route::get('horarios_servicios_asistente.index', function () {
    return view('horarios_servicios_asistente.index') ;
})->name('horarios_serv_asis.index');

Route::get('horarios_servicios_asistente', function () {
    return view('asistente.configurarHorarios') ;
})->name('Asistente.horarios');

Route::get('asistente.crearCita', function () {
    return view('asistente.crearCita') ;
})->name('Asistente.crearCita');


Route::get('asistente.configuracionCuentas', function () {
    return view('asistente.configuracionCuentas') ;
})->name('asistente.confCuentas');

Route::get('/hola', 'AjaxController@cargarCitas');


Route::delete('destroyCitAsistente{cita}', 'CitaControllerAsistente@destroy')->name('destroyCitAsistente');
Route::delete('reprogramarCitAsistente{cita}', 'CitaControllerAsistente@reprogramar')->name('reprogramarCitAsistente');
Route::delete('confirmarCitAsistente{cita}', 'CitaControllerAsistente@confirmar')->name('confirmarCitAsistente');
Route::resource('asistente', 'CitaControllerAsistente');
Route::get('asistente', 'CitaControllerAsistente@index');
Route::get('asistente', 'CitaControllerAsistente@index')->name('asistente.index');
Route::get('/reprogramarCitaAsistente/{horaCita}/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}/{cedula}', 'CitaControllerAsistente@reprogramarCita');
Route::get('reservarCita',function(){
    return view('asistente.crearCita');
 });

 
///////////////////Fin rutas asistente//////////////////////////////////////////// 


//Se usa para desloggear un usuario. Yo (Seney) lo uso para desloggear apenas se registran
Route::get('logoutUsuarioRecienRegistrado', 'AjaxController@logoutMensajeRegistro');

Route::get('/algo', function() {
    return view('algo');
});

//sirve para llenar los drops de los días bloqueados (asist, especialista, root)
Route::get('dropDiasBloqueo', 'AjaxController@dropDiasBloqueo');

//resource de bloqueoEspecialistas
Route::resource('bloqueo_especialistas', 'Bloqueo_especialistumController');

//lleva los datos para insertar un bloqueo de un especialista (asist, especialista, root)
Route::get('crearBloqueoEspecialista/{dropEspecialistas}/{dropDiasBloqueo}/{datepickedInicio}/{datepickedFin}/{horaInicio}/{horaFin}', 'Bloqueo_especialistumController@guardarBloqueoEsp');

Route::get('redirigirBloqueoEspIndex', 'Bloqueo_especialistumController@redirigirBloqueoEspIndex');

//Rutas del usuario Especialista///////////////////////////////////////////////////////////////////////
//Index
Route::get('Especialista.index', 'CitaControllerEspecialista@index')->name('Especialista.index');
Route::get('Especialista', 'CitaControllerEspecialista@index');

//Para cancelar cita
Route::delete('destroyCitEspecialista{cita}', 'CitaControllerEspecialista@destroy')->name('destroyCitEspecialista');

//Para reprogramar cita
Route::delete('reprogramarCitEspecialista{cita}', 'CitaControllerEspecialista@reprogramar')->name('reprogramarCitEspecialista');
Route::get('/reprogramarCitEspecialista/{horaCita}/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}/{cedula}', 'CitaControllerEspecialista@reprogramarCita');

//Para confirmar cita
Route::delete('confirmarCitEspecialista/{cita}', 'CitaControllerEspecialista@confirmar')->name('confirmarCitEspecialista');

//Para configurar horarios
Route::get('Especialista.configurarHorarios', function () {
    return view('Especialista.configurarHorarios') ;
})->name('Especilista.horarios');

Route::get('/verificarHorarioServicioEspecialista/{recinto}/{servicio}', 'AjaxController@horarioServiciosEspecialista');
Route::get('/annadirHorarioServicioEspecialista/{array_horario_servicio}', 'Horarios_servicioController@annadirActualizarHorariosEspecialista');


Route::resource('cuentas', 'CuentaController');
//Route::get('cuentas', 'CuentaController@index')->name('cuentas.index');
//Confirmar una cita de la lista mostrada al espec/asist conforme el id (especialista, asist)
Route::get('/confirmarCitaAjax/{id_cita}', 'CitaControllerEspecialista@confirmarCitaAjax');

//reprogramar una cita de la lista mostrada al espec/asist conforme el id (especialista, asist)
Route::get('/reprogramarCitaAjax/{id_cita}', 'CitaControllerEspecialista@reprogramarCitaAjax');

//cancelar una cita de la lista mostrada al espec/asist conforme el id (especialista, asist)
Route::get('/cancelarCitaAjax/{id_cita}', 'CitaControllerEspecialista@cancelarCitaAjax');

//ver citas del especialista loggeado en un recinto para hoy
Route::get('citasRecintoParaEspLoggeado/{ID_Recinto}', 'CitaControllerEspecialista@citaRecintoDia');

//ver citas del especialista loggeado en un recintode hoy en adelante
Route::get('citasRecintoParaEspLoggeadoFuturas/{ID_Recinto}', 'CitaControllerEspecialista@citaRecintoAPartirHoy');

//Carga TODAS las citas (histórico) confirmadas/reservadas del esp loggeado (esp)
Route::get('/citasRecintoParaEspLoggeadoHistActivas/{id_recinto}', 'CitaControllerEspecialista@historicoCitasActivasRecinto');

//Lleva al especialista a la página para ver citas de hoy en adelante (según recinto)
Route::get('/redirCitasAPartirHoy',function() {
    return view('Especialista.citasFuturas');
});

//Lleva al especialista a la página para ver citas de hoy en adelante (según recinto)
Route::get('/redirCitasHoyEsp',function() {
    return view('Especialista.index');
});

//Lleva al especialista a la página para ver citas activas históricas (según recinto)
Route::get('/redirCitasHistEsp',function() {
    return view('Especialista.citasTotales');
});

//ver citas de un recinto y un estado para el día actual (asist)
Route::get('citasAsistRecintoEstadoHoy/{ID_Recinto}/{estado}', 'CitaControllerAsistente@citaRecintoEstadoHoy');

//trae los estados de la tabla Estados_Cita (asist)
Route::get('/traerEstadosCitas', 'AjaxController@estadosCitas');







