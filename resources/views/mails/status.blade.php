@extends('layouts.app1')
@section('conteudo')
    <div class="container">
        <div class="info-texto" >
            <div class="texto" style="margin-left:30px">
                <h1>Olá {{$usuario->name}} !!</h1></br>
                <h1>O status de solicitação do documento <b>"{{$nome_documento}}"</b> foi atualizado para:</h1>
                    @if($documento->status=="Indeferido")
                      <h1 style="color:red">{{$documento->status}}</h1></br>
                      <h1>Motivo: </h1>
                      <h1>{{$documento->anotacoes}}</h1><br>
                      <h1>Será necessária uma nova solicitação com a correção das informações supracitadas</h1>
                      <h1>Para maiores informações, favor contatar o Setor da Escolaridade</h1>
                    @endif
                    @if($documento->status=="Concluído - Disponível para retirada")
                    <h1 style="color:blue">{{$documento->status}}</h1>
                    <p>
                      <h1 style="color:red">Atenção</h1>
                      <h1 style="color:red">A entrega dos documento(s) solicitado(s) está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h1>
                    </p>
                    @endif
            </div>
        </div>
    </div>
@endsection
