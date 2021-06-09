<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('loans', 'fiat_currency_id') && Schema::hasColumn('loans', 'fiat_amount') && Schema::hasColumn('loans', 'status') && Schema::hasColumn('loans', 'price_down_id'))
        {
           
           Schema::table('loans', function (Blueprint $table) {
             $table->dropColumn('fiat_currency_id');
             $table->dropColumn('fiat_amount');
             $table->dropColumn('status');
             $table->dropColumn('price_down_id');
              });

          }

        Schema::table('loans', function (Blueprint $table) {

            $table->unsignedBigInteger('loan_currency_id')->after('collateral_amount');

            $table->decimal('loan_amount',16,5)->after('loan_currency_id');
            $table->string('duration')->nullable()->after('loan_amount');

            $table->string('term_percentage')->nullable()->after('duration');


            $table->string('duration_type')->nullable()->after('duration');
            $table->string('min_price')->nullable()->after('duration_type');
            $table->string('max_price')->nullable()->after('min_price');
            $table->string('price_down_percentage')->nullable()->after('max_price');
             $table->string('interest_value')->nullable()->after('max_price');
            $table->enum('status',['pending','approved','paid','close','auto_close','rejected'])->default('pending')->after('price_down_percentage');




             
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
            $table->dropColumn('loan_currency_id');

            $table->dropColumn('loan_amount');
            $table->dropColumn('duration');

            $table->dropColumn('term_percentage');


            $table->dropColumn('duration_type');
            $table->dropColumn('min_price');
            $table->dropColumn('max_price');
            $table->dropColumn('price_down_percentage');
             $table->dropColumn('interest_value');
            $table->dropColumn('status');
        });
    }
}
