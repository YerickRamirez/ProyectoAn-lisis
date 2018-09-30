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

//Route::get('/', function () {
  //  return view('masterAdmin');
//});

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

