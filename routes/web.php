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
});//->middleware('auth.basic');

 Route::get('/',function () {
     return view('auth/login');
 });//->middleware('auth.basic');

Route::get('prueba', function () {
    return view('Prueba/index') ;
});//->middleware('auth.basic');

Route::get('paciente', function () {
    return view('Prueba/paciente') ;
});//->middleware('auth.basic');

Route::post('login', 'Auth\LoginController@login')-> name('login');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
