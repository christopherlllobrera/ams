<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $location = [
            [
                'location_name' => 'Main Office',
                'parent_location' => '',
                'location_address' => 'Main Office',
                'municipality_id' => 1,
                'province_id' => 1,
                'region_id' => 1,
                'location_country' => 'Philippines',
                'location_zip' => '1000',
            ],
            [
                'location_name' => 'Warehouse',
                'parent_location' => '',
                'location_address' => 'Warehouse',
                'municipality_id' => 1,
                'province_id' => 1,
                'region_id' => 1,
                'location_country' => 'Philippines',
                'location_zip' => '1000',
            ],
            [
                'location_name' => 'Branch Office',
                'parent_location' => '',
                'location_address' => 'Branch Office',
                'municipality_id' => 1,
                'province_id' => 1,
                'region_id' => 1,
                'location_country' => 'Philippines',
                'location_zip' => '1000',
            ],
            [
                'location_name' => 'Sub-Branch Office',
                'parent_location' => '',
                'location_address' => '',
                'municipality_id' => 1,
                'province_id' => 1,
                'region_id' => 1,
                'location_country' => 'Philippines',
                'location_zip' => '1000',
            ],
        ];

        foreach ($location as $location) {
            Location::create($location);
        }

    }
}
