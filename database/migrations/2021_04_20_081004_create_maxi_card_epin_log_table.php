<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaxiCardEpinLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maxi_card_epin_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number');
            $table->string('epin_code');
            $table->string('epin_password');
            $table->unsignedBigInteger('epin_amount_id')->nullable();
            $table->unsignedBigInteger('epin_amount');
            $table->decimal('commission')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('epin_amount_id')
                ->references('id')->on('maxi_card_epin')
                ->nullOnDelete()
                ->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maxi_card_epin_log');
    }
}
