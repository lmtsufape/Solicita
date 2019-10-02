@extends('layouts.app')

@section('conteudo')

    <div class="background" >

        <div class="centro">
          <form method="POST" action="{{route('cadastro-servidor')}}" id=form>
            @csrf
            <h4 class="text-center">Cadastrar Servidor</h4>
            <!--Nome-->
            <div>
              <label for='unidade' style="width: 14.5rem; margin-left:125px">Selecione uma Unidade Acadêmica</label>
              <select name="unidade" class="browser-default custom-select custom-select-lg mb-1" style="width: 14.5rem; margin-left:125px">
                <option value="" disabled selected>Unidade Acadêmica</option>
                @foreach($unidades as $unidade)
                <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                @endforeach
              </select>
            </div>
              <!--Nome-->
            <div class="form-group row formulario-centro">
                <div class="col-md-9">
                    <label for="name" class="field a-field a-field_a3 page__field ">
                    <input id = "nomeServidor" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome Completo">
                    <span class="a-field__label-wrap">
                    <span class="a-field__label">Nome</span>
                    </span>
                    </label>
                    @error('name')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <!--Matricula-->
            <div class="form-group row formulario-centro">
                <div class="col-md-9">
                    <label for="matricula" class="field a-field a-field_a3 page__field" >
                    <input id = "matriculaServidor" type="text" class="form-control @error('matricula') is-invalid @enderror field__input a-field__input"
                    name="matricula" required autocomplete="matricula" autofocus placeholder="Matricula" >

                    <span class="a-field__label-wrap">
                    <span class="a-field__label">Matrícula</span>
                    </span>
                    </label>
                    @error('matricula')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
            <!--E-mail-->
            <div class="form-group row formulario-centro">

                <div class="col-md-9">
                    <label for="email" class="field a-field a-field_a3 page__field ">
                    <input type="email" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
                    name="email" required autocomplete="email" autofocus placeholder="E-Mail" id = "emailServidor">

                    <span class="a-field__label-wrap">
                    <span class="a-field__label">E-Mail</span>
                    </span>
                    </label>
                    @error('email')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <!--Senha-->
            <div class="form-group row formulario-centro">
                <div class="col-md-9">
                    <label for="password" class="field a-field a-field_a3 page__field" >
                    <input type="password" class="form-control @error('password') is-invalid @enderror field__input a-field__input"
                    name="password" required autocomplete="password" placeholder="Senha provisória" id="password">

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
            <div class="form-group row mb-0" style="margin-center">
                    <div class="col-md-8 offset-md-4">
                      <a class="btn btn-primary btn-primary-lmts" onclick="event.preventDefault(); confirmacaoCadastro();" href="{{route('home')}}">
                      {{ ('Cadastrar') }}
                      </a>
                      <a class="btn btn-primary btn-primary-lmts" href="{{ route('cancela-cadastro')}}" >
                        {{ ('Cancelar') }}
                      </a>
                  </div>
                </div>
            </form>
        </div>
    </div>
    <script>
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
        // alert('Cadastro efetuado');
        document.getElementById('form').submit();
      }
      return true;
    }
    </script>
@endsection
