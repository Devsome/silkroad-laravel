<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItempoolnameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('shard')->hasTable('_ItemPoolName')) {
            Schema::connection('shard')->create('_ItemPoolName', function (Blueprint $table) {
                $table->string('CodeName');
                $table->string('RealName');
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
        Schema::dropIfExists('_ItemPoolName');
    }
}
