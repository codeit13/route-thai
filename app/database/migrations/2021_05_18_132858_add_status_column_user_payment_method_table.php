<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnUserPaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_payment_methods', function (Blueprint $table) {
            $table->string('qr-code')->nullable();
            $table->enum('type',['current','saving'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_payment_methods', function (Blueprint $table) {
            //
        });
    }
}
