<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRepayRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_repay_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_opening_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('currency_id');
             $table->decimal('collateral_amount',16,5);
               $table->unsignedBigInteger('loan_currency_id');

            $table->decimal('loan_amount',16,2);

            $table->decimal('loan_repayment_amount',16,2);

            $table->string('crypto_wallet_address')->nullable();
            


            $table->enum('status',['pending','approved','rejected','close','auto_close'])->default('pending');

            

           
            $table->timestamps();

                 $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('set null');

            $table->foreign('loan_opening_id')->references('id')->on('loans')
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
        Schema::dropIfExists('loan_repay_requests');
    }
}
