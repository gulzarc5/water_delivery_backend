<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon',20)->nullable();
            $table->text('description')->nullable();
            $table->string('image',256)->nullable();
            $table->double('discount',10,2)->default(0);
            $table->char('user_type',1)->default(1)->comment('1=new,2=old');
            $table->char('status',1)->default(1)->comment('1=enable,2=disable');
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
        Schema::dropIfExists('coupons');
    }
}
