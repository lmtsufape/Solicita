@extends('layouts.app')

@section('conteudo')

    <div class="tabela-centro mx-auto">
        <table class="table">
            <div class="lmts-primary">
                <select class="browser-default custom-select custom-select-lg mb-1" style="width: 14.5rem; margin-left:1280px; margin-top:10px ">
                    <option value="" disabled selected>Ordenar por</option>
                    <option value="1">Data de Requisição</option>
                    <option value="2">Curso</option>
                    <option value="3">A-Z</option>
                    <option value="4">Validade</option>

            </select>
            <div class="nome-documento lmts-primary mx-auto ">
                <h2 class="" style="padding-top:0px"> {{$titulo}} </h2>
            </div>
            </div>


            <thead class="lmts-primary table-borderless" style="border-color:#1B2E4F;">
            <tr >
                <th scope="col">Id</th>
                <th scope="col">Concluído</th>
                <th scope="col">CPF</th>
                <th scope="col">NOME</th>
                <th scope="col">CURSO</th>
                <th scope="col">DATA DE REQUISIÇÃO</th>
                <th scope="col">PRAZO</th>
                <th scope="col">STATUS</th>


                @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
                    <th scope="col">INFORMAÇÕES</th>
                @endif



            </tr>
            </thead>
            <tbody>

              {{--
                @for ($i = 0; $i < 30; $i++)
                    <tr>
                        <th scope="row">
                          <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="opcao1" aria-label="...">
                          </div>

                        </th>

                        <td>000.000.000-00</td>
                        <td>Fulano de Tal</td>
                        <td>Ciências da Computação</td>
                        <td>dd/mm/aaaa</td>
                        <td>dd/mm/aaaa</td>
                        <td>Em Andamento</td>


                        @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
                            <td class="text-wrap">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ligula dolor. Suspendisse suscipit ipsum quis magna hendrerit rhoncus.</td>
                        @endif

<<<<<<< HEAD
=======
<<<<<<< HEAD:resources/views/servidor/requisicoes_servidor.blade.php

=======
>>>>>>> 5be38ca3595bb84226e661af7f18c7e6a40ecdbf:resources/views/telas_servidor/requisicoes_servidor.blade.php
>>>>>>> master

                    </tr>
                @endfor

              --}}


              @foreach($listaRequisicao_documentos as $requisicao_documento)

                  <tr>
                    <td>{{$requisicao_documento->id}}</td>
                    <th scope="row">
                      <div class="form-check">
                        <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="opcao1" aria-label="...">
                      </div>

                    </th>
                    <td>{{$requisicao_documento->aluno->cpf}}</td>
                    <td>{{$requisicao_documento->aluno->user->name}}</td>
                    <td>{{$requisicao_documento->requisicao->perfil->default}}</td>
                    <td>{{$requisicao_documento->status_data}}</td>
                    <td>dd/mm/aaaa</td>
                    <td>{{$requisicao_documento->status}}</td>

                    @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
                        <td class="text-wrap">{{$requisicao_documento->detalhes}}</td>
                        
                    @endif
                </tr>
              @endforeach


            </tbody>
        </table>

      


    </div>

@endsection
