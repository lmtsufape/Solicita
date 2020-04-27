<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Curso;
use App\Aluno;
use App\User;
use App\Perfil;
use App\Unidade;
use App\Servidor;
use App\Requisicao;
use App\Documento;
use App\Requisicao_documento;

class AuthController extends Controller
{
    public function register(Request $request)
    {


        

        $usuario = new User();
        $aluno = new Aluno();
        $perfil = new Perfil();
        //USER
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->tipo = 'aluno';
        $usuario->save();
        //ALUNO
        $aluno->cpf = $request->input('cpf');
        $aluno->user_id = $usuario->id;
        $aluno->save();
        //PERFIL

        //Default
        $curso = Curso::where('id',$request->cursos)->first();
        $perfil->default = $curso->nome; //Nome do Curso
        //Situacao
        $vinculo = $request->vinculo;
            if($vinculo==="1"){
              $perfil->situacao = "Matriculado";
            }else if ($vinculo==="2"){
              $perfil->situacao = "Egresso";
            }
            else if ($vinculo==="3"){
              $perfil->situacao = "Especial";
            }
            else if ($vinculo==="4"){
              $perfil->situacao = "REMT - Regime Especial de Movimentação Temporária";
            }
            else if ($vinculo==="5"){
              $perfil->situacao = "Desistente";
            }
            else if ($vinculo==="6"){
              $perfil->situacao = "Trancado";
            }
            else if ($vinculo==="7"){
              $perfil->situacao = "Intercâmbio";
            }
        $unidade = Unidade::where('id',$request->unidade)->first();
        //aluno_id
        $perfil->aluno_id = $aluno->id;
        //unidade_id
        $perfil->unidade_id = $unidade->id;
        //curso_id
        $perfil->curso_id = $curso->id;
        $perfil->valor = true;
        $perfil->save();
        

        // $user = User::create([
        //      'email'    => $request->email,
        //      'password' => $request->password,
        //  ]);

        $token = auth('api')->login($usuario);

        return $this->respondWithToken($token);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60
        ]);
    }
}