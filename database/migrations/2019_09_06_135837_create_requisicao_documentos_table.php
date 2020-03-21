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
            $table->string('anotacoes')->nullable();
            $table->string('status')->default(false);
            $table->date('status_data');
            $table->string('detalhes')->nullable();
            $table->timestamps();
        });

        Schema::table('requisicao_documentos', function ($table) {
            $table->softDeletes();
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
