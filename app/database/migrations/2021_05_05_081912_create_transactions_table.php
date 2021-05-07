<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->char('trans_id',16)->nullable();
            $table->unsignedBigInteger('currency_id');

            $table->boolean('type');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->decimal('balance_before_trans',16,8)->nullable();
            $table->decimal('trans_amount',16,8)->nullable();

         

            $table->enum('status', ['approved','rejected', 'pending'])->default('pending');

            $table->timestamps();

              $table->foreign('currency_id')->references('id')->on('currency')
            ->onDelete('cascade')
            ->onUpdate('no action');

             $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('transactions');
    }
}
