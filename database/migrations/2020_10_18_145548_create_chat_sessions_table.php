<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('ticket_id');
            $table->string('session_id', 16)->unique();
            $table->integer('agent_id')->default(0);
            $table->string('status')->default('QUEUED');
            $table->integer('campaign_id')->default(0);
            $table->string('customer_name')->default('Unknown Customer');
            $table->string('customer_email')->default('');
            $table->string('customer_contact')->default('');
            $table->dateTime('datetime_queue');
            $table->dateTime('datetime_routed');
            $table->dateTime('datetime_abandon');
            $table->dateTime('datetime_prank');
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
        Schema::dropIfExists('chat_sessions');
    }
}
