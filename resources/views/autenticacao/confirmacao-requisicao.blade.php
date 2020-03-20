@extends('layouts.app')

@section('conteudo')
<div class="container">
        <div class="col-md-8">
          <form method="POST" action="{{ route('finaliza-requisicao') }}">
            @csrf
            <div class="card" style="width: 70rem;">
                <div class="card-header" align="center"><h5><strong>Protocolo</strong></h5></div>
                  <div class="card-body">
                        <div class="form-group row justify-content-center"></div>  <!-- COMPROVANTE DE MATRICULA / COMPROVANTE DE VINCULO / HISTORICO-->
                          <b><h4><label><strong>Nome:</strong></label>&nbsp{{$requisicao->perfil->aluno->user->name}}</h4></b>
                          <b><h4><label><strong>Curso:</strong></label>&nbsp{{$requisicao->perfil->curso->nome}}</h4></b>
                          <b><h4><label><strong>Vinculo:</strong></label>&nbsp{{$requisicao->perfil->situacao}}</h4></b>
                          <h4>Confirmamos o recebimento de sua solicitação para o(s) documento(s) abaixo:</h4>
                          <h4><ul>
                            @foreach ($arrayAux as $docSolicitado)
                            <b><li value="Documentos solicitados">{{$docSolicitado->tipo}}</li></b>
                            @if($docSolicitado->documento_id==4)
                              <h4>Descrição do documento solicitado {{$docSolicitado->detalhes}}</h4>
                            @endif
                            @if($docSolicitado->documento_id==5)
                              <h4>Descrição do documento solicitado {{$docSolicitado->detalhes}}</h4>
                            @endif
                            @endforeach
                          </ul></h4>
                          <!-- <p><value="Comprovante de Matricula" id="comprovanteMatricula">Comprovante de matricula</br></p>
                          <p><value="Histórico" id="historico"> Histórico</br></p>
                          <p><value="Programa de Disciplina" id="programaDisciplina"> Programa de Disciplina</br></p>
                          <p><value="Outros" id="outrosDocumentos"> Outros</br></p> -->
                          <!-- <p>
                            <h4>Número de Protocolo</h4>
                            <h1><p>{{$size}}.{{$requisicao->perfil->aluno->cpf}}.{{$requisicao->id}}</p></h1>
                          </p> -->
                          <b><h4><label><strong>Data da requisição:</strong> </label>&nbsp{{$date}}</h4></b>
                          <b><h4><label><strong>Hora da requisição:</strong> </label>&nbsp{{$hour}}</h4></b>

                          <p>
                            <h4 align="center" style="color:red">Prazo de Entrega do documento: <b>Até 02(dois) dias úteis</h4>
                            <h4 align="center" style="color:red">Atenção</h4>
                            <h4 align="center" style="color:red">A entrega dos documento(s) solicitado(s) está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h4>
                          </p>
                      <!-- </label> -->
                          </div>

                          <!-- <div class="col-md-6 " style="text-decoration:none; color: inherit;">
                              <a class="menu-principal" href="\home-aluno" align="center"
                                style="color: #1B2E4F; margin-bottom:30px">Voltar</a>
                          </div> -->
                          <!-- <a href="{{ route('finaliza-requisicao') }}" style="text-decoration:none; color: inherit;"> -->
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"class="btn btn-primary btn-primary-lmts" align="center" style="margin-left:15%;margin-bottom:20px">
                                {{ __('Voltar para a tela inicial') }}
                              </button>
                            </div>
                          <!-- </a> -->
                <!-- </form> -->
                    </div>
                  </form>
                </div>
            </div>
       </div>
@endsection
