@extends('layouts.app')


@section('conteudo')

<div class="background">


    <div class="background" style="height: 840px">
        <div class="centro" style="height: 840px">
                <h2 class="row d-flex justify-content-center" >Cadastro de servidor</h2>

                <form action="{{  route('novo-servidor')  }}" method="POST">

                  @csrf
                        <div class="form-group">
                    <div class="form-group row formulario-centro">

                        <div class="col-md-9">
                            <label for="name" class="field a-field a-field_a3 page__field ">
                            <input id="nomeServidor" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome Completo">

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

                    <!-- Form matricula -->

                    <div class="form-group row formulario-centro">

                      <div class="col-md-9">
                          <label for="name" class="field a-field a-field_a3 page__field ">
                          <input id="matriculaServidor" type="name" class="form-control @error('matricula') is-invalid @enderror field__input a-field__input"
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
                            <input id="emailServidor" type="email" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
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
                            <label for="password" class="field a-field a-field_a3 page__field" >
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror field__input a-field__input"
                            name="password" required autocomplete="current-password" placeholder="Senha">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">Senha</span>
                            </span>
                            </label>
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Confirmar Senha -->
                    <!-- <div class="form-group row formulario-centro">

                        <div class="col-md-9">
                            <label for="password-confirm" class="field a-field a-field_a3 page__field" >
                            <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror field__input a-field__input"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">Confirmar Senha</span>
                            </span>
                            </label>
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> -->

                    <!-- Botões -->
                    <div class="form-group row mb-0 justify-content-center ">
                        <div class="row " style="margin-top:20px; margin-left:-30px">
                                <div class="col-md-6 " style="">
                                    <a class="menu-principal" href="{{  route('home')}}"
                                    style="color: #1B2E4F; margin-left: -20px">Voltar</a>
                                </div>

                                <div class="col-md-6 " style="margin-left: -30px; margin-top: -4px">
                                    <button type="submit" class="btn btn-primary"  href="{{  route('novo-servidor')}}"
                                    onclick="confirmacaoCadastro();"
                                    style="margin-left: 60px;background-color: #1B2E4F; border-color: #d3e0e9">
                                        {{ __('Cadastrar') }}
                                    </button>
                                </div>
                        </div>

                  </div>
              </form>
          </div>
      </div>
      <!-- <script>
      function confirmacaoCadastro() {
        var inputNome = document.getElementById('nomeServidor');
        var inputMatricula = document.getElementById('matriculaServidor');
        var inputEmail = document.getElementById('emailServidor');
        var inputSenha = document.getElementById('password');
        if (inputNome.value == ""|| inputMatricula.value== "" ||inputEmail.value=="" || inputSenha.value=="")
        {
            alert('Para cadastrar o servidor, preencha todos os campos corretamente.');
            return false;
        }
        else{
          alert('Cadastro efetuado');
          document.getElementById('form').submit();
        }
        return true;
      }
      </script> -->

@endsection
