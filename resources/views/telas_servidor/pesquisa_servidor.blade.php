@extends('layouts.app')

@section('conteudo')
  
  <div class="container">
    

    <form action="{{  route('pesquisar-aluno-post')  }}" method="POST">
      @csrf
      <div class="form-row " >
        <div class="form-group col-md-6">
          <label for="formNome">Nome</label>
          <input type="text" class="form-control" onclick="clique();" name="formNome" value="" id="formNome" >
          <input type="checkbox" id="myCheck1" onclick="check1()">
                 
          
        </div>
        <div class="form-group col-md-6">
          <label for="formCPF">CPF</label>
           <input type="text"  class="form-control" name="formCPF" value="" id="formCPF" >
           <input type="checkbox" id="myCheck2" onclick="check2()">
            
        </div>
      </div>
      
      <button type="submit" class="btn btn-primary ">Pesquisar</button>
    </form> 
    <hr>
  
    <table class="table table-striped" id="table" >
      
      <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;" >
        <tr>
          <th scope="col" class="titleColumn" style="white-space:nowrap;">NOME</th>
          <th scope="col" class="titleColumn" style="white-space:nowrap;">CPF</th>
          <th scope="col" class="titleColumn" style="white-space:nowrap;">E-MAIL</th>
          <th scope="col" class="titleColumn" style="white-space:nowrap;">AÇÕES</th>
          
        </tr>
      </thead>
          <tbody>
@if(isset($alunos))
  @foreach($alunos as $aluno)
            <tr>
            <td>{{$aluno->name}}</td>  
              <td>{{$aluno->cpf}}</td>
              <td>{{$aluno->email}}</td>
              <td>
                
                
                <form action="{{  route('listar-requisicoes-servidor', ['id'=> $aluno->id])  }}" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-success">
                    Ver histórico
                  </button>
                </form>                
              </td>
            </tr>
  @endforeach
@endif           
          </tbody> 
    </table>        
      

  </div>

  {{--   INICIO DA TABELA DE RESULTADO --}}

  <script type="text/javascript">
    
    function check1() {
      document.getElementById("myCheck1").checked = true;
      document.getElementById("myCheck2").checked = false;
      $("#formNome").prop("disabled", false);
      $("#formCPF").prop("disabled", true);
    }

    function check2() {
      document.getElementById("myCheck1").checked = false;
      document.getElementById("myCheck2").checked = true;
      $("#formNome").prop("disabled", true);
      $("#formCPF").prop("disabled", false);
    }

    
    $(document).ready(function() {
      $("#formNome").prop("disabled", true); 
      $("#formCPF").prop("disabled", true); 
    });

    $(document).ready(function($){
      $('#formCPF').mask('000.000.000-00');

    });
    

  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection