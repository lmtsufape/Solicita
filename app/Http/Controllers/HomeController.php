<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Curso;
use App\Requisicao_documento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth'=>'verified']);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //Copie e cole isso na outra rota que for usar ------------->
        if(Auth::check()){
          if(Auth::user()->tipo == 'servidor'){
            $cursos = Curso::all();
            $requisicoes = Requisicao_documento::all();
            $tipoDocumento = ['Declaração de Vínculo','Comprovante de Matrícula','Histórico','Programa de Disciplina','Outros','Todos'];
            return view('telas_servidor.home_servidor', ['cursos'=>$cursos,'tipoDocumento'=>$tipoDocumento, 'requisicoes'=>$requisicoes]);
          }
          else if (Auth::user()->tipo == 'aluno') {
          return view('autenticacao.home-aluno');
          }

          else if (Auth::user()->tipo == 'administrador') {
          return view('autenticacao.home-administrador');
          }

        }
      //
        return view('home');
    }
}
