<?php

namespace App\View\Components;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MessageView extends Component
{
    private Message $message;
    private string $userMessagesCount;

    public function __construct(Message $message, string $userMessagesCount)
    {
        $this->message = $message;
        $this->userMessagesCount = $userMessagesCount;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $data = [
            'text' => $this->message->text,
            'attachments' => $this->message->attachments,
            'user' => $this->message->user,
            'isMine' => $this->message->user->is(Auth::user()),
            'userMessagesCount' => $this->userMessagesCount,
            'date' => $this->message->created_at->format('H:i'),
            'isEdited' => false
        ];

        if ($this->message->isEdited()) {
            $data = array_merge($data, ['isEdited' => true]);
        }

        return view('components.message-view', $data);
    }
}
