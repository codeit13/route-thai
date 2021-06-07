<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoanTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_terms', function (Blueprint $table) {
            $table->id();
            $table->decimal('terms_percentage',16,2);
            $table->integer('no_of_duration');
            $table->enum('duration_type', ['days','month',"year"])->default('days');
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
        Schema::dropIfExists('loan_terms');
    }
}
