<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'profile_name' => "Administrador",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'permissions' => '{"sheets":[{"id":2,"name":"Ver"},{"id":3,"name":"Filtrar por Per\u00edodo"},{"id":4,"name":"Ver Fichas Exclu\u00eddas"},{"id":5,"name":"Restaurar Fichas Exclu\u00eddas"},{"id":6,"name":"Gerar PDF"},{"id":7,"name":"Cadastrar"},{"id":8,"name":"Editar"},{"id":9,"name":"Editar Avalia\u00e7\u00e3o no Local da Ocorr\u00eancia"},{"id":10,"name":"Excluir"}],"reports":[{"id":12,"name":"Ver"}],"users":[{"id":14,"name":"Ver"},{"id":15,"name":"Cadastrar"},{"id":16,"name":"Editar"},{"id":17,"name":"Excluir"}]}'
            ],
            [
                'profile_name' => "TARM",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'permissions' => '{"sheets":[{"id":2,"name":"Ver"},{"id":3,"name":"Filtrar por Per\u00edodo"},{"id":4,"name":"Ver Fichas Exclu\u00eddas"},{"id":5,"name":"Restaurar Fichas Exclu\u00eddas"},{"id":6,"name":"Gerar PDF"},{"id":7,"name":"Cadastrar"},{"id":8,"name":"Editar"},{"id":9,"name":"Editar Avalia\u00e7\u00e3o no Local da Ocorr\u00eancia"},{"id":10,"name":"Excluir"}],"reports":[{"id":12,"name":"Ver"}],"users":[{"id":14,"name":"Ver"},{"id":15,"name":"Cadastrar"},{"id":16,"name":"Editar"},{"id":17,"name":"Excluir"}]}'
            ],
            [
                'profile_name' => "Médico",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'permissions' => null
            ],
            [
                'profile_name' => "Coordenador",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'permissions' => null
            ],
            [
                'profile_name' => "Rádio Operador",
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'permissions' => null
            ]
        ];
        foreach ($profiles as $profile) {
            Profile::create($profile);
        }
    }
}
