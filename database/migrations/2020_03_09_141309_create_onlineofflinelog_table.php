<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineofflinelogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('log')->hasTable('onlineofflinelog')) {
            Schema::connection('log')->create('onlineofflinelog', function (Blueprint $table) {
                $table->id();
                $table->integer('CharID');
                $table->tinyInteger('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('log')->dropIfExists('onlineofflinelog');
    }
}
