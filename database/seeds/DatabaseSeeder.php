<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(UsersTableSeeder::class);
        /*
        DB::table('users')->insert([
            'name'=>str::random(5),
            'email'=>str::random(5).'@gmail.com',
            'password'=>bcrypt('12345678'),

        ]);
        */

        /*

        // Seeders Documentos
        DB::table('documentos')->insert([
            'tipo'=>'Declaração de Vínculo'
        ]);

        DB::table('documentos')->insert([
            'tipo'=>'Comprovante de Matrícula'
        ]);

        DB::table('documentos')->insert([
            'tipo'=>'Histórico'
        ]);

        DB::table('documentos')->insert([
            'tipo'=>'Programa de Disciplina'
        ]);

        DB::table('documentos')->insert([
            'tipo'=>'Outros'
        ]);


        // Seeders Administrador
        DB::table('administradors')->insert([
            'matricula'=>str::random(10)
        ]);


        // Seeders Instituição

        DB::table('instituicaos')->insert([
            'administrador_id'=>'1',
            'nome'=>'UFAPE',

        ]);
        // Seeders Unidade

        // Seeders Curso
        */
        $this->call(UsuarioSeeder::class);
        $this->call(AdministradorSeeder::class);
        $this->call(InstituicaoSeeder::class);
        $this->call(UnidadeSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(DocumentoSeeder::class);
        $this->call(ServidorSeeder::class);
        $this->call(AlunoSeeder::class);
        $this->call(PerfilSeeder::class);  
    }
}
