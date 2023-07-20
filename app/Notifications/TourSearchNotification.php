<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TourSearchNotification extends Notification implements ShouldQueue
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
            ->subject(__('Tour request search'))
            ->line('Name: ' . $this->payload['name'])
            ->line('Email: ' . $this->payload['email'])
            ->line('Phone: ' . $this->payload['phone'])
            ->line('Note: ' . ($this->payload['text'] ?? ''));
    }
}
