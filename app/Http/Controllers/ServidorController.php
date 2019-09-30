<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Curso;
use App\User;
use App\Servidor;
use App\Unidade;
class ServidorController extends Controller
{
  public function index(){
    $unidades = Unidade::All();
    $usuarios = User::All();
    return view('autenticacao.cadastro-servidor',compact('users','unidades'));
    //return view ('autenticacao.cadastro-servidor');
  }
  public function storeServidor(Request $request) {
  //INSTANCIA DO USUARIO
    $usuario = new User();
    $usuario->name = $request->input('name');
    $usuario->email = $request->input('email');
    $usuario->password = $request->input('password');
    $usuario->save();
  //INSTANCIA DO SERVIDOR
    $servidor = new Servidor();
    $servidor->matricula = $request->input('matricula');
    $servidor->unidade_id = 1;
    $servidor->user_id = $usuario->id;
    $servidor->save();
    return redirect('/home-administrador')->with('jsAlert', 'Servidor cadastrado com sucesso!!');;
  }
  public function listaServidores(){
        return view('/autenticacao.home-administrador'); //redireciona para view
  }
  public function cancel(){
        return view('/autenticacao.home-administrador'); //redireciona para view
  }

  public function homeServidor(){
    $cursos = Curso::all();
    $tipoDocumento = ['Declaração de Vínculo','Comprovante de Matrícula','Histórico','Programa de Disciplina','Outros','Todos'];
    return view('telas_servidor.home_servidor', ['cursos'=>$cursos,'tipoDocumento'=>$tipoDocumento]);
  }
