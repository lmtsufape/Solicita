@extends('layouts.app')


@section('conteudo')

<div class="tela-servidor ">
        <div class="centro-cartao">
                <div class="card-deck d-flex justify-content-center">

                    <div class="conteudo-central d-flex justify-content-center">

                        <!-- Declaração de Vínculo-->

                        <a href="{{ route('listar-requisicoes', ['titulo' => 'Declaração de Vínculo']) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px">

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:20px">Declaração de Vínculo</h2>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('listar-requisicoes', ['titulo' => 'Comprovante de Matrícula']) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px">

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:20px">Comprovante de Matrícula</h2>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('listar-requisicoes', ['titulo' => 'Histórico']) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px" >

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:20px">Histórico</h2>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('listar-requisicoes', ['titulo' => 'Programa de Disciplina']) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px" >

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:0">Programa de Disciplina</h2>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('listar-requisicoes', ['titulo' => 'Outros']) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px">

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:20px">Outros</h2>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('listar-requisicoes', ['titulo' => 'Todos']) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px">

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:20px">Todos</h2>
                                </div>
                            </div>
                        </a>

@endsection
