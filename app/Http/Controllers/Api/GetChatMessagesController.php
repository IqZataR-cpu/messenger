<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GetChatMessagesController
{
    private ChatRepository $chatRepository;

    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function handle(Request $request, Chat $chat)
    {
        $user = Auth::user();

        if (!$chat && $this->chatRepository->notExistsInChat($user, $chat)) {
            return throw new AccessDeniedHttpException('Вас нет в этом чате!');
        }

        return MessageResource::collection(
            $this->chatRepository->getWithPagination(
                $chat,
                $request->offsetGet('offset'),
                Chat::MESSAGES_LIMIT
            )
        );
    }
}
