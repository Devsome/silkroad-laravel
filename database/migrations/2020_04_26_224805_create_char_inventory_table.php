<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('char_inventories', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('from_charid');
            $table->bigInteger('serial64');
            $table->bigInteger('item_id64');
            $table->string('name');
            $table->string('imgpath');
            $table->string('optlevel');
            $table->string('amount');
            $table->string('special')->default('0');
            $table->string('sort')->default('Unknown');
            $table->string('degree');
            $table->integer('level');
            $table->integer('npc_price')->default(0);
            $table->string('race')->default('');
            $table->string('sex')->default('');
            $table->longText('data');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('char_inventories');
    }
}
