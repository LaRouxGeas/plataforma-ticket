<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_produto', function (Blueprint $table) {
            $table->unsignedInteger('tic_fk')->nullable();
            $table->foreign('tic_fk')->references('tic_id')->on('tickets')->onDelete('cascade');

            $table->unsignedInteger('pro_fk')->nullable();
            $table->foreign('pro_fk')->references('pro_id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_produto');
    }
}
