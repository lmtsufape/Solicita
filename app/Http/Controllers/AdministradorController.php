<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{
  public function index(){
      return view('home')->with('success', 'Servidor cadastrado com sucesso!');
  }
}
