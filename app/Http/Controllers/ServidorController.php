<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Curso;
use App\User;
use App\Servidor;
use App\Unidade;

class ServidorController extends Controller
{
    public function index(){
        $cursos = Curso::all();
        $tipoDocumento = ['Declaração de Vínculo','Comprovante de Matrícula','Histórico','Programa de Disciplina','Outros','Todos'];
        return view('telas_servidor.home_servidor', ['cursos'=>$cursos,'tipoDocumento'=>$tipoDocumento]);
    }
    public function storeServidor(Request $request) {
      $request->validate([
        'name' => 'required|string|max:255',
        'matricula' => 'required|unique:servidors',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
      ]);
      $usuario = new User();
      $usuario->name = $request->input('name');
      $usuario->email = $request->input('email');
      $usuario->password = Hash::make($request->input('password'));
      $usuario->save();
    //INSTANCIA DO SERVIDOR
      $servidor = new Servidor();
      $servidor->matricula = $request->input('matricula');
      $servidor->unidade_id = 1;
      $servidor->user_id = $usuario->id;
      $servidor->save();
      dd($servidor);
      return view('/')->with('jsAlert', 'Servidor cadastrado com sucesso!!');
    }
    public function listaServidores(){
          return view('/autenticacao.home-administrador'); //redireciona para view
    }
    public function cancel(){
          return view('/'); //redireciona para view
    }
    public function homeServidor(){
    $unidades = Unidade::All();
    $usuarios = User::All();
    return view('autenticacao.cadastro-servidor',compact('users','unidades'));
    }
  }
