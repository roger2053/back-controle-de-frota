<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transports = array([
            'transport' => "MOTOLÂNCIA 01",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ],[
            'transport' => "MOTOLÂNCIA 02",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        DB::table('transports')->insert($transports);

        for ($i=1; $i <= 5; $i++) { 

            $transports = array([
                'transport' => "USA 0$i",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ]);
    
            DB::table('transports')->insert($transports);

        }

        for ($i=1; $i <= 15; $i++) { 

            if ($i < 10) {
                $transports = array([
                    'transport' => "USB 0$i",
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ]);
            } else {
                $transports = array([
                    'transport' => "USB $i",
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ]);
            }
    
            DB::table('transports')->insert($transports);

        }

        $transports = array([
            'transport' => "USB 01 - RT",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        DB::table('transports')->insert($transports);

    }
}
