@extends('layouts.app')

    
@section('conteudo')

    <div class="tela-servidor ">

        <div class="centro-cartao">
                <div class="card-deck d-flex justify-content-center">

                    <div class="conteudo-central d-flex justify-content-center">
                            
                        <!-- Declaração de Vínculo-->

                        

                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario').submit();">
                                <form id="formulario" action="{{ route('login') }}" method="GET" style="display: none;">
                                        @csrf
                                </form>
                                <div class="card-body d-flex justify-content-center">
                                
                                <h2 style="padding-top:20px">Declaração de Vínculo</h2>
                            </div>
                        </div>
                        

                                                                    
                        
                        <!--rovante de Matrícula -->
                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario').submit();">
                                <form id="formulario" action="{{ route('login') }}" method="GET" style="display: none;">
                                        @csrf
                                </form>
                        
                                <div class="card-body d-flex justify-content-cente r">
                                
                                <h2 style="padding-top:20px">Comprovante de Matrícula</h2>
                            </div>
                        </div>

                        <!--Histórico -->
                       <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario').submit();">
                                <form id="formulario" action="{{ route('login') }}" method="GET" style="display: none;">
                                        @csrf
                                </form>
                        
                            <div class="card-body d-flex justify-content-center">
                                
                                <h2 style="padding-top:35px">Histórico</h2>
                            </div>
                        </div> 
                    </div>
            
            
            
                    <div class="conteudo-central d-flex justify-content-center">
                        
                        <!-- -->
                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario').submit();">
                                <form id="formulario" action="{{ route('login') }}" method="GET" style="display: none;">
                                        @csrf
                                </form>
                            
                                <div class="card-body d-flex justify-content-center">
                                
                                <h2 style="padding-top:20px">Programa de Disciplina</h2>
                            </div>
                        </div>
                        <!-- -->
                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario').submit();">
                                <form id="formulario" action="{{ route('login') }}" method="GET" style="display: none;">
                                        @csrf
                                </form>
                        
                                <div class="card-body d-flex justify-content-center">
                                
                                <h2 style="padding-top:35px">Outros</h2>
                            </div>
                        </div>
                        <!-- -->
                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario').submit();">
                                <form id="formulario" action="{{ route('login') }}" method="GET" style="display: none;">
                                        @csrf
                                </form>
                        
                            <div class="card-body d-flex justify-content-center">
                                
                                <h2 style="padding-top:35px">Listar Todos</h2>
                            </div>
                        </div>
            
                            
                    </div>
        </div>

        
         
    </div>
            
    
<!--
    

-->
@endsection