<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHideRankingGuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hide_ranking_guilds')) {
            Schema::create('hide_ranking_guilds', static function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('guild');
                $table->integer('guild_id');
                $table->timestamps();
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
        Schema::dropIfExists('hide_ranking_guilds');
    }
}
