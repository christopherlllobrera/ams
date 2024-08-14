<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;


class ManufacturerSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::disableQueryLog();
        LazyCollection::make(function () {
            $file = fopen(public_path('table_manufacturer.csv'), 'r');
            while (($line = fgetcsv($file, 4096)) !== false) {
                $dataString = implode(',', $line);
                $row = explode(',', $dataString);
                yield $row;
            }
            fclose($file);
        })
            ->chunk(1000)
            ->each(function ($lines) {
                DB::table('manufacturers')->insert($lines->map(function ($line) {
                    return [
                        'id' => $line[0],
                        'manufacturer_name' => $line[1],
                        'URL' => $line[2],
                        'manufacturer_email' => $line[3],
                        'manufacturer_phone' => $line[4],
                        'manufacturer_attachment' => $line[5],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray());
            });
    }
}
