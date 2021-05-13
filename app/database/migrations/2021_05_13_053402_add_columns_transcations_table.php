<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTranscationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) { 
            $table->unsignedTinyInteger('timer')->nullable();
            $table->integer('quantity')->nullable();

            // $table->unsignedBigInteger('user_payment_method_id');
            $table->foreignId('user_payment_method_id')->constrained('user_payment_methods');
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
