@extends('layouts.app')

@section('conteudo')
<!-- Informações do aluno -->
<div class="card mx-auto" style="margin-left: 100px;margin-right: 100px;width:900px;">
  <div>@include('componentes.mensagens')</div>
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
          <a href="{{route('alterar-senha')}}" class="btn btn-primary" style="margin-top: 50px;margin-right: 10px;float:right;background-color: #1B2E4F;border-color:#1B2E4F;color:white">Editar Senha</a>
          <a href="{{route('editar-info')}}" class="btn btn-primary" style="margin-top: 50px; margin-right: 10px; float:right;background-color: #1B2E4F;border-color:#1B2E4F;color:white">Editar Informações</a>
    </div>
  </div>
</div>

<!-- Perfil aluno -->
<div class="card mx-auto" style="margin-top: 20px;margin-left: 100px;margin-right: 100px;width:900px;margin-bottom:50px">
  <div class="card-body">
        @foreach($perfisAluno as $pa)
        <form method="POST" enctype="multipart/form-data" id="formExcluirPerfil" action="{{ route('excluir-perfil') }}">
          @csrf
          <input type="radio" name="idPerfil" value="{{$pa->id}}" id="radioButton">{{$pa->default}} - {{$pa->situacao}}</input>
              @if($pa->valor==false)
              <a id="botao" data-toggle="modal" data-target="#myModal" aria-hidden="true"
                    data-whatever="{{$pa->default}}" onclick="perfilId({{$pa->id}})">
                    <span class="glyphicon glyphicon-ok-sign" style="overflow: hidden; color:gray"
                          data-toggle="tooltip" data-placement="top"
                           title="Definir como padrão."
                           data-id="{{$pa->id}}"
                           data-nome="{{$pa->default}}"
                           data-title="{{$pa->id}}">
                    </span>
              </a>
              @endif
              @if($pa->valor==true)
                <span class="glyphicon glyphicon-ok-sign" style="overflow: hidden; color:green"
                      data-toggle="tooltip" data-placement="top"
                      title="Perfil padrão.">
                </span>
              @endif
              <br>
          @endforeach
          <a id="submitRadio" href="{{route("excluir-perfil")}}" class="btn btn-secondary"
            onclick="event.preventDefault();document.getElementById('formExcluirPerfil').submit();"
            style="margin-top: 50px; margin-right: 10px; float:right;">Excluir Perfil
          </a>

        </form>
        <form method="GET" enctype="multipart/form-data" id="formAdicionaPerfil" action="{{ route('adiciona-perfil') }}">
          <a href="{{route("adiciona-perfil")}}" class="btn btn-primary"
            style="margin-top: 50px; margin-right: 10px; float:right;background-color: #1B2E4F;border-color:#1B2E4F;color:white">Adicionar Perfil</a>
        </form>
  </div>
          @foreach($perfisAluno as $pa)
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
              aria-hidden="true">
              <form method="post" id="formModal" action="{{ route("perfil-padrao") }}">
              @csrf
              <input type="hidden" name="idPerfil" value="" id="id_documento">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <label>Definir o perfil como padrão?</label>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-footer">
                      <a type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right:10px">
                        {{ ('Não') }}
                      </a>
                      <a type="button" class="btn btn-primary btn-primary-lmts" onclick="event.preventDefault(); confirma()"
                      href="{{ route("perfil-padrao")}}" style="margin-right:10px">
                      {{ ('Sim') }}
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
              <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
              </form>
              @endforeach
</div>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script>
function confirma(){
    document.getElementById("formModal").submit();
}
</script>
<script>
function perfilId(id){
  document.getElementById('id_documento').value = id;
}
</script>
@endsection
