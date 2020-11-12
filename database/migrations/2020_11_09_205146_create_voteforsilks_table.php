<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteforsilksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voteforsilks', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pingback');
            $table->integer('reward')->default(1);
            $table->boolean('active')->default(0);
            $table->integer('waiting_hours')->default(12);
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
        Schema::dropIfExists('voteforsilks');
    }
}
