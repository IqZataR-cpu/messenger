<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateProfile
{
    public function update(Request $request): JsonResponse
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'description' => $request->description,
            'email' => $request->email,
            'login' => $request->login,
        ]);

        return response()->json();
    }
}
