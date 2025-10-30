<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsAuditoriaTable extends Migration
{
    public function up()
    {
        Schema::create('logs_auditoria', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->string('acao', 50);
            $table->string('tipo_alvo', 50)->nullable();
            $table->integer('alvo_id')->nullable();
            $table->json('meta')->nullable();

            $table->timestamp('criado_em')->useCurrent();
            $table->boolean('excluido')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs_auditoria');
    }
}
