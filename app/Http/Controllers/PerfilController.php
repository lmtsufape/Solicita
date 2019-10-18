<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Curso;
use App\Unidade;
use App\Aluno;
use App\Perfil;
use App\User;
class PerfilController extends Controller
{
  public function index(){
    $cursos = Curso::all();
    $unidades = Unidade::all();

    return view('telas_aluno.perfil_aluno',compact('cursos','unidades'));
  }
  public function editarInfo(){
    $cursos = Curso::all();
    $unidades = Unidade::all();
    return view('telas_aluno.editar_info_aluno',compact('cursos','unidades'));
  }
  public function adicionaPerfil(Request $request){
    $idUser = Auth::user()->id;
    $user = User::find($idUser); //Usuário Autenticado
    $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
    $perfil = Perfil::where('aluno_id',$aluno->id)->first();
    $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
    $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
    $perfis = Perfil::where('aluno_id',$aluno->id)->get();
    // dd($perfis);
    $unidades = Unidade::All();
    // $cursos = Curso::whereNotIn('id', [$perfis->curso_id])->get();
    $cursos = Curso::All();
    // dd($cursos);
    return view ('telas_aluno.adiciona_perfil_aluno', compact('perfil', 'perfis','cursoAluno', 'unidadeAluno', 'aluno', 'unidades', 'cursos'));
  }
  public function salvaPerfil(Request $request){
    $usuario = User::find(Auth::user()->id);
    $aluno = $usuario->aluno;
    $perfil = new Perfil();
    // $perfil->aluno_id = $request->idAluno;
    $perfil->curso_id = $request->cursos;
    $perfil->unidade_id = $request->unidade;
    if($request->vinculo === "1"){
      $perfil->situacao = "Matriculado";
    }
    else{
      $perfil->situacao = "Egresso";
    }
    $temp = $request->cursos;
    $curso = Curso::where('id',$request->cursos)->first();
    $perfil->default = $curso->nome;
    $perfil->aluno()->associate($aluno);
    $perfil->save();
    return redirect ('/perfil-aluno');
  }

  //retorna para view de editar perfil do aluno
  public function excluirPerfil(Request $id) {
    $perfil = Perfil::find($id);
    $perfil->delete();
    return redirect()
    ->action('PerfilAlunoController@index', $perfis)
    ->withInput();
  }

  public function editaPerfil(){
    $idUser = Auth::user()->id;
    $aluno = Aluno::where('user_id',$idUser)->first();
    $perfis = Perfil::where('aluno_id',$aluno->id)->get();
    //dd($perfis);
    return view('telas_aluno.edita_perfil',compact('perfis'));
  }
}
