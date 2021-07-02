<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusValueToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('loans', 'status') && Schema::hasColumn('loans', 'price_down_percentage'))
        {
           
           Schema::table('loans', function (Blueprint $table) {
         
             $table->dropColumn('status');

             $table->dropColumn('price_down_percentage');

            
              });

        }

          Schema::table('loans', function (Blueprint $table) {

             $table->enum('status',['pending','approved','repay_in_progress','repaid','close','liquidate','rejected','expired'])->default('pending')->after('interest_value');

             $table->decimal('price_down_value',16,5)->after('interest_value')->nullable();

          


          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('loans', 'status') && Schema::hasColumn('loans', 'price_down_percentage'))
        {
           
           Schema::table('loans', function (Blueprint $table) {
          
             $table->dropColumn('status');
             $table->dropColumn('price_down_percentage');


            
              });

          }
    }
}
