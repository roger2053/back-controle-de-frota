<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumnObsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_withdrawns', function (Blueprint $table) {
            $table->text('obs')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_withdrawns', function (Blueprint $table) {
            $table->dropColumn('obs'); // Defina o valor padrão conforme necessário

        });
    }
}
