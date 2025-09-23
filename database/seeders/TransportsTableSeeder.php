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
        $transports = [
            [
            'transport' => "AMBULÂNCIA 01",
            'plate' => "ABC1D23",
            'driver' => "João Silva",
            'driver_phone' => "(11) 98765-4321",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "AMBULÂNCIA 02",
            'plate' => "DEF4G56",
            'driver' => "Maria Oliveira",
            'driver_phone' => "(11) 97654-3210",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "AMBULÂNCIA 03",
            'plate' => "GHI7J89",
            'driver' => "Pedro Santos",
            'driver_phone' => "(11) 96543-2109",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "AMBULÂNCIA 04",
            'plate' => "JKL1M23",
            'driver' => "Ana Costa",
            'driver_phone' => "(11) 95432-1098",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "AMBULÂNCIA 05",
            'plate' => "NOP4Q56",
            'driver' => "Carlos Ferreira",
            'driver_phone' => "(11) 94321-0987",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "MOTOLÂNCIA 01",
            'plate' => "RST7U89",
            'driver' => "Lucas Ribeiro",
            'driver_phone' => "(11) 93210-9876",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "MOTOLÂNCIA 02",
            'plate' => "VWX1Y23",
            'driver' => "Mariana Alves",
            'driver_phone' => "(11) 92109-8765",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "MOTOLÂNCIA 03",
            'plate' => "ZAB4C56",
            'driver' => "Rafael Pereira",
            'driver_phone' => "(11) 91098-7654",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "UNIDADE DE SUPORTE 01",
            'plate' => "DEF7G89",
            'driver' => "Juliana Lima",
            'driver_phone' => "(11) 90987-6543",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "UNIDADE DE SUPORTE 02",
            'plate' => "HIJ1K23",
            'driver' => "Felipe Martins",
            'driver_phone' => "(11) 89876-5432",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "UTI MÓVEL 01",
            'plate' => "LMN4O56",
            'driver' => "Amanda Souza",
            'driver_phone' => "(11) 88765-4321",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "UTI MÓVEL 02",
            'plate' => "PQR7S89",
            'driver' => "Gabriel Moreira",
            'driver_phone' => "(11) 87654-3210",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "UNIDADE DE RESGATE 01",
            'plate' => "TUV1W23",
            'driver' => "Beatriz Cardoso",
            'driver_phone' => "(11) 86543-2109",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "UNIDADE DE RESGATE 02",
            'plate' => "XYZ4A56",
            'driver' => "Rodrigo Dias",
            'driver_phone' => "(11) 85432-1098",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "UNIDADE DE RESGATE 03",
            'plate' => "BCD7E89",
            'driver' => "Camila Rocha",
            'driver_phone' => "(11) 84321-0987",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VIATURA ADMINISTRATIVA 01",
            'plate' => "FGH1I23",
            'driver' => "Bruno Gomes",
            'driver_phone' => "(11) 83210-9876",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VIATURA ADMINISTRATIVA 02",
            'plate' => "JKL4M56",
            'driver' => "Larissa Mendes",
            'driver_phone' => "(11) 82109-8765",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VIATURA ADMINISTRATIVA 03",
            'plate' => "NOP7Q89",
            'driver' => "Diego Barros",
            'driver_phone' => "(11) 81098-7654",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VAN 01",
            'plate' => "RST1U23",
            'driver' => "Isabela Campos",
            'driver_phone' => "(11) 80987-6543",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VAN 02",
            'plate' => "VWX4Y56",
            'driver' => "Ricardo Nunes",
            'driver_phone' => "(11) 79876-5432",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "CAMINHONETE 01",
            'plate' => "ZAB7C89",
            'driver' => "Patricia Vieira",
            'driver_phone' => "(11) 78765-4321",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "CAMINHONETE 02",
            'plate' => "DEF1G23",
            'driver' => "Marcos Lopes",
            'driver_phone' => "(11) 77654-3210",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "CAMINHONETE 03",
            'plate' => "HIJ4K56",
            'driver' => "Fernanda Castro",
            'driver_phone' => "(11) 76543-2109",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VEÍCULO DE APOIO 01",
            'plate' => "LMN7O89",
            'driver' => "Leonardo Pinto",
            'driver_phone' => "(11) 75432-1098",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VEÍCULO DE APOIO 02",
            'plate' => "PQR1S23",
            'driver' => "Aline Carvalho",
            'driver_phone' => "(11) 74321-0987",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VEÍCULO DE APOIO 03",
            'plate' => "TUV4W56",
            'driver' => "Thiago Andrade",
            'driver_phone' => "(11) 73210-9876",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VEÍCULO DE APOIO 04",
            'plate' => "XYZ7A89",
            'driver' => "Vanessa Correia",
            'driver_phone' => "(11) 72109-8765",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "VEÍCULO DE APOIO 05",
            'plate' => "BCD1E23",
            'driver' => "Eduardo Almeida",
            'driver_phone' => "(11) 71098-7654",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "UNIDADE ESPECIAL 01",
            'plate' => "FGH4I56",
            'driver' => "Natália Freitas",
            'driver_phone' => "(11) 70987-6543",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
            [
            'transport' => "UNIDADE ESPECIAL 02",
            'plate' => "JKL7M89",
            'driver' => "Roberto Teixeira",
            'driver_phone' => "(11) 69876-5432",
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
            ],
        ];

        DB::table('transports')->insert($transports);
    }
}
