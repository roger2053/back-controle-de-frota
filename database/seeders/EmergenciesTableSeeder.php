<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmergenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emergencies = array([
            'emergency' => "Traumático",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency' => "Caso Clínico",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency' => "Obstétrico",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency' => "Psiquiátrico",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency' => "Abuso Sexual",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency' => "Violência Doméstica",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency' => "Orientação",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'emergency' => "Não sabe",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        DB::table('emergencies')->insert($emergencies);
    }
}
