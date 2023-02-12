<?php

namespace App\View\Components;

use App\Models\Chat;
use App\Services\GetChatDescriptionService;
use App\Services\GetChatNameService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class WaitingElement extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.waiting-element');
    }
}
