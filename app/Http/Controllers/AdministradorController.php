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
    return view('/autenticacao.home-administrador',compact('unidades','usuarios', 'servidores','requisicoes'))->with('jsAlert', 'Servidor cadastrado com sucesso!!');

  }
  // public function listagemServidores(){
  //
  //       $listaUsuario = DB::table('users');
  //       $listaServidores = DB::table('servidors');
  //       dd(listaServidores);
  //       dd(listaUsuario);
  //       return view ('autenticacao.home-administrador', compact('listaUsuario','listaServidores'));
  // }
}
