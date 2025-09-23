<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfilesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EmergenciesTableSeeder::class);
        $this->call(EmergencyTypesTableSeeder::class);
        $this->call(HospitalsTableSeeder::class);
        $this->call(SeveritiesTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(TransportsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(LocalesTableSeeder::class);
        $this->call(AddNotInformedLocale::class);
        $this->call(AddMoreEmergencyTypes::class);
    }
}
