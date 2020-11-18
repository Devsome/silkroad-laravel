<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', static function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->enum('state', ['active', 'disabled']);
            $table->timestamps();
        });

        Schema::create('pages_content', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pages_id');
            $table->text('title');
            $table->longText('body');
            $table->softDeletes('deleted_at');
            $table->timestamps();

            $table->foreign('pages_id')
                ->references('id')->on('pages')
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
        Schema::dropIfExists('pages');

        Schema::dropIfExists('pages_content');
    }
}
