@extends('layouts.app')

@section('conteudo')

    <div class="background">

      @if($servidores='0');
      <table class="table">
          <div class="lmts-primary">
              <!-- <select class="browser-default custom-select custom-select-lg mb-1" style="width: 14.5rem; margin-left:1280px; margin-top:10px ">
                  <option value="1">Data de Requisição</option>
                  <option value="2">Curso</option>
                  <option value="3">A-Z</option>
                  <option value="4">Validade</option>

          </select> -->
          <!-- <div class="nome-documento lmts-primary mx-auto ">
              <h2 class="" style="padding-top:0px"></h2>
          </div>
          </div>
        -->
          <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;">
          <tr>
              <th scope="col">Nome</th>
              <th scope="col">Matricula</th>
              <th scope="col">E-mail</th>
              <th scope="col">Unidade Acadêmica</th>
          </tr>
          </thead>
          <tbody>
            @foreach($servidores as $servidor)
                  <tr>
                    <!-- <td value="{{$servidor->id}}"> {{$servidor->nome}}</td> -->
                    <td value="{{$servidor->id}}"> {{$servidor->matricula}}</td>
                  </tr>
              @endforeach
          </tbody>
        </div>
      </table>

    </div>
    @endif
@endsection
