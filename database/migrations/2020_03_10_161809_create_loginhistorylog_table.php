<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginHistoryLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('cms')->hasTable('loginhistory')) {
            Schema::connection('cms')->create('loginhistory', function (Blueprint $table) {
                $table->id();
                $table->integer('CharID');
                $table->tinyInteger('status');
                $table->timestamp('created_at')->useCurrent();
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
        Schema::connection('cms')->dropIfExists('loginhistory');
    }
}
