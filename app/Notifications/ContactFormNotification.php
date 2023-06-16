<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormNotification extends Notification implements ShouldQueue
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
            ->line('Name: ' . $this->payload['name'])
            ->line('Email: ' . $this->payload['email'])
            ->line('Text: ' . $this->payload['text']);
    }
}
