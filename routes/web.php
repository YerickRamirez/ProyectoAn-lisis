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
*/

Route::get('/log',function () {
    return view('auth/login');
});

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
    return redirect('cuentas') ;
})->middleware('admin');

Route::get('cuentas', function () {
    return view('Admin/configurarCuentas') ;
})->middleware('admin');

Route::get('crearCuentas', function () {
    return view('cuentas/create') ;
})->middleware('admin');//no estoy seguro de que sea admin


/*Route::get('horarios', function () {
    return view('Admin/configurarHorarios') ;
});*/ //esta estaba casi que repetida


Route::get('recintos', function () {
    return view('recintos/index');
})->middleware('admin');

//estas de cuentas las usan root y esp
Route::get('cuentas/create', function(){return view('cuentas/create');}) ->name('Prueba.adn')->middleware('asistente');
Route::post('crearCuenta', 'CuentaController@store')->middleware('asistente');
//fin estas de cuentas las usan root y esp

/* esta ruta literal no hace nada
Route::get('Admin/configurarRecintos')->name('admin.recintos');
*/

Route::resource('servicio', 'ServicioController')->middleware('admin');

//---------------------------------------
//Rutas Paciente
//---------------------------------------
//Para acceder a metodos del controlador Paciente
//todo mundo usa ese controlador de paciente :c
Route::resource('pacientes', 'PacienteController')->middleware('paciente');

//Pestanna para cambiar contrasenna del paciente
Route::get('cambioContrasenna', function () {
    return view('pacientes/cambiarContrasenna');
})->middleware('paciente');


//Controlador para contrasennas de pacientes
Route::resource('contrasennas', 'cambiarContrasennaController')->middleware('paciente'); 

//Para acceder a la pagina de editar generada por el scaffold
Route::get('perfilPaciente', 'PacienteController@edit')->middleware('paciente');

//Para dirigir a la pagina principal de pacientes sin tener que poner citas en la url
Route::get('paciente', function () {
    return redirect()->route('citas.index');
})->middleware('paciente');


/*Este no sé qué era, así que lo comenté, parece una simple prueba////////////////////////////////////////
Route::get('insertarUserPaciente', 'PacientePrueba@insertarUsuarioPaciente');//->middleware('auth');
*/

/*CAMBIO DE CONTRASENNA ROOT */
Route::get('contrasennaAdmin', function() {
    return view('Admin/cambiarContrasenna');
})->middleware('admin');

Route::resource('cambiarContrasennaAdmin', 'ContrasennaRootController')->middleware('admin');
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

Route::get('datepicker', function () {
    return view('Paciente/datepicker');
});
*/

//---------------------------------------
//---------------------------------------

//este tiene el guest y prefiero no tocar, además es login, todos pueden sin problema
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

Route::resource('especialistas', 'EspecialistaController')->middleware('admin');

//Route::get('vinculoRecinto', 'Recinto_servicioController@index');

Route::resource('recinto_servicios', 'Recinto_servicioController')->middleware('admin');

Route::get('eliminarVinculo/{servicio}/{recinto}', 
['as'=>'eliminarVinculo1','uses'=>'Recinto_servicioController@eliminar'])->middleware('admin');


Route::resource('especialista_servicios', 'Especialista_servicioController')->middleware('admin');

Route::get('eliminarVinculoEspecialista/{servicio}/{recinto}/{especialista}',
 ['as'=>'eliminarVinculoEspecialista1','uses'=>'Especialista_servicioController@eliminar'])->middleware('admin');

 Route::get('/vincularEspecialista/{servicio}/{recinto}/{especialista}', 
 'Especialista_servicioController@store')->middleware('admin');

 //sirve para traer todos los especialistas (bloqueo_esp root, master, asist)
 Route::get('cargarEspecialistas', 'AjaxController@cargarEspecialistas')->middleware('asistente');
 
 //sirve para traer el especialista loggeado (esp)
 Route::get('cargarEspecialistaLoggeado', 'AjaxController@cargarEspecialistaLoggeado')->middleware('especialista');

//Rutas tabla recinto
Route::resource('recintos', 'RecintoController')->middleware('admin');
//Fin rutas recinto


