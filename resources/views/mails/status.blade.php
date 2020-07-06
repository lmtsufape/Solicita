@extends('layouts.app1')
@section('conteudo')
@if($documento->status=="Indeferido")
<div class="container" style="background-color:white">
    
  {{-- Indeferimento --}}
  <div class="row justify-content-center" style="margin-top:100px">
    <div class="col-sm-12" align="center">
        <a target="_blank" href="http://ww3.uag.ufrpe.br/">
            <img src="{{$message->embed(public_path() . '/images/logoUfapeAzul.png')}}" height="80px" >
        </a>
    </div>
  </div>
  
    <p><font face="Times New Roman" font size="4" color="black">Olá, {{$usuario->name}}! </font></p>
    
    <p><font face="Times New Roman" font size="4" color="black">A emissão do documento "{{$nome_documento}}" foi indeferida pelo seguinte motivo: <strong>{{$documento->anotacoes}}</strong> </font></p>

    <p><font face="Times New Roman" font size="4" color="black">Caso necessite de outras informações, entrar em contato com a escolaridade através do e-mail: escolaridade@ufape.edu.br.</font></p>
    <p></p>
    <p align="center" ><font face="Times New Roman" font size="4" color="black">Atenciosamente, </font></p>
    
    <p align="center" style=""><font face="Times New Roman" font size="4" color="black"> <strong> Universidade Federal do Agreste de Pernambuco<br>
     Setor Escolaridade</strong></font></p>
  {{-- <div class="row justify-content-center">
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
          <p><h4>Para outros esclarecimentos, entrar em contato com a escolaridade através do email: setor.escolar.uag@ufrpe.br</h4></p>
      </div>
  </div>

  <div class="row justify-content-center" style="margin-top:20px">
      <div class="col-sm-12">
          <p><h3>Atenciosamente, <strong>Setor de Escolaridade</strong>.</h3></p>
      </div>
  </div> --}}

  
@endif
@if($documento->status=="Concluído - Disponível para retirada")
<div class="container" style="background-color:white" >
    <div class="row justify-content-center" style="margin-top:100px">
      <div class="col-sm-12" align="center">
          <a target="_blank" href="http://ww3.uag.ufrpe.br/">
              <img src="{{$message->embed(public_path() . '/images/logoUfapeAzul.png')}}" height="80px" >
          </a>
      </div>
    </div>
      {{-- DEFERIMENTO --}}
      <p><font face="Times New Roman" font size="4" color="black">Olá, {{$usuario->name}}! </font></p>
      
      <p><font face="Times New Roman" font size="4" color="black">O documento solicitado "{{$nome_documento}}" <strong>ESTÁ DISPONÍVEL PARA RETIRADA! </strong> </font></p>

      <p><font face="Times New Roman" font size="4" color="black">Caso necessite de outras informações, entrar em contato com a escolaridade através do e-mail: escolaridade@ufape.edu.br.</font></p>
      <p></p>
      <p align="center" ><font face="Times New Roman" font size="4" color="black">Atenciosamente, </font></p>
      
      <p align="center" style=""><font face="Times New Roman" font size="4" color="black"> <strong> Universidade Federal do Agreste de Pernambuco<br>
       Setor Escolaridade</strong></font></p>

  
</div>

@endif
<div class="row justify-content-center" style="background-color:white" align="center">
  <div class="col-sm-12">
      <div id="barra-logos" class="container">
          <ul id="logos" style="list-style:none;">
              <li style="margin-right:140px; margin-left:110px; border-right:1px ;height: 120px">
                  {{-- <a href="#">
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
                  </a> --}}
              </li>
          </ul>
        </div>
  </div>
</div>

</div>

@endsection
