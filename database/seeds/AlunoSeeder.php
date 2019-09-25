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
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> bcdcc07322ff96aa8c91318d75be4f29e7695e67
=======
       $user_id = DB::table('users')->where('name','veloso')->pluck('id');

       DB::table('alunos')->insert([
         'cpf'=>'987654321',
         'user_id' => $user_id[0],
         ]);
=======
>>>>>>> master
      $user_id = DB::table('users')->where('name','admin')->pluck('id');
        DB::table('alunos')->insert([
          'cpf'=>'12345678900',
          'user_id'=> $user_id[0],
        ]);
<<<<<<< HEAD
=======
>>>>>>> 5be38ca3595bb84226e661af7f18c7e6a40ecdbf
>>>>>>> master
    }
}
