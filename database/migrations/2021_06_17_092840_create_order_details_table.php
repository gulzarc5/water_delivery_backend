<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->char('type',1)->nullable();
            $table->double('mrp',10,2)->default(0);
            $table->double('price',10,2)->default(0);
            $table->integer('size_id');
            $table->integer('brand_id');
            $table->integer('coin_used')->nullable();
            $table->integer('coin_generated')->nullable();
            $table->char('order_status')->nullable();
            $table->date('cancelled_date')->nullable();
            $table->text('remarks',1000)->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