//------------------------Rutas para correos dejar sin middleware, si algo de eso explota es acá. xD
/*
Route::get('send/email/{email}/{name}/{fecha}/{hora}', 'CorreoCitaController@mail');

Route::get('sendCancelacion/email/{email}/{name}/{fecha}', 'CancelacionCitaController@mail');
*/
Route::get('recuperar/email/{email}', 'recuperarContrasennaController@mail');


//Rutas prueba ajax
Route::get('/recintosCombo', 'AjaxController@combobox')->middleware('paciente');
Route::get('/serviciosCombo/{ID_Recinto}', 'AjaxController@comboServicios')->middleware('paciente');
Route::get('/serviciosCombo', 'AjaxController@cargarServicios')->middleware('paciente');
Route::get('/vincular/{servicio}/{recinto}', 'Recinto_servicioController@store')->middleware('admin');
Route::get('/especialistasCombo/{ID_Servicio}/{ID_Recinto}', 'AjaxController@comboEspecialistas')->middleware('paciente');
Route::get('/especialistasComboSinHorario/{ID_Servicio}/{ID_Recinto}', 'AjaxController@comboEspecialistasSinHorario')->middleware('paciente');
Route::get('/verificarCitas/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}', 'AjaxController@datosCita')->middleware('paciente');

//ruta prueba para sugerir citas
Route::get('/sugerirCitas/{dropRecintos}/{dropServicios}/{dropEspecialistas}', 'AjaxController@datosSugerirCita')->middleware('paciente');
//fin rutas de ajax


//parece que solo la usa paciente (y creo que el store lo usan todos)
Route::resource('citas', 'CitaController')->middleware('paciente');

//Ruta añadir citas (creo que solo la usa paciente)
Route::get('/annadirCita/{horaCita}/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}', 'CitaController@store')->middleware('paciente');

//ruta reprogramarCita 
Route::get('/annadirCitaAsistente/{horaCita}/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}/{cedula}', 'CitaControllerAsistente@reprogramarCitaAsistente')->middleware('asistente');

//ruta añadir cita (asist, esp)
Route::get('/annadirCitaAsistenteEsp/{horaCita}/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}/{cedula}', 'CitaControllerAsistente@store')->middleware('asistente');
//

Route::get('combobox',function(){
    return view('PruebaCombobox.pruebacombo');
 })->middleware('paciente');
 //ese es un ejemplo, a combobox debería de ser pacientes
 
//Fin rutas pruebas combobox autorefresh



// Authentication Routes... no las voy a tocar con middle, no tiene sentido (quizá guest)
Route::get('login',function () {
    if(Auth::check()) {
        auth()->logout();
    }
    return view('auth/login');
});
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Registration Routes... no las voy a tocar con middle, no tiene sentido (quizá guest)
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes... no las voy a tocar con middle, no tiene sentido (quizá guest)
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Ni idea de qué carajos es no lo voy a tocar
Auth::routes();

//Rutas horarios servicios////////////////////////////////////////
Route::get('horarios', function () {
    return view('Admin/configurarHorarios') ;
})->name('Admin.horarios')->middleware('admin');

Route::get('horarios_servicios', function () {
    return view('horarios_servicios/index') ;
})->name('horarios_servicios.index')->middleware('admin');

Route::get('/verificarHorarioServicio/{recinto}/{servicio}/{especialista}', 'AjaxController@horarioServicios')->middleware('asistente');
Route::get('/annadirHorarioServicio/{array_horario_servicio}', 'Horarios_servicioController@annadirActualizarHorarios')->middleware('asistente');


/**Rutas Asistente index, configurar horarios, reservar y reprogramar citas  */
Route::get('horarios_servicios_asistente.index', function () {
    return view('horarios_servicios_asistente.index') ;
})->name('horarios_serv_asis.index')->middleware('asistente');

Route::get('horarios_servicios_asistente', function () {
    return view('asistente.configurarHorarios') ;
})->name('Asistente.horarios')->middleware('asistente');;


//crear cita asist, la usa asist
Route::get('asistente.crearCita', function () {
    return view('asistente.crearCita') ;
})->name('Asistente.crearCita')->middleware('asistente');


