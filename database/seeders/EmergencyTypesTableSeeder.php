<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmergencyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emergency_types = array([
            'emergency_id' => 1,
            'emergency_type' => "Acidente de Carro",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "Acidente de Moto",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "Choque",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "Queda de Altura",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "Atropelamento",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "FAB",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "FAF",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "Agressão/Espancamento",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "TCE",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "Queimadura",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "Suicídio/Tentativa",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "Afogamento",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 1,
            'emergency_type' => "Outros",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Convulsão",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Dor Abdominal",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Crise Asmática/Dispnéia",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "AVC",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Hipo/Hiperglicemia/DM",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Perda de Consciência/Desmaio",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Hemorragia digestiva alta/baixa",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Intoxicações Exógenas",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Dor Toráxica",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "IAM",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "ICC",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Crise Hipertensiva",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Vômito/Diarréia/Desidratação",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Alcoolismo",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "RN Complicações ao Nascimento",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "COVID19",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Suspeita de COVID19",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Sistomas Gripais",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 2,
            'emergency_type' => "Outros",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 3,
            'emergency_type' => "Trabalho de Parto",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 3,
            'emergency_type' => "Eclâmpsia/Pré",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 3,
            'emergency_type' => "Aborto",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 3,
            'emergency_type' => "Parto Prematuro",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 3,
            'emergency_type' => "Sangramento vaginal",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 3,
            'emergency_type' => "Outros",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 4,
            'emergency_type' => "Uso de Drogas",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 4,
            'emergency_type' => "Urgência Psiquiátrica",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency_id' => 4,
            'emergency_type' => "Outros",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        DB::table('emergency_types')->insert($emergency_types);
    }
}
