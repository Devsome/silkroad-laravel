<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniquekilllogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('log')->hasTable('uniquekilllogs')) {
            Schema::connection('log')->create('uniquekilllogs', function (Blueprint $table) {
                $table->id();
                $table->string('CharName16');
                $table->string('UniqueName');
                $table->timestamp('killed_at')->useCurrent();
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
        Schema::connection('log')->dropIfExists('uniquekilllogs');
    }
}
