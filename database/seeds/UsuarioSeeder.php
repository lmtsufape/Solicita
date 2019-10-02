<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

          [
          'name'=>'admin',
          'email'=>'admin@gmail',
<<<<<<< HEAD
          'password'=>'12345678',
          ],

          [
          'name'=>'server',
          'email'=>'admin@123',
          'password'=>'12345678',
          ],
          [
          'name'=>'veloso',
          'email'=>'admin@321',
          'password'=>'12345678',
        ],
      ]
      );
=======
          'password'=>Hash::make('123456'),
        ]);
>>>>>>> e940639e494ee9d1dabf1fbc304b209f905fa704
    }
}
