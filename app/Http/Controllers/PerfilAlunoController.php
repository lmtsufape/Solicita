<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Curso;
use App\Unidade;
use App\User;
use App\Aluno;
use App\Perfil;
use Auth;

class PerfilAlunoController extends Controller
{
    //
    public function index(){
      $cursos = Curso::all();
      $unidades = Unidade::all();
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      // $temp = Perfil::where('user_id',$perfisAluno->aluno_id)->first();
      // dd($temp);
      // array_push($arrayPerfis, $temp);
      //PRIMEIRO PERFIL DO ALUNO
      $perfil = Perfil::where('aluno_id',$aluno->id)->first();
      // dd($perfil);
      //TODOS OS PERFIS VINCULADOS AO ALUNO
      $perfisAluno = Perfil::where('aluno_id',$aluno->id)->get();
      // dd($perfisAluno);
      // dd($perfil->aluno_id);
      // $temp = Perfil::whereNotIn('aluno_id', $perfil->aluno_id)->get();
      // dd($temp);
      //
      // $users = DB::table('users')
      //                     ->whereNotIn('id', [1, 2, 3])
      //                     ->get();
      // $perfisAluno = Perfil::whereNotIn('aluno_id',$perfil->aluno_id)->get();
      $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
      $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
      return view('telas_aluno.perfil_aluno',['cursos'=>$cursos,'unidades'=>$unidades,'user'=>$user,
                                              'aluno'=>$aluno,'perfil'=>$perfil,'unidadeAluno'=>$unidadeAluno->nome,'cursoAluno'=>$cursoAluno,'perfisAluno'=>$perfisAluno]);
    }
    public function editarInfo(){
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      return view('telas_aluno.editar_info_aluno',compact('user','aluno'));
    }
    public function storeEditarInfo(Request $request){
      //atualização dos dados
      $user = Auth::user();
      // dd($request->email);
      if($user->email!=$request->email){
        $request->validate([
          'email' => ['bail','required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
      }
      $user->name = $request->name;
      $user->email = $request->email;
      $user->save();
      //dados para ser exibido na view
      $cursos = Curso::all();
      $unidades = Unidade::all();
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      $perfil = Perfil::where('aluno_id',$aluno->id)->first();
      $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
      $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
      return redirect()->route('home-aluno',['cursos'=>$cursos,'unidades'=>$unidades,'user'=>$user,
                                              'aluno'=>$aluno,'perfil'=>$perfil,'unidadeAluno'=>$unidadeAluno->nome,'cursoAluno'=>$cursoAluno])
                                              ->with('success', 'Seus dados foram atualizados!');
    }
    public function alterarSenha(){
      return view('telas_aluno.alterar_senha');
    }
    public function storeAlterarSenha(Request $request){
      if (!Hash::check($request->atual, Auth::user()->password)) {
        return redirect()->back()->with('error', 'Senha atual está incorreta');
      }
      $request->validate([
        'password' => 'required|string|min:8|confirmed',
        // 'atual' => 'required|string|min:8',
      ]);
      $user = Auth::user();
      $user->password = Hash::make($request->password);
      $user->save();
      //dados para ser exibido na view
      $cursos = Curso::all();
      $unidades = Unidade::all();
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      $perfil = Perfil::where('aluno_id',$aluno->id)->first();
      $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
      $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
      return redirect()->route('perfil-aluno',['cursos'=>$cursos,'unidades'=>$unidades,'user'=>$user,
                                              'aluno'=>$aluno,'perfil'=>$perfil,'unidadeAluno'=>$unidadeAluno->nome,'cursoAluno'=>$cursoAluno])
                                              ->with('success', 'Senha alterada com sucesso!');

    }
    public function adicionaPerfil(Request $request){
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      $perfil = Perfil::where('aluno_id',$aluno->id)->first();
      $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
      $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
      $perfis = Perfil::where('aluno_id',$aluno->id)->get();
      $id = [];
      foreach ($perfis as $perfil) {
        array_push($id, $perfil->curso_id);
      }
      $cursos = Curso::whereNotIn('id', $id)->get();
      $unidades = Unidade::All();
      $quant = count($perfis);
      if($quant==7){
        return redirect()->back()
        ->with('error', 'Você já possui todos os cursos adicionados ao seus perfil, caso queira atualizar o status do seu vínculo,
        favor excluir o curso em questão e adicionar perfil com o novo vínculo');
      }
      else{
      return view ('telas_aluno.adiciona_perfil_aluno', compact('perfil', 'perfis','cursoAluno', 'unidadeAluno', 'aluno', 'unidades', 'cursos'));
      }
    }
  public function salvaPerfil(Request $request){
  $usuario = User::find(Auth::user()->id);
  $aluno = $usuario->aluno;

  $perfil = new Perfil();
  $perfil->curso_id = $request->curso;
  $perfil->unidade_id = $request->unidade;
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
        $definicaoPadrao = $request->selecaoPadrao;
        if($definicaoPadrao=='true'){
          $perfis = Perfil::where('aluno_id',$aluno->id)->get();
          foreach ($perfis as $p) {
            $p->valor = false;
            $p->save();
          }
          $perfil->valor=true;
        }
        else{
        $perfil->valor = false;
      }
      $temp = $request->cursos;
      $curso = Curso::where('id',$request->curso)->first();
      // dd($request->curso;
      $perfil->default = $curso->nome;
      $perfil->aluno()->associate($aluno);
      $perfil->save();
      // }
  // return redirect ('/perfil-aluno');
  return redirect()->route('perfil-aluno')->with('success', 'Perfil adicionado com sucesso!');
}
public function excluirPerfil(Request $request) {
      // dd($request->idPerfil);

      $usuario = User::find(Auth::user()->id);
      $aluno = $usuario->aluno;
      $perfis = Perfil::where('aluno_id',$aluno->id)->get();
      $quant = count($perfis);
      if($quant===1){
        return redirect()->back()->with('error', 'Necessário haver ao menos um perfil vinculado ao aluno!');
      }
      else if($quant>1){
        $id = $request->idPerfil;
        $perfil = Perfil::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Deletado com Sucesso!');
      }
}
public function definirPerfilDefault(Request $request){
    // dd($request->idPerfil);
    $id = $request->idPerfil;
    $selecao = Perfil::where('id', $id)->first();
      $usuario = User::find(Auth::user()->id);
      $aluno = $usuario->aluno;
      $perfis = Perfil::where('aluno_id',$aluno->id)->get();
      foreach ($perfis as $p) {
        $p->valor = false;
        $p->save();
      }
      $selecao->valor = true;
      $selecao->save();
      return redirect()->back()->with('success', 'Definido com sucesso!');
  }
}
