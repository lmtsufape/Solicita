<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PerfilAluno extends Controller
{
    //

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
    public function adicionarPerfil(){
    }
}
