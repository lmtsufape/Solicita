@extends('layouts.app')


@section('conteudo')

<div class="container-fluid background-blue" style="min-height:110vh">
  <div class="row justify-content-center">
    <div class="col-sm-3">
      <div class="card card-cadastro card-cadastro-servidor">
        <div class="card-body">

          <div class="row justify-content-center">
            <h2>Cadastrar Servidor</h2>
          </div>
          <form action="{{  route('confirmacao-servidor')  }}" method="POST">
            @csrf
            <div class="row justify-content-center">
              <div class="col-sm-12">
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

            <div class="row justify-content-center">
              <div class="col-sm-12">
                <label for="name" class="field a-field a-field_a3 page__field ">
                <input id="matriculaServidor" type="number" class="form-control @error('matricula') is-invalid @enderror field__input a-field__input"
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

            <div class="row justify-content-center">
              <div class="col-sm-12">
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

            <div class="row justify-content-center">
              <div class="col-sm-12">
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

            <div class="row justify-content-center">
              <div class="col-sm-12">
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
            </div>

            <!-- Botões -->
            <div class="form-group row justify-content-center" style="margin-top:60px">
                <div class="col-sm-6">
                <a class="btn btn-secondary btn-cadastro-primary" href="{{  route('home')}}" >Voltar</a>
                </div>

                <div class="col-sm-6">
                    <button type="submit" class="btn lmts-primary btn-cadastro-primary" href="{{  route('confirmacao-servidor')}}"
                    onclick="confirmacaoCadastro();">
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


@endsection
