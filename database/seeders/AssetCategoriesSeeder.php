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
                'asset_type' => 'Computer',
                'categories' => 'Desktop',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Computer',
                'categories' => 'Laptop',
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

            // Storage Devices
            [
                'asset_type' => 'Storage Devices',
                'categories' => 'Hard Disk Drive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Storage Devices',
                'categories' => 'Solid State Drive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Storage Devices',
                'categories' => 'Network Attached Storage (NAS)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Storage Devices',
                'categories' => 'Backup Drive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Storage Devices',
                'categories' => 'Flash Drive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Storage Devices',
                'categories' => 'Memory Card',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Servers
            [
                'asset_type' => 'Servers',
                'categories' => 'Rack Server',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Servers',
                'categories' => 'Blade Server',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Servers',
                'categories' => 'Tower Server',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Servers',
                'categories' => 'Micro Server',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Servers',
                'categories' => 'Mainframe',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Servers',
                'categories' => 'Supercomputer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Servers',
                'categories' => 'Physical Server',
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
                'categories' => 'Mouse',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Peripherals',
                'categories' => 'Printer',
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

            // Office Supplies & Equipment
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Desk',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Chair',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Filing Cabinet',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Shelves',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Whiteboard',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Projector Screen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Stapler',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Hole Punch',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Scissors',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Notebooks',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Laminator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Shredder',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Office Supplies & Equipment',
                'categories' => 'Calculator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Wiring and Cabling
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Ethernet Cable',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Fiber Optic Cable',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Coaxial Cable',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Twisted Pair Cable',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Patch Cable',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Cable Tester',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Cable Crimper',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Cable Stripper',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Cable Ties',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Cable Labels',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Wiring and Cabling',
                'categories' => 'Cable Management Tools',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Ink Cartridges',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Toner Cartridges',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Printer Paper',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Batteries',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Tape',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Label',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Stamp',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Envelope',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Pen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Pencils',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Highlighters',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Markers',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Rubber Bands',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Paper Clips',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Binder Clips',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Staples',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Rubber Stamps',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Sticky Notes',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Glue',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Glue',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Scissor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Eraser',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'asset_type' => 'Consumables',
                'categories' => 'Sharpeners',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Staplers',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Hole Punches',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Laminating Pouches',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Binding Combs',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_type' => 'Consumables',
                'categories' => 'Shredder Bags',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('asset_categories')->insert($categories);
    }
}
