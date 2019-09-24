@extends('layouts.app')
@section('conteudo')

@section('titulo','Home Aluno')
@section('navbar')
    Home
@endsection

          <div class="card-deck d-flex justify-content-center">
              <div class="conteudo-central d-flex justify-content-center">


                 <a href="{{ route("prepara-requisicao", ["titulo" => "Solicitar novo documento"]) }}" style="text-decoration:none; color: inherit;">
                    <div class="card cartao text-center " style="border-radius: 30px">
                          <div class="card-body d-flex justify-content-center">
                              <h2 style="padding-top:15px">Solicitar Documentos</h2>
                          </div>
                    </div>
                 </a>

                 <a href="{{ route("home-aluno", ["titulo" => "Listar Documentos Solicitados"]) }}" style="text-decoration:none; color: inherit;">
                    <div class="card cartao text-center " style="border-radius: 30px">
                     <div class="card-body d-flex justify-content-center">
                          <h2 style="padding-top:15px">Listar Documentos Solicitados</h2>
                       </div>
                    </div>
                 </a>

                  <!--Listar Requisições-->
                  <!-- <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario').submit();">
                          <form id="formulario2" action="{{ route('login') }}" method="GET" style="display: none;">
                                  @csrf
                          </form>

                          <div class="card-body d-flex justify-content-center">
                          <h2 style="padding-top:20px">Listar Documentos Solicitados</h2>
                      </div>
                  </div> -->

              </div>
@endsection
