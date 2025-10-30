<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrazosTable extends Migration
{
    public function up()
    {
        Schema::create('prazos', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('processo_id');
            $table->foreign('processo_id')->references('id')->on('processos')->onDelete('cascade');

            $table->text('descricao');
            $table->timestamp('data_limite');

            $table->unsignedInteger('responsavel_id')->nullable();
            $table->foreign('responsavel_id')->references('id')->on('users')->onDelete('set null');

            $table->enum('prioridade', ['baixa', 'media', 'alta'])->default('media');
            $table->enum('status', ['pendente', 'concluido', 'vencido'])->default('pendente');
            $table->boolean('notificado')->default(false);

            $table->timestamp('criado_em')->useCurrent();

            $table->index('data_limite', 'idx_prazos_data');
            $table->boolean('excluido')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('prazos');
    }
}
