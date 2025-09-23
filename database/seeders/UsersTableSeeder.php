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
        $users = array([
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
        [
            "name" => "Jonathan Henrique",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "jhowjhoe@gmail.com",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base02",
            "profile_id" => 1,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Jonathan Henrique",
                    "email" => "jhowjhoe@gmail.com"
                ]
            ]),
            "deleted_at" => "2021-12-17 07:36:11",
            "created_at" => "2021-11-02 20:37:07",
            "updated_at" => "2021-12-17 07:36:11"
        ],
        [
            "name" => "Reis",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "campos2053@gmail.com",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 1,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Reis",
                    "email" => "campos2053@gmail.com"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-02 20:39:29",
            "updated_at" => "2021-12-07 11:19:31"
        ],
        [
            "name" => "Emson Porcino",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "ensonporcino@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 1,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Emson Porcino",
                    "email" => "ensonporcino@samulife.com.br"
                ]
            ]),
            "deleted_at" => "2021-11-27 16:36:21",
            "created_at" => "2021-11-20 12:32:02",
            "updated_at" => "2021-11-27 16:36:21"
        ],
        [
            "name" => "paula",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "paula@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "paula",
                    "email" => "paula@samulife.com.br"
                ]
            ]),
            "deleted_at" => "2021-11-27 16:37:43",
            "created_at" => "2021-11-24 10:58:15",
            "updated_at" => "2021-11-27 16:37:43"
        ],
        [
            "name" => "Bruno",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "bruno@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Bruno",
                    "email" => "bruno@samulife.com.br"
                ]
            ]),
            "deleted_at" => "2021-11-27 16:37:49",
            "created_at" => "2021-11-26 10:24:30",
            "updated_at" => "2021-11-27 16:37:49"
        ],
        [
            "name" => "Ricardo tarm",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "ricardo@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base02",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Ricardo tarm",
                    "email" => "ricardo@samulife.com.br"
                ]
            ]),
            "deleted_at" => "2021-11-27 16:37:56",
            "created_at" => "2021-11-26 10:38:46",
            "updated_at" => "2021-11-27 16:37:56"
        ],
        [
            "name" => "Emson Porcino",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "emsonporcino@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 1,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Emson Porcino",
                    "email" => "emsonporcino@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-27 16:37:24",
            "updated_at" => "2022-02-14 23:19:56"
        ],
        [
            "name" => "pepa",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "pepa@pepa.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "pepa",
                    "email" => "pepa@pepa.com.br"
                ]
            ]),
            "deleted_at" => "2021-11-27 21:22:28",
            "created_at" => "2021-11-27 17:06:10",
            "updated_at" => "2021-11-27 21:22:28"
        ],
        [
            "name" => "Emson Porcino",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "emsonporcino@hotmail.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 1,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Emson Porcino",
                    "email" => "emsonporcino@hotmail.com.br"
                ]
            ]),
            "deleted_at" => "2021-12-29 09:12:54",
            "created_at" => "2021-11-27 17:08:57",
            "updated_at" => "2021-12-29 09:12:54"
        ],
        [
            "name" => "Emanuela Feitosa",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "emmanuela-89@hotmail.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 5,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Emanuela Feitosa",
                    "email" => "emmanuela-89@hotmail.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-27 17:11:29",
            "updated_at" => "2021-11-27 17:11:29"
        ],
        [
            "name" => "Girleide Rodrigues",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "girleide@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Girleide Rodrigues",
                    "email" => "girleide@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-27 17:14:18",
            "updated_at" => "2022-02-15 07:25:28"
        ],
        [
            "name" => "Ursula Costa",
            "contact" => "(74) 99920-3550",
            "is_whatsapp" => false,
            "email" => "ursulaleonel@hotmail.com.br",
            "crm" => "22256",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Ursula Costa",
                    "email" => "ursulaleonel@hotmail.com.br",
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-27 17:16:04",
            "updated_at" => "2021-11-27 17:16:57"
        ],
        [
            "name" => "Elizabeth Kimberly",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "elizabeth@samulife.com.br",
            "crm" => "38297",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Elizabeth Kimberly",
                    "email" => "elizabeth@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-27 18:41:43",
            "updated_at" => "2022-02-12 14:07:03"
        ],
        [
            "name" => "Diogo Pereira França da Silva",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "diogopereir@yahoo.com.br",
            "crm" => "30790",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Diogo Pereira França da Silva",
                    "email" => "diogopereir@yahoo.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-27 18:57:16",
            "updated_at" => "2021-11-27 18:57:16"
        ],
        [
            "name" => "Tatiana Ferreira",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "tatiana@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Tatiana Ferreira",
                    "email" => "tatiana@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-27 19:07:36",
            "updated_at" => "2021-12-22 07:47:43"
        ],
        [
            "name" => "Rosimeire Pereira De Lima",
            "contact" => "(74) 99113-6723",
            "is_whatsapp" => true,
            "email" => "rosimeire@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Rosimeire Pereira De Lima",
                    "email" => "rosimeire@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-29 21:06:42",
            "updated_at" => "2021-11-29 21:10:24"
        ],
        [
            "name" => "Tainara Dos Santos Gomes",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "tainara@samulife.com.br",
            "crm" => "37630",
            "tarm" => null,
            "service_base" => "base02",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Tainara Dos Santos Gomes",
                    "email" => "tainara@samulife.com.br"
                ]
            ]),
            "deleted_at" => "2022-02-15 10:43:23",
            "created_at" => "2021-11-29 21:24:52",
            "updated_at" => "2022-02-15 10:43:23"
        ],
        [
            "name" => "Rui Camacam",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "rui@samulife.com.br",
            "crm" => "37532",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Rui Camacam",
                    "email" => "rui@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-29 21:40:41",
            "updated_at" => "2021-11-29 21:40:41"
        ],
        [
            "name" => "Nilda Aparecida",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "nilda@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Nilda Aparecida",
                    "email" => "nilda@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-30 12:40:21",
            "updated_at" => "2021-12-20 07:42:37"
        ],
        [
            "name" => "Alerrandro Mikael Santos De Brito",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "alerrandro@samulife.com.br",
            "crm" => "14578",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Alerrandro Mikael Santos De Brito",
                    "email" => "alerrandro@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-30 13:00:47",
            "updated_at" => "2021-11-30 13:00:47"
        ],
        [
            "name" => "Patricia Pompeu Barbosa",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "patricia@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Patricia Pompeu Barbosa",
                    "email" => "patricia@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-30 13:12:14",
            "updated_at" => "2021-12-27 19:36:04"
        ],
        [
            "name" => "Alexandra Carvalho de Araujo",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "ale@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => "4",
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Alexandra Carvalho de Araujo",
                    "email" => "ale@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-11-30 14:07:11",
            "updated_at" => "2021-11-30 14:07:11"
        ],
        [
            "name" => "Roger Reis",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "rogerreis@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 1,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Roger Reis",
                    "email" => "rogerreis@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-03 07:26:12",
            "updated_at" => "2021-12-19 08:49:17"
        ],
        [
            "name" => "roger",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "roger@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 1,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "roger",
                    "email" => "roger@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-07 11:21:11",
            "updated_at" => "2021-12-07 11:21:11"
        ],
        [
            "name" => "convidado",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "convidado@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "convidado",
                    "email" => "convidado@samulife.com.br"
                ]
            ]),
            "deleted_at" => "2021-12-17 07:37:10",
            "created_at" => "2021-12-09 19:14:57",
            "updated_at" => "2021-12-17 07:37:10"
        ],
        [
            "name" => "cleberli",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "cleberli@encode.dev.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "cleberli",
                    "email" => "cleberli@encode.dev.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-09 19:34:11",
            "updated_at" => "2021-12-29 10:21:06"
        ],
        [
            "name" => "Jessica Tais Barreto Jorge",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "jessica@samulife.com.br",
            "crm" => "38287",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Jessica Tais Barreto Jorge",
                    "email" => "jessica@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-20 09:25:46",
            "updated_at" => "2021-12-20 09:25:46"
        ],
        [
            "name" => "suporte",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "suporte@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "suporte",
                    "email" => "suporte@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-21 10:30:30",
            "updated_at" => "2021-12-21 10:30:30"
        ],
        [
            "name" => "Denise Maria Silva Sena",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "denise@samulife.com.br",
            "crm" => "33556",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Denise Maria Silva Sena",
                    "email" => "denise@samulife.com.br"                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-22 08:35:52",
            "updated_at" => "2022-01-26 09:07:15"
        ],
        [
            "name" => "Igor Dantas Freire",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "igor@samulife.com.br",
            "crm" => "36134",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Igor Dantas Freire",
                    "email" => "igor@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-22 12:18:53",
            "updated_at" => "2021-12-22 12:18:53"
        ],
        [
            "name" => "Muriel Jon",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "muriel@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 5,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Muriel Jon",
                    "email" => "muriel@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-22 15:39:02",
            "updated_at" => "2021-12-22 15:39:02"
        ],
        [
            "name" => "José Weberton Rodrigues",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "weberton@samulife.com.br",
            "crm" => "37008",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "José Weberton Rodrigues",
                    "email" => "weberton@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-23 15:24:21",
            "updated_at" => "2021-12-23 15:24:21"
        ],
        [
            "name" => "Mariana Ribeiro Silva Moura",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "mari@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Mariana Ribeiro Silva Moura",
                    "email" => "mari@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-24 10:00:05",
            "updated_at" => "2022-01-03 12:52:42"
        ],
        [
            "name" => "DANIEL MAXWELL DOS SANTOS SOUZA",
            "contact" => null,
            "is_whatsapp" => true,
            "email" => "maxwell.daniel15@samulife.com.br",
            "crm" => "32816",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "DANIEL MAXWELL DOS SANTOS SOUZA",
                    "email" => "maxwell.daniel15@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-24 10:26:19",
            "updated_at" => "2021-12-24 10:26:19"
        ],
        [
            "name" => "ANDRESSA MORGANNA MONTEIRO DOS SANTOS VALADARES",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "andressa@samulife.com.br",
            "crm" => "33027",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "ANDRESSA MORGANNA MONTEIRO DOS SANTOS VALADARES",
                    "email" => "andressa@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-24 10:41:26",
            "updated_at" => "2022-01-28 12:06:51"
        ],
        [
            "name" => "Rogerio Avelino Menezes",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "rogerio@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 5,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Rogerio Avelino Menezes",
                    "email" => "rogerio@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-24 11:03:40",
            "updated_at" => "2021-12-24 11:03:40"
        ],
        [
            "name" => "Marineide",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "marineide@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Marineide",
                    "email" => "marineide@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2021-12-27 09:13:54",
            "updated_at" => "2021-12-27 09:13:54"
        ],
        [
            "name" => "Maria Conceição Trindade",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "mariact@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base02",
            "profile_id" => 2,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Maria Conceição Trindade",
                    "email" => "mariact@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2022-01-24 22:18:16",
            "updated_at" => "2022-01-25 00:00:35"
        ],
        [
            "name" => "DEMIS GRACIANO DE CARVALHO",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "demis@samulife.com.br",
            "crm" => "34552",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "DEMIS GRACIANO DE CARVALHO",
                    "email" => "demis@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2022-01-25 09:47:28",
            "updated_at" => "2022-01-25 09:47:28"
        ],
        [
            "name" => "cleydson araujo silva",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "cleydson@samulife.com.br",
            "crm" => "37881",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "cleydson araujo silva",
                    "email" => "cleydson@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2022-01-25 10:34:49",
            "updated_at" => "2022-01-25 10:34:49"
        ],
        [
            "name" => "ADRIANO ERNESTO ROSA DE LIMA",
            "contact" => null,
            "is_whatsapp" => true,
            "email" => "adrianoernesto@samulife.com.br",
            "crm" => "38751",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "ADRIANO ERNESTO ROSA DE LIMA",
                    "email" => "adrianoernesto@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2022-01-26 09:15:46",
            "updated_at" => "2022-01-26 09:15:46"
        ],
        [
            "name" => "LUIS CLAUDIO SENA GOMES DE SOUZA",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "luis@samulife.com.br",
            "crm" => "26675",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "LUIS CLAUDIO SENA GOMES DE SOUZA",
                    "email" => "luis@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2022-01-28 10:53:06",
            "updated_at" => "2022-01-28 10:53:06"
        ],
        [
            "name" => "CARLA",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "carla@samulife.com.br",
            "crm" => null,
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "CARLA",
                    "email" => "carla@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2022-01-30 09:29:55",
            "updated_at" => "2022-01-30 09:31:33"
        ],
        [
            "name" => "Ana Bárbara Almeida Fonseca",
            "contact" => null,
            "is_whatsapp" => false,
            "email" => "anabarbara@samulife.com.br",
            "crm" => "38494",
            "tarm" => null,
            "service_base" => "base01",
            "profile_id" => 3,
            "password" => Hash::make("samulife"),
            'token' => MakeJwt([
                'data' => [
                    'iss' => 'samulife',
                    "name" => "Ana Bárbara Almeida Fonseca",
                    "email" => "anabarbara@samulife.com.br"
                ]
            ]),
            "deleted_at" => NULL,
            "created_at" => "2022-01-31 07:34:36",
            "updated_at" => "2022-01-31 07:34:36"
        ]);

        DB::table('users')->insert($users);
    }
}
