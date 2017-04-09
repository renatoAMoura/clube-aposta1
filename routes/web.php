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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>['web']],function(){
    Route::resource('campeonato','CampeonatoController');
});

Route::group(['middleware'=>['web']],function(){
    Route::resource('time','TimeController');
});


Route::group(['middleware'=>['web']],function(){
    Route::resource('jogo','JogoController');
});

Route::group(['middleware'=>['web']],function(){
    Route::resource('classificacao','ClassificacaoController');
});


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');
