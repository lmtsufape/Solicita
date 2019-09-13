<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServidorController extends Controller
{
    public function cadastrarServidor()
    {
  return view('cadastro-servidor.blade');
    }
    public function adiciona(Request $request) {
      $usuario = servidor::create([
        'matricula'=>$request->matricula,
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        ]);
      $user->()->attach($request->tipousuario);
      return redirect()->action('AdministradorController@listaServidores');
    }
}
