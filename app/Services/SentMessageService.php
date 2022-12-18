<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;

class SentMessageService
{
    public function sent(Chat $chat, User $user, array $messageData): Message
    {
        $message = new Message();
        $message->text = $messageData['text'];
        $message->attachment()->create();

        $message->chat()->associate($chat);
        $message->user()->associate($user);
    }
}
