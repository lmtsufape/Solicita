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
    $cursos = Curso::all();
    $unidades = Unidade::all();
    $alunoLogado = Auth::user();
    $perfis = Perfil::All();
    $perfil = Perfil::where('id',$alunoLogado->id)->first();
    // dd($perfil->unidades->nome);
    return view ('telas_aluno.adiciona_perfil_aluno', compact('perfil', 'perfis','cursos', 'unidades', 'alunoLogado'));
  }
  public function salvaPerfil(Request $request){
    $usuario = User::find(Auth::user()->id);
    $aluno = $usuario->aluno;
    $perfil = new Perfil();
    $perfil->aluno_id = $request->idAluno;
    $perfil->curso_id = $request->cursos;
    $perfil->unidade_id = $request->unidade;
    if($request->vinculo === "1"){
      $perfil->situacao = "Matriculado";
    }
    else{
      $perfil->situacao = "Egresso";
    }
    $temp = Perfil::where('id',$request->cursos)->first();
    // $perfil->default = Perfil::where('id',$request->cursos)->first();
    $perfil->default = $temp->default;
    $perfil->aluno()->associate($aluno);
    // $aluno->perfil()->associate($perfil);
    // dd($perfil);
    $perfil->save();
    return view ('telas_aluno.perfil_aluno', compact('perfil', 'alunoLogado'));
  }
}
