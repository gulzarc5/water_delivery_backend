<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('house_no',256)->nullable();
            $table->string('flat_no',256)->nullable();
            $table->string('address_one',500)->nullable();
            $table->string('address_two',500)->nullable();
            $table->string('landmark',500)->nullable();
            $table->string('name',256)->nullable();
            $table->string('mobile',15)->nullable();
            $table->string('lat',256)->nullable();
            $table->string('long',256)->nullable();
            $table->char('status',1)->comment('1=New Address,2=Permanent Address')->nullable();
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
        Schema::dropIfExists('addresses');
    }
}
