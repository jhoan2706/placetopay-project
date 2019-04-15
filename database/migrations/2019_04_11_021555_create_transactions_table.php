<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('transaction_id')->nullable();
            $table->string('reference', 32)->nullable();
            $table->string('description')->nullable();
            $table->double('amount', 10, 2)->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('response_date')->nullable();
            $table->string('response_authorization', 100)->nullable();
            $table->string('response_message')->nullable();
            $table->string('response_reason', 3)->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
