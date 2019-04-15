<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->unsignedInteger('document_type_id');
            $table->string('document', 12);
            $table->string('name', 60);
            $table->string('last_name', 60)->nullable();
            $table->string('company', 60)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('postal_code', 25)->nullable();
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('country', 2);
            $table->string('phone', 30)->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();       
            $table->timestamps();
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
