<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToLoanRepayCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_repay_currency', function (Blueprint $table) {
            $table->string('crypto_wallet_memo')->nullable()->after('crypto_wallet_address');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_repay_currency', function (Blueprint $table) {
            $table->dropColumn('crypto_wallet_memo');
        });
    }
}
