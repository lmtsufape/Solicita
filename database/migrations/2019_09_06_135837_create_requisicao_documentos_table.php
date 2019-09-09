<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisicaoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicao_documentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('aluno_id');
            $table->foreign('aluno_id')->references('id')->on('alunos');

            $table->unsignedBigInteger('documento_id');
            $table->foreign('documento_id')->references('id')->on('documentos');

            $table->unsignedBigInteger('servidor_id');
            $table->foreign('servidor_id')->references('id')->on('servidors');

            $table->unsignedBigInteger('requisicao_id');
            $table->foreign('requisicao_id')->references('id')->on('requisicaos');

            $table->string('anotacoes');
            $table->string('status');

            $table->date('status_data');
            $table->string('detalhes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisicao_documentos');
    }
}
