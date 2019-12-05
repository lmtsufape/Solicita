@extends('layouts.app')

@section('conteudo')
<div class="background">
    <div class="background" style="height: 840px">
        <div class="centro" style="height: 840px">
          <div>@include('componentes.mensagens')</div>
                <h2 class="row d-flex justify-content-center">Adicionar Perfil</h2>
                <form action="{{  route('salva-novo-perfil-aluno')  }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <div class="form-group row formulario-centro">
                      <div class="col-md-9">
                        <label for="vinculo" style="margin-left:25%">Tipo de vínculo</label>
                        <select name="vinculo" id="vinculo" class="browser-default custom-select custom-select-lg mb-3" style="width: 16rem; margin-left:25%">
                          <option value="1" selected>Matriculado</option>
                          <option value="2">Egresso</option>
                          <option value="3">Especial</option>
                          <option value="4">REMT - Regime Especial de Movimentação Temporária</option>
                          <option value="5">Desistente</option>
                          <option value="6">Matrícula Trancada</option>
                          <option value="7">Intercâmbio</option>
                            @error('vinculo')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </select>
                      <!-- Unidade Acadêmica-->
                      <label for="unidade" style="margin-left:25%">Unidade Acadêmica</label>
                      <select name="unidade" id="unidade"class="browser-default custom-select custom-select-lg mb-1" style="width: 16rem; margin-left:25%">
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
                      <label for="cursos" style="margin-left:25%">Curso</label>
                      <select name="curso" id="cursos" class="browser-default custom-select custom-select-lg mb-1" style="width: 16rem; margin-left:25%">
                        <options selected>Curso</option>
                          @foreach($cursos as $curso)
                          <option value="{{$curso->id}}">{{$curso->nome}}</option>
                          @endforeach
                          @error('curso')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </select></br>
                      <input type="checkbox" name="selecaoPadrao"  value="true">Definir como padrão
                      </input>
                      </div>
                    </div>
                    <!-- Botões -->
                    <div class="form-group row mb-0 justify-content-center ">
                        <div class="row " style="margin-top:5%; margin-left:-30px">
                                <div class="col-md-6 " style="">
                                    <a class="menu-principal" href="{{  route('perfil-aluno')}}" style="color: #1B2E4F; margin-left: -20px">Voltar</a>
                                </div>

                                <div class="col-md-6 " style="margin-left: -30px; margin-top: -4%">
                                    <button type="submit" class="btn btn-primary"  href="{{  route("salva-novo-perfil-aluno")}}"
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
