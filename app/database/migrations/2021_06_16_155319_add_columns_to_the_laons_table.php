<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTheLaonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
               
            $table->decimal('loan_currency_rate',16,5)->nullable()->after('loan_amount');
           $table->unsignedBigInteger('loan_opening_id')->nullable()->after('loan_id');
            $table->enum('request_type',['opening','closing'])->default('opening')->after('status');
            $table->string('crypto_wallet_address')->nullable()->after('request_type');

              $table->foreign('loan_opening_id')->references('id')->on('loans')
            ->onDelete('cascade')
            ->onUpdate('no action');
            

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
            $table->dropColumn('loan_currency_rate');
            $table->dropColumn('request_type');
            $table->dropColumn('loan_opening_id');
            $table->dropColumn('crypto_wallet_address');
            

        });
    }
}
