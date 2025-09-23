<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsSupportStartCommunicationOnSheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheets', function (Blueprint $table) { 
            
            $table->text('support_transport_start_usa')->after('support_transport_conductor_usb')->nullable();
            $table->text('support_transport_start_usb')->after('support_transport_conductor_usb')->nullable();
            $table->text('support_transport_start_motolancia')->after('support_transport_conductor_usb')->nullable();
           
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
            $table->dropColumn(
                'support_transport_start_usa',
                'support_transport_start_usb',
                'support_transport_start_motolancia',
            );
        });
    }
}
