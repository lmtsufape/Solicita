@extends('layouts.app')

    
@section('conteudo')

    <div class="tela-servidor ">

        <div class="centro-cartao">
                <div class="card-deck d-flex justify-content-center">

                    <div class="conteudo-central d-flex justify-content-center">
                            
                        <!-- Declaração de Vínculo-->
                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario').submit();">
                                <form id="formulario" action="{{ route('requisicoes_servidor') }}" method="GET" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="titulo" value="Declaração de Vínculo">
                                </form>
                                <div class="card-body d-flex justify-content-center">
                                
                                <h2 style="padding-top:20px">Declaração de Vínculo</h2>
                            </div>
                        </div>
                        

                                                                    
                        
                        <!--rovante de Matrícula -->
                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario1').submit();">
                                <form id="formulario1" action="{{ route('requisicoes_servidor') }}" method="GET" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="titulo" value="Comprovante de Matrícula">
                                </form>
                        
                                <div class="card-body d-flex justify-content-cente r">
                                
                                <h2 style="padding-top:20px">Comprovante de Matrícula</h2>
                            </div>
                        </div>

                        <!--Histórico -->
                       <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario2').submit();">
                                <form id="formulario2" action="{{ route('requisicoes_servidor') }}" method="GET" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="titulo" value="Histórico">
                                </form>
                        
                            <div class="card-body d-flex justify-content-center">
                                
                                <h2 style="padding-top:35px">Histórico</h2>
                            </div>
                        </div> 
                    </div>
            
            
            
                    <div class="conteudo-central d-flex justify-content-center">
                        
                        <!-- -->
                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario3').submit();">
                                <form id="formulario3" action="{{ route('requisicoes_servidor') }}" method="GET" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="titulo" value="Programa de Disciplina">
                                </form>
                            
                                <div class="card-body d-flex justify-content-center">
                                
                                <h2 style="padding-top:20px">Programa de Disciplina</h2>
                            </div>
                        </div>
                        <!-- -->
                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario4').submit();">
                                <form id="formulario4" action="{{ route('requisicoes_servidor') }}" method="GET" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="titulo" value="Outros">
                                </form>
                        
                                <div class="card-body d-flex justify-content-center">
                                
                                <h2 style="padding-top:35px">Outros</h2>
                            </div>
                        </div>
                        <!-- -->
                        <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario5').submit();">
                                <form id="formulario5" action="{{ route('requisicoes_servidor') }}" method="GET" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="titulo" value="Listar Todos">
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