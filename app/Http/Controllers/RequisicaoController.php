<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\StatusMail;
use App\Requisicao_documento;
use App\Requisicao;
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
  public function index()
  {
    return view('autenticacao.formulario-requisicao');
  }

  public function excluirRequisicao($id){
    $requisicao = Requisicao::find($id);
    $documentos = $requisicao->requisicao_documento()->get();
    
    foreach ($documentos as $doc) {
      # code...
      if($doc->status != 'Em andamento'){
        return redirect()->back()->with('error', 'Você não pode excluir esta requisição, pois a mesma possui documentos que já foram processados.');
      }
    }
    $requisicao->requisicao_documento()->delete();
    $requisicao->delete();
    return redirect()->back()->with('success', 'Requisição excluída com sucesso!');
  }

  public function getRequisicoes(Request $request){
    $documento = Documento::where('id',$request->titulo_id)->first();
    $curso = Curso::where('id',$request->curso_id)->first();
      //Verifica se o card clicado foi igual a "TODOS"
                      // ->withTrashed()
      if($request->titulo_id == 6){
          $titulo = 'Todos';
          //$id_documentos retorna um collection. É necessário transformar para array
          //pega todas as requisições com base no id do documento e no id do curso
          $id_documentos = DB::table('requisicao_documentos')
                  ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
                  ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
                  ->select ('requisicao_documentos.id')
                  ->where([['curso_id', $request->curso_id],['status','Concluído - Disponível para retirada']])
                  ->orWhere([['curso_id', $request->curso_id],['status','Indeferido']])
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
      return view('telas_servidor.requisicoes_servidor', compact('titulo','listaRequisicao_documentos'));
  }
    public function storeRequisicao(Request $request){
      return redirect('confirmacao-requisicao');

    }
    public function preparaNovaRequisicao(Request $request){
          $unidades = Unidade::All();
          $usuarios = User::All();
          $alunos = Aluno::All();
          $perfis = Perfil::where('aluno_id', Auth::user()->aluno->id)->get();
          return view('autenticacao.formulario-requisicao',compact('usuarios','unidades', 'perfis', 'alunos'));
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
          return view('autenticacao.confirmacao-requisicao', compact('arrayDocumentos', 'requisicao', 'arrayAux', 'size', 'ano', 'date', 'hour'));
    }
    public function requisitados(Requisicao $requisicao, $id, Perfil $perfil, $texto){
      date_default_timezone_set('America/Sao_Paulo');
      $date = date('d/m/Y');
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
    public function confirmacaoRequisicao(Request $request){
      return redirect('/autenticacao.confirmacao-requisicao');
    }
    public function finalizaRequisicao(Request $request){
      return redirect('/home-aluno');
    }
    public function cancelaRequisicao(){
      return view('/autenticacao.home-aluno');
    }
    public function listarRequisicoesAluno(){
      $requisicao = Requisicao::paginate(10);
      return view('/home-aluno')->with($requisicao);
    }
    public function indeferirRequisicao(Request $request){
        $request->validate([
          'anotacoes' => ['required'],
        ]);
        $id = $request->idDocumento;
        $servidorLogado = Auth::user();
        $servidor = Servidor::where('user_id', $servidorLogado->id)->first();
        $id_documento = Requisicao_documento::where('id', $id)->first();
            $id_documento->anotacoes = $request->anotacoes;
            $id_documento->status = "Indeferido";
            $id_documento->servidor_id = $servidor->id;
            $aluno = Aluno::where('id', $id_documento->aluno_id)->first();
            $user = User::where('id', $aluno->user_id)->first();
            $documento = Documento::where('id', $id_documento->documento_id)->first();
            $to_email = $user->email;
            $nome_documento = $documento->tipo;
            $data = array(
                'usuario' => $user,
                'aluno' => $aluno,
                'servidor' => $servidor,
                'documento' => $id_documento,
                'nome_documento' => $nome_documento,
                'anotacoes' => $id_documento->anotacoes,
            );
            $id_documento->save();
            $subject = 'Solicita - Status da Requisicao: '.$id_documento->status;
            //$details = ['email' => 'recipient@example.com'];
            
            
            $details = ['data'=>$data, 'cabecalho'=>'naoresponder.lmts@gmail.com', 'titulo'=>'Solicita - LMTS', 'toEmail'=>$to_email, 'subject'=>$subject];
            
            SendEmail::dispatch($details);
            // Mail::send('mails.status', $data, function($message) use ($to_email, $subject) {
            //     $message->to($to_email)
            //             ->subject($subject);
            //     $message->from('naoresponder.lmts@gmail.com','Solicita - LMTS');
            // });
        return redirect()->back()->with('success', 'Documento(s) Indeferidos(s) com Sucesso!'); //volta pra mesma url
      }
      public function concluirRequisicao(Request $request){
          $servidorLogado = Auth::user();
          $servidor = Servidor::where('user_id', $servidorLogado->id)->first();
          $arrayDocumentos = $request->checkboxLinha;
          $id_documentos = Requisicao_documento::find($arrayDocumentos);//whereIn
          if(isset($id_documentos)){
            foreach ($id_documentos as $id_documento) {
              $id_documento->status = "Concluído - Disponível para retirada";
              $id_documento->servidor_id = $servidor->id;
              $aluno = Aluno::where('id', $id_documento->aluno_id)->first();
              $user = User::where('id', $aluno->user_id)->first();
              $documento = Documento::where('id', $id_documento->documento_id)->first();
              $to_email = $user->email;
              $nome_documento = $documento->tipo;
              $data = array(
                  'usuario' => $user,
                  'aluno' => $aluno,
                  'servidor' => $servidor,
                  'documento' => $id_documento,
                  'nome_documento' => $nome_documento,
                  'anotacoes' => $id_documento->anotacoes,
              );
              $id_documento->save();
              $subject = 'Solicita - Status da Requisicao: '.$id_documento->status;
              $details = ['data'=>$data, 'cabecalho'=>'naoresponder.lmts@gmail.com', 'titulo'=>'Solicita - LMTS', 'toEmail'=>$to_email, 'subject'=>$subject];
            
              SendEmail::dispatch($details);


              // Mail::send('mails.status', $data, function($message) use ($to_email, $subject) {
              //     $message->to($to_email)
              //             ->subject($subject);
              //     $message->from('naoresponder.lmts@gmail.com','Solicita - LMTS');
              // });
            }
          }
          return redirect()->back()->with('success', 'Documento(s) Concluido(s) com Sucesso!'); //volta pra mesma url
        }
}
