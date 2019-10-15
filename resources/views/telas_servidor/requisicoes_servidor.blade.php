@extends('layouts.app')

@section('conteudo')

    <div class="tabela-centro mx-auto">
        <table class="table" >
            <div class="lmts-primary">

              <!-- botão para confirmar seleção -->
              <!-- ao clicar no botão de confirmar, é chamado a função confirmarRequisicao(). Se o usuário cancelar o event.preventDefault cancela o envio
                  do formulario. caso contrário, o formulário é enviado e o documento selecionado é marcado como processando-->
              <button id="btnFinalizar" onclick="event.preventDefault();confirmarRequisicao()"
              class="btn btn-outline-light" style="margin-bottom: -40px; float:right; margin-top: 20px; margin-right:20px"  >Concluir Requisição</button>

            <div class="nome-documento lmts-primary mx-auto " style="height:100px">
                <h2 class="" style="padding-top:50px"> {{$titulo}} </h2>
            </div>
            </div>




            <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;" >
            <tr >
                <!-- Checkbox para selecionar todos os documentos -->
                <th scope="row">

                  <!-- botão de finalizar -->
                  <form id="formularioRequisicao" action="{{  route('listar-requisicoes-post')  }}" method="POST">
                    @csrf


                    <!-- Checkbox que seleciona todos os outros -->
                    <div class="form-check">
                      <input class="checkboxLinha" type="checkbox" id="selectAll" value="">


                    </div>


                </th>


                <th scope="col">Id</th>
                <th scope="col">CPF</th>
                <th scope="col">NOME</th>
                <th scope="col">CURSO</th>
                <th scope="col">DATA DE REQUISIÇÃO</th>
                <th scope="col">PRAZO</th>
                <th scope="col">STATUS</th>


                @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
                    <th scope="col">INFORMAÇÕES</th>
                @endif



            </tr>
            </thead>
            <tbody>


                @foreach($listaRequisicao_documentos as $requisicao_documento)

                    <tr>
                      <th scope="row">
                        <div class="form-check">
                          <!-- checkboxLinha[] pega o valor de todos os checkboxLinha e envia como post para a rota -->
                          <input class="checkboxLinha" type="checkbox" id="checkboxLinha" name="checkboxLinha[]" value="{{$requisicao_documento['id']}}" onclick="">
                        </div>

                      </th>
                        <td>{{$requisicao_documento->id}}</td>
                        <td>{{$requisicao_documento->aluno->cpf}}</td>
                        <td>{{$requisicao_documento->aluno->user->name}}</td>
                        <td>{{$requisicao_documento->requisicao->perfil->default}}</td>
                        <td>{{$requisicao_documento->status_data}}</td>
                        <td>dd/mm/aaaa</td>
                        <td>{{$requisicao_documento->status}}</td>

                        @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
                            <td class="text-wrap">{{$requisicao_documento->detalhes}}</td>

                        @endif
                  </tr>
                @endforeach
              </div>
            </form>


            </tbody>
        </table>

<!-- @if (session('alert'))
<div class="alert alert-success">
  {{ session('alert') }}
</div>
@endif -->

<script>

var checkedAll = false;
var checkBoxs;
document.getElementById("selectAll").addEventListener("click", function(){
  checkBoxs = document.querySelectorAll('input[type="checkbox"]:not([id=selectAll])');
  //"Hack": http://toddmotto.com/ditch-the-array-foreach-call-nodelist-hack/
  [].forEach.call(checkBoxs, function(checkbox) {
      //Verificamos se é a hora de dar checked a todos ou tirar;
      checkbox.checked = checkedAll ? false : true;
  });
  //Invertemos ao final da execução, caso a última tenha sido true para checar todos, tornamos ele false para o próximo clique;
  checkedAll = checkedAll ? false : true;
  //getLinhas();
});

console.log(checkBoxs);

function confirmarRequisicao(){

  var ids = getLinhas(); // retorna o newArray contendo todos os ids dos checkboxs selecionados

// verifica se o usuário selecionou pelo menos um checkbox
if(ids.length != 0){

    if(confirm("Você deseja marcar o(s) documento(s) como solicitado?")== true){
      document.getElementById("formularioRequisicao").submit();
    }
  }else {
    alert("Selecione pelo menos um documento!");
  }

}

function getLinhas(){
  var ids = document.getElementsByClassName("checkboxLinha");// pega o id de todos os checkboxs marcados
  return getIds(ids);

}

function getIds(dados){
  var arrayDados = dados;
  var newArray = [];//array aux para guardar os ids dos documentos

  for(var i = 0; i <= arrayDados.length; i++){
    if(typeof arrayDados[i]=='object'){
      if(arrayDados[i].checked){// se o checkbox estiver marcado
        newArray.push(arrayDados[i].value); //adiciona em um array o id do documento solicitado
      }
    }
  }
  return newArray;
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection
