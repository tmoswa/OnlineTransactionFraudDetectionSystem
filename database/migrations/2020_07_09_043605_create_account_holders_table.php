<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_holders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('account_number')->default('');
            $table->string('account_type')->default('');
            $table->string('national_id')->default('');
            $table->string('email')->default('');
            $table->string('secret')->default('');
            $table->string('pin_code')->default('');
            $table->string('one_time_password')->default('');
            $table->string('spending_category')->default('');
            $table->string('longitude')->default('');
            $table->string('latitude')->default('');
            $table->string('status')->default('');
            $table->string('balance')->default('');
            $table->string('country')->default('');
            $table->string('phone_number')->default('');
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
        Schema::dropIfExists('account_holders');
    }
}
