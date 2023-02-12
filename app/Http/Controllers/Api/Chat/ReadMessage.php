<?php

namespace App\Http\Controllers\Api\Chat;

use App\Models\Chat;
use App\Models\Message;
use App\Models\MessageStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReadMessage
{
    public function read(Chat $chat): JsonResponse
    {
        $chat
            ->messages()
            ->where('user_id', Auth::id())
            ->get()
            ->each(function (Message $message) {
                $message->statuses()->attach(MessageStatus::read());
            });

        return response()->json();
    }
}
