<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MessageDeliveryNotification;
use Illuminate\Support\Carbon;

class SendScheduledMessages extends Command
{
    protected $signature = 'messages:send-scheduled';
    protected $description = 'Send scheduled messages to recipients';

    public function handle()
    {
        $today = now()->format('m-d');

        $messages = Message::where(function ($q) use ($today) {
            $q->where('delivery_schedule', 'birthday')
              ->orWhere('delivery_schedule', 'anniversary');
        })->get();

        foreach ($messages as $message) {
            // Simulasi: kirim semua pesan tipe birthday & anniversary setiap hari
            Notification::route('mail', $message->recipient_email)
                ->notify(new MessageDeliveryNotification($message));
        }

        $this->info("Scheduled messages sent.");
    }
}
