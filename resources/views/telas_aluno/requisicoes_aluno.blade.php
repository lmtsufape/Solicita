@extends('layouts.app')

@section('conteudo')

    <div class="tabela-centro mx-auto">
        <table class="table">
          <div class="lmts-primary">


          <div class="nome-documento lmts-primary mx-auto " style="height:100px">
              <h2 class="" style="padding-top:50px"> {{Auth::user()->name}} </h2>
          </div>
          </div>
            <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;">
            <tr >
                <th scope="col">#</th>
                <th scope="col">CPF</th>
                <th scope="col">NOME</th>
                <th scope="col">CURSO</th>
                <th scope="col">DATA DE REQUISIÇÃO</th>
                <th scope="col">PRAZO</th>
                <th scope="col">STATUS</th>
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
                  <td>{{$r->data_pedido}}</td>
                  <td>dd/mm/aaaa</td>
                  <td>
                    <ol>
                    @foreach($requisicoes_documentos as $rd)
                      @if($rd->requisicao_id == $r->id)
                          <!-- Documentos Solicitados -->
                          <li>
                            {{$rd->status}}
                          </li>
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
        <p>
          <h3 align="center" style="color:red">Atenção</h3>
          <h5 align="center" style="color:red">A entrega dos documentos solicitados está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h5>
        </p>
    </div>
@endsection
