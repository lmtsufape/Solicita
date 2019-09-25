<?php
use Illuminate\Http\Request;
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

Route::get('/', 'AlunoController@index')->name('login');

Route::get('/cadastro','AlunoController@createAluno')->name('cadastro');
Route::post('/cadastro','AlunoController@storeAluno')->name('cadastro');


Route::get('/', 'Usuario@index')->name('login');
//ROTAS PARA VARIAÇÕES DOS SERVIDORES

Route::get('/cadastro-servidor','ServidorController@index')->name('cadastro-servidor');
Route::post('/cadastro-servidor','ServidorController@storeServidor')->name('cadastro-servidor');
Route::get('/home-administrador','AdministradorController@index')->name('home-administrador');
Route::get('/cancela-cadastro','AdministradorController@cancel')->name('cancela-cadastro');

//percurso da tela inicial do sistema para a home do aluno
Route::get('/home-aluno', 'AlunoController@index')->name('home-aluno');
Route::get('/prepara-requisicao', 'AlunoController@preparaNovaRequisicao')->name('prepara-requisicao');
Route::get('/formulario-requisicao', 'AlunoController@preparaNovaRequisicao')->name('formulario-requisicao');

Route::post('/confirmacao-requisicao', 'AlunoController@novaRequisicao')->name('confirmacao-requisicao'); //----------------------

Route::get('/cancela-requisicao', 'AlunoController@cancelaRequisicao')->name('cancela-requisicao');

Route::get('/home-servidor',function(){
    return view('telas_servidor.home_servidor');
})->name('home_servidor');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
