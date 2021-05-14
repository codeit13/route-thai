<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnTranscations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function(Blueprint $table)
        {
            $table->dropColumn('type');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('type', ['sell','buy','deposit','withdraw']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
