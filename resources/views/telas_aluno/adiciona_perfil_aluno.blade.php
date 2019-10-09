@extends('layouts.app')

@section('conteudo')
<div class="background">


    <div class="background" style="height: 840px">
        <div class="centro" style="height: 840px">
                <h2 class="row d-flex justify-content-center">Adicionar Perfil</h2>
                <form action="{{  route('salva-novo-perfil-aluno')  }}" method="POST">
                  @csrf
                  <div class="form-group">

                    <!-- Form -->
                    <div class="form-group row justify-content-center">
                        <div class="col-md-9">
                            <p><div class = "label" id = informacao></div><b>Dados do seu perfil atual</b></p>
                            <p><div class = "label" id = nomeAlunoPerfil name= "idAluno" value="{{$alunoLogado->id}}"></div><b>Nome do Aluno: {{$perfil->aluno->user->name}}</b></p>
                            <p><div class = "label" id = cpfAlunoPerfil ></div><b>CPF: {{$perfil->aluno->cpf}}</b></p>
                            <p><div class = "label" id = vinculoAlunoPerfil ></div><b>Curso: {{$perfil->situacao}}</b></p>
                            <p><div class = "label" id = cursoAlunoPerfil ></div><b>Curso: {{$perfil->curso->nome}}</b></p>
                            <p><div class = "label" id = unidadeAlunoPerfil ></div><b>Unidade Acadêmica: {{$perfil->curso->unidade->nome}}</b></p>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="form-group row formulario-centro">
                      <div class="col-md-9">
                        <label for="vinculo" style="margin-left:125px">Tipo de vinculo</label>
                        <select name="vinculo" id="vinculo" class="browser-default custom-select custom-select-lg mb-3" style="width: 14.5rem; margin-left:125px">
                            <option value="1"selected>Aluno Matriculado</option>
                            <option value="2">Aluno Egresso</option>
                            @error('vinculo')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </select>
                      <!-- Unidade Acadêmica-->
                      <label for="unidade" style="margin-left:125px">Unidade Acadêmica</label>
                      <select name="unidade" id="unidade"class="browser-default custom-select custom-select-lg mb-1" style="width: 14.5rem; margin-left:125px">

                        @foreach($unidades as $unidade)
                        <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                        @endforeach
                        @error('unidade')
                        <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </select>

                      <!-- Cursos-->
                      <label for="cursos" style="margin-left:125px">Curso</label>
                      <select name="cursos" id="cursos" class="browser-default custom-select custom-select-lg mb-1" style="width: 14.5rem; margin-left:125px">
                        <options selected>Curso</option>

                          @foreach($cursos as $curso)
                          <option value="{{$curso->id}}">{{$curso->nome}}</option>
                          @endforeach

                          @error('cursos')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </select>

                      </div>
                    </div>
                    <!-- Botões -->
                    <div class="form-group row mb-0 justify-content-center ">
                        <div class="row " style="margin-top:20px; margin-left:-30px">
                                <div class="col-md-6 " style="">
                                    <a class="menu-principal" href="{{  route('perfil-aluno')}}" style="color: #1B2E4F; margin-left: -20px">Voltar</a>
                                </div>

                                <div class="col-md-6 " style="margin-left: -30px; margin-top: -4px">
                                    <button type="submit" class="btn btn-primary"  href="{{  route('salva-novo-perfil-aluno')}}"
                                      style="margin-left: 60px;background-color: #1B2E4F; border-color: #d3e0e9">
                                        {{ __('Salvar') }}
                                    </button>
                                </div>
                        </div>

                    </div>
              </form>
          </div>
      </div>
@endsection
