<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->string('pro_nome', 120);
            $table->text('pro_descricao');
            $table->timestamp('pro_criado_em')->nullable();
            $table->timestamp('pro_atualizado_em')->nullable();
            $table->timestamp('pro_deletado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
