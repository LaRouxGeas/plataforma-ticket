<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegioesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regioes', function (Blueprint $table) {
            $table->increments('reg_id');
            $table->string('reg_nome', 120);
            $table->text('reg_descricao');
            $table->timestamp('reg_criado_em')->nullable();
            $table->timestamp('reg_atualizado_em')->nullable();
            $table->timestamp('reg_deletado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regioes');
    }
}
