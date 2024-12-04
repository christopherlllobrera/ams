<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class LicenseSeeder extends Seeder
{
    public function run(): void
    {
        DB::disableQueryLog();
        LazyCollection::make(function () {
            $file = fopen(public_path('LICENSE_clean.csv'), 'r');
            while (($line = fgetcsv($file, 4096)) !== false) {
                $dataString = implode(',', $line);
                $row = explode(',', $dataString);
                yield $row;
            }
            fclose($file);
        })
            ->chunk(1000)
            ->each(function ($lines) {
                DB::table('licenses')->insert($lines->map(function ($line) {
                    return [
                        'id' => $line[0],
                        'software_name' => $line[1],
                        'categories_id' => $line[2],
                        'product_key' => $line[3],
                        'seat' => $line[4],
                        'supplier_id' => $line[5],
                        'manufacturer_id' => $line[6],
                        'registered_name' => $line[7],
                        'registered_email' => $line[8],
                        'license_order_number' => $line[9],
                        'license_purchase_cost' => $line[10],
                        'license_purchase_date' => $line[11],
                        'license_expiration_date' => $line[12],
                        'license_notes' => $line[13],
                        'license_attachment' => $line[14]?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray());
            });
    }
}
