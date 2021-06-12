<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_username_updated')->default(0);
            $table->integer('default_currency')->nullable();
            $table->integer('default_language')->nullable();
            $table->boolean('sms_notification')->default(0);
            $table->boolean('line_notification')->default(0);
            $table->string('line_number')->nullable();
            $table->string('line_user_id')->nullable();
            $table->boolean('telegram_notification')->default(0);
            $table->string('telegram_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
