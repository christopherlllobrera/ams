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
                        'serial_key' => $line[4],
                        'seat' => $line[5],
                        'seat_count' => $line[6],
                        'supplier_id' => $line[7],
                        'manufacturer_id' => $line[8],
                        'registered_name' => $line[9],
                        'registered_email' => $line[10],
                        'license_order_number' => $line[11],
                        'license_purchase_cost' => $line[12],
                        'license_purchase_date' => $line[13],
                        'license_expiration_date' => $line[14],
                        'license_notes' => $line[15],
                        'license_attachment' => $line[16]?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray());
            });
    }
}
