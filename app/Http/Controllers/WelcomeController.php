<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WelcomeController
{
    public function AuthenticatedStartPage()
    {
        /**
         * @var User $user;
         */
        $user = Auth::user();
        $contacts = $user->contacts;
        $chats = [];

        if ($user->chats->isNotEmpty()) {
            $chats = $user->chats->load([
                'users',
                'avatar',
            ])
                ->loadUsingLimit('latestMessages')
                ->sortByDesc(function (Chat $chat) {
                    return optional($chat->latestMessages->first())->created_at;
                });
        }

        return view('auth.welcome', [
            'chats' => $chats,
            'contacts' => $contacts,
            'currentUser' => $user
        ]);
    }

    public function NotAuthenticatedStartPage()
    {
        return redirect()->route('auth.welcome');
    }
}
