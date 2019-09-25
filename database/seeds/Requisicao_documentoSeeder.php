<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Requisicao_documentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aluno_id = DB::table('alunos')->where('cpf','12345678900')->pluck('id');
        $requisicao_id = DB::table('requisicaos')->where('aluno_id',$aluno_id[0])->pluck('id');
        $documento_id = DB::table('documentos')->where('tipo','Declaração de Vínculo')->pluck('id');
        $servidor_id = DB::table('servidors')->where('matricula','123456789')->pluck('id');
        $dt = Carbon::now();

        DB::table('requisicao_documentos')->insert([
          'anotacoes'=>'asdiaosdihasd',
          'status'=>'Em andamento',
          'status_data'=>$dt->toDateString(),
          'detalhes'=>'nenhum detalhe',
          'aluno_id'=>$aluno_id[0],
          'documento_id'=>$documento_id[0],
          'servidor_id'=>$servidor_id[0],
          'requisicao_id'=>$requisicao_id[0],

        ]);

    }
}
