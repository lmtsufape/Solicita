@extends('layouts.app')

@section('conteudo')

    <div class="background" method="post">

        <div class="centro">
          <form>
            <h1 class="text-center">Cadastrar Servidor</h1>

            <!--Nome-->
            <div class="form-group row formulario-centro">

                <div class="col-md-9">
                    <label for="name" class="field a-field a-field_a3 page__field ">
                    <input id="name" type="text" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
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
                    <input id="matricula" type="text" class="form-control @error('matricula') is-invalid @enderror field__input a-field__input"
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
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
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
            <!-- <div class="form-group row formulario-centro">

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

            </div> -->

            <div class="col-md-6 " style="margin-left: 10px; margin-top: 50px">
                <button type="submit" class="btn btn-primary" name="submitServidor" style="margin-left: 100px;background-color: #1B2E4F; border-color: #d3e0e9">
                    {{ ('Cadastrar') }}
                </button>

            </div>

            <div class="col-md-6 " style="margin-left: 150px; margin-top: -37px">
                <button type="submit" class="btn btn-primary" name="cancelServidor" style="margin-left: 100px; background-color: #FF0000; border-color: #d3e0e9">
                    {{ ('Cancelar') }}
                </button>
            </div>
          </form>
        </div>
    </div>

@endsection
