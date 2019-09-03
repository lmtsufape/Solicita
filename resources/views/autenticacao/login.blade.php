@extends('layouts.app')

    
@section('conteudo')
    <div class="info">
        <div class="info-texto" >
                <img src="" alt="">
            <div class="texto">

            
                <h1>O que é o <strong> escolar.io? </strong></h1>
                <p>
                    É uma ferramenta voltada para o atendimento das demandas<br>
                    de requisições de documentos no departamento de escolaridade<br>
                    da Universidade Federal Rural de Pernambuco - UAG.
                </p>
                <h1>Benefícios de utilizar o <strong> escolar.io? </strong></h1>
                <ul>
                    <li>Solicite seus documentos online;</li>
                    <li>Acompanhe o status do seu requerimento;</li>
                    <li>Retire os documentos apresentando o número de protocolo.</li>
                </ul>

                <h1>Quais documentos eu posso solicitar?</h1>
                <ul>
                    <li>Declaração de vínculo;</li>
                    <li>Comprovante de matrícula;</li>
                    <li>Histórico Escolar;</li>
                    <li>Programa de Disciplinas e</li>
                    <li>Outros.</li>
                </ul>
            </div>
            
                
        </div>



        <div class="info-login" >

                <h2 class="text-center">Entrar</h2>
                
                <form >
                    <div class="form-group">
                        <!--
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
                        -->

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
                    <div class="form-group row formulario-centro" style="padding-left:70px">
                            <div class="col-md-6 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Lembre-se de mim') }}
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="#" style="color: #1B2E4F;">
                                  {{ __('Esqueceu sua senha?   ') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center ">
                            <div class="row " style="margin-top:20px"> 
                                    <div class="col-md-6 " style="">
                                        <a class="menu-principal" href="#" style="color: #1B2E4F; margin-left: 10px">Cadastrar</a>
                                    </div>

                                    <div class="col-md-6 " style="margin-left: -14px; margin-top: -4px">
                                        <button type="submit" class="btn btn-primary"  style="margin-left: 100px;background-color: #1B2E4F; border-color: #d3e0e9">
                                            {{ __('Entrar') }}
                                        </button>
                                    </div>
                            </div>
                            
                    </div>
                    
                </form>
        </div>
    </div>
@endsection