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

/* CREO QUE NINGUNO ES NECESARIO
Route::get('master', function () {
    return view('masterAdmin');
});//->middleware('auth.basic');

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

Route::get('horarios', function () {
    return view('Admin/configurarHorarios') ;
});//->middleware('auth.basic');

Route::get('recintos', function () {
    return view('Admin/configurarRecintos') ;
});//->middleware('auth.basic');

Route::get('servicios', function () {
    return view('Admin/configurarServicios') ;
});//->middleware('auth.basic');


//---------------------------------------
//Rutas Paciente
//---------------------------------------

Route::get('paciente', function () {
    return view('Paciente/index') ;
});//->middleware('auth.basic');

Route::get('citas', function () {
    return view('Paciente/citas') ;
});//->middleware('auth.basic');

Route::get('perfil', function () {
    return view('Paciente/perfil') ;
});//->middleware('auth.basic');

Route::get('informacion', function () {
    return view('Paciente/informacion') ;
});//->middleware('auth.basic');

Route::get('datepicker', function () {
    return view('Paciente/datepicker');
});


//---------------------------------------
//---------------------------------------

Route::post('login', 'Auth\LoginController@login')-> name('login');

Route::post('/test/save', ['as' => 'save-date',
                           'uses' => 'DateController@showDate', 
                            function () {
                                return '';
                            }]);
                            
// Rutas de la tabla especialista

Route::get('especialistas', 'EspecialistaController@index');

Route::get('especialistas/{cedula}/editarEspecialista', 'EspecialistaController@editarEspecialista');

Route::get('especialistas/{cedula}/eliminarEspecialista', 'EspecialistaController@eliminarEspecialista');

Route::post('especialistas/{cedula}/actualizarEspecialista', 'EspecialistaController@actualizarEspecialista');

Route::view('especialistas/viewAnnadir', 'Especialista.annadirEspecialista');

Route::post('especialistas/agregarEspecialista', 'EspecialistaController@agregarEspecialista');

//Fin rutas tabla especialista

//Rutas tabla recinto
Route::resource('recintos', 'RecintoController');
Route::view('recintos/viewAnnadir', 'Recinto.annadirRecinto');
Route::get('recintos/{ID_Recinto}/eliminarRecinto', 'RecintoController@eliminarRecinto');
Route::post('recintos/agregarRecinto', 'RecintoController@agregarRecinto');
Route::get('recintos/{id}/editarRecinto', 'RecintoController@editarRecinto');
Route::post('recintos/{id}/actualizarRecinto', 'RecintoController@actualizarRecinto');
//Fin rutas recinto


//------------------------Rutas para correos
//Route::get('send/email/{email}/{name}/{fecha}', 'correoCitaController@mail');

Route::get('send/email/{email}/{name}/{fecha}/{hora}', 'CorreoCitaController@mail');


//Rutas prueba comboxo autorefresh
Route::get('/recintosCombo', 'AjaxController@combobox');

Route::get('/serviciosCombo/{ID_Recinto}', 'AjaxController@comboServicios');

Route::get('/especialistasCombo/{ID_Servicio}', 'AjaxController@comboEspecialistas');


Route::get('combobox',function(){
    return view('PruebaCombobox.pruebacombo');
 });

Route::get('ajax',function(){
    return view('message');
 });
 Route::get('/getmsg','AjaxController@index');
 
//Fin rutas pruebas combobox autorefresh



//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
