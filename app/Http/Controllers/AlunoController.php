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
    public function preparaNovaRequisicao(Request $request){
      // $unidades = Unidade::where('nome', $request->$nome)->first();
      $unidades = Unidade::All();
      //where('nome',$request->nome)->first();
      $usuarios = User::All();
      //dd($usuarios);
      $cursos = Curso::All();
      $alunos = Aluno::All();
      $perfis = Perfil::All();
      //dd($perfil);
      return view('autenticacao.formulario-requisicao',compact('usuarios','unidades', 'cursos', 'alunos', 'perfis', 'nome_aluno'));
    }
    public function novaRequisicao(Request $request){
        $requisicao = new Requisicao();
        $documento_req = new Requisicao_documento();
        $documentos = new Documento();
        // $nome_aluno = $request->input('nomeAluno');
        //dd($nome_aluno);

        $documentos->tipo = 'Declaracao de Vínculo';
        $documentos->save();

        $requisicao->data_pedido = '20/09/2019';
        $requisicao->hora_pedido = '00:00:00';
        $requisicao->aluno_id = 1;
        $requisicao->perfil_id = 1;
        $requisicao->servidor_id = 1;
        $requisicao->save();

        $documento_req->documento_id = $documentos->id;
        $documento_req->requisicao_id = $requisicao->id;
        $documento_req->aluno_id = 1;
        $documento_req->servidor_id = 1;
        $documento_req->anotacoes = 'Teste da Requisicao';
        $documento_req->status = 'Em andamento';
        $documento_req->status_data = '20/09/2019';
        $documento_req->detalhes = 'Anotacoes para o servidor';
        $documento_req->save();

        return view('autenticacao.confirmacao-requisicao', compact('documentos', 'requisicao', 'documento_req'));
      }
      public function confirmacaoRequisicao(Request $request){
        return redirect('/confirmacao-requisicao');
      }
      public function cancelaRequisicao(){
        return redirect('/home-aluno');
      }
      public function listarRequisicoesAluno(){
            $requisicao = Requisicao::paginate(10);
            return view('/home-aluno')->with($requisicao);
      }
      public function home(){
        return redirect('home-aluno');
      }
}
