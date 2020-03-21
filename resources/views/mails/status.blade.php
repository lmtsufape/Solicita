@extends('layouts.app1')
@section('conteudo')
    <div class="container">
        <div class="info-texto" >
            <div class="texto" style="margin-left:30px">
                <div class="row">
                  <div class="col-sm-12">
                    <label>Assunto:</label>
                    <h4>Indeferimento de solicitação de documentos.</h4>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <h4>Olá, {{$usuario->name}}!</h4>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <h4>O status de solicitação do documento <strong>"{{$nome_documento}}"</strong> foi atualizado para:</h4>
                  </div>
                </div>
                @if($documento->status=="Indeferido")
                <div class="row">
                  <div class="col-sm-12">
                    <p>
                      <h1 style="color:red">{{$documento->status}}</h1>
                      <label>Motivo: </label>
                      <h4>{{$documento->anotacoes}}</h4>                      
                    </p>
                    <h1>Atenção!!!</h1>
                    <h1>Será necessária uma nova solicitação com a correção das informações supracitadas.</h1>
                    <p>Para maiores informações, favor entrar em contato com o Setor da Escolaridade.</p>
                    
                  </div>
                </div>
                @endif
                    
                @if($documento->status=="Concluído - Disponível para retirada")
                <h1 style="color:blue">{{$documento->status}}</h1>
                <p>
                  <h1 style="color:red">Atenção!!!</h1>
                  <h1 style="color:red">A entrega dos documento(s) solicitado(s) está condicionada à apresentação de <strong>Documento Oficial com foto</strong>!</h1>
                </p>
                @endif

            </div>
        </div>
    </div>
@endsection
