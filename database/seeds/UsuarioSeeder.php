<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

          ['name'=>'admin',
          'email'=>'admin@gmail',
          'password'=>'123456',
        ],

        ['name'=>'jorge',
        'email'=>'admin@123',
        'password'=>'123456444',
      ],
      ['name'=>'veloso',
      'email'=>'admin@321',
      'password'=>'123',
      ],
      ]
      );
    }
}
