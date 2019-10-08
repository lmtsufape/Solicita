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
                              @foreach($perfis as $perfil)
                              <h5 name="nomeAluno"><b>{{$perfil->aluno->user->name}}</b></h5>
                              <label for='perfil' style="width: 14.5rem; margin-left:25px"><b>Curso</b></label>
                              <select name="default" class="browser-default custom-select custom-select-lg mb-1" style="width: 13.5rem; margin-left:10px">
                              <option value="{{$perfil->id}}">{{$perfil->default}}</option></br>
                              </select></br>
                              @endforeach
                                  <input type="checkbox" name="declaracaoVinculo"     value="Declaracao de Vinculo"     id="declaracaoVinculo"> Declaração de Vínculo</br>
                                    </input>
                                  <input type="checkbox" name="comprovanteMatricula"  value="Comprovante de Matricula"  id="comprovanteMatricula">Comprovante de matricula</br>
                                    </input>
                                  <input type="checkbox" name="historico"             value="Historico"                 id="historico">Histórico</br>
                                    </input>
                                    <div>
                                      <input type="checkbox" name="programaDisciplina"    value="Programa de Disciplina"    id="programaDisciplina"
                                        onclick="checaSelecaoProgramaDisciplina()"> Programa de Disciplina</br>
                                      </input>
                                        <textarea class="form-control @error('programaDisciplina') is-invalid @enderror "
                                                  form ="formRequisicao" style="display:none" name="requisicaoPrograma" cols="115" id="textareaProgramaDisciplina"
                                                  required placeholder="O campo deve ser preenchido." value="" ></textarea>
                                        @error('programaDisciplina')
                                          <span>
                                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                          </span>
                                        @enderror
                                      </div>
                                      <div>
                                      <input type="checkbox" name="outros"               value="Outros"                     id="outros"
                                        onclick="checaSelecaoOutros()"> Outros<br>
                                      </input>
                                      <textarea class="form-control @error('outrosDocumentos') is-invalid @enderror"
                                                  form ="formRequisicao" style="display:none" name="requisicaoOutros"   cols="115" id="textareaOutrosDocumentos"
                                                  required placeholder="O campo deve ser preenchido" value=""></textarea>
                                                @error('outrosDocumentos')
                                                  <span>
                                                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                  </span>
                                                @enderror
                                      </div>
                                      <!-- </label> -->
                              <div class="form-group row mb-0">
                                      <div class="col-md-8 offset-md-4">
                                        <button type="submit"class="btn btn-primary btn-primary-lmts" route=('confirmacao-requisicao')>
                                        {{ __('Finalizar') }}
                                      </button>
                                      <button type="cancel" class="btn btn-primary btn-primary-lmts" route=('home-aluno')>
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
  if(checkBoxPrograma.checked==true && document.getElementById("textareaProgramaDisciplina").value==""){
    alert('Os campos devem ser preenchidos corretamente.');
    return false;
  }
  if(checkBoxOutros.checked==true && document.getElementById("textareaOutrosDocumentos").value==""){
    alert('Os campos devem ser preenchidos corretamente.');
    return false;
  }
  else{
    document.getElementById('formRequisicao').submit();
  }
  return true;
  }
</script>
@endsection
