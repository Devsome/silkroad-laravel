<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniquekillogsProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = '
            CREATE PROCEDURE _ExecUniquekilllogs @CharName16 nvarchar (60), @UniqueName nvarchar (200)
            AS INSERT
               INTO uniquekilllogs (CharName16, UniqueName)
               VALUES(@CharName16, @UniqueName);
        ';

        DB::connection('log')->unprepared('DROP procedure IF EXISTS _ExecUniquekilllogs');
        DB::connection('log')->unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('log')->unprepared('DROP procedure IF EXISTS _ExecUniquekilllogs');
    }
}
