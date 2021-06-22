<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCollateralAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collateral_address', function (Blueprint $table) {
            $table->string('crypto_memo')->nullable()->after('crypto_wallet_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collateral_address', function (Blueprint $table) {
            
            $table->dropColumn('crypto_memo');
            
        });
    }
}
