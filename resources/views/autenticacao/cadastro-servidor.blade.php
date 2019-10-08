@extends('layouts.app')


@section('conteudo')

<div class="background">


    <div class="background" style="height: 840px">
        <div class="centro" style="height: 840px">
                <h2 class="row d-flex justify-content-center">Cadastro de Servidor</h2>

                <form action="{{  route('cadastro')  }}" method="POST">

                  @csrf
                        <div class="form-group">
                            <!--
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
                            -->
                    <!-- Form Nome -->

                    <div class="form-group row formulario-centro">

                        <div class="col-md-9">
                            <label for="name" class="field a-field a-field_a3 page__field ">
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome Completo">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">Nome Completo</span>
                            </span>
                            </label>
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Matricula -->

                    <div class="form-group row formulario-centro">

                      <div class="col-md-9">
                          <label for="name" class="field a-field a-field_a3 page__field ">
                          <input id="matricula" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input"
                          name="matricula" value="{{ old('matricula') }}" required autocomplete="name" autofocus placeholder="Matricula">

                          <span class="a-field__label-wrap">
                              <span class="a-field__label">Matricula</span>
                          </span>
                          </label>
                          @error('matricula')
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
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">

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


                    <!-- Form Senha -->
                    <div class="form-group row formulario-centro">

                        <div class="col-md-9">
                            <label for="password" class="field a-field a-field_a3 page__field ">
                            <input id="password" type="password" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
                            name="password" value="{{ old('password') }}" required autocomplete="email" autofocus placeholder="Senha" value="">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">Senha</span>
                            </span>
                            </label>
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!-- BOTOES AQUI -->
                    <div class="form-group row mb-0 justify-content-center ">
                        <div class="row " style="margin-top:20px; margin-left:-30px">
                                <div class="col-md-6 ">
                                    <a class="menu-principal" href="{{  route('home')}}" style="color: #1B2E4F; margin-left: -20px">Voltar</a>
                                </div>
                                <div class="col-md-6 " style="margin-left: -30px; margin-top: -4px">
                                    <button href="{{  route('confirmacao-servidor')}}" type="submit" class="btn btn-primary"
                                            style="margin-left: 60px;background-color: #1B2E4F; border-color: #d3e0e9">
                                        {{ __('Cadastrar') }}
                                    </button>
                                </div>
                        </div>
                    </div>
              </form>
          </div>
      </div>

@endsection
