<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemWebMallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_web_mall', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id');
            $table->text('item_name');
            $table->text('CodeName128');
            $table->smallInteger('gender');
            $table->unsignedBigInteger('category_id');
            $table->integer('silk_price')->default(0);
            $table->integer('item_quantity')->default(1);
            $table->integer('item_plus')->default(0);
            $table->longText('tooltip')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')->on('item_mall_item_categories')
                ->cascadeOnDelete()
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
        Schema::dropIfExists('item_web_mall');
    }
}
