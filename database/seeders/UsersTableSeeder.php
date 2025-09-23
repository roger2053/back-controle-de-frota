<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            [
                'name' => "Administrador do Sistema",
                "contact" => null,
                "is_whatsapp" => false,
                'email' => "admin@encode.dev.br",
                "crm" => null,
                "tarm" => null,
                "service_base" => null,
                'profile_id' => 1,
                'password' => Hash::make("admin"),
                'token' => MakeJwt([
                    'data' => [
                        'iss' => 'samulife',
                        'name' => "Administrador do Sistema",
                        'email' => "admin@encode.dev.br"
                    ]
                ]),
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        DB::table('users')->insert($users);
    }
}
