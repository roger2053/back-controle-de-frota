<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->increments("protocol");

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')->references('id')->on('users');

            $table->integer('emergency_id')->unsigned()->nullable();
            $table->foreign('emergency_id')->references('id')->on('emergencies');

            $table->integer('emergency_type_id')->unsigned()->nullable();
            $table->foreign('emergency_type_id')->references('id')->on('emergency_types');

            $table->integer('severity_id')->unsigned()->nullable();
            $table->foreign('severity_id')->references('id')->on('severities');

            $table->integer('hospital_id')->unsigned()->nullable();
            $table->foreign('hospital_id')->references('id')->on('hospitals');

            $table->integer('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->text('requester_name')->nullable(); // nome do solicitante
            $table->text('requester_contact')->nullable(); // telefone do solicitante
            $table->integer('count_victims')->nullable();
            $table->longText('complaint')->nullable(); // queixa do paciente
            $table->text('duration')->nullable();
            $table->text('diagnostic_hypothesis')->nullable();
            $table->text('conduct')->nullable();
            $table->text('how_much_time')->nullable();
            $table->longText('remedy_consult')->nullable();
            $table->longText('observations')->nullable();

            // Pacient
            $table->text('patient_name')->nullable();
            $table->text('patient_contact')->nullable();
            $table->text('patient_age')->nullable();
            $table->text('patient_gender')->nullable();
            $table->boolean('patient_aggressive')->default(false)->nullable();
            $table->text('patient_acute_pain')->nullable();
            $table->text('patient_estate')->nullable(); // Situação do paciente
            $table->text('patient_blood_pressure')->nullable(); // Pressão Arterial
            $table->text('patient_heart_rate')->nullable(); // Frequência Cardiaca
            $table->text('patient_respiratory_frequency')->nullable(); // Frequência Respiratória
            $table->text('patient_oxigen_saturation')->nullable();  // Saturação do Oxigênio
            $table->text('patient_pulse')->nullable(); // Pulsos
            $table->text('patient_hgt')->nullable();
            $table->text('patient_others')->nullable();
            $table->text('patient_cep')->nullable();
            $table->text('patient_address')->nullable();
            $table->text('patient_number')->nullable();
            $table->text('patient_district')->nullable();

            $table->integer('patient_city')->unsigned()->nullable();
            $table->foreign('patient_city')->references('id')->on('cities');

            $table->text('patient_state')->nullable();
            $table->text('patient_reference_point')->nullable();

            $table->string('patient_locale')->nullable();


            // $table->integer('patient_locale')->unsigned()->nullable();
            // $table->foreign('patient_locale')->references('id')->on('locales');


            // Transfer
            $table->text('transfer_code')->nullable();

            $table->integer('transfer_origin')->unsigned()->nullable();
            $table->foreign('transfer_origin')->references('id')->on('hospitals');

            $table->integer('transfer_destiny')->unsigned()->nullable();
            $table->foreign('transfer_destiny')->references('id')->on('hospitals');

            $table->integer('transfer_used_transport')->unsigned()->nullable();
            $table->foreign('transfer_used_transport')->references('id')->on('transports');

            $table->boolean('transfer_inner_transport')->nullable();

            // Used Transports

            $table->integer('used_transport')->unsigned()->nullable();
            $table->foreign('used_transport')->references('id')->on('transports'); // Transporte utilizado

            $table->integer('used_transport_team')->unsigned()->nullable();
            $table->foreign('used_transport_team')->references('id')->on('teams'); // Equipe

            $table->text('used_transport_comunication')->nullable(); // Comunicação
            $table->text('used_transport_start')->nullable(); // Partida

            // Transports
            $table->text('transport_plate')->nullable();
            $table->text('transport_driver')->nullable();
            $table->text('transport_driver_phone')->nullable();
            $table->text('transport_driver_observation')->nullable();
            $table->text('transport_comunication')->nullable(); // Comunicação
            $table->float('transport_km_start')->default(0.0)->nullable();
            $table->float('transport_km_end')->default(0.0)->nullable();
            $table->timestamp('transport_driver_at')->nullable();
            $table->timestamp('transport_pacient_at')->nullable();


            $table->text('used_transport_return')->nullable();
            $table->text('transport_plate_return')->nullable();
            $table->text('transport_driver_return')->nullable();
            $table->text('transport_driver_phone_return')->nullable();
            $table->text('transport_comunication_return')->nullable(); // Comunicação
            $table->float('transport_km_start_return')->default(0.0)->nullable();
            $table->float('transport_km_end_return')->default(0.0)->nullable();
            $table->timestamp('transport_driver_at_return')->nullable();
            $table->timestamp('transport_pacient_at_return')->nullable();
            $table->integer('used_transport_team_return')->unsigned()->nullable();


            $table->text('transport_local')->nullable();
            $table->text('transport_origin')->nullable();
            $table->text('transport_destination')->nullable();
            $table->text('transport_return')->nullable();
            $table->text('transport_base')->nullable();
            $table->text('transport_doctor')->nullable();
            $table->text('transport_nurse')->nullable();
            $table->text('transport_technical')->nullable();
            $table->text('transport_tarm')->nullable();
            $table->text('transport_radio_operator')->nullable();
            $table->text('transport_conductor')->nullable();
            $table->text('transport_drive_ambulance')->nullable();
            $table->text('transport_difficult_access')->nullable();
            $table->text('transport_other_situations')->nullable();

            // USA
            $table->boolean('support_transport_usa')->nullable();
            $table->text('support_transport_communication_usa')->nullable();
            $table->text('support_transport_place_usa')->nullable();
            $table->text('support_transport_departure_usa')->nullable();
            $table->text('support_transport_departure_from_location_usa')->nullable();
            $table->text('support_transport_destination_usa')->nullable();
            $table->text('support_transport_return_usa')->nullable();
            $table->text('support_transport_base_usa')->nullable();
            $table->text('support_transport_doctor_usa')->nullable();
            $table->text('support_transport_nurse_usa')->nullable();
            $table->text('support_transport_technical_usa')->nullable();
            $table->text('support_transport_tarm_usa')->nullable();
            $table->text('support_transport_radio_operator_usa')->nullable();
            $table->text('support_transport_conductor_usa')->nullable();
            $table->longText('support_transport_other_situations_usa')->nullable();

            // USB
            $table->boolean('support_transport_usb')->nullable();
            $table->text('support_transport_communication_usb')->nullable();
            $table->text('support_transport_place_usb')->nullable();
            $table->text('support_transport_departure_usb')->nullable();
            $table->text('support_transport_departure_from_location_usb')->nullable();
            $table->text('support_transport_destination_usb')->nullable();
            $table->text('support_transport_return_usb')->nullable();
            $table->text('support_transport_base_usb')->nullable();
            $table->text('support_transport_doctor_usb')->nullable();
            $table->text('support_transport_nurse_usb')->nullable();
            $table->text('support_transport_technical_usb')->nullable();
            $table->text('support_transport_tarm_usb')->nullable();
            $table->text('support_transport_radio_operator_usb')->nullable();
            $table->text('support_transport_conductor_usb')->nullable();
            $table->longText('support_transport_other_situations_usb')->nullable();

            // Motolancia
            $table->boolean('support_transport_motolancia')->nullable();
            $table->text('support_transport_communication_motolancia')->nullable();
            $table->text('support_transport_place_motolancia')->nullable();
            $table->text('support_transport_departure_motolancia')->nullable();
            $table->text('support_transport_departure_from_location_motolancia')->nullable();
            $table->text('support_transport_destination_motolancia')->nullable();
            $table->text('support_transport_return_motolancia')->nullable();
            $table->text('support_transport_base_motolancia')->nullable();
            $table->text('support_transport_doctor_motolancia')->nullable();
            $table->text('support_transport_nurse_motolancia')->nullable();
            $table->text('support_transport_technical_motolancia')->nullable();
            $table->text('support_transport_tarm_motolancia')->nullable();
            $table->text('support_transport_radio_operator_motolancia')->nullable();
            $table->text('support_transport_conductor_motolancia')->nullable();
            $table->longText('support_transport_other_situations_motolancia')->nullable();

            // Glasgow
            $table->integer('eye_opening')->nullable();
            $table->integer('verbal_response')->nullable();
            $table->integer('motor_response')->nullable();

            // Support
            $table->boolean('support_fireplace')->nullable();
            $table->boolean('support_military_police')->nullable();

            // Trauma
            $table->text('trauma_mechanism_trauma')->nullable();
            $table->text('trauma_count_victims')->nullable();
            $table->text('trauma_burned_body_surface')->nullable();
            $table->text('trauma_others')->nullable();

            // Pregnant
            $table->text('pregnant_gestational_age')->nullable();
            $table->text('pregnant_parity')->nullable();
            $table->text('pregnant_single_pregnancy')->nullable();
            $table->text('pregnant_pa')->nullable();
            $table->text('pregnant_bcf')->nullable();
            $table->text('pregnant_womb_dynamic')->nullable();
            $table->text('pregnant_fetal_movement')->nullable();
            $table->text('pregnant_vaginal_touch')->nullable();

            // Incident
            $table->boolean('incident_canceled')->nullable();
            $table->boolean('incident_outside')->nullable();
            $table->boolean('incident_removed_third_party')->nullable();
            $table->boolean('incident_death_in_transport')->nullable();
            $table->boolean('incident_death_in_place')->nullable();
            $table->boolean('incident_refused_service')->nullable();
            $table->boolean('incident_refused_hospitalization')->nullable();
            $table->longText('another_details')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        // DB::statement("ALTER TABLE sheets AUTO_INCREMENT = 152400;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sheets');
    }
}
