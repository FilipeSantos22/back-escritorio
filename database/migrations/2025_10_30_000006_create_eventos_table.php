<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 150);
            $table->text('descricao')->nullable();
            $table->timestamp('data_inicio');
            $table->timestamp('data_fim');

            $table->unsignedInteger('processo_id')->nullable();
            $table->foreign('processo_id')->references('id')->on('processos')->onDelete('set null');

            $table->unsignedInteger('criado_por')->nullable();
            $table->foreign('criado_por')->references('id')->on('users')->onDelete('set null');

            $table->timestamp('criado_em')->useCurrent();
            $table->boolean('excluido')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
