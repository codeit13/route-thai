<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {

            $table->char('loan_id',16)->nullable()->after('id');
            $table->decimal('usdt',16,5)->nullable()->after('loan_amount');
            

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
             $table->dropColumn('loan_id');
             $table->dropColumn('usdt');

        });
    }
}
