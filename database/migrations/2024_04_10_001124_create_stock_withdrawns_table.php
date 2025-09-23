<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockWithdrawnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_withdrawns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('destination_id');
            $table->string('cpf',11);
            $table->string('name');
            $table->integer('quantity_before')->default(0);
            $table->integer('quantity_updated')->default(0);
            $table->integer('quantity_withdrawn')->default(0);
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('stock_withdrawns');
    }
}
