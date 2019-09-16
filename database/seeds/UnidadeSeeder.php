<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $instituicao_id = DB::table('instituicaos')->where('nome','Universidade Federal Rural de Pernambuco')->pluck('id');
        DB::table('unidades')->insert([
          'nome'=> 'Unidade Acadêmica de Garanhuns',
          'instituicao_id'=> $instituicao_id[0],
        ]);
    }
}
