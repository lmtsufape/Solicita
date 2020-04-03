@extends('layouts.app')


@section('conteudo')
<div class="container-fluid background-blue" style="">
    <div class="row justify-content-center">
        <div class="col-sm-7">

            <div class="card card-cadastro">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <h2>Cadastro</h2>
                    </div>
                    <form action="{{  route('register')  }}" method="POST">
                        @csrf
                        {{-- Nome --}}
                        <div class="row justify-content-center form-group">
                            <div class="col-sm-8">
                                <label for="name" class="field a-field a-field_a3 page__field ">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input"
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

                            <div class="col-sm-4">
                                <label for="name" class="field a-field a-field_a3 page__field ">
                                <input id="cpf" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input"
                                name="cpf" value="{{ old('cpf') }}" required autocomplete="name" autofocus placeholder="CPF">

                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">CPF</span>
                                </span>
                                </label>
                                @error('cpf')
                                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        {{-- cpf --}}
                        <div class="form-group row justify-content-center">

                          </div>

                          <!-- Vínculo -->
                          <div class="row justify-content-center">
                              <div class="col-sm-4">
                                <label for="vinculo">Tipo de vínculo</label>
                                <select name="vinculo" id="vinculo" class="browser-default custom-select">
                                    <option value="" disable selected hidden>-- Selecionar Vínculo --</option>
                                    <option value="1" >Matriculado</option>
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

                              <div class="col-sm-4">
                                <label for="unidade">Instituição / Unidade Acadêmica</label>
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

                              <div class="col-sm-4">
                                <!-- Cursos-->
                                <label for="cursos">Curso</label>
                                <select name="cursos" id="cursos" class="browser-default custom-select">

                                    <option value="" disable selected hidden>-- Selecionar Curso --</option>
                                    @foreach($cursos as $curso)
                                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                    @endforeach

                                    @error('cursos')
                                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </select>
                              </div>

                          </div>

                          <!-- Form E-mail -->
                    <div class="form-group row justify-content-center" style="margin-top:20px">

                        <div class="col-md-4">
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
                            <p id='result'></p>
                        </div>

                        <div class="col-sm-4">
                            <label for="password" class="field a-field a-field_a3 page__field" >
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror field__input a-field__input"
                            name="password" required autocomplete="current-password" placeholder="Senha">
                            <span class="a-field__label-wrap">
                                <span class="a-field__label">Senha</span>
                            </span>
                            </label>
                            <span style="color:red">*Mínimo de 8 caracteres.</span>
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-sm-4">
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
                            <button id='validate' type="submit" class="btn lmts-primary btn-cadastro-primary">
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
<script type="text/javascript" >
  $(document).ready(function($){
    $('#cpf').mask('000.000.000-00');

  });

  function validateEmail(email) 
  {
      var re = /\S+@\S+\.\S+/;
      return re.test(email);
  }
    

  function validate() {
    var $result = $("#result");
    var email = $("#email").val();
    $result.text("");

    if (validateEmail(email)) {
      $result.text("Esse e-mail é valido");
      $result.css("color", "green");
      return true;
    } else {
      $result.text("Esse e-mail não é valido ");
      $result.css("color", "red");
      return false;
    }
    
  }

  $("#validate").on("click", validate);



  

</script>
@endsection
