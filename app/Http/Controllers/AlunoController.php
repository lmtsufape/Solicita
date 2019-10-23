<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Curso;
use App\Aluno;
use App\User;
use App\Perfil;
use App\Unidade;
use App\Servidor;
use App\Requisicao;
use App\Documento;
use App\Requisicao_documento;

class AlunoController extends Controller
{
  // Redireciona para tela de login ao entrar no sistema
  public function index(){
    // return view('autenticacao.home-aluno');
    return view('autenticacao.login');
  }

  //redireciona para a lista de requisições do aluno
  //devolve para a view a lista de requisicoes que o aluno fez
  public function listarRequisicoes(){
    $idUser=Auth::user()->id;
    $aluno = Aluno::where('user_id',$idUser)->first();
    // dd($aluno->id);
    //ordena pela data e hora do pedido
    $requisicoes = Requisicao::where('aluno_id',$aluno->id)->orderBy('data_pedido','desc')->orderBy('hora_pedido','desc')->get();
    // dd($idUser);
    $requisicoes_documentos = Requisicao_documento::where('aluno_id',$aluno->id)->get();

    $aluno= Aluno::where('user_id',$idUser)->first();

    $documentos = Documento::all();
    $perfis = Perfil::where('aluno_id',$aluno->id)->get();

    //dd($requisicoes);

    return view('telas_aluno.requisicoes_aluno',compact('requisicoes','requisicoes_documentos','aluno','documentos','perfis'));
  }


  public function homeAluno(){
    return view('autenticacao.home-aluno');
  }
  //cadastro de aluno
  public function createAluno(){
    $cursos = Curso::all();
    $unidades = Unidade::all();
    // $usuario = User::find(Auth::user()->id);
    $perfis = Perfil::all();
    return view('autenticacao.cadastro',compact('cursos','unidades','perfis')); //redireciona para view de cadastro do aluno
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
    $usuario->tipo = 'aluno';
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
    }else {
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
    return redirect('/');

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
  // dd($request->default);
    if($checkBoxProgramaDisciplina!=''){
    $request->validate([
      'requisicaoPrograma' => ['required'],
    ]);
    }
    if($checkBoxOutros!=''){
      $request->validate([
        'requisicaoOutros' => ['required'],
      ]);
    }
    $requisicao = new Requisicao();
    $idUser = Auth::user()->id;
    $user = User::find($idUser); //Usuário Autenticado
    $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
    //$perfil = Perfil::where('aluno_id',$aluno->id)->first(); //o perfil deve ser consultado com base na select do request e não com o aluno_id, pois um aluno pode ter vários perfis
    $perfil = Perfil::where('id',$request->default)->first();
    // dd($request->default);
    $arrayDocumentos = [];//Array Temporário
    //variáveis para os checkboxes
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('d/m/Y');
    $hour =  date('H:i');
    $requisicao->data_pedido = $date;
    $requisicao->hora_pedido = $hour;
    $requisicao->perfil_id = $perfil->id;
    $requisicao->aluno_id = $aluno->id; //necessária adequação com o código de autenticação do usuário do perfil aluno
    $requisicao->save();

  if($checkBoxDeclaracaoVinculo){
    $documentosRequisitados = new Requisicao_documento();
    $documentosRequisitados->status_data = $date;
    $documentosRequisitados->requisicao_id = $requisicao->id;
    $documentosRequisitados->aluno_id = $perfil->aluno_id;
    $documentosRequisitados->status = 'Em andamento';
    $documentosRequisitados->documento_id = 1;
    // $documentos = requisitados($documentosRequisitados, $requisicao, 1);
    array_push($arrayDocumentos, $documentosRequisitados);
  }
  if($checkBoxComprovanteMatricula){
    $documentosRequisitados = new Requisicao_documento();
    $documentosRequisitados->status_data = $date;
    $documentosRequisitados->requisicao_id = $requisicao->id;
    $documentosRequisitados->aluno_id = $perfil->aluno_id;
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
    $documentosRequisitados->aluno_id = $perfil->aluno_id;
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
    $documentosRequisitados->aluno_id = $perfil->aluno_id;
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
    $documentosRequisitados->aluno_id = $perfil->aluno_id;
    $documentosRequisitados->status = 'Em andamento';
    $documentosRequisitados->detalhes =  $request->get('requisicaoOutros');
    $documentosRequisitados->documento_id = 5;
    array_push($arrayDocumentos, $documentosRequisitados);
  }
  //#Documentos
  $ano = date('Y');
  $size = count($arrayDocumentos);
  $requisicao->requisicao_documento()->saveMany($arrayDocumentos);
      $id = [];
      foreach ($arrayDocumentos as $key) {
        array_push($id, $key->documento_id);
      }
  // dd($arrayDocumentos);
  $arrayAux = Documento::whereIn('id', $id)->get();
  // dd($arrayAux);
  $arrayDocumentos = $arrayAux;
  // dd($arrayDocumentos);
  // $documento = Documento::where('id',$request->titulo_id)->first();
  $curso = Curso::where('id',$request->curso_id)->first();
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
public function home(){
  return view ('autenticacao.home-aluno');
}
}
