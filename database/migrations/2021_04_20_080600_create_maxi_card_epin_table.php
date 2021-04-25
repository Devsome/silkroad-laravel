<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaxiCardEpinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maxi_card_epin', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->mediumText('description');
            $table->integer('price');
            $table->integer('silk');
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
        Schema::dropIfExists('maxi_card_epin');
    }
}
