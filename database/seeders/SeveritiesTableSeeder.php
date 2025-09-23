<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeveritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $severities = array([
            'severity' => "Sem Risco",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'severity' => "Médio",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'severity' => "Grave",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        DB::table('severities')->insert($severities);
    }
}
