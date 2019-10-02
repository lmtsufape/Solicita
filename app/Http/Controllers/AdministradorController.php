<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\User;
use App\Servidor;
use App\Unidade;
use App\Requisicao;

class AdministradorController extends Controller
{

  public function index(){
    $unidades = Unidade::All();
    $usuarios = User::All();
    $servidores = Servidor::All();
    $requisicoes = Requisicao::All();
    return view('/autenticacao.home',compact('unidades','usuarios', 'servidores','requisicoes'));

  }
  public function cancel(){
        return view('/autenticacao.home'); //redireciona para view
  }
}
