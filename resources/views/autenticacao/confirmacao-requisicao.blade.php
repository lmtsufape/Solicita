@extends('layouts.app')

@section('conteudo')
<div class="container">

  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="card card-cadastro">
        <div class="card-body">
          {{-- titulo --}}
            <div class="row justify-content-center">
                <h2>Protocolo</h2>
            </div>
            <form method="POST" action="{{ route('finaliza-requisicao') }}">
              @csrf
              {{-- nome aluno --}}
              <div class="form-group row">
                <div class="col-sm-12">
                  <label><strong>Nome</strong></label>
                  <h4>{{$requisicao->perfil->aluno->user->name}}</h4>
                </div>
              </div>
              {{-- curso --}}
              <div class="row form-group">
                <div class="col-sm-12">
                  <label><strong>Curso</strong></label>
                  <h4>{{$requisicao->perfil->curso->nome}}</h4>
                </div>
              </div>
              {{-- vinculo --}}
              <div class="row form-group">
                <div class="col-sm-12">
                  <label><strong>Vinculo</strong></label>
                  <h4>{{$requisicao->perfil->situacao}}</h4>
                </div>
              </div>

              {{-- documentos solicitados --}}
              <div class="row form-group">
                <div class="col-sm-12">
                  <h4>Confirmamos o recebimento de sua solicitação para o(s) documento(s) abaixo:</h4>
                  <h5>
                    <ul>
                      @foreach ($arrayAux as $docSolicitado)
                      <li value="Documentos solicitados">{{$docSolicitado->tipo}}</li>
                        @if($docSolicitado->documento_id==4)
                          <h5>Descrição do documento solicitado {{$docSolicitado->detalhes}}</h5>
                        @endif
                        @if($docSolicitado->documento_id==5)
                          <h5>Descrição do documento solicitado {{$docSolicitado->detalhes}}</h5>
                        @endif
                      @endforeach
                    </ul>
                  </h5>
                </div>
              </div>
              {{-- data requisição --}}
              <div class="row form-group">
                <div class="col-sm-12">
                  <label><strong>Data da requisição</strong></label>
                  <h4>{{$date}}</h4>
                </div>
              </div>

              {{-- hora requisição --}}
              <div class="row form-group">
                <div class="col-sm-12">
                  <label><strong>Hora da requisição</strong></label>
                  <h4>{{$hour}}</h4>
                </div>
              </div>

              {{-- Atenção --}}
              <div class="row justify-content-sm-center form-group">
                <div class="col-sm-12">
                  <div class="alert alert-danger">
                    <strong><h4 align="center" style="">Atenção</h4></strong>
                    <strong><h4 align="center" style="">Prazo de Entrega do documento: <b>Até 02(dois) dias úteis</h4></strong>
                    <strong><h4 align="center" style="">A entrega dos documento(s) solicitado(s) está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h4></strong>
                  </div>
                  <p>
                    
                  </p>
                </div>
              </div>

              <div class="row justify-content-center" align="center">
                <div class="col-sm-12">
                  <button type="submit"class="btn btn-lg btn-primary btn-primary-lmts" align="center">
                  {{ __('Voltar para a tela inicial') }}
                </button>
              </div>
              </div>
            </form>

        </div>
      </div>
    </div>
  </div>
        
  </div>
</div>
@endsection
