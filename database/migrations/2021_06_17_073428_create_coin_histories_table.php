<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_coins_id');
            $table->double('coins',10,2)->default(0);
            $table->double('total_coins',10,2)->default(0);
            $table->text('comment',1000)->nullable();
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
        Schema::dropIfExists('coin_histories');
    }
}
