<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForignKeyOnTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         Schema::table('transactions', function (Blueprint $table) { 
             $table->dropForeign(['fiat_currency_id']);
            $table->dropColumn('fiat_currency_id');
        });

         Schema::table('transactions', function (Blueprint $table) { 
            $table->unsignedBigInteger('fiat_currency_id')->nullable();

             $table->foreign('fiat_currency_id')->references('id')->on('currency')
            ->onDelete('cascade')
            ->onUpdate('set null');

            //  $table->foreign('user_payment_method_id')->references('id')->on('user_payment_methods')
            // ->onDelete('cascade')
            // ->onUpdate('set null');
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
