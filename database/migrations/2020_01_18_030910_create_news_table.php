<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('news', function(Blueprint $table) {
			$table->increments('id');
            $table->string('title', 100);
			$table->string('slug', 50)->unique();
			$table->text('body');
			$table->unsignedInteger('image_id')->nullable();
			$table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
	public function down()
	{
		Schema::drop('news');
	}
}
