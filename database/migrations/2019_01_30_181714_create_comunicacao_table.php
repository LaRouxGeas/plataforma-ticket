<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComunicacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunicacoes', function (Blueprint $table) {
            $table->increments('com_id');
            $table->string('com_nome', 120);
            $table->text('com_descricao');
            $table->timestamp('com_criado_em')->nullable();
            $table->timestamp('com_atualizado_em')->nullable();
            $table->timestamp('com_deletado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comunicacoes');
    }
}
