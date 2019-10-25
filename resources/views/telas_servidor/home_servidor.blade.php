@extends('layouts.app')


@section('conteudo')

<div class="tela-servidor ">
        <div class="centro-cartao">


            <label for="cursos" style="margin-left:275px; ">Selecionar Curso</label>
            <div class="justify-content-right" style="margin-left: 275px">
              <select name="cursos" id="cursos" onchange="getSelectValue();"
              class="browser-default custom-select custom-select-lg mb-1" style="width: 400px">

                @foreach($cursos as $curso)
                <option value="{{$curso->id}}">{{$curso->nome}}</option>
                @endforeach

              </select>

            </div>
            <script>

                function getSelectValue(){

                    var selectedValue = document.getElementById("cursos").value;
                    console.log(selectedValue);
                    document.getElementById('cursoIdDeclaracao1').value = selectedValue;
                    document.getElementById('cursoIdDeclaracao2').value = selectedValue;
                    document.getElementById('cursoIdDeclaracao3').value = selectedValue;
                    document.getElementById('cursoIdDeclaracao4').value = selectedValue;
                    document.getElementById('cursoIdDeclaracao5').value = selectedValue;
                    // document.getElementById('cursoIdDeclaracao6').value = selectedValue;


                }

            </script>

                <div class="card-deck d-flex justify-content-center">


                    <div class="conteudo-central d-flex justify-content-center">

                      <!-- Para a retirada do card "TODOS", foi reduzido o offset do laço para 5, em vez de 6 -->
                      @for($i = 1;$i <= 5; $i++)

                          <a   href="{{ route('listar-requisicoes') }}" onclick="event.preventDefault();
                                           document.getElementById('listar-requisicoes{{$i}}-form').submit();" style="text-decoration:none; color: inherit;">
                             <div class="card cartao text-center " style="border-radius: 20px">

                                     <div class="card-body d-flex justify-content-center">

                                     <h2 style="padding-top:20px">{{$tipoDocumento[$i-1]}}</h2>


                                 </div>
                             </div>
                          </a>

                          <form id="listar-requisicoes{{$i}}-form" action="{{ route('listar-requisicoes') }}" method="GET" style="display: none;">
                            <input id="cursoIdDeclaracao{{$i}}" type="hidden" name="curso_id" value="1">
                            <input  type="hidden" name="titulo_id" value="{{$i}}">

                          </form>

                        @endfor


                        <!-- <a href="{{ route('listar-requisicoes', ['titulo_id' => 2]) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px">

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:20px">Comprovante de Matrícula</h2>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('listar-requisicoes', ['titulo_id' => 3]) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px" >

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:20px">Histórico</h2>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('listar-requisicoes', ['titulo_id' => 4]) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px" >

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:0">Programa de Disciplina</h2>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('listar-requisicoes', ['titulo_id' => 5]) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px">

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:20px">Outros</h2>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('listar-requisicoes', ['titulo' => 'Todos']) }}" style="text-decoration:none; color: inherit;">
                            <div class="card cartao text-center " style="border-radius: 20px">

                                    <div class="card-body d-flex justify-content-center">

                                    <h2 style="padding-top:20px">Todos</h2>
                                </div>
                            </div>
                        </a> -->

                        <!-- </form> -->

@endsection
