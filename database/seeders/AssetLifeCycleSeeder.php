<?php

namespace Database\Seeders;

use App\Models\AssetLifeCycle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetLifeCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assetLifeCycles = [
            [
                'status' => 'Available',
                'definition' => 'The asset is ready for use, being prepared to be used,
                                being stored and is not in use but usable'
            ],

            [
                'status' => 'Deployed',
                'definition' => 'The asset is currently in use.'
            ],
            [
                'status' => 'For Repair',
                'definition' => 'The asset is undergoing repairs and is temporarily out of service.'
            ],
            [
                'status' => 'Missing',
                'definition' => 'The asset is missing and its location is unknown,
                                has been stolen and the current location is unknown'
            ],

            [
                'status' => 'For Disposal',
                'definition' => 'The asset has been pending discarded as waste.'
            ],
            [
                'status' => 'Disposed',
                'definition' => 'The asset has been discarded and is no longer in service.'
            ],
        ];

        foreach ($assetLifeCycles as $assetLifeCycle) {
            AssetLifeCycle::create($assetLifeCycle);
        }

    }
}
