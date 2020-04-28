@extends('layouts.app')
@section('conteudo')

<div class="tela-servidor ">
  <div>@include('componentes.mensagens')</div>
  <div class="centro-cartao">
      <label for="cursos" style="margin-left:275px; ">Selecionar Curso</label>
      <div class="justify-content-right" style="margin-left: 275px">
        <select name="cursos" id="cursos" onchange="getSelectValue();"
        class="browser-default custom-select custom-select-lg mb-1" style="width: 400px">
          @foreach($cursos as $curso)
              <option id="optionComOValor" value="{{$curso->id}}" onclick="quantidades({{$curso->id}})">{{$curso->nome}}</option>
          @endforeach
        </select>
      </div>
      <script>
          function getSelectValue(){
              var selectedValue = document.getElementById("cursos").value;
              document.getElementById('cursoIdDeclaracao1').value = selectedValue;
              document.getElementById('cursoIdDeclaracao2').value = selectedValue;
              document.getElementById('cursoIdDeclaracao3').value = selectedValue;
              document.getElementById('cursoIdDeclaracao4').value = selectedValue;
              document.getElementById('cursoIdDeclaracao5').value = selectedValue;
              document.getElementById('cursoIdDeclaracao6').value = selectedValue;
              document.getElementById('cursoIdDeclaracao7').value = selectedValue;

          }
      </script>
      
      <div class="card-deck d-flex justify-content-center">
        <div class="conteudo-central d-flex  justify-content-center align-content-start flex-wrap">
          <!-- Para a retirada do card "TODOS", foi reduzido o offset do laço para 5, em vez de 6 -->
          @for($i = 1;$i <= 5; $i++)
              <a id="click" href="{{ route('listar-requisicoes') }}" onclick="event.preventDefault(); document.getElementById('listar-requisicoes{{$i}}-form').submit();" style="text-decoration:none; color: inherit;">
                 <div class="card cartao text-center " style="border-radius: 20px">
                   <div class="card-body d-flex justify-content-center">
                     <h3 style="padding-top:20px">{{$tipoDocumento[$i-1]}}</h3>
                   </div>
                   <h5 id="quantidades{{$i}}"></h5>
                 </div>
              </a>
              <form id="listar-requisicoes{{$i}}-form" action="{{ route('listar-requisicoes') }}" method="GET" style="display: none;">
                <input id="cursoIdDeclaracao{{$i}}" type="hidden" name="curso_id" value="1">
                <input  type="hidden" name="titulo_id" value="{{$i}}">
              </form>
          @endfor
        </div>
      </div>
  </div>
</div>

<script>
    function quantidades(curso){ //id do curso
      var selectedValue = document.getElementById("cursos").value;
      var selecionado = selectedValue;
      var array = @json($requisicoes);
      
      var aux, i;
      tamanho = array.length;
      // document.reload();
      var vinculo = 0, matricula = 0, historico = 0 , programa = 0, outros = 0,indeferidos = 0 ,concluidos = 0;
      
      for(i = 0; i < tamanho; i++){
        //console.log(array[i].perfils[0].id)
        
        if(array[i].status == "Em andamento" && array[i].documento_id == 1 &&  array[i].curso == selecionado){
          vinculo++;
        }
        if(array[i].status == "Em andamento" && array[i].documento_id == 2 && array[i].curso == selecionado){
          matricula++;
        }
        if(array[i].status == "Em andamento" && array[i].documento_id == 3 && array[i].curso == selecionado){
          historico++;
        }
        if(array[i].status == "Em andamento" && array[i].documento_id == 4 && array[i].curso == selecionado){
          programa++;
        }        
        if(array[i].status == "Em andamento" && array[i].documento_id == 5 && array[i].curso == selecionado){
          outros++;
        }
        if(array[i].status == "Concluído - Disponível para retirada" &&  array[i].curso == selecionado){         
          concluidos++;        
        }
        if(array[i].status == "Indeferido" &&  array[i].curso == selecionado){          
          indeferidos++;        
        }

      }
      document.getElementById('quantidades1').innerHTML = 'Nº de Requisições: ' + vinculo;
      document.getElementById('quantidades2').innerHTML = 'Nº de Requisições: ' + matricula;
      document.getElementById('quantidades3').innerHTML = 'Nº de Requisições: ' + historico;
      document.getElementById('quantidades4').innerHTML = 'Nº de Requisições: ' + programa;
      document.getElementById('quantidades5').innerHTML = 'Nº de Requisições: ' + outros;
      //document.getElementById('quantidades6').innerHTML = 'Nº de Requisições: ' + concluidos;
      //document.getElementById('quantidades7').innerHTML = 'Nº de Requisições: ' + indeferidos;
    }

    quantidades(document.getElementById('optionComOValor').value);

    $('#cursos').on('change', function() {
      quantidades(document.getElementById('optionComOValor').value);
    })
    
    
    $(function(){
      getSelectValue();
      quantidades(document.getElementById('optionComOValor').value);
    })

    //atualizar pagina
    // var time = 60000; // 60s

    // setTimeout(function(){ 
    //    window.location.reload();
    // }, time);

    
</script>
@endsection


{{--  --}}

{{-- <div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-xl-12">
      <div class="card-deck">
        <div class="">
            
            @for($i = 1;$i <= 6; $i++)
                <a id="click" href="{{ route('listar-requisicoes') }}" onclick="event.preventDefault(); document.getElementById('listar-requisicoes{{$i}}-form').submit();" style="text-decoration:none; color: inherit;">
                   <div class="card cartao text-center " style="border-radius: 20px">
                     <div class="card-body d-flex justify-content-center">
                       <h3 style="padding-top:20px">{{$tipoDocumento[$i-1]}}</h3>
                     </div>
                     <h5 id="quantidades{{$i}}"></h5>
                   </div>
                </a>
                <form id="listar-requisicoes{{$i}}-form" action="{{ route('listar-requisicoes') }}" method="GET" style="display: none;">
                  <input id="cursoIdDeclaracao{{$i}}" type="hidden" name="curso_id" value="1">
                  <input  type="hidden" name="titulo_id" value="{{$i}}">
                </form>
            @endfor
          </div>
      </div>
    </div>        
  </div>        
</div> --}}