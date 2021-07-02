<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRepayDateToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->timestamp('repay_date')->nullable()->after('loan_repayment_amount');
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
            $table->dropColumn('repay_date');
        });
    }
}
