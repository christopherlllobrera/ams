<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssetCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            // Computer
            [
                'asset_type' => 'Laptop',
                'categories' => 'N/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Desktop',
                'categories' => 'N/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Printer',
                'categories' => 'N/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'asset_type' => 'Desktop',
                'categories' => 'N/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],




            // Networking Equipment
            [
                'asset_type' => 'Networking Equipment',
                'categories' => 'Firewall',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Networking Equipment',
                'categories' => 'Router',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Networking Equipment',
                'categories' => 'Switch',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Networking Equipment',
                'categories' => 'Access Point',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Networking Equipment',
                'categories' => 'Network Rack',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Networking Equipment',
                'categories' => 'Network Cabinet',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Networking Equipment',
                'categories' => 'Patch Panels',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Networking Equipment',
                'categories' => 'Cable Management Tools',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Communication Equipment
            [
                'asset_type' => 'Communication Equipment',
                'categories' => 'IP Phone',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Communication Equipment',
                'categories' => 'Smart Phone',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Communication Equipment',
                'categories' => 'Tablet',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Peripherals
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Monitor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Keyboard',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'asset_type' => 'Peripherals',
                'categories' => 'Scanner',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Projector',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Webcam',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Speaker',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Headset',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Microphone',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Docking Station',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'USB Hub',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'UPS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Surge Protector',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Charger',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Battery',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Power Supply',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Laptop Bag',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        DB::table('asset_categories')->insert($categories);
    }
}
