<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = array([
            'team' => "Equipe 01",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'team' => "Equipe 02",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'team' => "Equipe 03",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        DB::table('teams')->insert($teams);
    }
}
