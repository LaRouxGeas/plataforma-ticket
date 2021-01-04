<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTICKETsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('tic_id');
            $table->string('tic_titulo', 120)->nullable();
            $table->text('tic_descricao')->nullable();
            $table->unsignedInteger('tic_fk_autor');
            $table->unsignedInteger('tic_fk_avaliador')->nullable();
            $table->unsignedInteger('tic_fk_estado');
            $table->text('tic_observacao_solicitante')->nullable();
            $table->text('tic_observacao_aprovador')->nullable();
            $table->timestamp('tic_validade')->nullable();
            $table->timestamp('tic_criado_em')->nullable();
            $table->timestamp('tic_atualizado_em')->nullable();

            $table->foreign('tic_fk_estado')->references('est_id')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
