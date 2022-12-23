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

    public function sent(Chat $chat, Request $request)
    {
        $message = $this->sentMessageService->sent($chat, Auth::user(), $request->message, $request->attachments);

        if (!$message) {
            return response()->json(['status' => 'failed'], 422);
        }

        return response()->json(['status' => 'success'], 228);
    }
}
