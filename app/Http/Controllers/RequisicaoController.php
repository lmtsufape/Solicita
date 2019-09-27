<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisicao_documento;
use App\Requisicao;
use App\Documento;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class RequisicaoController extends Controller
{
  public function index()
  {
    return view('autenticacao.formulario-requisicao');
  }

  public function getRequisicoes(Request $request){
    $documento = Documento::where('tipo',$request->titulo)->first();
    //dd($documento->id);

    //DB::table() dá erro, mudar para forma abaixo
    //dd($documento->id);
    //$_SESSION["documento_id"]=$documento->id;
    $listaRequisicao_documentos = Requisicao_documento::where('documento_id',$documento->id)->get();
  
    //dd($listaRequisicao);
    //dd($listaRequisicao);
    $titulo = $request->titulo;

    return view('telas_servidor.requisicoes_servidor', compact('titulo','listaRequisicao_documentos'));
  }


    public function storeRequisicao(Request $request){

      return redirect('confirmacao-requisicao');

    }
}
