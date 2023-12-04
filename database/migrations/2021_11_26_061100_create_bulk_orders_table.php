<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name',256)->nullable();
            $table->string('mobile',20)->nullable();
            $table->BigInteger('brand_id')->nullable();
            $table->BigInteger('size_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('address')->nullable();
            $table->char('status')->default(1)->comment('1=New,2=Accepted,3=Processing,4=Completed');
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
        Schema::dropIfExists('bulk_orders');
    }
}
