<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedByToSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheets', function (Blueprint $table) {
            $table->string('deleted_by_id')->nullable();
            $table->string('deleted_by_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sheets', function (Blueprint $table) {
            $table->dropColumn('deleted_by_id');
            $table->dropColumn('deleted_by_name');
        });
    }
}
