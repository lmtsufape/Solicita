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
        $this->call(UsuarioSeeder::class);
        $this->call(AdministradorSeeder::class);
        $this->call(InstituicaoSeeder::class);
        $this->call(UnidadeSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(DocumentoSeeder::class);
    }
}
