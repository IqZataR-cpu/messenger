<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchChatsController extends Controller
{
    public function search(Request $request)
    {
        $userId = Auth::user()->id;

        $search = $request->text;

        $query = DB::table('chats')
            ->join('messages', 'messages.chat_id', '=', 'chats.id')
            ->where('messages.user_id', $userId)
            ->where('chats.name', 'LIKE', '%' . $search . '%');

        $chats = $this->getChats($query->get()->groupBy('chat_id'));

        $messages = $query
            ->orWhere('messages.text', 'LIKE', '%' . $search . '%')
            ->get()
            ->groupBy('chat_id');

        return response()->json(
            [
                'success' => 'success',
                'data' => [
                    'chats' => $chats,
                    'messages' => $messages
                ]
            ]);
    }

    private function getChats($values)
    {
        $chats = new Collection();

        foreach ($values as $key => $value) {
            $chat = new Collection();
            $chat->push($value->last());
            $chats->push($chat);
        }

        return $chats;
    }
}
