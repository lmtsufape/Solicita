<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $user_id = DB::table('users')->where('name','admin')->pluck('id');
        DB::table('alunos')->insert([
          'cpf'=>'12345678900',
          'user_id'=> $user_id[0],
        ]);
    }
}
