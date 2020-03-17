@extends('layouts.app')

@section('conteudo')

<div class="container-fluid background-blue" style="">
    <div class="row justify-content-center">
        <div class="col-sm-3">

          <div class="card card-cadastro">
            <div class="card-body">
              <div class="row justify-content-center">
                  <h2>Editar Informações</h2>
              </div>

              <form action="{{  route('editar-info')  }}" method="POST">
                @csrf

                <div class="row justify-content-center">
                  <div class="col-sm-12">
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

                <div class="row justify-content-center">
                  <div class="col-sm-12">
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
