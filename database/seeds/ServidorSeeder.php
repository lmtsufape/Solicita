<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user_id = DB::table('users')->where('name','admin')->pluck('id');
      $unidade_id = DB::table('unidades')->where('nome','UFAPE - SEDE (Unidade Acadêmica de Garanhuns)')->pluck('id');

      DB::table('servidors')->insert([
        'matricula'=>'123456789',
        'unidade_id'=>$unidade_id[0],
        'user_id'=>$user_id[0],
      ]);
    }
}
