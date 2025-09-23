<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = array([
            'status' => "Iniciado",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'status' => "Andamento",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'status' => "Finalizado",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'status' => "Interrompido",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'status' => "Trote",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'status' => "Repasse de Informação",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'status' => "Trote com Deslocamento",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        DB::table('statuses')->insert($status);
    }
}
