<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVictimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('victims', function (Blueprint $table) {
            $table->id();

            $table->text('name')->nullable();
            $table->longText('complaint')->nullable();
            $table->longText('complaint_medical')->nullable();
            $table->string('contact')->nullable();
            $table->string('age', 10)->nullable();
            $table->string('gender', 15)->nullable();
            $table->boolean('is_month')->default(0)->nullable();
            $table->text('address')->nullable();
            $table->string('address_number', 10)->nullable();
            $table->string('address_district')->nullable();
            $table->text('address_reference_point')->nullable();
            $table->text('address_city')->nullable();
            $table->text('duration')->nullable();
            $table->text('blood_pressure')->nullable(); // Pressão Arterial
            $table->text('heart_rate')->nullable(); // Frequência Cardiaca
            $table->text('respiratory_frequency')->nullable(); // Frequência Respiratória
            $table->text('oxigen_saturation')->nullable();  // Saturação do Oxigênio
            $table->text('pulse')->nullable(); // Pulsos
            $table->text('hgt')->nullable();
            $table->text('others')->nullable();
            $table->text('acute_pain')->nullable(); 
            $table->text('diagnostic_hypothesis')->nullable();
            $table->text('conduct')->nullable();
            $table->text('how_much_time')->nullable();
            $table->text('estate')->nullable(); // Situação do paciente
            $table->longText('remedy_consult')->nullable();
            $table->longText('observations')->nullable();
            $table->text('pregnant_gestational_age')->nullable();
            $table->text('pregnant_parity')->nullable();
            $table->text('pregnant_single_pregnancy')->nullable();
            $table->text('pregnant_pa')->nullable();
            $table->text('pregnant_bcf')->nullable();
            $table->text('pregnant_womb_dynamic')->nullable();
            $table->text('pregnant_fetal_movement')->nullable();
            $table->text('pregnant_vaginal_touch')->nullable();
            $table->integer('eye_opening')->nullable();
            $table->integer('verbal_response')->nullable();
            $table->integer('motor_response')->nullable();
            $table->longText('evolution')->nullable();

            $table->integer('emergency_id')->unsigned()->nullable();
            $table->foreign('emergency_id')->references('id')->on('emergencies');

            $table->integer('emergency_type_id')->unsigned()->nullable();
            $table->foreign('emergency_type_id')->references('id')->on('emergency_types');

            $table->integer('severity_id')->unsigned()->nullable();
            $table->foreign('severity_id')->references('id')->on('severities');

            $table->integer('sheet_protocol')->unsigned()->nullable();
            $table->foreign('sheet_protocol')->references('protocol')->on('sheets');

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
        Schema::dropIfExists('victims');
    }
}
