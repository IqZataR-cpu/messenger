<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\User;
use App\Repositories\ChatRepository;

class GetChatDescriptionService
{
    private ChatRepository $chatRepository;

    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function get(Chat $chat, User $fromUser)
     {
         if ($chat->isGroup())
         {
             return $chat->users->pluck('name')->implode(', ');
         }

         return $this->chatRepository->getChatCompanion($chat, $fromUser)->lastSeen();
     }
}
