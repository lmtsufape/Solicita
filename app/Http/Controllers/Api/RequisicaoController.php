<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
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
use Illuminate\Support\Facades\Validator;

class RequisicaoController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
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
    public function excluirRequisicao(Request $request){
        $id = $request->idRequisicao;
        $requisicao = Requisicao::find($id);
        $documentos = $requisicao->requisicao_documento()->get();

        foreach ($documentos as $doc) {
            # code...
            if($doc->status != 'Em andamento'){
                $message = 'Você não pode excluir esta requisição, pois a mesma possui documentos que já foram processados.';
                return response()->json(['message'=>$message]);
            }
        }
        $requisicao->requisicao_documento()->delete();
        $requisicao->delete();
                $message = 'Requisição excluída com sucesso!';
                return response()->json(['message'=>$message], 201);
    }

    public function listarRequisicoes(){    
      $idUser=Auth::user()->id;        
      $aluno = Aluno::where('user_id',$idUser)->first();
      //ordena pela data e hora do pedido
      // $requisicoes = Requisicao::where('aluno_id',$aluno->id)->orderBy('data_pedido','desc')->orderBy('hora_pedido', 'desc')->get();
      $requisicoes = Requisicao::where('aluno_id',$aluno->id)->orderBy('id','desc')->get();
      $requisicoes_documentos = Requisicao_documento::where('aluno_id',$aluno->id)->get();
      $aluno= Aluno::where('user_id',$idUser)->first();
      $documentos = Documento::all();
      $cursos = Curso::all();
      $perfis = Perfil::where('aluno_id',$aluno->id)->get();
      return response()->json([
          'requisicoes'=> $requisicoes,
          'solicitados'=>$requisicoes_documentos,
         // 'aluno'=>$aluno,
          'cursos'=>$cursos,
          'documentos'=>$documentos,
          'perfil'=>$perfis]);
    }

    public function preparaNovaRequisicao(Request $request){          
          $perfis = Perfil::where('aluno_id', Auth::user()->aluno->id)->get();
          $usuario =  Auth::user();
          return response()->json( [
              'usuario'=>$usuario,
              'perfil'=>$perfis]);

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
            return response()->json(['error'=> $mensagens]);
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
        $date = date('Y/m/d');
        $hour =  date('H:i');
        $requisicao->data_pedido = $date;
        $requisicao->hora_pedido = $hour;
        $requisicao->perfil_id = $perfil->id;//erroooooooooooooo
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
      $curso = Curso::where('id',$request->curso_id)->first();

     // return response()->json([ $arrayDocumentos, $requisicao, $arrayAux, $size, $ano, $date, $hour ]);
      return response()->json([
          'perfil' => $perfil,
         // 'requisicao_documentos' => $arrayDocumentos,
         //  $arrayDocumentos,
          'requisicao' => $requisicao,
         // $requisicao,
          'solicitados' => $arrayAux]);
    }

    public function requisitados(Requisicao $requisicao, $id, Perfil $perfil, $texto){
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y/m/d');
        $hour =  date('H:i');
        $documentosRequisitados = new Requisicao_documento();
        $documentosRequisitados->status_data = $date;
        $documentosRequisitados->requisicao_id = $requisicao->id;
        $documentosRequisitados->aluno_id = $perfil->aluno_id;
        $documentosRequisitados->status = 'Em andamento';
        if($id === 4){
            $documentosRequisitados->detalhes = $texto;
        }
        if($id===5){
            $documentosRequisitados->detalhes =  $texto;
        }
        $documentosRequisitados->documento_id = $id;
        $documentosRequisitados->detalhes =  $texto;
        return $documentosRequisitados;
    }


}
