@extends('layouts.app')
@section('conteudo')
    <div class="container">
        <div class="info-texto" >
            <div class="texto" style="margin-left:30px">
                <h1>Olá {{$usuario->name}} !!</h1></br>
                <h1>O status de solicitação do documento <b>"{{$nome_documento}}"</b> foi atualizado para:</h1>
                <h1>{{$documento->status}}</h1></br>
                <h1>Para maiores informações, favor contatar o Setor da Escolaridade</h1>
                    @if($documento->status=="indeferido")
                      <h1>Motivo: </h1>
                      <h1>{{$documento->anotacoes}}</h1>

                      <h1>Será necessária uma nova solicitação com a correção das informações supracitadas</h1>
                    @endif
            </div>
            <p>
              <h3 align="center" style="color:red">Atenção</h3>
              <h1 align="center" style="color:red">A entrega dos documento(s) solicitado(s) está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h1>
            </p>
        </div>
    </div>
@endsection
