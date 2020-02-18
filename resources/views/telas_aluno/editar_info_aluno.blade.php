@extends('layouts.app')

@section('conteudo')
<div class="background">


    <div class="background" style="height: 840px">
        <div class="centro" style="height: 840px">
          <div>@include('componentes.mensagens')</div>
                <h2 class="row d-flex justify-content-center" >Editar Perfil</h2>

                <form action="{{  route('editar-info')  }}" method="POST">

                  @csrf
                  <div class="form-group">
                    <!-- Form Nome -->
                    <div class="form-group row formulario-centro">
                        <div class="col-md-9">
                            <label for="name" class="field a-field a-field_a3 page__field ">
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input"
                            name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="Nome Completo">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">Nome Completo</span>
                            </span>
                            </label>
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!-- Form E-mail -->
                    <div class="form-group row formulario-centro">

                        <div class="col-md-9">
                            <label for="email" class="field a-field a-field_a3 page__field ">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
                            name="email" value="{{ $user->email }}" required autocomplete="email" autofocus placeholder="E-Mail">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">E-mail</span>
                            </span>
                            </label>
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="form-group row mb-0 justify-content-center ">
                        <div class="row " style="margin-top:20px; margin-left:-30px">
                                <div class="col-md-6 " style="">
                                    <a class="menu-principal" href="{{  route('perfil-aluno')}}" style="color: #1B2E4F; margin-left: -20px">Voltar</a>
                                </div>

                                <div class="col-md-6 " style="margin-left: -30px; margin-top: -4px">
                                    <button type="submit" class="btn btn-primary"  style="margin-left: 60px;background-color: #1B2E4F; border-color: #d3e0e9">
                                        {{ __('Atualizar') }}
                                    </button>
                                </div>
                        </div>
                    </div>
              </form>
          </div>
      </div>
@endsection
