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
Route::get('/home-administrador','AdministradorController@index')->name('home-administrador');
Route::get('/cancela-cadastro','AdministradorController@cancel')->name('cancela-cadastro');

//percurso da tela inicial do sistema para a home do aluno
Route::get('/home-aluno', 'AlunoController@index')->name('home-aluno');
//preparacao para a requisicao com a chamada da view de formulario de requisicao
Route::get('/formulario-requisicao', 'AlunoController@preparaNovaRequisicao')->name('formulario-requisicao');
Route::post('/formulario-requisicao', 'AlunoController@novaRequisicao')->name('formulario-requisicao');

//confirmacao da requisicao
Route::get('/confirmacao-requisicao', 'AlunoController@confirmacaoRequisicao')->name('confirmacao-requisicao');
Route::get('/cancela-requisicao', 'AlunoController@cancelaRequisicao')->name('cancela-requisicao');

Route::get('/home-servidor',function(){
    return view('telas_servidor.home_servidor');
})->name('home_servidor');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
