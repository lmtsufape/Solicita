<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdministradorToInstituicaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instituicaos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('administrador_id');
            $table->foreign('administrador_id')->references('id')->on('administradors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instituicaos', function (Blueprint $table) {
            //
            $table->dropForeign('instituicaos_administrador_id_foreign');
            $table->dropColumn('administrador_id');
        });
    }
}
