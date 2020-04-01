@extends('layouts.app')

@section('conteudo')
<div>@include('componentes.mensagens')</div>
<div class="container-fluid" style="min-height:100vh">

  <div class="tabela-centro mx-auto table-striped">
    <p>
      <h3 align="center" style="color:red">Atenção</h3>
      <h5 align="center" style="color:red">A entrega dos documentos solicitados está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h5>
    </p>
      <table class="table" id="table">
        <div class="lmts-primary">
        <div class="nome-documento lmts-primary mx-auto " style="height:100px">
            <h2 class="" style="padding-top:50px"> {{Auth::user()->name}} </h2>
        </div>
        </div>
          <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;">
          <tr>
              <th scope="col" align="center">#</th>
              <th scope="col" align="center" class="titleColumn" onclick="sortTable(0)" style="cursor:pointer">CURSO<img src="{{asset('images/sort.png')}}" style="height:15px"></th>
              <th scope="col" align="center" class="titleColumn" onclick="sortTable(1)" style="cursor:pointer">DATA E HORA DA REQUISIÇÃO<img src="{{asset('images/sort.png')}}" style="height:15px"></th>
              <th scope="col" align="center" style="cursor:pointer">DOCUMENTOS SOLICITADOS</th>
              <th scope="col" align="center" style="cursor:pointer">STATUS</th>
              <th scope="col" align="center">AÇÃO</th>
          </tr>
          </thead>
          <tbody>
          @foreach($requisicoes as $r)
              <tr>
                <th scope="row">{{$r->id}}</th>
                <td>
                  @foreach($perfis as $p)
                    @if($p->id == $r->perfil_id)
                      {{$p->default}}
                    @endif
                  @endforeach
                </td>
                <td>{{date_format(date_create($r->data_pedido), 'd/m/Y')}}, {{$r->hora_pedido}}</td>
                
                <td>
                  <ol style="margin-left:-30px">
                    @foreach($requisicoes_documentos as $rd)
                        @if($rd->requisicao_id == $r->id)
                            <!-- Documentos Solicitados -->
                              @foreach($documentos as $d)
                                  @if($d->id == $rd->documento_id)
                                    <li>
                                      @if($d->tipo == "Programa de Disciplina" || $d->tipo == "Outros" )
                                        {{$d->tipo}}
                                        <a data-toggle="tooltip" data-placement="left" title="Informações:{{$rd['detalhes']}} ">
                                          <span onclick="exibirAnotacoes()" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
                                          @component('componentes.popup', ["titulo"=>"Informações:", "conteudo"=>$rd->detalhes])
                                          @endcomponent                             
                                        </a>
                                      @else
                                        {{$d->tipo}}
                                        
                                      @endif
                                    </li>
                                  @endif
                              @endforeach
                        @endif
                    @endforeach
                  </ol>
                </td>
                
                <td align="cente">
                  <ol>
                  @foreach($requisicoes_documentos as $rd)
                    @if($rd->requisicao_id == $r->id)
                        <!-- Documentos Solicitados -->
                        @if($rd->status=="Em andamento")
                        <li style="color:#db6700">
                          {{$rd->status}}
                          <span class="glyphicon glyphicon-time" style="overflow: hidden; color:#db6700"
                          data-toggle="tooltip" data-placement="top"
                          title="Sua solicitação está em processamento.">
                          </span>
                        </li>
                        @endif
                        @if($rd->status=="Concluído - Disponível para retirada")
                        <li style="color:green">
                          {{$rd->status}}
                          <span class="glyphicon glyphicon-ok-sign" style="overflow: hidden; color:green"
                          data-toggle="tooltip" data-placement="top"
                          title="Seu documento está disponível para a retirada.">
                          </span>
                        </li>
                        @endif
                        {{-- Status do indeferimento com imagem do olho --}}
                        @if($rd->status=="Indeferido")
                        <li style="color:red">
                          {{$rd->status}}
                          <a data-toggle="tooltip" data-placement="left" title="Seu pedido foi Indeferido pelo(s) seguinte(s) motivo: {{$rd->anotacoes}}">
                              <span onclick="exibirAnotacoes()" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
                              @component('componentes.popup', ["titulo"=>"Motivo do indeferimento:" ,"conteudo" => $rd->anotacoes ])
                              @endcomponent                             
                          </a>                          
                        </li>

                        @endif
                      @endif
                  @endforeach
                  </ol>
                </td>
                <td align="center">
                  <form id="formExcluirRequisicao" onclick="confirmarExclusao()" action="{{route('excluir-requisicao',$r->id)}}" method="POST">
                    @csrf
                    <button class="btn" type="submit"><img src="{{asset('images/trash-solid.svg')}}" alt="" style="width:20px"></button>
                  </form>
                </td>
            </tr>
          @endforeach
          </tbody>
      </table>
      <form method="GET" action="{{ route('home') }}">

        <div class="col-md-8 offset-md-4">
            <button type="submit"class="btn btn-primary btn-primary-lmts" align="center" style="margin-left:15%;margin-bottom:20px">
            {{ __('Voltar para o Inicio') }}
          </button>
        </div>
      </form>

  </div>

    {{-- <div class="modal" tabindex="-1" role="dialog" id="dlgAnotacoes">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"> <strong>Motivo do indeferimento:</strong> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modalBody">
            {{$rd->anotacoes}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> --}}

    

</div>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script>
      function confirmarExclusao(){
        confirma = confirm('Você tem certeza que deseja excluir esta requisicao?');
        if(confirma){
          document.getElementById("formExcluirRequisicao").submit();
        }else{
          event.preventDefault();
        }
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
            console.log(rows[i].getElementsByTagName("TD")[n], rows[i + 1].getElementsByTagName("TD")[n])
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

      function exibirAnotacoes(anotacoes){        
        $('#dlgAnotacoes').modal('show');
    
      }

      

    </script>


@endsection
