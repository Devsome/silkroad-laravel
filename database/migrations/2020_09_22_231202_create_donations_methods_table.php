<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('method')->unique(); // unique payment method
            $table->string('name');
            $table->enum('currency', ['USD', 'EUR'])->default('USD');
            $table->string('image'); // Found at /public/image/donations
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('donation_methods');
    }
}
