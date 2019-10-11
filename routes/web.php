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


Route::get('/cadastro-servidor', function(){
    return view('autenticacao.cadastro-servidor');
})->name('cadastro_servidor');

Route::get('/nome-documento', function(){
    return view('autenticacao.nome-documento');
})->name('nome_documento');

Route::get('/home-servidor','ServidorController@index')->name('home_servidor');

//Route::get('/listar-requisicoes','listarRequisicoesController@index')->name('listar-requisicoes');
/*
Route::get('/listar-requisicoes',function(Request $request){
    return view('telas_servidor.requisicoes_servidor', ['titulo' => $request->titulo]);
})->name('listar-requisicoes');
*/

Route::get('/listar-requisicoes','RequisicaoController@getRequisicoes')->name('listar-requisicoes');

Route::post('/listar-requisicoes','RequisicaoController@concluirRequisicao')->name('listar-requisicoes-post');

Route::get('/home-aluno','AlunoController@homeAluno')->name('home-aluno');

Route::get('/perfil-aluno','PerfilAlunoController@index')->name('perfil-aluno');
Route::get('/editar-perfil','PerfilAlunoController@editarInfo')->name('editar-info');
Route::post('/editar-perfil','PerfilAlunoController@storeEditarInfo')->name('editar-info');


Route::get('/alterar-senha','PerfilAlunoController@alterarSenha')->name('alterar-senha');
Route::post('/alterar-senha','PerfilAlunoController@storeAlterarSenha')->name('alterar-senha');


//Formulário de requisicao
Route::get('/formulario-requisicao','RequisicaoController@index')->name('formulario-requisicao');
Route::post('/formulario-requisicao','RequisicaoController@storeRequisicao')->name('formulario-requisicao-post');

Route::get('/confirmacao-requisicao',function(){
    return view('autenticacao.confirmacao-requisicao');
})->name('confirmacao-requisicao');

Route::get('/listar-requisicoes-aluno','AlunoController@listarRequisicoes')->name('listar-requisicoes-aluno'); //rota para a lista de requisicoes que o aluno solicitou

//Route::get('/confirmacao-requisicao',function(){
//    return view('autenticacao.home-aluno');
//})->name('confirmacao-requisicao');

 // Route::get('/home-aluno', function(){
 //     return view('autenticacao.formulario-requisicao');
 // })->name('formulario-requisicao');

 Auth::routes();

 Route::get('/home', 'HomeController@index')->name('home'); //redireciona para a home de acordo com o tipo