Route::get('asistente.configuracionCuentas', function () {
    return view('asistente.configuracionCuentas') ;
})->name('asistente.confCuentas')->middleware('asistente');

//No tocar aún, no sé qué o quién lo usa
Route::get('/hola', 'AjaxController@cargarCitas');


Route::delete('destroyCitAsistente{cita}', 'CitaControllerAsistente@destroy')->name('destroyCitAsistente')->middleware('asistente');
Route::delete('reprogramarCitAsistente{cita}', 'CitaControllerAsistente@reprogramar')->name('reprogramarCitAsistente')->middleware('asistente');
Route::delete('confirmarCitAsistente{cita}', 'CitaControllerAsistente@confirmar')->name('confirmarCitAsistente')->middleware('asistente');
Route::resource('asistente', 'CitaControllerAsistente')->middleware('asistente');
Route::get('asistente', 'CitaControllerAsistente@index')->middleware('asistente');
Route::get('asistente', 'CitaControllerAsistente@index')->name('asistente.index')->middleware('asistente');
Route::get('/reprogramarCitaAsistente/{horaCita}/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}/{cedula}', 'CitaControllerAsistente@reprogramarCita')->middleware('asistente');

//ruta sacar cita (asist)
Route::get('reservarCita',function(){
    return view('asistente.crearCita');
 })->middleware('asistente');

 //ruta sacar cita (esp)
 Route::get('reservarCitaEsp',function(){
    return view('especialista_citas.crearCita');
 })->middleware('asistente');

 
///////////////////Fin rutas asistente//////////////////////////////////////////// 


//Se usa para desloggear un usuario. Yo (Seney) lo uso para desloggear apenas se registran
//no ponerle middle (quizá guest)
Route::get('logoutUsuarioRecienRegistrado', 'AjaxController@logoutMensajeRegistro');

/*borrar ruta y gráfica
Route::get('/algo', function() {
    return view('algo');
});
*/

//sirve para llenar los drops de los días bloqueados (asist, especialista, root)
Route::get('dropDiasBloqueo', 'AjaxController@dropDiasBloqueo')->middleware('asistente');

//resource de bloqueoEspecialistas para root
Route::resource('bloqueo_especialistas', 'Bloqueo_especialistumController')->middleware('asistente');
//resource de deshabilitarEspecialistas para root
Route::resource('deshab_especialistas', 'Deshabilitar_horarios_especialistaController')->middleware('asistente');

//resource de bloqueoEspecialistas para asistentes
Route::resource('bloqueo_especialistas_asist', 'Bloqueo_especialistumController')->middleware('asistente');
//resource de deshabilitarEspecialistas para asistente
Route::resource('deshab_asist', 'Deshabilitar_horarios_especialistaController')->middleware('asistente');

//resource de bloqueoEspecialistas para especialistas
Route::resource('bloqueo_especialistas_especial', 'Bloqueo_especialistumController')->middleware('asistente');
//resource de deshabilitarEspecialistas para especialistas
Route::resource('deshab_especial', 'Deshabilitar_horarios_especialistaController')->middleware('asistente');

//para redireccion del especialista, (esp)
Route::get('Especialista.menuConfigHorarios', function () {
    return view('Especialista.menuConfigHorarios') ;
})->name('Especialista.menuConfigHorarios')->middleware('especialista');


//lleva los datos para insertar un bloqueo de un especialista (asist, especialista, root)
Route::get('crearBloqueoEspecialista/{dropEspecialistas}/{dropDiasBloqueo}/{datepickedInicio}/{datepickedFin}/{horaInicio}/{horaFin}', 'Bloqueo_especialistumController@guardarBloqueoEsp')->middleware('asistente');;

////lleva los datos para insertar un deshabilitar de un especialista (asist, especialista, root)
Route::get('crearDeshabEspecialista/{dropEspecialistas}/{datepickedInicio}/{datepickedFin}/{horaInicio}/{horaFin}', 'Deshabilitar_horarios_especialistaController@guardarDeshabEsp')->middleware('asistente');

/* no borrar, se ve importante, pero el método no existe en el controlador
Route::get('redirigirBloqueoEspIndex', 'Bloqueo_especialistumController@redirigirBloqueoEspIndex');
*/

