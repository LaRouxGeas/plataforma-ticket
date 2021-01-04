<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketComunicacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_comunicacao', function (Blueprint $table) {
            $table->unsignedInteger('tic_fk')->nullable();
            $table->foreign('tic_fk')->references('tic_id')->on('tickets')->onDelete('cascade');

            $table->unsignedInteger('com_fk')->nullable();
            $table->foreign('com_fk')->references('com_id')->on('comunicacoes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_comunicacao');
    }
}
