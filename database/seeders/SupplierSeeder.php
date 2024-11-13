<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::disableQueryLog();
        LazyCollection::make(function () {
            $file = fopen(public_path('table_supplier.csv'), 'r');
            while (($line = fgetcsv($file, 4096)) !== false) {
                $dataString = implode(',', $line);
                $row = explode(',', $dataString);
                yield $row;
            }
            fclose($file);
        })
            //,supplier_notes,image,
            ->chunk(1000)
            ->each(function ($lines) {
                DB::table('suppliers')->insert($lines->map(function ($line) {
                    return [
                        'id' => $line[0],
                        'supplier_name' => $line[1],
                        'supplier_address' => null,
                        'municipality_id' => null,
                        'province_id' => null,
                        'country' => null,
                        'supplier_contact_name' => null,
                        'supplier_contact_phone' => null,
                        'supplier_email' => null,
                        'supplier_website' => null,
                        'supplier_notes' => null,
                        'supplier_attachment' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray());
            });
    }
}
