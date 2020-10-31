<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->time('office_hour_start')->default('08:00');
            $table->time('office_hour_end')->default('05:00');
            $table->integer('max_chat')->default(5);
            $table->integer('max_queue_limit')->default(5);
            $table->text('chat_welcome')->default('');
            $table->text('chat_beyond_hours')->default('');
            $table->string('sched_purging')->default('6 Months');
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
        Schema::dropIfExists('system_settings');
    }
}
