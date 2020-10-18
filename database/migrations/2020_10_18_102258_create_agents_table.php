<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('agent_username')->unique();
            $table->string('agent_password');
            $table->string('agent_handle')->default('');
            $table->string('agent_first')->default('');
            $table->string('agent_last')->default('');
            $table->string('agent_type')->default('Agent');
            $table->integer('agent_maxchat')->default(1);
            $table->boolean('active')->default(true);
            $table->string('status')->default('LOGOUT');
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
        Schema::dropIfExists('agents');
    }
}
