<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsdtLoanAmountColumnToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
           $table->decimal('repay_amount_usdt',16,5)->nullable()->after('loan_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('repay_amount_usdt');
        });
    }
}
