@extends('layouts.app')

@section('conteudo')
<!-- @section('navbar')
    Home
@endsection -->
<div class="container" style="height:80vh" >
  <div class="col-md-8">
      <div class="card" style="width: 100%; margin-left:20%; margin-right:20%;">
          <h5 class="card-header" style="text-align:center">Solicitar Documentos</h5>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data" id="formRequisicao" action="{{ route('confirmacao-requisicao') }}">
                @csrf
                 <!-- COMPROVANTE DE MATRICULA / COMPROVANTE DE VINCULO / HISTORICO-->
                <div class="form-group row justify-content-center"></div>
                <b><label>Aluno:  </label>&nbsp{{Auth::user()->name}}</b></br>
                <b><label>Perfil: </label></b>
                <select name="default" class="browser-default custom-select custom-select-lg mb-1" style="width: 80%;font-size: 90%">
                    @foreach($perfis as $perfil)
                    <!-- <label for='perfil' style="width: 14.5rem; margin-left:25px"><b>Curso</b></label> -->
                    <option @if($perfil->valor==true) selected @endif value="{{$perfil->id}}">{{$perfil->default}} - {{$perfil->situacao}}</option></br>
                    @endforeach
                </select>
                </br>
                <!-- <label>Vínculo</label>
                </br>
                <select name="vinculo" class="browser-default custom-select custom-select-lg mb-1" style="width: 70%;">
                  <option value="1"selected>Aluno Matriculado</option>
                  <option value="2">Aluno Egresso</option>
                </select></br>
                </br> -->
              </br>
                <label>Documentos</label>
                </br>
                <div>
                  <input type="checkbox" name="declaracaoVinculo"     value="Declaracao de Vinculo"
                    id="declaracaoVinculo"> Declaração de Vínculo (Também disponível pelo link:</input>
                      <a target="_blank" href = "http://www.drca.ufrpe.br/declaracao_vinculo/add">DRCA</a>).</br>
                </div>
                <div>
                  <input type="checkbox" name="comprovanteMatricula"  value="Comprovante de Matricula"  id="comprovanteMatricula"> Comprovante de matrícula.</input></br>
                </div>
                <div>
                  <input type="checkbox" name="historico"             value="Historico"                 id="historico"> Histórico Escolar.</input></br>
                </div>
                  <div>
                    <input type="checkbox" name="programaDisciplina"    value="Programa de Disciplina"    id="programaDisciplina"
                      onclick="checaSelecaoProgramaDisciplina()"> Programa de Disciplina (informar abaixo o nome da disciplina e a finalidade).</input>

                  </br>
                      <textarea maxlength="255" class="form-control @error('programaDisciplina') is-invalid @enderror "
                                form ="formRequisicao" style="display:none; margin-top:10px;" name="requisicaoPrograma" cols="115" id="textareaProgramaDisciplina"
                                required autocomplete="programaDisciplina"
                                placeholder="Preencha este campo com o nome da(s) disciplina(s) e a finalidade da requisição."></textarea>
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
                      onclick="checaSelecaoOutros()"> Outros (informar abaixo).<br>
                    </input>
                    <textarea maxlength="255" class="form-control @error('outrosDocumentos') is-invalid @enderror"
                                form ="formRequisicao" style="display:none; margin-top:10px" name="requisicaoOutros"   cols="115" id="textareaOutrosDocumentos"
                                required placeholder="O campo deve ser preenchido"></textarea>
                              @error('outrosDocumentos')
                                <span>
                                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                  <strong>{{ $message }}</strong>
                                  </span>
                                </span>
                              @enderror
                    </div>
                    <!-- </label> -->
                    <div class="form-group row mb-0" style="margin-top:10px">
                            <div class="col-md-8 offset-md-4">

                              <a class="btn btn-secondary" href="{{ route('cancela-requisicao')}}" style="margin-right:10px">
                                {{ ('Cancelar') }}
                              </a>

                              <a class="btn btn-primary btn-primary-lmts" onclick="event.preventDefault(); validaCampos();"
                              href="{{ route('confirmacao-requisicao') }}" style="margin-right:10px">
                              {{ ('Solicitar') }}
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
  if(checkBoxPrograma.checked==true && document.getElementById("textareaProgramaDisciplina").value==""){
    document.getElementById("textareaProgramaDisciplina").style.border = "2px solid red";
    if(checkBoxOutros.checked==true && document.getElementById("textareaOutrosDocumentos").value==""){
      document.getElementById("textareaOutrosDocumentos").style.border = "2px solid red";
    }
    alert('Os campos devem ser preenchidos corretamente.');
    return false;
  }
  if(checkBoxOutros.checked==true && document.getElementById("textareaOutrosDocumentos").value==""){
    document.getElementById("textareaOutrosDocumentos").style.border = "2px solid red";
    if(checkBoxPrograma.checked==true && document.getElementById("textareaProgramaDisciplina").value==""){
      document.getElementById("textareaProgramaDisciplina").style.border = "2px solid red";
    }
    alert('Os campos devem ser preenchidos corretamente.');
    return false;
  }

  else{
    document.getElementById('formRequisicao').submit();
  }
  return true;
  }
</script>
<!-- <script>
function informacao()
{
var myAlert = document.getElementById("info");
alert('Para o atendimento de sua solicitação, favor informar a(s) disciplina(s) e a finalizade da requisição.');
}
</script> -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"
>
@endsection
