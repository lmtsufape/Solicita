@extends('layouts.app')

@section('conteudo')

<div class="container" style="width: 100rem;margin-left: 200px;">
        <div class="col-md-8">
          <form method="POST" action="{{ route('finaliza-requisicao') }}">
            @csrf
            <div class="card" style="width: 70rem;">
                <h2><div class="card-header" align="center">{{ __('Confirmação de Requisição de Documentos') }}</div></h2>
                  <div class="card-body">
                        <div class="form-group row justify-content-center"></div>  <!-- COMPROVANTE DE MATRICULA / COMPROVANTE DE VINCULO / HISTORICO-->
                                  <p><div class = "label" id = nomeAlunoConfirmacao></div><b>Nome do Aluno: {{$requisicao->perfil->aluno->user->name}}</b></p>
                                  <p><div class = "label" id = cpfAlunoConfirmacao></div><b>CPF: {{$requisicao->perfil->aluno->cpf}}</b></p>
                                  <p><div class = "label" id = cursoAlunoConfirmacao></div><b>Curso: {{$requisicao->perfil->curso->nome}}</b></p>
                                  <h3><p> Confirmamos o reecebimento de sua solicitação para os documentos abaixo:</p></h3>
                                  <ul>
                                    @foreach ($arrayDocumentos as $docSolicitado)
                                    <li value="Documentos solicitados">{{$docSolicitado->documento_id}} - {{$docSolicitado}}</li>
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
                                  <h3><p class = "label" id = protocoloRequisicao align="center"> Protocolo de sua requisição: {{$ano}}.{{$size}}.{{$requisicao->perfil->aluno->cpf}}.{{$requisicao->id}}</p></h3>
                                  <h3><p align = "center"> Atenção !</p></h3>
                                  <h5><p>A entrega dos documentos solicitados está condicionada a apresentação de <b>Documento Oficial com foto !</b> </p></h5>
                                  <h5> Data prevista para entrega: </h5>
                              <!-- </label> -->
                                  </div>
                                  <a href="{{ route('finaliza-requisicao') }}" style="text-decoration:none; color: inherit;">
                                    <div class="form-group row mb-0">
                                      <div class="col-md-8 offset-md-4">
                                        <button type="submit"class="btn btn-primary btn-primary-lmts" align="center">
                                        {{ __('Confirmar') }}
                                      </button>
                                    </div>
                                </div>
                              </a>
                        <!-- </form> -->
                    </div>
                  </form>
                </div>
            </div>
       </div>



@endsection
