<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateARQUIVOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->increments('arq_id');
            $table->text('arq_nome');
            $table->text('arq_local')->nullable();
            $table->string('arq_extensao');
            $table->string('arq_mime');
            $table->unsignedInteger('arq_tamanho');
            $table->unsignedInteger('arq_fk_ticket')->nullable();
            $table->unsignedInteger('arq_fk_usuario');
            $table->timestamp('arq_criado_em')->nullable();
            $table->timestamp('arq_atualizado_em')->nullable();

            $table->foreign('arq_fk_ticket')->references('tic_id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivos');
    }
}
