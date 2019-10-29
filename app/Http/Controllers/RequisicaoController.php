<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Requisicao_documento;
use App\Requisicao;
use App\Documento;
use App\Curso;
use App\Aluno;
use App\Perfil;
use App\User;
use Carbon\Carbon;


class RequisicaoController extends Controller
{
  public function index()
  {
    return view('autenticacao.formulario-requisicao');
  }
  public function getRequisicoes(Request $request){
    $documento = Documento::where('id',$request->titulo_id)->first();
    $curso = Curso::where('id',$request->curso_id)->first();
    // dd($documento);
      //Verifica se o card clicado foi igual a "TODOS"
      if($request->titulo_id == 6){
          $titulo = 'Todos';
          //$id_documentos retorna um collection. É necessário transformar para array
          //pega todas as requisições com base no id do documento e no id do curso
          $id_documentos = DB::table('requisicao_documentos')
                  ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
                  ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
                  ->select ('requisicao_documentos.id')
                  ->where([['curso_id', $request->curso_id],['status','Em andamento']])
                  ->get();
      }
      else {
         $titulo = $documento->tipo;
         $id_documentos = DB::table('requisicao_documentos')
                ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
                ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
                ->select ('requisicao_documentos.id')
                ->where([['documento_id',$request->titulo_id],['curso_id', $request->curso_id],['status','Em andamento']])
                ->get();
      }
      $id = []; //array auxiliar que pega cada item do $id_documentos
      foreach ($id_documentos as $id_documento) {
        array_push($id, $id_documento->id); //passa o id de $id_documentos para o array auxiliar $id
      }
      $listaRequisicao_documentos = Requisicao_documento::whereIn('id', $id)->orderBy('aluno_id','asc')->get(); //Pega as requisições que possuem o id do curso
      $response = [];
      foreach ($listaRequisicao_documentos as $key) {
        array_push($response, ['id' => $key->id,
                               'cpf' => $key->aluno->cpf,
                               'nome' => $key->aluno->user->name,
                               'curso' => $key->requisicao->perfil->curso->nome,
                               'status_data' => $key->status_data,
                               'status' => $key->status,
                               'detalhes' => $key->detalhes,
                              ]);
      }
      usort($response, function($a, $b){ return $a['nome'] >= $b['nome']; });
      // dd($response);
      $listaRequisicao_documentos = $response;
      return view('telas_servidor.requisicoes_servidor', compact('titulo','listaRequisicao_documentos'));
  }
    public function concluirRequisicao(Request $request){
        //dd($request);
        $arrayDocumentos = $request->checkboxLinha;
        // dd($request->checkboxLinha);
        $id_documentos = Requisicao_documento::find($arrayDocumentos);//whereIn
        if(isset($id_documentos)){
        //dd($id_documentos);
          foreach ($id_documentos as $id_documento) {
            $id_documento->status = "Concluído";
            $id_documento->save();
          }
        }
        return redirect()->back()->with('alert', 'Documento(s) Concluído(s) com Sucesso!'); //volta pra mesma url
    }
    public function storeRequisicao(Request $request){
      return redirect('confirmacao-requisicao');

    }
}
