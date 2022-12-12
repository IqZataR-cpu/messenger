<?php

namespace App\View\Components;

use App\Models\Chat;
use App\Services\GetChatDescriptionService;
use App\Services\GetChatNameService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;
use Illuminate\View\View;

class DayView extends Component
{
    private string $createdAt;

    public function __construct($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return View
     */
    public function render()
    {
        $created_at = new \Carbon\Carbon((new \Carbon\Carbon($this->createdAt))->format('m/d/Y'));
        $dayName = $created_at->dayName;

        if ($created_at->lessThan(today()->subDays(5))) {
            $dayName = $created_at->format('d.m.Y');
        }

        if ($created_at->equalTo(today()->subDays(2))) {
            $dayName = 'Позавчера';
        }

        if ($created_at->equalTo(today()->subDay())) {
            $dayName = 'Вчера';
        }

        if ($created_at->equalTo(today())) {
            $dayName = 'Сегодня';
        }

        return view('components.day-view', [
            'rawDay' => $created_at->format('m/d/Y'),
            'dayName' => ucfirst(strtolower($dayName)),
        ]);
    }
}
