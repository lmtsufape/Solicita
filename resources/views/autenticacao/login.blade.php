@extends('layouts.app')

@section('conteudo')

<div class="row justify-content-center">
    {{-- info texto --}}
    <div class="col-sm-9">
        <div class="info">
            <div class="info-texto" >
                    <img src="" alt="">
                <div class="texto">
                    <h1>O que é o <strong> "Solicita"? </strong></h1>
                    <p style="margin-left:15px">
                        É uma ferramenta voltada para o atendimento das demandas de requisições de documentos no Setor de Escolaridade da
                        Universidade Federal Rural de Pernambuco - Unidade Acadêmica de Garanhuns (UFRPE / UAG).
                    </p>
                    <h1>Benefícios de utilizar o <strong> "Solicita"? </strong></h1>
                    <ul style="margin-left:15px">
                        <li>Solicite seus documentos online;</li>
                        <li>Acompanhe o status do seu requerimento;</li>
                        <li>Deslocamento até a faculdade apenas para o recebimento do documento(necessária a apresentação de documento oficial com foto).</li>
                    </ul>
    
                    <h1>Quais documentos eu posso solicitar?</h1>
                    <ul style="margin-left:15px">
                        <li>Declaração de vínculo;</li>
                        <li>Comprovante de matrícula;</li>
                        <li>Histórico Escolar;</li>
                        <li>Programa de Disciplinas e</li>
                        <li>Outros.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>{{-- end info texto --}}

    <div class="col-sm-3">
        <div>
            @include('componentes.mensagens')
        </div>
            <h2 class="text-center">Entrar</h2>
            <form method="POST" action="{{ route('login') }}" style="padding:20px">
                @csrf

            <!-- Form E-mail -->
            <div class="form-group row justify-content-center">

                <div class="col-sm-12">
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
            <div class="form-group row justify-content-center">

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
            <div class="form-group row justify-content-center" >
                    <div class="col-sm-12 ">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Lembre-se de mim') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #1B2E4F;">
                            {{ __('Esqueceu sua senha?   ') }}
                        </a>
                        @endif
                    </div>
                </div>

                <div class="form-group row justify-content-center ">
                    <div class="col-sm-6 ">
                    <a class="btn btn-light btn-cadastro-primary" href="{{  route('cadastro')  }}">Cadastrar</a>
                    </div>

                    <div class="col-sm-6 " >
                        <button type="submit" class="btn lmts-primary btn-cadastro-primary">
                            {{ __('Entrar') }}
                        </button>
                    </div>
                    </div>
            </form>
    </div>
</div>


@endsection
