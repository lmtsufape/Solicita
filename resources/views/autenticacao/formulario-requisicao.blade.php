@extends('layouts.app')

@section('conteudo')
@section('navbar')
    Home
@endsection
<div class="container" style="width: 100rem;margin-left: 200px;">
        <div class="col-md-8">
            <div class="card" style="width: 70rem;">
                <div class="card-header" align="center">{{ __('Solicitar Documentos') }}</div>
                  <div class="card-body">
                      <form method="POST" enctype="multipart/form-data" id="formRequisicao" action="{{ route('confirmacao-requisicao') }}">
                          @csrf
                          <div class="form-group row justify-content-center"></div>  <!-- COMPROVANTE DE MATRICULA / COMPROVANTE DE VINCULO / HISTORICO-->
                              <!-- <label for='curso' style="width: 14.5rem; margin-left:125px">Selecione uma Unidade Acadêmica</label> -->
                              @foreach($perfis as $perfil)
                              <h5 name="nomeAluno"><b>{{$perfil->aluno->user->name}}</b></h5>

                              <label for='perfil' style="width: 14.5rem; margin-left:25px"><b>Curso</b></label>
                              <select name="default" class="browser-default custom-select custom-select-lg mb-1" style="width: 13.5rem; margin-left:10px">
                              <option value="{{$perfil->id}}">{{$perfil->default}}</option></br>
                              </select></br>

                              <label for='perfil' style="width: 14.5rem; margin-left:25px"><b>Situaçao Acadêmica</b></label>
                              <select name="situacaoAcademica" class="browser-default custom-select custom-select-lg mb-1" style="width: 13.5rem; margin-left:10px">
                              <option value="{{$perfil->id}}">{{$perfil->situacao}}</option></br>
                              </select></br>

                              @endforeach
                                  <input type="checkbox" name="declaracaoVinculo" value="Declaracao de Vinculo" id="declaracaoVinculo"> Declaração de Vínculo</br>
                                  <input type="checkbox" name="comprovanteMatricula" value="Comprovante de Matricula" id="comprovanteMatricula">Comprovante de matricula</br>
                                  <input type="checkbox" name="historico" value="Historico" id="historico"> Histórico</br>
                                  <input type="checkbox" name="programaDisciplina" value="Programa de Disciplina" id="programaDisciplina" onclick="checaSelecaoProgramaDisciplina()"> Programa de Disciplina</br>
                                      <textarea form ="formRequisicao" style="display:none" required="" name="requisicaoPrograma"cols="115" id="textareaProgramaDisciplina"></textarea>
                                  <input type="checkbox" name="outros" value="Outros" id="outros" onclick="checaSelecaoOutros()"> Outros<br>
                                      <textarea form ="formRequisicao" style="display:none" required="" name="requisicaoOutros" id="textareaOutrosDocumentos" cols="115" ></textarea>
                              <!-- </label> -->
                              <div class="form-group row mb-0">
                                      <div class="col-md-8 offset-md-4">
                                        <a class="btn btn-primary btn-primary-lmts" onclick="event.preventDefault(); validaCampos();" href="{{ route('confirmacao-requisicao') }}">
                                        {{ ('Finalizar') }}
                                        </a>

                                        <a class="btn btn-primary btn-primary-lmts" onclick="event.preventDefault()" href="{{ route('cancela-requisicao')}}">
                                          {{ ('Cancelar') }}
                                        </a>
                                    </div>
                              </div>
                        </form>
                    </div>
            </div>
        </div>
</div>
<script>
function checaSelecaoProgramaDisciplina() {
  var checkBoxPrograma = document.getElementById("programaDisciplina");
  var textareaProgramaDisciplina = document.getElementById("textareaProgramaDisciplina");
  if (checkBoxPrograma.checked == true){
    textareaProgramaDisciplina.style.display = "block";
  } else {
    textareaProgramaDisciplina.style.display = "none";
  }
}
function checaSelecaoOutros() {
  var checkBoxOutros = document.getElementById("outros");
  var textareaOutrosDocumentos = document.getElementById("textareaOutrosDocumentos");
  if (checkBoxOutros.checked == true){
    textareaOutrosDocumentos.style.display = "block";
  } else {
    textareaOutrosDocumentos.style.display = "none";
  }
}
function validaCampos() {
  var checkBoxDeclaracao = document.getElementById('declaracaoVinculo');
  var checkBoxComprovante = document.getElementById('comprovanteMatricula');
  var checkBoxHistorico = document.getElementById('historico');
  var checkBoxPrograma = document.getElementById('programaDisciplina');
  var checkBoxOutros = document.getElementById('outros');
  var textareaProgramaDisciplina = document.getElementById("textareaProgramaDisciplina");
  var textareaOutrosDocumentos = document.getElementById("textareaOutrosDocumentos");

  if (checkBoxDeclaracao.checked == false
      && checkBoxComprovante.checked == false
      && checkBoxHistorico.checked == false
      && checkBoxPrograma.checked == false
      && checkBoxOutros.checked == false) {
      alert('Informe ao menos um dos documento que deseja solicitar.');
      return false;
  }
  else{
    document.getElementById('formRequisicao').submit();
  }
  return true;
}
</script>
@endsection
