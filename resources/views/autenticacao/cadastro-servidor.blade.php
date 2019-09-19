@extends('layouts.app')

@section('conteudo')

    <div class="background" >

        <div class="centro">
          <form method="POST" action="{{route('cadastro-servidor')}}">
            @csrf
            <h3 class="text-center">Cadastrar Servidor</h3>
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
            <div class="form-group row formulario-centro">

                <div class="col-md-9">
                    <label for="name" class="field a-field a-field_a3 page__field ">
                    <input type="text" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome">

                    <span class="a-field__label-wrap">
                    <span class="a-field__label">Nome</span>
                    </span>
                    </label>
                    @error('email')
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
                    <input type="text" class="form-control @error('matricula') is-invalid @enderror field__input a-field__input"
                    name="matricula" placeholder="Matricula">

                    <span class="a-field__label-wrap">
                    <span class="a-field__label">Matrícula</span>
                    </span>
                    </label>
                    @error('password')
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
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">

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
                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror field__input a-field__input"
                    name="password" required autocomplete="current-password" placeholder="Senha provisória">

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

            <div class="col-md-6 " style="margin-left: 10px; margin-top: 50px">
                <button type="submit" class="btn btn-primary" action={{route('login')}} style="margin-left: 100px;background-color: #1B2E4F; border-color: #d3e0e9">
                    {{ ('Cadastrar') }}
                </button>
            </div>

            <div class="col-md-6 " style="margin-left: 150px; margin-top: -37px">
                <button type="submit" class="btn btn-primary" action={{route('cancela-cadastro')}} style="margin-left: 100px; background-color: #FF0000; border-color: #d3e0e9">
                    {{ ('Cancelar') }}
                </button>
            </div>
          </form>
        </div>
    </div>

@endsection
