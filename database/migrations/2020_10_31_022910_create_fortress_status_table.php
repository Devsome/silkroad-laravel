<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortressStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('cms')->hasTable('_FortressStatus')) {
            Schema::connection('cms')->create('_FortressStatus', static function (Blueprint $table) {
                $table->id();
                $table->string('status');
                $table->timestamp('date');
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
        Schema::connection('cms')->dropIfExists('_FortressStatus');
    }
}
