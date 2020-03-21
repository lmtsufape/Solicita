@extends('layouts.app1')
@section('conteudo')
    <div class="container">
        <div class="info-texto" >
            <div class="texto" style="margin-left:30px">
              @if($documento->status=="Indeferido")
                  <div class="row">
                    <div class="col-sm-12">
                      <label>Assunto:</label>
                      <h4>Solicita: Indeferimento de solicitação de documentos.</h4>
                    </div>
                  </div>
                  
                  <br>
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <h4>Olá, {{$usuario->name}}!</h4>
                    </div>
                  </div>
                  
                  <br>
  
                  <div class="row">
                    <div class="col-sm-12">
                      <p>O status de solicitação do documento <strong>"{{$nome_documento}}"</strong></p>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-sm-12">
                    <p> foi atualizado para: <span style="color:red; font-size:large">{{$documento->status}}</span></p>
                    <p>
                      <label>Motivo: </label>
                      <h4>{{$documento->anotacoes}}.</h4>                      
                    </p>
                    {{-- <h1>Atenção!!!</h1>
                    <h1>Será necessária uma nova solicitação com a correção das informações supracitadas.</h1> --}}
                    <br>
                    <p>Para maiores informações, favor entrar em contato com o Setor da Escolaridade.</p>
                    <br>
                    <p>Atenciosamente, <br>Escolaridade.</p>

                    <p>Setor de Escolaridade<br>Universidade Federal do Agreste de Pernambuco. <br>Laboratório Multidisciplinar de Tecnologias Sociais</p>
                    
                    
                  </div>
                </div>
                @endif
                    
                @if($documento->status=="Concluído - Disponível para retirada")
                <div class="row">
                  <div class="col-sm-12">
                    <label>Assunto:</label>
                    <h4>Solicita: Documento disponível para retirada</h4>
                  </div>
                </div>
                
                <br>
                
                <div class="row">
                  <div class="col-sm-12">
                    <h4>Olá, {{$usuario->name}}!</h4>
                  </div>
                </div>
                
                <br>

                <div class="row">
                  <div class="col-sm-12">
                    <p>O status de solicitação do documento <strong>"{{$nome_documento}}"</strong></p>
                  </div>
                </div>
                <p> foi atualizado para: <span style="color:blue;font-size:large">{{$documento->status}}</span></p>
                <p>
                  <h3 style="color:red">Atenção!!!</h3>
                  <h3 style="color:red">A entrega dos documento(s) solicitado(s) está condicionada à apresentação de Documento Oficial com foto!</h3>
                  <p>Atenciosamente, <br>Escolaridade.</p>
                  <p>Setor de Escolaridade<br>Universidade Federal do Agreste de Pernambuco. <br>Laboratório Multidisciplinar de Tecnologias Sociais</p>
                </p>
                @endif

            </div>
        </div>
    </div>
@endsection
