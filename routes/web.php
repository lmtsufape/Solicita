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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('autenticacao.login');
})->name('login');

Route::get('/cadastro',function(){
    return view('autenticacao.cadastro');
})->name('cadastro');

Route::get('/home-servidor',function(){
    return view('telas_servidor.home_servidor');
})->name('home_servidor');

Route::get('/requisicoes-servidor',function(Request $request){
    return view('telas_servidor.requisicoes_servidor', ['titulo' => $request->titulo]);
})->name('requisicoes_servidor');

/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/