<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Aluno;
use App\Perfil;
use App\Servidor;

class RequisicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $aluno_id = Aluno::where('cpf','12345678900')->pluck('id');
      $perfil_id = Perfil::where('aluno_id',$aluno_id[0])->pluck('id');
      $servidor_id = Servidor::where('matricula','123456789')->pluck('id');

      $dt = Carbon::now();

      DB::table('requisicaos')->insert([
        'data_pedido'=>$dt->toDateString(),
        'hora_pedido'=>$dt->toTimeString(),
        'aluno_id'=>$aluno_id[0],
        'perfil_id'=>$perfil_id[0],
        'servidor_id'=>$servidor_id[0],
      ]);




    }
}
