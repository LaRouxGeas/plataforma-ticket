<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateESTADOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->increments('est_id');
            $table->string('est_nome', 120);
            $table->text('est_descricao');
            $table->timestamp('est_criado_em')->nullable();
            $table->timestamp('est_atualizado_em')->nullable();
            $table->timestamp('est_deletado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
