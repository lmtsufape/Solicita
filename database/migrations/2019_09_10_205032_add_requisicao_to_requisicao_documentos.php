<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequisicaoToRequisicaoDocumentos extends Migration
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
            $table->unsignedBigInteger('requisicao_id');
            $table->foreign('requisicao_id')->references('id')->on('requisicaos');
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
            $table->dropForeign('requisicao_documentos_requisicao_id_foreign');
            $table->dropColumn('requisicao_id');
        });
    }
}
