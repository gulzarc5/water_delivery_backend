<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('size_id');
            $table->double('mrp',10,2)->default(0);
            $table->double('price',10,2)->default(0);
            $table->double('product_discount',10,2)->default(0);
            $table->integer('coint_use')->default(0);
            $table->integer('coint_generate')->default(0);
            $table->char('jar_available_status',1)->default(1)->comment('1=yes,2=no');
            $table->double('jar_mrp',10,2)->default(0);
            $table->double('jar_price',10,2)->default(0);
            $table->double('jar_discount',10,2)->default(0);
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
        Schema::dropIfExists('product_sizes');
    }
}
