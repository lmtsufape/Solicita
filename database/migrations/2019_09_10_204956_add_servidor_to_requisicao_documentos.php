<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServidorToRequisicaoDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisicao_documentos', function (Blueprint $table) {
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
        Schema::table('requisicao_documentos', function (Blueprint $table) {
            //
            $table->dropForeign('requisicao_documentos_servidor_id_foreign');
            $table->dropColumn('servidor_id');
        });
    }
}
