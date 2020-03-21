@extends('layouts.app')

@section('conteudo')
<div class="container-fluid background-blue" style="">
    <div class="row justify-content-center">
        <div class="col-sm-3">

          <div class="card card-cadastro">
            <div class="card-body">
              <div class="row justify-content-center">
                  <h2>Alterar Senha</h2>
              </div>
              <form action="{{  route('alterar-senha')  }}" method="POST">

                @csrf

                <div class="row justify-content-center">
                  <div class="col-sm-12">
                    <label for="password" class="field a-field a-field_a3 page__field" >
                    <input id="password-old" type="password" class="form-control @error('password-old') is-invalid @enderror field__input a-field__input"
                    name="atual" required autocomplete="current-password" placeholder="Senha Antiga" >

                    <span class="a-field__label-wrap">
                        <span class="a-field__label">Senha atual</span>
                    </span>
                    </label>
                    @error('password-old')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row justify-content-center">
                  <div class="col-sm-12">
                    <label for="password" class="field a-field a-field_a3 page__field" >
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror field__input a-field__input"
                    name="password" required autocomplete="current-password" placeholder="Nova Senha" >

                    <span class="a-field__label-wrap">
                        <span class="a-field__label">Nova Senha</span>
                    </span>
                    </label>
                    <span style="color:red">*Mínimo de 8 caracteres.</span>
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
                    name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Nova Senha">

                    <span class="a-field__label-wrap">
                        <span class="a-field__label">Confirmar Nova Senha</span>
                    </span>
                    </label>
                    @error('password-confirm')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <!-- Botões -->
                <div class="form-group row justify-content-center" style="margin-top:60px">
                    <div class="col-sm-6">
                    <a class="btn btn-secondary btn-cadastro-primary" href="{{  route('perfil-aluno')}}" >Voltar</a>
                    </div>

                    <div class="col-sm-6">
                        <button type="submit" class="btn lmts-primary btn-cadastro-primary">
                            {{ __('Salvar') }}
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
