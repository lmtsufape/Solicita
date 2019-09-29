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


Route::get('/', 'UsuarioController@index')->name('login');
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

//Route::get('/listar-requisicoes','listarRequisicoesController@index')->name('listar-requisicoes');
Route::get('/listar-requisicoes',function(Request $request){
    return view('telas_servidor.requisicoes_servidor', ['titulo' => $request->titulo]);
})->name('listar-requisicoes');
Route::get('/home-aluno',function(){
    return view('autenticacao.home-aluno');
})->name('home-aluno');

//Formulário de requisicao
Route::get('/formulario-requisicao','RequisicaoController@index')->name('formulario-requisicao');
Route::post('/formulario-requisicao','RequisicaoController@storeRequisicao')->name('formulario-requisicao-post');

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
