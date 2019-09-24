<?php

use Illuminate\Database\Seeder;

class ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user_id = DB::table('users')->where('name','server')->pluck('id');
      $unidade_id = DB::table('unidades')->where('nome','UAG - Unidade Acadêmica de Garanhuns')->pluck('id');

      DB::table('servidors')->insert([
        'matricula'=>'99999999',
        'user_id' => $user_id[0],
        'unidade_id'=>$unidade_id[0],
      ]);
    }
}
