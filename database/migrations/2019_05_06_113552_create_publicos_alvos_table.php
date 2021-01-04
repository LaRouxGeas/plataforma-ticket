<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicosAlvosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicos_alvos', function (Blueprint $table) {
            $table->increments('pua_id');
            $table->string('pua_nome', 120);
            $table->text('pua_descricao');
            $table->timestamp('pua_criado_em')->nullable();
            $table->timestamp('pua_atualizado_em')->nullable();
            $table->timestamp('pua_deletado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicos_alvos');
    }
}
