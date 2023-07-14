<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{


    public function up()
    {
        Schema::table('tu_tabla', function (Blueprint $table) {
            DB::statement('ALTER TABLE habilidades MODIFY imagen LONGBLOB');
        });
    }

    public function down()
    {
        Schema::table('tu_tabla', function (Blueprint $table) {
            DB::statement('ALTER TABLE habilidades MODIFY imagen BLOB');
        });
    }
};
