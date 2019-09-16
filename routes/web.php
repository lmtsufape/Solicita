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
Route::get('/cadastro-servidor', 'ServidorController@servidores');
Route::post('/cadastro-servidor', 'ServidorController@storeServidor');

Route::get('/', function () {
    return view('autenticacao.login');
})->name('login');

Route::get('/cadastro',function(){
    return view('autenticacao.cadastro');
})->name('cadastro');

Route::get('/cadastro-servidor', function(){
    return view('autenticacao.cadastro-servidor');
})->name('cadastro-servidor');

Route::get('/requisicoes', function(){
    return view('autenticacao.requisicoes');
});

Route::get('/nome-documento', function(){
    return view('autenticacao.nome-documento');
})->name('nome_documento');

Route::get('/fulano', function(){
    return view('autenticacao.fulano');
});

Route::get('/servidores', function(){
    return view('autenticacao.servidores');
});
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
