<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('emp_id');
            $table->string('emp_nome', 120);
            $table->text('emp_descricao');
            $table->timestamp('emp_criado_em')->nullable();
            $table->timestamp('emp_atualizado_em')->nullable();
            $table->timestamp('emp_deletado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
