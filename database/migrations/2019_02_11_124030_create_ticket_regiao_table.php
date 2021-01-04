<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketRegiaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_regiao', function (Blueprint $table) {
            $table->unsignedInteger('tic_fk')->nullable();
            $table->foreign('tic_fk')->references('tic_id')->on('tickets')->onDelete('cascade');

            $table->unsignedInteger('reg_fk')->nullable();
            $table->foreign('reg_fk')->references('reg_id')->on('regioes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_regiao');
    }
}
