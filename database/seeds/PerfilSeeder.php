<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
//      public function run()
//      {
//         $user_id = DB::table('users')->where('name','veloso')->pluck('id');
//         $aluno_id = DB::table('alunos')->where('cpf', '987654321')->pluck('id');
//         $unidade_id = DB::table('unidades')->where('nome','UAG - Unidade Acadêmica de Garanhuns')->pluck('id');
//         $curso_id = DB::table('cursos')->where('nome','Agronomia')->pluck('id');
//
//         DB::table('perfils')->insert([
//           'situacao'=>'Egresso',
//           'default' => 'Agronomia',
//           'aluno_id' => $aluno_id[0],
//           'unidade_id'=> $unidade_id[0],
//           'curso_id' => $curso_id[0],
//           ]);
//      }
// =======
// >>>>>>> master
    public function run()
    {
      $aluno_id = DB::table('alunos')->where('cpf','12345678900')->pluck('id');
      $unidade_id = DB::table('unidades')->where('nome','UAG - Unidade Acadêmica de Garanhuns')->pluck('id');
      $curso_id = DB::table('cursos')->where('nome','Agronomia')->pluck('id');
      DB::table('perfils')->insert([
        'default'=>'Agronomia',
        'situacao'=>'Matriculado',
        'aluno_id'=>$aluno_id[0],
        'unidade_id'=>$unidade_id[0],
        'curso_id'=>$curso_id[0],
      ]);
    }
}
