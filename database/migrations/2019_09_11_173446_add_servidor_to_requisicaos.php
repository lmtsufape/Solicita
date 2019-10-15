<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServidorToRequisicaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisicaos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('servidor_id')->nullable();
            $table->foreign('servidor_id')->references('id')->on('servidors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requisicaos', function (Blueprint $table) {
            //
            $table->dropForeign('requisicaos_servidor_id_foreign');
            $table->dropColumn('servidor_id');
        });
    }
}
