<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name',45)->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->bigInteger('duration')->default(1)->comment('duration in days');
            $table->char('type',1)->comment('1 = by duration, 2 = by refil');
            $table->char('status',1)->comment('1 = enable, 2 = disable');
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
        Schema::dropIfExists('subscription_plans');
    }
}
