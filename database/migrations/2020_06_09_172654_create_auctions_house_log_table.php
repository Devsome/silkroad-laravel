<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsHouseLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions_house_logs', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('price_sold')->nullable();
            $table->unsignedBigInteger('seller_user_id');
            $table->unsignedBigInteger('buyer_user_id')->nullable();
            $table->enum('state', ['sold', 'notsold']);
            $table->timestamps();

            $table->foreign('seller_user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('buyer_user_id')
                ->references('id')->on('users')
                ->onUpdate('SET NULL')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctions_house_logs');
    }
}
