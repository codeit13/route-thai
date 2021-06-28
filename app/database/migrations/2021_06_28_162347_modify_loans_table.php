<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('loans', 'request_type') && Schema::hasColumn('loans', 'loan_opening_id') && Schema::hasColumn('loans', 'status'))
        {
           
           Schema::table('loans', function (Blueprint $table) {
             $table->dropColumn('request_type');
             $table->dropForeign('loans_loan_opening_id_foreign');
             $table->dropColumn('loan_opening_id');
             $table->dropColumn('status');

            
              });

        }

          Schema::table('loans', function (Blueprint $table) {

             $table->enum('status',['pending','approved','paid','repaid','close','liquidate','rejected'])->default('pending')->after('price_down_percentage');

             $table->enum('liquidation_type',['close_price','price_down','repay_date'])->after('status')->nullable();


          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       if (Schema::hasColumn('loans', 'status') && Schema::hasColumn('loans', 'liquidation_type'))
        {
           
           Schema::table('loans', function (Blueprint $table) {
             $table->dropColumn('liquidation_type');
             $table->dropColumn('status');

            
              });

          }

    }
}
