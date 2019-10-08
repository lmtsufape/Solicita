@extends('layouts.app')
@section('conteudo')

@section('titulo','Home Aluno')
@section('navbar')
    Home
@endsection

<!-- <nav class="navbar navbar-expand-lg" style="background-color: #1B2E4F; border-color: #d3e0e9; box-shadow: 0 0 6px rgba(0,0,0,0.5); font-size: 20px; "role="navigation">
  <div class="collapse navbar-collapse">

    <ul class="navbar-nav mr-auto hover">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('login')}}"
          onclick="event.preventDefault();
                        document.getElementById('login').submit();">
                        {{ __('Inicio') }}
        </a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{route('login')}}"
          onclick="event.preventDefault();
                        document.getElementById('login').submit();">
                        {{ __('Aluno') }}
        </a>
      </li>
      <li class="nav-item active">

        <a class="nav-link" href="{{route('login')}}"
          onclick="event.preventDefault();
                        document.getElementById('login').submit();">
                        {{ __('Ajuda') }}
        </a>

    </li>
      <li class="nav-item active">

        <a class="nav-link" href="{{route('login')}}"
          onclick="event.preventDefault();
                        document.getElementById('login').submit();">
                        {{ __('Sair') }}
        </a>
      </li>
    </ul>
  </div>
</nav> -->
          <div class="card-deck d-flex justify-content-center">

              <div class="conteudo-central d-flex justify-content-center">

                  <!-- Solicitar Documento-->
                  <!-- <div class="card cartao text-center " style="border-radius: 20px" href="#" onclick="event.preventDefault(); document.getElementById('formulario').submit();">
                      <form id="formulario" action="{{ route('formulario-requisicao') }}" method="GET" style="display: none;">
                           @csrf<
                               </form>
                                 <div class="card-body d-flex justify-content-center">
                                     <h2 style="padding-top:20px">Solicitar Documentos</h2>
                                 </div>
                 </div> -->

                 <a href="{{ route("formulario-requisicao", ["titulo" => "Solicitar Documentos"]) }}" style="text-decoration:none; color: inherit;">
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
