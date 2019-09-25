<?php

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\DB;
>>>>>>> 5be38ca3595bb84226e661af7f18c7e6a40ecdbf
>>>>>>> master

class ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
      $user_id = DB::table('users')->where('name','admin')->pluck('id');
=======
<<<<<<< HEAD
      $user_id = DB::table('users')->where('name','server')->pluck('id');
>>>>>>> master
      $unidade_id = DB::table('unidades')->where('nome','UAG - Unidade Acadêmica de Garanhuns')->pluck('id');

      DB::table('servidors')->insert([
        'matricula'=>'99999999',
        'user_id' => $user_id[0],
        'unidade_id'=>$unidade_id[0],
<<<<<<< HEAD
        'user_id'=>$user_id[0],
=======
=======
      $user_id = DB::table('users')->where('name','admin')->pluck('id');
      $unidade_id = DB::table('unidades')->where('nome','UAG - Unidade Acadêmica de Garanhuns')->pluck('id');

      DB::table('servidors')->insert([
        'matricula'=>'123456789',
        'unidade_id'=>$unidade_id[0],
        'user_id'=>$user_id[0],
>>>>>>> 5be38ca3595bb84226e661af7f18c7e6a40ecdbf
>>>>>>> master
      ]);
    }
}
