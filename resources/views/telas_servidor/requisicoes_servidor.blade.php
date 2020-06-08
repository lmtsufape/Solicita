@extends('layouts.app')

@section('conteudo')
  
    

  <div class="tabela-centro mx-auto" >

    <form action="{{  route('listar-requisicoes')  }}" method="GET">
        @csrf
        <div class="container">
           <div class="form-row " >
            <div class="form-group col-md-6">
              
              <label for="cursos" >Selecionar Curso</label>
              <div class="justify-content-right" >
                <select name="curso_id" id="cursos" onchange=""
                class="form-control mb-0" style="width: 500px">
                  
                  @foreach($cursos as $curso)
                    <option id="nomeCurso" value="{{$curso->id}}" onclick="">{{$curso->nome}}</option>
                  @endforeach
                </select>
              </div>

            </div>
            <div class="form-group col-md-6">
              
              
            <label for="documentos" >Selecionar Documento</label>
            <div class="justify-content-right" >
              <select name="titulo_id" id="documentos" onchange=""
              class="form-control mb-0" style="width: 500px">
                
                @foreach($documentos as $documento)
                  <option id="tipoDocumento" value="{{$documento->id}}" onclick="">{{$documento->tipo}}</option>
                @endforeach
              </select>
            </div>
         
              
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3" >Atualizar</button>
         
        </div>
       
    </form>


    <table class="table table-striped" id="table" >
      <div class="lmts-primary">
        <div class="nome-documento lmts-primary mx-auto " style="height:100px">
          <h2 id="idCursoTitulo" class="mb-0" style="padding-top:10px">{{$cursoSelecionado->nome}} - </h2>


          <h2 class="mt-1" > {{$titulo}}</h2>


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
            @if(isset($listaRequisicao_documentos))
              @if(sizeof($listaRequisicao_documentos) > 0)
              <input class="checkboxLinha" type="checkbox" id="selectAll" value="">
              @endif
            @endif

          </div>
        </th>
        <th scope="col" class="titleColumn" onclick="sortTable(0)" style="cursor:pointer">N°
          <img src="{{asset('images/sort.png')}}" style="height:15px">
        </th>
        <th scope="col" class="titleColumn" >CPF</th>
        <th scope="col" class="titleColumn" onclick="sortTable(2)" style="cursor:pointer">NOME
          <img src="{{asset('images/sort.png')}}" style="height:15px"></th>
        <th scope="col" class="titleColumn" >CURSO</th>
        <th scope="col" class="titleColumn" >E-MAIL</th>
        <th scope="col" class="titleColumn">VÍNCULO</th>
        <th scope="col" class="titleColumn" onclick="sortTable(5)" style="cursor:pointer">DATA E HORA DE REQUISIÇÃO
          <img src="{{asset('images/sort.png')}}" style="height:15px"></th>
        {{-- <th scope="col" class="titleColumn">HORA DE REQUISIÇÃO</th> --}}
        @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
            <th scope="col">INFORMAÇÕES</th>
        @endif
        @if($titulo=="Concluídos" || $titulo == "Indeferidos" )
            <th scope="col" >DOCUMENTO SOLICITADO</th>
            <th scope="col" >STATUS</th>
        @else
            <th scope="col">AÇÃO</th>
        @endif
        <!-- <th scope="col" class="titleColumn" >STATUS</th> -->
        
        </tr>
        </thead>
          <tbody>
            @foreach($listaRequisicao_documentos as $requisicao_documento)
            <tr>
            <th scope="row" style="width:10px">
              <div class="form-check">
                <!-- checkboxLinha[] pega o valor de todos os checkboxLinha e envia como post para a rota -->
                <input class="checkboxLinha" type="checkbox" id="checkboxLinha" name="checkboxLinha[]" value="{{$requisicao_documento['id']}}" onclick="">
              </div>
            </th>
              <td>{{$loop->iteration}}</td>
              <td>{{$requisicao_documento['cpf']}}</td>
              <td>{{$requisicao_documento['nome']}}</td>
              <td>{{$requisicao_documento['curso']}}</td>
              <td>{{$requisicao_documento['email']}}</td>
              <td>{{$requisicao_documento['vinculo']}}</td>
              <td>{{date_format(date_create($requisicao_documento['status_data']), 'd/m/Y')}}, {{$requisicao_documento['status_hora']}}</td>
              {{-- <td>{{$requisicao_documento['status_data']}}</td>
              <td>{{$requisicao_documento['status_hora']}}</td> --}}

                @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
                 <td class="td-align">                                 
                    <a data-toggle="tooltip" data-placement="left" title="Informações:{{$requisicao_documento['detalhes']}} ">                    
                        <span onclick="exibirAnotacoes({{$requisicao_documento['id']}})" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        @component('componentes.popup', ["titulo"=>"Informações:", "conteudo"=>$requisicao_documento['detalhes'], "id"=>$requisicao_documento['id']])
                        @endcomponent                             
                    </a>
                  </td>
                @endif
              {{-- DOCUMENTOS SOLICITADOS E STATUS - INICIO --}}
              @if($titulo=="Indeferidos" || $titulo == "Concluídos" )
                {{-- DOCUMENTOS INDEFERIDOS --}}
                @if($requisicao_documento['status'] == 'Indeferido' )
                    <td>                    
                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 1)
                        Declaração de Vínculo                          
                     @endif

                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 2)
                        Comprovante de Matrícula
                     @endif

                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 3)
                        Histórico Escolar                                                             
                     @endif
                      
                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 4) 
                          Programa de Disciplina
                          <a data-toggle="tooltip" data-placement="left" title="Informações:{{$requisicao_documento['requisicoes_documentos']['detalhes']}} ">                  
                              <span onclick="exibirAnotacoes({{$requisicao_documento['id']}})" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                              @component('componentes.popup', ["titulo"=>"Informações:", "conteudo"=>$requisicao_documento['requisicoes_documentos']['detalhes'], "id"=>$requisicao_documento['requisicoes_documentos']['id']])
                              @endcomponent                             
                          </a> 
                     @endif

                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 5)   
                        Outros 
                        <a data-toggle="tooltip" data-placement="left" title="Informações:{{$requisicao_documento['requisicoes_documentos']['detalhes']}} ">                    
                        <span onclick="exibirAnotacoes({{$requisicao_documento['id']}})" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        @component('componentes.popup', ["titulo"=>"Informações:", "conteudo"=>$requisicao_documento['requisicoes_documentos']['detalhes'], "id"=>$requisicao_documento['requisicoes_documentos']['id']])
                        @endcomponent                             
                    </a>      
                     @endif 

                    {{-- {{$requisicao_documento['requisicoes_documentos']['id']}} --}}
                    
                  </td>  
                    
                  <td class="text-danger">
                    Requisição: {{$requisicao_documento['status']}}
                    <a data-toggle="tooltip" data-placement="left" title="Motivo(s):{{$requisicao_documento['requisicoes_documentos']['anotacoes']}} ">                    
                        <span onclick="exibirAnotacoes({{$requisicao_documento['requisicoes_documentos']['id']+1}})" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        @component('componentes.popup', ["titulo"=>"Motivo(s):", "conteudo"=>$requisicao_documento['requisicoes_documentos']['anotacoes'], "id"=>$requisicao_documento['requisicoes_documentos']['id']+1])
                        @endcomponent                             
                    </a>
                  </td> 
                @elseif($titulo=="Concluídos")
                  {{-- DOCUMENTOS CONCLUIDOS --}}
                  <td>                    
                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 1)
                        Declaração de Vínculo                          
                     @endif

                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 2)
                        Comprovante de Matrícula
                     @endif

                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 3)
                        Histórico Escolar                                                             
                     @endif
                      
                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 4) 
                          Programa de Disciplina
                          <a data-toggle="tooltip" data-placement="left" title="Informações:{{$requisicao_documento['requisicoes_documentos']['detalhes']}} ">                  
                              <span onclick="exibirAnotacoes({{$requisicao_documento['id']}})" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                              @component('componentes.popup', ["titulo"=>"Informações:", "conteudo"=>$requisicao_documento['requisicoes_documentos']['detalhes'], "id"=>$requisicao_documento['requisicoes_documentos']['id']])
                              @endcomponent                             
                          </a> 
                     @endif

                     @if($requisicao_documento['requisicoes_documentos']['documento_id'] == 5)   
                        Outros 
                        <a data-toggle="tooltip" data-placement="left" title="Informações:{{$requisicao_documento['requisicoes_documentos']['detalhes']}} ">                    
                        <span onclick="exibirAnotacoes({{$requisicao_documento['id']}})" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        @component('componentes.popup', ["titulo"=>"Informações:", "conteudo"=>$requisicao_documento['requisicoes_documentos']['detalhes'], "id"=>$requisicao_documento['requisicoes_documentos']['id']])
                        @endcomponent                             
                    </a>      
                     @endif 

                    {{-- {{$requisicao_documento['requisicoes_documentos']['id']}} --}}
                    
                  </td>                     

                  <td class="text-success">
                    Requisição: {{$requisicao_documento['status']}}
                  </td> 
                @endif
                                
              @else
                <td class="td-align">
                  <a href="" id="botao" data-toggle="modal" data-target="#myModal" aria-hidden="true" onclick="event.preventDefault();mudarId({{$requisicao_documento['id']}});"
                      data-whatever="{{$requisicao_documento['nome']}}" 
                      data-curso="{{$requisicao_documento['curso']}}"
                      data-anotacoes="{{$requisicao_documento['detalhes']}}">
                     
                      <span class="glyphicon glyphicon-remove-circle" style="overflow: hidden; color:red"
                        title="Indeferir pedido." onclick="event.preventDefault()"
                        data-toggle="tooltip; modal" data-placement="top"
                        data-id="{{$requisicao_documento['id']}}"
                        data-nome="{{$requisicao_documento['nome']}}"
                        data-title="{{$requisicao_documento['curso']}}">
                      </span>
                  </a>
                </td>
              @endif             
              {{-- DOCUMENTOS SOLICITADOS E STATUS - FIM --}}
              
              </tr>
              @endforeach

              <!-- </div> -->
          </tbody>
          
            
          </form>
        </table>
        <table style="width:100%">
          <tr>
            @if(isset($listaRequisicao_documentos))
              @if(sizeof($listaRequisicao_documentos) > 0 && $titulo != "Concluídos" && $titulo != "Indeferidos")
                <button id="btnFinalizar" onclick="event.preventDefault();confirmarRequisicao()"
                class="btn btn-primary-lmts" style="margin-bottom: 40px; float:left; margin-top: 20px; margin-left:20px">Concluir Requisição</button>
              @endif
            @endif
          </tr>
        </table>
        

        
  </div>
    @foreach($listaRequisicao_documentos as $requisicao_documento)
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
        <form method="post" id="formModal" action="{{ route("indefere-requisicoes-post")}}">
          <input type="hidden" name="idDocumento" value="" id="id_documento">
          @csrf
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="col">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                    <h5 class="modal-title" id="myModalLabel">Justificativa: {{$requisicao_documento['id']}}</h5>
                    
                    {{-- <h5 class="modal-title myModalLabelPerfil" id="myModalLabelPerfil"></h5>
                    <h5 class="modal-title myModalLabelAnotacao" id="myModalLabelAnotacao"></h5>  --}}
                </div>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Mensagem:</label>
                    <textarea class="form-control" id="anotacoes" name="anotacoes" required></textarea>
                  </div>
              </div>
              <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right:10px">
                  {{ ('Fechar') }}
                </a>
                <a type="button" class="btn btn-primary btn-primary-lmts" onclick="event.preventDefault(); indeferirRequisicao()"
                href="{{ route("indefere-requisicoes-post")}}" style="margin-right:10px">
                {{ ('Enviar') }}
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
        <!-- Modal -->

