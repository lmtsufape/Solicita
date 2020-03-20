@extends('layouts.app')

@section('conteudo')
<div>@include('componentes.mensagens')</div>
<div class="container-fluid" style="min-height:100vh">

  <div class="tabela-centro mx-auto table-striped">
    <p>
      <h3 align="center" style="color:red">Atenção</h3>
      <h5 align="center" style="color:red">A entrega dos documentos solicitados está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h5>
    </p>
      <table class="table">
        <div class="lmts-primary">
        <div class="nome-documento lmts-primary mx-auto " style="height:100px">
            <h2 class="" style="padding-top:50px"> {{Auth::user()->name}} </h2>
        </div>
        </div>
          <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;">
          <tr>
              <th scope="col">#</th>
              <th scope="col">CPF</th>
              <th scope="col">NOME</th>
              <th scope="col">CURSO</th>
              <th scope="col">DATA DE REQUISIÇÃO</th>
              <th scope="col">PRAZO</th>
              <th scope="col">STATUS</th>
              <th scope="col">ANOTAÇÕES</th>
              <th scope="col">DOCUMENTOS SOLICITADOS</th>
          </tr>
          </thead>
          <tbody>
          @foreach($requisicoes as $r)
              <tr>
                <th scope="row">{{$r->id}}</th>
                <td>{{$aluno->cpf}}</td>
                <td>{{Auth::user()->name}}</td>
                <td>
                  @foreach($perfis as $p)
                    @if($p->id == $r->perfil_id)
                      {{$p->default}}
                    @endif
                  @endforeach
                </td>
                <td>{{date_format(date_create($r->data_pedido), 'd/m/Y')}}</td>
                <td>02 dias úteis</td>
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
                        @if($rd->status=="Indeferido")
                        <li style="color:red">
                          {{$rd->status}}
                          <span class="glyphicon glyphicon-exclamation-sign" style="overflow: hidden; color:red"
                          data-toggle="tooltip" data-placement="top"
                          title="Requisição indeferida">
                          </span>
                        </li>
                        @endif
                      @endif
                  @endforeach
                  </ol>
                </td>

                <td>
                  <ol>
                  @foreach($requisicoes_documentos as $rd)
                    @if($rd->requisicao_id == $r->id)
                    @if($rd->status=="Indeferido")
                    Seu pedido foi Indeferido pelo(s) seguinte(s) motivo:
                    @endif
                          {{$rd->anotacoes}}
                    @endif
                  @endforeach
                  </ol>
                </td>
                <td>
                  <ol>
              @foreach($requisicoes_documentos as $rd)
                  @if($rd->requisicao_id == $r->id)
                      <!-- Documentos Solicitados -->
                        @foreach($documentos as $d)
                            @if($d->id == $rd->documento_id)
                              <li>
                                {{$d->tipo}}
                              </li>
                            @endif
                        @endforeach
                  @endif
              @endforeach
            </ol>
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
</div>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection
