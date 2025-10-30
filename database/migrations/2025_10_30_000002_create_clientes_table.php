<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150);
            $table->string('documento', 20)->nullable();
            $table->string('contato', 150)->nullable();
            $table->text('endereco')->nullable();
            $table->timestamp('criado_em')->useCurrent();
            $table->boolean('excluido')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
