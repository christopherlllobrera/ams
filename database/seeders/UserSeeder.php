<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\LazyCollection;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::disableQueryLog();
        // Initialize counters
        $totalLines = 0;
        $processedLines = 0;
        $startTime = microtime(true);

        // First count total lines in CSV
        $file = fopen(public_path('Employee_with_emails.csv'), 'r');
        while (fgetcsv($file, 4096) !== false) {
            $totalLines++;
        }
        fclose($file);

        $this->command->info("Found {$totalLines} users to process");

        LazyCollection::make(function () {
            $file = fopen(public_path('Employee_with_emails.csv'), 'r');
            while (($line = fgetcsv($file, 4096)) !== false) {
                $dataString = implode(',', $line);
                $row = explode(',', $dataString);
                yield $row;
            }
            fclose($file);
        })
            ->chunk(100)
            ->each(function ($lines) use (&$processedLines, $totalLines, $startTime) {
                DB::table('users')->insert($lines->map(function ($line) {
                    return [
                        'id' => $line[0],
                        'personnel_no' => $line[1] ?? null,
                        'name' => $line[2],
                        'first_name' => $line[3] ?? null,
                        'middle_name' => $line[4] ?? null,
                        'last_name' => $line[5] ?? null,
                        'email' => $line[6] ?? null,
                        'sub_area' => $line[7],
                        'organizational_unit' => $line[8],
                        'employee_group' => $line[9],
                        'position_name' => $line[10],
                        'cost_center' => $line[11],
                        'cost_center_name' => $line[12],
                        'start_of_tenure' => $line[13],
                        'email_verified_at' => $line[6] ? now() : nul00l,
                        'password' => Hash::make($line[14] ?? 'password'),
                        'remember_token' => $line[15] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray());

                $processedLines += $lines->count();
                $percentage = round(($processedLines / $totalLines) * 100, 2);

                // Calculate time statistics
                $timeElapsed = microtime(true) - $startTime;
                $timePerRecord = $timeElapsed / $processedLines;
                $estimatedTimeRemaining = ($totalLines - $processedLines) * $timePerRecord;

                $this->command->info(sprintf(
                    "Processed %d of %d users (%.2f%%) | Time elapsed: %.2fs | Est. time remaining: %.2fs",
                    $processedLines,
                    $totalLines,
                    $percentage,
                    $timeElapsed,
                    $estimatedTimeRemaining
                ));
            });

        // Calculate final statistics
        $endTime = microtime(true);
        $totalTime = $endTime - $startTime;
        $averageTimePerRecord = $totalTime / $totalLines;

        // Display final statistics in a table
        $this->command->info("\nSeeding completed successfully!");
        $this->command->table(
            ['Metric', 'Value'],
            [
                ['Total Users Processed', number_format($totalLines)],
                ['Total Time (seconds)', number_format($totalTime, 2)],
                ['Average Time per Record (seconds)', number_format($averageTimePerRecord, 4)],
                ['Records per Second', number_format(1 / $averageTimePerRecord, 2)],
                ['Memory Peak Usage (MB)', number_format(memory_get_peak_usage(true) / 1024 / 1024, 2)],
            ]
        );

        // Verify the insertion
        $actualCount = DB::table('users')->count();
        if ($actualCount === $totalLines) {
            $this->command->info("✓ Verification passed: All {$totalLines} users were inserted successfully.");
        } else {
            $this->command->error("× Verification failed: Expected {$totalLines} users but found {$actualCount}.");
        }
    }
}
