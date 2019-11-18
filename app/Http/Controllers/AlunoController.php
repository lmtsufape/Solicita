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
    // $requisicoes = Requisicao::where('aluno_id',$aluno->id)->orderBy('data_pedido','desc')->orderBy('hora_pedido', 'desc')->get();
    $requisicoes = Requisicao::where('aluno_id',$aluno->id)->orderBy('id','desc')->get();
    // dd($requisicoes);
    $requisicoes_documentos = Requisicao_documento::where('aluno_id',$aluno->id)->get();
    $aluno= Aluno::where('user_id',$idUser)->first();
    $documentos = Documento::all();
    // dd($documentos);
    $perfis = Perfil::where('aluno_id',$aluno->id)->get();
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
      'cpf' => ['required','integer','size:11','unique:alunos'],
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
      'cpf' => 'bail|required|cpf|unique:alunos',
      'email' => 'bail|required|string|email|max:255|unique:users',
      'password' => 'bail|required|string|min:8|confirmed',
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
        }else if ($vinculo==="2"){
          $perfil->situacao = "Egresso";
        }
        else if ($vinculo==="3"){
          $perfil->situacao = "Especial";
        }
        else if ($vinculo==="4"){
          $perfil->situacao = "REMT - Regime Especial de Movimentação Temporária";
        }
        else if ($vinculo==="5"){
          $perfil->situacao = "Desistente";
        }
        else if ($vinculo==="6"){
          $perfil->situacao = "Trancado";
        }
        else if ($vinculo==="7"){
          $perfil->situacao = "Intercambio";
        }
    $unidade = Unidade::where('id',$request->unidade)->first();
    //aluno_id
    $perfil->aluno_id = $aluno->id;
    //unidade_id
    $perfil->unidade_id = $unidade->id;
    //curso_id
    $perfil->curso_id = $curso->id;
    $perfil->valor = true;
    //dd($perfil);
    $perfil->save();
    return redirect('/')->with('success', 'Cadastrado com sucesso!');

  }
  public function home(){
  return view ('autenticacao.home-aluno');
  }
}
