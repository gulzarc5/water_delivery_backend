<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionOrderDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscription_order_dates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_subscription_id');
            $table->date('order_date');
            $table->char('status')->default(1)->comment('1 = pending, 2 = Ordered');
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
        Schema::dropIfExists('user_subscription_order_dates');
    }
}
