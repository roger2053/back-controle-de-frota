<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GasPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $points = [
            [
                'name' => 'Posto Avenida',
                'district' => 'Centro',
                'street' => 'Av. Vereador Osvaldo Campos',
                'number' => '630',
                'complement' => '',
                'city' => 'Itiúba',
                'state' => 'BA',
                'phone' => '(74) 99194-1075',
            ],

        ];

        DB::table('gas_points')->insert($points);
    }
}
