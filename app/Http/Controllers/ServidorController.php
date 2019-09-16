<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Servidor;
use App\Unidade;


class ServidorController extends Controller
{
            public function servidores(Request $request){

                $unidades = Unidade::All();
                $usuarios = User::All();

            }

            public function storeServidor(Request $request) {

            $servidor = new Servidor();
            $usuario = new User();
            $unidade_id = $unidades->;

            $usuario = $request-> name;
            $usuario = $request-> email;
            $usuario = $request-> password;
            $usuario->save();
            $usuarioUltimo = User::where($request->email)->first();

            $servidor->servidor_id = $usuarioUltimo->id;
            $servidor->matricula = $request-> matricula;
            $servidor->save();
            return redirect()->route(cadastro-servidor)->with('message', 'Servidor castrado com sucesso!!');
          }
}
