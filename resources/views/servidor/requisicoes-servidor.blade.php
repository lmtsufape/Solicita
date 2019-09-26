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
                <h2 class="" style="padding-top:0px">{{$titulo}}</h2>
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
                @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
                    <th scope="col">INFORMAÇÕES</th>
                @endif

                

            </tr>
            </thead>
            <tbody>

                @for ($i = 0; $i < 30; $i++)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>000.000.000-00</td>
                        <td>Fulano de Tal</td>
                        <td>Ciências da Computação</td>
                        <td>dd/mm/aaaa</td>
                        <td>dd/mm/aaaa</td>
                        <td>Em Andamento</td>
                        @if($titulo=="Outros" | $titulo=="Programa de Disciplina")
                            <td class="text-wrap">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ligula dolor. Suspendisse suscipit ipsum quis magna hendrerit rhoncus.</td>
                        @endif

                        

                    </tr>
                @endfor
            
            
            </tbody>
        </table>
        
        
        
    </div>

@endsection