<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Curso;
use App\Requisicao_documento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //Copie e cole isso na outra rota que for usar ------------->
        if(Auth::check()){
          if(Auth::user()->tipo == 'servidor'){
            $cursos = Curso::all();
            $requisicoes = Requisicao_documento::all();
            $requisicoes= DB::table('requisicao_documentos')
                             ->join('requisicaos', 'requisicaos.id', '=', 'requisicao_documentos.requisicao_id')
                             ->join('perfils', 'requisicaos.perfil_id', '=', 'perfils.id')
                             ->join('cursos', 'perfils.curso_id', '=' ,'cursos.id')
                             ->select ('requisicao_documentos.id')
                            //  ->where([['status','Em andamento'], ['deleted_at', null]])
                             ->where([['status','Em andamento']])
                             ->orWhere('status', 'Indeferido')
                             ->orWhere('status', 'Concluído - Disponível para retirada')
                             // ->groupBy('curso_id')
                             // ->select('curso_id', DB::raw('count(*) as total'))
                             ->get();
             $id = []; //array auxiliar que pega cada item do $id_documentos
             foreach ($requisicoes as $key) {
               array_push($id, $key->id); //passa o id de $id_documentos para o array auxiliar $id
             }
             $listaRequisicao_documentos = Requisicao_documento::whereIn('id', $id)->get(); //Pega as requisições que possuem o id do curso
             $response = [];
             foreach ($listaRequisicao_documentos as $key) {
                 array_push($response, ['id' => $key->id,
                                        'curso' => $key->requisicao->perfil->curso->id,
                                        'documento_id' => $key->documento_id,
                                        'status' =>$key->status,
                                        'perfils'=>$key->aluno->perfil
                                     ]);
                                   }

            $tipoDocumento = ['Declaração de Vínculo','Comprovante de Matrícula','Histórico','Programa de Disciplina','Outros','Emitidos', 'Indeferidos'];
            return view('telas_servidor.home_servidor', ['cursos'=>$cursos,'tipoDocumento'=>$tipoDocumento, 'requisicoes'=>$response]);
          }
          else if (Auth::user()->tipo == 'aluno') {
          return view('autenticacao.home-aluno');
          }

          else if (Auth::user()->tipo == 'administrador') {
          return view('autenticacao.home-administrador');
          }
        }
      //
        return view('home');
    }
}
