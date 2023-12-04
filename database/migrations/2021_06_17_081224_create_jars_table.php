<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jars', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('size_id');
            $table->double('mrp',10,2)->default(0);
            $table->double('price',10,2)->default(0);
            $table->char('status',1)->comment('1=enable,2=disable')->default(1);
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
        Schema::dropIfExists('jars');
    }
}
