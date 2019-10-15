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

Route::get('/home-administrador','AdministradorController@index')->name('home-administrador');

Route::get('/home-servidor','ServidorController@index')->name('home_servidor');
Route::get('/', 'UsuarioController@index')->name('login');
//ROTAS PARA VARIAÇÕES DOS SERVIDORES
Route::get('/home-servidor','ServidorController@index')->name('cadastro-servidor');
Route::get('/cadastro-servidor','ServidorController@homeServidor')->name('cadastro-servidor');
Route::post('/confirmacao-servidor','ServidorController@storeServidor')->name('confirmacao-servidor');
// Route::get('/home-administrador','AdministradorController@index')->name('home-administrador');
Route::get('/cancela-cadastro','ServidorController@cancel')->name('cancela-cadastro');
Route::post('/novo-servidor','ServidorController@storeServidor')->name('novo-servidor');
//percurso da tela inicial do sistema para a home do aluno
Route::get('/alterar-senha-servidor','ServidorController@alterarSenhaServidor')->name('alterar-senha-servidor');
Route::post('/alterar-senha-servidor','ServidorController@storeAlterarSenhaServidor')->name('alterar-senha-servidor');

Route::get('/home-aluno', 'AlunoController@index')->name('home-aluno');
Route::get('/prepara-requisicao', 'AlunoController@preparaNovaRequisicao')->name('prepara-requisicao');
// Route::get('/formulario-requisicao', 'AlunoController@preparaNovaRequisicao')->name('formulario-requisicao');
Route::post('/confirmacao-requisicao', 'AlunoController@novaRequisicao')->name('confirmacao-requisicao'); //----------------------
Route::post('/finaliza-requisicao', 'AlunoController@finalizaRequisicao')->name('finaliza-requisicao');
Route::get('/cancela-requisicao', 'AlunoController@cancelaRequisicao')->name('cancela-requisicao');
Route::get('/home-servidor','ServidorController@index')->name('home_servidor');

Route::get('/listar-requisicoes','RequisicaoController@getRequisicoes')->name('listar-requisicoes');
Route::post('/listar-requisicoes','RequisicaoController@concluirRequisicao')->name('listar-requisicoes-post');
Route::get('/home-aluno','AlunoController@homeAluno')->name('home-aluno');
Route::get('/perfil-aluno','PerfilAlunoController@index')->name('perfil-aluno');
Route::get('/editar-perfil','PerfilAlunoController@editarInfo')->name('editar-info');
Route::get('/exibir-perfil-aluno','PerfilAlunoController@editarInfo')->name('exibir-perfil-aluno');
Route::post('/editar-perfil','PerfilAlunoController@storeEditarInfo')->name('editar-info');
// Route::post('/excluir-perfil','PerfilAlunoController@excluirPerfil')->name('excluir-perfil');
Route::post('/excluir-perfil','PerfilAlunoController@excluirPerfil')->name('excluir-perfil');

Route::get('/adiciona-perfil', 'PerfilAlunoController@adicionaPerfil')->name('adiciona-perfil');
Route::post('/salva-novo-perfil-aluno', 'PerfilAlunoController@salvaPerfil')->name('salva-novo-perfil-aluno');
Route::get('/alterar-senha','PerfilAlunoController@alterarSenha')->name('alterar-senha');
Route::post('/alterar-senha','PerfilAlunoController@storeAlterarSenha')->name('alterar-senha');

//Formulário de requisicao
Route::get('/formulario-requisicao','RequisicaoController@index')->name('formulario-requisicao');
Route::post('/formulario-requisicao','RequisicaoController@storeRequisicao')->name('formulario-requisicao-post');

Route::get('/confirmacao-requisicao',function(){
    return view('autenticacao.confirmacao-requisicao');
})->name('confirmacao-requisicao');
 Auth::routes();
 Route::get('/home', 'HomeController@index')->name('home'); //redireciona para a home de acordo com o tipo
