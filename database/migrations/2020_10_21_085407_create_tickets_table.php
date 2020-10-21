<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();         // for integrity
            $table->string('ticket_refno')->default('');    // needs checking
            $table->dateTime('datetime_created');
            $table->string('ticket_type');                  // WEBCHAT
            $table->integer('ticket_status');
            /* $table->string('ticket_callid');             // OTHER TICKET INFO
            $table->string('ticket_title');
            $table->string('ticket_resolution'); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
