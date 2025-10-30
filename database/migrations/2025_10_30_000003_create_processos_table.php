<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessosTable extends Migration
{
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero', 50)->unique();
            $table->string('tribunal', 100)->nullable();
            $table->string('vara', 100)->nullable();
            $table->string('classe', 100)->nullable();

            $table->unsignedInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('set null');

            $table->text('resumo')->nullable();
            $table->enum('status', ['ativo', 'arquivado', 'vencido'])->default('ativo');

            $table->unsignedInteger('responsavel_id')->nullable();
            $table->foreign('responsavel_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedInteger('criado_por')->nullable();
            $table->foreign('criado_por')->references('id')->on('users')->onDelete('set null');

            $table->timestamp('criado_em')->useCurrent();
            $table->timestamp('atualizado_em')->useCurrent();
            $table->boolean('excluido')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('processos');
    }
}
