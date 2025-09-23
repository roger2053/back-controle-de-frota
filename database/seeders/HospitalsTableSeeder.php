<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hospitals = array([
            'name' => "Hospital Regional Sr. Do Bonfim",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Regional de Juazeiro",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Pro Matre (Juazeiro)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "SOTE (Juazeiro)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital da Criança (Juaz)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "H. Materno Infantil de Juazeiro",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Dom Malan",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital do Trauma",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Neurocárdio",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Memorial",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital da Criança (FSA)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Geral do Estado (SSA)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Couto Maia (SSA)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Santa Isabel (SSA)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Roberto Santos (SSA)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Do Subúrbio (SSA)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Santo Antonio (SSA)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "H. Reg. Fernando Bezerra (OURICURI)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "H. Reg. Inácio de Sá (SALGUEIRO)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Nossa Senhora de Fátima (Ponto Novo)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital São Sebastião (Filadélfia)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Edgar Santos  (Pindobaçu)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Municipal de Itiúba (Itiúba)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "UBS Andorinha (Andorinha)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital São Franscisco (Campo Formoso)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Municipal de Jaguarari (Jaguarari)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "UPA",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Outros",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Hospital Psiquiátrico Nossa Senhora de Fátima (Juazeiro)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'name' => "Sala de Estabilização (Pilar)",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        DB::table('hospitals')->insert($hospitals);
    }
}
