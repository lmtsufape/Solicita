<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $administrador_id = DB::table('administradors')->where('matricula','123456789')->pluck('id');
        DB::table('instituicaos')->insert([
          'nome'=>'Universidade Federal do Agreste de Pernambuco',
          'administrador_id'=>$administrador_id[0],
        ]);
    }
}
