@extends('layouts.app')

@section('conteudo')
<!-- @section('navbar')
    Home
@endsection -->
<div class="container" style="min-height:80vh" >

  <div class="row justify-content-center">
    <div class="col-sm-8">
      <div class="card card-cadastro">
        <div class="card-body">

            <div class="row justify-content-center">
                <h2>Solicitar Documentos</h2>
            </div>
            <form method="POST" enctype="multipart/form-data" id="formRequisicao" action="{{ route('confirmacao-requisicao') }}">
              @csrf
              
              <div class="form-group row justify-content-center">
                <div class="col-sm-12">

                  <label>Aluno</label>
                  <h4>&nbsp{{Auth::user()->name}}</h4>
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <div class="col-sm-12">
                  <label>Perfil</label>
                  <select name="default" class="custom-select custom-select-lg " style="font-size: 90%">
                    @foreach($perfis as $perfil)
                    <!-- <label for='perfil' style="width: 14.5rem; margin-left:25px"><b>Curso</b></label> -->
                    <option @if($perfil->valor==true) selected @endif value="{{$perfil->id}}">{{$perfil->default}} - {{$perfil->situacao}}</option></br>
                    @endforeach
                </select>
                </div>
              </div>

              <div class="form-group row justify-content-center">
                <div class="col-sm-12">
                  <label>Documentos</label>
                  {{-- Declaração de vínculo --}}
                  <div>
                    <input type="checkbox" name="declaracaoVinculo"     value="Declaracao de Vinculo"
                      id="declaracaoVinculo"> Declaração de vínculo (também disponível pelo link:</input>
                        <a target="_blank" href = "http://www.drca.ufrpe.br/declaracao_vinculo/add">DRCA</a>).</br>
                  </div>
                  {{-- comprovante de matrícula --}}
                  <div>
                    <input type="checkbox" name="comprovanteMatricula"  value="Comprovante de Matricula"  id="comprovanteMatricula"> Comprovante de matrícula.</input></br>
                  </div>
                  {{-- Histórico escolar --}}
                  <div>
                    <input type="checkbox" name="historico"             value="Historico"                 id="historico"> Histórico Escolar.</input></br>
                  </div>

                  {{-- programa de disciplina --}}
                  <div>
                    <input type="checkbox" name="programaDisciplina"    value="Programa de Disciplina"    id="programaDisciplina"
                      onclick="checaSelecaoProgramaDisciplina()"> Programa de Disciplina (informar abaixo o nome da disciplina e a finalidade).</input>

                  </br>
                      <textarea maxlength="255" class="form-control @error('programaDisciplina') is-invalid @enderror @error('requisicaoPrograma') is-invalid @enderror"
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
                      @error('requisicaoPrograma')
                        <span>
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                          <strong>{{ $message }}</strong>
                          </span>
                        </span>
                      @enderror
                    </div>
                    {{-- outros  --}}
                    <div>
                      <input type="checkbox" name="outros"               value="Outros"                     id="outros"
                        onclick="checaSelecaoOutros()"> Outros (informar abaixo).<br>
                      </input>
                      <textarea maxlength="255" class="form-control @error('requisicaoOutros') is-invalid @enderror"
                                  form ="formRequisicao" style="display:none; margin-top:10px" name="requisicaoOutros"   cols="115" id="textareaOutrosDocumentos"
                                  required placeholder="O campo deve ser preenchido"></textarea>
                                @error('requisicaoOutros')
                                  <span>
                                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                  </span>
                                @enderror
                      </div>

                      <div class="form-group row mb-0" style="margin-top:10px">
                        <div class="col-md-8 offset-md-4">

                          <a class="btn btn-secondary" href="{{ route('cancela-requisicao')}}" style="margin-right:10px">
                            {{ ('Cancelar') }}
                          </a>

                          <a class="btn btn-primary-lmts" onclick="event.preventDefault(); validaCampos();"
                          href="{{ route('confirmacao-requisicao') }}" style="margin-right:10px">
                          {{ ('Solicitar') }}
                          </a>
                        </div>
                      </div>


                </div>
              </div>
                  
                
            
            </form>

        </div>
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
