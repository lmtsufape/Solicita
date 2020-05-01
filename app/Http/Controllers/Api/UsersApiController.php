<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;

use Illuminate\Support\Facades\DB;

use App\Curso;
use App\Aluno;
use App\Perfil;
use App\Unidade;
use App\Servidor;
use App\Requisicao;
use App\Documento;
use App\Requisicao_documento;

class UsersApiController extends Controller
{
	use VerifiesEmails;
	public $successStatus = 200;
	/**
	* login api
	*
	* @return \Illuminate\Http\Response
	*/
	public function login(){
		if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
			$user = Auth::user();
			if($user->email_verified_at !== NULL){
				$success['message'] = "Login successfull";
				$credentials = request(['email', 'password']);

		        if (! $token = auth('api')->attempt($credentials)) {
		            return response()->json(['error' => 'Unauthorized'], 401);
		        }

		        return response()->json([
		            'access_token' => $token,
		            'token_type'   => 'bearer',
		            'expires_in'   => auth('api')->factory()->getTTL() * 60,
		            'success' => $success,
		        ], $this->successStatus);
				//return response()->json(['success' => $success], $this->successStatus);
			}else{
				return response()->json(['error'=>'Please Verify Email'], 401);
			}
		}
		else{
			return response()->json(['error'=>'Unauthorised'], 401);
		}
	}
	/**
	* Register api
	*
	* @return \Illuminate\Http\Response
	*/
	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 401);
		}


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
        



		// $input = $request->all();
		// $input['password'] = Hash::make($input['password']);
		// $user = User::create($input);
		$usuario->sendApiEmailVerificationNotification();
		$success['message'] = 'Please confirm yourself by clicking on verify user button sent to you on your email';
		return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'success'=>$success,
        ], $this->successStatus);
		//return response()->json(['success'=>$success], $this->successStatus);
	}
	/**
	* details api
	*
	* @return \Illuminate\Http\Response
	*/
	public function details()
	{
		$user = Auth::user();
		return response()->json(['success' => $user], $this->successStatus);
	}
	public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}