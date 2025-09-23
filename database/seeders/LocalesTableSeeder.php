<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = array([
            'locale' => "UPA",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'locale' => "CAPS",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'locale' => "USF",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'locale' => "UBS",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'locale' => "Clínicas",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'locale' => "Hospital",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'locale' => "Domicílio",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'locale' => "Via Pública",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'locale' => "Estab. Comercial/Ensino",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'locale' => "Órgão Público",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        DB::table('locales')->insert($locales);
    }
}
