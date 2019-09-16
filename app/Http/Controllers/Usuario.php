<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Aluno;
use App\User;
use App\Perfil;
use App\Unidade;

class Usuario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Redireciona para tela de login ao entrar no sistema
    public function index()
    {
      return view('autenticacao.login');
    }

    //cadastro de aluno
    public function createAluno(){

      $cursos = Curso::all();
      $unidades = Unidade::all();

      return view('autenticacao.cadastro',compact('cursos','unidades')); //redireciona para view de cadastro do aluno
    }

    public function storeAluno(Request $request){
      $usuario = new User();
      $aluno = new Aluno();
      $perfil = new Perfil();


      //USER
      $usuario->name = $request->input('name');
      $usuario->email = $request->input('email');
      $usuario->password = $request->input('password');
      $usuario->save();


      //ALUNO
      $ultimo_id = User::where('email',$request->email)->first(); //ultimo id inserido na tabela Usuario
      $aluno->cpf = $request->input('cpf');
      $aluno->user_id = $ultimo_id->id;
      $aluno->save();

      //PERFIL
      $ultimo_cpf = Aluno::where('cpf',$request->cpf)->first();
      //dd($ultimo_cpf->cpf);
      $ultimo_curso_id = Curso::where('id',$request->cursos)->first();
      //dd($curso_id->id);

      //Default
      $perfil->default = $ultimo_curso_id->nome; //Nome do Curso
      //Situacao
      $vinculo = $request->vinculo;
      if($vinculo==="1"){
        $perfil->situacao = "Matriculado";

      }else {
        $perfil->situacao = "Egresso";
      }

      $unidade_id = Unidade::where('id',$request->unidade)->first();
      //aluno_id
      $perfil->aluno_id = $ultimo_cpf->id;
      //unidade_id
      $perfil->unidade_id = $unidade_id->id;
      //curso_id

      $perfil->curso_id = $ultimo_curso_id->id;
      //dd($perfil);

      $perfil->save();




      return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
