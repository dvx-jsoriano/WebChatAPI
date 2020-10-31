<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('cust_username', 50)->unique();
            $table->string('cust_password');
            $table->string('cust_acctno')->default('');
            $table->string('cust_name')->default('');
            //$table->string('cust_first')->default('');
            //$table->string('cust_last')->default('');
            $table->string('cust_email')->default('');
            $table->string('cust_contact')->default('');
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
        Schema::dropIfExists('customers');
    }
}
