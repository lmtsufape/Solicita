<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $cursos = ['Agronomia','Bacharelado em Ciência da Computação','Engenharia de Alimentos','Licenciatura em Letras',
                  'Licenciatura em Pedagogia', 'Medicina Veterinária', 'Zootecnia'];
      $abreviatura = ['AG','BCC','EA','LL',
                  'LP', 'MV', 'BZ'];

      $unidade_id = DB::table('unidades')->where('nome','UFAPE - SEDE (Unidade Acadêmica de Garanhuns)')->pluck('id');
      for ($i=0; $i < sizeof($cursos); $i++) {
        DB::table('cursos')->updateOrInsert([
          'nome' => $cursos[$i],
          'abreviatura' => $abreviatura[$i],
          'unidade_id' => $unidade_id[0],
        ]);
      }

    }
}
