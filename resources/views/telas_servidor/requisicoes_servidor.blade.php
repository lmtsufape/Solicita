@extends('layouts.app')

@section('conteudo')

    <div class="tabela-centro mx-auto">
        <table class="table" >
            <div class="lmts-primary">

            <div class="nome-documento lmts-primary mx-auto " style="height:100px">
                <h2 class="" style="padding-top:50px"> {{$titulo}} </h2>
            </div>
            </div>




            <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;" >
            <tr >
                <!-- Checkbox para selecionar todos os documentos -->
                <th scope="row">

                  <!-- botão de finalizar -->
                  <form action="{{  route('listar-requisicoes-post')  }}" method="POST">

                    <button type="button" id="btnFinalizar" class="btn btn-secondary btn-sm" style="margin-bottom: 10px" onclick="getLinhas()">Finalizar</button>
                  </form>


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
                          <input class="checkboxLinha" type="checkbox" id="checkboxLinha" name="checkboxLinha" value="{{$requisicao_documento->id}}" onclick="">
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



            </tbody>
        </table>

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


function getLinhas(){
  var ids = document.getElementsByClassName("checkboxLinha");// pega o id de todos os checkboxs marcados
  getIds(ids);

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

  enviarArray(newArray);
if (newArray != null) {

  //console.log(newArray);
}

}





function enviarArray(newArray){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    console.log(JSON.stringify(newArray));

    $.ajax({
      url:'/listar-requisicoes-post',
      type: 'POST',
      dataType:'json',
      contentType: 'json',
      newArray: JSON.stringify(newArray),
      contentType: 'application/json; charset=utf-8',
    });

    // $.ajax({
    //     url:'{{ route('listar-requisicoes-post') }}', // Is this what you meant, is this the route you set up?
    //     type: 'POST',
    //     data: {'data': newArray, '_token' : '<?=csrf_token()?>'},
    //     success : function(newArray){
    //       // Do what you want with your data on success
    //     },
    //     error : function(e){
    //        console.log(e);
    //     }
    // });



    console.log(newArray);
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection
