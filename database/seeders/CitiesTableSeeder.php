<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = array(
            // [
            //     'city' => "Senhor do Bonfim",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
            // [
            //     'city' => "Pindobaçu",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
            // [
            //     'city' => "Campo Formoso",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
            // [
            //     'city' => "Ponto Novo",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
            [
                'city' => "Itiuba",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],
            // [
            //     'city' => "Jaguarari",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
            // [
            //     'city' => "Andorinha",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
            // [
            //     'city' => "Antonio Gonçalves",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
            // [
            //     'city' => "Filadelfia",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
            // [
            //     'city' => "Pilar",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
            // [
            //     'city' => "Serra da Carnaíba",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'deleted_at' => null
            // ],
        );

        DB::table('cities')->insert($cities);
    }
}
