@extends('layouts.app')

@section('conteudo')
<div>@include('componentes.mensagens')</div>
<div class="container-fluid" style="min-height:100vh">

  {{-- <div class="row jusify-content-center d-flex justify-content-center">
    <div class="col-sm-10">
      <div class="alert alert-danger" role="alert">
        <h3 align="center">Atenção</h3>
      <h4 align="center">A entrega dos documentos solicitados está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h4>
      </div>
    </div>
  </div>
 --}}
  <div class="row justify-content-sm-center">
    <div class="col-sm-10">
      <h2 class="tituloTabela">{{Auth::user()->name}}</h2>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <table class="table table-responsive-lg table-borderless" id="table">
          <thead class="lmts-primary " style="border-color:#1B2E4F;">  
                <tr>
                    <th scope="col" align="center">#</th>
                    <th scope="col" align="center" class="titleColumn" onclick="sortTable(0)" style="cursor:pointer">CURSO<img src="{{asset('images/sort.png')}}" style="height:15px"></th>
                    <th scope="col" align="center" class="titleColumn" onclick="sortTable(1)" style="cursor:pointer">DATA E HORA DA REQUISIÇÃO<img src="{{asset('images/sort.png')}}" style="height:15px"></th>
                    <th scope="col" align="center" style="cursor:pointer">DOCUMENTOS SOLICITADOS</th>
                    <th scope="col" align="center" style="cursor:pointer">STATUS</th>
                    
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
                                      @if($d->tipo == "Programa de Disciplina")
                                        {{$d->tipo}}
                                        <a data-toggle="tooltip" data-placement="left" title="Informações:{{$rd['detalhes']}} ">
                                          {{-- Status do indeferimento com imagem do olho --}}
                                          <span onclick="exibirAnotacoes('dlgPrograma')" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
                                          @component('componentes.popup', ["titulo"=>"Informações", "conteudo"=>$rd->detalhes,"id"=>"dlgPrograma"])
                                          @endcomponent                             
                                        </a>
    
                                      @elseif($d->tipo == "Outros") 
                                        {{$d->tipo}}
                                        <a data-toggle="tooltip" data-placement="left" title="Informações:{{$rd['detalhes']}} ">
                                          {{-- Status do indeferimento com imagem do olho --}}
                                          <span onclick="exibirAnotacoes('dlgOutros')" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
                                          @component('componentes.popup', ["titulo"=>"Informações", "conteudo"=>$rd->detalhes, "id"=>"dlgOutros"])
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
                
                <td align="center">
                  @php
                    $tudoAndamento = true
                  @endphp
                  
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
                        @php
                          $tudoAndamento = false
                        @endphp
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
                          @php
                            $tudoAndamento = false
                          @endphp
                            <li style="color:red">
                              {{$rd->status}}
                              <a data-toggle="tooltip" data-placement="left" title="Seu pedido foi Indeferido pelo(s) seguinte(s) motivo: {{$rd->anotacoes}}">
                                  <span onclick="exibirAnotacoes({{$rd->id}})" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
                                  @component('componentes.popup', ["titulo"=>"Seu pedido foi Indeferido pelo(s) seguinte(s) motivo:" ,"conteudo" => $rd->anotacoes, "id"=>$rd->id ])
                                  @endcomponent                             
                              </a>                          
                            </li>
                        @endif
                      @endif
                  @endforeach
                  </ol>
                </td>
                
            </tr>
          @endforeach
          </tbody>
      </table>
    </div>
  </div>

  <div class="row justify-content-center" align="center">
    <div class="col-sm-12">
      <form method="GET" action="{{ url()->previous() }}">
  
        <button type="submit"class="btn btn-primary btn-primary-lmts" align="center" style="margin-bottom:20px">
        {{ __('Voltar para o Inicio') }}
        </button>
      </form>    

    </div>
  </div>

</div>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script>
      function confirmarExclusao(){
        confirma = confirm('Você tem certeza que deseja excluir esta requisição?');
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

      function exibirAnotacoes(id){ 
        var s = '#'+id;
        $(s).modal('show');
        console.log(s) 
    
      }

      

    </script>


@endsection
