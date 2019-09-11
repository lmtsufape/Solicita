@extends('layouts.app')


@section('conteudo')


    <div class="background">
        <div class="centro ">
                <h2 class="row d-flex justify-content-center" >Cadastro</h2>

                <form >
                        <div class="form-group">
                            <!--
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
                            -->
    
                    <!-- Form Nome -->
                                                
                    <div class="form-group row formulario-centro">

                        <div class="col-md-9">
                            <label for="name" class="field a-field a-field_a3 page__field ">
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input" 
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
                    
                    <!-- Form CPF -->
                                                
                    <div class="form-group row formulario-centro">

                    <div class="col-md-9">
                        <label for="name" class="field a-field a-field_a3 page__field ">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input" 
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome">

                        <span class="a-field__label-wrap">
                            <span class="a-field__label">CPF</span>
                        </span>
                        </label>
                        @error('email')
                        <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </div>
                    <!-- Vínculo -->
                    <select class="browser-default custom-select custom-select-lg mb-3" style="width: 14.5rem; margin-left:125px">
                        <option value="" disabled selected>Tipo de vínculo</option>
                        <option value="1">Aluno Matriculado</option>
                        <option value="2">Aluno Egresso</option>
                        
                    </select>

                    <select class="browser-default custom-select custom-select-lg mb-1" style="width: 14.5rem; margin-left:125px">
                        <<option value="" disabled selected>Curso</option>
                        <option value="1">Agronomia</option>
                        <option value="2">BCC</option>
                        
                    </select>
                    

                    

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
                    <div class="form-group row formulario-centro">

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
                    </div>
                    
                    <!-- Botões -->
                    <div class="form-group row mb-0 justify-content-center ">
                        <div class="row " style="margin-top:20px; margin-left:-30px"> 
                                <div class="col-md-6 " style="">
                                    <a class="menu-principal" href="{{  route('login')}}" style="color: #1B2E4F; margin-left: -20px"><strong>Voltar</strong></a>
                                </div>

                                <div class="col-md-6 " style="margin-left: -30px; margin-top: -4px">
                                    <button type="submit" class="btn btn-primary"  style="margin-left: 60px;background-color: #1B2E4F; border-color: #d3e0e9">
                                        {{ __('Entrar') }}
                                    </button>
                                </div>
                        </div>
                            
                    </div>


                    
                        
                    </form>
        </div>
    </div>    
@endsection