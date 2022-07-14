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
            $table->string('account_number')->default('');
            $table->string('otp')->default('');
            $table->string('longitude')->default('');
            $table->string('latitude')->default('');
            $table->string('description')->default('');
            $table->string('amount')->default('');
            $table->string('transaction_date')->default('');
            $table->string('transaction_time')->default('');
            $table->string('status')->default('');
            $table->string('ip_address')->default('');
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
        Schema::dropIfExists('transactions');
    }
}
