<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class RequisicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



      $aluno_id = DB::table('alunos')->where('cpf','12345678900')->pluck('id');
      $perfil_id = DB::table('perfils')->where('aluno_id',$aluno_id[0])->pluck('id');
      $servidor_id = DB::table('servidors')->where('matricula','123456789')->pluck('id');

      $dt = Carbon::now();



      DB::table('requisicaos')->insert([
        'data_pedido'=>$dt->toDateString(),
        'hora_pedido'=>$dt->toTimeString(),
        'aluno_id'=>$aluno_id[0],
        'perfil_id'=>$perfil_id[0],
        'servidor_id'=>$servidor_id[0],
      ]);

      $aluno_id = DB::table('alunos')->where('cpf','98765432100')->pluck('id');
      $perfil_id = DB::table('perfils')->where('aluno_id',$aluno_id[0])->pluck('id');
      $servidor_id = DB::table('servidors')->where('matricula','123456789')->pluck('id');

      $dt = Carbon::now();



      //requisicao 1 do aluno
      DB::table('requisicaos')->insert([
        'data_pedido'=>$dt->toDateString(),
        'hora_pedido'=>$dt->toTimeString(),
        'aluno_id'=>$aluno_id[0],
        'perfil_id'=>$perfil_id[0],
        'servidor_id'=>$servidor_id[0],
      ]);

      //requisicao 2 do aluno
      DB::table('requisicaos')->insert([
        'data_pedido'=>$dt->toDateString(),
        'hora_pedido'=>$dt->toTimeString(),
        'aluno_id'=>$aluno_id[0],
        'perfil_id'=>$perfil_id[0],
        'servidor_id'=>$servidor_id[0],
      ]);



    }
}
