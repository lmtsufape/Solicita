@extends('layouts.app1')
@section('conteudo')
@if($documento->status=="Indeferido")
<div class="container" style="background-color:white">
    
  {{-- Indeferimento --}}
  <div class="row justify-content-center">
      <div class="col-sm-12" align="center">
          <h1><strong>INDEFERIMENTO DE DOCUMENTO SOLICITADO!</strong> </h1>
      </div>
  </div>

  <div class="row justify-content-center" style="margin-top:50px">
      <div class="col-sm-12">
          <p><h3>Olá, <strong>{{$usuario->name}}!</strong></h3></p>
          <p><h4>O documento solicitado <strong>"{{$nome_documento}}"</strong> foi <span style="color:red">INDEFERIDO.</span></h4></p>
          <p><h4>Motivo: <strong>{{$documento->anotacoes}}</strong></h4></p>
      </div>
  </div>

  <div class="row justify-content-center" style="margin-top:20px">
      <div class="col-sm-12">
          <p><h4>Para maiores esclarecimentos, favor entrar em contato com o setor de <strong>Escolaridade</strong>.</h4></p>
      </div>
  </div>

  <div class="row justify-content-center" style="margin-top:20px">
      <div class="col-sm-12">
          <p><h3>Atenciosamente, <strong>Setor de Escolaridade</strong>.</h3></p>
      </div>
  </div>

  
@endif
@if($documento->status=="Concluído - Disponível para retirada")
<div class="container" style="background-color:white" >
    
  {{-- DEFERIMENTO --}}
  <div class="row justify-content-center" style="margin-top:100px">
      <div class="col-sm-12" align="center">
          <h1><strong>DOCUMENTO DISPONÍVEL PARA RETIRADA!</strong> </h1>
      </div>
  </div>

  <div class="row justify-content-center" style="margin-top:50px">
      <div class="col-sm-12">
          <p><h3>Olá, <strong>{{$usuario->name}}!</strong></h3></p>
          <p><h4>O documento solicitado <strong>"{{$nome_documento}}"</strong> está <span style="color:green"><strong>DISPONÍVEL PARA RETIRADA</strong></span></h4></p>
      </div>
  </div>

  <div class="row justify-content-center" style="margin-top:20px" align="center">
      <div class="col-sm-12">
          <p><h3>ATENÇÃO!</h3></p>
          <p><h4>A ENTREGA DO DOCUMENTO SOLICITADO ESTÁ CONDICIONADA À APRESENTAÇÃO DE DOCUMENTO OFICIAL COM FOTO!</h4></p>
      </div>
  </div>

  <div class="row justify-content-center" style="margin-top:20px">
      <div class="col-sm-12">
          <p><h3>Atenciosamente, <strong>Setor de Escolaridade</strong>.</h3></p>
      </div>
  </div>
</div>

@endif
<div class="row justify-content-center" style="background-color:white" align="center">
  <div class="col-sm-12">
      <div id="barra-logos" lass-"container">
          <ul id="logos" style="list-style:none;">
              <li style="margin-right:140px; margin-left:110px; border-right:1px ;height: 120px">
                  <a href="#">
                      <img src="{{$message->embed(public_path() . '/images/logo.png')}}"  style = "margin-left: 8px; margin-top:5px " height="70px" >
                  </a>
                  <img src="{{$message->embed(public_path() . '/images/separador.png')}}"  height="70px">
                  <a target="_blank" href="http://lmts.uag.ufrpe.br/">
                      <img src="{{$message->embed(public_path() . '/images/lmts.jpg')}}" height="70px">
                  </a>
                  <img src="{{$message->embed(public_path() . '/images/separador.png')}}"  height="70px">
                  <a target="_blank" href="http://www.ufrpe.br/">
                      <img src="{{$message->embed(public_path() . '/images/ufrpe.png')}}"  height="70px"  >
                  </a>
    
                  <img src="{{$message->embed(public_path() . '/images/separador.png')}}"  height="70px" >
                  <a target="_blank" href="http://ww3.uag.ufrpe.br/">
                      <img src="{{$message->embed(public_path() . '/images/logoUfapeAzul.png')}}" height="70px" >
                  </a>
              </li>
          </ul>
        </div>
  </div>
</div>

</div>

@endsection
