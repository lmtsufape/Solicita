<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use App\Curso;
use App\Unidade;
use App\User;
use App\Aluno;
use App\Perfil;
use App\Requisicao;
use App\Requisicao_documento;
use Auth;
use Illuminate\Support\Facades\Validator;

class PerfilAlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::all();
        $unidades = Unidade::all();
        $idUser = Auth::user()->id;
        $user = User::find($idUser); //Usuário Autenticado
        $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado

        //PRIMEIRO PERFIL DO ALUNO
        $perfil = Perfil::where([['aluno_id',$aluno->id], ['valor', true]])->first();

        return response()->json([
            'perfil'=>[$perfil],
            'aluno'=>[$aluno],
            'user'=>[$user],
            'unidades'=> $unidades]);

        //TODOS OS PERFIS VINCULADOS AO ALUNO
        $perfisAluno = Perfil::where('aluno_id',$aluno->id)->get();
        $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
        $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
        return response()->json([$cursos,
            $unidades,
            $user,
            $aluno,
            $perfil,
            $unidadeAluno->nome,
            $cursoAluno,
            $perfisAluno
        ]);
    }

    public function editarInfo(){
        $idUser = Auth::user()->id;
        $user = User::find($idUser); //Usuário Autenticado
        $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
        return response()->json([
            'user'=>$user,
            'aluno'=>$aluno]);

    }

    public function storeEditarInfo(Request $request){
        //atualização dos dados
        $user = Auth::user();
        if($user->email!=$request->email){
            $request->validate([
                'email' => ['bail','required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        //dados para ser exibido na view
        $cursos = Curso::all();
        $unidades = Unidade::all();
        $idUser = Auth::user()->id;
        $user = User::find($idUser); //Usuário Autenticado
        $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
        $perfil = Perfil::where('aluno_id',$aluno->id)->first();
        $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
        $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
        $perfisAluno = Perfil::where('aluno_id',$aluno->id)->get();
        $message = 'Seus dados foram atualizados!';
        return response()->json([
            /*           $cursos,
                       $unidades,
                       $user,
                       $aluno,
                       $perfil,
                       $unidadeAluno->nome,
                       $cursoAluno,
                       $perfisAluno,*/
            'message'=>$message
        ]);
    }

    public function storeAlterarSenha(Request $request){

        if (!Hash::check($request->atual, Auth::user()->password)) {
            $message = 'Senha atual está incorreta.';
            return response()->json(["message" => $message]);
        }
        if($request->input('password_confirmation') != $request->password){
            $message = 'Senhas não coincidem.';
            return response()->json(["message" => $message]);
        }
        if($request->input('password_confirmation') == $request->atual){
            $message = 'Senha atual é igual a senha nova.';
            return response()->json(["message" => $message]);
        }
        $rules = [
            'password' => 'required|string|min:8',
            // 'atual' => 'required|string|min:8',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $message = "Erro, senha invalida";
            return response()->json(["message" => $message]);
        }
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        $cursos = Curso::all();
        $unidades = Unidade::all();
        $idUser = Auth::user()->id;
        $user = User::find($idUser); //Usuário Autenticado
        $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
        $perfil = Perfil::where('aluno_id',$aluno->id)->first();
        $perfisAluno = Perfil::where('aluno_id',$aluno->id)->get();
        $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
        $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
        $message = 'Senha alterada com sucesso!';

        return response()->json([
            "message" =>$message], 201);
    }

    public function adicionaPerfil(Request $request){
        $idUser = Auth::user()->id;
        $user = User::find($idUser); //Usuário Autenticado
        $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
        $perfil = Perfil::where('aluno_id',$aluno->id)->first();
        $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
        $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
        $perfis = Perfil::where('aluno_id',$aluno->id)->get();
        $id = [];
        foreach ($perfis as $perfil) {
            array_push($id, $perfil->curso_id);
        }
        $cursos = Curso::whereNotIn('id', $id)->get();
        $unidades = Unidade::All();
        $quant = count($perfis);
        if($quant==7){
            $message = 'Você já possui todos os cursos adicionados ao seus perfil, caso queira atualizar o status do seu vínculo,
        favor excluir o curso em questão e adicionar perfil com o novo vínculo';
            return response()->json([$message]);
        }
        else{
            return response()->json([
                $perfil,
                $perfis,
                $cursoAluno,
                $unidadeAluno,
                $aluno,
                $unidades,
                $cursos
            ]);
        }
    }

    public function salvaPerfil(Request $request){
        $usuario = User::find(Auth::user()->id);
        $aluno = $usuario->aluno;

        $perfil = new Perfil();
        $perfil->curso_id = $request->curso;
        $perfil->unidade_id = $request->unidade;
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
        $definicaoPadrao = $request->selecaoPadrao;
        if($definicaoPadrao=='true'){
            $perfis = Perfil::where('aluno_id',$aluno->id)->get();
            foreach ($perfis as $p) {
                $p->valor = false;
                $p->save();
            }
            $perfil->valor=true;
        }
        else{
            $perfil->valor = false;
        }
        $temp = $request->cursos;
        $curso = Curso::where('id',$request->curso)->first();
        $perfil->default = $curso->nome;
        $perfil->aluno()->associate($aluno);
        $perfil->save();
        // }
        // return redirect ('/perfil-aluno');
        $message = "Perfil adicionado com sucesso";
        return response()->json(['message'=>$message]);
    }

    public function excluirPerfil(Request $request) {

        if($request->idPerfil==null){
            $message = "Selecione o perfil que deseja excluir";
            return response()->json(['message'=>$message]);
        }
        $usuario = User::find(Auth::user()->id);
        $aluno = $usuario->aluno;
        $perfis = Perfil::where('aluno_id',$aluno->id)->get();


        $quant = count($perfis);
        if($quant===1){
            $message = "Necessário haver ao menos um perfil vinculado ao aluno!";
            return response()->json(['message'=>$message]);
        }
        else{
            // Requisições do perfil selecionado para deletar
            $requisicoes = Requisicao::where('perfil_id',$request->idPerfil)->get();
            foreach ($requisicoes as $requisicao) {

                $requisicao_documento = Requisicao_Documento::where('requisicao_id',$requisicao->id)->get();
                foreach ($requisicao_documento as $rd) {
                    if($rd->status == "Em andamento"){
                        $message = 'Você não pode excluir este perfil pois existem requisições em andamento vinculadas a ele.';
                        return response()->json(['message'=>$message]);

                    }
                }
            }

            $id = $request->idPerfil;
            $isDefault = Perfil::where('id',$id)->first();
            // Perfil Default
            if ($isDefault->valor==true) {
                // $perfil = Perfil::where('id', $id)->delete();
                $perfil = Perfil::find($id);
                $requisicoes = Requisicao::where('perfil_id',$perfil->id)->get();
                // dd($requisicoes);
                foreach ($requisicoes as $requisicao){
                    $requisicao_documento = Requisicao_documento::where('requisicao_id',$requisicao->id)->where('status','not like','Em andamento');
                    if(isset($requisicao_documento)){
                        // dd($requisicao_documento);
                        $requisicao_documento->delete();
                        $requisicao->delete();
                    }
                }
                $perfil->delete();
                // dd($perfil);
                $primeiro = Perfil::where('aluno_id', $aluno->id)->first();
                $primeiro->valor=true;
                $primeiro->save();
                $message = 'Perfil excluído com sucesso!';
                return response()->json(['message'=>$message], 201);

            }
            // Perfil Secundário
            else{
                // $perfil = Perfil::where('id', $id)->delete();
                $perfil = Perfil::find($id);
                $requisicoes = Requisicao::where('perfil_id',$perfil->id)->get();
                // dd($requisicoes);
                foreach ($requisicoes as $requisicao){
                    $requisicao_documento = Requisicao_documento::where('requisicao_id',$requisicao->id)->where('status','not like','Em andamento');
                    // dd($requisicao_documento);
                    if(isset($requisicao_documento)){
                        $requisicao_documento->delete();
                        $requisicao->delete();

                    }
                }
                $perfil->delete();

                // dd($perfil);
            }
            $message = 'Perfil excluído com sucesso!';
            return response()->json(['message'=>$message], 201);
        }
    }

    public function definirPerfilDefault(Request $request){
        $id = $request->idPerfil;
        $selecao = Perfil::where('id', $id)->first(); //perfil que será selecionado como padrão
        // dd($selecao);
        $usuario = User::find(Auth::user()->id);

        $aluno = $usuario->aluno;
        $perfis = Perfil::where('aluno_id',$aluno->id)->get();
        // dd($perfis);
        foreach ($perfis as $p) {
            if($p->id == $selecao->id){
                // dd("Achei");
                $p->valor = true;
                $p->save();
            }else{
                $p->valor = false;
                $p->save();
            }
        }
        $message = 'Perfil definido como padrão com sucesso!';
        return response()->json(['message'=>$message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
