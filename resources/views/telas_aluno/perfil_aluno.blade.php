@extends('layouts.app')

@section('conteudo')
<!-- Informações do aluno -->
<div class="card mx-auto" style="margin-left: 100px;margin-right: 100px;width:900px;">
  @include('componentes.mensagens')
  <h5 class="card-header">Informações do Aluno</h5>
  <div class="card-body">
    <div class="mx-auto" style="width: 800px;">
          <div class="mx-auto" style="background-color: white;width:400px;height:250px;float:left;padding-left:100px">
            <label for="nome">Nome</label>
            <h4>{{Auth::user()->name}}</h4>
            <label for="nome">CPF</label>
            <h4>{{$aluno->cpf}}</h4>
            <label for="nome">Tipo de Vinculo</label>
            <h4>{{$perfil->situacao}}</h4>
          </div>
          <div class="" style="background-color: white;width:400px;height:250px;float:left;padding-left:100px">
            <label for="nome">Unidade Acadêmica</label>
            <h4>{{$unidadeAluno}}</h4>
            <label for="nome">Curso</label>
            <h4>{{$cursoAluno->nome}}</h4>
            <label for="nome">E-mail</label>
            <h4>{{$user->email}}</h4>
          </div>
          <a href="{{route('alterar-senha')}}" class="btn btn-secondary" style="margin-top: 50px;margin-left: 10px;float:right;">Editar Senha</a>
          <a href="{{route('editar-info')}}" class="btn btn-primary" style="margin-top: 50px;float:right;background-color: #1B2E4F;border-color:#1B2E4F;color:white">Editar Perfil</a>
    </div>
  </div>
</div>

<!-- Perfil aluno -->
<div class="card mx-auto" style="margin-top: 20px;margin-left: 100px;margin-right: 100px;width:900px;">
  <div class="card-body">
        <!-- @csrf -->
        @foreach($perfisAluno as $pa)
            <input type="radio" name="idPerfilRequest" value="{{$pa->default}}">{{$pa->default}} - {{$pa->situacao}}</input>
            <form method="POST" enctype="multipart/form-data" id="formPerfilPadrao" action="{{ route('perfil-padrao', ["idPerfilPadrao"=>$pa->id]) }}">
              @csrf
            @if($pa->valor==false)
              <a href="{{route("perfil-padrao", ["idPerfilPadrao" => $pa->id])}}"
                onclick="event.preventDefault();document.getElementById('formPerfilPadrao').submit();">
                  <span class="glyphicon glyphicon-ok-sign" style="overflow: hidden; color:gray"
                        data-toggle="tooltip" data-placement="top"
                        title="Definir como perfil padrão.">
                  </span>&nbsp
              </a>
            @endif
            @if($pa->valor==true)
              <span class="glyphicon glyphicon-ok-sign" style="overflow: hidden; color:green"
                    data-toggle="tooltip" data-placement="top"
                    title="Perfil padrão.">
              </span>&nbsp
            @endif
          </form>
        <!-- </br> -->
        <form method="POST" enctype="multipart/form-data" id="formExcluirPerfil" action="{{ route('excluir-perfil', ["idPerfil"=>$pa->id]) }}">
          @csrf
          @endforeach
          <a href="{{route("excluir-perfil", ["idPerfil" => $pa->id])}}" class="btn btn-primary"
            onclick="event.preventDefault();document.getElementById('formExcluirPerfil').submit();"
            style="margin-right: 10px; margin-top: 50px;float:right;background-color: #1B2E4F;border-color:#1B2E4F">Excluir Perfil</a>
        </form>
        <form method="POST" enctype="multipart/form-data" id="formAdicionaPerfil" action="{{ route('adiciona-perfil') }}">
          <a href="{{route("adiciona-perfil")}}" class="btn btn-primary"
            style="margin-right: 10px; margin-top: 50px;float:right;background-color: #1B2E4F;border-color:#1B2E4F">Adicionar Perfil</a>
        </form>
  </div>
</div>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script>
// function padrao(){
//        document.getElementById("formPerfilPadrao").submit();
//      }
//      function excluir(){
//             document.getElementById("formPerfilPadrao").submit();
//           }
</script>
@endsection
