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

Route::get('master', function () {
    return view('masterAdmin');
});

 Route::get('/',function () {
     return view('Prueba.login');
 });

Route::get('prueba', function () {
    return view('Prueba/index') ;
});

Route::get('paciente', function () {
    return view('Prueba/paciente') ;
});

Route::post('login', 'Auth\LoginController@login')-> name('login');


Route::get('datepicker', function () {
    return view('Prueba/datepicker');
});

Route::post('/test/save', ['as' => 'save-date',
                           'uses' => 'DateController@showDate', 
                            function () {
                                return '';
                            }]);
// Rutas de la tabla especialista
Route::resource('especialistas', 'EspecialistaController');

Route::get('especialistas/{cedula}/editarEspecialista', 'EspecialistaController@editarEspecialista');

Route::get('especialistas/{cedula}/eliminarEspecialista', 'EspecialistaController@eliminarEspecialista');

Route::post('especialistas/{cedula}/actualizarEspecialista', 'EspecialistaController@actualizarEspecialista');
//Fin rutas tabla especialista

