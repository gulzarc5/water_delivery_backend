<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->double('payable_amount',10,2)->default(0);
            $table->double('total_amount',10,2)->default(0);
            $table->double('coins_used',10,2)->default(0);
            $table->double('discount',10,2)->default(0);
            $table->char('payment_type',1)->comment('1=online,2=offline')->default(2);
            $table->char('payment_status',1)->comment('1=pending,2=failed,3=paid')->default(2);
            $table->date('delivery_schedule_date')->nullable();
            $table->string('delivery_schedule',45)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
