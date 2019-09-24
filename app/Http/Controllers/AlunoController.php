<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Servidor;
use App\Aluno;
use App\Unidade;
use App\Requisicao;
use App\Curso;
use App\Documento;
use App\Requisicao_documento;
use App\Perfil;

class AlunoController extends Controller
{
    //
    public function index(){
      return view('autenticacao.home-aluno');
    }
    public function preparaNovaRequisicao(){
      $unidades = Unidade::All();
      $usuarios = User::All();
      $cursos = Curso::All();
      $alunos = Aluno::All();
      $perfil = Perfil::All();
      return view('autenticacao.formulario-requisicao',compact('usuarios','unidades', 'cursos', 'alunos', 'perfil'));
    }
    public function novaRequisicao(Request $request){

        $requisicao = new Requisicao();
        $documento_req = new Requisicao_documento();
        $documentos = new Documento();
        $id_aluno = Auth()->User()->id;
        $id_perfil =
        $id_servidor =


        //$requisicao->aluno_id = Auth()->User()->id;
        //dd($id_aluno);
      //
      //   $usuario->email = $request->input('email');
      //
      //   $usuario->password = $request->input('password');
      //
      //   $usuario->save();
      // // //INSTANCIA DO SERVIDOR
      //   $servidor = new Servidor();
      //   $servidor->matricula = $request->input('matricula');
      //   $servidor->unidade_id = 1;
      //   $servidor->user_id = $usuario->id;
      //   $servidor->save();
      //   return view('/autenticacao.home-administrador')->with('jsAlert', 'Servidor cadastrado com sucesso!!');;
      //
        //dd($requisicao);
        return view('autenticacao.confirmacao-requisicao');
      }
      public function confirmacaoRequisicao(Request $request){


        return view('autenticacao.confirmacao-requisicao');

      }
      public function cancelaRequisicao(){
        redirect('autenticacao.home-aluno');

      }
      public function listarRequisicoesAluno(){
            $requisicao = Requisicao::paginate(10);
            return view('autenticacao.home-aluno')->with($requisicao);
      }
}
