<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Curso;

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
            $tipoDocumento = ['Declaração de Vínculo','Comprovante de Matrícula','Histórico','Programa de Disciplina','Outros','Todos'];
            return view('telas_servidor.home_servidor', ['cursos'=>$cursos,'tipoDocumento'=>$tipoDocumento]);
          }
          elseif (Auth::user()->tipo == 'aluno') {
          return view('autenticacao.home-aluno');
          }
        }
      //                                             <----------------
        return view('home');
    }
}
