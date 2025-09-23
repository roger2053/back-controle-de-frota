<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgeGroupToVictimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('victims', function (Blueprint $table) {
            $table->string('age_group', 10)->nullable()->after("contact");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('victims', function (Blueprint $table) {
            $table->dropColumn('age_group');
        });
    }
}
