<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRepayCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_repay_currency', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id');
            $table->string('crypto_wallet_address');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currency')
            ->onDelete('cascade')
            ->onUpdate('no action');
            $table->foreign('updated_by')->references('id')->on('admin')
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
        Schema::dropIfExists('loan_repay_currency');
    }
}
