@extends('layouts.app')

@section('conteudo')

<!-- @include('componentes.mensagens') -->
    <div class="tabela-centro mx-auto">
        <table class="table" id="table" >
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
                <th scope="col" class="titleColumn" onclick="sortTable(0)" style="cursor:pointer">N°
                  <img src="{{asset('images/sort.png')}}" style="height:15px">
                </th>
                <th scope="col" class="titleColumn" >CPF</th>
                <th scope="col" class="titleColumn" onclick="sortTable(2)" style="cursor:pointer">NOME
                <img src="{{asset('images/sort.png')}}" style="height:15px"></th>
                <th scope="col" class="titleColumn" >CURSO</th>
                <th scope="col" class="titleColumn" onclick="sortTable(4)" style="cursor:pointer">DATA DE REQUISIÇÃO
                <img src="{{asset('images/sort.png')}}" style="height:15px"></th>
                <th scope="col" class="titleColumn" >PRAZO</th>
                <th scope="col" class="titleColumn" >STATUS</th>

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
                    <td>{{$loop->iteration}}</td>
                    <td>{{$requisicao_documento['cpf']}}</td>
                    <td>{{$requisicao_documento['nome']}}</td>
                    <td>{{$requisicao_documento['curso']}}</td>
                    <td>{{$requisicao_documento['status_data']}}</td>
                    <td>dd/mm/aaaa</td>
                    <td>{{$requisicao_documento['status']}}</td>

                        @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
                            <td class="text-wrap">{{$requisicao_documento['detalhes']}}</td>

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
    if(confirm("Você deseja marcar o(s) documento(s) como concluído(s)?")== true){

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

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("table");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection
