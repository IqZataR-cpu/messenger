<?php

namespace App\View\Components;

use App\Models\Chat;
use App\Services\GetChatDescriptionService;
use App\Services\GetChatNameService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ChatView extends Component
{
    private Chat $chat;
    private GetChatNameService $getChatNameService;
    private GetChatDescriptionService $chatDescriptionService;

    public function __construct(
        Chat $chat,
        GetChatNameService $getChatNameService,
        GetChatDescriptionService $chatDescriptionService
    ) {
        $this->chat = $chat;
        $this->getChatNameService = $getChatNameService;
        $this->chatDescriptionService = $chatDescriptionService;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.chat-view', [
            'name' => $this->getChatNameService->get($this->chat, Auth::user()),
            'description' => $this->chatDescriptionService->get($this->chat, Auth::user()),
            'avatar' => $this->chat->avatar,
            'tab' => $this->chat->id,
            'messages' => $this->chat->latestMessages->reverse()
        ]);
    }
}
