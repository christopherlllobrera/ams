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
                'definition' => 'The asset is ready for use.'
            ],
            [
                'status' => 'Pending',
                'definition' => 'The asset is being prepared for use.'
            ],
            [
                'status' => 'Deployed',
                'definition' => 'The asset is currently in use.'
            ],
            [
                'status' => 'Under Repair',
                'definition' => 'The asset is undergoing repairs and is temporarily out of service.'
            ],
            [
                'status' => 'In Storage',
                'definition' => 'The asset is stored and not in use, but remains functional.'
            ],
            [
                'status' => 'Missing',
                'definition' => 'The asset is missing and its location is unknown.'
            ],
            [
                'status' => 'Stolen',
                'definition' => 'The asset has been stolen and its location is unknown.'
            ],
            [
                'status' => 'Rental',
                'definition' => 'The asset is leased and currently in use.'
            ],
            [
                'status' => 'Donated',
                'definition' => 'The asset has been given away as a donation.'
            ],
            [
                'status' => 'Disposed',
                'definition' => 'The asset has been discarded and is no longer in service.'
            ],
            [
                'status' => 'Pending Disposal',
                'definition' => 'The asset is awaiting disposal.'
            ],
            [
                'status' => 'Out of Service',
                'definition' => 'The asset is no longer in use and has been taken out of service.'
            ],
            [
                'status' => 'Sold',
                'definition' => 'The asset has been sold to a user.'
            ]
        ];

        foreach ($assetLifeCycles as $assetLifeCycle) {
            AssetLifeCycle::create($assetLifeCycle);
        }

    }
}
