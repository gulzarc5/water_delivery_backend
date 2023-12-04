<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name',256);
            $table->string('email',256)->nullable();
            $table->string('mobile',256)->nullable();
            $table->integer('otp',6)->nullable();
            $table->string('api_token',256)->nullable();
            $table->char('gender',1)->comment('M=Male,F=Female')->nullable();
            $table->string('lat',256)->nullable();
            $table->string('long',256)->nullable();
            $table->bigInteger('address_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
