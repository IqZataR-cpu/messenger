<?php

namespace App\Services;

use App\Models\Attachment;
use App\Models\Chat;
use App\Models\Message;
use App\Models\MessageStatus;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class SentMessageService
{
    /**
     * @param Chat $chat
     * @param User $user
     * @param ?string $messageText
     * @param array<UploadedFile> $attachments
     * @return ?Message
     */
    public function sent(Chat $chat, User $user, ?string $messageText, ?array $attachments): ?Message
    {
        $message = new Message();

        DB::transaction(function () use (&$message, $chat, $user, $messageText, $attachments) {
            $message->text = $messageText;

            $message->chat()->associate($chat);
            $message->user()->associate($user);
            $message->save();

            $message->statuses()->attach(MessageStatus::sent());
            $message->statuses()->attach(MessageStatus::notRead());

            if (!$attachments) {
                return;
            }

            foreach ($attachments as $file) {
                $path = $file->storeAs('/attachments/', $file->getClientOriginalName());
                $attachment = new Attachment(['link' => url($path)]);

                $message->attachment()->save($attachment);
            }
        });

        return $message;
    }
}
