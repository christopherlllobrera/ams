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
                        'supplier_address' => $line[2],
                        'municipality_id' => $line[3],
                        'province_id' => $line[4],
                        'country' => $line[5],
                        'supplier_contact_name' => $line[6],
                        'supplier_contact_phone' => $line[7],
                        'supplier_fax' => $line[8],
                        'supplier_email' => $line[9],
                        'supplier_website' => $line[10],
                        'supplier_notes' => $line[11],
                        'supplier_attachment' => $line[12],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray());
            });
    }
}
