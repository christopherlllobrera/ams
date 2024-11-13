<?php

// app/Console/Commands/CheckLicenseExpiration.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Licenses;
use App\Notifications\LicenseExpirationNotification;
use Carbon\Carbon;

class CheckLicenseExpiration extends Command
{
    protected $signature = 'check:license-expiration';
    protected $description = 'Check and notify users about license expiration';

    public function handle()
    {
        // Get licenses that will expire in 1 month
        $oneMonthLicenses = Licenses::query()
            ->whereBetween('license_expiration_date', [Carbon::now(), Carbon::now()->addMonth()])
            ->get();

        // Get licenses that will expire in 2 weeks
        $twoWeeksLicenses = Licenses::query()
            // ->whereDate('license_expiration_date', '=', Carbon::now()->addWeeks(2))
            ->whereBetween('license_expiration_date', [Carbon::now(), Carbon::now()->addWeeks(2)])
            ->get();

        // Get licenses that will expire tomorrow
        $dayBeforeLicenses = Licenses::query()
            ->whereDate('license_expiration_date', '=', Carbon::tomorrow())
            ->get();

        // Get licenses that expire today
        $todayLicenses = Licenses::query()
            ->whereDate('license_expiration_date', '=', Carbon::today())
            ->get();

        // Get licenses that expired yesterday
        $dayAfterLicenses = Licenses::query()
            ->whereDate('license_expiration_date', '=', Carbon::yesterday())
            ->get();

        $this->sendNotifications($oneMonthLicenses, 'one_month');
        $this->sendNotifications($twoWeeksLicenses, 'two_weeks');
        $this->sendNotifications($dayBeforeLicenses, 'day_before');
        $this->sendNotifications($todayLicenses, 'today');
        $this->sendNotifications($dayAfterLicenses, 'day_after');

        $this->info('License expiration notifications sent successfully.');
    }

    private function sendNotifications($licenses, $period)
    {
        foreach ($licenses as $license) {
            $license->notify(new LicenseExpirationNotification(
                $period,
                $license->registered_name,
                $license->license_expiration_date
            ));
        }
    }
}