//Rutas del usuario Especialista///////////////////////////////////////////////////////////////////////
//Index
Route::get('Especialista.index', 'CitaControllerEspecialista@index')->name('Especialista.index')->middleware('especialista');
Route::get('Especialista', 'CitaControllerEspecialista@index')->middleware('especialista');

//Para cancelar cita
Route::delete('destroyCitEspecialista{cita}', 'CitaControllerEspecialista@destroy')->name('destroyCitEspecialista')->middleware('especialista');

//Para reprogramar cita //dejar esas así con middle asistente, me parece que después no sirven otras cosas
Route::delete('reprogramarCitEspecialista{cita}', 'CitaControllerEspecialista@reprogramar')->name('reprogramarCitEspecialista')->middleware('asistente');
Route::get('/reprogramarCitEspecialista/{horaCita}/{dropRecintos}/{dropServicios}/{dropEspecialistas}/{datepicked}/{cedula}', 'CitaControllerEspecialista@reprogramarCita')->middleware('asistente');
//Para confirmar cita
Route::delete('confirmarCitEspecialista/{cita}', 'CitaControllerEspecialista@confirmar')->name('confirmarCitEspecialista')->middleware('asistente');

//Para configurar horarios
Route::get('Especialista.configurarHorarios', function () {
    return view('Especialista.configurarHorarios') ;
})->name('Especilista.horarios')->middleware('especialista');

//no estoy seguro, pero trabaja con el id del esp loggeado, dedije que era de esp nada más.
Route::get('/verificarHorarioServicioEspecialista/{recinto}/{servicio}', 'AjaxController@horarioServiciosEspecialista')->middleware('especialista');

//no estoy seguro de quién la puede usar, lo dejé de asist para arriba (me parece lo lógico)
Route::get('/annadirHorarioServicioEspecialista/{array_horario_servicio}', 'Horarios_servicioController@annadirActualizarHorariosEspecialista')->middleware('asistente');

//Resource de cuentas para root //NOTOCAR MIDDLE, SINO ASIST NO PUEDE METER CUENTAS
Route::resource('cuentas', 'CuentaController')->middleware('asistente');

//resource de cuentas para asistente
Route::resource('cuentas_asistente', 'CuentaController')->middleware('asistente');

//resource de cuentas_activas //No sé, creo que debería de ser solo root
Route::resource('cuentas_activas', 'Cuentas_activaController')->middleware('admin');

//Route::get('cuentas', 'CuentaController@index')->name('cuentas.index');
//Confirmar una cita de la lista mostrada al espec/asist conforme el id (especialista, asist)
Route::get('/confirmarCitaAjax/{id_cita}', 'CitaControllerEspecialista@confirmarCitaAjax')->middleware('asistente');

//reprogramar una cita de la lista mostrada al espec/asist conforme el id (especialista, asist)
Route::get('/reprogramarCitaAjax/{id_cita}', 'CitaControllerEspecialista@reprogramarCitaAjax')->middleware('asistente');

//cancelar una cita de la lista mostrada al espec/asist conforme el id (especialista, asist)
Route::get('/cancelarCitaAjax/{id_cita}', 'CitaControllerEspecialista@cancelarCitaAjax')->middleware('asistente');

//ver citas del especialista loggeado en un recinto para hoy
Route::get('citasRecintoParaEspLoggeado/{ID_Recinto}', 'CitaControllerEspecialista@citaRecintoDia')->middleware('especialista');

//ver citas del especialista loggeado en un recintode hoy en adelante
Route::get('citasRecintoParaEspLoggeadoFuturas/{ID_Recinto}', 'CitaControllerEspecialista@citaRecintoAPartirHoy')->middleware('especialista');

//Carga TODAS las citas (histórico) confirmadas/reservadas del esp loggeado (esp)
Route::get('/citasRecintoParaEspLoggeadoHistActivas/{id_recinto}', 'CitaControllerEspecialista@historicoCitasActivasRecinto')->middleware('especialista');

//Lleva al especialista a la página para ver citas de hoy en adelante (según recinto)
Route::get('/redirCitasAPartirHoy',function() {
    return view('Especialista.citasFuturas');
})->middleware('especialista');

