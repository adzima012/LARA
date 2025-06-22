<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MessageDeliveryNotification extends Notification
{
    public $messageData;

    public function __construct($messageData)
    {
        $this->messageData = $messageData;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('A Message from Lara')
            ->greeting('Dear ' . $this->messageData->recipient_name)
            ->line($this->messageData->message)
            ->line('— Sent with love from Lara.');
    }
}
