<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumnNfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_adds', function (Blueprint $table) {
            $table->string('nf')->nullable();
            $table->string('batch')->nullable();
            $table->unsignedBigInteger('quantity_used')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_adds', function (Blueprint $table) {
            $table->dropColumn('nf');
            $table->dropColumn('batch');
            $table->dropColumn('quantity_used');
        });
    }
}