//Lleva al especialista a la página para ver citas de hoy (según recinto)
Route::get('/redirCitasHoyEsp',function() {
    return view('Especialista.index');
})->middleware('especialista');

//Lleva al especialista a la página para ver citas activas históricas (según recinto)
Route::get('/redirCitasHistEsp',function() {
    return view('Especialista.citasTotales');
})->middleware('especialista');


//Lleva al asistente a la página para ver citas de hoy en adelante (según recinto y estado)
Route::get('/redirCitasAPartirHoyAsist',function() {
    return view('asistente.citasFuturas');
})->middleware('asistente');

//Lleva al asistente a la página para ver citas de hoy (según recinto y estado)
Route::get('/redirCitasHoyAsist',function() {
    return view('asistente.index');
})->middleware('asistente');

//Lleva al asistente a la página para ver citas históricas (según recinto y estado)
Route::get('/redirCitasHistAsist',function() {
    return view('asistente.citasTotales');
})->middleware('asistente');

//ver citas de un recinto y un estado para el día actual (asist)
Route::get('citasAsistRecintoEstadoHoy/{ID_Recinto}/{estado}', 'CitaControllerAsistente@citaRecintoEstadoHoy')->middleware('asistente');

//trae los estados de la tabla Estados_Cita (asist)
Route::get('/traerEstadosCitas', 'AjaxController@estadosCitas')->middleware('asistente');

//ver citas a partir de hoy según recinto y estado (asist)
Route::get('citasRecintoEstadoAsistFuturas/{ID_Recinto}/{estado}', 'CitaControllerAsistente@citaRecintoEstadoAPartirHoy')->middleware('asistente');

//ver citas históricas según recinto y estado (asist)
Route::get('citasRecintoEstadoAsistHist/{ID_Recinto}/{estado}', 'CitaControllerAsistente@citaRecintoEstadoHist')->middleware('asistente');


////////////////////////////////////////////////////////////////////////////De aquí para abajo no quedé seguro de lo del middleware, hay que probarlo bien
//Para editar los pacientes desde el root
Route::get('pacientes.editRoot/{paciente}', 'PacienteController@editRoot')->name('pacientes.editRoot')->middleware('asistente');

//Para hacer el update de los datos del paciente desde el root
Route::put('pacientes.updateRoot/{paciente}', 'PacienteController@updateRoot')->name('pacientes.updateRoot')->middleware('asistente');

Route::get('asistente/verPacientes', 'PacienteController@index')->middleware('asistente');

Route::delete('pacientes.activar/{paciente}', 'PacienteController@activar')->name('pacientes.activar')->middleware('asistente');

//Elimina cuentas de los usuarios
//Route::delete('destroyCitAsistente{cita}', 'CitaControllerAsistente@destroy')->name('destroyCitAsistente');
Route::get('destroyCuentas/{cuenta}', 'CuentaController@destroy')->name('destroyCuentas')->middleware('asistente');
Route::get('reactivarCuentas/{cuenta}', 'CuentaController@reactivate')->name('reactivarCuentas')->middleware('asistente');

Route::post('activardesactivar', 'Cuentas_activaController@activar')->name('activardesactivar')->middleware('asistente');

Route::post('reestablecer', 'recuperarContrasennaController@mail')->name('reestablecer');
//Route::get('reestablecer', 'recuperarContrasennaController@mail')->name('reestablecer');


//Cambio contraseña asistente
Route::resource('cambiarContrasennaAsistente', 'ContrasenneAsistenteController');
Route::get('contrasennaAsistente', function() {
    return view('asistente/cambiarContrasenna');
})->middleware('asistente');

//Cambio contraseña especialista
Route::resource('cambiarContrasennaEspecialista', 'ContrasenneEspecialistaController');
Route::get('contrasennaEspecialista', function() {
    return view('Especialista/cambiarContrasenna');
})->middleware('especialista');

//Mostrar horario del servicio elegido según recinto y esp
Route::get('/mostrarHorarioEsp/{dropRecintos}/{dropServicios}/{dropEspecialistas}', 'AjaxController@mostrarHorarioEsp')->middleware('paciente');
