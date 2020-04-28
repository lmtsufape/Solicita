<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Requisicao;
use Mail;
use App\Mail\StatusMail;
use App\Requisicao_documento;
use App\Documento;
use App\Curso;
use App\Aluno;
use App\Perfil;
use App\User;
use Carbon\Carbon;
use App\Servidor;
use App\Unidade;
use App\Jobs\SendEmail;

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
                      ->where([['curso_id', $request->titulo_id],['status','Concluído - Disponível para retirada']])                  
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
                                   //'requisicoes_documentos'=> $key
                                  ]);
                                }
          }
          usort($response, function($a, $b){ return $a['nome'] >= $b['nome']; });
          $listaRequisicao_documentos = $response;
          
          
          //return response()->json( [$listaRequisicao_documentos, $curso, $documento]);
          return response()->json( Auth::user()->id);
          
          //no response a informações do das de cada requisição(cada requisicao pode ter um ou mais documentos solicitados) com as informações visto no ultimo foreach

    }

    public function preparaNovaRequisicao(Request $request){
          $unidades = Unidade::All();
          $usuarios = User::All();
          $alunos = Aluno::All();
          $perfis = Perfil::where('aluno_id', Auth::user()->aluno->id)->get();
          return response()->json( [$usuarios,$unidades, $perfis, $alunos]);
        }
    public function novaRequisicao(Request $request){
      $checkBoxDeclaracaoVinculo = $request->declaracaoVinculo;
      $checkBoxComprovanteMatricula = $request->comprovanteMatricula;
      $checkBoxHistorico = $request->historico;
      $checkBoxProgramaDisciplina = $request->programaDisciplina;
      $checkBoxOutros = $request->outros;
        $mensagens = [
        'requisicaoPrograma.required' => 'Preencha este campo com as informações relativas à disciplina e a finalidade do pedido',
        'requisicaoPrograma.max' => 'O campo só pode ter no máximo 190 caracteres',
        'requisicaoOutros.max' => 'O campo só pode ter no máximo 190 caracteres'
        ];
        
        if($checkBoxProgramaDisciplina!=''){
          $request->validate([
            'requisicaoPrograma' => ['required'],
          ]);
          $request->validate([
            'requisicaoPrograma' => 'required|max:190'
          ], $mensagens);
        }
        if($checkBoxOutros!=''){
          $request->validate([
            'requisicaoOutros' => ['required'],
          ]);
          $request->validate([
            'requisicaoOutros' => 'required|max:190'
          ], $mensagens);
        }
        $requisicao = new Requisicao();
        $idUser = Auth::user()->id;
        $user = User::find($idUser); //Usuário Autenticado
        $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
        $perfil = Perfil::where('id',$request->default)->first();
        $arrayDocumentos = [];//Array Temporário
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('d/m/Y');
        $hour =  date('H:i');
        $requisicao->data_pedido = $date;
        $requisicao->hora_pedido = $hour;
        $requisicao->perfil_id = $perfil->id;
        $requisicao->aluno_id = $aluno->id; //necessária adequação com o código de autenticação do usuário do perfil aluno
        $requisicao->save();
      if($checkBoxDeclaracaoVinculo){
        $texto = "";
        array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 1, $perfil, $texto));
      }
      if($checkBoxComprovanteMatricula){
        $texto = "";
        array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 2, $perfil, $texto));
      }
      if($checkBoxHistorico){
        $texto = "";
        array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 3, $perfil, $texto));
      }
      if($checkBoxProgramaDisciplina){
        $texto =  $request->get('requisicaoPrograma');
        array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 4, $perfil, $texto));
      }
      if($checkBoxOutros){
        $texto =  $request->get('requisicaoOutros');
        array_push($arrayDocumentos, RequisicaoController::requisitados($requisicao, 5, $perfil, $texto));
      }
      //#Documentos
      $ano = date('Y');
      $size = count($arrayDocumentos);
      $requisicao->requisicao_documento()->saveMany($arrayDocumentos);
          $id = [];
          foreach ($arrayDocumentos as $key) {
            array_push($id, $key->documento_id);
          }
          $arrayAux = Documento::whereIn('id', $id)->get();
          // $documento = Documento::where('id',$request->titulo_id)->first();
          $curso = Curso::where('id',$request->curso_id)->first();
          // return view('autenticacao.confirmacao-requisicao', compact('arrayDocumentos', 'requisicao', 'arrayAux', 'size', 'ano', 'date', 'hour'));

          return response()->json([ $arrayDocumentos, $requisicao, $arrayAux, $size, $ano, $date, $hour ]);

    }


}
