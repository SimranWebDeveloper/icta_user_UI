<?php
namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendMessageNotification
{
    public function handle(MessageSent $event)
    {
        // WebSocket veya diğer bildirim yöntemleri ile bildirimi gönderin
    }
}