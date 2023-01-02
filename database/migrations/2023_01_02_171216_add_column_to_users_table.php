<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    //en la funciones up es lo que se realiza cuando se corre la migracion
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {    //debes colocar lo contrario en los en down que se ejecuta cuando se hace un rollback
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('username');
        });
    }
};
