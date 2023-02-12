<?php

namespace App\Http\Controllers\Api\Contacts;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddContact
{
    public function add(Request $request): JsonResponse
    {
        $user = User::findOrFail($request->contact_id);

        Auth::user()->contacts()->attach($user->id);

        return response()->json();
    }
}
