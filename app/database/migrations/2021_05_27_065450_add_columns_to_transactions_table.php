<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTransactionsTable extends Migration
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

            
           
            $table->enum('type', ['sell','buy','deposit','withdraw','transfer']);

            $table->unsignedBigInteger('wallet_from')->nullable()->after('address');
            $table->unsignedBigInteger('wallet_to')->nullable()->after('wallet_from');

            
            
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
}
