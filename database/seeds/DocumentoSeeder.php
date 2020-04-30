<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documentos = ['Declaração de Vínculo','Comprovante de Matrícula','Histórico','Programa de Disciplina','Outros'];

        for ($i=0; $i < sizeof($documentos); $i++) {

            if($documentos[$i] == 'Programa de Disciplina' || $documentos[$i] == 'Outros'){
                DB::table('documentos')->insert([
                    'tipo'=>$documentos[$i],
                    'detalhes'=> true,                    
                  ]);   
                
            }else{
                DB::table('documentos')->insert([
                    'tipo'=>$documentos[$i],
                    'detalhes'=> false,                    
                  ]); 
                
            }
          
        }
    }
}
