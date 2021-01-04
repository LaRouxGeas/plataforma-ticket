<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketPublicoAlvoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_publico_alvo', function (Blueprint $table) {
            $table->unsignedInteger('tic_fk')->nullable();
            $table->foreign('tic_fk')->references('tic_id')->on('tickets')->onDelete('cascade');

            $table->unsignedInteger('pua_fk')->nullable();
            $table->foreign('pua_fk')->references('pua_id')->on('publicos_alvos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_publico_alvo');
    }
}
