<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddMoreEmergencyTypes extends Seeder
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
            'emergency_type' => "Acidentes Inespecíficos",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 1,
            'emergency_type' => "Choque Elétrico",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 1,
            'emergency_type' => "Fratura",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 1,
            'emergency_type' => "Queda da Própria Altura",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 1,
            'emergency_type' => "Queda Bicicleta/Cavalo",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 4,
            'emergency_type' => "Crise de Ansiedade",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 4,
            'emergency_type' => "Depressão",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 4,
            'emergency_type' => "Psicose Puerperal",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 4,
            'emergency_type' => "Surto Psicótico",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 4,
            'emergency_type' => "Uso de Drogas",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 3,
            'emergency_type' => "Gestante com Dor",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 3,
            'emergency_type' => "Perda de Líquido",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 6,
            'emergency_type' => "Violência Doméstica",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 5,
            'emergency_type' => "Abuso Sexual",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Sinais e Sint. Cardíacos",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Agravos Cardíacos",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Sinais e Sint. Circulatórios",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Agravos Circulatórios",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => "2",
            'emergency_type' => "Sinais e Sint. Digestivos",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Agravos Digestivos",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => "2",
            'emergency_type' => "Sinais e Sint. Neurológicos",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Agravos Neurológicos",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => "2",
            'emergency_type' => "Sinais e Sint. Respiratórios",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Agravos Respiratórios",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => "2",
            'emergency_type' => "Sinais e Sint. Urinários",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Agravos Urinários",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Acamado",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Dores em Geral",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Febre/Calafrio",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Fraqueza/Cansaço",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Hipotensão",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Fraqueza/Cansaço",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Mal estar Inespecífico",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Fraqueza/Cansaço",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Neoplasias",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Quadros Hemorrágicos",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Quadros Infecciosos/Sespe",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Tontura",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Tremores/Sudorese",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Tontura",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
        [
            'emergency_id' => 2,
            'emergency_type' => "Procedimentos",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],
    );

        DB::table('emergency_types')->insert($emergency_types);
    }
}
