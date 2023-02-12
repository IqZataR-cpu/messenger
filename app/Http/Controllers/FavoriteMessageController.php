<?php

namespace App\Http\Controllers;

use App\Models\FavoriteMessage;
use App\Models\Message;
use Illuminate\Http\JsonResponse;

class FavoriteMessageController extends Controller
{
    /**
     * @param int $messageId
     * @throws \Exception
     */
    public function add(int $messageId): JsonResponse
    {
        if (!Message::where('id', $messageId)->exists()) {
            return response()->json(['errors' => 'Данное сообщение не существует!', 500]);
        }

        if (FavoriteMessage::where('message_id', $messageId)->exists()) {
            return response()->json(['errors' => 'Данное сообщение уже в избранном!', 500]);
        }

        $favoriteMessage = new FavoriteMessage();
        $favoriteMessage->message_id = $messageId;
        $favoriteMessage->save();

        return response()->json(['success' => 'success', 200]);
    }

    public function remove(int $messageId): JsonResponse
    {
        if (!Message::where('id', $messageId)->exists() || !FavoriteMessage::where('message_id', $messageId)->exists()) {
            return response()->json(['errors' => 'Данное сообщение не существует!', 500]);
        }

        $favoriteMessage = FavoriteMessage::where('message_id', $messageId)->first();
        $favoriteMessage->delete();

        return response()->json(['success' => 'success', 200]);
    }
}
