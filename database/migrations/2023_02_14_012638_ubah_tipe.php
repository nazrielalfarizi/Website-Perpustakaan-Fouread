<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE guestbook MODIFY kelas ENUM("X", "XI", "XII")');
        DB::statement('ALTER TABLE guestbook MODIFY jurusan ENUM("RPL", "MM", "TKJ")');
        // Schema::table('guestbook', function (Blueprint $table) {
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guestbook', function (Blueprint $table) {
            //
        });
    }
};
