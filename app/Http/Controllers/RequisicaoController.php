<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisicao_documento;
use App\Requisicao;
use App\Documento;
use Carbon\Carbon;

class RequisicaoController extends Controller
{
  public function index()
  {
    return view('autenticacao.formulario-requisicao');
  }

    public function storeRequisicao(Request $request){
      /*
      //dd($request->input('requisicaoPrograma'));

      //dd($request->input('declaracaoVinculo')); //se tiver vazio retorna null
      $mytime = Carbon::now('America/Recife');
      $mytime = $mytime->toDateString();

      $requisicaoDocumento = new Requisicao_documento();
      /*
      $requisicaoDocumento->status_data = $mytime;
      $requisicaoDocumento->status = 'Processando';
      $requisicaoDocumento->aluno_id = 1;
      $requisicaoDocumento->servidor_id = 1;
      $requisicaoDocumento->requisicao_id = 1;
      $requisicaoDocumento->documento_id = 1;

      $requisicaoDocumento->save();
      */

      //$requisicao = new Requisicao();
      /*
      $requisicao_documento_array = [];

      if($request->declaracaoVinculo != null){
        //dd($request->input('declaracaoVinculo'));
        $requisicao_documento1 = new Requisicao_documento();

        $requisicao_documento1->aluno_id = 1;
        $requisicao_documento1->servidor_id = 1;
        $requisicao_documento1->requisicao_id = 1;

        $documento1 = Documento::where('tipo',$request->declaracaoVinculo)->first();
        //dd($documento1->id);

        $requisicao_documento1->documento_id = $documento1->id;
        array_push($requisicao_documento_array,$requisicao_documento1);

        //dd($documento1);

      }
      if($request->input('comprovanteMatricula') != null){
        //dd($request->input('comprovanteMatricula'));
        $requisicao_documento2 = new Requisicao_documento();

        $requisicao_documento2->aluno_id = 1;
        $requisicao_documento2->servidor_id = 1;
        $requisicao_documento2->requisicao_id = 1;

        $documento2 = Documento::where('tipo',$request->comprovanteMatricula)->first();
        //dd($documento2);

        $requisicao_documento2->documento_id = $documento2->id;
        array_push($requisicao_documento_array,$requisicao_documento2);
      }
      if($request->input('historico') != null){
        //dd($request->input('historico'));
        $requisicao_documento3 = new Requisicao_documento();
        $requisicao_documento3->aluno_id = 1;
        $requisicao_documento3->servidor_id = 1;
        $requisicao_documento3->requisicao_id = 1;
        $documento3 = Documento::where('tipo',$request->historico)->first();
        $requisicao_documento3->documento_id = $documento3->id;
        array_push($requisicao_documento_array,$requisicao_documento3);
      }
      if($request->input('programaDisciplina') != null){
        //dd($request->input('programaDisciplina'));
      }
      if($request->input('outros') != null){
        //dd($request->input('outros'));
      }

      //dd($requisicao_documento_array);
      //dd($documento->documento());

      $requisicaoDocumento->documento()->saveMany($requisicao_documento_array);

      */

      return redirect('confirmacao-requisicao');

    }
}
