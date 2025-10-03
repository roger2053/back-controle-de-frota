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
        $hospitals = array(
            [
                'name' => "Hospital Municipal de Itiúba (Itiúba)",
                'type' => "hospital",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],
            [
                'name' => "Covas (PSF)",
                'type' => "psf",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],
            [
                'name' => "SAMU",
                'type' => "samu",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],
            [
                'name' => "Outros",
                'type' => "others",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ]
        );

        DB::table('hospitals')->insert($hospitals);
    }
}
