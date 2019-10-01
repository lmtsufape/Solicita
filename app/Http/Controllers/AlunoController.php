<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Auth;

use App\User;
use App\Servidor;
use App\Aluno;
use App\Unidade;
use App\Requisicao;
use App\Curso;
use App\Documento;
use App\Requisicao_documento;
use App\Perfil;

    //
    // public function preparaNovaRequisicao(Request $request){
    //
    //   $unidade = Unidade::where('nome',$request->nome)->first();
    //   $usuarios = User::All();
    //   $cursos = Curso::All();
    //   $alunos = Aluno::All();
    //   $perfil = Perfil::All();
    //   return view('autenticacao.formulario-requisicao',compact('usuarios','unidades', 'cursos', 'alunos', 'perfil'));
    //
    // }
    // public function novaRequisicao(Request $request){
    //
    //     $requisicao = new Requisicao();
    //     $documento_req = new Requisicao_documento();
    //     $documentos = new Documento();
    //     return view('autenticacao.confirmacao-requisicao');
    //   }

class AlunoController extends Controller
{
  // Redireciona para tela de login ao entrar no sistema
  public function index()
  {
    return view('autenticacao.home-aluno');
  }
  public function preparaNovaRequisicao(Request $request){
    $unidades = Unidade::All();
    $usuarios = User::All();
    $alunos = Aluno::All();
    $perfis = Perfil::All();
    return view('autenticacao.formulario-requisicao',compact('usuarios','unidades', 'perfis', 'alunos'));
  }
  public function novaRequisicao(Request $request){
    $documento_req = new Requisicao_documento();
    $requisicao = new Requisicao();
    $alunoLogado = Auth::user();
    $arrayDocumentos = [];//Array Temporário
    //variáveis para os checkboxes
    $checkBoxDeclaracaoVinculo = $request->declaracaoVinculo;
    $checkBoxComprovanteMatricula = $request->comprovanteMatricula;
    $checkBoxHistorico = $request->historico;
    $checkBoxProgramaDisciplina = $request->programaDisciplina;
    $checkBoxOutros = $request->outros;

    date_default_timezone_set('America/Sao_Paulo');
    $date = date('d/m/Y');
    $hour =  date('H:i');
    $requisicao->data_pedido = $date;
    $requisicao->hora_pedido = $hour;
    $requisicao->perfil_id = 1;
    $requisicao->servidor_id = 1;
    $requisicao->aluno_id = 1; //necessária adequação com o código de autenticação do usuário do perfil aluno
    $requisicao->save();

      if($checkBoxDeclaracaoVinculo){
        $documentosRequisitados = new Requisicao_documento();
        $documentosRequisitados->status_data = $date;
        $documentosRequisitados->requisicao_id = $requisicao->id;
        $documentosRequisitados->aluno_id = 1;
        $documentosRequisitados->status = 'Em andamento';
        // $documentosRequisitados->detalhes = "";
        $documentosRequisitados->documento_id = 1;
        // $documentos = requisitados($documentosRequisitados, $requisicao, 1);
        array_push($arrayDocumentos, $documentosRequisitados);
      }
      if($checkBoxComprovanteMatricula){
        $documentosRequisitados = new Requisicao_documento();
        $documentosRequisitados->status_data = $date;
        $documentosRequisitados->requisicao_id = $requisicao->id;
        $documentosRequisitados->aluno_id = 1;
        $documentosRequisitados->status = 'Em andamento';
        // $documentosRequisitados->detalhes = "";
        $documentosRequisitados->documento_id = 2;
        // $documentos = requisitados($documentosRequisitados, $requisicao, 1);
        array_push($arrayDocumentos, $documentosRequisitados);
      }
      if($checkBoxHistorico){
        $documentosRequisitados = new Requisicao_documento();
        $documentosRequisitados->status_data = $date;
        $documentosRequisitados->requisicao_id = $requisicao->id;
        $documentosRequisitados->aluno_id = 1;
        $documentosRequisitados->status = 'Em andamento';
        // $documentosRequisitados->detalhes = "";
        $documentosRequisitados->documento_id = 3;
        // $documentos = requisitados($documentosRequisitados, $requisicao, 1);
        array_push($arrayDocumentos, $documentosRequisitados);
      }
      if($checkBoxProgramaDisciplina){
        $documentosRequisitados = new Requisicao_documento();
        $documentosRequisitados->status_data = $date;
        $documentosRequisitados->requisicao_id = $requisicao->id;
        $documentosRequisitados->aluno_id = 1;
        $documentosRequisitados->status = 'Em andamento';
        $documentosRequisitados->detalhes = $request->get('requisicaoPrograma');
        $documentosRequisitados->documento_id = 4;
        // $documentos = requisitados($documentosRequisitados, $requisicao, 1);
        // $documentosRequisitados->anotacoes = $request->get('textareaProgramaDisciplina');
        array_push($arrayDocumentos, $documentosRequisitados);
      }
      if($checkBoxOutros){
        $documentosRequisitados = new Requisicao_documento();
        $documentosRequisitados->status_data = $date;
        $documentosRequisitados->requisicao_id = $requisicao->id;
        $documentosRequisitados->aluno_id = 1;
        $documentosRequisitados->status = 'Em andamento';
        $documentosRequisitados->detalhes =  $request->get('requisicaoOutros');
        $documentosRequisitados->documento_id = 5;
        // $documentosRequisitados->anotacoes = $request->get('textareaOutrosDocumentos');
        array_push($arrayDocumentos, $documentosRequisitados);
      }
      //#Documentos
        $ano = date('Y');
        $size = count($arrayDocumentos);
        $requisicao->requisicao_documentos()->saveMany($arrayDocumentos);
        $documento = Documento::where('id',$request->titulo_id)->first();
        $curso = Curso::where('id',$request->curso_id)->first();

        // $titulo = $documento->tipo;
        // $id_documentos = DB::table('requisicao_documentos')
        //                 ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
        //                 ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
        //                 ->select ('requisicao_documentos.id')
        //                 ->where([['documento_id',$request->titulo_id],['curso_id', $request->curso_id],['status','Em andamento']])
        //                 ->get();
        //
        //       // dd($id_documentos);
        //       $id = []; //array auxiliar que pega cada item do $id_documentos
        //
        //       foreach ($id_documentos as $id_documento) {
        //         array_push($id, $id_documento->tipo); //passa o id de $id_documentos para o array auxiliar $id
        //       }
        //       $listaRequisicao_documentos = Requisicao_documento::whereIn('id', $id)->get();

      return view('autenticacao.confirmacao-requisicao', compact('documentos', 'requisicao', 'arrayDocumentos', 'size', 'ano'));
    }
    public function requisitados(Requisicao_documento $documentosRequisitados, Requisicao $requisicao, $id){

      date_default_timezone_set('America/Sao_Paulo');
      $date = date('d/m/Y');
      $hour =  date('H:i');
      $documentosRequisitados->status_data = $date;
      $documentosRequisitados->requisicao_id = $requisicao->id;
      $documentosRequisitados->aluno_id = 1;
      $documentosRequisitados->status = 'Em andamento';
      // $documentosRequisitados->detalhes = "";
      $documentosRequisitados->documento_id = $id;
      return $documentosRequisitados;
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
      return view ('autenticacao.home-aluno');
    }
  //cadastro de aluno
  public function createAluno(){
    $cursos = Curso::all();
    $unidades = Unidade::all();
    return view('autenticacao.cadastro',compact('cursos','unidades')); //redireciona para view de cadastro do aluno
  }

