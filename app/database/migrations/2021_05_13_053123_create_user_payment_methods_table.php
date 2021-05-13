<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');
            $table->string('account_label');
            
            // $table->unsignedBigInteger('user_id');
            $table->foreignId('user_id')->constrained('users');

            // $table->unsignedBigInteger('payment_method_id');
            $table->foreignId('payment_method_id')->constrained('payment_methods');

            $table->enum('status', ['active','inactive'])->default('active');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_payment_methods');
    }
}
