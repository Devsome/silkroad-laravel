<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemMallItemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_mall_item_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('TypeID2');
            $table->integer('TypeID3');
            $table->text('category');
            $table->integer('TypeID4');
            $table->text('type');
            $table->smallInteger('race');
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
        Schema::dropIfExists('item_mall_item_categories');
    }
}
