<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
<<<<<<< HEAD
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

      $unidade = Unidade::where('nome',$request->nome)->first();
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
        // $id_aluno = Auth()->Aluno()->id;
        // $cpf_aluno = Auth()->Aluno()->cpf;
        // $nome_aluno = Auth()->User()->nome;
        // $email_aluno = Auth()->User()->email;

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
=======
>>>>>>> master
use Illuminate\Support\Facades\Hash;
use App\Curso;
use App\Aluno;
use App\User;
use App\Perfil;
use App\Unidade;
class AlunoController extends Controller
{
  // Redireciona para tela de login ao entrar no sistema
  public function index()
  {
    return view('autenticacao.login');
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
    if($vinculo==="1")
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
    return redirect('/')->with('jsAlert','Usuário Cadastrado com sucesso.');
  }
<<<<<<< HEAD
=======
>>>>>>> 5be38ca3595bb84226e661af7f18c7e6a40ecdbf
>>>>>>> master
}
