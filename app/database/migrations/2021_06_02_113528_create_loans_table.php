<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->unsignedBigInteger('admin_id')->nullable();

            $table->unsignedBigInteger('currency_id');

             $table->decimal('collateral_amount',16,5);

            $table->unsignedBigInteger('fiat_currency_id');

            $table->decimal('fiat_amount',16,2);


            $table->unsignedBigInteger('term_id');

            $table->unsignedBigInteger('price_down_id');

            $table->boolean('on_wallet')->nullable();

            $table->decimal('collateral_currency_rate',16,5);
        
            $table->decimal('loan_repayment_amount',16,5);

            $table->boolean('has_close_price')->nullable();

            $table->decimal('close_price',16,5)->nullable();

            $table->boolean('is_agree')->nullable();

            $table->enum('status',['pending','approved','paid','close'])->default('pending');





            $table->timestamps();

              $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
