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
})->middleware('auth.basic');

 Route::get('/',function () {
     return view('auth/login');
 });//->middleware('auth.basic');

Route::get('prueba', function () {
    return view('Prueba/index') ;
})->middleware('auth.basic');

Route::get('paciente', function () {
    return view('Prueba/paciente') ;
})->middleware('auth.basic');

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

Route::resource('especialistas/viewAnnadir', 'EspecialistaController@viewAnnadir');

Route::any('especialistas/agregarEspecialista', 'EspecialistaController@agregarEspecialista');

//Fin rutas tabla especialista


//Rutas prueba comboxo autorefresh
Route::any('combobox', 'EspecialistaController@combobox');
//Fin rutas pruebas combobox autorefresh


//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

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
