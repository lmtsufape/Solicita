@extends('layouts.app')

@section('conteudo')
<!-- Informações do aluno -->
<div class="card mx-auto" style="margin-left: 100px;margin-right: 100px;width:900px;">
  <h5 class="card-header">Informações do Aluno</h5>
  <div class="card-body">

    <div class="mx-auto" style="width: 800px;">
          <div class="mx-auto" style="background-color: white;width:400px;height:250px;float:left;padding-left:100px">
            <label for="nome">Nome</label>
            <h4>{{$user->name}}</h4>

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

    @csrf
<div class="card mx-auto" style="margin-top: 20px;margin-left: 100px;margin-right: 100px;width:900px;">
  <h5 class="card-header">Tipo de Perfil</h5>
  <div class="card-body">

    <div class="mx-auto" style="width: 800px;">
      <a href="{{ route("perfil-aluno", ["titulo" => "Listar Documentos Solicitados"]) }}" style="text-decoration:none; color: inherit;">
         <div class="card cartao text-center " style="border-radius: 30px">
          <div class="card-body d-flex justify-content-center">
               <h2 style="padding-top:15px">Perfil</h2>
            </div>
         </div>
      </a>
      <a href="{{ route("perfil-aluno", ["titulo" => "Listar Documentos Solicitados"]) }}" style="text-decoration:none; color: inherit;">
         <div class="card cartao text-center " style="border-radius: 30px">
          <div class="card-body d-flex justify-content-center">
               <h2 style="padding-top:15px">Perfil</h2>
            </div>
         </div>
      </a>
      <a href="{{ route("perfil-aluno", ["titulo" => "Listar Documentos Solicitados"]) }}" style="text-decoration:none; color: inherit;">
         <div class="card cartao text-center " style="border-radius: 30px">
          <div class="card-body d-flex justify-content-center">
               <h2 style="padding-top:15px">Perfil</h2>
            </div>
         </div>
      </a>
    </div>
    <form method="GET" enctype="multipart/form-data" id="formAdicionaPerfil" action="{{ route('adiciona-perfil') }}">
          <a href="{{route("adiciona-perfil")}}" class="btn btn-primary"
            style="margin-right: 10px; margin-top: 50px;float:right;background-color: #1B2E4F;border-color:#1B2E4F">Adicionar Perfil</a>
          <a href="#" class="btn btn-primary"
            style="margin-right: 10px; margin-top: 50px;float:right;background-color: #1B2E4F;border-color:#1B2E4F">Editar Perfil</a>
    </form>
    </div>
  </div>

@endsection
