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
        $contact = User::findOrFail($request->contact_id);
        /**
         * @var User $user
         */
        $user = Auth::user();

        if (optional($user->contacts()->find($contact->id))->exists) {
            return response()->json();
        }

        $user->contacts()->attach($contact->id);

        return response()->json();
    }
}
