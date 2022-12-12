<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class WelcomeController
{
    public function AuthenticatedStartPage()
    {
        $user = Auth::user();
        $contacts = $user->contacts;
        $chats = $user->chats->load([
            'users',
            'avatar',
        ])->loadUsingLimit('latestMessages');

        return view('auth.welcome', [
            'chats' => $chats,
            'contacts' => $contacts,
            'currentUser' => $user
        ]);
    }

    public function NotAuthenticatedStartPage()
    {
        Auth::loginUsingId(1);

        if (Auth::check()) {
            return redirect()->route('auth.welcome');
        }

        return view('welcome');
    }
}
