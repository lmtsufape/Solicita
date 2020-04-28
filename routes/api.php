<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('Api')->group(function(){


	Route::post('/register', 'AuthController@register');
	Route::post('/login', 'AuthController@login');
	Route::post('/logout', 'AuthController@logout');

	

	Route::group(['middleware'=>['jwt.auth']], function(){
		Route::prefix('cursos')->group(function(){
			Route::get('/', 'CursoController@index');
		});

		Route::prefix('requisicaos')->group(function(){
			Route::get('/', 'RequisicaoController@index');
			Route::post('/listarRequisicoes', 'RequisicaoController@getRequisicoes');
			Route::post('/preparaNovaRequisicao', 'RequisicaoController@preparaNovaRequisicao');
			Route::post('/novaRequisicao', 'RequisicaoController@novaRequisicao');

		});
		Route::prefix('documentos')->group(function(){
			Route::get('/', 'DocumentoController@index');
		});

		Route::prefix('alunos')->group(function(){
			Route::get('/', 'AlunoController@index');
		});

		Route::prefix('requisicao_documentos')->group(function(){
			Route::get('/', 'RequisicaoDocumentoController@index');
		});

		Route::prefix('perfils')->group(function(){
			Route::get('/', 'PerfilController@index');
		});

		Route::prefix('instituicaos')->group(function(){
			Route::get('/', 'InstituicaoController@index');
		});

		Route::prefix('unidades')->group(function(){
			Route::get('/', 'UnidadeController@index');
		});
	});

	
});