<script>
function mudarId(id){
  document.getElementById('id_documento').value = id;
}
function selectClicado(){
  var selectedValue = document.getElementById("cursos").value;
  document.getElementById('cursoIdDeclaracao').value = selectedValue;
  document.getElementById('listar-requisicoes-form').submit();

}
$(function(){
  var nomeCurso = {!! json_encode($cursoSelecionado->toArray()) !!};
  var nomeDocumento = {!! json_encode($documentoSelecionado->toArray()) !!}; 
  document.getElementById('cursos').value = nomeCurso['id'];
  document.getElementById('documentos').value = nomeDocumento['id'];
  console.log(nomeDocumento['id']);        
});


</script>

<script>
$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var recipient = button.data('whatever')
    var id = button.data('id')
    var curso = button.data('curso')
    var anotacoes = button.data('anotacoes')
    // var recipient = .data('whatever')
    // Extrai informação dos atributos data-*
    // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
    // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
    var modal = $(this)
    modal.find('.modal-title').text('Nome do Aluno: ' + recipient)
    //Exibir o curso e anotações no modal
    // modal.find('.myModalLabelPerfil ').text('Curso: ' + curso)
    // modal.find('.myModalLabelAnotacao').text("Anotação: " + anotacoes)
    
    modal.find('.modal-body input').val(recipient)
  })
  
 function exibirAnotacoes(id){ 
    var s = '#'+id;
    $(s).modal('show');
    console.log(s) 

  }

</script>
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

//console.log(checkBoxs);

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
function indeferirRequisicao(){
     if(confirm("Confirma o indeferimento desta requisição?")== true){
       console.log("indeferir requisição")
       document.getElementById("formModal").submit();
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
      console.log(rows[i].getElementsByTagName("TD")[5],rows[i + 1].getElementsByTagName("TD")[5] )
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

function exibirAnotacoes(id){ 
    var s = '#'+id;
    $(s).modal('show');
    console.log(s) 
    
}



//atualizar pagina
// var time = 1; // 60s

// atualizarPagina(){
//   window.location.reload();
// };


function retornarCurso(id){
  if(id == 1){
        return 'Agronomia';
      }else if(id == 2){
        return 'Bacharelado em Ciência da Computação';
      }
      else if(id == 3){
        return 'Engenharia de Alimentos';
      }else if(id == 4){
        return 'Licenciatura em Letras';
      }else if(id == 5){
        return 'Licenciatura em Pedagogia';
      }else if(id == 6){
        return 'Medicina Veterinária';
      }else if(id == 7){
        return 'Zootecnia';
      }
}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection
