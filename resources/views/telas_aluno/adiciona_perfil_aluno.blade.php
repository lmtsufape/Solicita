@extends('layouts.app')

@section('conteudo')
<div class="container-fluid background-blue">
  <div class="row justify-content-center">
    <div>@include('componentes.mensagens')</div>
  </div>
  
  <div class="row justify-content-center">
    <div class="col-sm-3">
      <div class="card card-cadastro">
        <div class="card-body">
          <div class="row justify-content-center">
            <h2>Cadastrar Perfil</h2>
            <form action="{{  route('salva-novo-perfil-aluno')  }}" method="POST">
              @csrf
              <div class="row justify-content-center">
                <div class="col-sm-12">
                  <label for="vinculo">Tipo de vínculo</label>
                  <select name="vinculo" id="vinculo" class="browser-default custom-select">
                    <option value="" disable selected hidden>-- Selecionar Vínculo --</option>
                    <option value="1">Matriculado</option>
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
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-sm-12">
                  <!-- Unidade Acadêmica-->
                  <label for="unidade">Unidade Acadêmica</label>
                  <select name="unidade" id="unidade"class="browser-default custom-select">
                    <option value="" disable selected hidden>-- Selecionar Unidade --</option>
                    @foreach($unidades as $unidade)
                    <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                    @endforeach
                    @error('unidade')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </select>

                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-sm-12">
                  <!-- Cursos-->
                  <label for="cursos">Curso</label>
                  <select name="curso" id="cursos" class="browser-default custom-select">
                    <option value="" disable selected hidden>-- Selecionar Curso --</option>
                      @foreach($cursos as $curso)
                      <option value="{{$curso->id}}">{{$curso->nome}}</option>
                      @endforeach
                      @error('curso')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </select>

                  <input style="margin-top:20px" type="checkbox" name="selecaoPadrao"  value="true">Definir como padrão</input>
                </div>
              </div>

              <!-- Botões -->
              <div class="form-group row justify-content-center" style="margin-top:60px">
                  <div class="col-sm-6">
                    <a class="btn btn-secondary btn-cadastro-primary" href="{{  route('perfil-aluno')}}" >Voltar</a>
                  </div>

                  <div class="col-sm-6">
                      <button type="submit" class="btn lmts-primary btn-cadastro-primary">
                          {{ __('Cadastrar') }}
                      </button>
                  </div>

              </div>
            </form>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
