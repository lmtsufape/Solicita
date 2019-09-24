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
                      <form method="POST" enctype="multipart/form-data" id="formRequisicao">
                          @csrf
                          <div class="form-group row justify-content-center"></div>  <!-- COMPROVANTE DE MATRICULA / COMPROVANTE DE VINCULO / HISTORICO-->
                              <!-- <label for='curso' style="width: 14.5rem; margin-left:125px">Selecione uma Unidade Acadêmica</label> -->
                              <select name="curso" class="browser-default custom-select custom-select-lg mb-1" style="width: 13.5rem; margin-left:10px">
                                @foreach($cursos as $curso)
                                  <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                @endforeach
                              </select></br>
                                  <input type="checkbox" name="Declaracao de Vinculo" value="Declaracao de Vinculo" id="declaracaoVinculo"> Declaração de Vínculo</br>

                                  <input type="checkbox" name="Comprovante de Matricula" value="Comprovante de Matricula" id="comprovanteMatricula">Comprovante de matricula</br>

                                  <input type="checkbox" name="Histórico" value="Histórico" id="historico"> Histórico</br>

                                  <input type="checkbox" name="Programa de Disciplina" value="Programa de Disciplina" id="programaDisciplina" onclick="checaSelecaoProgramaDisciplina()"> Programa de Disciplina</br>

                                      <textarea form ="formRequisicao" style="display:none" name="requisicaoPrograma"cols="115" id="textareaProgramaDisciplina"></textarea>

                                  <input type="checkbox" name="Outros" value="Outros" id="outros" onclick="checaSelecaoOutros()"> Outros<br>
                                          <textarea form ="formRequisicao" style="display:none" name="requisicaoOutros" id="textareaOutrosDocumentos" cols="115" ></textarea>
                              <!-- </label> -->
                              <div class="form-group row mb-0">
                                      <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary btn-primary-lmts" onclick="validaCampos()" action={{route('confirmacao-requisicao')}}>
                                        {{ __('Finalizar') }}
                                        </button>

                                        <button type="cancel" class="btn btn-primary btn-primary-lmts" action={{route('cancela-requisicao')}}>
                                          {{ __('Cancelar') }}
                                        </button>

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
  if (checkBoxPrograma.checked == true && textareaProgramaDisciplina.null_or_empty==true) {
      alert('O campo deve ser preenchido corretamente.');
      return false;
  }
  return true;
}

</script>
@endsection
