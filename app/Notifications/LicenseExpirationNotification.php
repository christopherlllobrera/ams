<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LicenseExpirationNotification extends Notification
{
    use Queueable;

    protected $period;
    protected $name;
    protected $expirationDate;

    public function __construct($period, $name, $expirationDate)
    {
        $this->period = $period;
        $this->name = $name;
        $this->expirationDate = $expirationDate;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $subject = $this->getSubject();
        $message = $this->getMessage();
        $urgency = $this->getUrgencyLevel();

        return (new MailMessage)
            ->subject($subject)
            ->greeting("Hello {$this->name},")
            ->line($message)
            ->line("Expiration Date: {$this->expirationDate->format('Y-m-d')}")
            ->line($urgency)
            ->action('Renew License', url('/renew-license'))
            ->line('Thank you for using our service!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    private function getSubject()
    {
        return match ($this->period) {
            'one_month' => 'License Expiration Notice - 1 Month Reminder',
            'two_weeks' => 'License Expiration Notice - 2 Weeks Reminder',
            'day_before' => 'URGENT: Your License Expires Tomorrow',
            'today' => 'CRITICAL: Your License Expires Today',
            'day_after' => 'ATTENTION: Your License Has Expired',
            default => 'License Expiration Notice',
        };
    }

    private function getMessage()
    {
        return match ($this->period) {
            'one_month' => 'Your license will expire in one month',
            'two_weeks' => 'Your license will expire in two weeks',
            'day_before' => 'Your license will expire tomorrow',
            'today' => 'Your license expires today',
            'day_after' => 'Your license expired yesterday',
            default => 'Your license requires attention',
        };
    }

    private function getUrgencyLevel()
    {
        return match ($this->period) {
            'one_month', 'two_weeks' => 'Please renew your license before it expires to avoid any service interruption.',
            'day_before' => 'URGENT: Please renew your license immediately to prevent service interruption.',
            'today' => 'CRITICAL: Your license expires today. Immediate action required to prevent service interruption.',
            'day_after' => 'Your license has expired. Please renew immediately to restore service.',
            default => 'Please review your license status.',
        };
    }
}
