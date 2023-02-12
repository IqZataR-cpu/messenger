<?php

namespace App\Http\Controllers\Api\Chat;

use App\Models\Attachment;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateChat
{
    public function create(Request $request): JsonResponse
    {
        /**
         * @var Collection<User> $contacts
         */
        $contacts = User::whereIn('id', $request->contacts)
            ->get();

        if ($contacts->isEmpty()) {
            return response()->json();
        }

        /**
         * @var User $user
         */
        $user = Auth::user();

        if ($request->is_personal) {
            $alreadyExists = $user->chats()
                ->where('is_personal', true)
                ->whereHas('users', function ($query) use ($contacts) {
                    $query->where('users.id', $contacts->first()->id);
                })
                ->exists();

            if ($alreadyExists) {
                return response()->json();
            }
        }

        $chat = new Chat([
            'name' => $request->name ?? $contacts->first()->name,
            'description' => $request->description,
            'is_personal' => $request->is_personal
        ]);

        $chat->save();

        $chat->users()->attach($contacts->add($user));

        if ($file = $request->file('avatar')) {
            $attachment = new Attachment(['link' => 'temp']);
            $chat->avatar()->save($attachment);
            $fileName = Str::random(32) . '_' . $attachment->id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('attachments', $fileName);

            $attachment->link = $fileName;
            $attachment->save();
        } elseif ($user->avatar) {
            $chat->avatar()->create(['link'=> $user->avatar->link]);
        }

        return response()->json();
    }
}
