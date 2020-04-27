<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Requisicao;

class RequisicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisicoes = Requisicao::all();
        return response()->json($requisicoes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getRequisicoes(Request $request){

        //no resquest vem informações do documento selecionado ($request->titulo_id) e o 
        //o curso($request->curso_id)

        $documento = Documento::where('id',$request->titulo_id)->first();
        $curso = Curso::where('id',$request->curso_id)->first();
          //Verifica se o card clicado foi igual a "TODOS"
                          // ->withTrashed()
          if($request->titulo_id == 6){
              $titulo = 'Concluídos';
              //$id_documentos retorna um collection. É necessário transformar para array
              //pega todas as requisições com base no id do documento e no id do curso
              $id_documentos = DB::table('requisicao_documentos')
                      ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
                      ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
                      ->select ('requisicao_documentos.id')
                      ->where([['curso_id', $request->curso_id],['status','Concluído - Disponível para retirada']])                  
                      ->get();

          }
          else if($request->titulo_id == 7){
              $titulo = 'Indeferidos';
              //$id_documentos retorna um collection. É necessário transformar para array
              //pega todas as requisições com base no id do documento e no id do curso
              $id_documentos = DB::table('requisicao_documentos')
                      ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
                      ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
                      ->select ('requisicao_documentos.id')
                      ->where([['curso_id', $request->curso_id],['status','Indeferido']])                 
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
          $listaRequisicao_documentos = Requisicao_documento::whereIn('id', $id)->get(); //Pega as requisições que possuem o id do curso
          $response = [];
          foreach ($listaRequisicao_documentos as $key) {
            if($key->requisicao->perfil != null) {
            array_push($response, ['id' => $key->id,
                                   'cpf' => $key->aluno->cpf,
                                   'perfil'=> $key->aluno->perfil,
                                   'nome' => $key->aluno->user->name,
                                   'curso' => $key->requisicao->perfil->curso->nome,
                                   'email' => $key->aluno->user->email,
                                   'vinculo' => $key->requisicao->perfil->situacao,
                                   'status_data' => $key->status_data,
                                   'status_hora' => Requisicao::where('id',$key->requisicao_id)->get('hora_pedido')[0]->hora_pedido,
                                   'status' => $key->status,
                                   'detalhes' => $key->detalhes,
                                   'requisicoes_documentos'=> $key
                                  ]);
                                }
          }
          usort($response, function($a, $b){ return $a['nome'] >= $b['nome']; });
          $listaRequisicao_documentos = $response;
          
          // return view('telas_servidor.requisicoes_servidor', compact('titulo','listaRequisicao_documentos', 'quantidades'));
          return response()->json($listaRequisicao_documentos, $curso, $titulo);
          // return view('telas_servidor.requisicoes_servidor', compact('curso','titulo','listaRequisicao_documentos'));

          //no response a informações do das de cada requisição(cada requisicao pode ter um ou mais documentos solicitados) com as informações visto no ultimo foreach

    }
}