  public function storeAluno(Request $request){
    $regras = [
      'name' => 'required|string|max:255',
      //'cpf' => ['required','integer','size:11','unique:alunos'],
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'vinculo' => ['required'],
      'unidade' => ['required'],
      'cursos' => ['required'],
    ];
    $mensagens = [
      'name.required' => 'Por favor, preencha este campo',
      'email.required' => 'Por favor, preencha este campo',
      'email.email' => 'Por favor, preencha um email válido',
      'vinculo.required' => 'Por favor, selecione o tipo de vínculo',
      'unidade.required' => 'Por favor, selecione a unidade acadêmica',
      'cursos.required' => 'Por favor, selecione o seu curso',
      'password.required' => 'Por favor, digite uma senha',
      'passowd.min' => 'Por favor, digite uma senha com, no mínimo, 8 dígitos',
    ];
    //$request->validate([$regras,$mensagens]);
    $request->validate([
      'name' => 'required|string|max:255',
      'cpf' => 'required|cpf|unique:alunos',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'vinculo' => ['required'],
      'unidade' => ['required'],
      'cursos' => ['required'],
    ]);
    $usuario = new User();
    $aluno = new Aluno();
    $perfil = new Perfil();
    //USER
    $usuario->name = $request->input('name');
    $usuario->email = $request->input('email');
    $usuario->password = Hash::make($request->input('password'));
    $usuario->save();
    //ALUNO
    $aluno->cpf = $request->input('cpf');
    $aluno->user_id = $usuario->id;
    $aluno->save();
    //PERFIL
    //$ultimo_cpf = Aluno::where('cpf',$request->cpf)->first();
    //dd($ultimo_cpf->cpf);
    //dd($curso_id->id);
    //Default
    $curso = Curso::where('id',$request->cursos)->first();
    $perfil->default = $curso->nome; //Nome do Curso
    //Situacao
    $vinculo = $request->vinculo;
    if($vinculo==="1"){
      $perfil->situacao = "Matriculado";
      }else
      {
      $perfil->situacao = "Egresso";
      }
    $unidade = Unidade::where('id',$request->unidade)->first();
    //aluno_id
    $perfil->aluno_id = $aluno->id;
    //unidade_id
    $perfil->unidade_id = $unidade->id;
    //curso_id
    $perfil->curso_id = $curso->id;
    //dd($perfil);
    $perfil->save();
    return redirect('/')->with('jsAlert','Usuário Cadastrado com sucesso.');
  }
}
