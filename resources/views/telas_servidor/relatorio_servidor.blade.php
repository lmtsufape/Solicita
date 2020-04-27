@extends('layouts.app')

@section('conteudo')
  
  <div class="container">
    

    <form action="{{  route('listar-relatorio-post')  }}" method="POST">
      @csrf
      <div class="form-row " >
        <div class="form-group col-md-6">
          <label for="example-date-input1" class="col-form-label">Inicio</label>
          <input class="form-control  @error('dataInicio') is-invalid @enderror " type="date" name="dataInicio" value="2020-04-23" id="example-date-input1">
          @error('dataInicio')
            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
            <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="example-date-input2" class="col-form-label">Fim</label>
          <input class="form-control  @error('dataFim') is-invalid @enderror" type="date" name="dataFim" value="2020-04-23" id="example-date-input2">
          @error('dataFim')
            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
            <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      
      <button type="submit" class="btn btn-primary ">Pesquisar</button>
    </form> 
    <hr>
  
    <table class="table table-striped" id="table" >
      
      <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;" >
        <tr >        
          
          <th scope="col" class="titleColumn" style="white-space:nowrap;">DECLRAÇÃO DE VÍNCULO</th>
          <th scope="col" class="titleColumn" style="white-space:nowrap;">COMPROVANTE DE MATRÍCULA</th>
          <th scope="col" class="titleColumn" style="white-space:nowrap;">HISTÓRICO</th>
          <th scope="col" class="titleColumn" style="white-space:nowrap;">PROGRAMA DE DISCIPLINA</th>
          <th scope="col" class="titleColumn" style="white-space:nowrap;">OUTROS</th>
          <th scope="col" class="titleColumn" style="white-space:nowrap;">TOTAL</th>
        </tr>
      </thead>
          <tbody>
@if(isset($contadorDeclaracaoVinculo) || isset($contadorComprovanteMatricula) || isset($contadorHistorico)
|| isset($contadorProgramaDisciplina) || isset($contadorOutros))
                      <tr>
                        <td>{{$contadorDeclaracaoVinculo}}</td>  
                        <td>{{$contadorComprovanteMatricula}}</td>
                        <td>{{$contadorHistorico}}</td>
                        <td>{{$contadorProgramaDisciplina}}</td>
                        <td>{{$contadorOutros}}</td>
                        <td>{{$total}}</td>
                      </tr>         
@endif 
 
          </tbody> 
    </table>        
      

  </div>

  {{--   INICIO DA TABELA DE RESULTADO --}}

  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection







{{--   @foreach($listaRequisicao_documentos as $requisicao_documento)
    
                      <tr>
                        @if($requisicao_documento["requisicoes_documentos"]["documento_id"] == 1)
                          <td> $contadorDeclaracaoVinculo++ </td>
                        @endif
                        
                        <td></td>
                        <td>x</td>
                        <td>x</td>
                        <td>x</td>
                        <td>x</td>
                      </tr>        
   
  @endforeach  --}}

  {{-- var_dump({{ $listaRequisicao_documentos[0]["id"] }}); --}}