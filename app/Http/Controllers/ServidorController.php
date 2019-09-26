<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
class ServidorController extends Controller
{
    //

    //redireciona para view home_servidor
    public function index(){

        $cursos = Curso::all();
        $tipoDocumento = ['Declaração de Vínculo','Comprovante de Matrícula','Histórico','Programa de Disciplina','Outros','Todos'];
        return view('telas_servidor.home_servidor', ['cursos'=>$cursos,'tipoDocumento'=>$tipoDocumento]);
    }
}
