@extends('layouts.app')

@section('conteudo')

<div class="container">
        <div class="col-md-8">
          <form method="POST" action="{{ route('finaliza-requisicao') }}">
            @csrf
            <div class="card" style="width: 70rem;">
                <div class="card-header" align="center"><h5>Confirmação</h5></div>
                  <div class="card-body">
                        <div class="form-group row justify-content-center"></div>  <!-- COMPROVANTE DE MATRICULA / COMPROVANTE DE VINCULO / HISTORICO-->
                          <label>Nome</label>
                          <b><h4>{{$requisicao->perfil->aluno->user->name}}</h4></b>
                          <label>Curso</label>
                          <b><h4>{{$requisicao->perfil->curso->nome}}</h4></b>
                          <br>
                          <h4>Confirmamos o reecebimento de sua solicitação para os documentos abaixo:</h4>
                          <ul>
                            @foreach ($arrayDocumentos as $docSolicitado)
                            <li value="Documentos solicitados">{{$docSolicitado->documento_id}}</li>
                            @if($docSolicitado->documento_id==4)
                              <h5>Descrição do documento solicitado {{$docSolicitado->detalhes}}</h5>
                            @endif
                            @if($docSolicitado->documento_id==5)
                              <h5>Descrição do documento solicitado {{$docSolicitado->detalhes}}</h5>
                            @endif
                            @endforeach
                          </ul>


                          <!-- <p><value="Comprovante de Matricula" id="comprovanteMatricula">Comprovante de matricula</br></p>
                          <p><value="Histórico" id="historico"> Histórico</br></p>
                          <p><value="Programa de Disciplina" id="programaDisciplina"> Programa de Disciplina</br></p>
                          <p><value="Outros" id="outrosDocumentos"> Outros</br></p> -->
                          <p>
                            <h4>Número de Protocolo</h4>
                            <h1><p>{{$ano}}.{{$size}}.{{$requisicao->perfil->aluno->cpf}}.{{$requisicao->id}}</p></h1>
                          </p>

                          <br>

                          <label>Data prevista para entrega</label>
                          <h4> dd/mm/aaaa</h4>

                          <br>
                          <p>
                            <h3 align="center" style="color:red">Atenção</h3>
                            <h5 align="center" style="color:red">A entrega dos documentos solicitados está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h5>
                          </p>
                      <!-- </label> -->
                          </div>
                          <a href="{{ route('finaliza-requisicao') }}" style="text-decoration:none; color: inherit;">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"class="btn btn-primary btn-primary-lmts" align="center" style="margin-left:15%;margin-bottom:20px">
                                {{ __('Confirmar') }}
                              </button>
                            </div>
                      </a>
                <!-- </form> -->
                    </div>
                  </form>
                </div>
            </div>
       </div>
@endsection
