<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCoinHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_coin_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_coin_id');
            $table->char('type',1)->comment('1 = debit, 2 = credit')->nullable();
            $table->double('coin')->default(0);
            $table->double('total_coin')->default(0);
            $table->tinyText('comment')->nullable();
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
        Schema::dropIfExists('user_coin_histories');
    }
}
