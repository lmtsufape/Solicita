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
    return view('autenticacao.login');
})->name('login');

Route::get('/cadastro',function(){
    return view('autenticacao.cadastro');
})->name('cadastro');

Route::get('/', 'Usuario@index')->name('login');
//ROTAS PARA VARIAÇÕES DOS SERVIDORES
Route::get('/cadastro-servidor','ServidorController@index')->name('cadastro-servidor');
Route::post('/cadastro-servidor','ServidorController@storeServidor')->name('cadastro-servidor');
Route::get('/home-administrador','ServidorController@listaServidores')->name('lista-servidores');
Route::get('/home-administrador','ServidorController@cancel')->name('cancela-cadastro');

Route::get('/nome-documento', function(){
    return view('autenticacao.nome-documento');
})->name('nome_documento');

Route::get('/home-servidor',function(){
    return view('telas_servidor.home_servidor');
})->name('home_servidor');

Route::get('/home-aluno',function(){
    return view('autenticacao.home-aluno');
})->name('home-aluno');

Route::get('/formulario-requisicao',function(){
    return view('autenticacao.formulario-requisicao');
})->name('formulario-requisicao');

Route::get('/confirmacao-requisicao',function(){
    return view('autenticacao.confirmacao-requisicao');
})->name('confirmacao-requisicao');

Route::get('/confirmacao-requisicao',function(){
    return view('autenticacao.home-aluno');
})->name('confirmacao-requisicao');

 Route::get('/home-aluno', function(){
     return view('autenticacao.formulario-requisicao');
 })->name('formulario-requisicao');

 Auth::routes();
 Route::get('/home', 'HomeController@index')->name('home');
