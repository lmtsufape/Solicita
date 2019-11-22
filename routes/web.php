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
//----------------------------------------------USUARIO----------------------------------------------------------------
Route::get('/', 'AlunoController@index')->name('login');
// ---------------------------------------------ALUNO-------------------------------------------------------------------
Route::get('/cadastro','AlunoController@createAluno')->name('cadastro');
Route::post('/cadastro','AlunoController@storeAluno')->name('cadastro');

//----------------------------------------------ADMINISTRADOR-----------------------------------------------------------
Route::group(['middleware'=> 'CheckAdministrador'], function(){
    Route::get('/home-administrador','AdministradorController@index')->name('home-administrador')->middleware('CheckAdministrador');
    Route::get('/cadastro-servidor','ServidorController@homeServidor')->name('cadastro-servidor')->middleware('CheckAdministrador');
    Route::post('/confirmacao-servidor','ServidorController@storeServidor')->name('confirmacao-servidor')->middleware('CheckAdministrador');
    Route::get('/cancela-cadastro','ServidorController@cancel')->name('cancela-cadastro')->middleware('CheckAdministrador');
});

//----------------------------------------------SERVIDOR----------------------------------------------------------------
Route::group(['middleware'=> 'CheckServidor'], function(){

  // Route::post('/filtrar-requisicoes/{curso_id?}','RequisicaoController@filtrarCurso')->name('filtrar-requisicoes-post')->middleware('CheckServidor');

  Route::post('/indefere-requisicoes/{requisicao_id?}','RequisicaoController@indeferirRequisicao')->name('indefere-requisicoes-post')->middleware('CheckServidor');
  Route::get('/listar-requisicoes','RequisicaoController@getRequisicoes')->name('listar-requisicoes')->middleware('CheckServidor');
  Route::post('/listar-requisicoes','RequisicaoController@concluirRequisicao')->name('listar-requisicoes-post')->middleware('CheckServidor');
  Route::get('/home-servidor','ServidorController@index')->name('home_servidor')->middleware('CheckServidor');
  Route::get('/home-servidor','ServidorController@index')->name('cadastro-servidor')->middleware('CheckServidor');
  Route::post('/novo-servidor','ServidorController@storeServidor')->name('novo-servidor')->middleware('CheckServidor');
  Route::get('/alterar-senha-servidor','ServidorController@alterarSenhaServidor')->name('alterar-senha-servidor')->middleware('CheckServidor');
  Route::post('/alterar-senha-servidor','ServidorController@storeAlterarSenhaServidor')->name('alterar-senha-servidor')->middleware('CheckServidor');
  Route::get('/home-servidor','ServidorController@index')->name('home_servidor')->middleware('CheckServidor');
});

Route::group(['middleware'=> 'CheckAluno'], function(){
    Route::get('/home-aluno', 'AlunoController@index')->name('home-aluno')->middleware('CheckAluno');
    Route::get('/home-aluno','AlunoController@homeAluno')->name('home-aluno')->middleware('CheckAluno');
    Route::get('/listar-requisicoes-aluno','AlunoController@listarRequisicoes')->name('listar-requisicoes-aluno')->middleware('CheckAluno');
    Route::post('/confirmacao-requisicao', 'RequisicaoController@novaRequisicao')->name('confirmacao-requisicao')->middleware('CheckAluno'); //------------
    Route::post('/finaliza-requisicao', 'RequisicaoController@finalizaRequisicao')->name('finaliza-requisicao')->middleware('CheckAluno');
    Route::get('/cancela-requisicao', 'RequisicaoController@cancelaRequisicao')->name('cancela-requisicao')->middleware('CheckAluno');
    Route::get('/prepara-requisicao', 'RequisicaoController@preparaNovaRequisicao')->name('prepara-requisicao')->middleware('CheckAluno');
    Route::get('/confirmacao-requisicao',function(){
      return view('autenticacao.confirmacao-requisicao');
    })->name('confirmacao-requisicao')->middleware('CheckAluno');
    Route::get('/perfil-aluno','PerfilAlunoController@index')->name('perfil-aluno')->middleware('CheckAluno');
    Route::get('/editar-perfil','PerfilAlunoController@editarInfo')->name('editar-info')->middleware('CheckAluno');
    Route::get('/exibir-perfil-aluno','PerfilAlunoController@editarInfo')->name('exibir-perfil-aluno')->middleware('CheckAluno');
    Route::post('/editar-perfil','PerfilAlunoController@storeEditarInfo')->name('editar-info')->middleware('CheckAluno');
    Route::post('/excluir-perfil{idPerfil?}','PerfilAlunoController@excluirPerfil')->name('excluir-perfil')->middleware('CheckAluno');
    Route::post('/perfil-padrao{idPerfilPadrao?}','PerfilAlunoController@definirPerfilDefault')->name('perfil-padrao')->middleware('CheckAluno');
    Route::get('/adiciona-perfil', 'PerfilAlunoController@adicionaPerfil')->name('adiciona-perfil')->middleware('CheckAluno');
    Route::post('/salva-novo-perfil-aluno', 'PerfilAlunoController@salvaPerfil')->name('salva-novo-perfil-aluno')->middleware('CheckAluno');
    Route::post('/salva-novo-perfil-aluno', 'PerfilAlunoController@salvaPerfil')->name('salva-novo-perfil-aluno')->middleware('CheckAluno');
    Route::get('/alterar-senha','PerfilAlunoController@alterarSenha')->name('alterar-senha')->middleware('CheckAluno');
    Route::post('/alterar-senha','PerfilAlunoController@storeAlterarSenha')->name('alterar-senha')->middleware('CheckAluno');
    Route::get('/formulario-requisicao','RequisicaoController@index')->name('formulario-requisicao')->middleware('CheckAluno');
    Route::post('/formulario-requisicao','RequisicaoController@storeRequisicao')->name('formulario-requisicao-post')->middleware('CheckAluno');
});
// ---------------------------------------REQUISICAO------------------------------------------------------------------
Auth::routes(['verify' => true]);
// Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/mail-send', 'MailController@send');

 // Route::get('/edita-perfil','PerfilController@editaPerfil')->name('edita-perfil');
 // Route::get('/adiciona-perfil', 'PerfilController@adicionaPerfil')->name('adiciona-perfil');//SUPRIMIR
 // Route::post('/excluir-perfil','PerfilAlunoController@excluirPerfil')->name('excluir-perfil');
 // Route::get('/', 'UsuarioController@index')->name('login');
 // Route::post('/confirmacao-requisicao', 'AlunoController@novaRequisicao')->name('confirmacao-requisicao'); //------------
 // Route::post('/finaliza-requisicao', 'AlunoController@finalizaRequisicao')->name('finaliza-requisicao');
 // Route::get('/cancela-requisicao', 'AlunoController@cancelaRequisicao')->name('cancela-requisicao');
 // Route::get('/prepara-requisicao', 'AlunoController@preparaNovaRequisicao')->name('prepara-requisicao');
 // Route::post('/excluir-perfil','PerfilAlunoController@excluirPerfil')->name('excluir-perfil');
