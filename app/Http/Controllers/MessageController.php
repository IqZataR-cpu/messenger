<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Services\SentMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private SentMessageService $sentMessageService;

    public function __construct(SentMessageService $sentMessageService)
    {
        $this->sentMessageService = $sentMessageService;
    }

    public function sent(Request $request)
    {
        $chat = Chat::findOrFail($request->chat_id);

        $message = $this->sentMessageService->sent($chat, Auth::user(), $request->message);
    }
}
