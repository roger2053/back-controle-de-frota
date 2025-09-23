<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherFieldsOnSheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheets', function (Blueprint $table) { 
            $table->text('other_transfer_origin')->after('transfer_origin')->nullable();
            $table->text('other_transfer_destiny')->after('transfer_destiny')->nullable();
            $table->text('other_hospital')->after('hospital_id')->nullable();
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
            $table->dropColumn('other_transfer_origin', 'other_transfer_destiny', 'other_hospital');
        });
    }
}
