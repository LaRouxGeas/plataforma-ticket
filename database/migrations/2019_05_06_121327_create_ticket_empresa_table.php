<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_empresa', function (Blueprint $table) {
            $table->unsignedInteger('tic_fk')->nullable();
            $table->foreign('tic_fk')->references('tic_id')->on('tickets')->onDelete('cascade');

            $table->unsignedInteger('emp_fk')->nullable();
            $table->foreign('emp_fk')->references('emp_id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_empresa');
    }
}
