<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateProfile
{
    public function update(Request $request): JsonResponse
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        DB::transaction(function () use ($user, $request) {
            $user->update([
                'name' => $request->name,
                'description' => $request->description,
                'email' => $request->email,
                'login' => $request->login,
            ]);

            if ($file = $request->file('avatar')) {
                $attachment = new Attachment(['link' => 'temp']);
                $user->avatar()->save($attachment);
                $fileName = Str::random(32) . '_' . $attachment->id . '.' . $file->getClientOriginalExtension();
                $file->storeAs('attachments', $fileName);

                $attachment->link = $fileName;
                $attachment->save();
            }
        });


        return response()->json();
    }
}
