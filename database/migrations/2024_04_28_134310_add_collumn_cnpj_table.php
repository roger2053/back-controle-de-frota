<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumnCnpjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->string('cnpj')->nullable();
            $table->string('social_reason')->nullable();
            $table->unsignedBigInteger('fantasy_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('cnpj');
            $table->dropColumn('social_reason');
            $table->dropColumn('fantasy_name');
        });
    }
}
