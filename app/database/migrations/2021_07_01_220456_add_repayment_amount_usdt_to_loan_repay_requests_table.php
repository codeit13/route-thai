<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepaymentAmountUsdtToLoanRepayRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_repay_requests', function (Blueprint $table) {
            $table->decimal('loan_currency_rate',16,5)->after('loan_currency_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_repay_requests', function (Blueprint $table) {
            $table->dropColumn('loan_currency_rate');
        });
    }
}
