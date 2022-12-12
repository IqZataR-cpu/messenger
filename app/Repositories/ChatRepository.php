<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Models\User;

class ChatRepository
{
    public function getWithPagination(Chat $chat, int $offset, int $limit)
    {
        return $chat->messages()
            ->latest()
            ->with('attachment', 'user.avatar', 'statuses')
            ->take($limit)
            ->offset($offset)
            ->get();
    }

    public function getChatCompanion(Chat $chat, User $fromUser)
    {
        return $chat->users->where('id', '!=', $fromUser->id)->first();
    }

    public function existsInChat(User $user, Chat $chat)
    {
        return $chat->users()->whereId($user->id)->exists();
    }

    public function notExistsInChat(User $user, Chat $chat)
    {
        return !$this->existsInChat($user, $chat);
    }
}
