<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string("emergency_type");
            $table->integer('emergency_id')->unsigned()->constrained()->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->foreign('emergency_id')->references('id')->on('emergencies');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency_types');
    }
}
