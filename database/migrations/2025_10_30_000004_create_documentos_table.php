<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('processo_id');
            $table->foreign('processo_id')->references('id')->on('processos')->onDelete('cascade');

            $table->string('nome', 150);
            $table->string('tipo', 50)->nullable();
            $table->text('caminho_arquivo');
            $table->integer('versao')->default(1);
            $table->boolean('confidencial')->default(false);

            $table->unsignedInteger('criado_por')->nullable();
            $table->foreign('criado_por')->references('id')->on('users')->onDelete('set null');

            $table->timestamp('criado_em')->useCurrent();

            $table->index('nome', 'idx_documentos_nome');
            $table->boolean('excluido')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
