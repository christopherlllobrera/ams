<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        DB::disableQueryLog();
        LazyCollection::make(function () {
            $file = fopen(public_path('AMS-clean-data-1.csv'), 'r');
            while (($line = fgetcsv($file, 4096)) !== false) {
                $dataString = implode(',', $line);
                $row = explode(',', $dataString);
                yield $row;
            }
            fclose($file);
        })
            ->chunk(1000)
            ->each(function ($lines) {
                DB::table('assets')->insert($lines->map(function ($line) {
                    return [
                        'id' => $line[0],
                        'company_id' => $line[1],
                        'company_number' => $line[2],
                        'asset_code' => $line[3],
                        'asset_type' => $line[4],
                        'asset_categories' => $line[5],
                        'asset_model_id' => $line[6],
                        'serial_number' => $line[7],
                        'assetlifecycle_id' => $line[8],
                        'location_id' => $line[9],
                        'department_id' => $line[10],
                        'project_id' => $line[11],
                        'asset_note' => $line[12],
                        'depreciation_cost' => $line[13],
                        'depreciation_year' => $line[14],
                        'EOL_date' => $line[15],
                        'supplier_name' => $line[16],
                        'purchase_receipt' => $line[17],
                        'purchase_date' => now(),
                        'purchase_order' => $line[19],
                        'purchase_cost' => $line[20],
                        'good_receipt' => $line[21],
                        'delivery_receipt' => $line[22],
                        'delivery_date' => now(),
                        'start_of_warranty' => $line[24],
                        'end_of_warranty' => $line[25],
                        'asset_attachment' => $line[26],

                        'operating_system' => $line[27],
                        'processor' => $line[28],
                        'RAM' => $line[29],
                        'storage' => $line[30],
                        'GPU' => $line[31],
                        'color' => $line[32],
                        'MAC_address' => $line[33],
                        'image' => $line[34],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray());
            });
    }
}
