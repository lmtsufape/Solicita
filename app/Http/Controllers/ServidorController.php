<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Curso;
use App\User;
use App\Servidor;
use App\Unidade;
use Auth;

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
        'password' => 'required|string|min:8|confirmed',
      ]);
      $usuario = new User();
      $usuario->name = $request->input('name');
      $usuario->email = $request->input('email');
      $usuario->password = Hash::make($request->input('password'));
      $usuario->tipo = 'servidor';
      $usuario->save();
    //INSTANCIA DO SERVIDOR
      $servidor = new Servidor();
      $servidor->matricula = $request->input('matricula');
      $servidor->unidade_id = 1;
      $servidor->user_id = $usuario->id;
      $servidor->save();
      // dd($servidor);
      return redirect()->route('home-administrador')->with('success', 'Servidor cadastrado com sucesso!');
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

    public function alterarSenhaServidor(){
      $user = Auth::user();
      return view('telas_servidor.alterar_senha_server', compact('user'));
    }

    public function storeAlterarSenhaServidor(Request $request){
      $request->validate([
        'password' => 'required|string|min:8|confirmed',
      ]);
      $user = Auth::user();
      $user->password = Hash::make($request->password);
      $user->save();
      return redirect()->route('home')->with('success', 'Senha alterada com sucesso!');
    }
  
  }
