<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLoanRepayRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_repay_requests', function (Blueprint $table) {
            $table->enum('collateral_method',['wallet','crypto_address'])->after('loan_repayment_amount')->nullable();
            $table->boolean('on_wallet')->after('loan_repayment_amount')->nullable();
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
            $table->dropColumn('collateral_method');
            $table->dropColumn('on_wallet');
            
        });
    }
}
