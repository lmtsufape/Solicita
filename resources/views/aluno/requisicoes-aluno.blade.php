@extends('layouts.app')

@section('conteudo')

    <div class="tabela-centro mx-auto">

      <table class="table">

        <div class="lmts-primary">

          <select class="browser-default custom-select custom-select-lg mb-1" style="width: 14.5rem; margin-left:1280px; margin-top:10px">

            <option value="" disabled selected>Ordenar por</option>
            <option value="1">Data de Requisição</option>
            <option value="2">Curso</option>
            <option value="3">A-Z</option>
            <option value="4">Validade</option>

          </select>

          <div class="nome-documento lmts-primary mx-auto">
            <h2 class="" style="padding-top:0px">Fulano de Tal</h2>
          </div>

        </div>

        <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;">

          <tr >

            <th scope="col">#</th>
            <th scope="col">CPF</th>
            <th scope="col">NOME</th>
            <th scope="col">CURSO</th>
            <th scope="col">DATA DE REQUISIÇÃO</th>
            <th scope="col">PRAZO</th>
            <th scope="col">STATUS</th>
            <th scope="col">DOCUMENTOS SOLICITADOS</th>

          </tr>

        </thead>

        <tbody>

          @for ($i = 0; $i < 30; $i++)

            <tr>

              <th scope="row">{{$i}}</th>
              <td>000.000.000-00</td>
              <td>Fulano de Tal</td>
              <td>Ciência da Computação</td>
              <td>dd/mm/aaaa</td>
              <td>dd/mm/aaaa</td>
              <td>Em Andamento</td>

              <td>

                <ul>

                  <li>Documento 1</li>
                  <li>Documento 2</li>
                  <li>Documento 3</li>

                </ul>

              </td>

            </tr>

          @endfor

        </tbody>

      </table>

    </div>

@endsection
