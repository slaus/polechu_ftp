<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TourOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly array $payload
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Request from Contact form'))
            ->line('CLIENT')
            ->line('Name: ' . $this->payload['client']['name'])
            ->line('Email: ' . $this->payload['client']['email'])
            ->line('Phone: ' . $this->payload['client']['phone'])
            ->line('Time for call: ' . $this->payload['client']['time'])
            ->line('Note: ' . $this->payload['client']['note'])
            ->line('-------------------------------------------')
            ->line('TOUR')
            ->line('ID: ' . $this->payload['tour']['id'])
            ->line('Name: ' . $this->payload['tour']['name'])
            ->line('State: ' . $this->payload['tour']['state'])
            ->line('Town: ' . $this->payload['tour']['town'])
            ->line('Check In: ' . $this->payload['tour']['checkin'])
            ->line('Nights: ' . $this->payload['tour']['nights']);
    }
}
