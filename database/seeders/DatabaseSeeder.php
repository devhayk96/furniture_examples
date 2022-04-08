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
        $this->call([
            PermissionsSeeder::class,
            CategoriesSeeder::class,
            BuildingTypesSeeder::class,
            RepairingTypesSeeder::class,
            BuildingFloorsSeeder::class,
            DealTypesSeeder::class,
            AdditionalInfoSeeder::class,
            ServiceSeeder::class,
            AboutUsSeeder::class,
            TermsOfUseSeeder::class,
//            SellerStatusesSeeder::class,
            UserRolesSeeder::class,
            RegionsSeeder::class,
            VillagesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            StreetsSeeder::class,
            WebsiteInfoSeeder::class,
        ]);
    }
}
