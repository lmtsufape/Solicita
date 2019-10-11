<?php

namespace App\Http\Controllers;

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
      $perfisAluno = Perfil::All();
      $arrayPerfis = [];
      // dd($perfisAluno;
      $cursos = Curso::all();
      $unidades = Unidade::all();
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      // $temp = Perfil::where('user_id',$perfisAluno->aluno_id)->first();

      // dd($temp);
      // array_push($arrayPerfis, $temp);

      $perfil = Perfil::where('aluno_id',$aluno->id)->first();
      $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
      $cursoAluno = Curso::where('id',$perfil->curso_id)->first();

      return view('telas_aluno.perfil_aluno',['cursos'=>$cursos,'unidades'=>$unidades,'user'=>$user,
                                              'aluno'=>$aluno,'perfil'=>$perfil,'unidadeAluno'=>$unidadeAluno->nome,'cursoAluno'=>$cursoAluno]);
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


      return view('telas_aluno.perfil_aluno',['cursos'=>$cursos,'unidades'=>$unidades,'user'=>$user,
                                              'aluno'=>$aluno,'perfil'=>$perfil,'unidadeAluno'=>$unidadeAluno->nome,'cursoAluno'=>$cursoAluno]);

    }

    public function alterarSenha(){
      return view('telas_aluno.alterar_senha');
    }
    public function storeAlterarSenha(Request $request){


      $request->validate([
        'password' => 'required|string|min:8|confirmed',
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


      return view('telas_aluno.perfil_aluno',['cursos'=>$cursos,'unidades'=>$unidades,'user'=>$user,
                                              'aluno'=>$aluno,'perfil'=>$perfil,'unidadeAluno'=>$unidadeAluno->nome,'cursoAluno'=>$cursoAluno]);

    }
    public function excluirPerfil(){
      return redirect('telas_aluno.perfil_aluno');

    }
}
